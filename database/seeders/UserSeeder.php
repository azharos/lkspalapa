<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'username'      => 'admin1',
                'password'      => 'admin1',
                'role'          => 'admin'
            ],
            [
                'username'      => 'admin2',
                'password'      => 'admin2',
                'role'          => 'admin'
            ],
            [
                'username'      => 'user1',
                'password'      => 'user1',
                'role'          => 'user'
            ],
        ];

        foreach ($data as $item) {
            User::create([
                'name'      => $item['username'],
                'username'  => $item['username'],
                'email'     => $item['username'] . '@gmail.com',
                'password'  => bcrypt($item['password']),
                'role'      => $item['role'],
            ]);
        }
    }
}
