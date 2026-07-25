<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::latest()->get();

        return view('branches.index', compact('branches'));
    }

    public function create()
    {
        return view('branches.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:branches,name|max:255',
        ]);

        Branch::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('branches.index')
            ->with('success', 'Branch Added Successfully');
    }

    public function show(Branch $branch)
    {
        //
    }

    public function edit(Branch $branch)
    {
        return view('branches.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name' => 'required|max:255|unique:branches,name,' . $branch->id,
        ]);

        $branch->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('branches.index')
            ->with('success', 'Branch Updated Successfully');
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();

        return redirect()
            ->route('branches.index')
            ->with('success', 'Branch Deleted Successfully');
    }
}