@extends('layouts.layout2')

@section('title')
    Feel Free to "JELAJAH" Kuliner dsekitarmu!
@endsection

@section('css')
    <link rel="stylesheet" href="css/login.css">
@endsection

@section('isiAlert')
    @if((session('alert'))!=null)

            @php echo session('alert'); @endphp
    @endif
@endsection

@section('main')

<div class="container d-flex justify-content-center align-items-center h-100">
    <div class="card">
        <h1 class="h3 mb-3 fw-normal" id="titleLogin">LOGIN</h1>
        <div class="line-divider"></div>
        <form class="form-signin" action="/loginAccount" method="POST">
            @csrf


            <div class="form">
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email ">
                {{-- <label for="floatingInput">Email atau No Telepon</label> --}}
            </div>
            <div class="form">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                {{-- <label for="floatingPassword">Password</label> --}}

            </div>
            <div class="mb-3" id="showPass">
                <input type="checkbox" onchange="togglePasswordVisibility()" name="showPassword" value="none" id="cbShow" >
                <label for="ForCheckbox">Perlihatkan</label>
            </div>
            <div class="form-floating">
                <button id ="ButLogin" class="w-100 btn btn-lg btn-success" type="submit">Login</button>
            </div>

        </form>
        <div class="line-divider"></div>
        <div class="regisPkl">
            <p>Belum Punya Akun? </p>
            <a href="/account/create"><p>Register</p></a>
        </div>
    </div>
</div>
<script src="/js/login.js"></script>

@endsection
