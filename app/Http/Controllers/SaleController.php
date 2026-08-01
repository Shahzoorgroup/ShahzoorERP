<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $request->validate([
            'invoice_no' => 'required|unique:sales,invoice_no',
            'branch_id' => 'required|exists:branches,id',
            'customer_id' => 'required|exists:customers,id',
            'sale_date' => 'required|date',
            'product_id' => 'required|array|min:1',
            'product_id.*' => 'required|exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
            'price' => 'required|array',
            'price.*' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {

            $grandTotal = 0;

            foreach ($request->product_id as $index => $productId) {

                $grandTotal +=
                    $request->quantity[$index] *
                    $request->price[$index];
            }

            $sale = Sale::create([
                'invoice_no' => $request->invoice_no,
                'branch_id' => $request->branch_id,
                'customer_id' => $request->customer_id,
                'sale_date' => $request->sale_date,
                'total_amount' => $grandTotal,
                'down_payment' => 0,
                'remaining_amount' => $grandTotal,
                'installment_months' => 0,
                'monthly_installment' => 0,
                'next_due_date' => null,
                'status' => 'Running',
                'remarks' => null,
            ]);

            foreach ($request->product_id as $index => $productId) {

                $qty = $request->quantity[$index];
                $price = $request->price[$index];
                $total = $qty * $price;

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $productId,
                    'quantity' => $qty,
                    'unit_price' => $price,
                    'total_price' => $total,
                ]);

                $product = Product::find($productId);

                $product->decrement('stock_quantity', $qty);
            }

            DB::commit();

            return redirect()
                ->route('sales.index')
                ->with('success', 'Sale Added Successfully');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function show(Sale $sale)
    {
        $sale->load([
            'branch',
            'customer',
            'saleItems.product',
        ]);

        return view('sales.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        $sale->load('saleItems.product');

        $branches = Branch::orderBy('name')->get();

        $customers = Customer::orderBy('name')->get();

        $products = Product::where('status', 'Active')
            ->orderBy('name')
            ->get();

        return view(
            'sales.edit',
            compact(
                'sale',
                'branches',
                'customers',
                'products'
            )
        );
    }
	    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'customer_id' => 'required|exists:customers,id',
            'sale_date' => 'required|date',
        ]);

        DB::beginTransaction();

        try {

            foreach ($sale->saleItems as $item) {

                $product = Product::find($item->product_id);

                if ($product) {

                    $product->increment(
                        'stock_quantity',
                        $item->quantity
                    );

                }

            }

            $sale->saleItems()->delete();

            $grandTotal = 0;

            foreach ($request->product_id as $index => $productId) {

                $qty = $request->quantity[$index];

                $price = $request->price[$index];

                $total = $qty * $price;

                $grandTotal += $total;

                SaleItem::create([

                    'sale_id' => $sale->id,
                    'product_id' => $productId,
                    'quantity' => $qty,
                    'unit_price' => $price,
                    'total_price' => $total,

                ]);

                $product = Product::find($productId);

                if ($product) {

                    $product->decrement(
                        'stock_quantity',
                        $qty
                    );

                }

            }

            $sale->update([

                'branch_id' => $request->branch_id,
                'customer_id' => $request->customer_id,
                'sale_date' => $request->sale_date,
                'total_amount' => $grandTotal,
                'remaining_amount' => $grandTotal,

            ]);

            DB::commit();

            return redirect()
                ->route('sales.index')
                ->with(
                    'success',
                    'Sale Updated Successfully'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );

        }
    }
	    public function destroy(Sale $sale)
    {
        DB::beginTransaction();

        try {

            foreach ($sale->saleItems as $item) {

                $product = Product::find($item->product_id);

                if ($product) {

                    $product->increment(
                        'stock_quantity',
                        $item->quantity
                    );

                }

            }

            $sale->saleItems()->delete();

            $sale->delete();

            DB::commit();

            return redirect()
                ->route('sales.index')
                ->with(
                    'success',
                    'Sale Deleted Successfully'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );

        }
    }
}