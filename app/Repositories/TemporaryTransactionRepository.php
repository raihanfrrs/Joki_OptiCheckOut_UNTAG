<?php

namespace App\Repositories;

use Ramsey\Uuid\Uuid;
use App\Models\TempTransaction;
use App\Repositories\SizeRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ToppingRepository;
use App\Repositories\TemperatureRepository;

class TemporaryTransactionRepository
{
    protected $product, $temperature, $size, $topping;

    public function __construct(ProductRepository $productRepository, TemperatureRepository $temperatureRepository, SizeRepository $sizeRepository, ToppingRepository $toppingRepository)
    {
        $this->product = $productRepository;
        $this->temperature = $temperatureRepository;
        $this->size = $sizeRepository;
        $this->topping = $toppingRepository;
    }

    public function getCartByCashierId($cashier)
    {
        return TempTransaction::where('cashier_id', $cashier)->get();
    }

    public function checkCartIfProductExist($product)
    {
        return TempTransaction::where('product_id', $this->product->getProduct($product->id)->id)->where('cashier_id', auth()->user()->cashier->id)->first();
    }

    public function storeToCart($product)
    {
        return TempTransaction::create([
            'id' => Uuid::uuid4()->toString(),
            'cashier_id' => auth()->user()->cashier->id,
            'product_id' => $this->product->getProduct($product->id)->id,
            'temperature_id' => $this->temperature->getAllTemperatures()->first()->id,
            'size_id' => $this->size->getAllSizes()->first()->id,
            'topping_id' => $this->topping->getAllToppings()->first()->id,
            'qty' => 1,
            'subtotal' => $this->product->getProduct($product->id)->price->price
        ]);
    }

    public function shoppingCartCount()
    {
        return TempTransaction::where('cashier_id', auth()->user()->cashier->id)->count();
    }
    
    public function deleteShoppingCartByProductId($product)
    {
        return TempTransaction::where('product_id', $this->product->getProduct($product->id)->id)->where('cashier_id', auth()->user()->cashier->id)->delete();
    }

    public function deleteShoppingCartById($id)
    {
        return TempTransaction::where('id', $id)->delete();
    }

    public function updateQuantityShoppingCartByProductId($request)
    {
        return TempTransaction::where('product_id', $this->product->getProduct($request->id)->id)
                                ->where('cashier_id', auth()->user()->cashier->id)
                                ->update([
                                    'qty' => $request->qty,
                                    'subtotal' => $this->product->getProduct($request->id)->price->price * $request->qty
                                ]);
    }

    public function updateTemperatureShoppingCartByProductId($request)
    {
        return TempTransaction::where('id', $request->transaction_id)->update([
            'temperature_id' => $request->temperature_id
        ]);
    }

    public function updateSizeShoppingCartByProductId($request)
    {
        return TempTransaction::where('id', $request->transaction_id)->update([
            'size_id' => $request->size_id
        ]);
    }

    public function updateToppingShoppingCartByProductId($request)
    {
        return TempTransaction::where('id', $request->transaction_id)->update([
            'topping_id' => $request->topping_id
        ]);
    }
}