<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TemporaryTransactionRepository;

class CheckoutController extends Controller
{
    protected $temporary;

    public function __construct(TemporaryTransactionRepository $temporaryTransactionRepository)
    {
        $this->temporary = $temporaryTransactionRepository;
    }

    public function cart_index()
    {
        $carts = $this->temporary->getCartByCashierId(auth()->user()->cashier->id);

        return view('pages.cashier.checkout.index', compact('carts'));
    }
}
