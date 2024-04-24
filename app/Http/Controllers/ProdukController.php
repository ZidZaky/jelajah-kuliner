<?php

namespace App\Http\Controllers;

use App\Models\Produk;
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
            'jenisProduk' => 'required',
            'fotoProduk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // This ensures 'foto' can be null
            'idPKL' => 'required'
        ]);

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
            $berhasil = DB::insert('INSERT INTO `produks` (`id`, `namaProduk`, `desc`, `harga`, `stok`, `jenisProduk`, `foto`, `idPKL`) VALUES (NULL, ?, ?,?,?,?,?,?);', [
                $valdata['namaProduk'],
                $valdata['desc'],
                $valdata['harga'],
                $valdata['stok'],
                $valdata['jenisProduk'],
                $valdata['fotoProduk'],
                $valdata['idPKL']
            ]);

            if ($berhasil) {
                return redirect('/dataPKL/'.session('pkl')['id']);
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
}
