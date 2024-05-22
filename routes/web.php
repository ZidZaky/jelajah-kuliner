<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\PKLController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\PesananController;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Route;
use App\Models\Ulasan;
use App\Models\Produk;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('map');
});
Route::get('/dashboard', function () {
    $ulasan = Ulasan::all(); // Fetch $ulasan from the database
    $produk = Produk::all(); // Fetch $ulasan from the database
    $pesanan = Pesanan::all();
    return view('dashboard', ['ulasan' => $ulasan,'produk' => $produk, 'pesanan' => $pesanan]);
});
Route::get('/profile', function () {
    return view('profile');
});

Route::post('loginAccount', [AccountController::class, 'login']);
Route::get('logout', [AccountController::class, 'logoutAccount']);
Route::get('pesanDetail/{id}', [PesananController::class, 'pesanDetail']);
Route::get('terimaPesanan/{id}', [PesananController::class, 'terimaPesanan']);
Route::get('tolakPesanan/{id}', [PesananController::class, 'tolakPesanan']);
Route::get('batalPesanan/{id}', [PesananController::class, 'batalPesanan']);
Route::get('selesaiPesanan/{id}', [PesananController::class, 'selesaiPesanan']);
Route::get('riwayatProduk/{id}', [ProdukController::class, 'riwayatProduk']);
Route::get('/buatStokAkhir/{id}', [ProdukController::class, 'buatStokAkhir']);
Route::get('/buatStokAwal/{id}', [ProdukController::class, 'buatStokAwal']);
Route::post('/buatHistory', [ProdukController::class, 'buatHistory']);
Route::post('/updateHistory', [ProdukController::class, 'updateHistory']);
Route::get('/hst',function(){
    return view('riwayatProduk'); });



Route::get('/dataPKL/{idAccount}', [PKLController::class, 'showDetail']);

Route::get('/login', function () {
    if (session()->has('account')) {
        return redirect('/dashboard');
    }
    return view('login');
});


Route::post('/account/{id}', [AccountController::class,'editProfile']);
Route::resource('/account', AccountController::class);
Route::resource('/PKL', PKLController::class);
Route::resource('/produk', ProdukController::class);
Route::resource('/ulasan', UlasanController::class);
Route::resource('/pesanan', PesananController::class);

Route::get('/pesanan/create/{id}', [PesananController::class, 'createWithId'])->name('pesanan.createWithId');


// Define a route to fetch coordinates from the database
Route::get('/getCoordinates', [PKLController::class, 'getCoordinates']);
// Route::get('/getUlasan', [UlasanController::class, 'getUlasan']);
Route::get('/getUlasan/{id}', [UlasanController::class, 'getUlasan']);
Route::get('/getProduk/{id}', [ProdukController::class, 'getProduk']);

Route::get('/ulasan/create/{id}', [UlasanController::class, 'createWithId']);
