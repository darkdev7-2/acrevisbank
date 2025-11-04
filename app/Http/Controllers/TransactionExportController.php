<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class TransactionExportController extends Controller
{
    /**
     * Export transactions to PDF
     */
    public function exportPDF(Request $request, $locale, $accountId)
    {
        $user = Auth::user();
        $account = Account::where('id', $accountId)
            ->where('user_id', $user->id)
            ->firstOrFail();

        // Build query with filters
        $query = $account->transactions()->orderBy('transaction_date', 'desc');

        // Apply filters
        if ($request->has('date_from') && $request->date_from) {
            $query->where('transaction_date', '>=', Carbon::parse($request->date_from));
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->where('transaction_date', '<=', Carbon::parse($request->date_to)->endOfDay());
        }

        if ($request->has('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        if ($request->has('min_amount') && $request->min_amount) {
            $query->where('amount', '>=', $request->min_amount);
        }

        if ($request->has('max_amount') && $request->max_amount) {
            $query->where('amount', '<=', $request->max_amount);
        }

        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('recipient_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('reference', 'like', '%' . $searchTerm . '%');
            });
        }

        $transactions = $query->get();

        $pdf = Pdf::loadView('pdf.transactions', [
            'account' => $account,
            'transactions' => $transactions,
            'user' => $user,
            'filters' => $request->all(),
            'locale' => $locale,
        ]);

        $filename = 'transactions_' . $account->account_number . '_' . date('Y-m-d') . '.pdf';
        return $pdf->download($filename);
    }

    /**
     * Export transactions to CSV
     */
    public function exportCSV(Request $request, $locale, $accountId)
    {
        $user = Auth::user();
        $account = Account::where('id', $accountId)
            ->where('user_id', $user->id)
            ->firstOrFail();

        // Build query with filters
        $query = $account->transactions()->orderBy('transaction_date', 'desc');

        // Apply same filters as PDF
        if ($request->has('date_from') && $request->date_from) {
            $query->where('transaction_date', '>=', Carbon::parse($request->date_from));
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->where('transaction_date', '<=', Carbon::parse($request->date_to)->endOfDay());
        }

        if ($request->has('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        if ($request->has('min_amount') && $request->min_amount) {
            $query->where('amount', '>=', $request->min_amount);
        }

        if ($request->has('max_amount') && $request->max_amount) {
            $query->where('amount', '<=', $request->max_amount);
        }

        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('recipient_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('reference', 'like', '%' . $searchTerm . '%');
            });
        }

        $transactions = $query->get();

        // Create CSV
        $filename = 'transactions_' . $account->account_number . '_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($transactions, $locale) {
            $file = fopen('php://output', 'w');

            // CSV Header
            $headerLabels = $this->getCSVHeaders($locale);
            fputcsv($file, $headerLabels);

            // CSV Data
            foreach ($transactions as $transaction) {
                $row = [
                    $transaction->transaction_date->format('d.m.Y H:i'),
                    $transaction->reference,
                    $transaction->description ?? '-',
                    $transaction->recipient_name ?? '-',
                    $transaction->recipient_iban ?? '-',
                    $transaction->type === 'debit' ? 'Débit' : 'Crédit',
                    $transaction->category,
                    number_format($transaction->amount, 2, '.', ''),
                    $transaction->currency,
                    number_format($transaction->balance_after, 2, '.', ''),
                    $this->getStatusLabel($transaction->status, $locale),
                ];
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Download transfer receipt as PDF
     */
    public function downloadReceipt($locale, $transactionId)
    {
        $user = Auth::user();

        $transaction = Transaction::whereHas('account', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->findOrFail($transactionId);

        $account = $transaction->account;

        $pdf = Pdf::loadView('pdf.receipt', [
            'transaction' => $transaction,
            'account' => $account,
            'user' => $user,
            'locale' => $locale,
        ]);

        $filename = 'receipt_' . $transaction->reference . '.pdf';
        return $pdf->download($filename);
    }

    /**
     * Get CSV headers based on locale
     */
    private function getCSVHeaders($locale)
    {
        $headers = [
            'fr' => ['Date', 'Référence', 'Description', 'Bénéficiaire', 'IBAN', 'Type', 'Catégorie', 'Montant', 'Devise', 'Solde après', 'Statut'],
            'de' => ['Datum', 'Referenz', 'Beschreibung', 'Empfänger', 'IBAN', 'Typ', 'Kategorie', 'Betrag', 'Währung', 'Saldo danach', 'Status'],
            'en' => ['Date', 'Reference', 'Description', 'Recipient', 'IBAN', 'Type', 'Category', 'Amount', 'Currency', 'Balance after', 'Status'],
            'es' => ['Fecha', 'Referencia', 'Descripción', 'Beneficiario', 'IBAN', 'Tipo', 'Categoría', 'Monto', 'Moneda', 'Saldo después', 'Estado'],
        ];

        return $headers[$locale] ?? $headers['fr'];
    }

    /**
     * Get status label based on locale
     */
    private function getStatusLabel($status, $locale)
    {
        $labels = [
            'fr' => [
                'pending' => 'En attente',
                'completed' => 'Complété',
                'failed' => 'Échoué',
                'cancelled' => 'Annulé',
            ],
            'de' => [
                'pending' => 'Ausstehend',
                'completed' => 'Abgeschlossen',
                'failed' => 'Fehlgeschlagen',
                'cancelled' => 'Storniert',
            ],
            'en' => [
                'pending' => 'Pending',
                'completed' => 'Completed',
                'failed' => 'Failed',
                'cancelled' => 'Cancelled',
            ],
            'es' => [
                'pending' => 'Pendiente',
                'completed' => 'Completado',
                'failed' => 'Fallido',
                'cancelled' => 'Cancelado',
            ],
        ];

        return $labels[$locale][$status] ?? $labels['fr'][$status] ?? $status;
    }
}
