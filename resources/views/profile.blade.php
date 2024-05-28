@extends('layouts.layout2')

@section('title')
    Feel Free to "JELAJAH" Kuliner dsekitarmu!
@endsection

@section('css')
    <link rel="stylesheet" href="css/profile.css">
    <style>
  .modal-content {
    background-color: #9C242C;
  }
</style>
@endsection

@section('main')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center" style="color: #F08A5D"><strong>MY PROFILE</strong></h5><br>
                <form method="POST" action="/account" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ session('account')->nama }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status Akun</label>
                        <input type="text" class="form-control" id="status" name="status" value="{{ session('account')->status }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ session('account')->email }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="noHP" class="form-label">Nomor Telpon</label>
                        <input type="number" class="form-control" id="noHP" name="noHP" value="{{ session('account')->nohp }}" readonly>
                    </div>
<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  edit profile
</button>

<!-- Modal -->
<div class="modal fade"  id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" style="color: white" >
    <div class="modal-content" >
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Profil</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
      <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ session('account')->nama }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status Akun</label>
                        <input type="text" class="form-control" id="status" name="status" value="{{ session('account')->status }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ session('account')->email }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="noHP" class="form-label">Nomor Telpon</label>
                        <input type="number" class="form-control" id="noHP" name="noHP" value="{{ session('account')->nohp }}" readonly>
                    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">batal</button>
        <button type="button" class="btn btn-success">simpan</button>
      </div>
    </div>
  </div>
</div>
                </form>

            </div>
        </div>
    </div>
@endsection
