<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\PKL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public static function index()
    {
        return view('list-produk', [
            'Produks' => Produk::all()
        ]);
    }

    //create
    public function create()
    {
        return view('addProduct');
    }


    //save
    public function store(Request $request)
    {


        $valdata = $request->validate([
            'namaProduk' => 'required',
            'desc' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'stokSaatIni' => 'required',
            'jenisProduk' => 'required',
            'fotoProduk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // This ensures 'foto' can be null
            'idPKL' => 'required'
        ]);
        $valdata['stokSaatIni'] =  $valdata['stok'];
        // dd($valdata);

        if ($request->hasFile('fotoProduk')) {
            $file = $request->file('fotoProduk');
            $filename = $request->namaProduk . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $filename);
            $valdata['foto'] = $filename;
        } else {
            $isnull = 'null';
            $valdata['foto'] = $isnull;
        }

        try {
            $berhasil = DB::insert('INSERT INTO `produks` (`id`, `namaProduk`, `desc`, `harga`, `stok`, `stokSaatIni`, `jenisProduk`, `foto`, `idPKL`) VALUES (NULL, ?, ?,?,?,?,?,?,?);', [
                $valdata['namaProduk'],
                $valdata['desc'],
                $valdata['harga'],
                $valdata['stok'],
                $valdata['stokSaatIni'],
                $valdata['jenisProduk'],
                $valdata['fotoProduk'],
                $valdata['idPKL']
            ]);

            // dd($berhasil);

            if ($berhasil) {
                return redirect('/dataPKL/'.session('account')['id']);
            } else {
                return redirect('/produk/create')->with('error', 'Password berbeda');
            }
        } catch (\Exception $e) {
            // Handle the exception
            return redirect('/produk/create')->with('error', $e->getMessage());
        }
    }


    //edit
    public function edit(Produk $produk)
    {
        return view('editProduk', ['Produk' => $produk]);
    }

    //update
    public function update(Request $request, Produk $produk)
    {
        $valdata = $request->validate([
            'namaProduk' => 'required',
            'desc' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'foto' => 'nullable',
            'idAccount' => 'required'
        ]);

        $produk->update($valdata);

        return redirect('/PKL');
    }

    //delete
    public function destroy(Produk $produk)
    {
        Produk::destroy($produk->id);
        return redirect('/PKL');
    }

    public function getProduk($id)
    {
        // Fetch ulasan data for the specific PKL ID
        $produk = Produk::where('idPKL', $id)->get();

        // Return ulasan data as JSON
        return response()->json($produk);
    }

    public function riwayatProduk($id) {
        // Find the Pesanan by its ID
        $pkl = PKL::find($id);

         // Retrieve the related products for the Pesanan
         $query = "select * from history_stok where idPKL = ?";
         $riwayat = DB::select($query, [$id]);

        // Check if Pesanan is found

            // Return the view with the updated Pesanan and related products
            return view('riwayatProduk', [
                'riwayat' => $riwayat,
                'pkl' => $pkl
            ]);

    }

    public function buatStokAkhir($id){
        $produk = Produk::where('id',$id)->first();
        return view('buatStokAkhir',['produk' => $produk]);
    }
    public function buatStokAwal($id){
        $produk = Produk::where('id',$id)->first();
        return view('buatStokAwal',['produk' => $produk]);
    }

    public function buatHistory(Request $request)
{
    $valdata = $request->validate([
        'idPKL' => 'required',
        'idProduk' => 'required',
        'stokAwal' => 'required'
    ]);

    $berhasil = DB::update('UPDATE `produks` SET `stok` = ? WHERE `id` = ? AND `idpkl` = ?', [
        $valdata['stokAwal'],  // Assuming you want to update the stok with stokAkhir value
        $valdata['idProduk'],
        $valdata['idPKL']
    ]);

    $berhasil2 = DB::insert('INSERT INTO history_stok (id, idProduk, stokAwal, stokAkhir, idPKL, created_at, updated_at) VALUES (NULL, ?, ?, ?, ?, ?, ?)', [
        $valdata['idProduk'],
        $valdata['stokAwal'],
        0,
        $valdata['idPKL'],
        now(),
        now()
    ]);

    if ($berhasil && $berhasil2) {
        return redirect("/riwayatProduk/{$valdata['idPKL']}");
    } else {
        return back()->with('error', 'Failed to save the history.');
    }
}

public function updateHistory(Request $request)
{
    $valdata = $request->validate([
        'idPKL' => 'required',
        'idProduk' => 'required',
        'stokAkhir' => 'required'
    ]);

    $affected = DB::update('UPDATE history_stok SET stokAkhir = ?, updated_at = ? WHERE idPKL = ? AND idProduk = ?', [
        $valdata['stokAkhir'],
        now(),
        $valdata['idPKL'],
        $valdata['idProduk']
    ]);

    $berhasil = DB::update('UPDATE `produks` SET `stok` = ? WHERE `id` = ? AND `idpkl` = ?', [
        $valdata['stokAkhir'],  // Assuming you want to update the stok with stokAkhir value
        $valdata['idProduk'],
        $valdata['idPKL']
    ]);

    if ($affected && $berhasil) {
        return redirect("/riwayatProduk/{$valdata['idPKL']}")->with('success', 'History updated successfully.');
    } else {
        return back()->with('error', 'Failed to update the history.');
    }
}


}
