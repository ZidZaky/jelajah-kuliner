@extends('layouts.layout2')

@section('title')
    Tracking Map - Jelajah Kuliner
@endsection

@section('css')
    <link rel="stylesheet" href="/css/style.css">
@endsection

@section('main')
    <div id="map"></div>
    <div id="accountDetails"
        style=" position: absolute; z-index: 100; top: 0; right: 0; width: 25%; height: 100%; padding: 10px; border: 1px solid #ccc; display: none; background-color: #B83B5E;">
        <button onclick="closeAccountDetails()" style="float: right; border-radius: 6px;" class="btn btn-danger">X</button>
        <h2  style="color: #F9ED69"><STRONG>[PKL NAME]</STRONG></h2><br>
        <img src="path_to_image" alt="PKL Photo Goes Here"
            style="width: 100%; max-width: 100%; height: 230px; display: block; margin: 0 auto; border: #F9ED69 3px solid; border-radius: 5px">

        <div style="margin-top: 5px; text-align: center; display: flex; justify-content: space-around; width: 100%;">
            <button onclick="changeContent('Ulasan')" type="button" class="btn btn-success"
                style="flex: 1; border-radius: 0; color: #702c74; background-color: yellow;">Ulasan</button>
            <button onclick="changeContent('Menu')" type="button" class="btn btn-success"
                style="flex: 1; border-radius: 0; color: #702c74; background-color: yellow;">Menu</button>
            <button onclick="changeContent('Pesan')" type="button" class="btn btn-success"
                style="flex: 1; border-radius: 0; color: #702c74; background-color: yellow;">Pesan</button>
        </div>

        <div id="contentWrapper"
            style="border: yellow 3px solid; margin-top: 4px; width: 100%; height: 50%; border-radius: 5px">
            <div id="contentUlasan" style="display: none;">
                Ulasan Content Goes Here
            </div>

            <div id="contentMenu" style="display: none;">
                Menu Content Goes Here
            </div>

            <div id="contentPesan" style="display: none;">
                Pesan Content Goes Here
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map("map").setView([51.505, -0.09], 150);
        var osm = L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        });
        osm.addTo(map);

        fetch('/getCoordinates')
            .then(response => response.json())
            .then(data => {
                data.forEach(coordinates => {
                    // Create a marker for each coordinate on the map
                    const marker = L.marker([coordinates.latitude, coordinates.longitude]).addTo(map);

                    // Pass the id to the displayAccountDetails function when marker is clicked
                    marker.on('click', function() {
                        displayAccountDetails(coordinates.id, coordinates.namaPKL);
                    });
                });
            })
            .catch(error => {
                console.error('Error fetching coordinates:', error);
            });


        // Function to display account details in the accountDetails div
        function displayAccountDetails(id) {
            // document.getElementById('accountName').innerText = 'Nama: ' + account.nama;
            // document.getElementById('accountEmail').innerText = 'Email: ' + account.email;
            // document.getElementById('accountNohp').innerText = 'No HP: ' + account.nohp;
            // document.getElementById('accountStatus').innerText = 'Status: ' + account.status;
            // document.getElementById('idAccount').innerText = 'ID: ' + id;
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
