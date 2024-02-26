<?php

namespace App\Repositories;

use App\Repositories\ProductRepository;

class InventoryRepository
{
    protected $product;

    public function __construct(ProductRepository $productRepository)
    {
        $this->product = $productRepository;
    }

    public function updateStockProduct($data, $id)
    {
        return $this->product->getProduct($id)->update([
            'stock' => $data['stock']
        ]);
    }
}