<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Pesanan;
use App\Models\ProdukDipesan;

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
        $response->assertStatus(200);  // atau sesuaikan dengan status yang benar

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

    public function testEditView()
    {
        $pesanan = Pesanan::factory()->create();
        $response = $this->get('/editPesanan/' . $pesanan->id);
        $response->assertStatus(200);
    }

    public function testUpdatePesanan()
    {
        $pesanan = Pesanan::factory()->create();
        $response = $this->post('/updatePesanan/' . $pesanan->id, [
            'jumlah' => 3
        ]);
        $response->assertStatus(302);
    }

    public function testDestroyPesanan()
    {
        $pesanan = Pesanan::factory()->create();
        $response = $this->get('/deletePesanan/' . $pesanan->id);
        $response->assertStatus(302);
    }

    public function testCreateWithId()
    {
        $response = $this->get('/formPesanan/1');
        $response->assertStatus(200);
    }

    public function testPesanDetail()
    {
        $response = $this->get('/pesanDetail/1');
        $response->assertStatus(200);
    }

    public function testTerimaPesanan()
    {
        $response = $this->get('/terimaPesanan/1');
        $response->assertStatus(200);
    }

    public function testTolakPesanan()
    {
        $response = $this->get('/tolakPesanan/1');
        $response->assertStatus(200);
    }

    public function testBatalPesanan()
    {
        $response = $this->get('/batalPesanan/1');
        $response->assertStatus(200);
    }

    public function testSelesaiPesanan()
    {
        $response = $this->get('/selesaiPesanan/1');
        $response->assertStatus(200);
    }

    public function testGetPesananSelesai()
    {
        $response = $this->get('/pesananSelesai');
        $response->assertStatus(200);
    }
}
