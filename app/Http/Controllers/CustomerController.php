<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Branch;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('branch')->latest()->get();

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        $branches = Branch::orderBy('name')->get();

        return view('customers.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_id'   => 'required|exists:branches,id',
            'name'        => 'required|max:255',
            'father_name' => 'required|max:255',
            'cnic'        => 'required|unique:customers,cnic',
            'mobile'      => 'required|max:20',
            'address'     => 'required',
            'status'      => 'required',
        ]);

        Customer::create($request->all());

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer Added Successfully');
    }

    public function show(Customer $customer)
    {
        return redirect()->route('customers.index');
    }

    public function edit(Customer $customer)
    {
        $branches = Branch::orderBy('name')->get();

        return view('customers.edit', compact('customer', 'branches'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'branch_id'   => 'required|exists:branches,id',
            'name'        => 'required|max:255',
            'father_name' => 'required|max:255',
            'cnic'        => 'required|unique:customers,cnic,' . $customer->id,
            'mobile'      => 'required|max:20',
            'address'     => 'required',
            'status'      => 'required',
        ]);

        $customer->update($request->all());

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer Updated Successfully');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer Deleted Successfully');
    }
}