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

            if (empty($checkUser)) {
                return back()->withErrors([
                    'username' => 'Username atau kata sandi salah!'
                ])->onlyInput('username');
            } else {
                if ($checkUser->cashier->status == 'inactive') {
                    return back()->withErrors([
                        'username' => 'Akun Anda tidak aktif, harap hubungi administrator Anda!'
                    ])->onlyInput('username');
                }
            }
        }

        if (empty($checkUser)) {
            return back()->withErrors([
                'username' => 'Username atau kata sandi salah!'
            ])->onlyInput('username');
        }

        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();

            $user = Auth::user();

            activity()->causedBy($user)->log('Login');

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
            'username' => 'Username atau kata sandi salah!'
        ])->onlyInput('username');
    }
}
