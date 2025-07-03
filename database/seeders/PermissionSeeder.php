<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            'masters',
            'operations',
            'members',
            'reports',
            'company-settings',
            'accounts'
        ];


        foreach ($modules as $module) {
            Permission::firstOrCreate(['name' => "{$module}"]);
        }

        // Get or create the super admin role
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);

        // Assign all permissions to super admin
        $allPermissions = Permission::all();
        $superAdminRole->syncPermissions($allPermissions);


    }
}
