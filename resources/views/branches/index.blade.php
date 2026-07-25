<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Branch Management
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between mb-5">
                <h3 class="text-xl font-bold">
                    Branch List
                </h3>

                <a href="{{ route('branches.create') }}"
                   class="bg-blue-600 text-white px-5 py-2 rounded-lg">
                    + Add Branch
                </a>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">

                <table class="w-full">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">ID</th>
                            <th class="p-3 text-left">Branch Name</th>
                            <th class="p-3 text-left">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($branches as $branch)

                        <tr class="border-t">

                            <td class="p-3">{{ $branch->id }}</td>

                            <td class="p-3">{{ $branch->name }}</td>

                            <td class="p-3">

                                <a href="{{ route('branches.edit', $branch->id) }}"
                                   class="bg-yellow-500 text-white px-3 py-1 rounded">
                                    Edit
                                </a>

                                <form action="{{ route('branches.destroy', $branch->id) }}"
                                      method="POST"
                                      style="display:inline;">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Delete this branch?')"
                                        class="bg-red-600 text-white px-3 py-1 rounded">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="3" class="text-center p-5">
                                No Branch Found
                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</x-app-layout>