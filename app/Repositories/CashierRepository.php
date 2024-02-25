<?php

namespace App\Repositories;

use Ramsey\Uuid\Uuid;
use App\Models\Cashier;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CashierRepository
{
    
    public function getAllCashiers()
    {
        return Cashier::all();
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
                'name' => $data['first_name'] . ' ' . $data['last_name'],
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

}