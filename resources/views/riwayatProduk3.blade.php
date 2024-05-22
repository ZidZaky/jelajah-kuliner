@extends('layouts.layout2')

@section('title')
    Feel Free to "JELAJAH" Kuliner di Sekitarmu!
@endsection

@section('css')
    <link rel="stylesheet" href="/css/dataPKL.css">
@endsection

@section('main')
    {{-- <div class="content">
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
                @if ($riwayat->count() > 0)
                    @foreach ($produk as $p)
                        <div class="batas">
                            <div class="card">
                                <div class="inCard" id="theImage">
                                    <img src="https://i.pinimg.com/564x/34/e1/30/34e13046e8f9fd9f3360568abd453685.jpg"
                                        alt="">
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
                <div style="align-items:center;">
                    <br>
                    <a href="/riwayatProduk/{{ $pkl->namaPKL }}">
                        <button class="btn btn-success" style="width: 10vh;">
                            Riwayat Stok Produk
                        </button>
                    </a>
                    <br>
                </div>
            </div>

            <hr id="hrmiring">
            <div class="side">
                <div class="namapp">
                    <p class="namap">Ulasan PKL</p>
                </div>
                <hr>
                @if (count($ulasan) == 0)
                    <p class="namap" style="text-align: center">Data Ulasan Kosong</p>
                @else
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
                                    <div class="bar" style="--rating: {{ ($bintang[$i - 1] / $total) * 20 }}%;"></div>
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
                                <p id="bintangRev">{{ Bintang($ul->rating) }}</p>
                                <p id="desRev">{{ $ul->ulasan }}</p>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div> --}}
<div class="kanan border border-right d-flex flex-column justify-content-between" style="display:none;"
    style="height: 100%; width: 50%; margin-left: 5px;">
    <p style="margin-top: 1vh; margin-bottom: 1vh;">Hari dan Tanggal: {{ now()->format('l, d F Y') }}</p>
    <table id="tabelStruk" class="table" style="position: absolute; width: 33%; margin-top: 5vh">
        <thead>
            <tr>
                <th>ID PRODUK</th>
                <th>Stok Awal</th>
                <th>Stok Akhir</th>
                <th>Selisih</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
            @foreach ($riwayat as $r)
                @php
                    $pkl = App\Models\PKL::where('id', session('account')['id'])->first();
                @endphp
                <tr>
                    <td>{{ $r->idProduk }}</td>
                    <td>{{ $r->stokAwal }}</td>
                    <td>{{ $r->stokAkhir }}</td>
                    <td>{{ $r->stokAwal -  $r->stokAkhir}}</td>
                </tr>
            @endforeach
            {{-- <tr>
                <td colspan="3">Total Quantity</td>
                <td id="totalQuantity">{{ $jmlhtotal }}</td>
            </tr>
            <tr>
                <td colspan="3">Total Keseluruhan</td>
                <td id="totalKeseluruhan">{{ $pesan->TotalBayar }}</td>
            </tr> --}}
        </tfoot>
    </table>
</div>
@endsection

{{-- @php
    function Bintang($rating)
    {
        $back = 'kosong';
        for ($k = 1; $k <= $rating; $k++) {
            if ($back === 'kosong') {
                $back = '⭐️';
            } else {
                $back .= '⭐️';
            }
        }
        return $back;
    }

@endphp --}}
