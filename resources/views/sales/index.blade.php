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

                <a
                    href="{{ route('sales.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                    + New Sale

                </a>

            </div>


            @if(session('success'))

                <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">

                    {{ session('success') }}

                </div>

            @endif


            @if(session('error'))

                <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">

                    {{ session('error') }}

                </div>

            @endif


            <div class="bg-white shadow rounded-lg overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="p-3 text-left">
                                    Invoice
                                </th>

                                <th class="p-3 text-left">
                                    Customer
                                </th>

                                <th class="p-3 text-left">
                                    Branch
                                </th>

                                <th class="p-3 text-left">
                                    Date
                                </th>

                                <th class="p-3 text-left">
                                    Amount
                                </th>

                                <th class="p-3 text-left">
                                    Approval
                                </th>

                                <th class="p-3 text-left">
                                    Status
                                </th>

                                <th class="p-3 text-center">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($sales as $sale)

                                <tr class="border-t hover:bg-gray-50">

                                    <td class="p-3 font-semibold">

                                        {{ $sale->invoice_no }}

                                    </td>


                                    <td class="p-3">

                                        {{ $sale->customer->name ?? '-' }}

                                    </td>


                                    <td class="p-3">

                                        {{ $sale->branch->name ?? '-' }}

                                    </td>


                                    <td class="p-3">

                                        {{ $sale->sale_date }}

                                    </td>


                                    <td class="p-3 font-semibold">

                                        Rs.
                                        {{ number_format($sale->total_amount, 2) }}

                                    </td>


                                    <td class="p-3">

                                        @if($sale->approval_status === 'Pending')

                                            <span
                                                class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">

                                                Pending

                                            </span>

                                        @elseif($sale->approval_status === 'Approved')

                                            <span
                                                class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">

                                                Approved

                                            </span>

                                        @elseif($sale->approval_status === 'Rejected')

                                            <span
                                                class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">

                                                Rejected

                                            </span>

                                        @else

                                            <span
                                                class="inline-block bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">

                                                {{ $sale->approval_status ?? 'Unknown' }}

                                            </span>

                                        @endif

                                    </td>


                                    <td class="p-3">

                                        @if($sale->status === 'Running')

                                            <span
                                                class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">

                                                Running

                                            </span>

                                        @elseif($sale->status === 'Completed')

                                            <span
                                                class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">

                                                Completed

                                            </span>

                                        @else

                                            <span
                                                class="inline-block bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">

                                                {{ $sale->status }}

                                            </span>

                                        @endif

                                    </td>


                                    <td class="p-3">

                                        <div class="flex gap-2 justify-center flex-wrap">


                                            <a
                                                href="{{ route('sales.show', $sale->id) }}"
                                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">

                                                View

                                            </a>


                                            @if($sale->approval_status === 'Pending')

                                                <form
                                                    action="{{ route('sales.approve', $sale->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to approve this sale?')">

                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">

                                                        Approve

                                                    </button>

                                                </form>


                                                <form
                                                    action="{{ route('sales.reject', $sale->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to reject this sale?')">

                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="bg-orange-600 hover:bg-orange-700 text-white px-3 py-1 rounded">

                                                        Reject

                                                    </button>

                                                </form>

                                            @endif


                                            <a
                                                href="{{ route('sales.edit', $sale->id) }}"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">

                                                Edit

                                            </a>


                                            <form
                                                action="{{ route('sales.destroy', $sale->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Delete this sale?')">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">

                                                    Delete

                                                </button>

                                            </form>


                                            <a
                                                href="#"
                                                class="bg-gray-700 hover:bg-gray-800 text-white px-3 py-1 rounded">

                                                Print

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="8"
                                        class="text-center p-6 text-gray-500">

                                        No Sales Found

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>