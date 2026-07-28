<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Edit Category
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('categories.update', $category) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Category Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $category->name) }}"
                            class="w-full border rounded-lg p-3">

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

                            <option value="Active" {{ $category->status == 'Active' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="Inactive" {{ $category->status == 'Inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>
                    </div>

                    <div class="flex gap-3">

                        <button
                            type="submit"
                            class="bg-green-600 text-white px-6 py-2 rounded-lg">
                            Update Category
                        </button>

                        <a
                            href="{{ route('categories.index') }}"
                            class="bg-gray-600 text-white px-6 py-2 rounded-lg">
                            Back
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>