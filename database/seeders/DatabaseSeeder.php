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
        // Seed roles and permissions first
        $this->call([
            RolesAndPermissionsSeeder::class,
            ServicesSeeder::class,
        ]);

        // Create a test user (only if doesn't exist)
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // Create admin user (only if doesn't exist)
        if (!User::where('email', 'admin@acrevis.ch')->exists()) {
            $admin = User::factory()->create([
                'name' => 'Admin Acrevis',
                'email' => 'admin@acrevis.ch',
            ]);
            $admin->assignRole('admin');
        }
    }
}
