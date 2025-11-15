<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class EncryptExistingData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:encrypt {--force : Force the operation without confirmation}';

    /**
     * The console description of the command.
     *
     * @var string
     */
    protected $description = 'Encrypt existing sensitive data in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->option('force')) {
            if (!$this->confirm('This will encrypt all sensitive data in the database. Continue?')) {
                $this->info('Operation cancelled.');
                return 0;
            }
        }

        $this->info('Starting data encryption...');
        $this->newLine();

        // Encrypt User data
        $this->encryptUserData();

        $this->newLine();
        $this->info('✅ Data encryption completed successfully!');

        return 0;
    }

    /**
     * Encrypt User data
     */
    protected function encryptUserData()
    {
        $this->info('Encrypting User data...');

        $users = User::all();
        $encryptedCount = 0;
        $skippedCount = 0;

        $encryptedAttributes = [
            'tax_identification_number',
            'id_document_number',
            'phone',
            'whatsapp',
            'address',
            'street',
            'postal_code',
            'birth_place',
            'employer',
        ];

        $progressBar = $this->output->createProgressBar($users->count());
        $progressBar->start();

        foreach ($users as $user) {
            $needsUpdate = false;

            foreach ($encryptedAttributes as $attribute) {
                $value = $user->getRawAttribute($attribute);

                // Skip if empty or already encrypted
                if (empty($value) || $this->isEncrypted($value)) {
                    continue;
                }

                // Encrypt the value
                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        $attribute => Crypt::encryptString($value)
                    ]);

                $needsUpdate = true;
            }

            if ($needsUpdate) {
                $encryptedCount++;
            } else {
                $skippedCount++;
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine();

        $this->info("✓ Encrypted: {$encryptedCount} users");
        $this->info("⊘ Skipped: {$skippedCount} users (already encrypted or no data)");
    }

    /**
     * Check if a value is already encrypted
     */
    protected function isEncrypted($value): bool
    {
        try {
            Crypt::decryptString($value);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
