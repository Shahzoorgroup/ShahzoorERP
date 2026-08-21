<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Create New Role
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('roles.store') }}" method="POST">

                    @csrf

                    <div class="mb-4">

                        <label class="block font-semibold mb-2">
                            Role Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full border rounded-lg p-2"
                            required>

                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="mb-4">

                        <label class="block font-semibold mb-2">
                            Display Name
                        </label>

                        <input
                            type="text"
                            name="display_name"
                            value="{{ old('display_name') }}"
                            class="w-full border rounded-lg p-2"
                            required>

                        @error('display_name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="mb-4">

                        <label class="block font-semibold mb-2">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            class="w-full border rounded-lg p-2">{{ old('description') }}</textarea>

                    </div>

                    <div class="mb-6">

                        <label class="block font-semibold mb-2">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full border rounded-lg p-2">

                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>

                        </select>

                    </div>

                    <div class="flex gap-3">

                        <button
                            type="submit"
                            class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">

                            Save Role

                        </button>

                        <a
                            href="{{ route('roles.index') }}"
                            class="px-5 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>