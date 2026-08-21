<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl">
            Add New Customer
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
                    action="{{ route('customers.store') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf

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

                                <option value="">
                                    Select Branch
                                </option>

                                @foreach($branches as $branch)

                                    <option
                                        value="{{ $branch->id }}"
                                        {{ old('branch_id') == $branch->id ? 'selected' : '' }}>

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
                                value="{{ old('name') }}"
                                class="w-full border rounded-lg p-3"
                                placeholder="Enter Customer Name"
                                required>

                        </div>

                        <div>

                            <label class="block font-semibold mb-2">
                                Father Name
                            </label>

                            <input
                                type="text"
                                name="father_name"
                                value="{{ old('father_name') }}"
                                class="w-full border rounded-lg p-3"
                                placeholder="Enter Father Name"
                                required>

                        </div>

                        <div>

                            <label class="block font-semibold mb-2">
                                CNIC
                            </label>

                            <input
                                type="text"
                                name="cnic"
                                value="{{ old('cnic') }}"
                                class="w-full border rounded-lg p-3"
                                placeholder="35202xxxxxxxxx"
                                required>

                        </div>

                        <div>

                            <label class="block font-semibold mb-2">
                                Mobile Number
                            </label>

                            <input
                                type="text"
                                name="mobile"
                                value="{{ old('mobile') }}"
                                class="w-full border rounded-lg p-3"
                                placeholder="03XXXXXXXXX"
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
                                    value="{{ old('location') }}"
                                    class="w-full border rounded-lg p-3"
                                    placeholder="Click Get Location"
                                    readonly>

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
                                value="{{ old('latitude') }}">

                            <input
                                type="hidden"
                                name="longitude"
                                id="longitude"
                                value="{{ old('longitude') }}">

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
                            placeholder="Enter complete customer address"
                            required>{{ old('address') }}</textarea>

                    </div>

                    <div
                        id="mapLinkBox"
                        class="hidden mt-4 bg-green-50 border border-green-200 rounded-lg p-4">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="font-semibold text-green-700">
                                    Customer Location Captured
                                </p>

                                <p
                                    id="coordinates"
                                    class="text-sm text-gray-600 mt-1">
                                </p>

                            </div>

                            <a
                                id="googleMapsLink"
                                href="#"
                                target="_blank"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">

                                Open Google Maps

                            </a>

                        </div>

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

                            <input
                                type="file"
                                name="customer_photo"
                                accept="image/*"
                                class="w-full border rounded-lg p-2">

                            <p class="text-sm text-gray-500 mt-1">
                                JPG, PNG or WEBP. Maximum 2 MB.
                            </p>

                        </div>

                        <div>

                            <label class="block font-semibold mb-2">
                                House Photo
                            </label>

                            <input
                                type="file"
                                name="house_photo"
                                accept="image/*"
                                class="w-full border rounded-lg p-2">

                            <p class="text-sm text-gray-500 mt-1">
                                JPG, PNG or WEBP. Maximum 4 MB.
                            </p>

                        </div>

                        <div>

                            <label class="block font-semibold mb-2">
                                CNIC Front
                            </label>

                            <input
                                type="file"
                                name="cnic_front"
                                accept="image/*"
                                class="w-full border rounded-lg p-2">

                            <p class="text-sm text-gray-500 mt-1">
                                CNIC front side image. Maximum 2 MB.
                            </p>

                        </div>

                        <div>

                            <label class="block font-semibold mb-2">
                                CNIC Back
                            </label>

                            <input
                                type="file"
                                name="cnic_back"
                                accept="image/*"
                                class="w-full border rounded-lg p-2">

                            <p class="text-sm text-gray-500 mt-1">
                                CNIC back side image. Maximum 2 MB.
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
                                {{ old('status', 'Active') == 'Active' ? 'selected' : '' }}>

                                Active

                            </option>

                            <option
                                value="Inactive"
                                {{ old('status') == 'Inactive' ? 'selected' : '' }}>

                                Inactive

                            </option>

                        </select>

                    </div>

                    <div class="flex gap-3">

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">

                            Save Customer

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

        document
            .getElementById('getLocation')
            .addEventListener('click', function () {

                const status =
                    document.getElementById('locationStatus');

                const locationInput =
                    document.getElementById('location');

                const latitudeInput =
                    document.getElementById('latitude');

                const longitudeInput =
                    document.getElementById('longitude');

                const button =
                    document.getElementById('getLocation');

                const mapLinkBox =
                    document.getElementById('mapLinkBox');

                const coordinates =
                    document.getElementById('coordinates');

                const googleMapsLink =
                    document.getElementById('googleMapsLink');


                if (!navigator.geolocation) {

                    status.innerText =
                        'Your browser does not support location services.';

                    return;

                }


                button.disabled = true;

                button.innerText =
                    '📍 Getting Location...';

                status.innerText =
                    'Getting your current location. Please wait...';


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


                        const googleMapsUrl =
                            'https://www.google.com/maps?q=' +
                            latitude + ',' +
                            longitude;


                        googleMapsLink.href =
                            googleMapsUrl;


                        coordinates.innerText =
                            'Latitude: ' +
                            latitude +
                            ' | Longitude: ' +
                            longitude;


                        mapLinkBox.classList.remove('hidden');


                        status.innerText =
                            'Location captured successfully.';


                        status.classList.remove(
                            'text-gray-500'
                        );

                        status.classList.add(
                            'text-green-600'
                        );


                        button.disabled = false;

                        button.innerText =
                            '📍 Location Captured';

                    },


                    function (error) {

                        button.disabled = false;

                        button.innerText =
                            '📍 Get Location';


                        if (error.code === 1) {

                            status.innerText =
                                'Location permission denied. Please allow location access in your browser.';

                        }

                        else if (error.code === 2) {

                            status.innerText =
                                'Unable to determine your location. Please try again.';

                        }

                        else if (error.code === 3) {

                            status.innerText =
                                'Location request timed out. Please try again.';

                        }

                        else {

                            status.innerText =
                                'Unable to get your location.';

                        }


                        status.classList.remove(
                            'text-gray-500'
                        );

                        status.classList.add(
                            'text-red-600'
                        );

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