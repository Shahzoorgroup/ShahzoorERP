<?php

namespace App\Http\Controllers;

use App\Models\Recovery;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecoveryController extends Controller
{
    public function index()
    {
        $recoveries = Recovery::with([
            'sale.customer',
            'sale.branch',
        ])
        ->latest()
        ->get();

        return view('recoveries.index', compact('recoveries'));
    }

    public function create()
    {
        $sales = Sale::with('customer')
            ->where('remaining_amount', '>', 0)
            ->orderBy('invoice_no')
            ->get();

        return view('recoveries.create', compact('sales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sale_id' => 'required|exists:sales,id',
            'recovery_date' => 'required|date',
            'amount_received' => 'required|numeric|min:1',
            'remarks' => 'nullable',
        ]);

        DB::beginTransaction();

        try {

            $sale = Sale::findOrFail($request->sale_id);

            $remaining = $sale->remaining_amount - $request->amount_received;

            if ($remaining < 0) {
                $remaining = 0;
            }

            Recovery::create([
                'sale_id' => $sale->id,
                'recovery_date' => $request->recovery_date,
                'amount_received' => $request->amount_received,
                'remaining_balance' => $remaining,
                'user_id' => auth()->id(),
                'remarks' => $request->remarks,
            ]);

            $sale->remaining_amount = $remaining;

            if ($remaining == 0) {
                $sale->status = 'Completed';
            }

            $sale->save();

            DB::commit();

            return redirect()
                ->route('recoveries.index')
                ->with('success', 'Recovery Added Successfully');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());

        }
    }

    public function show(Recovery $recovery)
    {
        //
    }

    public function edit(Recovery $recovery)
    {
        //
    }

    public function update(Request $request, Recovery $recovery)
    {
        //
    }

    public function destroy(Recovery $recovery)
    {
        //
    }
}