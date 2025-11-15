<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed roles and permissions FIRST
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        // 2. Create users BEFORE other seeders that need author_id
        // Create a test user (only if doesn't exist)
        if (!User::where('email', 'test@example.com')->exists()) {
            $testUser = User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
            $testUser->assignRole('Customer');
        }

        // Create admin user (only if doesn't exist)
        if (!User::where('email', 'admin@acrevis.ch')->exists()) {
            $admin = User::factory()->create([
                'name' => 'Admin Acrevis',
                'email' => 'admin@acrevis.ch',
            ]);
            $admin->assignRole('Admin');
        }

        // 3. Now seed content that needs author_id
        $this->call([
            ServicesSeeder::class,
            ArticleSeeder::class,
            AgencySeeder::class,
            CareerSeeder::class,
            AccountSeeder::class,
        ]);

        $this->command->info('');
        $this->command->info('✅ Base de données initialisée avec succès!');
        $this->command->info('');
        $this->command->info('👨‍💼 ADMIN:');
        $this->command->info('   Email: admin@acrevis.ch');
        $this->command->info('   Password: password');
        $this->command->info('');
        $this->command->info('👤 CLIENT TEST:');
        $this->command->info('   Email: test@example.com');
        $this->command->info('   Password: password');
    }
}
