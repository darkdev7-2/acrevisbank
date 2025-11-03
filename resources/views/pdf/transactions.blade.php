<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $locale === 'fr' ? 'Relevé de transactions' : ($locale === 'de' ? 'Transaktionsauszug' : ($locale === 'en' ? 'Transaction Statement' : 'Estado de transacciones')) }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 10px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #d91b5c; padding-bottom: 20px; }
        .header h1 { color: #d91b5c; margin: 0; font-size: 24px; }
        .header .subtitle { color: #666; margin-top: 5px; }
        .info-box { background: #f5f5f5; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .info-row { margin-bottom: 8px; }
        .info-label { font-weight: bold; display: inline-block; width: 150px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #d91b5c; color: white; padding: 10px; text-align: left; font-size: 9px; }
        td { padding: 8px; border-bottom: 1px solid #ddd; font-size: 9px; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .debit { color: #dc2626; }
        .credit { color: #16a34a; }
        .footer { margin-top: 40px; text-align: center; font-size: 8px; color: #999; border-top: 1px solid #ddd; padding-top: 20px; }
        .total-row { font-weight: bold; background-color: #fff3cd !important; }
    </style>
</head>
<body>
    <div class="header">
        <h1>ACREVIS BANK</h1>
        <div class="subtitle">{{ $locale === 'fr' ? 'Relevé de transactions' : ($locale === 'de' ? 'Transaktionsauszug' : ($locale === 'en' ? 'Transaction Statement' : 'Estado de transacciones')) }}</div>
    </div>

    <div class="info-box">
        <div class="info-row">
            <span class="info-label">{{ $locale === 'fr' ? 'Titulaire' : ($locale === 'de' ? 'Kontoinhaber' : ($locale === 'en' ? 'Account Holder' : 'Titular')) }}:</span>
            {{ $user->name }}
        </div>
        <div class="info-row">
            <span class="info-label">{{ $locale === 'fr' ? 'Compte' : ($locale === 'de' ? 'Konto' : ($locale === 'en' ? 'Account' : 'Cuenta')) }}:</span>
            {{ $account->account_type }} - {{ $account->account_number }}
        </div>
        <div class="info-row">
            <span class="info-label">IBAN:</span>
            {{ trim($account->formatted_iban) }}
        </div>
        <div class="info-row">
            <span class="info-label">{{ $locale === 'fr' ? 'Date d\'édition' : ($locale === 'de' ? 'Erstellungsdatum' : ($locale === 'en' ? 'Issue Date' : 'Fecha de emisión')) }}:</span>
            {{ date('d.m.Y H:i') }}
        </div>
        <div class="info-row">
            <span class="info-label">{{ $locale === 'fr' ? 'Période' : ($locale === 'de' ? 'Zeitraum' : ($locale === 'en' ? 'Period' : 'Período')) }}:</span>
            @if(isset($filters['date_from']) || isset($filters['date_to']))
                {{ $filters['date_from'] ?? '...' }} {{ $locale === 'fr' ? 'au' : ($locale === 'de' ? 'bis' : ($locale === 'en' ? 'to' : 'hasta')) }} {{ $filters['date_to'] ?? '...' }}
            @else
                {{ $locale === 'fr' ? 'Toutes les transactions' : ($locale === 'de' ? 'Alle Transaktionen' : ($locale === 'en' ? 'All transactions' : 'Todas las transacciones')) }}
            @endif
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>{{ $locale === 'fr' ? 'Date' : ($locale === 'de' ? 'Datum' : ($locale === 'en' ? 'Date' : 'Fecha')) }}</th>
                <th>{{ $locale === 'fr' ? 'Référence' : ($locale === 'de' ? 'Referenz' : ($locale === 'en' ? 'Reference' : 'Referencia')) }}</th>
                <th>{{ $locale === 'fr' ? 'Description' : ($locale === 'de' ? 'Beschreibung' : ($locale === 'en' ? 'Description' : 'Descripción')) }}</th>
                <th>{{ $locale === 'fr' ? 'Bénéficiaire' : ($locale === 'de' ? 'Empfänger' : ($locale === 'en' ? 'Recipient' : 'Beneficiario')) }}</th>
                <th style="text-align: right;">{{ $locale === 'fr' ? 'Montant' : ($locale === 'de' ? 'Betrag' : ($locale === 'en' ? 'Amount' : 'Monto')) }}</th>
                <th style="text-align: right;">{{ $locale === 'fr' ? 'Solde' : ($locale === 'de' ? 'Saldo' : ($locale === 'en' ? 'Balance' : 'Saldo')) }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $transaction)
            <tr>
                <td>{{ $transaction->transaction_date->format('d.m.Y H:i') }}</td>
                <td>{{ $transaction->reference }}</td>
                <td>{{ $transaction->description ?? '-' }}</td>
                <td>{{ $transaction->recipient_name ?? '-' }}</td>
                <td style="text-align: right;" class="{{ $transaction->type === 'debit' ? 'debit' : 'credit' }}">
                    {{ $transaction->type === 'debit' ? '-' : '+' }} {{ number_format($transaction->amount, 2, '.', "'") }} {{ $transaction->currency }}
                </td>
                <td style="text-align: right;">{{ number_format($transaction->balance_after, 2, '.', "'") }} {{ $transaction->currency }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 20px;">
                    {{ $locale === 'fr' ? 'Aucune transaction trouvée' : ($locale === 'de' ? 'Keine Transaktionen gefunden' : ($locale === 'en' ? 'No transactions found' : 'No se encontraron transacciones')) }}
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p><strong>ACREVIS BANK AG</strong></p>
        <p>St. Gallen | Zürich | Geneva | www.acrevis.ch</p>
        <p>{{ $locale === 'fr' ? 'Ce document a été généré électroniquement et est valable sans signature.' : ($locale === 'de' ? 'Dieses Dokument wurde elektronisch erstellt und ist ohne Unterschrift gültig.' : ($locale === 'en' ? 'This document has been generated electronically and is valid without signature.' : 'Este documento ha sido generado electrónicamente y es válido sin firma.')) }}</p>
    </div>
</body>
</html>
