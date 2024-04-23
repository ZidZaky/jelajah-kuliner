@extends('layouts.layout')

@section('title')
    REGISTRASI || JELAJAHKULINER
@endsection

@section('css')
    <link rel="stylesheet" href="/css/register.css">
@endsection

@section('main')
    <div class="container">
        <div class="card" >
            <div class="card-body">
                <h5 class="card-title text-center" style="color: #F08A5D"><strong>Buat Akun dan Mulailah Menjelajah!</strong></h5><br>
                    <form method="POST" action="/account" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Pengguna</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pengguna atau Nama PKL">
                        </div>

                        <div>
                            <label for="role" class="form-label" >Pilih Status Akunmu:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status"  id="status" value="Pelanggan">
                                <label class="form-check-label" for="Pelanggan">Pelanggan</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status" value="PKL">
                                <label class="form-check-label" for="PKL" >Pedagang Kaki Lima</label>
                            </div>
                        </div><br>

                        <div class="mb-3">
                            <label for="email" class="form-label" >Email</label>
                            <input type="email" class="form-control" id="email" name="email"  placeholder="Email Aktif">
                        </div>

                        <div class="mb-3">
                            <label for="nohp" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="nohp" name="nohp" placeholder="Nomor Telepon Aktif">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password Akun">
                        </div>

                        <div class="mb-3">
                            <label for="passwordkonf" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="passwordkonf" name="passwordkonf" placeholder="Ulangi Password">
                        </div>

                        <!-- <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1" style="color: #F9ED69">Saya yakin data diatas sudah benar dan sesuai</label>
                        </div> -->

                        <button type="submit" class="btn btn-success d-grid gap-2 col-4 mx-auto">Buat Akun!</button>
                    </form>
            </div>
        </div>
    </div>
@endsection
