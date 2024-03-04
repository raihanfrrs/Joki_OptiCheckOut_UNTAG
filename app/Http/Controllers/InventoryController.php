<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\InventoryRepository;

class InventoryController extends Controller
{

    protected $inventory;

    public function __construct(InventoryRepository $inventoryRepository)
    {
        $this->inventory = $inventoryRepository;
    }

    public function inventory_product_index()
    {
        return view('pages.cashier.inventory.product.index');
    }

    public function inventory_product_update(InventoryProductUpdateRequest $request, Product $product)
    {
        try {
            if ($this->inventory->updateStockProduct($request, $product->id)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Stok Produk Diperbarui!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
