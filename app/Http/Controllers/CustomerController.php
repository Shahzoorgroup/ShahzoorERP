<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('branch')
            ->latest()
            ->get();

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        $branches = Branch::orderBy('name')->get();

        return view('customers.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id'      => 'required|exists:branches,id',
            'name'           => 'required|string|max:255',
            'father_name'    => 'required|string|max:255',
            'cnic'           => 'required|string|max:20|unique:customers,cnic',
            'mobile'         => 'required|string|max:20',
            'address'        => 'required|string',
            'location'       => 'nullable|string|max:255',
            'latitude'       => 'nullable|numeric|between:-90,90',
            'longitude'      => 'nullable|numeric|between:-180,180',
            'customer_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'house_photo'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'cnic_front'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cnic_back'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'         => 'required|in:Active,Inactive',
        ]);

        if ($request->hasFile('customer_photo')) {
            $validated['customer_photo'] =
                $request->file('customer_photo')->store('customers/photos', 'public');
        }

        if ($request->hasFile('house_photo')) {
            $validated['house_photo'] =
                $request->file('house_photo')->store('customers/houses', 'public');
        }

        if ($request->hasFile('cnic_front')) {
            $validated['cnic_front'] =
                $request->file('cnic_front')->store('customers/cnic', 'public');
        }

        if ($request->hasFile('cnic_back')) {
            $validated['cnic_back'] =
                $request->file('cnic_back')->store('customers/cnic', 'public');
        }

        Customer::create($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer Added Successfully');
    }

    public function ajaxStore(Request $request)
    {
        $validated = $request->validate([
            'branch_id'      => 'required|exists:branches,id',
            'name'           => 'required|string|max:255',
            'father_name'    => 'required|string|max:255',
            'cnic'           => 'required|string|max:20|unique:customers,cnic',
            'mobile'         => 'required|string|max:20',
            'address'        => 'required|string',
            'location'       => 'nullable|string|max:255',
            'latitude'       => 'nullable|numeric|between:-90,90',
            'longitude'      => 'nullable|numeric|between:-180,180',
            'customer_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'house_photo'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'cnic_front'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cnic_back'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'         => 'required|in:Active,Inactive',
        ]);

        if ($request->hasFile('customer_photo')) {
            $validated['customer_photo'] =
                $request->file('customer_photo')->store('customers/photos', 'public');
        }

        if ($request->hasFile('house_photo')) {
            $validated['house_photo'] =
                $request->file('house_photo')->store('customers/houses', 'public');
        }

        if ($request->hasFile('cnic_front')) {
            $validated['cnic_front'] =
                $request->file('cnic_front')->store('customers/cnic', 'public');
        }

        if ($request->hasFile('cnic_back')) {
            $validated['cnic_back'] =
                $request->file('cnic_back')->store('customers/cnic', 'public');
        }

        $customer = Customer::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Customer Added Successfully',
            'customer' => [
                'id'        => $customer->id,
                'name'      => $customer->name,
                'latitude'  => $customer->latitude,
                'longitude' => $customer->longitude,
            ],
        ]);
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
        $validated = $request->validate([
            'branch_id'      => 'required|exists:branches,id',
            'name'           => 'required|string|max:255',
            'father_name'    => 'required|string|max:255',
            'cnic'           => 'required|string|max:20|unique:customers,cnic,' . $customer->id,
            'mobile'         => 'required|string|max:20',
            'address'        => 'required|string',
            'location'       => 'nullable|string|max:255',
            'latitude'       => 'nullable|numeric|between:-90,90',
            'longitude'      => 'nullable|numeric|between:-180,180',
            'customer_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'house_photo'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'cnic_front'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cnic_back'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'         => 'required|in:Active,Inactive',
        ]);

        $files = [
            'customer_photo' => 'customers/photos',
            'house_photo'    => 'customers/houses',
            'cnic_front'    => 'customers/cnic',
            'cnic_back'     => 'customers/cnic',
        ];

        foreach ($files as $field => $directory) {

            if ($request->hasFile($field)) {

                if (!empty($customer->$field)) {
                    Storage::disk('public')->delete($customer->$field);
                }

                $validated[$field] =
                    $request->file($field)->store($directory, 'public');
            }
        }

        $customer->update($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer Updated Successfully');
    }

    public function destroy(Customer $customer)
    {
        $files = [
            'customer_photo',
            'house_photo',
            'cnic_front',
            'cnic_back',
        ];

        foreach ($files as $field) {

            if (!empty($customer->$field)) {
                Storage::disk('public')->delete($customer->$field);
            }
        }

        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer Deleted Successfully');
    }
}