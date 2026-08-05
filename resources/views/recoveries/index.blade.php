<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Recovery Management
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto px-4">

            <div class="flex justify-between mb-5">

                <h3 class="text-xl font-bold">
                    Recovery List
                </h3>

                <a href="{{ route('recoveries.create') }}"
                   class="bg-blue-600 text-white px-5 py-2 rounded-lg">

                    + New Recovery

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

                            <th class="p-3 text-left">
                                Invoice
                            </th>

                            <th class="p-3 text-left">
                                Customer
                            </th>

                            <th class="p-3 text-left">
                                Recovery Date
                            </th>

                            <th class="p-3 text-left">
                                Received
                            </th>

                            <th class="p-3 text-left">
                                Remaining
                            </th>

                            <th class="p-3 text-left">
                                Remarks
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($recoveries as $recovery)

                        <tr class="border-t">

                            <td class="p-3">

                                {{ $recovery->sale->invoice_no }}

                            </td>

                            <td class="p-3">

                                {{ $recovery->sale->customer->name }}

                            </td>

                            <td class="p-3">

                                {{ $recovery->recovery_date }}

                            </td>

                            <td class="p-3">

                                Rs. {{ number_format($recovery->amount_received,2) }}

                            </td>

                            <td class="p-3">

                                Rs. {{ number_format($recovery->remaining_balance,2) }}

                            </td>

                            <td class="p-3">

                                {{ $recovery->remarks }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="text-center p-5">

                                No Recoveries Found

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>