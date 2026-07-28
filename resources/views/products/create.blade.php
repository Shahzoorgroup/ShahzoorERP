<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Add New Product
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto px-4">

            <div class="bg-white rounded-lg shadow p-6">

                <form action="{{ route('products.store') }}" method="POST">

                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class="font-semibold">Branch</label>

                            <select name="branch_id" class="w-full border rounded-lg p-3 mt-2">

                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">
                                        {{ $branch->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div>
                            <label class="font-semibold">Category</label>

                            <select name="category_id" class="w-full border rounded-lg p-3 mt-2">

                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div>
                            <label class="font-semibold">Product Name</label>
                            <input type="text" name="name" class="w-full border rounded-lg p-3 mt-2">
                        </div>

                        <div>
                            <label class="font-semibold">Company</label>
                            <input type="text" name="company" class="w-full border rounded-lg p-3 mt-2">
                        </div>

                        <div>
                            <label class="font-semibold">Model</label>
                            <input type="text" name="model" class="w-full border rounded-lg p-3 mt-2">
                        </div>

                        <div>
                            <label class="font-semibold">Barcode</label>
                            <input type="text" name="barcode" class="w-full border rounded-lg p-3 mt-2">
                        </div>

                        <div>
                            <label class="font-semibold">Purchase Price</label>
                            <input type="number" step="0.01" name="cost_price" class="w-full border rounded-lg p-3 mt-2">
                        </div>

                        <div>
                            <label class="font-semibold">Sale Price</label>
                            <input type="number" step="0.01" name="sale_price" class="w-full border rounded-lg p-3 mt-2">
                        </div>

                        <div>
                            <label class="font-semibold">Minimum Sale Price</label>
                            <input type="number" step="0.01" name="minimum_sale_price" class="w-full border rounded-lg p-3 mt-2">
                        </div>

                        <div>
                            <label class="font-semibold">Down Payment</label>
                            <input type="number" step="0.01" name="down_payment" class="w-full border rounded-lg p-3 mt-2">
                        </div>

                        <div>
                            <label class="font-semibold">Installment Months</label>
                            <input type="number" name="installment_months" class="w-full border rounded-lg p-3 mt-2">
                        </div>

                        <div>
                            <label class="font-semibold">Monthly Installment</label>
                            <input type="number" step="0.01" name="monthly_installment" class="w-full border rounded-lg p-3 mt-2">
                        </div>

                        <div>
                            <label class="font-semibold">Stock Quantity</label>
                            <input type="number" name="stock_quantity" class="w-full border rounded-lg p-3 mt-2">
                        </div>

                        <div>
                            <label class="font-semibold">Minimum Stock</label>
                            <input type="number" name="minimum_stock" class="w-full border rounded-lg p-3 mt-2">
                        </div>

                        <div>
                            <label class="font-semibold">Status</label>

                            <select name="status" class="w-full border rounded-lg p-3 mt-2">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>

                    </div>

                    <div class="mt-6">

                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg">
                            Save Product
                        </button>

                        <a href="{{ route('products.index') }}"
                            class="bg-gray-600 text-white px-6 py-3 rounded-lg ml-2">
                            Back
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>