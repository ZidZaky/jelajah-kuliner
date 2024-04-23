@extends('layouts.layout2')

@section('title')
    Tracking Map - Jelajah Kuliner
@endsection

@section('css')
    <link rel="stylesheet" href="css/style.css">
@endsection

@section('main')
    <div id="map"></div>
    <div id="accountDetails"
        style="position: absolute; z-index: 100; top: 0; right: 0; width: 20%; height: 100%; padding: 10px; border: 1px solid #ccc; display: none; background-color: bisque;">
        <button onclick="closeAccountDetails()" style="float: right;">Close</button>
        <h3>Name of Account</h3>
        <img src="path_to_image" alt="Foto Of Person on account"
            style="width: 100%; max-width: 100%; height: 200px; display: block; margin: 0 auto;">

        <div style="margin-top: 20px; text-align: center;">
            <button onclick="changeContent('Ulasan')">Ulasan</button>
            <button onclick="changeContent('Menu')">Menu</button>
            <button onclick="changeContent('Pesan')">Pesan</button>
        </div>
        <div id="contentUlasan" style="display: none;">
            <!-- Content for Ulasan button -->
            Ulasan Content Goes Here
        </div>

        <div id="contentMenu" style="display: none;">
            <!-- Content for Menu button -->
            Menu Content Goes Here
        </div>

        <div id="contentPesan" style="display: none;">
            <!-- Content for Pesan button -->
            Pesan Content Goes Here
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map("map").setView([51.505, -0.09], 150);
        var osm = L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        });
        osm.addTo(map);

        // Fetch latitude and longitude data from your Laravel backend using AJAX
        fetch('/getCoordinates')
            .then(response => response.json())
            .then(data => {
                // Loop through each set of coordinates
                data.forEach(coordinates => {
                    // Create a marker for each coordinate on the map
                    L.marker([coordinates.latitude, coordinates.longitude]).addTo(map).on('click', function() {
                        // Simulated account details (replace with actual session data)
                        displayAccountDetails(); // Display account details when marker is clicked
                    });
                });
            })
            .catch(error => {
                console.error('Error fetching coordinates:', error);
            });


        // Function to display account details in the accountDetails div
        function displayAccountDetails() {
            // document.getElementById('accountName').innerText = 'Nama: ' + account.nama;
            // document.getElementById('accountEmail').innerText = 'Email: ' + account.email;
            // document.getElementById('accountNohp').innerText = 'No HP: ' + account.nohp;
            // document.getElementById('accountStatus').innerText = 'Status: ' + account.status;
            document.getElementById('accountDetails').style.display = 'block';
        }

        // Event listener for marker click event
        marker

        function closeAccountDetails() {
            document.getElementById('accountDetails').style.display = 'none'; // Hide the accountDetails div
            // Reset account details
            document.getElementById('accountName').innerText = '';
            document.getElementById('accountEmail').innerText = '';
            document.getElementById('accountNohp').innerText = '';
            document.getElementById('accountStatus').innerText = '';
        }

        // Function to change content based on button click
        function changeContent(buttonName) {
            // Hide all content divs
            document.getElementById('contentUlasan').style.display = 'none';
            document.getElementById('contentMenu').style.display = 'none';
            document.getElementById('contentPesan').style.display = 'none';

            // Show the corresponding content div
            document.getElementById('content' + buttonName).style.display = 'block';
        }
    </script>
@endsection
