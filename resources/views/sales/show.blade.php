<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-2xl">
            Sale Details
        </h2>

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto px-4">

            <div class="bg-white rounded-lg shadow p-6">

                <div class="flex justify-between mb-6">

                    <h2 class="text-2xl font-bold">

                        Invoice
                        {{ $sale->invoice_no }}

                    </h2>

                    <a href="{{ route('sales.index') }}"
                       class="bg-gray-600 text-white px-4 py-2 rounded">

                        Back

                    </a>

                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">

                    <div>

                        <strong>Customer</strong>

                        <br>

                        {{ $sale->customer->name }}

                    </div>

                    <div>

                        <strong>Branch</strong>

                        <br>

                        {{ $sale->branch->name }}

                    </div>

                    <div>

                        <strong>Sale Date</strong>

                        <br>

                        {{ $sale->sale_date }}

                    </div>

                    <div>

                        <strong>Status</strong>

                        <br>

                        {{ $sale->status }}

                    </div>

                    <div>

                        <strong>Total Amount</strong>

                        <br>

                        Rs. {{ number_format($sale->total_amount,2) }}

                    </div>

                </div>

                <hr class="my-6">

                <h3 class="text-xl font-bold mb-4">

                    Products

                </h3>

                <table class="w-full border">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="p-3 text-left">
                                Product
                            </th>

                            <th class="p-3 text-center">
                                Qty
                            </th>

                            <th class="p-3 text-right">
                                Unit Price
                            </th>

                            <th class="p-3 text-right">
                                Total
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($sale->saleItems as $item)

                        <tr class="border-t">

                            <td class="p-3">

                                {{ $item->product->name }}

                            </td>

                            <td class="p-3 text-center">

                                {{ $item->quantity }}

                            </td>

                            <td class="p-3 text-right">

                                Rs. {{ number_format($item->unit_price,2) }}

                            </td>

                            <td class="p-3 text-right">

                                Rs. {{ number_format($item->total_price,2) }}

                            </td>

                        </tr>

                        @endforeach
						                    </tbody>

                    <tfoot>

                        <tr class="border-t bg-gray-100">

                            <th colspan="3" class="p-3 text-right">

                                Grand Total

                            </th>

                            <th class="p-3 text-right">

                                Rs. {{ number_format($sale->total_amount,2) }}

                            </th>

                        </tr>

                    </tfoot>

                </table>

                <div class="mt-8 flex gap-3">

                    <a href="{{ route('sales.edit',$sale->id) }}"
                       class="bg-yellow-500 text-white px-5 py-2 rounded">

                        Edit Sale

                    </a>

                    <a href="{{ route('sales.index') }}"
                       class="bg-gray-600 text-white px-5 py-2 rounded">

                        Back To Sales

                    </a>

                    <button
                        onclick="window.print()"
                        class="bg-blue-600 text-white px-5 py-2 rounded">

                        Print Invoice

                    </button>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>