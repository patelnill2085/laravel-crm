<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@crm.com',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ]);

        // Manager User
        User::create([
            'name'     => 'Manager User',
            'email'    => 'manager@crm.com',
            'password' => Hash::make('password123'),
            'role'     => 'manager',
        ]);

        // Staff User
        User::create([
            'name'     => 'Staff User',
            'email'    => 'staff@crm.com',
            'password' => Hash::make('password123'),
            'role'     => 'staff',
        ]);
    }
}