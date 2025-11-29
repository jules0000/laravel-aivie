<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create permissions
        Permission::create(['name' => 'submit diary entry']);
        Permission::create(['name' => 'view own entries']);
        Permission::create(['name' => 'admin access']);

        // Create roles
        $userRole = Role::create(['name' => 'user']);
        $adminRole = Role::create(['name' => 'admin']);

        // Assign permissions to roles
        $userRole->givePermissionTo(['submit diary entry', 'view own entries']);
        $adminRole->givePermissionTo(['submit diary entry', 'view own entries', 'admin access']);

        // Create default admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $admin->assignRole('admin');

        // Create a test user
        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $user->assignRole('user');
    }
}

