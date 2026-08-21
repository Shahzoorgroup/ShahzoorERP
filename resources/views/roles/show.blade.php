<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Role Details
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <div class="mb-5">
                    <h3 class="text-sm text-gray-500">Role Name</h3>
                    <p class="text-lg font-semibold">{{ $role->name }}</p>
                </div>

                <div class="mb-5">
                    <h3 class="text-sm text-gray-500">Display Name</h3>
                    <p class="text-lg">{{ $role->display_name }}</p>
                </div>

                <div class="mb-5">
                    <h3 class="text-sm text-gray-500">Description</h3>
                    <p>{{ $role->description ?: 'No description available.' }}</p>
                </div>

                <div class="mb-6">
                    <h3 class="text-sm text-gray-500">Status</h3>

                    @if($role->status == 'Active')
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full">
                            Active
                        </span>
                    @else
                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full">
                            Inactive
                        </span>
                    @endif
                </div>

                <a href="{{ route('roles.index') }}"
                   class="inline-block px-5 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                    Back to Roles
                </a>

            </div>

        </div>

    </div>

</x-app-layout>