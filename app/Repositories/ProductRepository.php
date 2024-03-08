<?php

namespace App\Repositories;

use Ramsey\Uuid\Uuid;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository
{
    
    public function getAllProducts()
    {
        return Product::all();
    }

    public function getAllProductsTrashed()
    {
        return Product::onlyTrashed()->get();
    }

    public function getAllProductsWithTrashed()
    {
        return Product::withTrashed()->get();
    }

    public function getProduct($id)
    {
        return Product::withTrashed()->find($id);
    }

    public function storeProduct($data)
    {
        $product_id = Uuid::uuid4()->toString();

        DB::transaction(function () use ($data, $product_id) {
            $product = Product::create([
                'id' => $product_id,
                'price_id' => $data['price_id'],
                'category_id' => $data['category_id'],
                'temperature_id' => $data['temperature_id'],
                'topping_id' => $data['topping_id'],
                'size_id' => $data['size_id'],
                'name' => $data['name'],
                'stock' => $data['stock']
            ]);

            if ($data->hasFile('product_image')) {
                $media = $product->addMediaFromRequest('product_image')->withResponsiveImages()->toMediaCollection('product_images');
    
                $media->update([
                    'model_id' => $product_id,
                    'model_type' => Product::class,
                ]);
            }
        });

        return true;
    }

    public function updateProduct($data, $product)
    {
        DB::transaction(function () use ($data, $product) {
            self::getProduct($product->id)->update([
                'price_id' => $data['price_id'],
                'category_id' => $data['category_id'],
                'temperature_id' => $data['temperature_id'],
                'topping_id' => $data['topping_id'],
                'size_id' => $data['size_id'],
                'name' => $data['name'],
                'stock' => $data['stock']
            ]);

            if ($data->hasFile('product_image')) {
                $product->clearMediaCollection('product_images');

                $media = $product->addMediaFromRequest('product_image')->withResponsiveImages()->toMediaCollection('product_images');
    
                $media->update([
                    'model_id' => $product->id,
                    'model_type' => Product::class,
                ]);
            }
        });

        return true;
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

    public function filterProduct($filter)
    {
        $query = Product::select('products.*');

        if ($filter['price_id'] != null) {
            $query->where('price_id', $filter['price_id']);
        }

        if ($filter['temperature_id']) {
            $query->where('temperature_id', $filter['temperature_id']);
        }

        if ($filter['size_id']) {
            $query->where('size_id', $filter['size_id']);
        }

        if ($filter['topping_id']) {
            $query->where('topping_id', $filter['topping_id']);
        }

        return $query->get();
    }

    public function restoreProduct($id)
    {
        return Product::withTrashed()->find($id)->restore();
    }

    public function permanentlyDeleteProduct($id)
    {
        return Product::withTrashed()->find($id)->forceDelete();
    }
}