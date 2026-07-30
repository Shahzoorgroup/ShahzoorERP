<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['branch', 'customer'])
            ->latest()
            ->get();

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $branches = Branch::orderBy('name')->get();

        $customers = Customer::orderBy('name')->get();

        $products = Product::where('status', 'Active')
            ->orderBy('name')
            ->get();

        $invoiceNo = 'INV-' . date('Ymd') . '-' . str_pad((Sale::count() + 1), 4, '0', STR_PAD_LEFT);

        return view('sales.create', compact(
            'branches',
            'customers',
            'products',
            'invoiceNo'
        ));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Sale $sale)
    {
        //
    }

    public function edit(Sale $sale)
    {
        //
    }

    public function update(Request $request, Sale $sale)
    {
        //
    }

    public function destroy(Sale $sale)
    {
        //
    }
}