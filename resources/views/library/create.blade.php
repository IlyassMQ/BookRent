@extends('layouts.app')

@section('title', 'Create Library')

@section('content')

<div class="max-w-2xl mx-auto px-4 py-8">

    <div class="bg-white border border-amber-100 rounded-2xl shadow-sm p-6">

        {{-- HEADER --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-stone-800">
                Create Your Library
            </h2>
            <p class="text-sm text-stone-500">
                Add your library details and choose its location
            </p>
        </div>

        {{-- ERRORS --}}
        @if($errors->any())
            <div class="bg-red-50 text-red-600 px-4 py-3 rounded-lg mb-5 text-sm space-y-1">
                @foreach($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST"
              action="{{ route('library.store') }}"
              onsubmit="return checkLocation()"
              class="space-y-5">
            @csrf

            {{-- NAME --}}
            <div>
                <label class="text-sm text-stone-600">Library Name</label>
                <input type="text" name="name"
                       class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">
            </div>

            {{-- ADDRESS --}}
            <div>
                <label class="text-sm text-stone-600">Address</label>
                <input type="text" name="address"
                       class="w-full mt-1 px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">
            </div>

            {{-- HIDDEN GEO --}}
            <input type="hidden" name="geo_lat" id="geo_lat">
            <input type="hidden" name="geo_lng" id="geo_lng">

            {{-- MAP --}}
            <div>
                <label class="text-sm text-stone-600 mb-2 block">
                    Select Location on Map
                </label>

                <div id="map"
                     class="w-full h-64 rounded-xl border border-stone-200 shadow-sm"></div>

                <p class="text-xs text-stone-400 mt-2">
                    Click anywhere on the map to place your library location
                </p>
            </div>

            {{-- SUBMIT --}}
            <button class="w-full bg-amber-700 text-white py-2.5 rounded-lg font-medium hover:bg-amber-800 transition">
                Create Library
            </button>

        </form>

    </div>

</div>

@endsection


@section('scripts')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    var map = L.map('map').setView([33.5731, -7.5898], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var marker;

    map.on('click', function(e) {

        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        if (marker) {
            map.removeLayer(marker);
        }

        marker = L.marker([lat, lng]).addTo(map);

        document.getElementById('geo_lat').value = lat;
        document.getElementById('geo_lng').value = lng;
    });

    function checkLocation() {
        if (!document.getElementById('geo_lat').value) {
            alert("Please select a location on the map");
            return false;
        }
        return true;
    }
</script>

@endsection