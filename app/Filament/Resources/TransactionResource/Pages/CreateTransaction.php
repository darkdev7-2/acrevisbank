<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use App\Models\Account;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Generate transaction number if not set
        if (empty($data['transaction_number'])) {
            $data['transaction_number'] = 'TRX-' . strtoupper(substr(uniqid(), -10));
        }

        // Calculate balance_after if not set
        if (isset($data['account_id']) && isset($data['amount']) && isset($data['type'])) {
            $account = Account::find($data['account_id']);
            if ($account) {
                $data['balance_after'] = $data['type'] === 'credit'
                    ? $account->available_balance + $data['amount']
                    : $account->available_balance - $data['amount'];
            }
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        // Update account balance after transaction creation
        $transaction = $this->record;

        if ($transaction->status === 'completed' && $transaction->account) {
            $account = $transaction->account;

            if ($transaction->type === 'credit') {
                $account->balance += $transaction->amount;
                $account->available_balance += $transaction->amount;
            } else {
                $account->balance -= $transaction->amount;
                $account->available_balance -= $transaction->amount;
            }

            $account->save();

            Notification::make()
                ->success()
                ->title('Transaction créée')
                ->body("Le solde du compte a été mis à jour: " . number_format($account->available_balance, 2) . " CHF")
                ->send();
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
