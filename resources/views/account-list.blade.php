@extends('layouts.layout2')

@section('title')
List Account
@endsection

@section('css')
<link rel="stylesheet" href="css/dataPKL.css">
@endsection

@section('main')
<div class="content">
    <div class="up">
        <div class="upside">
            <p class="namaakun">Hi, {{ session('account')['nama'] }} 👋</p>
        </div>
    </div>
    <hr id="hratas">
    <h1 class="text-center">List of Accounts</h1>
    <hr>

    <div class="batas">
        <div class="butButtonFront" style="">
        </div>
        @if ($account->count() > 0)
            @foreach ($account as $a)

                <div class="card border-danger text-bg-light mb-3" style="max-width: 500px; ">
                    <div class="row g-0">
                        <div class="col-md-4 mt-3">
                            <img src="https://i.pinimg.com/236x/0d/c1/ba/0dc1babea2221d912247ca059e1231dd.jpg"
                                class="img-fluid rounded-start" alt="pernahkah kau merasa">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $a->nama }}</h5>
                                <p class="card-text">{{ $a->email }}</p>
                                <p class="card-text">{{ $a->status }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="namap" style="text-align: center;">Kosong? astagfirullah</p>
        @endif

    </div>
    @endsection
