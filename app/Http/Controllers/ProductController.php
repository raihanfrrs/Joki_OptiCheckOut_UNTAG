<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    protected $product;

    public function __construct(ProductRepository $productRepository)
    {
        $this->product = $productRepository;
    }
    
    public function product_index()
    {   
        $products = $this->product->getAllProducts()->where('status', 'active');

        return view('pages.cashier.products.index', compact('products'));
    }
}
