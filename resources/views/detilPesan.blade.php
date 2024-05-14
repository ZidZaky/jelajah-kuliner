@extends('layouts.layout2')

@section('title')
    Feel Free to "JELAJAH" Kuliner di Sekitarmu!
@endsection

@section('css')
    <link rel="stylesheet" href="/css/pesan.css">
@endsection

@section('main')
    <div class="all">
        <div class="up border border-bottom">
            <div class="upside">
                <p class="namaakun">Hi, {{ session('account')['nama'] }} 👋</p>
            </div>
            <div>
                <button type="button" class="btn btn-success" disabled><span>Ajukan Pesanan!
                        &#9998;</span></button>
            </div>
        </div>
        <div class="nmpkl">
            <p class="namap">{{ $pesan->idPKL }}</p>
            {{-- <p class="deskri">{{ $pkl->desc }}</p> --}}
        </div>

        <div class="showmenu" style="padding-top: 5px; padding-bottom: 5px">
            <div class="kiri border border-right" style="width: 100%;">
                <p>Pesanan Anda</p>
            </div>

            <div class="kanan border border-right d-flex flex-column justify-content-between"
                style="height: 100%; width: 50%; margin-left: 5px;">
                <p style="margin-top: 1vh; margin-bottom: 1vh;">Tanggal: {{ $pesan->created_at->format('d-m-Y') }}</p>
                <table id="tabelStruk" class="table" style="position: absolute; width: 33%; margin-top: 5vh">
                    <thead>
                        <tr>
                            <th>ID PORDUK</th>
                            <th>Nama Produk</th>
                            <th>Quantity</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Assuming you have a collection of orders or products to display -->
                        @foreach($produks as $produk)
                        <tr>
                            <td>{{$produk->idProduk}}</td>
                            <td>{{$produk->namaProduk}}</td>
                            <td>{{$produk->namaProduk}}</td>
                            <td>{{$produk->namaProduk}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Total Quantity</td>
                            <td id="totalQuantity">-</td>
                        </tr>
                        <tr>
                            <td colspan="3">Total Keseluruhan</td>
                            <td id="totalKeseluruhan">{{ $pesan->TotalBayar }}</td>
                        </tr>
                    </tfoot>
                </table>
                <div>
                    <label for="keterangan">Keterangan Tambahan</label><br>
                    <p id="keterangan">{{ $pesan->Keterangan}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
