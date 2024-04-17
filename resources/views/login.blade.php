@extends('layouts.layout')

@section('title')
    Feel Free to "JELAJAH" Kuliner dsekitarmu!
@endsection

@section('css')
    <link rel="stylesheet" href="css/login.css">
@endsection

@section('main')
<div class="container d-flex justify-content-center align-items-center h-100">
    <div class="card">
        <form class="form-signin" action="/loginAccount" method="POST">
            @csrf
            <img class="mb-4" src="https://via.placeholder.com/150" alt="Logo" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Silahkan Login!</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2024</p>
        </form>
    </div>
</div>
@endsection
