<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Add New Branch
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4">

            <div class="bg-white shadow rounded-lg p-6">

                <form action="{{ route('branches.store') }}" method="POST">

                    @csrf

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">
                            Branch Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="w-full border rounded-lg p-3"
                            placeholder="Enter Branch Name"
                        >
                    </div>

                    <div class="flex gap-3">

                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg">
                            Save Branch
                        </button>

                        <a
                            href="{{ route('branches.index') }}"
                            class="bg-gray-500 text-white px-6 py-2 rounded-lg">
                            Back
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>