<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Add New User
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto">

            @if ($errors->any())

                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('users.store') }}" method="POST">

                    @csrf

                    <div class="grid grid-cols-2 gap-4">

                        <div>

                            <label>Name</label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                class="w-full border rounded mt-1">

                        </div>

                        <div>

                            <label>Email</label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="w-full border rounded mt-1">

                        </div>

                        <div>

                            <label>Password</label>

                            <input
                                type="password"
                                name="password"
                                class="w-full border rounded mt-1">

                        </div>

                        <div>

                            <label>Confirm Password</label>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="w-full border rounded mt-1">

                        </div>

                        <div>

                            <label>Mobile</label>

                            <input
                                type="text"
                                name="mobile"
                                value="{{ old('mobile') }}"
                                class="w-full border rounded mt-1">

                        </div>

                        <div>

                            <label>Designation</label>

                            <input
                                type="text"
                                name="designation"
                                value="{{ old('designation') }}"
                                class="w-full border rounded mt-1">

                        </div>

                        <div>

                            <label>Branch</label>

                            <select
                                name="branch_id"
                                class="w-full border rounded mt-1">

                                <option value="">Select Branch</option>

                                @foreach($branches as $branch)

                                    <option
                                        value="{{ $branch->id }}">

                                        {{ $branch->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            <label>Role</label>

                            <select
                                name="role_id"
                                class="w-full border rounded mt-1">

                                @foreach($roles as $role)

                                    <option
                                        value="{{ $role->id }}">

                                        {{ $role->display_name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            <label>Status</label>

                            <select
                                name="status"
                                class="w-full border rounded mt-1">

                                <option value="Active">
                                    Active
                                </option>

                                <option value="Inactive">
                                    Inactive
                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="mt-6">

                        <button
                            class="bg-blue-600 text-white px-5 py-2 rounded">

                            Save User

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>