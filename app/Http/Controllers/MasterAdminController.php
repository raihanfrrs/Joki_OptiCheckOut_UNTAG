<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Product;
use App\Models\Category;
use App\Repositories\PriceRepository;
use App\Repositories\CashierRepository;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Http\Requests\CashierStoreRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\CashierUpdateRequest;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Requests\CategoryUpdateRequest;

class MasterAdminController extends Controller
{
    protected $product, $price, $cashier, $category;

    public function __construct(PriceRepository $priceRepository, ProductRepository $productRepository, CashierRepository $cashierRepository, CategoryRepository $categoryRepository)
    {
        $this->price = $priceRepository;
        $this->product = $productRepository;
        $this->cashier = $cashierRepository;
        $this->category = $categoryRepository;
    }

    public function master_cashier_index()
    {
        return view('pages.admin.master.cashier.index');
    }

    public function master_cashier_create()
    {
        return view('pages.admin.master.cashier.add');
    }

    public function master_cashier_store(CashierStoreRequest $request)
    {
        try {
            if ($this->cashier->storeCashier($request)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Cashier Added!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function master_cashier_edit(Cashier $cashier)
    {
        return view('pages.admin.master.cashier.edit', compact('cashier'));
    }

    public function master_cashier_update(CashierUpdateRequest $request, Cashier $cashier)
    {
        try {
            if ($this->cashier->updateCashier($request, $cashier)) {
                return redirect()->route('master.cashier.index')->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Cashier Updated!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    
    public function master_product_index()
    {
        return view('pages.admin.master.product.index', [
            'prices' => $this->price->getAllPrices(),
            'categories' => $this->category->getAllCategories()
        ]);
    }

    public function master_product_store(ProductStoreRequest $request)
    {
        try {
            if ($this->product->storeProduct($request)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Product Added!'
                ]);
            }
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function master_product_update(ProductUpdateRequest $request, Product $product)
    {
        try {
            if ($this->product->updateProduct($request, $product)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Product Updated!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function master_product_destroy(Product $product)
    {
        if ($this->product->deleteProduct($product->id)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Product Deleted!'
            ]);
        }
    }

    public function master_product_update_status(Product $product)
    {
        if ($this->product->updateProductStatus($product->id, $product->status)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Product Status Updated!'
            ]);
        }
    }

    public function master_category_index()
    {
        return view('pages.admin.master.category.index');
    }

    public function master_category_store(CategoryStoreRequest $request)
    {
        try {
            if ($this->category->storeCategory($request)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Category Added!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function master_category_update(CategoryUpdateRequest $request, Category $category)
    {
        try {
            if ($this->category->updateCategory($request, $category->id)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Category Updated!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function master_category_destroy(Category $category)
    {
        if ($this->category->deleteCategory($category->id)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Category Deleted!'
            ]);
        }
    }
}
