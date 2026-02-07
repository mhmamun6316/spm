<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions with groups
        $permissions = [
            // Dashboard Group
            'dashboard.view',

            // Users Group
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
            'users.approve',

            // Roles Group
            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',

            // Product Categories Group
            'product_categories.view',
            'product_categories.create',
            'product_categories.edit',
            'product_categories.delete',

            // Products Group
            'products.view',
            'products.create',
            'products.edit',
            'products.delete',

            // Hero Sliders Group
            'hero_sliders.view',
            'hero_sliders.create',
            'hero_sliders.edit',
            'hero_sliders.delete',

            // Home Contents Group
            'home_contents.view',
            'home_contents.create',
            'home_contents.edit',
            'home_contents.delete',

            // Page Contents Group
            'page_contents.view',
            'page_contents.create',
            'page_contents.edit',
            'page_contents.delete',

            // Services Group
            'services.view',
            'services.create',
            'services.edit',
            'services.delete',

            // Global Partners Group
            'global_partners.view',
            'global_partners.create',
            'global_partners.edit',
            'global_partners.delete',

            // Satisfied Clients Group
            'satisfied_clients.view',
            'satisfied_clients.create',
            'satisfied_clients.edit',
            'satisfied_clients.delete',

            // Certifications Group
            'certifications.view',
            'certifications.create',
            'certifications.edit',
            'certifications.delete',

            // Contacts Group
            'contacts.view',
            'contacts.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->givePermissionTo(['dashboard.view']);
    }
}
