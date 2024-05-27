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
                    <p>Account Reports!</p>
                </div>
                <hr>

                <div class="batas">
                    @if ($reports->count() > 0)
                        @foreach ($reports as $rep)
                            @php
                                $account = \App\Models\Account::where('id', $rep->idPengguna)->first();
                                // echo var_dump($account)
                            @endphp
                            <div class="card">
                                <div class="inCard" id="theImage">
                                    <img src="https://i.pinimg.com/236x/0d/c1/ba/0dc1babea2221d912247ca059e1231dd.jpg"
                                        alt="">
                                </div>
                                <div class="inCard" id="mid">
                                    <div class="button-only" style=" display: flex; flex; flex-direction:row;">


                                        @if ($account->status == 'Banned')
                                            <button class="btn btn-success" style="width: 100%;"
                                                onclick="confirmUnBan('{{ $rep->id }}')">unban User</button>
                                        @else
                                            <button class="btn btn-danger" style="width: 100%;"
                                                onclick="confirmBan('{{ $rep->id }}')">Ban
                                                User!</button>
                                        @endif
                                        <form action="{{ route('report.destroy', $rep->id) }}" method="POST" style="width: 100%;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-success" style="width: 100%;" onclick="return confirm('Apakah kamu yakin untuk Melakukan Hapus Report ini?')">Delete Report</button>
                                        </form>

                                    </div>
                                    <p class="np">{{ $account->nama }}</p>
                                    <p class="deskhusus">Kode Pesanan : {{ $rep->idPesanan }}, Pelapor :
                                        {{ $rep->idPelapor }}

                                    </p>
                                    <p class="hrg">{{ $rep->alasan }}</p>

                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="namap" style="text-align: center;">Semua Baik2 Saja!</p>
                    @endif
                </div>


            </div>
        </div>
    </div>
    <script>
        function confirmBan(id) {
            if (confirm("Apakah kamu yakin untuk Melakukan Ban Kepada Pengguna ini?")) {
                window.location.href = "/banUser/" + id;
            }
        }

        function confirmUnBan(id) {
            if (confirm("Apakah kamu yakin untuk Melakukan UnBan Kepada Pengguna ini?")) {
                window.location.href = "/unbanUser/" + id;
            }
        }

        function deletereport(id) {
            if (confirm("Apakah kamu yakin untuk Melakukan Hapus Report ini?")) {
                window.location.href = "report/" + id + "/delete/";
            }
        }
    </script>
@endsection
