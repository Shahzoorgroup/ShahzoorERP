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

                <a
                    href="{{ route('customers.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                    + Add Customer

                </a>

            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="p-3 text-left">
                                    ID
                                </th>

                                <th class="p-3 text-left">
                                    Customer
                                </th>

                                <th class="p-3 text-left">
                                    Branch
                                </th>

                                <th class="p-3 text-left">
                                    Mobile
                                </th>

                                <th class="p-3 text-left">
                                    Location
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

                        @forelse($customers as $customer)

                            <tr class="border-t hover:bg-gray-50">

                                <td class="p-3">
                                    {{ $customer->id }}
                                </td>

                                <td class="p-3">

                                    <div class="font-semibold">
                                        {{ $customer->name }}
                                    </div>

                                    <div class="text-sm text-gray-500">
                                        {{ $customer->father_name }}
                                    </div>

                                </td>

                                <td class="p-3">
                                    {{ $customer->branch->name ?? 'N/A' }}
                                </td>

                                <td class="p-3">
                                    {{ $customer->mobile }}
                                </td>

                                <td class="p-3">

                                    @if($customer->latitude && $customer->longitude)

                                        <a
                                            href="https://www.google.com/maps?q={{ $customer->latitude }},{{ $customer->longitude }}"
                                            target="_blank"
                                            class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg text-sm">

                                            📍 View Map

                                        </a>

                                        <div class="text-xs text-gray-500 mt-1">

                                            {{ number_format($customer->latitude, 6) }},
                                            {{ number_format($customer->longitude, 6) }}

                                        </div>

                                    @elseif($customer->location)

                                        <span class="text-gray-700">
                                            {{ $customer->location }}
                                        </span>

                                    @else

                                        <span class="text-gray-400">
                                            No Location
                                        </span>

                                    @endif

                                </td>

                                <td class="p-3">

                                    @if($customer->status === 'Active')

                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                            Active
                                        </span>

                                    @else

                                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                                            Inactive
                                        </span>

                                    @endif

                                </td>

                                <td class="p-3">

                                    <div class="flex gap-2 justify-center">

                                        <a
                                            href="{{ route('customers.edit',$customer->id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">

                                            Edit

                                        </a>

                                        <form
                                            action="{{ route('customers.destroy',$customer->id) }}"
                                            method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                onclick="return confirm('Delete this customer?')"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">

                                                Delete

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="text-center p-5 text-gray-500">

                                    No Customer Found

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