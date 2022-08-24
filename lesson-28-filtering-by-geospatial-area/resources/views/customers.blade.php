@extends('layout')

@section('content')

<header class="bg-white shadow">
  <div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="md:flex md:items-center md:justify-between">
      <div class="flex-1 min-w-0">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
          Customers
        </h2>
      </div>
      <div class="mt-4 flex md:mt-0 md:ml-4">
        <span class="shadow-sm rounded-md">
          <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:text-gray-800 active:bg-gray-50 transition duration-150 ease-in-out">
            New customer
          </button>
        </span>
      </div>
    </div>
  </div>
</header>

<main class="max-w-6xl mx-auto sm:px-6 lg:px-8 py-12">
  <div class="w-full p-2 bg-white rounded-md shadow">
    <div class="rounded" style="height: 600px" id="map"></div>
  </div>
</main>

<script src="https://api.mapbox.com/mapbox-gl-js/v1.9.1/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v1.9.1/mapbox-gl.css" rel="stylesheet" />
<script>
mapboxgl.accessToken = '{{ config('services.mapbox.token') }}';

var map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/mapbox/streets-v11',
  center: [-96, 53.8],
  zoom: 3.1
});

var regions = @json($regions->map->only('id', 'color', 'geometry_as_json'));
var customers = @json($customers->map->only('latitude', 'longitude'));

map.on('load', function() {
  regions.forEach(function (region) {
    map.addSource(`region-${region.id}`, {
      'type': 'geojson',
      'data': JSON.parse(region.geometry_as_json)
    });
    map.addLayer({
      'id': `region-${region.id}`,
      'type': 'fill',
      'source': `region-${region.id}`,
      'layout': {},
      'paint': {
        'fill-color': region.color,
        'fill-opacity': 0.8
      }
    });
  });

  customers.forEach(function (customer) {
    var el = document.createElement('div');
    el.innerHTML = `<div class="rounded-full bg-white w-3 h-3 bg-white opacity-75"></div>`;

    new window.mapboxgl.Marker(el)
      .setLngLat([customer.longitude, customer.latitude])
      .addTo(map);
  });
});
</script>

@endsection
