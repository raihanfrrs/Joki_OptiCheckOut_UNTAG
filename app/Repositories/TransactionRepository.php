<?php

namespace App\Repositories;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use Illuminate\Support\Facades\DB;
use App\Repositories\TemporaryTransactionRepository;

class TransactionRepository
{
    protected $temporary, $product;

    public function __construct(TemporaryTransactionRepository $temporaryTransactionRepository, ProductRepository $productRepository)
    {
        $this->temporary = $temporaryTransactionRepository;
        $this->product = $productRepository;
    }

    public function getAllTransactions()
    {
        return Transaction::all();
    }

    public function getAllTransactionsByCashierId($id)
    {
        return Transaction::where('cashier_id', $id)->get();
    }

    public function getAllTransactionsGroupByPeriodically($periodic)
    {
        $groupByClause = '';

        switch ($periodic) {
            case 'day':
                $groupByClause = DB::raw('DATE(transactions.created_at) as period');
                break;
            case 'month':
                $groupByClause = DB::raw('DATE_FORMAT(transactions.created_at, "%Y-%m") as period');
                break;
            case 'year':
                $groupByClause = DB::raw('YEAR(transactions.created_at) as period');
                break;
            default:
                break;
        }

        return Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
            ->select(DB::raw('SUM(subtotal) as grand_total'), DB::raw('SUM(qty) as qty'), $groupByClause)
            ->groupBy('period') // Menggunakan alias pada metode groupBy
            ->get();
    }

    public function getTransactionByDay($day)
    {
        $timestamp = strtotime($day);
    
        // return Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
        //                 ->join('products', 'detail_transactions.product_id', '=', 'products.id')
        //                 ->join('prices', 'products.price_id', '=', 'prices.id')
        //                 ->join('sizes', 'detail_transactions.size_id', '=', 'sizes.id')
        //                 ->join('temperatures', 'detail_transactions.temperature_id', '=', 'temperatures.id')
        //                 ->join('toppings', 'detail_transactions.topping_id', '=', 'toppings.id')
        //                 ->select('transactions.*', 'products.name as product_name', 'prices.price', 'sizes.name as size', 'temperatures.name as temperature', 'toppings.name as topping', 'detail_transactions.qty', 'detail_transactions.subtotal')
        //                 ->whereDate('transactions.created_at', '=', date('Y-m-d', $timestamp))->get();

        return Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                        ->join('products', 'detail_transactions.product_id', '=', 'products.id')
                        ->join('prices', 'products.price_id', '=', 'prices.id')
                        ->join('sizes', 'products.size_id', '=', 'sizes.id')
                        ->join('temperatures', 'products.temperature_id', '=', 'temperatures.id')
                        ->join('toppings', 'products.topping_id', '=', 'toppings.id')
                        ->select('transactions.*', 'products.name as product_name', 'prices.price', 'sizes.name as size', 'temperatures.name as temperature', 'toppings.name as topping', 'detail_transactions.qty', 'detail_transactions.subtotal')
                        ->whereDate('transactions.created_at', '=', date('Y-m-d', $timestamp))->get();
    }

    public function getTransactionByMonth($month)
    {
        $timestamp = Carbon::createFromFormat('F-Y', $month)->startOfMonth();
        
        // return Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
        //                 ->join('products', 'detail_transactions.product_id', '=', 'products.id')
        //                 ->join('prices', 'products.price_id', '=', 'prices.id')
        //                 ->join('sizes', 'detail_transactions.size_id', '=', 'sizes.id')
        //                 ->join('temperatures', 'detail_transactions.temperature_id', '=', 'temperatures.id')
        //                 ->join('toppings', 'detail_transactions.topping_id', '=', 'toppings.id')
        //                 ->select('transactions.*', 'products.name as product_name', 'prices.price', 'sizes.name as size', 'temperatures.name as temperature', 'toppings.name as topping', 'detail_transactions.qty', 'detail_transactions.subtotal')
        //                 ->whereBetween('transactions.created_at', [$timestamp->format('Y-m-d H:i:s'), $timestamp->endOfMonth()->format('Y-m-d H:i:s')])
        //                 ->get();

        return Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                        ->join('products', 'detail_transactions.product_id', '=', 'products.id')
                        ->join('prices', 'products.price_id', '=', 'prices.id')
                        ->join('sizes', 'products.size_id', '=', 'sizes.id')
                        ->join('temperatures', 'products.temperature_id', '=', 'temperatures.id')
                        ->join('toppings', 'products.topping_id', '=', 'toppings.id')
                        ->select('transactions.*', 'products.name as product_name', 'prices.price', 'sizes.name as size', 'temperatures.name as temperature', 'toppings.name as topping', 'detail_transactions.qty', 'detail_transactions.subtotal')
                        ->whereBetween('transactions.created_at', [$timestamp->format('Y-m-d H:i:s'), $timestamp->endOfMonth()->format('Y-m-d H:i:s')])
                        ->get();
    }

    public function getTransactionByYear($year)
    {
        return Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
            ->join('products', 'detail_transactions.product_id', '=', 'products.id')
            ->join('prices', 'products.price_id', '=', 'prices.id')
            ->join('sizes', 'products.size_id', '=', 'sizes.id')
            ->join('temperatures', 'products.temperature_id', '=', 'temperatures.id')
            ->join('toppings', 'products.topping_id', '=', 'toppings.id')
            ->select('transactions.*', 'products.name as product_name', 'prices.price', 'sizes.name as size', 'temperatures.name as temperature', 'toppings.name as topping', 'detail_transactions.qty', 'detail_transactions.subtotal')
            ->whereYear('transactions.created_at', $year)
            ->get();
    }

    public function getTransactionByMonthAndCashierId($month)
    {
        $timestamp = Carbon::createFromFormat('F-Y', $month)->startOfMonth();

        return Transaction::where('cashier_id', auth()->user()->cashier->id)
                            ->whereBetween('created_at', [$timestamp->format('Y-m-d H:i:s'), $timestamp->endOfMonth()->format('Y-m-d H:i:s')])
                            ->get();
    }

    public function storeToTransaction()
    {
        $transaction_id = Uuid::uuid4()->toString();

        Transaction::create([
            'id' => $transaction_id,
            'cashier_id' => auth()->user()->cashier->id,
            'grand_total' => $this->temporary->getCartByCashierId(auth()->user()->cashier->id)->sum('subtotal')
        ]);

        foreach ($this->temporary->getCartByCashierId(auth()->user()->cashier->id) as $key => $value) {
            DetailTransaction::create([
               'id' => Uuid::uuid4()->toString(),
               'transaction_id' => $transaction_id,
               'product_id' => $value->product_id,
               'qty' => $value->qty,
               'subtotal' => $value->subtotal
            ]);

            $this->product->getProduct($value->product_id)->decrement('stock', $value->qty);           

            $this->temporary->deleteShoppingCartById($value->id);
        }

        return $transaction_id;
    }
}