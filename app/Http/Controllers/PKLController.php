<?php

namespace App\Http\Controllers;

use App\Models\PKL;
use App\Models\Produk;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class PKLController extends Controller
{
    //
    public static function index($id)
    {
        return view('dataPKL', [
            'PKL' => PKL::find($id),
            'Produks' => Produk::find($id),
            'Ulasan' => Ulasan::find($id)
        ]);
    }

    //create
    public function create()
    {
        return view('CreateDataPKL');
    }


    //save
    public function store(Request $request)
    {
        // dd($request);
        $valdata = $request->validate([
            'namaPKL' => 'required',
            'desc' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'idAccount' => 'required'
        ]);
        // dd($valdata);
        $berhasil = PKL::create($valdata);
        if ($berhasil) {
            return redirect('/');
        } else {
            return redirect('/PKL/create')->with('error', 'Gagal menyimpan data PKL.');
        }
    }


    //edit
    public function edit(PKL $pkl)
    {
        return view('editPKL', ['pkl' => $pkl]);
    }

    //update
    public function update(Request $request, PKL $pkl)
    {
        $valdata = $request->validate([
            'namaPKL' => 'required',
            'desc' => 'required',
            'idAccount' => 'required'
        ]);

        $pkl->update($valdata);

        return redirect('/PKL');
    }

    //delete
    public function destroy(PKL $pkl)
    {
        PKL::destroy($pkl->id);
        return redirect('account-list');
    }

    public static function showAll()
    {
        $pkl = PKL::all();
        return
            ['dataPKL' => $pkl];
    }
    public static function showDetail($idAccount)
    {
        $pklData = PKL::where('idAccount', $idAccount)->first();
        $produk = Produk::where('idAccount', $pklData->id)->get();
        return view('dataPKL', [
            'pkl' => $pklData,
            'produk' => $produk
        ]);
    }

    public function getCoordinates()
    {
        // Fetch latitude and longitude data from your database
        $coordinates = PKL::select('latitude', 'longitude')->get();

        // Return latitude and longitude data as JSON
        return response()->json($coordinates);
    }

}
