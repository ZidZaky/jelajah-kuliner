<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\PKL;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    //
    public static function index($id)
    {
        // Retrieve Pesanan data
        $Pesanan = Pesanan::find($id);

        // Check if Pesanan data exists
        if ($Pesanan) {
            // Retrieve associated products
            $Produks = Produk::where('idPesanan', $Pesanan->id)->get();

            return view('pesanan', [
                'Pesanan' => $Pesanan,
                'Produks' => $Produks
            ]);
        } else {
            // Handle case where Pesanan data does not exist
            return response()->view('errors.404', [], 404);
        }
    }


    //create
    public function create($id)
    {
        return view('CreatePesanan');
        dd($id);
        // Retrieve Pesanan data
        $Pesanan = Pesanan::find($id);

        // Check if Pesanan data exists
        if ($Pesanan) {
            // Retrieve associated products
            $Produks = Produk::where('idPesanan', $Pesanan->id)->get();

            return view('CreatePesanan', [
                'Pesanan' => $Pesanan,
                'Produks' => $Produks
            ]);
        } else {
            // Handle case where Pesanan data does not exist
            return response()->view('errors.404', [], 404);
        }
    }


    //save
    public function store(Request $request)
    {
        // Create a new Pesanan instance
        $pesanan = new Pesanan();
        $pesanan->idAccount = $request->input('idAccount');
        $pesanan->idPKL = $request->input('idPKL');
        $pesanan->Keterangan = $request->input('keterangan');
        $pesanan->TotalBayar = $request->input('totalHarga');
        $pesanan->status = $request->input('status');

        // Save the Pesanan instance
        if ($pesanan->save()) {
            // Retrieve the ID of the saved Pesanan
            $idPesanan = $pesanan->id;

            // Iterate through each product in the request
            foreach ($request->except(['_token', 'idAccount', 'idPKL', 'totalHarga', 'keterangan', 'status']) as $key => $value) {
                // Extract the product ID from the input name
                $idProduk = explode('_', $key)[1];

                // Check if a record with the same idPesanan and idProduk already exists
                $existingRecord = DB::table('produk_dipesan')
                    ->where('idPesanan', $idPesanan)
                    ->where('idProduk', $idProduk)
                    ->first();

                // If no existing record found, insert a new record
                if (!$existingRecord) {
                    DB::table('produk_dipesan')->insert([
                        'idPesanan' => $idPesanan,
                        'idProduk' => $idProduk,
                        'JumlahProduk' => $value
                    ]);
                }
            }


            // Redirect to dashboard with success message
            return redirect('/dashboard')->with('success', 'Pesanan berhasil disimpan. ID Pesanan: ' . $idPesanan);
        } else {
            // Redirect back to Pesanan create page with error message
            return redirect('/Pesanan/create')->with('error', 'Gagal menyimpan data Pesanan.');
        }
    }



    //edit
    public function edit(Pesanan $Pesanan)
    {
        return view('editPesanan', ['Pesanan' => $Pesanan]);
    }

    //update
    public function update(Request $request, Pesanan $Pesanan)
    {
        $valdata = $request->validate([
            'namaPesanan' => 'required',
            'desc' => 'required',
            'idAccount' => 'required'
        ]);

        $Pesanan->update($valdata);

        return redirect('/Pesanan');
    }

    //delete
    public function destroy(Pesanan $Pesanan)
    {
        Pesanan::destroy($Pesanan->id);
        return redirect('account-list');
    }

    public static function showAll()
    {
        $Pesanan = Pesanan::all();
        return
            ['dataPesanan' => $Pesanan];
    }
    public static function showDetail($idAccount)
    {
        $PesananData = Pesanan::where('idAccount', $idAccount)->first();
        // dd($PesananData);
        $produk = Produk::where('idPesanan', $PesananData->id)->get();
        // $ulasan = Ulasan::where('idPesanan', $PesananData->id)->get();;
        session(['Pesanan' => $PesananData]);

        return view('dataPesanan', [
            'Pesanan' => $PesananData,
            'produk' => $produk
            // 'ulasan' => $ulasan
        ]);
    }

    public function createWithId($id)
    {
        // Retrieve Pesanan data
        $PKL = PKL::find($id);

        // Check if Pesanan data exists
        if ($PKL) {
            // Retrieve associated products
            $Produks = Produk::where('idPKL', $PKL->id)->get();

            return view('pesan', [
                'pkl' => $PKL,
                'produk' => $Produks
            ]);
        } else {
            // Handle case where Pesanan data does not exist
            return response()->view('errors.404', [], 404);
        }
    }
    public function pesanDetail($id){
        $pesan = Pesanan::find($id);
        // $pesan = Pesanan::find($id);
        return view('detilPesan', [
            'pesan' => $pesan
        ]);
    }
}
