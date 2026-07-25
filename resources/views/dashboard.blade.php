<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Shahzoor Group ERP Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <div class="bg-blue-600 text-white rounded-xl p-6 shadow">
                    <h3 class="text-lg font-bold">Total Customers</h3>
                    <p class="text-4xl mt-4">{{ $customers }}</p>
                </div>

                <div class="bg-green-600 text-white rounded-xl p-6 shadow">
                    <h3 class="text-lg font-bold">Total Products</h3>
                    <p class="text-4xl mt-4">{{ $products }}</p>
                </div>

                <div class="bg-red-600 text-white rounded-xl p-6 shadow">
                    <h3 class="text-lg font-bold">Today's Recovery</h3>
                    <p class="text-4xl mt-4">Rs. 0</p>
                </div>

                <div class="bg-yellow-500 text-white rounded-xl p-6 shadow">
                    <h3 class="text-lg font-bold">Today's Sales</h3>
                    <p class="text-4xl mt-4">0</p>
                </div>

                <div class="bg-purple-600 text-white rounded-xl p-6 shadow">
                    <h3 class="text-lg font-bold">Pending Installments</h3>
                    <p class="text-4xl mt-4">0</p>
                </div>

                <div class="bg-gray-700 text-white rounded-xl p-6 shadow">
                    <h3 class="text-lg font-bold">Branches</h3>
                    <p class="text-4xl mt-4">{{ $branches }}</p>
                </div>

            </div>

            <div class="mt-10 bg-white rounded-xl shadow p-6">

                <h3 class="text-xl font-bold mb-4">
                    Quick Menu
                </h3>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">

                    <a href="{{ route('customers.index') }}" class="bg-blue-600 text-white p-3 rounded-lg text-center">
                        Customers
                    </a>

                    <a href="#" class="bg-green-600 text-white p-3 rounded-lg text-center">
                        Products
                    </a>

                    <a href="#" class="bg-yellow-500 text-white p-3 rounded-lg text-center">
                        Sales
                    </a>

                    <a href="#" class="bg-red-600 text-white p-3 rounded-lg text-center">
                        Recovery
                    </a>

                    <a href="{{ route('branches.index') }}" class="bg-purple-600 text-white p-3 rounded-lg text-center">
                        Branches
                    </a>

                    <a href="#" class="bg-gray-700 text-white p-3 rounded-lg text-center">
                        Reports
                    </a>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>