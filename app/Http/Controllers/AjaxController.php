<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\PriceRepository;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    protected $price;

    public function __construct(PriceRepository $priceRepository)
    {
        $this->price = $priceRepository;
    }

    public function product_edit(Product $product)
    {
        return view('components.data-ajax.pages.modal.data-master-product', [
            'product' => $product,
            'prices' => $this->price->getAllPrices()
        ]);
    }
}
