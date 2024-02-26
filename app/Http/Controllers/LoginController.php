<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function cashier()
    {
        return view('components.auth.cashier');
    }

    public function admin()
    {
        return view('components.auth.admin');
    }

    public function store(LoginRequest $request, $level)
    {
        $kredensial = $request->only('username', 'password');

        if ($level == 'admin') {
            $checkUser = User::where('username', $request->username)->where('level', $level)->first();
        } else {
            $checkUser = User::where('username', $request->username)->where('level', $level)->first();

            if ($checkUser->cashier->status == 'inactive') {
                return back()->withErrors([
                    'username' => 'Your account is inactive, please contact your admin!'
                ])->onlyInput('username');
            }
        }

        if (empty($checkUser)) {
            return back()->withErrors([
                'username' => 'Wrong username or password!'
            ])->onlyInput('username');
        }

        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user) {
                return redirect()->intended('/')->with([
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Berhasil Masuk!'
                ]);
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'Wrong username or password!'
        ])->onlyInput('username');
    }
}
