@include('layout.header')

{{-- Leaflet CSS --}}
<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
/>

<nav class="bg-blue-600 text-white shadow-md sticky top-0 z-50 font-verdana">
    <div class="container mx-auto px-4 flex justify-between items-center py-2.5">

        <div class="flex items-center space-x-2">
            <span class="px-4 py-2 rounded-xl text-sm font-semibold bg-blue-500">
                {{ __('Lokasi Antar') }}
            </span>
        </div>

        <div class="flex items-center space-x-1.5 bg-blue-700 p-1 rounded-xl text-xs font-semibold">
            <a href="{{ route('lang.switch', 'id') }}"
                class="px-3 py-1.5 rounded-lg transition-all {{ app()->getLocale() == 'id' ? 'bg-white text-blue-700 shadow font-bold' : 'text-blue-100 hover:text-white' }}">
                🇮🇩 ID
            </a>

            <a href="{{ route('lang.switch', 'en') }}"
                class="px-3 py-1.5 rounded-lg transition-all {{ app()->getLocale() == 'en' ? 'bg-white text-blue-700 shadow font-bold' : 'text-blue-100 hover:text-white' }}">
                🇺🇸 EN
            </a>
        </div>

    </div>
</nav>

<main class="container mx-auto px-4 py-8 max-w-3xl font-verdana">

    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8">

        {{-- Header --}}
        <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center">
                <i class="fa-solid fa-location-dot"></i>
            </div>

            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ __('Lokasi Pengantaran') }}
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    {{ __('Tentukan lokasi pengantaran pada peta.') }}
                </p>
            </div>
        </div>

        {{-- Map --}}
        <div
            id="delivery-map"
            class="w-full h-100 rounded-xl border border-gray-300 overflow-hidden">
        </div>

        {{-- Location Button --}}
        <button
            type="button"
            id="current-location"
            class="w-full mt-5 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 rounded-xl font-semibold transition-colors">
            <i class="fa-solid fa-location-crosshairs mr-2"></i>
            {{ __('Gunakan Lokasi Saya') }}
        </button>

        {{-- Coordinate Information --}}
        <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    {{ __('Latitude') }}
                </label>

                <input
                    type="text"
                    id="latitude"
                    readonly
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    {{ __('Longitude') }}
                </label>

                <input
                    type="text"
                    id="longitude"
                    readonly
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-sm">
            </div>

        </div>

        {{-- Continue --}}
        <button
            type="button"
            id="continue-button"
            class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold transition-colors">
            <i class="fa-solid fa-arrow-right mr-2"></i>
            {{ __('Lanjut') }}
        </button>

    </section>

</main>

{{-- Leaflet JS --}}
<script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Posisi awal peta
        const defaultLatitude = -5.3971;
        const defaultLongitude = 105.2668;

        const map = L.map('delivery-map').setView(
            [defaultLatitude, defaultLongitude],
            13
        );

        // OpenStreetMap
        L.tileLayer(
            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap contributors'
            }
        ).addTo(map);

        // Marker
        let marker = L.marker(
            [defaultLatitude, defaultLongitude],
            {
                draggable: true
            }
        ).addTo(map);

        marker.bindPopup('{{ __("Lokasi pengantaran") }}').openPopup();

        const latitudeInput = document.getElementById('latitude');
        const longitudeInput = document.getElementById('longitude');

        function updateCoordinates(latitude, longitude) {

            latitudeInput.value = latitude.toFixed(6);
            longitudeInput.value = longitude.toFixed(6);

        }

        updateCoordinates(
            defaultLatitude,
            defaultLongitude
        );

        // Ketika marker dipindahkan
        marker.on('dragend', function (event) {

            const position = event.target.getLatLng();

            updateCoordinates(
                position.lat,
                position.lng
            );

        });

        // Ketika peta diklik
        map.on('click', function (event) {

            marker.setLatLng(event.latlng);

            updateCoordinates(
                event.latlng.lat,
                event.latlng.lng
            );

        });

        // Gunakan lokasi perangkat
        document.getElementById('current-location')
            .addEventListener('click', function () {

                if (!navigator.geolocation) {
                    alert('{{ __("Perangkat Anda tidak mendukung lokasi.") }}');
                    return;
                }

                navigator.geolocation.getCurrentPosition(
                    function (position) {

                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;

                        map.setView(
                            [latitude, longitude],
                            17
                        );

                        marker.setLatLng([
                            latitude,
                            longitude
                        ]);

                        updateCoordinates(
                            latitude,
                            longitude
                        );

                    },
                    function () {

                        alert('{{ __("Lokasi tidak dapat diperoleh. Pastikan izin lokasi telah diberikan.") }}');

                    }
                );

            });

    });
</script>

@include('layout.footer')