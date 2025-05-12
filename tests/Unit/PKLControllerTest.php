<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PKLControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateView() {
        $response = $this->get('/pkl/create');
        $response->assertStatus(200);
    }

    public function testStorePKL() {
        $response = $this->post('/pkl', [
            'nama' => 'PKL A',
            'lokasi' => 'Test Lokasi'
        ]);
        $response->assertStatus(302);
    }

    public function testEditView() {
        $response = $this->get('/pkl/1/edit');
        $response->assertStatus(200);
    }

    public function testUpdatePKL() {
        $response = $this->put('/pkl/1', [
            'nama' => 'PKL Update'
        ]);
        $response->assertStatus(302);
    }

    public function testDestroyPKL() {
        $response = $this->delete('/pkl/1');
        $response->assertStatus(302);
    }

    public function testGetCoordinates() {
        $response = $this->get('/pkl/coordinates');
        $response->assertStatus(200);
    }

    public function testGetPictureByID() {
        $response = $this->get('/pkl/1/picture');
        $response->assertStatus(200);
    }

    public function testGetIdPKL() {
        $response = $this->get('/pkl/id');
        $response->assertStatus(200);
    }

    public function testGetDataPKL() {
        $response = $this->get('/pkl/data');
        $response->assertStatus(200);
    }

    public function testUpdateLocation() {
        $response = $this->post('/pkl/1/location', ['lat' => -6.2, 'lng' => 106.8]);
        $response->assertStatus(200);
    }
}
