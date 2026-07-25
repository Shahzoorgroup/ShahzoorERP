<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Customer Management
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between mb-5">

                <h3 class="text-xl font-bold">
                    Customer List
                </h3>

                <a href="{{ route('customers.create') }}"
                   class="bg-blue-600 text-white px-5 py-2 rounded-lg">
                    + Add Customer
                </a>

            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">

                <table class="w-full">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">ID</th>
                            <th class="p-3 text-left">Customer</th>
                            <th class="p-3 text-left">Branch</th>
                            <th class="p-3 text-left">Mobile</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($customers as $customer)

                        <tr class="border-t">

                            <td class="p-3">{{ $customer->id }}</td>
                            <td class="p-3">{{ $customer->name }}</td>
                            <td class="p-3">{{ $customer->branch->name }}</td>
                            <td class="p-3">{{ $customer->mobile }}</td>
                            <td class="p-3">{{ $customer->status }}</td>

                            <td class="p-3">

                                <div class="flex gap-2">

                                    <a href="{{ route('customers.edit',$customer->id) }}"
                                       class="bg-yellow-500 text-white px-3 py-1 rounded">
                                        Edit
                                    </a>

                                    <form action="{{ route('customers.destroy',$customer->id) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Delete this customer?')"
                                            class="bg-red-600 text-white px-3 py-1 rounded">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center p-5">
                                No Customer Found
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</x-app-layout>