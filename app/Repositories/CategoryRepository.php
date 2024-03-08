<?php

namespace App\Repositories;

use App\Models\Category;
use Ramsey\Uuid\Uuid;

class CategoryRepository
{
    public function getAllCategories()
    {
        return Category::orderBy('name')->get();
    }

    public function getAllCategoriesTrashed()
    {
        return Category::onlyTrashed()->orderBy('name')->get();
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

    public function restoreCategory($id)
    {
        return Category::withTrashed()->find($id)->restore();
    }

    public function permanentlyDeleteCategory($id)
    {
        return Category::withTrashed()->find($id)->forceDelete();
    }
}