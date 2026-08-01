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

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                        <div>

                            <label class="font-semibold">
                                Invoice No
                            </label>

                            <input
                                type="text"
                                name="invoice_no"
                                value="{{ $invoiceNo }}"
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

                                <option value="">
                                    Select Branch
                                </option>

                                @foreach($branches as $branch)

                                    <option value="{{ $branch->id }}">
                                        {{ $branch->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            <div class="flex justify-between items-center">

                                <label class="font-semibold">
                                    Customer
                                </label>

                                <button
                                    type="button"
                                    id="openCustomerModal"
                                    class="text-blue-600 text-sm font-bold">

                                    + New Customer

                                </button>

                            </div>

                            <select
                                id="customer_id"
                                name="customer_id"
                                class="w-full border rounded-lg mt-1"
                                required>

                                <option value="">
                                    Select Customer
                                </option>

                                @foreach($customers as $customer)

                                    <option value="{{ $customer->id }}">
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
                                value="{{ date('Y-m-d') }}"
                                class="w-full border rounded-lg mt-1"
                                required>

                        </div>

                    </div>

                    <hr class="my-6">

                    <div class="flex justify-between mb-4">

                        <h3 class="text-xl font-bold">
                            Products
                        </h3>

                        <button
                            type="button"
                            id="addRow"
                            class="bg-green-600 text-white px-4 py-2 rounded-lg">

                            + Add Product

                        </button>

                    </div>

                    <table
                        class="w-full border"
                        id="productsTable">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="p-2">
                                    Product
                                </th>

                                <th class="p-2">
                                    Qty
                                </th>

                                <th class="p-2">
                                    Price
                                </th>

                                <th class="p-2">
                                    Total
                                </th>

                                <th class="p-2">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td class="p-2">

                                    <select
                                        name="product_id[]"
                                        class="w-full border rounded product">

                                        <option value="">
                                            Select Product
                                        </option>

                                        @foreach($products as $product)

                                            <option
                                                value="{{ $product->id }}"
                                                data-price="{{ $product->sale_price }}">

                                                {{ $product->name }}

                                            </option>

                                        @endforeach

                                    </select>

                                </td>

                                <td class="p-2">

                                    <input
                                        type="number"
                                        name="quantity[]"
                                        value="1"
                                        class="w-full border rounded quantity">

                                </td>

                                <td class="p-2">

                                    <input
                                        type="number"
                                        name="price[]"
                                        class="w-full border rounded price">

                                </td>

                                <td class="p-2">

                                    <input
                                        type="text"
                                        class="w-full border rounded total"
                                        value="0"
                                        readonly>

                                </td>

                                <td class="p-2">

                                    <button
                                        type="button"
                                        class="bg-red-600 text-white px-3 py-1 rounded removeRow">

                                        Delete

                                    </button>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                    <div class="mt-6 text-right">

                        <h2 class="text-2xl font-bold">

                            Grand Total :
                            Rs.
                            <span id="grandTotal">
                                0
                            </span>

                        </h2>

                    </div>

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
	    <div
        id="customerModal"
        class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

        <div class="bg-white rounded-lg shadow-xl w-full max-w-3xl p-6">

            <div class="flex justify-between items-center mb-5">

                <h2 class="text-2xl font-bold">
                    Add New Customer
                </h2>

                <button
                    type="button"
                    id="closeCustomerModal"
                    class="text-red-600 text-xl">

                    ✕

                </button>

            </div>

            <form id="customerForm">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>

                        <label class="font-semibold">
                            Branch
                        </label>

                        <select
                            name="branch_id"
                            class="w-full border rounded-lg">

                            @foreach($branches as $branch)

                                <option value="{{ $branch->id }}">
                                    {{ $branch->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        <label class="font-semibold">
                            Customer Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="w-full border rounded-lg">

                    </div>

                    <div>

                        <label class="font-semibold">
                            Father Name
                        </label>

                        <input
                            type="text"
                            name="father_name"
                            class="w-full border rounded-lg">

                    </div>

                    <div>

                        <label class="font-semibold">
                            CNIC
                        </label>

                        <input
                            type="text"
                            name="cnic"
                            class="w-full border rounded-lg">

                    </div>

                    <div>

                        <label class="font-semibold">
                            Mobile
                        </label>

                        <input
                            type="text"
                            name="mobile"
                            class="w-full border rounded-lg">

                    </div>

                    <div>

                        <label class="font-semibold">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full border rounded-lg">

                            <option value="Active">
                                Active
                            </option>

                            <option value="Inactive">
                                Inactive
                            </option>

                        </select>

                    </div>

                    <div class="md:col-span-2">

                        <label class="font-semibold">
                            Address
                        </label>

                        <textarea
                            name="address"
                            rows="3"
                            class="w-full border rounded-lg"></textarea>

                    </div>

                </div>

                <div class="flex justify-end gap-3 mt-6">

                    <button
                        type="button"
                        id="closeCustomerModal2"
                        class="bg-gray-500 text-white px-5 py-2 rounded-lg">

                        Cancel

                    </button>

                    <button
                        type="button"
                        id="saveCustomer"
                        class="bg-blue-600 text-white px-5 py-2 rounded-lg">

                        Save Customer

                    </button>

                </div>

            </form>

        </div>

    </div>
	<script>

function calculateTotals(){

    let grand=0;

    document.querySelectorAll("#productsTable tbody tr").forEach(function(row){

        let qty=parseFloat(row.querySelector(".quantity").value)||0;

        let price=parseFloat(row.querySelector(".price").value)||0;

        let total=qty*price;

        row.querySelector(".total").value=total;

        grand+=total;

    });

    document.getElementById("grandTotal").innerText=grand;

}

document.addEventListener("change",function(e){

    if(e.target.classList.contains("product")){

        let price=e.target.options[e.target.selectedIndex].dataset.price;

        e.target.closest("tr").querySelector(".price").value=price;

        calculateTotals();

    }

});

document.addEventListener("input",function(e){

    if(e.target.classList.contains("quantity") || e.target.classList.contains("price")){

        calculateTotals();

    }

});

document.getElementById("addRow").addEventListener("click",function(){

    let tbody=document.querySelector("#productsTable tbody");

    let row=tbody.rows[0].cloneNode(true);

    row.querySelectorAll("input").forEach(function(input){

        if(input.classList.contains("quantity")){

            input.value=1;

        }else{

            input.value="";

        }

    });

    row.querySelector(".total").value=0;

    row.querySelector("select").selectedIndex=0;

    tbody.appendChild(row);

});

document.addEventListener("click",function(e){

    if(e.target.classList.contains("removeRow")){

        let rows=document.querySelectorAll("#productsTable tbody tr");

        if(rows.length>1){

            e.target.closest("tr").remove();

            calculateTotals();

        }

    }

});

const modal=document.getElementById("customerModal");

document.getElementById("openCustomerModal").addEventListener("click",function(){

    modal.classList.remove("hidden");
    modal.classList.add("flex");

});

document.getElementById("closeCustomerModal").addEventListener("click",function(){

    modal.classList.remove("flex");
    modal.classList.add("hidden");

});

document.getElementById("closeCustomerModal2").addEventListener("click",function(){

    modal.classList.remove("flex");
    modal.classList.add("hidden");

});

calculateTotals();
document.getElementById("saveCustomer").addEventListener("click", function () {

    let form = document.getElementById("customerForm");

    let formData = new FormData(form);

    fetch("{{ route('customers.ajaxStore') }}", {

        method: "POST",

        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
            "Accept": "application/json"
        },

        body: formData

    })

    .then(response => response.json())

    .then(data => {

        if (data.success) {

            let customerSelect = document.getElementById("customer_id");

            let option = document.createElement("option");

            option.value = data.customer.id;

            option.text = data.customer.name;

            option.selected = true;

            customerSelect.appendChild(option);

            form.reset();

            modal.classList.remove("flex");

            modal.classList.add("hidden");

            alert(data.message);

        } else {

            alert("Customer save failed.");

        }

    })

    .catch(error => {

        console.log(error);

        alert("Something went wrong.");

    });

});

</script>

</x-app-layout>