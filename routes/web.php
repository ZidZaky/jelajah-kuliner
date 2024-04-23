<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\PKLController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UlasanController;
use Illuminate\Support\Facades\Route;

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
    return view('dashboard');
});
Route::get('/profile', function () {
    return view('profile');
});

Route::post('loginAccount', [AccountController::class, 'login']);
Route::get('logout', [AccountController::class, 'logoutAccount']);

Route::get('/dataPKL/{idAccount}', [PKLController::class, 'showDetail']);

Route::get('/login', function () {
    if (session()->has('account')) {
        return redirect('/dashboard');
    }
    return view('login');
});


Route::resource('/account', AccountController::class);
Route::resource('/PKL', PKLController::class);
Route::resource('/produk', ProdukController::class);
Route::resource('/ulasan', UlasanController::class);

// Define a route to fetch coordinates from the database
Route::get('/getCoordinates', [PKLController::class, 'getCoordinates']);
