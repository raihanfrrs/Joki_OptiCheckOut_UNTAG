<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function not_found()
    {

    }

    public function not_authorized()
    {
        return view('pages.error.authorized');
    }
}
