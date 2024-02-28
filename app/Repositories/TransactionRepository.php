<?php

namespace App\Repositories;

use App\Models\DetailTransaction;
use App\Models\Transaction;
use App\Repositories\TemporaryTransactionRepository;
use Ramsey\Uuid\Uuid;

class TransactionRepository
{
    protected $temporary;

    public function __construct(TemporaryTransactionRepository $temporaryTransactionRepository)
    {
        $this->temporary = $temporaryTransactionRepository;
    }

    public function getAllTransactions()
    {
        return Transaction::all();
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
               'temperature_id' => $value->temperature_id,
               'size_id' => $value->size_id,
               'topping_id' => $value->topping_id,
               'qty' => $value->qty,
               'subtotal' => $value->subtotal
            ]);

            $this->temporary->deleteShoppingCartById($value->id);
        }

        return $transaction_id;
    }
}