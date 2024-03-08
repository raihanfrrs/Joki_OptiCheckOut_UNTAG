<?php

namespace App\Repositories;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Cashier;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use App\Repositories\TransactionRepository;

class CashierRepository
{
    protected $user, $transaction;

    public function __construct(UserRepository $userRepository, TransactionRepository $transactionRepository)
    {
        $this->user = $userRepository;
        $this->transaction = $transactionRepository;
    }
    
    public function getAllCashiers()
    {
        return Cashier::all();
    }

    public function getAllCashiersTrashed()
    {
        return Cashier::onlyTrashed()->get();
    }

    public function getCashier($id)
    {
        return Cashier::find($id);
    }

    public function storeCashier($data)
    {
        $user_id = Uuid::uuid4()->toString();
        $cashier_id = Uuid::uuid4()->toString();

        DB::transaction(function () use ($data, $user_id, $cashier_id) {
            User::create([
                'id' => $user_id,
                'username' => $data['username'],
                'password' => bcrypt($data['password']),
                'level' => 'cashier'
            ]);

            $cashier = Cashier::create([
                'id' => $cashier_id,
                'user_id' => $user_id,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'pob' => $data['pob'],
                'dob' => $data['dob'],
                'gender' => $data['gender'],
                'address' => $data['address']
            ]);

            if ($data->hasFile('cashier_image')) {
                $media = $cashier->addMediaFromRequest('cashier_image')->withResponsiveImages()->toMediaCollection('cashier_images');
    
                $media->update([
                    'model_id' => $cashier_id,
                    'model_type' => Cashier::class,
                ]);
            }
        });

        return true;
    }

    public function updateCashier($data, $cashier)
    {
        DB::transaction(function () use ($data, $cashier) {
            self::getCashier($cashier->id)->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'pob' => $data['pob'],
                'dob' => $data['dob'],
                'gender' => $data['gender'],
                'address' => $data['address']
            ]);


            $user = $this->user->getUser($cashier->user_id);

            $updateData = [
                'username' => $data['username'],
            ];

            if (!empty($data['password'])) {
                $updateData['password'] = bcrypt($data['password']);
            }

            $user->update($updateData);

            if ($data->hasFile('cashier_image_update')) {
                $cashier->clearMediaCollection('cashier_images');

                $media = $cashier->addMediaFromRequest('cashier_image_update')->withResponsiveImages()->toMediaCollection('cashier_images');
    
                $media->update([
                    'model_id' => $cashier->id,
                    'model_type' => Cashier::class,
                ]);
            }
        });

        return true;
    }

    public function updateCashierStatus($cashier)
    {
        return self::getCashier($cashier->id)->update([
            'status' => $cashier->status == 'active' ? 'inactive' : 'active'
        ]);
    }

    public function getCashierPerformanceTransaction()
    {
        return DB::table('transactions')
                    ->join('cashiers', 'transactions.cashier_id', '=', 'cashiers.id')
                    ->join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                    ->select('cashiers.first_name', 'cashiers.last_name', DB::raw('SUM(detail_transactions.subtotal) as total'), DB::raw('SUM(detail_transactions.qty) as qty'), DB::raw('COUNT(DISTINCT transactions.id) as transaction_count'))
                    ->groupBy('transactions.cashier_id')
                    ->get();
    }

    public function destroyCashier($cashier)
    {
        if (self::getCashier($cashier->id)->trashed()) {
            return self::getCashier($cashier->id)->forceDelete();
        } else {
            return self::getCashier($cashier->id)->delete();
        }
    }

    public function restoreCashier($id)
    {
        return Cashier::withTrashed()->find($id)->restore();
    }

    public function permanentlyDeleteCashier($id)
    {
        return Cashier::withTrashed()->find($id)->forceDelete();
    }
}