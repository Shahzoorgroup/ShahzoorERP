<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Create New Sale
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('sales.store') }}" method="POST">

                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                        <div>
                            <label class="font-semibold">Invoice No</label>

                            <input
                                type="text"
                                name="invoice_no"
                                value="{{ $invoiceNo }}"
                                readonly
                                class="w-full border rounded-lg mt-1">
                        </div>

                        <div>
                            <label class="font-semibold">Branch</label>

                            <select
                                name="branch_id"
                                class="w-full border rounded-lg mt-1">

                                <option value="">Select Branch</option>

                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">
                                        {{ $branch->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div>
                            <label class="font-semibold">Customer</label>

                            <select
                                name="customer_id"
                                class="w-full border rounded-lg mt-1">

                                <option value="">Select Customer</option>

                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">
                                        {{ $customer->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div>
                            <label class="font-semibold">Sale Date</label>

                            <input
                                type="date"
                                name="sale_date"
                                value="{{ date('Y-m-d') }}"
                                class="w-full border rounded-lg mt-1">
                        </div>

                    </div>

                    <hr class="my-6">

                    <h3 class="text-xl font-bold mb-4">
                        Products
                    </h3>

                    <table class="w-full border">

                        <thead class="bg-gray-100">

                            <tr>
                                <th class="p-2">Product</th>
                                <th class="p-2">Qty</th>
                                <th class="p-2">Price</th>
                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td class="p-2">

                                    <select
                                        name="product_id"
                                        class="w-full border rounded">

                                        <option value="">
                                            Select Product
                                        </option>

                                        @foreach($products as $product)

                                            <option value="{{ $product->id }}">
                                                {{ $product->name }}
                                            </option>

                                        @endforeach

                                    </select>

                                </td>

                                <td class="p-2">
                                    <input
                                        type="number"
                                        name="quantity"
                                        value="1"
                                        class="w-full border rounded">
                                </td>

                                <td class="p-2">
                                    <input
                                        type="number"
                                        name="price"
                                        class="w-full border rounded">
                                </td>

                            </tr>

                        </tbody>

                    </table>

                    <div class="mt-6">

                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg">

                            Save Sale

                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>