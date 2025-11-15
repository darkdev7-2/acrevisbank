<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User management
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Account management
            'view accounts',
            'create accounts',
            'edit accounts',
            'delete accounts',
            'activate accounts',
            'deactivate accounts',

            // Transaction management
            'view transactions',
            'create transactions',
            'edit transactions',
            'delete transactions',
            'approve transactions',

            // Beneficiary management
            'view beneficiaries',
            'create beneficiaries',
            'edit beneficiaries',
            'delete beneficiaries',

            // Credit request management
            'view credit requests',
            'create credit requests',
            'edit credit requests',
            'delete credit requests',
            'approve credit requests',
            'reject credit requests',

            // Pending registration management
            'view pending registrations',
            'validate registrations',
            'reject registrations',

            // Contact form management
            'view contact forms',
            'delete contact forms',
            'mark contact forms as read',

            // Newsletter management
            'view newsletter subscribers',
            'edit newsletter subscribers',
            'delete newsletter subscribers',
            'export newsletter subscribers',

            // Reports and analytics
            'view reports',
            'export reports',
            'view dashboard',

            // Settings
            'manage settings',
            'view activity log',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create Admin role with all permissions
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->givePermissionTo(Permission::all());

        // Create Customer role with limited permissions
        $customerRole = Role::firstOrCreate(['name' => 'Customer']);
        $customerRole->givePermissionTo([
            'view accounts',
            'view transactions',
            'view beneficiaries',
            'create beneficiaries',
            'edit beneficiaries',
            'delete beneficiaries',
            'create credit requests',
            'view credit requests',
        ]);

        // Create a super admin user if doesn't exist
        $admin = User::firstOrCreate(
            ['email' => 'admin@acrevisbank.ch'],
            [
                'name' => 'Super Admin',
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'validation_status' => 'validated',
                'validated_at' => now(),
            ]
        );
        $admin->assignRole('Admin');

        $this->command->info('Roles and permissions seeded successfully!');
        $this->command->info('Admin user: admin@acrevisbank.ch / password: password');
    }
}
