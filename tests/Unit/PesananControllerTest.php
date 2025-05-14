<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Models\Pesanan;
use App\Models\ProdukDipesan;
use App\Models\PKL;
use App\Models\Produk;



class PesananControllerTest extends TestCase
{
    // use RefreshDatabase;

    public function testCreateView()
    {
        // Buat akun baru di database
        $account = \App\Models\Account::factory()->create([
            'nama' => 'PKL Test User',
            'email' => 'pkl@example.com',
            'nohp' => '08123456789',
            'password' => bcrypt('password'), // atau Hash::make
            'status' => 'PKL'
        ]);

        // Simulasikan session seolah user tersebut sedang login
        $this->withSession([
            'account' => [
                'id' => $account->id,
                'nama' => $account->nama,
                'email' => $account->email,
                'nohp' => $account->nohp,
                'status' => $account->status
            ]
        ]);

        // Ambil ID PKL secara acak dari database
        $randomId = \App\Models\Pkl::inRandomOrder()->first()->id;

        // Kirimkan request ke URL create pesanan dengan ID yang diambil secara acak
        $response = $this->get("/pesanan/create/{$randomId}");
        // dd($response);
        // Verifikasi bahwa pengguna diarahkan ke halaman create pesanan
        $response->assertStatus(status: 200);  // atau sesuaikan dengan status yang benar

        // Atau untuk verifikasi lebih lanjut, bisa cek URL yang diteruskan
        // $response->assertRedirect("/pesanan/create/{$randomId}");
    }

    public function testStorePesanan()
    {
        // Buat akun baru di database
        $account = \App\Models\Account::factory()->create([
            'nama' => 'PKL Test User',
            'email' => 'pkl@example.com',
            'nohp' => '08123456789',
            'password' => bcrypt('password'),
            'status' => 'PKL'
        ]);

        // Simulasikan session login
        $this->withSession([
            'account' => [
                'id' => $account->id,
                'nama' => $account->nama,
                'email' => $account->email,
                'nohp' => $account->nohp,
                'status' => $account->status
            ]
        ]);

        // Ambil ID PKL secara acak dari database
        $randomId = \App\Models\Pkl::inRandomOrder()->first()->id;

        // Buat produk untuk PKL tersebut
        $produk = \App\Models\Produk::factory()->create([
            'idPKL' => $randomId,
        ]);
        $produkId = $produk->id;

        // Kirimkan POST request ke /pesanan
        $response = $this->post('/pesanan', [
            'idAccount' => $account->id, // ✅ Pakai ID account yang benar
            'idPKL' => $randomId,
            'totalHarga' => 20000,
            'status' => 'Pesanan Baru',
            'keterangan' => 'Tidak pedas ya mas!',
            'produk_' . $produkId => 2,
        ]);

        // Pastikan statusnya 200
        $response->assertStatus(302);

        // Verifikasi bahwa pesanan tersimpan dalam database
        $this->assertDatabaseHas('pesanans', [
            'idAccount' => $account->id,
            'idPKL' => $randomId,
            'TotalBayar' => 20000,
            'status' => 'Pesanan Baru',
            'Keterangan' => 'Tidak pedas ya mas!',
        ]);

        // Ambil ID pesanan terakhir
        $lastPesananId = \App\Models\Pesanan::latest()->first()->id;

        // Cek bahwa produk dipesan tercatat
        $this->assertDatabaseHas('produk_dipesan', [
            'idPesanan' => $lastPesananId,
            'idProduk' => $produkId,
            'JumlahProduk' => 2,
        ]);
    }

    public function testCreateWithId()
    {
        $account = \App\Models\Account::factory()->create([
            'nama' => 'PKL Test User',
            'email' => 'pkl@example.com',
            'nohp' => '08123456789',
            'password' => bcrypt('password'), // atau Hash::make
            'status' => 'PKL'
        ]);

        // Simulasikan session seolah user tersebut sedang login
        $this->withSession([
            'account' => [
                'id' => $account->id,
                'nama' => $account->nama,
                'email' => $account->email,
                'nohp' => $account->nohp,
                'status' => $account->status
            ]
        ]);

        $pkl = \App\Models\Pkl::inRandomOrder()->first();
        // dd($pkl);
        $response = $this->get('/pesanan/create/' . $pkl->id);
        // dd($response[0]);

        // Cek hasil response
        $response->assertStatus(200);
        $response->assertViewIs('pesan');
        $response->assertViewHas('pkl');
        $response->assertViewHas('produk');
    }

    public function testPesanDetail()
    {
        $account = \App\Models\Account::factory()->create([
            'nama' => 'PKL Test User',
            'email' => 'pkl@example.com',
            'nohp' => '08123456789',
            'password' => bcrypt('password'), // atau Hash::make
            'status' => 'PKL'
        ]);

        // Simulasikan session seolah user tersebut sedang login
        $this->withSession([
            'account' => [
                'id' => $account->id,
                'nama' => $account->nama,
                'email' => $account->email,
                'nohp' => $account->nohp,
                'status' => $account->status
            ]
        ]);

        $pesanan = \App\Models\Pesanan::inRandomOrder()->first();
        // dd($pesanan);
        $response = $this->get('pesanDetail/' . $pesanan->id);
        // dd($response[0]);
        $response->assertStatus(200);
    }

    public function testTerimaPesanan()
    {
        $account = \App\Models\Account::factory()->create([
            'nama' => 'PKL Test User',
            'email' => 'pkl@example.com',
            'nohp' => '08123456789',
            'password' => bcrypt('password'), // atau Hash::make
            'status' => 'PKL'
        ]);

        // Simulasikan session seolah user tersebut sedang login
        $this->withSession([
            'account' => [
                'id' => $account->id,
                'nama' => $account->nama,
                'email' => $account->email,
                'nohp' => $account->nohp,
                'status' => $account->status
            ]
        ]);

        $pesanan = \App\Models\Pesanan::factory()->create();
        DB::table('produk_dipesan')->insert([
            'idPesanan' => $pesanan->id,
            'idProduk' => \App\Models\Produk::factory()->create()->id,
            'JumlahProduk' => 1
        ]);

        $response = $this->get('/terimaPesanan/' . $pesanan->id);
        // dd($response[0]);
        $response->assertStatus(200);
        $this->assertEquals('Pesanan Diproses', $pesanan->fresh()->status);
    }

    public function testTolakPesanan()
    {
        $account = \App\Models\Account::factory()->create([
            'nama' => 'PKL Test User',
            'email' => 'pkl@example.com',
            'nohp' => '08123456789',
            'password' => bcrypt('password'), // atau Hash::make
            'status' => 'PKL'
        ]);

        // Simulasikan session seolah user tersebut sedang login
        $this->withSession([
            'account' => [
                'id' => $account->id,
                'nama' => $account->nama,
                'email' => $account->email,
                'nohp' => $account->nohp,
                'status' => $account->status
            ]
        ]);

        $pesanan = \App\Models\Pesanan::factory()->create();
        DB::table('produk_dipesan')->insert([
            'idPesanan' => $pesanan->id,
            'idProduk' => \App\Models\Produk::factory()->create()->id,
            'JumlahProduk' => 1
        ]);

        $response = $this->get('/tolakPesanan/' . $pesanan->id);
        // dd($response[0]);

        $response->assertStatus(200);
        $this->assertEquals('Pesanan Ditolak', $pesanan->fresh()->status);
    }

    public function testBatalPesanan()
    {
        $account = \App\Models\Account::factory()->create([
            'nama' => 'PKL Test User',
            'email' => 'pkl@example.com',
            'nohp' => '08123456789',
            'password' => bcrypt('password'), // atau Hash::make
            'status' => 'PKL'
        ]);

        // Simulasikan session seolah user tersebut sedang login
        $this->withSession([
            'account' => [
                'id' => $account->id,
                'nama' => $account->nama,
                'email' => $account->email,
                'nohp' => $account->nohp,
                'status' => $account->status
            ]
        ]);

        $pesanan = \App\Models\Pesanan::factory()->create();
        DB::table('produk_dipesan')->insert([
            'idPesanan' => $pesanan->id,
            'idProduk' => \App\Models\Produk::factory()->create()->id,
            'JumlahProduk' => 1
        ]);

        $response = $this->get('/batalPesanan/' . $pesanan->id);
        $response->assertStatus(200);
        $this->assertEquals('Pesanan Dibatalkan', $pesanan->fresh()->status);
    }

    public function testSelesaiPesanan()
    {
        $account = \App\Models\Account::factory()->create([
            'nama' => 'PKL Test User',
            'email' => 'pkl@example.com',
            'nohp' => '08123456789',
            'password' => bcrypt('password'), // atau Hash::make
            'status' => 'PKL'
        ]);

        // Simulasikan session seolah user tersebut sedang login
        $this->withSession([
            'account' => [
                'id' => $account->id,
                'nama' => $account->nama,
                'email' => $account->email,
                'nohp' => $account->nohp,
                'status' => $account->status
            ]
        ]);
        $pesanan = \App\Models\Pesanan::inRandomOrder()->first();
        $response = $this->get('selesaiPesanan/' . $pesanan->id);
        // dd($response[0]);
        $response->assertStatus(200);
        $this->assertEquals('Pesanan Selesai', $pesanan->fresh()->status);
    }

    
}
