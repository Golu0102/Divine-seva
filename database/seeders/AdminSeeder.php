<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'username' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin@123'),
            ]
        );
    }
}

