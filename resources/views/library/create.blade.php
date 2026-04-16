{{-- resources/views/library/create.blade.php --}}

@extends('layouts.app')

@section('title', 'Create Library')

@section('content')

<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">Create Your Library</h2>

    {{-- ERRORS --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-600 p-3 mb-4 rounded">
            @foreach($errors->all() as $error)
                <div>- {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('library.store') }}" onsubmit="return checkLocation()">
        @csrf

        {{-- NAME --}}
        <input type="text" name="name" placeholder="Library Name"
               class="w-full border p-2 rounded mb-3">

        {{-- ADDRESS --}}
        <input type="text" name="address" placeholder="Address"
               class="w-full border p-2 rounded mb-3">

        {{-- HIDDEN LAT LNG --}}
        <input type="hidden" name="geo_lat" id="geo_lat">
        <input type="hidden" name="geo_lng" id="geo_lng">

        {{-- MAP --}}
        <label class="block mb-2 font-medium">Choose Location on Map</label>
        <div id="map" class="w-full h-64 rounded mb-4 border"></div>

        {{-- SUBMIT --}}
        <button class="w-full bg-indigo-600 text-white py-2 rounded">
            Create Library
        </button>

    </form>

</div>

@endsection


@section('scripts')

{{-- LEAFLET --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // Default map location (you can change city)
    var map = L.map('map').setView([33.5731, -7.5898], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var marker;

    // When user clicks map
    map.on('click', function(e) {

        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        // Remove old marker
        if (marker) {
            map.removeLayer(marker);
        }

        // Add marker
        marker = L.marker([lat, lng]).addTo(map);

        // Fill hidden inputs
        document.getElementById('geo_lat').value = lat;
        document.getElementById('geo_lng').value = lng;
    });

    // Prevent submit if no location selected
    function checkLocation() {
        if (!document.getElementById('geo_lat').value) {
            alert("Please select a location on the map");
            return false;
        }
        return true;
    }
</script>

@endsection