<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\PriceRepository;
use App\Repositories\SettingRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TemporaryTransactionRepository;

class AjaxController extends Controller
{
    protected $price, $category, $setting, $temporary;

    public function __construct(PriceRepository $priceRepository, CategoryRepository $categoryRepository, SettingRepository $settingRepository, TemporaryTransactionRepository $temporaryTransactionRepository)
    {
        $this->price = $priceRepository;
        $this->category = $categoryRepository;
        $this->setting = $settingRepository;
        $this->temporary = $temporaryTransactionRepository;
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

    public function add_to_cart(Request $request)
    {
        if ($this->temporary->checkCartIfProductExist($request)) {
            return false;
        }

        return $this->temporary->storeToCart($request);
    }

    public function shopping_cart_count()
    {
        return $this->temporary->shoppingCartCount();
    }

    public function shopping_cart_product_delete(Request $request)
    {
        return $this->temporary->deleteShoppingCartByProductId($request);
    }

    public function shopping_cart_product_update_quantity(Request $request)
    {
        return $this->temporary->updateQuantityShoppingCartByProductId($request);
    }

    public function shopping_cart_product_update_temperature(Request $request)
    {
        return $this->temporary->updateTemperatureShoppingCartByProductId($request);
    }

    public function shopping_cart_product_update_size(Request $request)
    {
        return $this->temporary->updateSizeShoppingCartByProductId($request);
    }

    public function shopping_cart_product_update_topping(Request $request)
    {
        return $this->temporary->updateToppingShoppingCartByProductId($request);
    }
}
