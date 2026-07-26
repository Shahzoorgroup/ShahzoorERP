<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Add New Category
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('categories.store') }}" method="POST">

                    @csrf

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Category Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="w-full border rounded-lg p-3"
                            placeholder="Enter Category Name">

                        @error('name')
                            <p class="text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full border rounded-lg p-3">

                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>

                        </select>
                    </div>

                    <div class="flex gap-3">

                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg">
                            Save Category
                        </button>

                        <a
                            href="{{ route('categories.index') }}"
                            class="bg-gray-500 text-white px-6 py-2 rounded-lg">
                            Back
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>