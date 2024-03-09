<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\AlternativeMatriks;
use App\Repositories\SizeRepository;
use App\Repositories\PriceRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SettingRepository;
use App\Repositories\ToppingRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TemperatureRepository;
use App\Repositories\AlternativeMatrikRepository;
use App\Repositories\CashierRepository;
use App\Repositories\TemporaryTransactionRepository;

class AjaxController extends Controller
{
    protected $price, $category, $setting, $temporary, $alternativeMatrik, $temperature, $size, $topping, $product, $cashier;

    public function __construct(PriceRepository $priceRepository, CategoryRepository $categoryRepository, SettingRepository $settingRepository, TemporaryTransactionRepository $temporaryTransactionRepository, AlternativeMatrikRepository $alternativeMatrik, TemperatureRepository $temperatureRepository, SizeRepository $sizeRepository, ToppingRepository $toppingRepository, ProductRepository $productRepository, CashierRepository $cashierRepository)
    {
        $this->price = $priceRepository;
        $this->category = $categoryRepository;
        $this->setting = $settingRepository;
        $this->temporary = $temporaryTransactionRepository;
        $this->alternativeMatrik = $alternativeMatrik;
        $this->temperature = $temperatureRepository;
        $this->size = $sizeRepository;
        $this->topping = $toppingRepository;
        $this->product = $productRepository;
        $this->cashier = $cashierRepository;
    }

    public function product_edit(Product $product)
    {
        return view('components.data-ajax.pages.modal.data-master-product', [
            'product' => $product,
            'prices' => $this->price->getAllPrices(),
            'categories' => $this->category->getAllCategories(),
            'temperatures' => $this->temperature->getAllTemperatures(),
            'sizes' => $this->size->getAllSizes(),
            'toppings' => $this->topping->getAllToppings()
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

    public function alternative_matrik_add()
    {
        return view('components.data-ajax.pages.modal.data-alternative-matrik', [
            'products' => $this->alternativeMatrik->getAllAlternativeMatriksWhereNotProductAndUser()
        ]);
    }

    public function alternative_matrik_edit(AlternativeMatriks $alternative_matrik)
    {
        return view('components.data-ajax.pages.modal.data-alternative-matrik-edit', [
            'alternative_matrik' => $alternative_matrik,
            'prices' => $this->price->getAllPrices(),
            'temperature' => $this->temperature->getAllTemperatures(),
            'size' => $this->size->getAllSizes(),
            'topping' => $this->topping->getAllToppings()
        ]);
    }

    public function filter_product_index(Request $request)
    {

        $minimun_price = $this->price->getMinimumPrice();
        $maximum_temperature = $this->temperature->getMaximumTemperature();
        $maximum_size = $this->size->getMaximumSize();
        $maximum_topping = $this->topping->getMaximumTopping();

        $filters = $this->product->filterProduct($request);

        $filterProductResult = view('components.data-ajax.pages.page.data-filter-product-result', ['filters' => $filters])->render();
        $filterNormalizationMatrikResult = view('components.data-ajax.pages.page.data-filter-normalization-matrik-result', ['minimun_price' => $minimun_price, 'maximum_temperature' => $maximum_temperature, 'maximum_size' => $maximum_size, 'maximum_topping' => $maximum_topping, 'filters' => $filters])->render();
        $filterRankResult = view('components.data-ajax.pages.page.data-filter-rank-result', ['minimun_price' => $minimun_price, 'maximum_temperature' => $maximum_temperature, 'maximum_size' => $maximum_size, 'maximum_topping' => $maximum_topping, 'filters' => $filters])->render();

        return response()->json([
            'filterProductResult' => $filterProductResult,
            'filterNormalizationMatrikResult' => $filterNormalizationMatrikResult,
            'filterRankResult' => $filterRankResult,
        ]);
    }

    public function alternative_matrik_store(Product $product)
    {
        return $this->alternativeMatrik->storeAlternativeMatrikFromFilter($product);
    }

    public function shopping_cart_store(Product $product)
    {
        if ($this->temporary->checkCartIfProductExist($product) || $this->product->getProduct($product->id)->stock == 0) {
            return false;
        }

        return $this->temporary->storeToCart($product);
    }

    public function trash_count()
    {
        return $this->product->getAllProductsTrashed()->count() + $this->category->getAllCategoriesTrashed()->count() + $this->cashier->getAllCashiersTrashed()->count();
    }

    public function category_trash_count()
    {
        return $this->category->getAllCategoriesTrashed()->count();
    }

    public function product_trash_count()
    {
        return $this->product->getAllProductsTrashed()->count();
    }

    public function cashier_trash_count()
    {
        return $this->cashier->getAllCashiersTrashed()->count();
    }
}
