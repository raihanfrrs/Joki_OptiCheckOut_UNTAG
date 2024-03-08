<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\CashierRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;

class TrashController extends Controller
{
    protected $category, $cashier, $product;

    public function __construct(CategoryRepository $categoryRepository, CashierRepository $cashierRepository, ProductRepository $productRepository)
    {
        $this->category = $categoryRepository;
        $this->cashier = $cashierRepository;
        $this->product = $productRepository;
    }

    public function trash_index()
    {
        return view('pages.admin.trash.index');
    }

    public function trash_cashier_update($cashier)
    {
        if ($this->cashier->restoreCashier($cashier)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Kasir Dipulihkan!'
            ]);
        }
    }

    public function trash_cashier_destroy($cashier)
    {
        if ($this->cashier->permanentlyDeleteCashier($cashier)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Kasir Dihapus Permanen!'
            ]);
        }
    }

    public function trash_category_update($category)
    {
        if ($this->category->restoreCategory($category)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Kategori Dipulihkan!'
            ]);
        }
    }

    public function trash_category_destroy($category)
    {
        if ($this->category->permanentlyDeleteCategory($category)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Kategori Dihapus Permanen!'
            ]);
        }
    }

    public function trash_product_update($product)
    {
        if ($this->product->restoreProduct($product)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Produk Dipulihkan!'
            ]);
        }
    }

    public function trash_product_destroy($product)
    {
        if ($this->product->permanentlyDeleteProduct($product)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Produk Dihapus Permanen!'
            ]);
        }
    }
}
