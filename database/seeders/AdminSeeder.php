<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Ramsey\Uuid\Uuid;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('level', 'admin')->get();
        $faker = Faker::create();

        foreach ($users as $key => $admin) {
            Admin::create([
                'id' => Uuid::uuid4()->toString(),
                'user_id' => $admin->id,
                'first_name' => 'Admin',
                'last_name' => 'Pusat',
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'pob' => 'Blitar',
                'dob' => now(),
                'gender' => 'male',
                'address' => 'Jl. Arief Rahman Hakim No.100, Klampis Ngasem, Kec. Sukolilo, Surabaya, Jawa Timur 60117'
            ]);
        }
    }
}
