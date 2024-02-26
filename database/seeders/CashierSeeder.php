<?php

namespace Database\Seeders;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Cashier;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CashierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('level', 'cashier')->get();
        $faker = Faker::create();

        foreach ($users as $key => $cashier) {
            Cashier::create([
                'id' => Uuid::uuid4()->toString(),
                'user_id' => $cashier->id,
                'first_name' => 'Cashier',
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
