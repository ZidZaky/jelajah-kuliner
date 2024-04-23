<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

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
        return view('CreateProduk');
    }


    //save
    public function store(Request $request)
    {

        $valdata = $request->validate([
            'namaProduk' => 'required',
            'desc' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'foto' => 'nullable',
            'idAccount' => 'required'
        ]);
        $berhasil = Produk::create($valdata);
        if ($berhasil) {
            return redirect('/PKL');
        } else {
            return redirect('/Produk/create')->with('error', 'Password berbeda');
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
}
