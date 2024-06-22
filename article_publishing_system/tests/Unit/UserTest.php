<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;


class UserTest extends TestCase
{
    public function testCreateUser()
    {
        $userData = [
            'user_name' => 'Admin',
            'user_email' => 'admin1@example.com',
            'user_password' => Hash::make('password'),
            'user_role' => 1,
            'user_bio' => 'Admin user bio',
        ];

        $userService = new User();
        $user = $userService->create($userData);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($userData['user_name'], $user->user_name);
        $this->assertEquals($userData['user_email'], $user->user_email);
        $this->assertEquals($userData['user_password'], $user->user_password);
        $this->assertEquals($userData['user_role'], $user->user_role);
        $this->assertEquals($userData['user_bio'], $user->user_bio);
    }
}
