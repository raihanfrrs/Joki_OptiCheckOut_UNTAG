<?php

namespace Database\Seeders;

use Ramsey\Uuid\Uuid;
use App\Models\Rating;
use App\Models\Topping;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ToppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $toppings = [
            'Pakai',
            'Tidak'
        ];

        foreach (Rating::whereIn('rating', [2, 4])->orderBy('rating')->get() as $key => $rating) {
            Topping::create([
                'id' => Uuid::uuid4()->toString(),
                'rating_id' => $rating->id,
                'name' => $toppings[$key]
            ]);
        }
    }
}
