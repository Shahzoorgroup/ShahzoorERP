<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Product Management
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">

            <div class="flex justify-between mb-5">

                <h3 class="text-xl font-bold">
                    Product List
                </h3>

                <a href="{{ route('products.create') }}"
                   class="bg-blue-600 text-white px-5 py-2 rounded-lg">
                    + Add Product
                </a>

            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-100">

                        <tr>
                            <th class="p-3 text-left">ID</th>
                            <th class="p-3 text-left">Branch</th>
                            <th class="p-3 text-left">Category</th>
                            <th class="p-3 text-left">Product</th>
                            <th class="p-3 text-left">Sale Price</th>
                            <th class="p-3 text-left">Stock</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                    @forelse($products as $product)

                        <tr class="border-t">

                            <td class="p-3">{{ $product->id }}</td>
                            <td class="p-3">{{ $product->branch->name }}</td>
                            <td class="p-3">{{ $product->category->name }}</td>
                            <td class="p-3">{{ $product->name }}</td>
                            <td class="p-3">Rs. {{ number_format($product->sale_price, 2) }}</td>
                            <td class="p-3">{{ $product->stock_quantity }}</td>
                            <td class="p-3">{{ $product->status }}</td>

                            <td class="p-3">

                                <a href="{{ route('products.edit', $product) }}"
                                   class="bg-yellow-500 text-white px-3 py-1 rounded">
                                    Edit
                                </a>

                                <form action="{{ route('products.destroy', $product) }}"
                                      method="POST"
                                      class="inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Delete this product?')"
                                        class="bg-red-600 text-white px-3 py-1 rounded">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center p-5">
                                No Products Found
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>
</x-app-layout>