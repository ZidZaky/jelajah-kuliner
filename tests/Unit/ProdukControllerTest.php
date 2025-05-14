<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Produk;
use App\Models\PKL;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProdukControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_product_and_its_history()
    {
        Storage::fake('public'); // Fake disk untuk simpan foto

        // Arrange: buat data PKL
        $pkl = PKL::factory()->create();

        // Simulasi file foto
        $file = UploadedFile::fake()->image('produk.jpg');

        // Act: kirim POST request ke route store produk
        $response = $this->post('/produk', [
            'namaProduk' => 'Bakso',
            'jenisProduk' => 'Makanan',
            'desc' => 'Bakso enak dan pedas',
            'harga' => 15000,
            'stok' => 10,
            'idPKL' => $pkl->id,
            'fotoProduk' => $file,
        ]);

        // Assert: produk berhasil tersimpan
        $this->assertDatabaseHas('produks', [ // assert untuk cek data di database
            'namaProduk' => 'Bakso',
            'desc' => 'Bakso enak dan pedas',
            'harga' => 15000,
            'idPKL' => $pkl->id
        ]);

        // Assert: file foto disimpan di storage
        Storage::disk('public')->assertExists('product/Bakso.jpg'); // assert file disimpan

        // Assert: history stok tersimpan
        $this->assertDatabaseHas('history_stoks', [ // assert untuk stok awalnya
            'stokAwal' => 10,
            'idPKL' => $pkl->id
        ]);

        // Assert: redirect ke halaman PKL
        $response->assertRedirect('/dataPKL/' . $pkl->idAccount); // assert redirect berhasil
    }

    public function test_validation_fails_when_required_fields_are_missing()
    {
        $response = $this->post('/produk', []); // kosong

        $response->assertSessionHasErrors([
            'namaProduk', 'jenisProduk', 'desc', 'harga', 'stok', 'idPKL'
        ]); // assert validasi error muncul
    }

    public function test_user_can_delete_a_product()
    {
        $pkl = PKL::factory()->create();
        $produk = Produk::factory()->create(['idPKL' => $pkl->id]);

        $response = $this->delete('/produk/' . $produk->id);

        $this->assertModelMissing($produk); // assert model terhapus
        $response->assertRedirect('/PKL'); // assert redirect berhasil
    }

   public function test_user_can_fetch_product_json_structure()
{
    $pkl = \App\Models\PKL::factory()->create();
    \App\Models\Produk::factory()->create(['idPKL' => $pkl->id]);

    $response = $this->get('/getProduk/' . $pkl->id);

    $response->assertStatus(200);
    $response->assertJsonStructure([ // assert hanya struktur JSON-nya
        '*' => ['id', 'nama', 'harga'], // sesuaikan dengan response controller Anda
    ]);
}

}
