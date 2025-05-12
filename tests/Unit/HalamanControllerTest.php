<?php

// namespace Tests\Unit;

use PHPUnit\Framework\Assert as TestUnit;
use App\Models\Account;
use App\Models\PKL;
use App\Models\Produk;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;


class HalamanControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    
    public function test_Buat_Stok_Awal(){
        //buat akun
        $prepared = $this->prepared();

        $response = $this->post('/MakeStokAwal',[
            'idPKL'=>$prepared[1]->id,
            'idproduk'=>$prepared[2]->id,
            'stokAwal'=>fake()->numberBetween(30,100)
        ]);

        // dd($response);
        $redirecting = $response->headers->get('Location');
        $response->assertRedirectContains('dataPKL');
        return $prepared;
    }

    public function test_Buat_Stok_Akhir(){
        //buat akun
        $prepared = $this->test_Buat_Stok_Awal();
        // dd($prepared[1]->id,$prepared[2]->id);

        $response = $this->post('/updateStokAkhir',[
            'idPKL'=>$prepared[1]->id,
            'idproduk'=>$prepared[2]->id,
            'stokAkhir'=>5,
        ]);
        // dd($response);
        $response->assertRedirectContains('dataPKL');
    }

    public function test_Get_Riwayat_Stok(){
        //buat akun
        $prepared = $this->prepared();
        $response = $this->post('/MakeStokAwal',[
            'idPKL'=>$prepared[1]->id,
            'idproduk'=>$prepared[2]->id,
            'stokAwal'=>fake()->numberBetween(30,100)
        ]);
        $actual = DB::select("SELECT * from history_stoks h where idPKL=".$prepared[1]->id." and idProduk=".$prepared[2]->id.";");
        $res  = $this->get('/rwt/'.$prepared[1]->id.'p'.$prepared[2]->id);
        $a = $res[0];
        $b = json_decode(json_encode(($actual[0])), true);
        // dd($a,$b,getType($a),getType($b),$a==$b);
        TestUnit::assertSame($a,$b);
    }


    public function prepared(){
        $akun = Account::factory()->count(1)->create();

        //buat akun pkl
        $pkl = PKL::factory()->create([
            'idAccount'=>$akun[0]->id,
        ]);
        //buat 1 product
        $product = Produk::factory()->create([
            'idPKL'=>$pkl->id,
        ]);
        return [$akun[0],$pkl,$product];
    } 
}
