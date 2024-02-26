<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\PriceRepository;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    protected $price, $category;

    public function __construct(PriceRepository $priceRepository, CategoryRepository $categoryRepository)
    {
        $this->price = $priceRepository;
        $this->category = $categoryRepository;
    }

    public function product_edit(Product $product)
    {
        return view('components.data-ajax.pages.modal.data-master-product', [
            'product' => $product,
            'prices' => $this->price->getAllPrices(),
            'categories' => $this->category->getAllCategories()
        ]);
    }

    public function category_edit(Category $category)
    {
        return view('components.data-ajax.pages.modal.data-master-category', compact('category'));
    }
}
