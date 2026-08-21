<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">
                Roles Management
            </h2>

            <a href="{{ route('roles.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                + Add Role
            </a>
        </div>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg overflow-hidden">

                <table class="min-w-full">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="px-6 py-3 text-left">#</th>

                            <th class="px-6 py-3 text-left">Role Name</th>

                            <th class="px-6 py-3 text-left">Display Name</th>

                            <th class="px-6 py-3 text-left">Status</th>

                            <th class="px-6 py-3 text-center">Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($roles as $role)

                            <tr class="border-b">

                                <td class="px-6 py-4">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $role->name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $role->display_name }}
                                </td>

                                <td class="px-6 py-4">

                                    @if($role->status=='Active')

                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full">
                                            Active
                                        </span>

                                    @else

                                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full">
                                            Inactive
                                        </span>

                                    @endif

                                </td>

                                <td class="px-6 py-4 text-center">

                                    <a href="{{ route('roles.show',$role) }}"
                                       class="text-blue-600 mr-3">
                                        View
                                    </a>

                                    <a href="{{ route('roles.edit',$role) }}"
                                       class="text-yellow-600 mr-3">
                                        Edit
                                    </a>

                                    <form action="{{ route('roles.destroy',$role) }}"
                                          method="POST"
                                          class="inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Delete this role?')"
                                            class="text-red-600">

                                            Delete

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5"
                                    class="text-center py-8 text-gray-500">

                                    No roles found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-5">

                {{ $roles->links() }}

            </div>

        </div>

    </div>

</x-app-layout>