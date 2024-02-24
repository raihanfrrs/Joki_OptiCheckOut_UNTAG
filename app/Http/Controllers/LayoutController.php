<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LayoutController extends Controller
{
    public function index()
    {
        if (Auth::check() && auth()->user()->level == 'admin') {
            return view('pages.admin.dashboard.index');
        } elseif (Auth::check() && auth()->user()->level == 'cashier') {
            return view('pages.cashier.dashboard.index');
        } else {
            return redirect()->route('login.cashier');
        }
    }
}
