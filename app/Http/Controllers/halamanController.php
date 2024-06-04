<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\HistoryStokController;
use App\Models\Account;
use App\Models\PKL;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;


class halamanController extends Controller
{
    public function UpdateStatusStok(Request $req){
        // dd($req,'awl');
        
        $val = $req->validate([
            'stokAwal'=>'required',
            'idproduk'=>'required',
            'idPKL'=>'required'
        ]);
        $stok = new HistoryStokController();
        $idStok = $stok->store($val['idproduk'],$val['stokAwal'],$val['idPKL']);
        // dd($id);
        $produk = new ProdukController();
        if($produk->updateStokAktif($val['idproduk'],$idStok)){
            $pkl = PKL::findOrFail($val['idPKL']);
            // dd($pkl);
            return redirect('/dataPKL/'.$pkl->idAccount);
        }

    }
    public function UpdateStokAkhir(Request $req){
        // dd($req);
        $val = $req->validate([
            'stokAkhir'=>'required',
            'idproduk'=>'required',
            'idPKL'=>'required'
        ]);
        // dd($val['stokAkhir']);   
        $produk = new ProdukController();
        $idStok = $produk->findStok($val['idproduk']);
        // dd($idStok);
        // dd($val['stokAkhir']);
        $stok = new HistoryStokController();
        if($stok->UpdateStokAkhir($val['stokAkhir'],$idStok)){
            $pkl = PKL::findOrFail($val['idPKL']);
            // dd($pkl);
            return redirect('/dataPKL/'.$pkl->idAccount);
        }

    }
    public function DashboardPenjualan($idAcc){
        $pkl = PKL::where('idAccount',$idAcc)->get();
        if(count($pkl)==1){
            $idPKL = ($pkl[0]->id);
            $Today = DB::table('produks as p')
            ->join('history_stoks as h', 'p.stokAktif', '=', 'h.id')
            ->select(
                DB::raw('GROUP_CONCAT(p.id SEPARATOR ",") as ids'),
                DB::raw('GROUP_CONCAT(p.namaProduk SEPARATOR ",") as produks'),
                'p.idPKL as idPKL',
                DB::raw('SUM(h.TerjualOnline) as terjualOnline'),
                DB::raw('SUM(CASE WHEN h.statusIsi = 0 THEN h.stokAkhir WHEN h.statusIsi = 1 THEN h.stokAwal - h.stokAkhir - h.TerjualOnline END) as terjualOffline'),
                DB::raw('SUM(CASE WHEN h.statusIsi = 0 THEN h.stokAkhir + h.TerjualOnline WHEN h.statusIsi = 1 THEN (h.stokAwal - h.stokAkhir - h.TerjualOnline) + h.TerjualOnline END) as TerjualKeseluruhan'),
                DB::raw('SUM(h.TerjualOnline * p.harga) as omzetOnline'),
                DB::raw('SUM(CASE WHEN h.statusIsi = 0 THEN h.stokAkhir * p.harga WHEN h.statusIsi = 1 THEN (h.stokAwal - h.stokAkhir - h.TerjualOnline) * p.harga END) as omzetOffline'),
                DB::raw('SUM(CASE WHEN h.statusIsi = 0 THEN (h.stokAkhir + h.TerjualOnline) * p.harga WHEN h.statusIsi = 1 THEN ((h.stokAwal - h.stokAkhir - h.TerjualOnline) + h.TerjualOnline) * p.harga END) as omzetKeseluruhan')
            )
            ->groupBy('p.idPKL')
            ->having('p.idPKL', '=', $idPKL)
            ->get();
            
            // dd($ProdukToday);
                    // dd($getData[0]);
                    // dd('dp');
            $bulan = date("n");
            $taun = date("Y");
            $month = DB::select("
                SELECT group_concat(p.namaProduk) produks, p.idPKL idPKL,
                sum(h.TerjualOnline) terjualOnline,
                sum(case
                    when h.statusIsi=0 then h.stokAkhir
                    when h.statusIsi=1 then h.stokAwal-h.stokAkhir-h.TerjualOnline
                end) terjualOffline,
                sum(case
                    when h.statusIsi=0 then h.stokAkhir+h.TerjualOnline
                    when h.statusIsi=1 then (h.stokAwal-h.stokAkhir-h.TerjualOnline)+h.TerjualOnline
                end) TerjualKeseluruhan,
                sum(h.TerjualOnline*p.harga) omzetOnline,
                sum(case
                    when h.statusIsi=0 then (h.stokAkhir)*p.harga
                    when h.statusIsi=1 then (h.stokAwal-h.stokAkhir-h.TerjualOnline)*p.harga
                end) omzetOffline,
                sum(case
                    when h.statusIsi=0 then (h.stokAkhir+h.TerjualOnline)*p.harga
                    when h.statusIsi=1 then ((h.stokAwal-h.stokAkhir-h.TerjualOnline)+h.TerjualOnline)*p.harga
                end) omzetKeseluruhan
                FROM produks p
                JOIN history_stoks h ON h.idProduk=p.id
                WHERE MONTH(h.created_at) = ".$bulan." AND YEAR(h.created_at) = ".$taun." AND p.idPKL=".$idPKL."
                GROUP BY p.idPKL;
                ");

            $year = DB::select("
                SELECT group_concat(p.namaProduk) produks, p.idPKL idPKL,
                sum(h.TerjualOnline) terjualOnline,
                sum(case
                    when h.statusIsi=0 then h.stokAkhir
                    when h.statusIsi=1 then h.stokAwal-h.stokAkhir-h.TerjualOnline
                end) terjualOffline,
                sum(case
                    when h.statusIsi=0 then h.stokAkhir+h.TerjualOnline
                    when h.statusIsi=1 then (h.stokAwal-h.stokAkhir-h.TerjualOnline)+h.TerjualOnline
                end) TerjualKeseluruhan,
                sum(h.TerjualOnline*p.harga) omzetOnline,
                sum(case
                    when h.statusIsi=0 then (h.stokAkhir)*p.harga
                    when h.statusIsi=1 then (h.stokAwal-h.stokAkhir-h.TerjualOnline)*p.harga
                end) omzetOffline,
                sum(case
                    when h.statusIsi=0 then (h.stokAkhir+h.TerjualOnline)*p.harga
                    when h.statusIsi=1 then ((h.stokAwal-h.stokAkhir-h.TerjualOnline)+h.TerjualOnline)*p.harga
                end) omzetKeseluruhan
                FROM produks p
                JOIN history_stoks h ON h.idProduk=p.id
                WHERE YEAR(h.created_at) = ".$taun." AND p.idPKL=".$idPKL."
                GROUP BY p.idPKL;
            ");
            

            $Produs = DB::select("
                SELECT 
                    p.id AS id,
                    p.namaProduk AS produks,
                    p.idPKL AS idPKL,
                    sum(
                        CASE 
                            WHEN h.statusIsi = 0 THEN h.stokAkhir + h.TerjualOnline 
                            WHEN h.statusIsi = 1 THEN (h.stokAwal - h.stokAkhir - h.TerjualOnline) + h.TerjualOnline 
                        END
                    ) AS TerjualKeseluruhan
                FROM 
                    produks AS p
                JOIN 
                    history_stoks AS h ON p.id=h.idProduk
                where p.idPKL=".$idPKL."
                GROUP by p.id,p.namaProduk,p.idPKL
                order by p.namaProduk;
            ");
            // dd($produkbulan);
            // dd();
            // dd(date("Y"));
            // if()
            // dd(count($Produs));
            if(count($Today)>1||count($month)>1||count($year)>1||count($Produs)>1){
                return view('dp',['DataToday'=>$Today[0],'DataMonth'=>$month[0],'DataYear'=>$year[0],'produs'=>$Produs]);

            }
            else{
                $ary = [];
                return view('dp',['DataToday'=>$ary,'DataMonth'=>$ary,'DataYear'=>$ary,'produs'=>$ary]);

            }

        }
        
    }
}
