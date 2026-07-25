<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Edit Customer
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('customers.update', $customer->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">Branch</label>

                        <select name="branch_id" class="w-full border rounded-lg p-3">
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}"
                                    {{ $customer->branch_id == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">Customer Name</label>

                        <input type="text"
                               name="name"
                               value="{{ $customer->name }}"
                               class="w-full border rounded-lg p-3">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">Father Name</label>

                        <input type="text"
                               name="father_name"
                               value="{{ $customer->father_name }}"
                               class="w-full border rounded-lg p-3">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">CNIC</label>

                        <input type="text"
                               name="cnic"
                               value="{{ $customer->cnic }}"
                               class="w-full border rounded-lg p-3">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">Mobile</label>

                        <input type="text"
                               name="mobile"
                               value="{{ $customer->mobile }}"
                               class="w-full border rounded-lg p-3">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">Address</label>

                        <textarea name="address"
                                  class="w-full border rounded-lg p-3"
                                  rows="3">{{ $customer->address }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">Status</label>

                        <select name="status" class="w-full border rounded-lg p-3">

                            <option value="Active" {{ $customer->status == 'Active' ? 'selected' : '' }}>Active</option>

                            <option value="Closed" {{ $customer->status == 'Closed' ? 'selected' : '' }}>Closed</option>

                            <option value="Defaulter" {{ $customer->status == 'Defaulter' ? 'selected' : '' }}>Defaulter</option>

                        </select>
                    </div>

                    <button class="bg-blue-600 text-white px-6 py-2 rounded-lg">
                        Update Customer
                    </button>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>