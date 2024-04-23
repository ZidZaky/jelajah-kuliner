<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    //
    public static function index()
    {
        return view('list-ulasan', [
            'Produks' => Ulasan::all()
        ]);
    }

    //create
    public function create()
    {
        return view('CreateUlasan');
    }


    //save
    public function store(Request $request)
    {

        $valdata = $request->validate([
            'ulasan' => 'required',
            'idAccount' => 'required',
            'idProduk' => 'required'
        ]);
        $berhasil = Ulasan::create($valdata);
        if ($berhasil) {
            return redirect('/');
        } else {
            return redirect('/Ulasan/create')->with('error', 'Password berbeda');
        }
    }

    //edit
    public function edit(Ulasan $Ulasan)
    {
        return view('editUlasan', ['Ulasan' => $Ulasan]);
    }

    //update
    public function update(Request $request, Ulasan $Ulasan)
    {
        $valdata = $request->validate([
            'namaProduk' => 'required',
            'desc' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'foto' => 'nullable',
            'idAccount' => 'required'
        ]);

        $Ulasan->update($valdata);

        return redirect('/');
    }

    //delete
    public function destroy(Ulasan $Ulasan)
    {
        Ulasan::destroy($Ulasan->id);
        return redirect('/');
    }
}
