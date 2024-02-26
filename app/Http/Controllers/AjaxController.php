<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\PriceRepository;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    protected $price, $category, $setting;

    public function __construct(PriceRepository $priceRepository, CategoryRepository $categoryRepository, SettingRepository $settingRepository)
    {
        $this->price = $priceRepository;
        $this->category = $categoryRepository;
        $this->setting = $settingRepository;
    }

    public function product_edit(Product $product)
    {
        return view('components.data-ajax.pages.modal.data-master-product', [
            'product' => $product,
            'prices' => $this->price->getAllPrices(),
            'categories' => $this->category->getAllCategories()
        ]);
    }

    public function inventory_product_edit(Product $product)
    {
        return view('components.data-ajax.pages.modal.data-inventory-product', compact('product'));
    }

    public function category_edit(Category $category)
    {
        return view('components.data-ajax.pages.modal.data-master-category', compact('category'));
    }

    public function deactivate_profile_update()
    {
        return $this->setting->deactivateCashierProfile();
    }
}
