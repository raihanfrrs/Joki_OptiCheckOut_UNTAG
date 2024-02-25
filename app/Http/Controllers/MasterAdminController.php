<?php

namespace App\Http\Controllers;

use App\Http\Requests\CashierStoreRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Repositories\CashierRepository;
use Illuminate\Http\Request;
use App\Repositories\PriceRepository;
use App\Repositories\ProductRepository;

class MasterAdminController extends Controller
{
    protected $product, $price, $cashier;

    public function __construct(PriceRepository $priceRepository, ProductRepository $productRepository, CashierRepository $cashierRepository)
    {
        $this->price = $priceRepository;
        $this->product = $productRepository;
        $this->cashier = $cashierRepository;
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
            if ($this->cashier->storeCashier($request)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Cashier Added!'
                ]);
            }
    }
    
    public function master_product_index()
    {
        $prices = $this->price->getAllPrices();

        return view('pages.admin.master.product.index', compact('prices'));
    }

    public function master_product_store(ProductStoreRequest $request)
    {
        try {
            if ($this->product->storeProduct($request->all())) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Product Added!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function master_product_update(ProductUpdateRequest $request, Product $product)
    {
        try {
            if ($this->product->updateProduct($request->all(), $product->id)) {
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
}
