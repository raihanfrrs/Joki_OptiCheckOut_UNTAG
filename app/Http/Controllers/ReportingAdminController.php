<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Repositories\TransactionRepository;

class ReportingAdminController extends Controller
{
    protected $transaction;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transaction = $transactionRepository;
    }

    public function admin_sales_report_daily()
    {
        return view('pages.admin.report.sales.daily.index');
    }

    public function admin_sales_report_daily_print($day)
    {
        $transactions = $this->transaction->getTransactionByDay($day);

        return view('pages.admin.report.sales.daily.print', compact('transactions'));
    }

    public function admin_sales_report_monthly()
    {
        return view('pages.admin.report.sales.monthly.index');
    }

    public function admin_sales_report_monthly_print($month)
    {
        $transactions = $this->transaction->getTransactionByMonth($month);

        return view('pages.admin.report.sales.monthly.print', compact('transactions'));
    }

    public function admin_sales_report_yearly()
    {
        return view('pages.admin.report.sales.yearly.index');
    }

    public function admin_sales_report_yearly_print($year)
    {
        $transactions = $this->transaction->getTransactionByYear($year);

        return view('pages.admin.report.sales.yearly.print', compact('transactions'));
    }

    public function admin_performance_report()
    {
        return view('pages.admin.report.performance.index');
    }

    public function admin_invoice()
    {
        return view('pages.admin.report.invoice.index');
    }

    public function admin_invoice_show(Transaction $transaction)
    {
        return view('pages.admin.report.invoice.show', compact('transaction'));
    }

    public function admin_invoice_print(Transaction $transaction)
    {
        return view('pages.admin.report.invoice.print', compact('transaction'));
    }
}
