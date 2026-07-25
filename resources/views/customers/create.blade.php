<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Add New Customer
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4">

            <div class="bg-white shadow rounded-lg p-6">

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('customers.store') }}" method="POST">

                    @csrf

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Branch
                        </label>

                        <select name="branch_id" class="w-full border rounded-lg p-3">

                            <option value="">Select Branch</option>

                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}">
                                    {{ $branch->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Customer Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="w-full border rounded-lg p-3"
                            placeholder="Enter Customer Name">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Father Name
                        </label>

                        <input
                            type="text"
                            name="father_name"
                            class="w-full border rounded-lg p-3"
                            placeholder="Enter Father Name">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            CNIC
                        </label>

                        <input
                            type="text"
                            name="cnic"
                            class="w-full border rounded-lg p-3"
                            placeholder="35202xxxxxxxxx">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Mobile Number
                        </label>

                        <input
                            type="text"
                            name="mobile"
                            class="w-full border rounded-lg p-3"
                            placeholder="03XXXXXXXXX">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Address
                        </label>

                        <textarea
                            name="address"
                            rows="3"
                            class="w-full border rounded-lg p-3"
                            placeholder="Enter Address"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Status
                        </label>

                        <select name="status" class="w-full border rounded-lg p-3">
                            <option value="Active">Active</option>
                            <option value="Closed">Closed</option>
                            <option value="Defaulter">Defaulter</option>
                        </select>
                    </div>

                    <div class="flex gap-3">

                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg">
                            Save Customer
                        </button>

                        <a
                            href="{{ route('customers.index') }}"
                            class="bg-gray-600 text-white px-6 py-2 rounded-lg">
                            Back
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>