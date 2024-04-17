@extends('layouts.layout')

@section('title')
    Feel Free to "JELAJAH" Kuliner dsekitarmu!
@endsection

@section('css')
    <link rel="stylesheet" href="css/register.css">
@endsection

@section('main')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Register</h5>
                <form method="POST" action="/account/{{ $account->id }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="inputFirstName" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="inputFirstName" value="{{$account->nama}}">
                    </div>
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail" value="{{$account->email}}">
                    </div>
                    <div class="mb-3">
                        <label for="inputPhone" class="form-label">Nomor Handphone</label>
                        <input type="tel" class="form-control" id="inputPhone" value="{{$account->nohp}}">
                    </div>
                    <div class="mb-3">
                        <label for="inputLastName" class="form-label">Password</label>
                        <input type="text" class="form-control" id="inputLastName" value="{{$account->password}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
