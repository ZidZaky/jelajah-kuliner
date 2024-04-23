<div class="sidebar">
    <nav>
        <h1><a href="/">Jelajah Kuliner</a></h1>
        <ul>
            <li><a href="/spots">Best Spots</a></li>
            <li><a href="/list-products">Products</a></li>
            <li><a href="/your-history">Your History</a></li>
            <li><a href="/profile">Your Profile</a></li>
            @php
                $pklExists = \App\Models\PKL::where('idAccount', session('account')['id'])->exists();
            @endphp

            @if ($pklExists)
                <a class="btn btn-primary" href="/dataPKL/{{ session('account')['id'] }}" role="button">Show Data
                    PKL</a>
            @else
                <a class="btn btn-primary" href="/PKL/create" role="button">Create Data PKL</a>
            @endif

        </ul>
        <hr>
        <a class="btn btn-warning" href="/logout" role="button">Logout</a>
        <!-- iki lapo kok warning -->
        @if (session('account')['nama'] == 'Admin')
            <a class="btn btn-primary" href="/account" role="button">List Account</a>
        @endif
    </nav>
    <div class="menu">
        <p>=</p>
    </div>
</div>
