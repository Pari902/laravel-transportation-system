<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User 2',
            'email' => 'admin2@transportation.com', // Admin email
            'password' => Hash::make('admin2TR#25'), // Admin password
            'role' => 'admin', // Ensure the role is 'admin'
        ]);
    }
}

