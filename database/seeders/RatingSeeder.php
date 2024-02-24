<?php

namespace Database\Seeders;

use App\Models\Rating;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ratings = [
            [
                'id' => Uuid::uuid4()->toString(),
                'rating' => 1,
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'rating' => 2,
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'rating' => 3,
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'rating' => 4,
            ]
        ];

        foreach ($ratings as $key => $rating) {
            Rating::create($rating);
        }
    }
}
