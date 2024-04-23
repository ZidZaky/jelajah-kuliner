@extends('layouts.layout2')

@section('title')
    Feel Free to "JELAJAH" Kuliner dsekitarmu!
@endsection

@section('css')
    <link rel="stylesheet" href="/css/dataPKL.css">
@endsection

@section('main')
    <div class="countent">
        <div class="up">
            <div class="upside">
                <p class="namaakun">Hi, {{ session('account')['nama'] }} 👋</p>
            </div>
            <button type="" id="butEdit"><span>&#9998</span></button>

        </div>
        <hr id="hratas">
        <div class="outer">
            <div class="demain">
                <div class="nmpkl">
                    <p class="namap">{{ $pkl->namaPKL }}</p>
                    <p class="deskri">{{ $pkl->desc }}</p>
                    <p>Produk anda</p>
                    <!-- <hr> -->
                </div>
                <!-- <hr> -->
                {{-- {{dd($produk)}} --}}
                @if ($produk->count() > 0)
                    @foreach ($produk as $p)
                        <div class="batas">
                            <div class="card">
                                <div class="inCard" id="theImage">
                                    <img src="https://i.pinimg.com/564x/34/e1/30/34e13046e8f9fd9f3360568abd453685.jpg"
                                        alt="">
                                </div>
                                <div class="inCard" id="mid">
                                    <p class="np">{{$p->namaProduk}}</p>
                                    <p class="Des">{{$p->desc}}</p>
                                    <p class="hrg">Rp. {{$p->harga}}</p>
                                </div>
                                <div class="inCard" id="leftt">
                                    <p class="stok">Stok</p>
                                    <p class="numberr">{{$p->stok}}</p>
                                    <!-- <div class="plmn">
                                <button type="" class="butPluss">+</button>
                                <button type="" class="butMin">-</button>
                            </div> -->

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
                        <div class="rating-chart">
                            <p class="derating">⭐️ 5</p>
                            <div class="bar" style="--rating: 90%;"></div>
                            <div class="percentage">(90%)</div>
                        </div>

                        <div class="rating-chart">
                            <p class="derating">⭐️ 4</p>
                            <div class="bar" style="--rating: 80%;"></div>
                            <div class="percentage">(80%)</div>
                        </div>

                        <div class="rating-chart">
                            <p class="derating">⭐️ 3</p>
                            <div class="bar" style="--rating: 60%;"></div>
                            <div class="percentage">(60%)</div>
                        </div>

                        <div class="rating-chart">
                            <p class="derating">⭐️ 2</p>
                            <div class="bar" style="--rating: 40%;"></div>
                            <div class="percentage">(40%)</div>
                        </div>

                        <div class="rating-chart">
                            <p class="derating">⭐️ 1</p>
                            <div class="bar" style="--rating: 20%;"></div>
                            <div class="percentage">(20%)</div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="listRev">
                    <div class="cardRev">
                        <p id="namaRev">Nama Pereview</p>
                        <hr>
                        <p id="bintangRev">⭐️⭐️⭐️⭐️⭐️</p>
                        <p id="desRev">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque explicabo eius ad
                            non doloribus tempora delectus, accusantium excepturi quasi nam, deserunt blanditiis in?
                            Suscipit est reprehenderit ab, amet aliquid voluptas.</p>
                        <hr>
                    </div>

                    <div class="cardRev">
                        <p id="namaRev">Nama Pereview</p>
                        <hr>
                        <p id="bintangRev">⭐️⭐️⭐️⭐️⭐️</p>
                        <p id="desRev">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque explicabo eius ad
                            non doloribus tempora delectus, accusantium excepturi quasi nam, deserunt blanditiis in?
                            Suscipit est reprehenderit ab, amet aliquid voluptas.</p>
                        <hr>
                    </div>

                    <div class="cardRev">
                        <p id="namaRev">Nama Pereview</p>
                        <hr>
                        <p id="bintangRev">⭐️⭐️⭐️⭐️⭐️</p>
                        <p id="desRev">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque explicabo eius ad
                            non doloribus tempora delectus, accusantium excepturi quasi nam, deserunt blanditiis in?
                            Suscipit est reprehenderit ab, amet aliquid voluptas.</p>
                        <hr>
                    </div>

                    <div class="cardRev">
                        <p id="namaRev">Nama Pereview</p>
                        <hr>
                        <p id="bintangRev">⭐️⭐️⭐️⭐️⭐️</p>
                        <p id="desRev">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque explicabo eius ad
                            non doloribus tempora delectus, accusantium excepturi quasi nam, deserunt blanditiis in?
                            Suscipit est reprehenderit ab, amet aliquid voluptas.</p>
                        <hr>
                    </div>

                    <div class="cardRev">
                        <p id="namaRev">Nama Pereview</p>
                        <hr>
                        <p id="bintangRev">⭐️⭐️⭐️⭐️⭐️</p>
                        <p id="desRev">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque explicabo eius ad
                            non doloribus tempora delectus, accusantium excepturi quasi nam, deserunt blanditiis in?
                            Suscipit est reprehenderit ab, amet aliquid voluptas.</p>
                        <hr>
                    </div>

                    <div class="cardRev">
                        <p id="namaRev">Nama Pereview</p>
                        <hr>
                        <p id="bintangRev">⭐️⭐️⭐️⭐️⭐️</p>
                        <p id="desRev">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque explicabo eius ad
                            non doloribus tempora delectus, accusantium excepturi quasi nam, deserunt blanditiis in?
                            Suscipit est reprehenderit ab, amet aliquid voluptas.</p>
                        <hr>
                    </div>

                    <div class="cardRev">
                        <p id="namaRev">Nama Pereview</p>
                        <hr>
                        <p id="bintangRev">⭐️⭐️⭐️⭐️⭐️</p>
                        <p id="desRev">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque explicabo eius ad
                            non doloribus tempora delectus, accusantium excepturi quasi nam, deserunt blanditiis in?
                            Suscipit est reprehenderit ab, amet aliquid voluptas.</p>
                        <hr>
                    </div>

                    <div class="cardRev">
                        <p id="namaRev">Nama Pereview</p>
                        <hr>
                        <p id="bintangRev">⭐️⭐️⭐️⭐️⭐️</p>
                        <p id="desRev">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque explicabo eius ad
                            non doloribus tempora delectus, accusantium excepturi quasi nam, deserunt blanditiis in?
                            Suscipit est reprehenderit ab, amet aliquid voluptas.</p>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
