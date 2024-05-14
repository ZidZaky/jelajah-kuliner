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
            <form action="/pesanan" method="POST">
            <a><button type="submit" class="btn btn-success"><span>Ajukan Pesanan!
                        &#9998;</span></button></a>
        </div>
        <div class="nmpkl">
            <p class="namap">{{ $pkl->namaPKL }}</p>
            <p class="deskri">{{ $pkl->desc }}</p>
        </div>

        <div class="showmenu" style="padding-top: 5px; padding-bottom: 5px">
            <div class="kiri border border-right" style="width: 100%;">
                <p>Pesanan Anda</p>

                    @csrf
                    <input type="text" name="idAccount" id="idAccount" value="{{ session('account')['id'] }}" hidden>
                    <input type="text" name="idPKL" id="idPKL" value="{{ $pkl->id }}" hidden>

                    @if ($produk->count() > 0)
                        @foreach ($produk as $p)
                            <div class="card">
                                <div class="inCard" id="theImage">
                                    <img src="{{ $p->image_url }}" alt="" width="100px">
                                </div>
                                <div class="inCard" id="mid">
                                    <p class="np">{{ $p->namaProduk }}</p>
                                    <p class="Des">{{ $p->desc }}</p>
                                    <p class="hrg">Rp. {{ number_format($p->harga, 2, ',', '.') }}</p>
                                </div>
                                <div class="inCard" id="leftt">
                                    <button type="button" class="btn btn-primary decrementButton"> - </button>
                                    <span class="quantity mx-2" id="quantity_{{ $p->id }}"> 0 </span>
                                    <button type="button" class="btn btn-primary incrementButton"> + </button>
                                    <input type="hidden" id="myInput_{{ $p->id }}"
                                        name="produk_{{ $p->id }}" value="0">
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="namap" style="text-align: center">Produk Kosong</p>
                    @endif


                    <input type="text" name="totalHarga" id="totalPrice" value="0" hidden>


                    <input type="text" name="status" id="status" value="Pesanan Baru" hidden>

            </div>

            <div class="kanan border border-right d-flex flex-column justify-content-between"
                style="height: 100%; width: 50%; margin-left: 5px;">
                <p style="margin-top: 1vh; margin-bottom: 1vh;">Hari dan Tanggal: {{ now()->format('l, d F Y') }}</p>
                <table id="tabelStruk" class="table" style="position: absolute; width: 33%; margin-top: 5vh">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Nama Produk</th>
                            <th>Quantity</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Total Quantity</td>
                            <td id="totalQuantity"></td>
                        </tr>
                        <tr>
                            <td colspan="3">Total Keseluruhan</td>
                            <td id="totalKeseluruhan"></td>
                        </tr>
                    </tfoot>
                </table>
                <div>
                    <label for="keterangan">Keterangan Tambahan (Opsional)</label><br>
                    <input type="text" name="keterangan" id="keterangan" value="-">
                </div>
                </form>
                <a class="align-self-center mb-2" href="/dashboard"><button class="btn btn-danger">Batalkan
                        Pesanan</button></a>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.incrementButton').forEach(button => {
            button.addEventListener('click', function() {
                let quantityElement = this.closest('.inCard').querySelector('.quantity');
                let quantity = parseInt(quantityElement.textContent);
                quantity++;
                quantityElement.textContent = quantity;
                this.nextElementSibling.value = quantity; // Update hidden input value
                updateTotalPriceAndTable();
            });
        });

        document.querySelectorAll('.decrementButton').forEach(button => {
            button.addEventListener('click', function() {
                let quantityElement = this.closest('.inCard').querySelector('.quantity');
                let quantity = parseInt(quantityElement.textContent);
                if (quantity > 0) {
                    quantity--;
                    quantityElement.textContent = quantity;
                    this.nextElementSibling.value = quantity; // Update hidden input value
                    updateTotalPriceAndTable();
                }
            });
        });

        function updateTotalPriceAndTable() {
            var totalPrice = 0;
            var totalQuantity = 0;
            var tabelStruk = document.getElementById('tabelStruk').querySelector('tbody');
            tabelStruk.innerHTML = ''; // Clear the table on update
            let nomor = 1;

            document.querySelectorAll('.card').forEach(card => {
                let quantity = parseInt(card.querySelector('.quantity').textContent);
                if (quantity > 0) {
                    let productName = card.querySelector('.np').textContent;
                    let productPrice = parseInt(card.querySelector('.hrg').textContent.replace('Rp. ', '').replace(
                        /\./g, '').replace(/,00/g, ''));
                    let totalHarga = quantity * productPrice;
                    totalPrice += totalHarga;
                    totalQuantity += quantity;
                    let row = `<tr>
                                <td>${nomor++}</td>
                                <td>${productName}</td>
                                <td>${quantity}</td>
                                <td>Rp. ${totalHarga.toLocaleString('id-ID', {minimumFractionDigits: 2})}</td>
                              </tr>`;
                    tabelStruk.innerHTML += row;
                }
            });

            document.getElementById('totalPrice').value = totalPrice.toLocaleString('id-ID');
            document.getElementById('totalKeseluruhan').textContent =
                `Rp. ${totalPrice.toLocaleString('id-ID', {minimumFractionDigits: 2})}`;
            document.getElementById('totalQuantity').textContent = totalQuantity;
        }
    </script>
@endsection
