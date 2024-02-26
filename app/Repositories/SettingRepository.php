<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Models\Cashier;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use App\Repositories\AdminRepository;
use App\Repositories\CashierRepository;

class SettingRepository
{
    protected $admin, $cashier, $user;

    public function __construct(AdminRepository $adminRepository, CashierRepository $cashierRepository, UserRepository $userRepository)
    {
        $this->admin = $adminRepository;
        $this->cashier = $cashierRepository;
        $this->user = $userRepository;
    }

    public function updateProfileSettings($data)
    {
        if (auth()->user()->level == 'admin') {
            $admin = $this->admin->getAdmin(auth()->user()->admin->id);

            DB::transaction(function () use ($data, $admin) {
                $admin->update([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'pob' => $data['pob'],
                    'dob' => $data['dob'],
                    'gender' => $data['gender'],
                    'address' => $data['address']
                ]);

                if ($data->hasFile('admin_image')) {
                    $admin->clearMediaCollection('admin_images');

                    $media = $admin->addMediaFromRequest('admin_image')->withResponsiveImages()->toMediaCollection('admin_images');

                    $media->update([
                        'model_id' => $admin->id,
                        'model_type' => Admin::class,
                    ]);
                }
            });

            return true;
        } else {
            $cashier = $this->cashier->getCashier(auth()->user()->cashier->id);

            DB::transaction(function () use ($data, $cashier) {
                $cashier->update([
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
                    $cashier->clearMediaCollection('cashier_images');

                    $media = $cashier->addMediaFromRequest('cashier_image')->withResponsiveImages()->toMediaCollection('cashier_images');

                    $media->update([
                        'model_id' => $cashier->id,
                        'model_type' => Cashier::class,
                    ]);
                }
            });

            return true;
        }
    }

    public function updateAccountSettings($data)
    {
        $user = $this->user->getUser(auth()->user()->id);

        DB::transaction(function () use ($data, $user) {
            $user->update([
                'username' => $data['username'],
                'password' => bcrypt($data['password'])
            ]);
        });

        return true;
    }

    public function deactivateCashierProfile()
    {
        $cashier = $this->cashier->getCashier(auth()->user()->cashier->id);

        DB::transaction(function () use ($cashier) {
            $cashier->update([
                'status' => 'inactive'
            ]);
        });

        return true;
    }
}