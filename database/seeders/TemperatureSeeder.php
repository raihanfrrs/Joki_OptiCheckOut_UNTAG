<?php

namespace Database\Seeders;

use Ramsey\Uuid\Uuid;
use App\Models\Rating;
use App\Models\Temperature;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TemperatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $temperatures = [
            'Panas',
            'Dingin'
        ];

        foreach (Rating::whereIn('rating', [2, 4])->orderBy('rating')->get() as $key => $rating) {
            Temperature::create([
                'id' => Uuid::uuid4()->toString(),
                'rating_id' => $rating->id,
                'name' => $temperatures[$key]
            ]);
        }
    }
}
