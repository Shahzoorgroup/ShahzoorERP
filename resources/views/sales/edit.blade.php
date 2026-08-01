<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Edit Sale
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto px-4">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('sales.update',$sale->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                        <div>

                            <label class="font-semibold">
                                Invoice No
                            </label>

                            <input
                                type="text"
                                value="{{ $sale->invoice_no }}"
                                readonly
                                class="w-full border rounded-lg mt-1">

                        </div>

                        <div>

                            <label class="font-semibold">
                                Branch
                            </label>

                            <select
                                name="branch_id"
                                class="w-full border rounded-lg mt-1"
                                required>

                                @foreach($branches as $branch)

                                    <option
                                        value="{{ $branch->id }}"
                                        {{ $sale->branch_id==$branch->id?'selected':'' }}>

                                        {{ $branch->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            <label class="font-semibold">
                                Customer
                            </label>

                            <select
                                name="customer_id"
                                class="w-full border rounded-lg mt-1"
                                required>

                                @foreach($customers as $customer)

                                    <option
                                        value="{{ $customer->id }}"
                                        {{ $sale->customer_id==$customer->id?'selected':'' }}>

                                        {{ $customer->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            <label class="font-semibold">
                                Sale Date
                            </label>

                            <input
                                type="date"
                                name="sale_date"
                                value="{{ $sale->sale_date }}"
                                class="w-full border rounded-lg mt-1"
                                required>

                        </div>

                    </div>

                    <hr class="my-6">

                    <table
                        class="w-full border"
                        id="productsTable">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="p-2">Product</th>
                                <th class="p-2">Qty</th>
                                <th class="p-2">Price</th>
                                <th class="p-2">Total</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($sale->saleItems as $item)

                            <tr>

                                <td class="p-2">

                                    <select
                                        name="product_id[]"
                                        class="w-full border rounded">

                                        @foreach($products as $product)

                                            <option
                                                value="{{ $product->id }}"
                                                {{ $item->product_id==$product->id?'selected':'' }}>

                                                {{ $product->name }}

                                            </option>

                                        @endforeach

                                    </select>

                                </td>

                                <td class="p-2">

                                    <input
                                        type="number"
                                        name="quantity[]"
                                        value="{{ $item->quantity }}"
                                        class="w-full border rounded quantity">

                                </td>

                                <td class="p-2">

                                    <input
                                        type="number"
                                        name="price[]"
                                        value="{{ $item->unit_price }}"
                                        class="w-full border rounded price">

                                </td>

                                <td class="p-2">

                                    <input
                                        type="text"
                                        value="{{ $item->total_price }}"
                                        class="w-full border rounded total"
                                        readonly>

                                </td>

                            </tr>

                            @endforeach
							                        </tbody>

                    </table>

                    <div class="mt-6 text-right">

                        <h2 class="text-2xl font-bold">

                            Grand Total :
                            Rs.
                            <span id="grandTotal">
                                {{ number_format($sale->total_amount,2) }}
                            </span>

                        </h2>

                    </div>

                    <div class="mt-6 flex gap-3">

                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg">

                            Update Sale

                        </button>

                        <a
                            href="{{ route('sales.index') }}"
                            class="bg-gray-600 text-white px-6 py-2 rounded-lg">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

<script>

function calculateTotals(){

    let grand = 0;

    document.querySelectorAll("#productsTable tbody tr").forEach(function(row){

        let qty = parseFloat(row.querySelector(".quantity").value) || 0;

        let price = parseFloat(row.querySelector(".price").value) || 0;

        let total = qty * price;

        row.querySelector(".total").value = total.toFixed(2);

        grand += total;

    });

    document.getElementById("grandTotal").innerText = grand.toFixed(2);

}

document.addEventListener("input",function(e){

    if(
        e.target.classList.contains("quantity") ||
        e.target.classList.contains("price")
    ){

        calculateTotals();

    }

});

calculateTotals();

</script>

</x-app-layout>