<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
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

            // Credit requests management
            'view credit requests',
            'create credit requests',
            'edit credit requests',
            'delete credit requests',
            'approve credit requests',
            'reject credit requests',
            'assign credit requests',

            // Newsletter management
            'view newsletter subscribers',
            'delete newsletter subscribers',
            'export newsletter subscribers',

            // Content management
            'view articles',
            'create articles',
            'edit articles',
            'delete articles',
            'publish articles',

            'view services',
            'create services',
            'edit services',
            'delete services',

            'view pages',
            'create pages',
            'edit pages',
            'delete pages',

            // Agency management
            'view agencies',
            'create agencies',
            'edit agencies',
            'delete agencies',

            // Contact submissions
            'view contacts',
            'delete contacts',

            // Media management
            'view media',
            'upload media',
            'delete media',

            // Dashboard access
            'access dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions

        // 1. Super Admin - All permissions
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // 2. Admin - Most permissions except user deletion
        $admin = Role::create(['name' => 'Admin']);
        $admin->givePermissionTo([
            'view users',
            'create users',
            'edit users',
            'view credit requests',
            'create credit requests',
            'edit credit requests',
            'delete credit requests',
            'approve credit requests',
            'reject credit requests',
            'assign credit requests',
            'view newsletter subscribers',
            'delete newsletter subscribers',
            'export newsletter subscribers',
            'view articles',
            'create articles',
            'edit articles',
            'delete articles',
            'publish articles',
            'view services',
            'create services',
            'edit services',
            'delete services',
            'view pages',
            'create pages',
            'edit pages',
            'delete pages',
            'view agencies',
            'create agencies',
            'edit agencies',
            'delete agencies',
            'view contacts',
            'delete contacts',
            'view media',
            'upload media',
            'delete media',
            'access dashboard',
        ]);

        // 3. Credit Manager - Credit and client focused
        $creditManager = Role::create(['name' => 'Credit Manager']);
        $creditManager->givePermissionTo([
            'view users',
            'view credit requests',
            'edit credit requests',
            'approve credit requests',
            'reject credit requests',
            'assign credit requests',
            'view contacts',
            'access dashboard',
        ]);

        // 4. Content Manager - Content focused
        $contentManager = Role::create(['name' => 'Content Manager']);
        $contentManager->givePermissionTo([
            'view articles',
            'create articles',
            'edit articles',
            'publish articles',
            'view services',
            'create services',
            'edit services',
            'view pages',
            'create pages',
            'edit pages',
            'view agencies',
            'create agencies',
            'edit agencies',
            'view newsletter subscribers',
            'export newsletter subscribers',
            'view media',
            'upload media',
            'access dashboard',
        ]);

        // 5. Customer - Basic client permissions
        $customer = Role::create(['name' => 'Customer']);
        $customer->givePermissionTo([
            'create credit requests',
        ]);

        $this->command->info('Roles and permissions created successfully!');
        $this->command->info('');
        $this->command->info('Roles created:');
        $this->command->info('1. Super Admin - Full access');
        $this->command->info('2. Admin - Most permissions');
        $this->command->info('3. Credit Manager - Credit and client management');
        $this->command->info('4. Content Manager - Content and marketing management');
        $this->command->info('5. Customer - Basic client access');
    }
}
