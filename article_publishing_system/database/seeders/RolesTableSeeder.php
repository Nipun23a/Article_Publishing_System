<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run():void
    {
        UserRole::create(['role_name' => 'admin']);
        UserRole::create(['role_name' => 'user']);
    }
}
