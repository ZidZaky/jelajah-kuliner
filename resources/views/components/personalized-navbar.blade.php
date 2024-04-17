<div class="sidebar">
    <nav>
        <h1><a href="/dashboard">Jelajah Kuliner</a></h1>
        {{-- {{dd(session('account'))}} --}}
        @if (session('account'))
            <h3>
                <p>Welcome, {{ session('account')->nama }}</p>
            </h3>
        @else
            <script>
                window.location = "/login";
            </script>
        @endif

        <ul>
            <li><a href="/spots">Best Spots</a></li>
            <li><a href="/list-products">Products</a></li>
            <li><a href="/your-history">Your History</a></li>
            <li><a href="/profile">Your Profile</a></li>
        </ul>
        <hr>
        <a class="btn btn-warning" href="/logout" role="button">Logout</a>
    </nav>
</div>
