<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with([
            'branch',
            'customer',
            'salesman',
            'salesOfficer',
            'recoveryOfficer',
            'approvedBy',
        ])
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

        $salesOfficers = User::whereHas('role', function ($query) {
            $query->where('name', 'sales_officer');
        })
            ->where('status', 'Active')
            ->orderBy('name')
            ->get();

        $recoveryOfficers = User::whereHas('role', function ($query) {
            $query->where('name', 'recovery_officer');
        })
            ->where('status', 'Active')
            ->orderBy('name')
            ->get();

        $invoiceNo = 'INV-' . date('Ymd') . '-' .
            str_pad((Sale::count() + 1), 4, '0', STR_PAD_LEFT);

        return view('sales.create', compact(
            'branches',
            'customers',
            'products',
            'salesOfficers',
            'recoveryOfficers',
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

            'market_advance' => 'nullable|numeric|min:0',

            'sales_officer_id' => 'nullable|exists:users,id',
            'recovery_officer_id' => 'nullable|exists:users,id',

            'installment_months' => 'nullable|integer|min:0',
            'next_due_date' => 'nullable|date',
            'remarks' => 'nullable|string|max:1000',
        ]);

        DB::beginTransaction();

        try {

            $grandTotal = 0;

            foreach ($request->product_id as $index => $productId) {

                $qty = (int) $request->quantity[$index];
                $price = (float) $request->price[$index];

                $grandTotal += $qty * $price;
            }

            $marketAdvance = (float) ($request->market_advance ?? 0);

            if ($marketAdvance > $grandTotal) {

                DB::rollBack();

                return back()
                    ->withInput()
                    ->withErrors([
                        'market_advance' =>
                            'Market Advance cannot be greater than total sale amount.'
                    ]);
            }

            $remainingAmount = $grandTotal - $marketAdvance;

            $installmentMonths =
                (int) ($request->installment_months ?? 0);

            $monthlyInstallment = 0;

            if ($installmentMonths > 0 && $remainingAmount > 0) {

                $monthlyInstallment =
                    $remainingAmount / $installmentMonths;
            }

            $salesmanId = null;

            if (
                auth()->check() &&
                method_exists(auth()->user(), 'isSalesman') &&
                auth()->user()->isSalesman()
            ) {
                $salesmanId = auth()->id();
            }

            $sale = Sale::create([

                'invoice_no' => $request->invoice_no,

                'branch_id' => $request->branch_id,

                'customer_id' => $request->customer_id,

                'salesman_id' => $salesmanId,

                'sales_officer_id' =>
                    $request->sales_officer_id,

                'recovery_officer_id' =>
                    $request->recovery_officer_id,

                'sale_date' => $request->sale_date,

                'total_amount' => $grandTotal,

                'market_advance' => $marketAdvance,

                'down_payment' => $marketAdvance,

                'remaining_amount' => $remainingAmount,

                'installment_months' =>
                    $installmentMonths,

                'monthly_installment' =>
                    $monthlyInstallment,

                'next_due_date' =>
                    $request->next_due_date,

                'status' => 'Running',

                'approval_status' => 'Pending',

                'approved_by' => null,

                'approved_at' => null,

                'remarks' => $request->remarks,
            ]);

            foreach ($request->product_id as $index => $productId) {

                $qty = (int) $request->quantity[$index];

                $price = (float) $request->price[$index];

                $total = $qty * $price;

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

            DB::commit();

            return redirect()
                ->route('sales.index')
                ->with(
                    'success',
                    'Sale Added Successfully. Waiting for Sales Manager approval.'
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

    public function show(Sale $sale)
    {
        $sale->load([
            'branch',
            'customer',
            'salesman',
            'salesOfficer',
            'recoveryOfficer',
            'approvedBy',
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

        $salesOfficers = User::whereHas('role', function ($query) {
            $query->where('name', 'sales_officer');
        })
            ->where('status', 'Active')
            ->orderBy('name')
            ->get();

        $recoveryOfficers = User::whereHas('role', function ($query) {
            $query->where('name', 'recovery_officer');
        })
            ->where('status', 'Active')
            ->orderBy('name')
            ->get();

        return view(
            'sales.edit',
            compact(
                'sale',
                'branches',
                'customers',
                'products',
                'salesOfficers',
                'recoveryOfficers'
            )
        );
    }

    public function update(Request $request, Sale $sale)
    {
        $request->validate([

            'branch_id' => 'required|exists:branches,id',

            'customer_id' => 'required|exists:customers,id',

            'sale_date' => 'required|date',

            'product_id' => 'required|array|min:1',

            'product_id.*' =>
                'required|exists:products,id',

            'quantity' => 'required|array',

            'quantity.*' =>
                'required|integer|min:1',

            'price' => 'required|array',

            'price.*' =>
                'required|numeric|min:0',

            'market_advance' =>
                'nullable|numeric|min:0',

            'sales_officer_id' =>
                'nullable|exists:users,id',

            'recovery_officer_id' =>
                'nullable|exists:users,id',

            'installment_months' =>
                'nullable|integer|min:0',

            'next_due_date' =>
                'nullable|date',

            'remarks' =>
                'nullable|string|max:1000',
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

                $qty =
                    (int) $request->quantity[$index];

                $price =
                    (float) $request->price[$index];

                $total =
                    $qty * $price;

                $grandTotal += $total;

                SaleItem::create([

                    'sale_id' =>
                        $sale->id,

                    'product_id' =>
                        $productId,

                    'quantity' =>
                        $qty,

                    'unit_price' =>
                        $price,

                    'total_price' =>
                        $total,
                ]);

                $product =
                    Product::find($productId);

                if ($product) {

                    $product->decrement(
                        'stock_quantity',
                        $qty
                    );
                }
            }

            $marketAdvance =
                (float) ($request->market_advance ?? 0);

            if ($marketAdvance > $grandTotal) {

                DB::rollBack();

                return back()
                    ->withInput()
                    ->withErrors([
                        'market_advance' =>
                            'Market Advance cannot be greater than total sale amount.'
                    ]);
            }

            $remainingAmount =
                $grandTotal - $marketAdvance;

            $installmentMonths =
                (int) ($request->installment_months ?? 0);

            $monthlyInstallment = 0;

            if (
                $installmentMonths > 0 &&
                $remainingAmount > 0
            ) {

                $monthlyInstallment =
                    $remainingAmount /
                    $installmentMonths;
            }

            $sale->update([

                'branch_id' =>
                    $request->branch_id,

                'customer_id' =>
                    $request->customer_id,

                'sale_date' =>
                    $request->sale_date,

                'total_amount' =>
                    $grandTotal,

                'market_advance' =>
                    $marketAdvance,

                'down_payment' =>
                    $marketAdvance,

                'remaining_amount' =>
                    $remainingAmount,

                'installment_months' =>
                    $installmentMonths,

                'monthly_installment' =>
                    $monthlyInstallment,

                'next_due_date' =>
                    $request->next_due_date,

                'sales_officer_id' =>
                    $request->sales_officer_id,

                'recovery_officer_id' =>
                    $request->recovery_officer_id,

                'remarks' =>
                    $request->remarks,

                'approval_status' =>
                    'Pending',

                'approved_by' =>
                    null,

                'approved_at' =>
                    null,
            ]);

            DB::commit();

            return redirect()
                ->route('sales.index')
                ->with(
                    'success',
                    'Sale Updated Successfully. Waiting for approval.'
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

    public function approve(Sale $sale)
    {
        if (!$this->isSalesManager()) {

            abort(403, 'Only Sales Manager can approve sales.');
        }

        if ($sale->approval_status !== 'Pending') {

            return back()->with(
                'error',
                'This sale has already been processed.'
            );
        }

        $sale->update([

            'approval_status' =>
                'Approved',

            'approved_by' =>
                auth()->id(),

            'approved_at' =>
                now(),
        ]);

        return back()->with(
            'success',
            'Sale approved successfully.'
        );
    }

    public function reject(Sale $sale)
    {
        if (!$this->isSalesManager()) {

            abort(403, 'Only Sales Manager can reject sales.');
        }

        if ($sale->approval_status !== 'Pending') {

            return back()->with(
                'error',
                'This sale has already been processed.'
            );
        }

        $sale->update([

            'approval_status' =>
                'Rejected',

            'approved_by' =>
                auth()->id(),

            'approved_at' =>
                now(),
        ]);

        return back()->with(
            'success',
            'Sale rejected successfully.'
        );
    }

    private function isSalesManager()
    {
        if (!auth()->check()) {
            return false;
        }

        $user = auth()->user();

        if (!$user->role) {
            return false;
        }

        return $user->role->name === 'sales_manager';
    }

    public function destroy(Sale $sale)
    {
        DB::beginTransaction();

        try {

            foreach ($sale->saleItems as $item) {

                $product =
                    Product::find($item->product_id);

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