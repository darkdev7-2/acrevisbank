<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the test user (created in DatabaseSeeder)
        $testUser = User::where('email', 'test@example.com')->first();

        if (!$testUser) {
            $this->command->warn('Test user not found. Creating one...');
            $testUser = User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
            $testUser->assignRole('Customer');
        }

        // Create Compte Courant (Current Account)
        $currentAccount = Account::create([
            'user_id' => $testUser->id,
            'account_number' => '01-123456-7',
            'iban' => 'CH9300762011623852957',
            'account_type' => 'Compte courant',
            'currency' => 'CHF',
            'balance' => 15842.50,
            'available_balance' => 15842.50,
            'is_active' => true,
            'opened_at' => Carbon::now()->subYears(2),
        ]);

        // Create Compte d'Épargne (Savings Account)
        $savingsAccount = Account::create([
            'user_id' => $testUser->id,
            'account_number' => '01-123456-8',
            'iban' => 'CH4508390020006041652',
            'account_type' => 'Compte d\'épargne',
            'currency' => 'CHF',
            'balance' => 42500.00,
            'available_balance' => 42500.00,
            'is_active' => true,
            'opened_at' => Carbon::now()->subYears(3),
        ]);

        // Create realistic transactions for current account
        $this->createTransactions($currentAccount);
        $this->createTransactions($savingsAccount, 'savings');

        $this->command->info('✅ Created accounts for test@example.com:');
        $this->command->info('   - Compte courant: ' . $currentAccount->iban);
        $this->command->info('   - Compte d\'épargne: ' . $savingsAccount->iban);
    }

    private function createTransactions(Account $account, $type = 'current')
    {
        $balance = $type === 'current' ? 10000.00 : 40000.00;

        $transactions = $type === 'current' ? [
            // Recent transactions (last 30 days)
            [
                'type' => 'credit',
                'category' => 'salary',
                'amount' => 6500.00,
                'description' => 'Salaire mensuel',
                'recipient_name' => null,
                'recipient_iban' => null,
                'days_ago' => 5,
            ],
            [
                'type' => 'debit',
                'category' => 'rent',
                'amount' => 1850.00,
                'description' => 'Loyer appartement',
                'recipient_name' => 'Immobilière SA',
                'recipient_iban' => 'CH5604835012345678009',
                'days_ago' => 3,
            ],
            [
                'type' => 'debit',
                'category' => 'groceries',
                'amount' => 142.35,
                'description' => 'Migros Supermarché',
                'recipient_name' => 'Migros',
                'recipient_iban' => null,
                'days_ago' => 2,
            ],
            [
                'type' => 'debit',
                'category' => 'utilities',
                'amount' => 95.50,
                'description' => 'Assurance maladie',
                'recipient_name' => 'CSS Assurance',
                'recipient_iban' => 'CH7609000000301234567',
                'days_ago' => 7,
            ],
            [
                'type' => 'debit',
                'category' => 'shopping',
                'amount' => 67.80,
                'description' => 'Manor St.Gallen',
                'recipient_name' => null,
                'recipient_iban' => null,
                'days_ago' => 10,
            ],
            [
                'type' => 'debit',
                'category' => 'transport',
                'amount' => 89.00,
                'description' => 'CFF Abonnement',
                'recipient_name' => 'CFF',
                'recipient_iban' => 'CH3900700110408967241',
                'days_ago' => 15,
            ],
            [
                'type' => 'credit',
                'category' => 'transfer',
                'amount' => 250.00,
                'description' => 'Remboursement ami',
                'recipient_name' => null,
                'recipient_iban' => null,
                'days_ago' => 12,
            ],
            [
                'type' => 'debit',
                'category' => 'leisure',
                'amount' => 125.00,
                'description' => 'Restaurant La Pergola',
                'recipient_name' => null,
                'recipient_iban' => null,
                'days_ago' => 18,
            ],
        ] : [
            // Savings account transactions
            [
                'type' => 'credit',
                'category' => 'transfer',
                'amount' => 2500.00,
                'description' => 'Épargne mensuelle',
                'recipient_name' => null,
                'recipient_iban' => null,
                'days_ago' => 5,
            ],
            [
                'type' => 'credit',
                'category' => 'interest',
                'amount' => 42.50,
                'description' => 'Intérêts trimestriels',
                'recipient_name' => null,
                'recipient_iban' => null,
                'days_ago' => 30,
            ],
        ];

        foreach ($transactions as $trans) {
            if ($trans['type'] === 'debit') {
                $balance -= $trans['amount'];
            } else {
                $balance += $trans['amount'];
            }

            Transaction::create([
                'account_id' => $account->id,
                'type' => $trans['type'],
                'category' => $trans['category'],
                'amount' => $trans['amount'],
                'currency' => 'CHF',
                'balance_after' => $balance,
                'recipient_name' => $trans['recipient_name'],
                'recipient_iban' => $trans['recipient_iban'],
                'description' => $trans['description'],
                'reference' => 'REF' . rand(100000, 999999),
                'status' => 'completed',
                'transaction_date' => Carbon::now()->subDays($trans['days_ago']),
            ]);
        }

        // Update account balance to match last transaction
        $account->update(['balance' => $balance, 'available_balance' => $balance]);
    }
}
