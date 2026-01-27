<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Administrator',
            'employee_id' => 'URS26-ADM00001',
            'username' => 'admin',
            'email' => 'admin@ipcr.system',
            'password' => Hash::make('password'),
            'phone' => '09123456789',
            'role' => 'admin',
            'department_id' => null,
            'designation_id' => null,
            'is_active' => true,
        ]);

        // Assign admin role
        UserRole::create([
            'user_id' => $admin->id,
            'role' => 'admin',
        ]);
    }
}