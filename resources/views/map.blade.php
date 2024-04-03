@extends('layouts.layout')

@section('title')
    Tracking Map - Jelajah Kuliner
@endsection

@section('css')
    <link rel="stylesheet" href="css/style.css">
@endsection

@section('main')
    <div id="map"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        var map = L.map("map").setView([51.505, -0.09], 150);
        var osm = L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        });
        osm.addTo(map);

        var marker = L.marker([51.5, -0.09]).addTo(map);
        marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();

        var popup = L.popup();

        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent("You clicked the map at " + e.latlng.toString())
                .openOn(map);
        }

        map.on('click', onMapClick);
    </script>
@endsection
