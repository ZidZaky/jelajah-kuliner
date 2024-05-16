@extends('layouts.layout2')

@section('title')
    BUAT STOK AKHIR!
@endsection

@section('css')
    <link rel="stylesheet" href="/css/dataPKL.css">
@endsection

@section('main')
    @php
        $pkl = App\Models\PKL::where('idAccount', session('account')['id'])->first();
    @endphp
    <div class="content">
        <div class="up" style="padding-left: 20px">
            <a href="/dashboard"><button class="btn btn-danger">Back to Dashboard</button></a>
            <div class="upside">
                <p class="namaakun">Hi, {{ session('account')['nama'] }} 👋</p>
            </div>
            <a href="/produk/create"><button type="" id="butEdit"><span>Tambah Produk &#9998</span></button></a>
        </div>
        <hr id="hratas">
        <div class="outer" style=" display: flex; flex-direction: column; align-items: center;">
            <div class="nmpkl" style="text-align: center; width: 100%;">
                <p class="namap">{{ $pkl->namaPKL}}</p>
                <p class="deskri">{{ $pkl->desc}}</p>
                <p>Produk Anda</p>
            </div>
            <form action="/updateHistory" method="POST" style="width: 90%;">
                @csrf
                <input type="number" name="idPKL" id="" value="{{ $pkl->id }}" hidden>
                <input type="number" name="idProduk" id="" value="{{ $produk->id }}" hidden>
                <div class="batas" style="width: 100%;">
                    <div class="card" style="width: 40%; margin-left: -100px;">
                        <div class="inCard" id="theImage">
                            <img src="https://i.pinimg.com/564x/34/e1/30/34e13046e8f9fd9f3360568abd453685.jpg" alt="">
                        </div>
                        <div class="inCard" id="mid">
                            <p class="np">{{ $produk->namaProduk }}</p>
                            <p class="Des">{{ $produk->desc }}</p>
                            <p class="hrg">Rp. {{ $produk->harga }}</p>
                        </div>
                        <div class="inCard" id="leftt">
                            <p class="stok">Isi Stok Akhir:</p>
                            <p class="numberr">
                                <input type="number" name="stokAkhir" id="" value="" style="width: 70px;">
                            </p>
                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content: center; width: 100%; margin-top: 20px;">
                    <button class="btn btn-success" type="submit">Simpan Stok Akhir</button>
                </div>
            </form>
        </div>
    </div>
@endsection
