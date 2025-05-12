<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\historyStok;

class HistoryStokController extends Controller
{
    
    public function store($idproduk,$stokAwal,$idPKL){
        $stok = new historyStok();
        $stok->idPKL = $idPKL;
        $stok->idProduk = $idproduk;
        $stok->stokAwal = $stokAwal;
        $stok->save();

        // dd($stok->id);
        return $stok->id;
    }

    public function UpdatestokOnline($jumlah,$idStok){
       $stok = historyStok::findOrFail($idStok);
       $tes = $stok->TerjualOnline + $jumlah;
       $stok->TerjualOnline = $tes;
        // dd($stok);
       if($stok->statusIsi==1){
            $this->UpdatestokAkhir(($stok->stokAkhir-$jumlah),$stok->id);
       }
       return $stok->save();
// >>>>>>> fa7102ddd6950ef6706450bf1323a6b5c945e902
    }

    public function UpdatestokAkhir($jumlah,$idStok){
        $stok = historyStok::findOrFail($idStok);
        $stok->stokAkhir = $jumlah;
        $stok->statusIsi = 1;
        return ($stok->save());
     }
    public function go(){
        $this->UpdatestokOnline(5,1);
    }
    
}
