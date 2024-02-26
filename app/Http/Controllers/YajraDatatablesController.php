<?php

namespace App\Http\Controllers;

use App\Repositories\CashierRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use Yajra\DataTables\Facades\DataTables;

class YajraDatatablesController extends Controller
{
    protected $product, $cashier, $category;

    public function __construct(ProductRepository $productRepository, CashierRepository $cashierRepository, CategoryRepository $categoryRepository)
    {
        $this->product = $productRepository;
        $this->cashier = $cashierRepository;
        $this->category = $categoryRepository;
    }

    public function master_product()
    {
        $products = $this->product->getAllProducts();

        return DataTables::of($products)
        ->addColumn('index', function ($model) use ($products) {
            return $products->search($model) + 1;
        })
        ->addColumn('product', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-product.product-column', compact('model'))->render();
        })
        ->addColumn('category', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-product.category-column', compact('model'))->render();
        })
        ->addColumn('stock', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-product.stock-column', compact('model'))->render();
        })
        ->addColumn('price', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-product.price-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-product.status-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-product.action-column', compact('model'))->render();
        })
        ->rawColumns(['index', 'product', 'stock', 'price', 'status', 'action'])
        ->make(true);
    }

    public function master_cashier()
    {
        $cashiers = $this->cashier->getAllCashiers();

        return DataTables::of($cashiers)
        ->addColumn('index', function ($model) use ($cashiers) {
            return $cashiers->search($model) + 1;
        })
        ->addColumn('name', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-cashier.name-column', compact('model'))->render();
        })
        ->addColumn('email', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-cashier.email-column', compact('model'))->render();
        })
        ->addColumn('phone', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-cashier.phone-column', compact('model'))->render();
        })
        ->addColumn('place_date_of_birth', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-cashier.place-date-of-birth-column', compact('model'))->render();
        })
        ->addColumn('gender', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-cashier.gender-column', compact('model'))->render();
        })
        ->addColumn('address', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-cashier.address-column', compact('model'))->render();
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-cashier.created-at-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-cashier.status-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-cashier.action-column', compact('model'))->render();
        })
        ->rawColumns(['index', 'name', 'email', 'phone', 'place_date_of_birth', 'gender', 'address', 'registered_at','status', 'action'])
        ->make(true);
    }

    public function master_category()
    {
        $categories = $this->category->getAllCategories();

        return DataTables::of($categories)
        ->addColumn('index', function ($model) use ($categories) {
            return $categories->search($model) + 1;
        })
        ->addColumn('name', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-category.name-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-category.action-column', compact('model'))->render();
        })
        ->rawColumns(['index', 'name', 'action'])
        ->make(true);
    }

    public function inventory_product()
    {
        $products = $this->product->getAllProducts();

        return DataTables::of($products)
        ->addColumn('index', function ($model) use ($products) {
            return $products->search($model) + 1;
        })
        ->addColumn('product', function ($model) {
            return view('components.data-ajax.yajra-column.data-inventory-product.product-column', compact('model'))->render();
        })
        ->addColumn('category', function ($model) {
            return view('components.data-ajax.yajra-column.data-inventory-product.category-column', compact('model'))->render();
        })
        ->addColumn('stock', function ($model) {
            return view('components.data-ajax.yajra-column.data-inventory-product.stock-column', compact('model'))->render();
        })
        ->addColumn('price', function ($model) {
            return view('components.data-ajax.yajra-column.data-inventory-product.price-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.data-ajax.yajra-column.data-inventory-product.status-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-inventory-product.action-column', compact('model'))->render();
        })
        ->rawColumns(['index', 'product', 'stock', 'price', 'status', 'action'])
        ->make(true);
    }
}
