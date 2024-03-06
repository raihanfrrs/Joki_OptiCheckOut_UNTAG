<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Repositories\ActivityRepository;
use App\Repositories\CashierRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\TransactionRepository;
use Yajra\DataTables\Facades\DataTables;

class YajraDatatablesController extends Controller
{
    protected $product, $cashier, $category, $transaction, $activity;

    public function __construct(ProductRepository $productRepository, CashierRepository $cashierRepository, CategoryRepository $categoryRepository, TransactionRepository $transactionRepository, ActivityRepository $activityRepository)
    {
        $this->product = $productRepository;
        $this->cashier = $cashierRepository;
        $this->category = $categoryRepository;
        $this->transaction = $transactionRepository;
        $this->activity = $activityRepository;
    }

    public function master_product()
    {
        $products = $this->product->getAllProducts();

        return DataTables::of($products)
        ->addColumn('index', function ($model) use ($products) {
            return $products->search($model) + 1;
        })
        ->addColumn('product', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-product.product-column', compact('model'))->render();
        })
        ->addColumn('category', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-product.category-column', compact('model'))->render();
        })
        ->addColumn('temperature', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-product.temperature-column', compact('model'))->render();
        })
        ->addColumn('size', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-product.size-column', compact('model'))->render();
        })
        ->addColumn('topping', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-product.topping-column', compact('model'))->render();
        })
        ->addColumn('stock', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-product.stock-column', compact('model'))->render();
        })
        ->addColumn('price', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-product.price-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-product.status-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-product.action-column', compact('model'))->render();
        })
        ->rawColumns(['index', 'product', 'stock', 'price', 'status', 'action'])
        ->make(true);
    }

    public function master_cashier()
    {
        $cashiers = $this->cashier->getAllCashiers();

        return DataTables::of($cashiers)
        ->addColumn('index', function ($model) use ($cashiers) {
            return $cashiers->search($model) + 1;
        })
        ->addColumn('name', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-cashier.name-column', compact('model'))->render();
        })
        ->addColumn('email', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-cashier.email-column', compact('model'))->render();
        })
        ->addColumn('phone', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-cashier.phone-column', compact('model'))->render();
        })
        ->addColumn('place_date_of_birth', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-cashier.place-date-of-birth-column', compact('model'))->render();
        })
        ->addColumn('gender', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-cashier.gender-column', compact('model'))->render();
        })
        ->addColumn('address', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-cashier.address-column', compact('model'))->render();
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-cashier.created-at-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-cashier.status-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-cashier.action-column', compact('model'))->render();
        })
        ->rawColumns(['index', 'name', 'email', 'phone', 'place_date_of_birth', 'gender', 'address', 'registered_at','status', 'action'])
        ->make(true);
    }

    public function master_category()
    {
        $categories = $this->category->getAllCategories();

        return DataTables::of($categories)
        ->addColumn('index', function ($model) use ($categories) {
            return $categories->search($model) + 1;
        })
        ->addColumn('name', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-category.name-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-master-category.action-column', compact('model'))->render();
        })
        ->rawColumns(['index', 'name', 'action'])
        ->make(true);
    }

    public function inventory_product()
    {
        $products = $this->product->getAllProducts();

        return DataTables::of($products)
        ->addColumn('index', function ($model) use ($products) {
            return $products->search($model) + 1;
        })
        ->addColumn('product', function ($model) {
            return view('components.data-ajax.yajra-column.data-inventory-product.product-column', compact('model'))->render();
        })
        ->addColumn('category', function ($model) {
            return view('components.data-ajax.yajra-column.data-inventory-product.category-column', compact('model'))->render();
        })
        ->addColumn('temperature', function ($model) {
            return view('components.data-ajax.yajra-column.data-inventory-product.temperature-column', compact('model'))->render();
        })
        ->addColumn('size', function ($model) {
            return view('components.data-ajax.yajra-column.data-inventory-product.size-column', compact('model'))->render();
        })
        ->addColumn('topping', function ($model) {
            return view('components.data-ajax.yajra-column.data-inventory-product.topping-column', compact('model'))->render();
        })
        ->addColumn('stock', function ($model) {
            return view('components.data-ajax.yajra-column.data-inventory-product.stock-column', compact('model'))->render();
        })
        ->addColumn('price', function ($model) {
            return view('components.data-ajax.yajra-column.data-inventory-product.price-column', compact('model'))->render();
        })
        ->addColumn('status', function ($model) {
            return view('components.data-ajax.yajra-column.data-inventory-product.status-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-inventory-product.action-column', compact('model'))->render();
        })
        ->rawColumns(['index', 'product', 'category', 'temperature', 'size', 'topping', 'stock', 'price', 'status', 'action'])
        ->make(true);
    }

    public function sales_report_cashier()
    {
        $transactions = $this->transaction->getAllTransactionsByCashierId(auth()->user()->cashier->id);

        return DataTables::of($transactions)
        ->addColumn('index', function ($model) use ($transactions) {
            return $transactions->search($model) + 1;
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-sales-report-cashier.created-at-column', compact('model'))->render();
        })
        ->addColumn('amount', function ($model) {
            return view('components.data-ajax.yajra-column.data-sales-report-cashier.amount-column', compact('model'))->render();
        })
        ->addColumn('total', function ($model) {
            return view('components.data-ajax.yajra-column.data-sales-report-cashier.total-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-sales-report-cashier.action-column', compact('model'))->render();
        })
        ->rawColumns(['index', 'created_at', 'amount', 'total', 'action'])
        ->make(true);
    }

    public function sales_report_admin_daily()
    {
        $transactions = $this->transaction->getAllTransactionsGroupByPeriodically('day');

        return DataTables::of($transactions)
        ->addColumn('index', function ($model) use ($transactions) {
            return $transactions->search($model) + 1;
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-sales-report-admin-daily.created-at-column', compact('model'))->render();
        })
        ->addColumn('amount', function ($model) {
            return view('components.data-ajax.yajra-column.data-sales-report-admin-daily.amount-column', compact('model'))->render();
        })
        ->addColumn('total', function ($model) {
            return view('components.data-ajax.yajra-column.data-sales-report-admin-daily.total-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-sales-report-admin-daily.action-column', compact('model'))->render();
        })
        ->rawColumns(['index', 'created_at', 'amount', 'total', 'action'])
        ->make(true);
    }

    public function sales_report_admin_monthly()
    {
        $transactions = $this->transaction->getAllTransactionsGroupByPeriodically('month');

        return DataTables::of($transactions)
        ->addColumn('index', function ($model) use ($transactions) {
            return $transactions->search($model) + 1;
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-sales-report-admin-monthly.created-at-column', compact('model'))->render();
        })
        ->addColumn('amount', function ($model) {
            return view('components.data-ajax.yajra-column.data-sales-report-admin-monthly.amount-column', compact('model'))->render();
        })
        ->addColumn('total', function ($model) {
            return view('components.data-ajax.yajra-column.data-sales-report-admin-monthly.total-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-sales-report-admin-monthly.action-column', compact('model'))->render();
        })
        ->rawColumns(['index', 'created_at', 'amount', 'total', 'action'])
        ->make(true);
    }

    public function sales_report_admin_yearly()
    {
        $transactions = $this->transaction->getAllTransactionsGroupByPeriodically('year');

        return DataTables::of($transactions)
        ->addColumn('index', function ($model) use ($transactions) {
            return $transactions->search($model) + 1;
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-sales-report-admin-yearly.created-at-column', compact('model'))->render();
        })
        ->addColumn('amount', function ($model) {
            return view('components.data-ajax.yajra-column.data-sales-report-admin-yearly.amount-column', compact('model'))->render();
        })
        ->addColumn('total', function ($model) {
            return view('components.data-ajax.yajra-column.data-sales-report-admin-yearly.total-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-sales-report-admin-yearly.action-column', compact('model'))->render();
        })
        ->rawColumns(['index', 'created_at', 'amount', 'total', 'action'])
        ->make(true);
    }

    public function performance_report_admin()
    {
        $performances = $this->cashier->getCashierPerformanceTransaction();

        return DataTables::of($performances)
        ->addColumn('index', function ($model) use ($performances) {
            return $performances->search($model) + 1;
        })
        ->addColumn('cashier', function ($model) {
            return view('components.data-ajax.yajra-column.data-performance-report-admin.cashier-column', compact('model'))->render();
        })
        ->addColumn('transaction', function ($model) {
            return view('components.data-ajax.yajra-column.data-performance-report-admin.transaction-column', compact('model'))->render();
        })
        ->addColumn('qty_sold', function ($model) {
            return view('components.data-ajax.yajra-column.data-performance-report-admin.qty-sold-column', compact('model'))->render();
        })
        ->addColumn('income', function ($model) {
            return view('components.data-ajax.yajra-column.data-performance-report-admin.income-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-performance-report-admin.action-column', compact('model'))->render();
        })
        ->rawColumns(['index', 'cashier', 'transaction', 'qty_sold', 'income', 'action'])
        ->make(true);
    }

    public function invoice_admin()
    {
        $transactions = $this->transaction->getAllTransactions();

        return DataTables::of($transactions)
        ->addColumn('index', function ($model) use ($transactions) {
            return $transactions->search($model) + 1;
        })
        ->addColumn('invoice', function ($model) {
            return view('components.data-ajax.yajra-column.data-invoice-admin.invoice-column', compact('model'))->render();
        })
        ->addColumn('cashier', function ($model) {
            return view('components.data-ajax.yajra-column.data-invoice-admin.cashier-column', compact('model'))->render();
        })
        ->addColumn('amount', function ($model) {
            return view('components.data-ajax.yajra-column.data-invoice-admin.amount-column', compact('model'))->render();
        })
        ->addColumn('total', function ($model) {
            return view('components.data-ajax.yajra-column.data-invoice-admin.total-column', compact('model'))->render();
        })
        ->addColumn('created_at', function ($model) {
            return view('components.data-ajax.yajra-column.data-invoice-admin.created-at-column', compact('model'))->render();
        })
        ->addColumn('action', function ($model) {
            return view('components.data-ajax.yajra-column.data-invoice-admin.action-column', compact('model'))->render();
        })
        ->rawColumns(['index', 'invoice', 'cashier', 'amount', 'total', 'created_at', 'action'])
        ->make(true);
    }

    public function activity_admin()
    {
        $activies = $this->activity->getAllActivitiesByUserId();

        return DataTables::of($activies)
        ->addColumn('index', function ($model) use ($activies) {
            return $activies->search($model) + 1;
        })
        ->addColumn('date', function ($model) {
            return view('components.data-ajax.yajra-column.data-admin-activity.date-column', compact('model'))->render();
        })
        ->addColumn('description', function ($model) {
            return view('components.data-ajax.yajra-column.data-admin-activity.description-column', compact('model'))->render();
        })
        ->rawColumns(['index', 'date', 'description'])
        ->make(true);
    }

    public function activity_cashier()
    {
        $activies = $this->activity->getAllActivitiesByUserId();

        return DataTables::of($activies)
        ->addColumn('index', function ($model) use ($activies) {
            return $activies->search($model) + 1;
        })
        ->addColumn('date', function ($model) {
            return view('components.data-ajax.yajra-column.data-admin-activity.date-column', compact('model'))->render();
        })
        ->addColumn('description', function ($model) {
            return view('components.data-ajax.yajra-column.data-admin-activity.description-column', compact('model'))->render();
        })
        ->rawColumns(['index', 'date', 'description'])
        ->make(true);
    }

    public function activity_cashier_detail(Cashier $cashier)
    {
        $activies = $this->activity->getAllActivitiesByCashierUserId($cashier->user->id);

        return DataTables::of($activies)
        ->addColumn('index', function ($model) use ($activies) {
            return $activies->search($model) + 1;
        })
        ->addColumn('date', function ($model) {
            return view('components.data-ajax.yajra-column.data-cashier-activity-detail.date-column', compact('model'))->render();
        })
        ->addColumn('description', function ($model) {
            return view('components.data-ajax.yajra-column.data-cashier-activity-detail.description-column', compact('model'))->render();
        })
        ->rawColumns(['index', 'date', 'description'])
        ->make(true);
    }
}
