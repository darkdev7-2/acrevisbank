<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $locale === 'fr' ? 'Reçu de virement' : ($locale === 'de' ? 'Überweisungsbeleg' : ($locale === 'en' ? 'Transfer Receipt' : 'Recibo de transferencia')) }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #333; }
        .header { text-align: center; margin-bottom: 40px; border-bottom: 3px solid #d91b5c; padding-bottom: 20px; }
        .header h1 { color: #d91b5c; margin: 0; font-size: 28px; }
        .header .subtitle { color: #666; margin-top: 8px; font-size: 14px; }
        .success-badge { background-color: #16a34a; color: white; padding: 10px 20px; border-radius: 5px; display: inline-block; margin: 20px 0; font-weight: bold; }
        .info-section { background: #f5f5f5; padding: 20px; margin-bottom: 25px; border-radius: 8px; border-left: 4px solid #d91b5c; }
        .info-section h3 { color: #d91b5c; margin-top: 0; margin-bottom: 15px; font-size: 14px; }
        .info-row { margin-bottom: 12px; display: flex; }
        .info-label { font-weight: bold; width: 180px; color: #666; }
        .info-value { flex: 1; }
        .amount-box { background: linear-gradient(135deg, #d91b5c 0%, #b8154a 100%); color: white; padding: 25px; text-align: center; border-radius: 8px; margin: 30px 0; }
        .amount-box .label { font-size: 12px; opacity: 0.9; margin-bottom: 10px; }
        .amount-box .amount { font-size: 32px; font-weight: bold; }
        .reference-box { background: #fff3cd; border: 2px dashed #ffc107; padding: 15px; text-align: center; border-radius: 5px; margin: 20px 0; }
        .reference-box .label { font-size: 10px; color: #856404; margin-bottom: 5px; }
        .reference-box .reference { font-size: 16px; font-weight: bold; color: #856404; font-family: monospace; }
        .footer { margin-top: 50px; text-align: center; font-size: 9px; color: #999; border-top: 2px solid #ddd; padding-top: 20px; }
        .footer .security-notice { background: #e3f2fd; padding: 15px; border-radius: 5px; margin-top: 20px; color: #1976d2; }
        .divider { border-top: 1px solid #ddd; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="header">
        <h1>ACREVIS BANK</h1>
        <div class="subtitle">{{ $locale === 'fr' ? 'Reçu de virement bancaire' : ($locale === 'de' ? 'Banküberweisungsbeleg' : ($locale === 'en' ? 'Bank Transfer Receipt' : 'Recibo de transferencia bancaria')) }}</div>
        <div class="success-badge">
            ✓ {{ $locale === 'fr' ? 'OPÉRATION RÉUSSIE' : ($locale === 'de' ? 'ERFOLGREICH' : ($locale === 'en' ? 'SUCCESSFUL' : 'EXITOSO')) }}
        </div>
    </div>

    <div class="reference-box">
        <div class="label">{{ $locale === 'fr' ? 'RÉFÉRENCE DE TRANSACTION' : ($locale === 'de' ? 'TRANSAKTIONSREFERENZ' : ($locale === 'en' ? 'TRANSACTION REFERENCE' : 'REFERENCIA DE TRANSACCIÓN')) }}</div>
        <div class="reference">{{ $transaction->reference }}</div>
    </div>

    <div class="info-section">
        <h3>{{ $locale === 'fr' ? '📤 Informations de l\'expéditeur' : ($locale === 'de' ? '📤 Absenderinformationen' : ($locale === 'en' ? '📤 Sender Information' : '📤 Información del remitente')) }}</h3>
        <div class="info-row">
            <span class="info-label">{{ $locale === 'fr' ? 'Nom' : ($locale === 'de' ? 'Name' : ($locale === 'en' ? 'Name' : 'Nombre')) }}:</span>
            <span class="info-value">{{ $user->name }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">{{ $locale === 'fr' ? 'Compte débiteur' : ($locale === 'de' ? 'Belastungskonto' : ($locale === 'en' ? 'Debit Account' : 'Cuenta de débito')) }}:</span>
            <span class="info-value">{{ $account->account_type }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">{{ $locale === 'fr' ? 'Numéro de compte' : ($locale === 'de' ? 'Kontonummer' : ($locale === 'en' ? 'Account Number' : 'Número de cuenta')) }}:</span>
            <span class="info-value">{{ $account->account_number }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">IBAN:</span>
            <span class="info-value">{{ trim($account->formatted_iban) }}</span>
        </div>
    </div>

    <div class="info-section">
        <h3>{{ $locale === 'fr' ? '📥 Informations du bénéficiaire' : ($locale === 'de' ? '📥 Empfängerinformationen' : ($locale === 'en' ? '📥 Recipient Information' : '📥 Información del beneficiario')) }}</h3>
        <div class="info-row">
            <span class="info-label">{{ $locale === 'fr' ? 'Nom' : ($locale === 'de' ? 'Name' : ($locale === 'en' ? 'Name' : 'Nombre')) }}:</span>
            <span class="info-value">{{ $transaction->recipient_name }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">IBAN:</span>
            <span class="info-value">{{ chunk_split($transaction->recipient_iban, 4, ' ') }}</span>
        </div>
        @if($transaction->description)
        <div class="info-row">
            <span class="info-label">{{ $locale === 'fr' ? 'Description' : ($locale === 'de' ? 'Beschreibung' : ($locale === 'en' ? 'Description' : 'Descripción')) }}:</span>
            <span class="info-value">{{ $transaction->description }}</span>
        </div>
        @endif
    </div>

    <div class="amount-box">
        <div class="label">{{ $locale === 'fr' ? 'MONTANT TRANSFÉRÉ' : ($locale === 'de' ? 'ÜBERWIESENER BETRAG' : ($locale === 'en' ? 'TRANSFERRED AMOUNT' : 'MONTO TRANSFERIDO')) }}</div>
        <div class="amount">{{ number_format($transaction->amount, 2, '.', "'") }} {{ $transaction->currency }}</div>
    </div>

    <div class="info-section">
        <h3>{{ $locale === 'fr' ? '📋 Détails de l\'opération' : ($locale === 'de' ? '📋 Transaktionsdetails' : ($locale === 'en' ? '📋 Operation Details' : '📋 Detalles de la operación')) }}</h3>
        <div class="info-row">
            <span class="info-label">{{ $locale === 'fr' ? 'Date et heure' : ($locale === 'de' ? 'Datum und Uhrzeit' : ($locale === 'en' ? 'Date and Time' : 'Fecha y hora')) }}:</span>
            <span class="info-value">{{ $transaction->transaction_date->format('d.m.Y \à H:i') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">{{ $locale === 'fr' ? 'Type de transaction' : ($locale === 'de' ? 'Transaktionstyp' : ($locale === 'en' ? 'Transaction Type' : 'Tipo de transacción')) }}:</span>
            <span class="info-value">{{ $locale === 'fr' ? 'Virement bancaire' : ($locale === 'de' ? 'Banküberweisung' : ($locale === 'en' ? 'Bank Transfer' : 'Transferencia bancaria')) }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">{{ $locale === 'fr' ? 'Catégorie' : ($locale === 'de' ? 'Kategorie' : ($locale === 'en' ? 'Category' : 'Categoría')) }}:</span>
            <span class="info-value">{{ ucfirst($transaction->category) }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">{{ $locale === 'fr' ? 'Statut' : ($locale === 'de' ? 'Status' : ($locale === 'en' ? 'Status' : 'Estado')) }}:</span>
            <span class="info-value">
                @if($transaction->status === 'completed')
                    <span style="color: #16a34a; font-weight: bold;">✓ {{ $locale === 'fr' ? 'Complété' : ($locale === 'de' ? 'Abgeschlossen' : ($locale === 'en' ? 'Completed' : 'Completado')) }}</span>
                @else
                    {{ $transaction->status }}
                @endif
            </span>
        </div>
        <div class="info-row">
            <span class="info-label">{{ $locale === 'fr' ? 'Solde après opération' : ($locale === 'de' ? 'Saldo nach Transaktion' : ($locale === 'en' ? 'Balance after operation' : 'Saldo después de operación')) }}:</span>
            <span class="info-value">{{ number_format($transaction->balance_after, 2, '.', "'") }} {{ $transaction->currency }}</span>
        </div>
    </div>

    <div class="footer">
        <div class="security-notice">
            <strong>🔒 {{ $locale === 'fr' ? 'SÉCURITÉ' : ($locale === 'de' ? 'SICHERHEIT' : ($locale === 'en' ? 'SECURITY' : 'SEGURIDAD')) }}</strong><br>
            {{ $locale === 'fr' ? 'Ce reçu confirme que votre virement a été traité avec succès. Conservez-le pour vos dossiers.' : ($locale === 'de' ? 'Dieser Beleg bestätigt, dass Ihre Überweisung erfolgreich verarbeitet wurde. Bewahren Sie ihn für Ihre Unterlagen auf.' : ($locale === 'en' ? 'This receipt confirms that your transfer has been processed successfully. Keep it for your records.' : 'Este recibo confirma que su transferencia ha sido procesada con éxito. Consérvelo para sus registros.')) }}
        </div>
        <div class="divider"></div>
        <p><strong>ACREVIS BANK AG</strong></p>
        <p>St. Gallen | Zürich | Geneva</p>
        <p>Tel: +41 71 227 27 27 | Email: info@acrevis.ch | www.acrevis.ch</p>
        <p style="margin-top: 15px; font-size: 8px;">
            {{ $locale === 'fr' ? 'Document généré le' : ($locale === 'de' ? 'Dokument erstellt am' : ($locale === 'en' ? 'Document generated on' : 'Documento generado el')) }} {{ date('d.m.Y \à H:i') }}<br>
            {{ $locale === 'fr' ? 'Ce document a été généré électroniquement et est valable sans signature.' : ($locale === 'de' ? 'Dieses Dokument wurde elektronisch erstellt und ist ohne Unterschrift gültig.' : ($locale === 'en' ? 'This document has been generated electronically and is valid without signature.' : 'Este documento ha sido generado electrónicamente y es válido sin firma.')) }}
        </p>
    </div>
</body>
</html>
