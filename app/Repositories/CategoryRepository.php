<?php

namespace App\Repositories;

use App\Models\Category;
use Ramsey\Uuid\Uuid;

class CategoryRepository
{
    public function getAllCategories()
    {
        return Category::all();
    }

    public function getCategory($id)
    {
        return Category::find($id);
    }

    public function storeCategory($data)
    {
        return Category::create([
            'id' => Uuid::uuid4()->toString(),
            'name' => $data['name']
        ]);
    }

    public function updateCategory($data, $id)
    {
        return self::getCategory($id)->update([
            'name' => $data['name']
        ]);
    }

    public function deleteCategory($id)
    {
        if (self::getCategory($id)->trashed()) {
            return self::getCategory($id)->forceDelete();
        } else {
            return self::getCategory($id)->delete();
        }
    }
}