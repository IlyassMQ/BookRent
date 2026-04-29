@extends('layouts.app')

@section('title', 'Create Your Library')

@section('content')

<div class="max-w-4xl mx-auto px-4 py-8">

    {{-- BREADCRUMB NAVIGATION --}}
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-stone-500">
            <a href="{{ route('libraries.index') }}" class="hover:text-amber-700 transition flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Libraries
            </a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-amber-700 font-semibold">Create Library</span>
        </div>
    </div>

    {{-- MAIN FORM CARD --}}
    <div class="bg-white rounded-2xl shadow-xl border border-amber-100 overflow-hidden">
        
        {{-- FORM HEADER --}}
        <div class="bg-gradient-to-r from-amber-50 to-amber-100/30 px-6 py-4 border-b border-amber-200">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-amber-600 to-amber-700 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold serif-font text-[#2C1810]">
                        Create Your Library
                    </h2>
                    <p class="text-xs text-stone-500">
                        Add your library details and choose its location
                    </p>
                </div>
            </div>
        </div>

        {{-- FORM BODY --}}
        <div class="p-6">
            
            {{-- ERROR DISPLAY --}}
            @if($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-600 rounded-lg p-4">
                    <div class="flex items-start gap-2 mb-2">
                        <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold text-red-700">Please fix the following errors:</span>
                    </div>
                    <ul class="space-y-1 ml-7">
                        @foreach($errors->all() as $error)
                            <li class="text-sm text-red-600 flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST"
                  action="{{ route('library.store') }}"
                  onsubmit="return checkLocation()"
                  class="space-y-6">
                @csrf

                {{-- LIBRARY NAME --}}
                <div class="group">
                    <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                        <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Library Name *
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <input type="text" 
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="e.g., Central Public Library"
                               class="w-full pl-10 pr-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all @error('name') border-red-500 @enderror">
                    </div>
                    <p class="text-xs text-stone-400 mt-1">Enter the official name of your library</p>
                </div>

                {{-- ADDRESS --}}
                <div class="group">
                    <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                        <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Address *
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <input type="text" 
                               name="address"
                               value="{{ old('address') }}"
                               placeholder="Street, City, Postal Code"
                               class="w-full pl-10 pr-3 py-2.5 rounded-lg border-2 border-amber-200 focus:border-amber-600 focus:ring-2 focus:ring-amber-200 transition-all @error('address') border-red-500 @enderror">
                    </div>
                    <p class="text-xs text-stone-400 mt-1">Full street address for your library</p>
                </div>

                {{-- HIDDEN GEO FIELDS --}}
                <input type="hidden" name="geo_lat" id="geo_lat">
                <input type="hidden" name="geo_lng" id="geo_lng">

                {{-- MAP SECTION --}}
                <div>
                    <label class="block text-sm font-medium text-[#5C2E0B] mb-2 serif-font">
                        <svg class="inline-block w-4 h-4 mr-1 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                        Select Location on Map *
                    </label>

                    {{-- Map Container --}}
                    <div id="map"
                         class="w-full h-80 rounded-xl border-2 border-amber-200 shadow-sm overflow-hidden">
                    </div>

                    <div class="flex items-center gap-2 mt-3">
                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-xs text-stone-500">
                            Click anywhere on the map to place your library location marker
                        </p>
                    </div>
                    
                    <div id="selected-coords" class="mt-2 text-xs text-stone-400 hidden">
                        Selected location: <span id="coord-lat"></span>, <span id="coord-lng"></span>
                    </div>
                </div>

                {{-- FORM ACTIONS --}}
                <div class="flex gap-3 pt-4 border-t border-amber-200">
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-[#8B4513] to-[#6B3410] hover:from-[#6B3410] hover:to-[#5C2E0B] text-white py-2.5 rounded-lg transition-all duration-300 font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Create Library
                        </span>
                    </button>
                    
                    <a href="{{ route('libraries.index') }}" 
                       class="px-6 py-2.5 border-2 border-stone-300 text-stone-700 rounded-lg hover:bg-stone-50 transition-all duration-200 font-medium text-center">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>

    {{-- HELPER INFO CARD --}}
    <div class="mt-6 bg-gradient-to-r from-blue-50 to-transparent rounded-xl p-4 border border-blue-100">
        <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-[#2C1810]">About Library Registration</p>
                <p class="text-xs text-stone-600 mt-1">• Click on the map to set your library's exact location<br>• Your library will need to be approved by an administrator before becoming active<br>• Once approved, you can start adding books and managing your collection</p>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')

{{-- Leaflet CSS & JS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // Initialize map with Casablanca center coordinates
    var map = L.map('map').setView([33.5731, -7.5898], 13);

    // Add OpenStreetMap tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
    }).addTo(map);

    var marker;
    var selectedCoordsDiv = document.getElementById('selected-coords');
    var coordLatSpan = document.getElementById('coord-lat');
    var coordLngSpan = document.getElementById('coord-lng');

    // Handle map click events
    map.on('click', function(e) {
        var lat = e.latlng.lat.toFixed(6);
        var lng = e.latlng.lng.toFixed(6);

        // Remove existing marker if any
        if (marker) {
            map.removeLayer(marker);
        }

        // Add new marker
        marker = L.marker([lat, lng]).addTo(map);
        
        // Add a popup to the marker
        marker.bindPopup("<strong>Library Location</strong><br>Lat: " + lat + "<br>Lng: " + lng).openPopup();

        // Set hidden form values
        document.getElementById('geo_lat').value = lat;
        document.getElementById('geo_lng').value = lng;
        
        // Show selected coordinates
        coordLatSpan.textContent = lat;
        coordLngSpan.textContent = lng;
        selectedCoordsDiv.classList.remove('hidden');
    });

    // Function to validate location before form submission
    function checkLocation() {
        var lat = document.getElementById('geo_lat').value;
        var lng = document.getElementById('geo_lng').value;
        
        if (!lat || !lng) {
            alert("Please select a location on the map by clicking where your library is located.");
            return false;
        }
        return true;
    }
</script>

@endsection