<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Category Management
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">

            <div class="flex justify-between mb-5">
                <h3 class="text-xl font-bold">
                    Category List
                </h3>

                <a href="{{ route('categories.create') }}"
                   class="bg-blue-600 text-white px-5 py-2 rounded-lg">
                    + Add Category
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg overflow-hidden">

                <table class="w-full">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">ID</th>
                            <th class="p-3 text-left">Category Name</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($categories as $category)

                        <tr class="border-t">

                            <td class="p-3">{{ $category->id }}</td>
                            <td class="p-3">{{ $category->name }}</td>
                            <td class="p-3">{{ $category->status }}</td>

                            <td class="p-3">

                                <a href="{{ route('categories.edit', $category) }}"
                                   class="bg-yellow-500 text-white px-3 py-1 rounded">
                                    Edit
                                </a>

                                <form action="{{ route('categories.destroy', $category) }}"
                                      method="POST"
                                      class="inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Are you sure you want to delete this category?')"
                                        class="bg-red-600 text-white px-3 py-1 rounded">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="text-center p-5">
                                No Category Found
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>
</x-app-layout>