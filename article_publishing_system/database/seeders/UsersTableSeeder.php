<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'user_name' => 'Admin',
            'user_email' => 'admin@example.com',
            'user_password' => Hash::make('password'),
            'user_role' => 1,
            'user_bio' => 'Admin user bio',
        ]);
    }
}

