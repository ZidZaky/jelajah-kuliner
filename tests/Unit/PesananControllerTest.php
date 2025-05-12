<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PesananControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateView() {
        $response = $this->get('/pesanan/create');
        $response->assertStatus(200);
    }

    public function testStorePesanan() {
        $response = $this->post('/pesanan', [
            'produk_id' => 1,
            'jumlah' => 2
        ]);
        $response->assertStatus(302);
    }

    public function testEditView() {
        $response = $this->get('/pesanan/1/edit');
        $response->assertStatus(200);
    }

    public function testUpdatePesanan() {
        $response = $this->put('/pesanan/1', [
            'jumlah' => 3
        ]);
        $response->assertStatus(302);
    }

    public function testDestroyPesanan() {
        $response = $this->delete('/pesanan/1');
        $response->assertStatus(302);
    }

    public function testCreateWithId() {
        $response = $this->get('/pesanan/create/1');
        $response->assertStatus(200);
    }

    public function testPesanDetail() {
        $response = $this->get('/pesanan/detail/1');
        $response->assertStatus(200);
    }

    public function testTerimaPesanan() {
        $response = $this->post('/pesanan/1/terima');
        $response->assertStatus(200);
    }

    public function testTolakPesanan() {
        $response = $this->post('/pesanan/1/tolak');
        $response->assertStatus(200);
    }

    public function testBatalPesanan() {
        $response = $this->post('/pesanan/1/batal');
        $response->assertStatus(200);
    }

    public function testSelesaiPesanan() {
        $response = $this->post('/pesanan/1/selesai');
        $response->assertStatus(200);
    }

    public function testGetPesananSelesai() {
        $response = $this->get('/pesanan/selesai');
        $response->assertStatus(200);
    }
}
