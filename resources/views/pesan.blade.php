@extends('layouts.layout2')

@section('title')
    PESAN KULINERMU!
@endsection

@section('css')
    <link rel="stylesheet" href="/css/pesan.css">
@endsection

@section('main')
    <div class="all">
        <div class="up border border-bottom d-flex justify-content-between align-items-center">
            <a href="/dashboard"><button class="btn btn-danger">Batalkan Pesanan</button></a>
            <p class="namaakun m-0">Mau jajan apa, {{ session('account')['nama'] }}? 🤔</p>
            <form action="/pesanan" method="POST" class="m-0">
                <button type="submit" class="btn btn-success">Ajukan Pesanan!&#9998;</button>
        </div>
        <div class="nmpkl">

        </div>

        <div class="showmenu" style="padding-top: 5px; padding-bottom: 5px">
            <div class="kiri border border-right" style="width: 100%;">
                <h3 class="namap" style="border-bottom: 1px solid #ccc;"><strong>{{ $pkl->namaPKL }}</strong></h3>
                <p class="deskri">{{ $pkl->desc }}</p>

                    @csrf
                    <input type="text" name="idAccount" id="idAccount" value="{{ session('account')['id'] }}" hidden>
                    <input type="text" name="idPKL" id="idPKL" value="{{ $pkl->id }}" hidden>

                    @if ($produk->count() > 0)
                        @foreach ($produk as $p)
                            <div class="card" style="margin-top: 10px">
                                <div class="inCard" id="theImage">
                                    <img src="https://i.pinimg.com/564x/34/e1/30/34e13046e8f9fd9f3360568abd453685.jpg" alt="">

                                </div>
                                <div class="inCard" id="mid">
                                    <p class="np">{{ $p->nama }}</p>
                                    <p class="Des">{{ $p->deskripsi }}</p>
                                    <p class="hrg">Rp. {{ number_format($p->harga, 2, ',', '.') }}</p>
                                </div>
                                <div class="inCard" id="leftt">
                                    @if($p->sisaStok==0)
                                        <p>stok habis</p>
                                    @else
                                        <button type="button" class="btn btn-primary decrementButton"> - </button>
                                        <span class="quantity mx-2" id="quantity_{{ $p->id }}"> 0 </span>
                                        <button type="button" class="btn btn-primary incrementButton"> + </button>
                                        <input type="hidden" id="myInput_{{ $p->id }}"
                                            name="produk_{{ $p->id }}" value="0">
                                    @endif
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
                <p style="margin-top: 1vh; margin-bottom: 1vh; text-align: center;"><strong>(👉ﾟヮﾟ)👉  {{ now()->format('l, d F Y') }}  👈(ﾟヮﾟ👈)</strong></p>
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
                <div style="height: 100%; margin-top: 50vh;">
                    <label for="keterangan">Keterangan Tambahan (Opsional):</label>
                    <br>
                    <input type="text" name="keterangan" id="keterangan" value="-" placeholder="Contoh: Tidak pedas ya mas!" style="width: 80%; height: 5vh;">
                </div>
                </form>

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
