<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterAdminController extends Controller
{
    public function master_product_index()
    {
        return view('pages.admin.master.product.index');
    }
}
