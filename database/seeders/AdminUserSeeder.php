<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Super Admin
        $superAdmin = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'name' => 'Super Admin',
            'email' => 'admin@acrevis.ch',
            'password' => Hash::make('password'),
            'phone' => '+41 71 227 27 27',
            'country' => 'Suisse',
            'city' => 'St-Gall',
            'preferred_language' => 'fr',
            'account_type' => 'individual',
            'customer_segment' => 'privat',
            'is_active' => true,
        ]);
        $superAdmin->assignRole('Super Admin');

        // Create Admin
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'name' => 'Admin User',
            'email' => 'admin.user@acrevis.ch',
            'password' => Hash::make('password'),
            'phone' => '+41 71 227 27 28',
            'country' => 'Suisse',
            'city' => 'St-Gall',
            'preferred_language' => 'fr',
            'account_type' => 'individual',
            'customer_segment' => 'privat',
            'is_active' => true,
        ]);
        $admin->assignRole('Admin');

        // Create Credit Manager
        $creditManager = User::create([
            'first_name' => 'Jean',
            'last_name' => 'Dupont',
            'name' => 'Jean Dupont',
            'email' => 'credit.manager@acrevis.ch',
            'password' => Hash::make('password'),
            'phone' => '+41 71 227 27 29',
            'country' => 'Suisse',
            'city' => 'St-Gall',
            'preferred_language' => 'fr',
            'account_type' => 'individual',
            'customer_segment' => 'privat',
            'is_active' => true,
        ]);
        $creditManager->assignRole('Credit Manager');

        // Create Content Manager
        $contentManager = User::create([
            'first_name' => 'Marie',
            'last_name' => 'Martin',
            'name' => 'Marie Martin',
            'email' => 'content.manager@acrevis.ch',
            'password' => Hash::make('password'),
            'phone' => '+41 71 227 27 30',
            'country' => 'Suisse',
            'city' => 'St-Gall',
            'preferred_language' => 'fr',
            'account_type' => 'individual',
            'customer_segment' => 'privat',
            'is_active' => true,
        ]);
        $contentManager->assignRole('Content Manager');

        $this->command->info('Admin users created successfully!');
        $this->command->info('');
        $this->command->info('Login credentials:');
        $this->command->info('==================');
        $this->command->info('Super Admin:');
        $this->command->info('  Email: admin@acrevis.ch');
        $this->command->info('  Password: password');
        $this->command->info('');
        $this->command->info('Admin:');
        $this->command->info('  Email: admin.user@acrevis.ch');
        $this->command->info('  Password: password');
        $this->command->info('');
        $this->command->info('Credit Manager:');
        $this->command->info('  Email: credit.manager@acrevis.ch');
        $this->command->info('  Password: password');
        $this->command->info('');
        $this->command->info('Content Manager:');
        $this->command->info('  Email: content.manager@acrevis.ch');
        $this->command->info('  Password: password');
    }
}
