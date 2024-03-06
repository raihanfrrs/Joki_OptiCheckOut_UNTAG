<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\CashierRepository;
use App\Repositories\ProductRepository;
use App\Repositories\TransactionRepository;

class LayoutController extends Controller
{
    protected $transaction, $cashier, $product;

    public function __construct(TransactionRepository $transactionRepository, CashierRepository $cashierRepository, ProductRepository $productRepository)
    {
        $this->transaction = $transactionRepository;
        $this->cashier = $cashierRepository;
        $this->product = $productRepository;
    }

    public function index()
    {
        if (Auth::check() && auth()->user()->level == 'admin') {
            return view('pages.admin.dashboard.index', [
                'total_sales_monthly' => $this->transaction->getTransactionByMonth(\Carbon\Carbon::now()->format('F-Y')),
                'total_cashier' => $this->cashier->getAllCashiers()->count(),
                'total_product' => $this->product->getAllProducts()->count(),
                'total_invoice' => $this->transaction->getAllTransactions()->count()
            ]);
        } elseif (Auth::check() && auth()->user()->level == 'cashier') {
            return view('pages.cashier.dashboard.index', [
                'total_sales_monthly' => $this->transaction->getTransactionByMonth(\Carbon\Carbon::now()->format('F-Y'))->where('cashier_id', auth()->user()->cashier->id),
                'total_product' => $this->transaction->getTransactionByMonth(\Carbon\Carbon::now()->format('F-Y'))->where('cashier_id', auth()->user()->cashier->id),
                'total_invoice' => $this->transaction->getTransactionByMonthAndCashierId(\Carbon\Carbon::now()->format('F-Y'))->count()
            ]);
        } else {
            return redirect()->route('login.cashier');
        }
    }
}
