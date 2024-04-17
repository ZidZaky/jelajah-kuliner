@extends('layouts.layout2')

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
                <form method="POST" action="/account" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ session('account')->nama }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                        value="{{ session('account')->email }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nohp" class="form-label">Nomor Handphone</label>
                        <input type="text" class="form-control" id="nohp" name="nohp" value="{{ session('account')->nohp }}" readonly>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
