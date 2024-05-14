@extends('layouts.layout2')

@section('title')
    Tracking Map - Jelajah Kuliner
@endsection

@section('css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
@endsection

@section('main')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="z-index: 100">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div id="map"></div>
    <div class="listPesanan" style="display:none;">
        <div class="NavbarAtasPesanan">
            <p>Pesanan</p>
            <button id="butClosePesanan"onclick="closePesanan()">X</button>
        </div>
        <div class="ContentPesanan">
            <div class="tablePesanan">
                <div class="miniNavbar" style="padding-bottom:0; margin-bottom:0;">
                    <?php
                    $jmlh = 0;
                    $jmlh_pb = 0;
                    $jmlh_pd = 0;
                    $jmlh_ps = 0;
                    foreach ($pesanan as $pesan) {
                        if ($pesan->idAccount == session('account')['id']) {
                            $jmlh++;
                        }
                    }
                    foreach ($pesanan as $pesan) {
                        if ($pesan->status == 'Pesanan Baru' && $pesan->idAccount == session('account')['id']) {
                            $jmlh_pb++;
                        }
                    }
                    foreach ($pesanan as $pesan) {
                        if ($pesan->status == 'Pesanan Diproses' && $pesan->idAccount == session('account')['id']) {
                            $jmlh_pd++;
                        }
                    }
                    foreach ($pesanan as $pesan) {
                        if ($pesan->status == 'Pesanan Selesai' && $pesan->idAccount == session('account')['id']) {
                            $jmlh_ps++;
                        }
                    }
                    $account = \App\Models\Account::where('id', $pesan->idAccount)->first();

                    ?>
                    <button type="" id="butAllPes" onclick="changePesanan('AllPesanan')">Semua Pesanan
                        ({{ $jmlh }})</button>
                    <button type="" id="butNewPes" onclick="changePesanan('newPesanan')">Pesanan Baru
                        ({{ $jmlh_pb }})</button>
                    <button type="" id="butAccPes" onclick="changePesanan('terimaPesanan')">Pesanan
                        Diproses({{ $jmlh_pd }})</button>
                    <button type="" id="butDonePes" onclick="changePesanan('donePesanan')">Pesanan
                        Selesai({{ $jmlh_ps }})</button>
                </div>
                <!-- <hr style="padding : 0 0; margin: 0 0; color: white;"> -->
                <div class="table" id="tuebel">
                    <div class="allPesanan">
                        <div class="subTable">
                            <p class="tpemesan">TANGGAL</p>
                            <p class="tproduk">PEMESAN</p>
                            <p class="tstok">TOTAL</p>
                            <p class="ttotal">STATUS</p>
                            <p class="tstatus">DETIL</p>
                        </div>
                        <div class="TableSide" id="SemuaPesanan" style="display: none;">
                            @if ($jmlh != 0)
                                @foreach ($pesanan as $pesan)
                                    @if ($pesan->idAccount == session('account')['id'])
                                        <div class="deTable">
                                            <div class="isiDeTable">
                                                <p class="tpemesan">{{ $pesan->created_at->format('d-m-Y') }}</p>
                                                <p class="tproduk">{{ $account->nama }}</p>
                                                <p class="tstok">Rp. {{ $pesan->TotalBayar }},-</p>
                                                <div class="ttotal">
                                                    <p class="dstatus">{{ $pesan->status }}</p>
                                                </div>
                                                <!-- <p class="ttotal">MENUNGGU DITERIMA</p> -->
                                                <div class="tstatus">
                                                    <button><a href="/pesanDetail/{{$pesan->id}}"
                                                            style="text-decoration:none; color:white">DETIL</a></button>
                                                    @php
                                                        $pklExists = \App\Models\PKL::where(
                                                            'idAccount',
                                                            session('account')['id'],
                                                        )->exists();
                                                    @endphp
                                                    @if ($pesan->status == 'Pesanan Baru' && $pklExists && session('account')['status'] == 'PKL')
                                                        <button class="btn btn-success" style="background-color: green"><a
                                                                href=""
                                                                style="text-decoration:none; color:white">Terima
                                                                Pesanan</a></button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <h2>Data Kosong</h2>
                            @endif
                        </div>
                        <div class="TableSide" id="NewPesanan" style="display: none;">

                            @if ($jmlh_pb != 0)
                                @foreach ($pesanan as $pesan)
                                    @if ($pesan->idAccount == session('account')['id'] && $pesan->status == 'Pesanan Baru')
                                        <div class="deTable">
                                            <div class="isiDeTable">
                                                <p class="tpemesan">{{ $pesan->created_at->format('d-m-Y') }}</p>
                                                <p class="tproduk">{{ $account->nama }}</p>
                                                <p class="tstok">Rp. {{ $pesan->TotalBayar }},-</p>
                                                <div class="ttotal">
                                                    <p class="dstatus">{{ $pesan->status }}</p>
                                                </div>
                                                <!-- <p class="ttotal">MENUNGGU DITERIMA</p> -->
                                                <div class="tstatus">
                                                    <button>DETIL</button>
                                                    @php
                                                        $pklExists = \App\Models\PKL::where(
                                                            'idAccount',
                                                            session('account')['id'],
                                                        )->exists();
                                                    @endphp
                                                    @if ($pesan->status == 'Pesanan Baru' && $pklExists && session('account')['status'] == 'PKL')
                                                        <button class="btn btn-success" style="background-color: green"><a
                                                                href=""
                                                                style="text-decoration:none; color:white">Terima
                                                                Pesanan</a></button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <h2>Data Kosong</h2>
                            @endif


                        </div>
                        <div class="TableSide" id="DiterimaPesanan" style="display:none;">
                            @if ($jmlh_pd != 0)
                                @foreach ($pesanan as $pesan)
                                    @if ($pesan->idAccount == session('account')['id'] && $pesan->status == 'Pesanan Diproses')
                                        <div class="deTable">
                                            <div class="isiDeTable">
                                                <p class="tpemesan">{{ $pesan->created_at->format('d-m-Y') }}</p>
                                                <p class="tproduk">{{ $account->nama }}</p>
                                                <p class="tstok">Rp. {{ $pesan->TotalBayar }},-</p>
                                                <div class="ttotal">
                                                    <p class="dstatus">{{ $pesan->status }}</p>
                                                </div>
                                                <!-- <p class="ttotal">MENUNGGU DITERIMA</p> -->
                                                <div class="tstatus">
                                                    <button>DETIL</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <h2>Data Kosong</h2>
                            @endif

                        </div>
                        <div class="TableSide" id="DonePesanan" style="display:none;">
                            @if ($jmlh_ps != 0)
                                @foreach ($pesanan as $pesan)
                                    @if ($pesan->idAccount == session('account')['id'] && $pesan->status == 'Pesanan Selesai')
                                        <div class="deTable">
                                            <div class="isiDeTable">
                                                <p class="tpemesan">{{ $pesan->created_at->format('d-m-Y') }}</p>
                                                <p class="tproduk">{{ $account->nama }}</p>
                                                <p class="tstok">Rp. {{ $pesan->TotalBayar }},-</p>
                                                <div class="ttotal">
                                                    <p class="dstatus">{{ $pesan->status }}</p>
                                                </div>
                                                <!-- <p class="ttotal">MENUNGGU DITERIMA</p> -->
                                                <div class="tstatus">
                                                    <button>DETIL</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <h2>Data Kosong</h2>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="accountDetails">
        <button onclick="closeAccountDetails()" class="btn btn-danger">X</button>
        {{-- <button class="btn btn-danger">X</button> --}}
        <p id="namaPKL"></p><br>
        <img src="https://i.pinimg.com/736x/da/5e/ba/da5eba94367e1a2aaa683f1acc105f97.jpg" alt="PKL Photo Goes Here">

        <div id="tsur" style="">
            <button id="butUlasan" onclick="changeContent('Ulasan')" type="button" class="btn btn-success"
                style="opacity:100%">Ulasan</button>
            <button id="butMenu"onclick="changeContent('Menu')" type="button" class="btn btn-success">Menu</button>
            <button id="butPesan"onclick="changeContent('Pesan')" type="button" class="btn btn-success">Pesan</button>
        </div>

        <div id="createUlasan" style="margin: 0">

        </div>
        <div id="contentWrapper">

            @if (session('account')['status'] != 'PKL')
                <button id="reviewButton">
                    <img src="https://www.gstatic.com/images/icons/material/system_gm/2x/rate_review_gm_blue_18dp.png"
                        alt="Gambar">
                    <p>Berikan Reviewmu</p>
                </button>
            @endif
            <div id="contentUlasan">





            </div>

            <div id="contentMenu" style="display: none;">
                <div class="cardMenu">
                    <div class="leffft">
                        <img src="https://i.pinimg.com/564x/b8/cf/ab/b8cfabff7a8e6a304d82a0a33c2c5e8e.jpg" alt="">
                        <p></p>
                    </div>

                    <div class="RightSide">
                        <p id="nmProduct"></p>
                        <p id="deskrip"></p>
                        <hr>
                        <div class="forStok">
                            <p id="stock">Stok :</p>
                            <p id="numstok"></p>
                        </div>
                    </div>
                </div>

            </div>

            <div id="contentPesan" style="display: none;">

            </div>
        </div>
    </div>
    <!-- <script>
        src = "js/pesanan.js"
    </script> -->
    <script src="/js/pesanan.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/leaflet/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var alert = document.querySelector('.alert');
                if (alert) {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 5000); // 5 seconds
        });
        // opacityList('Ulasan');
        function deBintang(rtg) {
            let back = "kosong";
            for (let i = 1; i <= rtg; i++) {
                if (back === 'kosong') {
                    back = '⭐️';
                } else {
                    let temp = '⭐️' + back;
                    back = temp;
                }
            }
            // console.log(back);
            return back;
        }

        // document.getElementById('accountDetails').style.display = 'block';
        let ulas = document.getElementById('contentUlasan');
        let menu = document.getElementById('contentMenu');
        let pesan = document.getElementById('contentPesan');
        let bunkus = document.getElementById('contentWrapper');

        if (ulas.style.display == 'none' && menu.style.display == 'none' && pesan.style.display == 'none') {
            bunkus.style.height = '350px';
        }
        var map = L.map("map").setView([-7.2575, 112.7521], 12); // Set view to Surabaya, Indonesia

        var osm = L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        });
        osm.addTo(map);

        fetch('/getCoordinates')
            .then(response => response.json())
            .then(data => {
                data.forEach(coordinates => {
                    // Create a marker for each coordinate on the map
                    const marker = L.marker([coordinates.latitude, coordinates.longitude]).addTo(map);

                    // Pass the id to the displayAccountDetails function when marker is clicked
                    marker.on('click', function() {
                        displayAccountDetails(coordinates.id, coordinates.namaPKL);
                        fillContentUlasan(coordinates.id);
                        fillContentMenu(coordinates.id);
                        fillContentPesan(coordinates.id);

                        // Get the button element
                        const button = document.getElementById('reviewButton');

                        // Add click event listener to the button
                        button.addEventListener('click', function() {
                            // Redirect to the specified URL when the button is clicked
                            window.location.href = `/ulasan/create/${coordinates.id}`;

                        });
                    });
                });
            })
            .catch(error => {
                console.error('Error fetching coordinates:', error);
            });


        // Function to display account details in the accountDetails div
        function displayAccountDetails(id, namaPKL) {
            document.getElementById('namaPKL').innerText = namaPKL;
            document.getElementById('accountDetails').style.display = 'block';
        }

        // Event listener for marker click event
        marker

        function closeAccountDetails() {
            document.getElementById('accountDetails').style.display = 'none'; // Hide the accountDetails div
            // Reset account details
            document.getElementById('accountName').innerText = '';
            document.getElementById('accountEmail').innerText = '';
            document.getElementById('accountNohp').innerText = '';
            document.getElementById('accountStatus').innerText = '';
        }

        // Function to change content based on button click
        function changeContent(buttonName) {
            // Hide all content divs

            document.getElementById('contentUlasan').style.display = 'none';
            document.getElementById('contentMenu').style.display = 'none';
            document.getElementById('contentPesan').style.display = 'none';
            // document.getElementById('reviewButton').style.display = 'none';

            // // Show the corresponding content div
            // if (buttonName == 'Ulasan') {
            //     document.getElementById('reviewButton').style.display = 'block';
            // }
            document.getElementById('content' + buttonName).style.display = 'block';
            opacityList(buttonName);
        }
        // opacityList('Ulasan');
        // opacityList("Ulasan");
        function opacityList(jenis) {
            let menu = document.getElementById('butMenu');
            let ulas = document.getElementById('butUlasan');
            let pesan = document.getElementById('butPesan');
            menu.style.opacity = "50%";
            ulas.style.opacity = "50%";
            pesan.style.opacity = "50%";
            if (jenis == 'Ulasan') {
                ulas.style.opacity = "100%";
            }
            if (jenis == 'Menu') {
                menu.style.opacity = "100%"
            }
            if (jenis == 'Pesan') {
                pesan.style.opacity = "100%";
            }
        }




        function fillContentUlasan(id) {
            // Fetch ulasan data for the specific PKL ID
            fetch(`/getUlasan/${id}`)
                .then(response => response.json())
                .then(data => {
                    const ulasanContainer = document.getElementById('contentUlasan');
                    ulasanContainer.innerHTML = ''; // Clear previous ulasan
                    // console.log(data.length);
                    if (data.length === 0) {
                        console.log('tes');
                        const emptyDataMessage = document.createElement('h1');
                        emptyDataMessage.innerText = 'Data Ulasan Kosong';
                        console.log('apani :' + emptyDataMessage.innerText);

                        ulasanContainer.appendChild(emptyDataMessage);
                    } else {
                        data.forEach(ulasan => {
                            const ulasanDiv = document.createElement('div');
                            ulasanDiv.classList.add('cardUlasan');

                            const divWrapper = document.createElement('div');
                            divWrapper.classList.add('ulasan-content');

                            const img = document.createElement('img');
                            img.src = 'https://i.pinimg.com/564x/02/b8/50/02b850fcc321beaa87d8459daa6509de.jpg';
                            img.classList.add('ulasan-image');
                            divWrapper.appendChild(img);

                            const detailDiv = document.createElement('div');
                            detailDiv.classList.add('ulasan-details');

                            const namaAkun = document.createElement('p');
                            console.log(ulasan);
                            namaAkun.innerText = ulasan.idAccount;
                            namaAkun.classList.add('nmAkun');
                            detailDiv.appendChild(namaAkun);

                            const tanggal = document.createElement('p');
                            tanggal.innerText = 'tanggal';
                            tanggal.classList.add('nmAkun');
                            detailDiv.appendChild(tanggal);

                            divWrapper.appendChild(detailDiv);



                            divWrapper.appendChild(detailDiv);




                            ulasanDiv.appendChild(divWrapper);

                            const hr = document.createElement('hr');
                            ulasanDiv.appendChild(hr);

                            const ulasanParagraph = document.createElement('p');
                            ulasanParagraph.innerText = ulasan.ulasan;
                            ulasanParagraph.classList.add('ulasan');
                            ulasanDiv.appendChild(ulasanParagraph);


                            const rating = document.createElement('p');
                            rating.innerText = deBintang(ulasan.rating);
                            // deBintang(5);
                            // ulasan.rating +
                            rating.classList.add('rating');
                            divWrapper.appendChild(rating);

                            ulasanContainer.appendChild(ulasanDiv);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching ulasan:', error);
                });
        }



        function fillContentMenu(id) {
            // Fetch product data for the specific PKL ID
            fetch(`/getProduk/${id}`)
                .then(response => response.json())
                .then(data => {
                    const menuContainer = document.getElementById('contentMenu');
                    menuContainer.innerHTML = ''; // Clear previous menu

                    if (data.length === 0) {
                        const emptyDataMessage = document.createElement('h1');
                        emptyDataMessage.innerText = 'Data Menu Kosong';
                        menuContainer.appendChild(emptyDataMessage);
                    } else {
                        data.forEach(product => {
                            const cardMenuDiv = document.createElement('div');
                            cardMenuDiv.classList.add('cardMenu');

                            const leftDiv = document.createElement('div');
                            leftDiv.classList.add('leffft');

                            const img = document.createElement('img');
                            img.src = "https://i.pinimg.com/564x/b8/cf/ab/b8cfabff7a8e6a304d82a0a33c2c5e8e.jpg";
                            img.alt = product.namaProduk;
                            leftDiv.appendChild(img);

                            const hargaP = document.createElement('p');
                            hargaP.innerText = `Rp.${product.harga},-`;
                            leftDiv.appendChild(hargaP);

                            cardMenuDiv.appendChild(leftDiv);

                            const rightDiv = document.createElement('div');
                            rightDiv.classList.add('RightSide');

                            const namaProdukP = document.createElement('p');
                            namaProdukP.id = 'nmProduct';
                            namaProdukP.innerText = product.namaProduk;
                            rightDiv.appendChild(namaProdukP);

                            const deskripP = document.createElement('p');
                            deskripP.id = 'deskrip';
                            deskripP.innerText = product.desc;
                            rightDiv.appendChild(deskripP);

                            const hr = document.createElement('hr');
                            rightDiv.appendChild(hr);

                            const forStokDiv = document.createElement('div');
                            forStokDiv.classList.add('forStok');

                            const stockP = document.createElement('p');
                            stockP.id = 'stock';
                            stockP.innerText = 'Stok :';
                            forStokDiv.appendChild(stockP);

                            const numStokP = document.createElement('p');
                            numStokP.id = 'numstok';
                            numStokP.innerText = product.stok;
                            forStokDiv.appendChild(numStokP);

                            rightDiv.appendChild(forStokDiv);

                            cardMenuDiv.appendChild(rightDiv);

                            menuContainer.appendChild(cardMenuDiv);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching product data:', error);
                });
        }

        function fillContentPesan(id) {
            // Get the contentPesan div
            var contentPesanDiv = document.getElementById("contentPesan");

            // Clear any existing content in the contentPesan div
            contentPesanDiv.innerHTML = '';

            // Create a button element
            var button = document.createElement("button");

            // Set the button text
            button.textContent = "Pesan Sekarang!";

            // Set up a click event listener
            button.addEventListener("click", function() {
                // Redirect to the order page with the provided ID
                window.location.href = "pesanan/create/" + id;
            });

            // Append the button to the contentPesan div
            contentPesanDiv.appendChild(button);
        }
    </script>
@endsection
