<?php

namespace App\Repositories;

use App\Models\Product;
use Ramsey\Uuid\Uuid;

class ProductRepository
{
    
    public function getAllProducts()
    {
        return Product::all();
    }

    public function getProduct($id)
    {
        return Product::find($id);
    }

    public function storeProduct($data)
    {
        return Product::create([
            'id' => Uuid::uuid4()->toString(),
            'price_id' => $data['price_id'],
            'name' => $data['name'],
            'stock' => $data['stock']
        ]);
    }

    public function updateProduct($data, $product)
    {
        return self::getProduct($product)->update([
            'price_id' => $data['price_id'],
            'name' => $data['name'],
            'stock' => $data['stock']
        ]);
    }

    public function deleteProduct($id)
    {
        if (self::getProduct($id)->trashed()) {
            return self::getProduct($id)->forceDelete();
        } else {
            return self::getProduct($id)->delete();
        }
    }

    public function updateProductStatus($id, $status)
    {
        return self::getProduct($id)->update([
            'status' => $status == 'active' ? 'inactive' : 'active'
        ]);
    }
}