<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        activity()->disableLogging();

        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            CashierSeeder::class,
            RatingSeeder::class,
            PriceSeeder::class,
            ProductSeeder::class,
            CategorySeeder::class,
            TemperatureSeeder::class,
            ToppingSeeder::class,
            SizeSeeder::class
        ]);

        activity()->enableLogging();
    }
}
