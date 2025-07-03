<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        $superAdminRole  = Role::firstOrCreate(['name' => 'super-admin']);

        $superAdminUser  = User::firstOrCreate(
            ['email' => 'support@brosistech.com'], 
            ['name' => 'Ramniwas Choudhary- Brosis Technologies', 'password' => bcrypt('12345678')]
        );
        
        $superAdminUser->assignRole($superAdminRole);
    }
}
