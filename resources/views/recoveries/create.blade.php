<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Add Recovery
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto px-4">

            <div class="bg-white shadow rounded-lg p-6">

                @if($errors->any())

                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">

                        <ul>

                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif

                <form action="{{ route('recoveries.store') }}" method="POST">

                    @csrf

                    <div class="mb-4">

                        <label class="font-semibold">
                            Select Sale
                        </label>

                        <select
                            name="sale_id"
                            id="sale_id"
                            class="w-full border rounded-lg mt-1"
                            required>

                            <option value="">
                                Select Invoice
                            </option>

                            @foreach($sales as $sale)

                                <option
                                    value="{{ $sale->id }}">

                                    {{ $sale->invoice_no }}
                                    |
                                    {{ $sale->customer->name }}
                                    |
                                    Balance:
                                    Rs. {{ number_format($sale->remaining_amount,2) }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-4">

                        <label class="font-semibold">
                            Recovery Date
                        </label>

                        <input
                            type="date"
                            name="recovery_date"
                            value="{{ date('Y-m-d') }}"
                            class="w-full border rounded-lg mt-1"
                            required>

                    </div>

                    <div class="mb-4">

                        <label class="font-semibold">
                            Received Amount
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="amount_received"
                            class="w-full border rounded-lg mt-1"
                            required>

                    </div>

                    <div class="mb-4">

                        <label class="font-semibold">
                            Remarks
                        </label>

                        <textarea
                            name="remarks"
                            rows="3"
                            class="w-full border rounded-lg mt-1"></textarea>

                    </div>

                    <div class="mt-6">

                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg">

                            Save Recovery

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>