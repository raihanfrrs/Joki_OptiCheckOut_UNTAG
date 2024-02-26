<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $setting;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->setting = $settingRepository;
    }

    public function settings_profile_index()
    {
        $data = auth()->user()->level == 'admin' ? auth()->user()->admin : auth()->user()->cashier;

        return view('pages.settings.index', compact('data'));
    }

    public function settings_profile_update(ProfileUpdateRequest $request)
    {
        try {
            if ($this->setting->updateProfileSettings($request)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Profile Updated!'
                ]);
            }
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function settings_account_index()
    {
        $data = auth()->user();

        return view('pages.settings.index', compact('data'));
    }

    public function settings_account_update(AccountUpdateRequest $request)
    {
        try {
            if ($this->setting->updateAccountSettings($request)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Account Updated!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
