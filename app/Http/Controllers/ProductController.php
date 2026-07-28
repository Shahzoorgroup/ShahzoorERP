<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['branch', 'category'])->latest()->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $branches = Branch::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('products.create', compact('branches', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'company' => 'required|max:255',
            'model' => 'nullable|max:255',
            'barcode' => 'nullable|max:255|unique:products,barcode',
            'cost_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'minimum_sale_price' => 'required|numeric',
            'down_payment' => 'required|numeric',
            'installment_months' => 'required|integer',
            'monthly_installment' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'minimum_stock' => 'required|integer',
            'status' => 'required',
        ]);

        Product::create($request->all());

        return redirect()
            ->route('products.index')
            ->with('success', 'Product Added Successfully');
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        $branches = Branch::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('products.edit', compact('product', 'branches', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}