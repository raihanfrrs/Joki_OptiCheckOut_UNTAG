<?php

namespace Database\Seeders;

use App\Models\Price;
use Ramsey\Uuid\Uuid;
use App\Models\Rating;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prices = [
            16000,
            15000,
            14000,
            12000
        ];

        foreach (Rating::orderBy('rating')->get() as $key => $rating) {
            Price::create([
                'id' => Uuid::uuid4()->toString(),
                'rating_id' => $rating->id,
                'price' => $prices[$key]
            ]);
        }
    }
}
