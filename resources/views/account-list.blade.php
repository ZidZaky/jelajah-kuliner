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
        <div class="outer">
            <div class="demain">
                <div class="nmpkl">
                    <p>List Account</p>
                </div>
                <hr>

                <div class="batas">
                    <div class="butButtonFront" style="">
                    </div>
                    @if ($account->count() > 0)
                        @foreach ($account as $a)
                            <div class="card">
                                <div class="inCard" id="theImage">
                                    <img src="https://i.pinimg.com/236x/0d/c1/ba/0dc1babea2221d912247ca059e1231dd.jpg"
                                        alt="">
                                </div>
                                <div class="inCard" id="mid">
                                    <p class="np">{{ $a->nama }}</p>
                                    <p class="Des">{{ $a->email }}</p>
                                    <p class="hrg">{{ $a->status }}</p>
                                    asdadss
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="namap" style="text-align: center;">Produk kosong</p>
                    @endif
                </div>


            </div>
        @endsection
