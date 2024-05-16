@extends('layouts.layout2')

@section('title')
    Feel Free to "JELAJAH" Kuliner dsekitarmu!
@endsection

@section('css')
    <link rel="stylesheet" href="css/profile.css">
@endsection

@section('main')
@php
    $account = \App\Models\Account::where('id', session('account')['id'])->first();
@endphp
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center" style="color: #F08A5D"><strong>MY PROFILE</strong></h5><br>
                <form method="POST" action="/account" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $account->nama }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status Akun</label>
                        <input type="text" class="form-control" id="status" name="status" value="{{ $account->status }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $account->email }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="noHP" class="form-label">Nomor Telpon</label>
                        <input type="number" class="form-control" id="noHP" name="noHP" value="{{ $account->nohp }}" readonly>
                    </div>
                </form>
                <a href="/editProfile/{{ session('account')->id }}">
                    <button>
                        Edit Account
                    </button>
                </a>
            </div>
        </div>
    </div>
@endsection
