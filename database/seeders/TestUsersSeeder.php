<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Create 7 test users
        $users = [
            [
                'name' => 'Test User 1',
                'email' => 'test1@example.com',
                'password' => Hash::make('password'),
                'phone' => '08012345671'
            ],
            [
                'name' => 'Test User 2',
                'email' => 'test2@example.com',
                'password' => Hash::make('password'),
                'phone' => '08012345672'
            ],
            [
                'name' => 'Test User 3',
                'email' => 'test3@example.com',
                'password' => Hash::make('password'),
                'phone' => '08012345673'
            ],
            [
                'name' => 'Test User 4',
                'email' => 'test4@example.com',
                'password' => Hash::make('password'),
                'phone' => '08012345674'
            ],
            [
                'name' => 'Test User 5',
                'email' => 'test5@example.com',
                'password' => Hash::make('password'),
                'phone' => '08012345675'
            ],
            [
                'name' => 'Test User 6',
                'email' => 'test6@example.com',
                'password' => Hash::make('password'),
                'phone' => '08012345676'
            ],
            [
                'name' => 'Test User 7',
                'email' => 'test7@example.com',
                'password' => Hash::make('password'),
                'phone' => '08012345677'
            ],
        ];

        // Create users and store them in an array
        foreach ($users as $userData) {
            User::firstOrCreate(['email' => $userData['email']], $userData);
        }
    }
}
