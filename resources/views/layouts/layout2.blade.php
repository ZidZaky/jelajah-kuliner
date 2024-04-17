<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title') </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @yield('css')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sidebars/" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3" />

    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        body {
            font-family: "Nunito", sans-serif;
        }

        .sidebar {
            position: absolute;
            z-index: 100;
            height: 100vh;
            padding: 10px;
            background: #FFEBB2;
        }

        .sidebar a.btn.btn-primary{
            background: #A34343;
        }

        .sidebar ul {
            list-style-type: none;
        }

        #map {
            height: 100vh;
            width: 100%;
            z-index: 0;
        }

        @media (max-width: 768px) {
            .sidebar ul {
                display: flex;
            }
        }
    </style>
</head>

<body>
    @include('components.personalized-navbar')
    <div class="main">
        @yield('main')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
