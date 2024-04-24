@extends('layouts.layout2')

@section('title')
    Feel Free to "JELAJAH" Kuliner di Sekitarmu!
@endsection

@section('css')
    <link rel="stylesheet" href="/css/dataPKL.css">
@endsection

@section('main')
    <div class="content">
        <div class="up">
            <div class="upside">
                <p class="namaakun">Hi, {{ session('account')['nama'] }} 👋</p>
            </div>
            <a href="/produk/create"><button type="" id="butEdit"><span>Tambah Produk &#9998</span></button></a>
        </div>
        <hr id="hratas">
        <div class="outer">
            <div class="demain">
                <div class="nmpkl">
                    <p class="namap">{{ $pkl->namaPKL }}</p>
                    <p class="deskri">{{ $pkl->desc }}</p>
                    <p>Produk Anda</p>
                </div>
                @if ($produk->count() > 0)
                    @foreach ($produk as $p)
                        <div class="batas">
                            <div class="card">
                                <div class="inCard" id="theImage">
                                    <img src="https://i.pinimg.com/564x/34/e1/30/34e13046e8f9fd9f3360568abd453685.jpg" alt="">
                                </div>
                                <div class="inCard" id="mid">
                                    <p class="np">{{ $p->namaProduk }}</p>
                                    <p class="Des">{{ $p->desc }}</p>
                                    <p class="hrg">Rp. {{ $p->harga }}</p>
                                </div>
                                <div class="inCard" id="leftt">
                                    <p class="stok">Stok</p>
                                    <p class="numberr">{{ $p->stok }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="namap" style="text-align: center">Produk Kosong</p>
                @endif
            </div>
            <hr id="hrmiring">
            <div class="side">
                <div class="namapp">
                    <p class="namap">Ulasan PKL</p>
                </div>
                <hr>
                <div class="batasRev">
                    <div class="chart">
                        @php
                            $bintang = [0, 0, 0, 0, 0];
                            $total = 0;
                            foreach ($ulasan as $ul) {
                                $bintang[$ul->rating - 1]++;
                                $total++;
                            }
                        @endphp
                        @for ($i = 5; $i >= 1; $i--)
                            <div class="rating-chart">
                                <p class="derating">⭐️ {{ $i }}</p>
                                <div class="bar" style="--rating: {{ $bintang[$i - 1] / $total * 20 }}%;"></div>
                                <div class="percentage">{{ $bintang[$i - 1] }}</div>
                            </div>
                        @endfor
                    </div>
                </div>
                <hr>
                <div class="listRev">
                    @foreach ($ulasan as $ul)
                        <div class="cardRev">
                            <p id="namaRev">{{ $ul->idAccount }}</p>
                            <hr>
                            <p id="bintangRev">⭐️{{ $ul->rating }}</p>
                            <p id="desRev">{{ $ul->ulasan }}</p>
                            <hr>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
