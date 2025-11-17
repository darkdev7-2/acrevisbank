<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Card;
use App\Models\CardTransaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CardService
{
    /**
     * Create a new virtual card for an account
     */
    public function createVirtualCard(Account $account, array $data = []): Card
    {
        return DB::transaction(function () use ($account, $data) {
            $cardNumber = $this->generateCardNumber();
            $cvv = $this->generateCVV();
            $expiryDate = $this->calculateExpiryDate();

            $card = Card::create([
                'account_id' => $account->id,
                'card_number' => $cardNumber,
                'cvv' => $cvv,
                'expiry_month' => $expiryDate['month'],
                'expiry_year' => $expiryDate['year'],
                'cardholder_name' => $data['cardholder_name'] ?? strtoupper($account->user->full_name),
                'card_type' => $data['card_type'] ?? 'Visa',
                'status' => 'pending',
                'is_virtual' => true,
                'daily_limit' => $data['daily_limit'] ?? 5000.00,
                'monthly_limit' => $data['monthly_limit'] ?? 50000.00,
            ]);

            // Log activity
            activity()
                ->performedOn($card)
                ->causedBy($account->user)
                ->withProperties([
                    'account_id' => $account->id,
                    'card_type' => $card->card_type,
                ])
                ->log('Virtual card created');

            return $card;
        });
    }

    /**
     * Activate a card
     */
    public function activateCard(Card $card, User $activatedBy = null): bool
    {
        if ($card->status !== 'pending') {
            return false;
        }

        $card->update([
            'status' => 'active',
            'activated_at' => now(),
        ]);

        activity()
            ->performedOn($card)
            ->causedBy($activatedBy ?? $card->account->user)
            ->log('Card activated');

        return true;
    }

    /**
     * Block a card
     */
    public function blockCard(Card $card, string $reason, User $blockedBy = null): bool
    {
        if ($card->status === 'cancelled' || $card->status === 'blocked') {
            return false;
        }

        $card->update([
            'status' => 'blocked',
            'blocked_at' => now(),
            'blocked_reason' => $reason,
        ]);

        activity()
            ->performedOn($card)
            ->causedBy($blockedBy ?? $card->account->user)
            ->withProperties(['reason' => $reason])
            ->log('Card blocked');

        return true;
    }

    /**
     * Unblock a card
     */
    public function unblockCard(Card $card, User $unblockedBy = null): bool
    {
        if ($card->status !== 'blocked') {
            return false;
        }

        $card->update([
            'status' => 'active',
            'blocked_at' => null,
            'blocked_reason' => null,
        ]);

        activity()
            ->performedOn($card)
            ->causedBy($unblockedBy ?? $card->account->user)
            ->log('Card unblocked');

        return true;
    }

    /**
     * Cancel a card permanently
     */
    public function cancelCard(Card $card, User $cancelledBy = null): bool
    {
        if ($card->status === 'cancelled') {
            return false;
        }

        $card->update([
            'status' => 'cancelled',
        ]);

        activity()
            ->performedOn($card)
            ->causedBy($cancelledBy ?? $card->account->user)
            ->log('Card cancelled');

        return true;
    }

    /**
     * Renew a card (creates a new card with new details)
     */
    public function renewCard(Card $oldCard): Card
    {
        return DB::transaction(function () use ($oldCard) {
            // Cancel old card
            $this->cancelCard($oldCard);

            // Create new card
            $newCard = Card::create([
                'account_id' => $oldCard->account_id,
                'card_number' => $this->generateCardNumber(),
                'cvv' => $this->generateCVV(),
                'expiry_month' => $this->calculateExpiryDate()['month'],
                'expiry_year' => $this->calculateExpiryDate()['year'],
                'cardholder_name' => $oldCard->cardholder_name,
                'card_type' => $oldCard->card_type,
                'status' => 'pending',
                'is_virtual' => $oldCard->is_virtual,
                'daily_limit' => $oldCard->daily_limit,
                'monthly_limit' => $oldCard->monthly_limit,
            ]);

            activity()
                ->performedOn($newCard)
                ->causedBy($oldCard->account->user)
                ->withProperties([
                    'old_card_id' => $oldCard->id,
                    'reason' => 'renewal',
                ])
                ->log('Card renewed');

            return $newCard;
        });
    }

    /**
     * Process a card transaction
     */
    public function processTransaction(Card $card, array $data): CardTransaction
    {
        return DB::transaction(function () use ($card, $data) {
            $amount = $data['amount'];

            // Check if card can transact
            if (!$card->canTransact($amount)) {
                $transaction = CardTransaction::create([
                    'card_id' => $card->id,
                    'transaction_id' => $this->generateTransactionId(),
                    'type' => $data['type'] ?? 'purchase',
                    'amount' => $amount,
                    'currency' => $data['currency'] ?? 'CHF',
                    'merchant_name' => $data['merchant_name'] ?? null,
                    'merchant_category' => $data['merchant_category'] ?? null,
                    'merchant_city' => $data['merchant_city'] ?? null,
                    'merchant_country' => $data['merchant_country'] ?? null,
                    'status' => 'declined',
                    'decline_reason' => $this->determineDeclineReason($card, $amount),
                    'is_online' => $data['is_online'] ?? false,
                    'is_international' => $data['is_international'] ?? false,
                    'ip_address' => request()->ip(),
                ]);

                return $transaction;
            }

            // Create approved transaction
            $transaction = CardTransaction::create([
                'card_id' => $card->id,
                'transaction_id' => $this->generateTransactionId(),
                'type' => $data['type'] ?? 'purchase',
                'amount' => $amount,
                'currency' => $data['currency'] ?? 'CHF',
                'merchant_name' => $data['merchant_name'] ?? null,
                'merchant_category' => $data['merchant_category'] ?? null,
                'merchant_city' => $data['merchant_city'] ?? null,
                'merchant_country' => $data['merchant_country'] ?? null,
                'status' => 'approved',
                'authorization_code' => $this->generateAuthorizationCode(),
                'is_online' => $data['is_online'] ?? false,
                'is_international' => $data['is_international'] ?? false,
                'ip_address' => request()->ip(),
                'authorized_at' => now(),
                'settled_at' => now(),
            ]);

            // Update card spending limits
            $card->increment('daily_spent', $amount);
            $card->increment('monthly_spent', $amount);
            $card->update(['last_used_at' => now()]);

            // Update account balance
            $card->account->decrement('balance', $amount);
            $card->account->decrement('available_balance', $amount);

            activity()
                ->performedOn($transaction)
                ->causedBy($card->account->user)
                ->withProperties([
                    'amount' => $amount,
                    'merchant' => $data['merchant_name'] ?? 'N/A',
                ])
                ->log('Card transaction processed');

            return $transaction;
        });
    }

    /**
     * Reset daily spending limits (should be run daily via cron)
     */
    public function resetDailyLimits(): int
    {
        return Card::where('daily_spent', '>', 0)->update(['daily_spent' => 0]);
    }

    /**
     * Reset monthly spending limits (should be run monthly via cron)
     */
    public function resetMonthlyLimits(): int
    {
        return Card::where('monthly_spent', '>', 0)->update(['monthly_spent' => 0]);
    }

    /**
     * Mark expired cards
     */
    public function markExpiredCards(): int
    {
        $count = 0;

        Card::where('status', 'active')->get()->each(function ($card) use (&$count) {
            if ($card->is_expired) {
                $card->update(['status' => 'expired']);
                $count++;
            }
        });

        return $count;
    }

    /**
     * Generate a random 16-digit card number (Luhn algorithm compliant)
     */
    protected function generateCardNumber(): string
    {
        // Start with a common BIN (Bank Identification Number) for Visa: 4
        $prefix = '4532'; // Visa test card prefix
        $length = 16;

        // Generate random digits
        $number = $prefix;
        for ($i = strlen($prefix); $i < $length - 1; $i++) {
            $number .= rand(0, 9);
        }

        // Calculate Luhn check digit
        $sum = 0;
        $shouldDouble = true;

        for ($i = strlen($number) - 1; $i >= 0; $i--) {
            $digit = (int) $number[$i];

            if ($shouldDouble) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $sum += $digit;
            $shouldDouble = !$shouldDouble;
        }

        $checkDigit = (10 - ($sum % 10)) % 10;
        $number .= $checkDigit;

        return $number;
    }

    /**
     * Generate a random 3-digit CVV
     */
    protected function generateCVV(): string
    {
        return str_pad((string) rand(0, 999), 3, '0', STR_PAD_LEFT);
    }

    /**
     * Calculate expiry date (3 years from now)
     */
    protected function calculateExpiryDate(): array
    {
        $expiryDate = now()->addYears(3);

        return [
            'month' => $expiryDate->format('m'),
            'year' => $expiryDate->format('Y'),
        ];
    }

    /**
     * Generate unique transaction ID
     */
    protected function generateTransactionId(): string
    {
        return 'TXN' . strtoupper(Str::random(12)) . now()->timestamp;
    }

    /**
     * Generate authorization code
     */
    protected function generateAuthorizationCode(): string
    {
        return strtoupper(Str::random(6));
    }

    /**
     * Determine decline reason
     */
    protected function determineDeclineReason(Card $card, float $amount): string
    {
        if (!$card->is_active) {
            return 'Card is not active';
        }

        if (($card->daily_spent + $amount) > $card->daily_limit) {
            return 'Daily limit exceeded';
        }

        if (($card->monthly_spent + $amount) > $card->monthly_limit) {
            return 'Monthly limit exceeded';
        }

        if ($card->account->available_balance < $amount) {
            return 'Insufficient funds';
        }

        return 'Transaction declined';
    }
}
