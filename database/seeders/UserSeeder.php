<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'id' => Uuid::uuid4()->toString(),
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'level' => 'admin'
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'username' => 'cashier',
                'password' => bcrypt('cashier'),
                'level' => 'cashier'
            ]
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
