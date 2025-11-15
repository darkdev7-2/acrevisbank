<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnableTwoFactorForAllUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Activating 2FA for all users...');

        // Enable 2FA for all existing users
        User::query()->update([
            'two_factor_enabled' => true,
        ]);

        $count = User::count();

        $this->command->info("2FA enabled for {$count} user(s).");
        $this->command->warn('⚠️  IMPORTANT: All users will be required to verify via email on next login.');
    }
}
