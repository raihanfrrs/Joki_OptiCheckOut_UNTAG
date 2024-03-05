<?php

namespace Database\Seeders;

use App\Models\Size;
use Ramsey\Uuid\Uuid;
use App\Models\Rating;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = [
            'Gelas Besar',
            'Gelas Kecil'
        ];

        foreach (Rating::whereIn('rating', [2, 4])->orderBy('rating')->get() as $key => $rating) {
            Size::create([
                'id' => Uuid::uuid4()->toString(),
                'rating_id' => $rating->id,
                'name' => $sizes[$key]
            ]);
        }
    }
}
