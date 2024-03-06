<?php

namespace Database\Seeders;

use App\Models\Category;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'Minuman',
            ]
        ];

        foreach ($categories as $key => $category) {
            Category::create($category);
        }
    }
}
