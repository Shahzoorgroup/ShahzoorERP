<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Sales Management
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">

            <div class="flex justify-between mb-5">
                <h3 class="text-xl font-bold">
                    Sales List
                </h3>

                <a href="{{ route('sales.create') }}"
                   class="bg-blue-600 text-white px-5 py-2 rounded-lg">
                    + New Sale
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg overflow-hidden">

                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Invoice</th>
                            <th class="p-3 text-left">Customer</th>
                            <th class="p-3 text-left">Branch</th>
                            <th class="p-3 text-left">Date</th>
                            <th class="p-3 text-left">Amount</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($sales as $sale)

                        <tr class="border-t">

                            <td class="p-3">{{ $sale->invoice_no }}</td>

                            <td class="p-3">
                                {{ $sale->customer->name ?? '-' }}
                            </td>

                            <td class="p-3">
                                {{ $sale->branch->name ?? '-' }}
                            </td>

                            <td class="p-3">
                                {{ $sale->sale_date }}
                            </td>

                            <td class="p-3">
                                Rs. {{ number_format($sale->total_amount,2) }}
                            </td>

                            <td class="p-3">
                                {{ $sale->status }}
                            </td>

                            <td class="p-3">

                                <div class="flex gap-2 justify-center">

                                    <a href="{{ route('sales.show',$sale->id) }}"
                                       class="bg-green-600 text-white px-3 py-1 rounded">
                                        View
                                    </a>

                                    <a href="{{ route('sales.edit',$sale->id) }}"
                                       class="bg-yellow-500 text-white px-3 py-1 rounded">
                                        Edit
                                    </a>

                                    <form action="{{ route('sales.destroy',$sale->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this sale?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="bg-red-600 text-white px-3 py-1 rounded">

                                            Delete

                                        </button>

                                    </form>

                                    <a href="#"
                                       class="bg-blue-600 text-white px-3 py-1 rounded">
                                        Print
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center p-5">

                                No Sales Found

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>
</x-app-layout>