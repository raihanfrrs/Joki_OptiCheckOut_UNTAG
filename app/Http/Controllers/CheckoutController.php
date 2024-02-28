<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Repositories\SizeRepository;
use App\Repositories\ToppingRepository;
use App\Repositories\TemperatureRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\TemporaryTransactionRepository;

class CheckoutController extends Controller
{
    protected $temporary, $temperature, $size, $topping, $transaction;

    public function __construct(TemporaryTransactionRepository $temporaryTransactionRepository, TemperatureRepository $temperatureRepository, SizeRepository $sizeRepository, ToppingRepository $toppingRepository, TransactionRepository $transactionRepository)
    {
        $this->temporary = $temporaryTransactionRepository;
        $this->temperature = $temperatureRepository;
        $this->size = $sizeRepository;
        $this->topping = $toppingRepository;
        $this->transaction = $transactionRepository;
    }

    public function cart_index()
    {
        return view('pages.cashier.checkout.index', [
            'carts' => $this->temporary->getCartByCashierId(auth()->user()->cashier->id),
            'temperatures' => $this->temperature->getAllTemperatures(),
            'sizes' => $this->size->getAllSizes(),
            'toppings' => $this->topping->getAllToppings()
        ]);
    }

    public function cart_store()
    {
        $transaction = $this->transaction->storeToTransaction();
        if ($transaction) {
            return redirect()->route('invoice', $transaction)->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Transaction Success!'
            ]);
        }
    }

    public function invoice_transaction(Transaction $transaction)
    {
        return view('pages.cashier.checkout.invoice', compact('transaction'));
    }

    public function invoice_print(Transaction $transaction)
    {
        return view('pages.cashier.checkout.print', compact('transaction'));
    }
}
