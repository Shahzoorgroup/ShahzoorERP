<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">
                User Management
            </h2>

            <a href="{{ route('users.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded">
                + Add User
            </a>
        </div>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg overflow-hidden">

                <table class="min-w-full">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left">ID</th>
                            <th class="px-4 py-3 text-left">Name</th>
                            <th class="px-4 py-3 text-left">Email</th>
                            <th class="px-4 py-3 text-left">Role ID</th>
                            <th class="px-4 py-3 text-left">Role</th>
                            <th class="px-4 py-3 text-left">Branch</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($users as $user)

                            <tr class="border-b">

                                <td class="px-4 py-3">{{ $user->id }}</td>

                                <td class="px-4 py-3">{{ $user->name }}</td>

                                <td class="px-4 py-3">{{ $user->email }}</td>

                                <td class="px-4 py-3">
                                    {{ $user->role_id }}
                                </td>

                                <td class="px-4 py-3">
                                    @if($user->role)
                                        {{ $user->role->display_name }}
                                    @else
                                        No Role
                                    @endif
                                </td>

                                <td class="px-4 py-3">
                                    {{ optional($user->branch)->name }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $user->status }}
                                </td>

                                <td class="px-4 py-3 text-center">

                                    <a href="{{ route('users.edit',$user) }}">
                                        Edit
                                    </a>

                                    |

                                    <form action="{{ route('users.destroy',$user) }}"
                                          method="POST"
                                          class="inline">

                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Delete User?')">
                                            Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    No Users Found
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-4">
                {{ $users->links() }}
            </div>

        </div>

    </div>

</x-app-layout>