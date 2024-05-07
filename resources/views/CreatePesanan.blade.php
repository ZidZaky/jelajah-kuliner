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
                    <p>Pesanan Anda</p>
                </div>
                <form action="/pesanan" method="POST">
                    @csrf
                    <input type="text" name="idAccount" id="idAccount" value="{{ session('account')['id'] }}" hidden>
                    <input type="text" name="idPKL" id="idPKL" value="{{ $pkl->id }}" hidden>
                    @if ($produk->count() > 0)
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
                                        <input type="number" id="myInput_{{ $p->id }}"
                                            name="produk_{{ $p->id }}" min="0" value="0">
                                        <input type="number" id="idProduk" name="idProduk_{{ $p->id }}"
                                            value="{{ $p->id }}" hidden>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="namap" style="text-align: center">Produk Kosong</p>
                    @endif
                    <p> Total Harga: Rp.
                        <input type="text" name="totalHarga" id="totalPrice" value="0" readonly> ,-
                    </p>
                    <label for="keterangan">Keterangan Tambahan (Opsional)</label>
                    <input type="text" name="keterangan" id="keterangan">
                    <input type="text" name="status" id="status" value="Pesanan Baru" hidden>
                    <button type="submit" class="btn btn-success">Ajukan Pesanan!</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Select all input fields with IDs starting with 'myInput_'
        document.querySelectorAll('input[id^="myInput_"]').forEach(function(input) {
            input.addEventListener('input', function() {
                // Call a function to recalculate the total price
                updateTotalPrice();
            });
        });

        // Function to update the total price based on the quantity of each product
        // Function to update the total price based on the quantity of each product
        function updateTotalPrice() {
            var totalPrice = 0;
            // Iterate through all input fields with IDs starting with 'myInput_'
            document.querySelectorAll('input[id^="myInput_"]').forEach(function(input) {
                // Get the quantity value of the current input field
                var quantity = parseInt(input.value);
                // Get the price of the product from the corresponding 'hrg' element
                var price = parseInt(input.closest('.card').querySelector('.hrg').textContent.replace('Rp. ', ''));
                // Calculate the subtotal for the current product and add it to the total price
                totalPrice += quantity * price;
            });
            // Update the total price input field value in the HTML
            document.getElementById('totalPrice').value = totalPrice;
        }
    </script>

@endsection
