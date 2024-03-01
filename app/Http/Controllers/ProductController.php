<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;

class ProductController extends Controller
{
    protected $product, $category;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->product = $productRepository;
        $this->category = $categoryRepository;
    }
    
    public function product_index($category)
    {   
        $categories = $this->category->getAllCategories();

        if ($category == 'all') {
            $products = $this->product->getAllProducts()->where('category_id', $categories->first()->id)->where('status', 'active');
        } else {
            $products = $this->product->getAllProducts()->where('category_id', $category)->where('status', 'active');
        }

        $product_category = $category == 'all' ? $categories->first()->id : $this->category->getCategory($category)->id;

        return view('pages.cashier.products.index', compact('products', 'categories', 'product_category'));
    }
}
