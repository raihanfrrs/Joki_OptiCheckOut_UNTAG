<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportingCashierController extends Controller
{
    public function sales_report_index()
    {
        return view('pages.cashier.report.sales.index');
    }
}
