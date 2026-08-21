<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Edit Customer
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-5xl mx-auto px-4">

            <div class="bg-white shadow rounded-lg p-6">

                @if ($errors->any())

                    <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">

                        <ul class="list-disc ml-5">

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif

                <form
                    action="{{ route('customers.update', $customer->id) }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <h3 class="text-lg font-bold mb-4">
                        Customer Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>

                            <label class="block font-semibold mb-2">
                                Branch
                            </label>

                            <select
                                name="branch_id"
                                class="w-full border rounded-lg p-3"
                                required>

                                @foreach($branches as $branch)

                                    <option
                                        value="{{ $branch->id }}"
                                        {{ $customer->branch_id == $branch->id ? 'selected' : '' }}>

                                        {{ $branch->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            <label class="block font-semibold mb-2">
                                Customer Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $customer->name) }}"
                                class="w-full border rounded-lg p-3"
                                required>

                        </div>

                        <div>

                            <label class="block font-semibold mb-2">
                                Father Name
                            </label>

                            <input
                                type="text"
                                name="father_name"
                                value="{{ old('father_name', $customer->father_name) }}"
                                class="w-full border rounded-lg p-3"
                                required>

                        </div>

                        <div>

                            <label class="block font-semibold mb-2">
                                CNIC
                            </label>

                            <input
                                type="text"
                                name="cnic"
                                value="{{ old('cnic', $customer->cnic) }}"
                                class="w-full border rounded-lg p-3"
                                required>

                        </div>

                        <div>

                            <label class="block font-semibold mb-2">
                                Mobile Number
                            </label>

                            <input
                                type="text"
                                name="mobile"
                                value="{{ old('mobile', $customer->mobile) }}"
                                class="w-full border rounded-lg p-3"
                                required>

                        </div>

                        <div>

                            <label class="block font-semibold mb-2">
                                Customer Location
                            </label>

                            <div class="flex gap-2">

                                <input
                                    type="text"
                                    id="location"
                                    name="location"
                                    value="{{ old('location', $customer->location) }}"
                                    class="w-full border rounded-lg p-3"
                                    placeholder="Customer location">

                                <button
                                    type="button"
                                    id="getLocation"
                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg whitespace-nowrap">

                                    📍 Get Location

                                </button>

                            </div>

                            <p
                                id="locationStatus"
                                class="text-sm text-gray-500 mt-2">
                            </p>

                            <input
                                type="hidden"
                                name="latitude"
                                id="latitude"
                                value="{{ old('latitude', $customer->latitude) }}">

                            <input
                                type="hidden"
                                name="longitude"
                                id="longitude"
                                value="{{ old('longitude', $customer->longitude) }}">

                            @if($customer->latitude && $customer->longitude)

                                <div class="mt-3">

                                    <a
                                        href="https://www.google.com/maps?q={{ $customer->latitude }},{{ $customer->longitude }}"
                                        target="_blank"
                                        class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">

                                        📍 View Current Location on Google Maps

                                    </a>

                                    <p class="text-xs text-gray-500 mt-2">

                                        Saved Coordinates:
                                        {{ number_format($customer->latitude, 6) }},
                                        {{ number_format($customer->longitude, 6) }}

                                    </p>

                                </div>

                            @endif

                        </div>

                    </div>

                    <div class="mt-4">

                        <label class="block font-semibold mb-2">
                            Complete Address
                        </label>

                        <textarea
                            name="address"
                            rows="3"
                            class="w-full border rounded-lg p-3"
                            required>{{ old('address', $customer->address) }}</textarea>

                    </div>

                    <hr class="my-8">

                    <h3 class="text-lg font-bold mb-4">
                        Customer Documents
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>

                            <label class="block font-semibold mb-2">
                                Customer Photo
                            </label>

                            @if($customer->customer_photo)

                                <div class="mb-3">

                                    <img
                                        src="{{ asset('storage/' . $customer->customer_photo) }}"
                                        class="w-32 h-32 object-cover rounded-lg border">

                                </div>

                            @endif

                            <input
                                type="file"
                                name="customer_photo"
                                accept="image/*"
                                class="w-full border rounded-lg p-2">

                            <p class="text-sm text-gray-500 mt-1">
                                New photo upload karne par old photo replace ho jayegi.
                            </p>

                        </div>

                        <div>

                            <label class="block font-semibold mb-2">
                                House Photo
                            </label>

                            @if($customer->house_photo)

                                <div class="mb-3">

                                    <img
                                        src="{{ asset('storage/' . $customer->house_photo) }}"
                                        class="w-32 h-32 object-cover rounded-lg border">

                                </div>

                            @endif

                            <input
                                type="file"
                                name="house_photo"
                                accept="image/*"
                                class="w-full border rounded-lg p-2">

                            <p class="text-sm text-gray-500 mt-1">
                                New photo upload karne par old photo replace ho jayegi.
                            </p>

                        </div>

                        <div>

                            <label class="block font-semibold mb-2">
                                CNIC Front
                            </label>

                            @if($customer->cnic_front)

                                <div class="mb-3">

                                    <img
                                        src="{{ asset('storage/' . $customer->cnic_front) }}"
                                        class="w-48 h-28 object-cover rounded-lg border">

                                </div>

                            @endif

                            <input
                                type="file"
                                name="cnic_front"
                                accept="image/*"
                                class="w-full border rounded-lg p-2">

                            <p class="text-sm text-gray-500 mt-1">
                                New CNIC front upload karne par old file replace ho jayegi.
                            </p>

                        </div>

                        <div>

                            <label class="block font-semibold mb-2">
                                CNIC Back
                            </label>

                            @if($customer->cnic_back)

                                <div class="mb-3">

                                    <img
                                        src="{{ asset('storage/' . $customer->cnic_back) }}"
                                        class="w-48 h-28 object-cover rounded-lg border">

                                </div>

                            @endif

                            <input
                                type="file"
                                name="cnic_back"
                                accept="image/*"
                                class="w-full border rounded-lg p-2">

                            <p class="text-sm text-gray-500 mt-1">
                                New CNIC back upload karne par old file replace ho jayegi.
                            </p>

                        </div>

                    </div>

                    <hr class="my-8">

                    <div class="mb-6">

                        <label class="block font-semibold mb-2">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full border rounded-lg p-3"
                            required>

                            <option
                                value="Active"
                                {{ old('status', $customer->status) == 'Active' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option
                                value="Inactive"
                                {{ old('status', $customer->status) == 'Inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>

                    <div class="flex gap-3">

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">

                            Update Customer

                        </button>

                        <a
                            href="{{ route('customers.index') }}"
                            class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg">

                            Back

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>


    <script>

        document.getElementById('getLocation').addEventListener('click', function () {

            const button = this;

            const status = document.getElementById('locationStatus');
            const locationInput = document.getElementById('location');
            const latitudeInput = document.getElementById('latitude');
            const longitudeInput = document.getElementById('longitude');

            if (!navigator.geolocation) {

                status.innerText =
                    'Your browser does not support location services.';

                return;

            }

            button.disabled = true;
            button.innerText = 'Getting Location...';

            status.innerText =
                'Getting your current location...';

            navigator.geolocation.getCurrentPosition(

                function (position) {

                    const latitude =
                        position.coords.latitude;

                    const longitude =
                        position.coords.longitude;

                    latitudeInput.value =
                        latitude;

                    longitudeInput.value =
                        longitude;

                    locationInput.value =
                        latitude + ', ' + longitude;

                    status.innerHTML =
                        'Location captured successfully. ' +
                        '<a href="https://www.google.com/maps?q=' +
                        latitude + ',' +
                        longitude +
                        '" target="_blank" class="text-blue-600 underline">' +
                        'View on Google Maps' +
                        '</a>';

                    button.disabled = false;
                    button.innerText = '📍 Update Location';

                },

                function (error) {

                    button.disabled = false;
                    button.innerText = '📍 Get Location';

                    if (error.code === 1) {

                        status.innerText =
                            'Location permission denied. Please allow location access.';

                    } else if (error.code === 2) {

                        status.innerText =
                            'Unable to determine your location.';

                    } else if (error.code === 3) {

                        status.innerText =
                            'Location request timed out. Try again.';

                    } else {

                        status.innerText =
                            'Unable to get your location.';

                    }

                },

                {
                    enableHighAccuracy: true,
                    timeout: 15000,
                    maximumAge: 0
                }

            );

        });

    </script>

</x-app-layout>