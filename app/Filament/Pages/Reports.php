<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Actions\Action;
use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\CreditRequest;
use Illuminate\Support\Facades\Response;

class Reports extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    protected static ?string $navigationGroup = 'Administration';

    protected static ?string $navigationLabel = 'Rapports';

    protected static string $view = 'filament.pages.reports';

    protected static ?int $navigationSort = 12;

    public function getHeaderActions(): array
    {
        return [
            Action::make('export_users')
                ->label('Exporter Clients (CSV)')
                ->icon('heroicon-o-user-group')
                ->color('primary')
                ->action('exportUsers'),

            Action::make('export_accounts')
                ->label('Exporter Comptes (CSV)')
                ->icon('heroicon-o-credit-card')
                ->color('success')
                ->action('exportAccounts'),

            Action::make('export_transactions')
                ->label('Exporter Transactions (CSV)')
                ->icon('heroicon-o-arrow-path')
                ->color('warning')
                ->action('exportTransactions'),

            Action::make('export_credit_requests')
                ->label('Exporter Demandes de Crédit (CSV)')
                ->icon('heroicon-o-banknotes')
                ->color('danger')
                ->action('exportCreditRequests'),
        ];
    }

    public function exportUsers()
    {
        $filename = 'clients_' . now()->format('Y-m-d_His') . '.csv';

        $callback = function() {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Prénom', 'Nom', 'Email', 'Téléphone', 'Statut Validation', 'Date Création']);

            User::chunk(100, function($users) use ($file) {
                foreach ($users as $user) {
                    fputcsv($file, [
                        $user->id,
                        $user->first_name,
                        $user->last_name,
                        $user->email,
                        $user->phone,
                        $user->validation_status,
                        $user->created_at->format('d/m/Y H:i'),
                    ]);
                }
            });

            fclose($file);
        };

        return Response::stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }

    public function exportAccounts()
    {
        $filename = 'comptes_' . now()->format('Y-m-d_His') . '.csv';

        $callback = function() {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Numéro Compte', 'IBAN', 'Client', 'Type', 'Devise', 'Solde', 'Actif', 'Date Ouverture']);

            Account::with('user')->chunk(100, function($accounts) use ($file) {
                foreach ($accounts as $account) {
                    fputcsv($file, [
                        $account->id,
                        $account->account_number,
                        $account->iban,
                        $account->user->first_name . ' ' . $account->user->last_name,
                        $account->account_type,
                        $account->currency,
                        $account->balance,
                        $account->is_active ? 'Oui' : 'Non',
                        $account->opened_at ? $account->opened_at->format('d/m/Y') : '',
                    ]);
                }
            });

            fclose($file);
        };

        return Response::stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }

    public function exportTransactions()
    {
        $filename = 'transactions_' . now()->format('Y-m-d_His') . '.csv';

        $callback = function() {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Numéro Transaction', 'Compte', 'Type', 'Catégorie', 'Montant', 'Devise', 'Statut', 'Date']);

            Transaction::with('account')->chunk(100, function($transactions) use ($file) {
                foreach ($transactions as $transaction) {
                    fputcsv($file, [
                        $transaction->id,
                        $transaction->transaction_number,
                        $transaction->account->account_number,
                        $transaction->type,
                        $transaction->category,
                        $transaction->amount,
                        $transaction->currency,
                        $transaction->status,
                        $transaction->transaction_date->format('d/m/Y H:i'),
                    ]);
                }
            });

            fclose($file);
        };

        return Response::stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }

    public function exportCreditRequests()
    {
        $filename = 'demandes_credit_' . now()->format('Y-m-d_His') . '.csv';

        $callback = function() {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Référence', 'Prénom', 'Nom', 'Email', 'Montant', 'Durée', 'Statut', 'Date']);

            CreditRequest::chunk(100, function($requests) use ($file) {
                foreach ($requests as $request) {
                    fputcsv($file, [
                        $request->id,
                        $request->reference_number,
                        $request->first_name,
                        $request->last_name,
                        $request->email,
                        $request->amount,
                        $request->duration_months,
                        $request->status,
                        $request->created_at->format('d/m/Y H:i'),
                    ]);
                }
            });

            fclose($file);
        };

        return Response::stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }

    public function getStats()
    {
        return [
            'total_users' => User::count(),
            'validated_users' => User::where('validation_status', 'validated')->count(),
            'pending_users' => User::where('validation_status', 'pending')->count(),
            'total_accounts' => Account::count(),
            'active_accounts' => Account::where('is_active', true)->count(),
            'total_balance' => Account::sum('balance'),
            'total_transactions' => Transaction::count(),
            'completed_transactions' => Transaction::where('status', 'completed')->count(),
            'total_credit_requests' => CreditRequest::count(),
            'approved_credits' => CreditRequest::where('status', 'approved')->count(),
            'pending_credits' => CreditRequest::where('status', 'pending')->count(),
        ];
    }
}
