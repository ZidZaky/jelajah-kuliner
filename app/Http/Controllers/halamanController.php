<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\HistoryStokController;
use App\Models\Account;
use App\Models\PKL;
use App\Models\Produk;
use Exception;
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

    public function getrwtStok($idPklpidProduk){
        $pisah = explode("p",$idPklpidProduk);
        $idPKL = $pisah[0];
        $idProduk = $pisah[1];

        $data = DB::select("SELECT * from history_stoks h where idPKL=".$idPKL." and idProduk=".$idProduk.";");
        // dd($data);
        if(count($data)>0){
            return $data;
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
    public function DashboardPenjualan($idAccVApa){
        // dd($idAccVApa);
        $split = explode("V",$idAccVApa);
        // dd($split);
        $idAcc = $split[0];
        $apa = $split[1];
        $pkl = PKL::where('idAccount',$idAcc)->get();
        if(count($pkl)==1){
            $bulan = date("n");
            $taun = date("Y");
            $tgl = date("d");
            $idPKL = ($pkl[0]->id);
            // dd($idPKL)
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
            // dd($Today);
            $startdate = DB::select("select date(created_at) as startdt FROM pesanans
            WHERE idPKL=".$idPKL." and status = 'Pesanan Selesai'
            ORDER BY created_at asc limit 1");
            if($startdate!=null){
                $startdate = $startdate[0];

            }
            // dd($Today);
            // dd($startdate);
            
            
            // dd($ProdukToday);
                    // dd($getData[0]);
                    // dd('dp');
            
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
            

            $all = DB::select("
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
        $Produs = 0;
        
        if($apa=="Today"){
            $produkToday = DB::select("SELECT 
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
                where day(h.created_at)=".$tgl." and month(h.created_at)=".$bulan." and year(h.created_at)=".$taun." and p.idPKL = ".$idPKL."
                GROUP by p.id,p.namaProduk,p.idPKL
                order by p.namaProduk;");
                $Produs = $produkToday;
                // dd($Produs);
        }
        
        else if($apa == "Bulan"){
            $produkMonth = DB::select("SELECT 
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
                where month(h.created_at)=".$bulan." and year(h.created_at)=".$taun."
                GROUP by p.id,p.namaProduk,p.idPKL
                order by p.namaProduk;");
            $Produs=$produkMonth;
        }
        else{
            $produkYear = DB::select("SELECT 
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
                where year(h.created_at)=".$taun."
                GROUP by p.id,p.namaProduk,p.idPKL
                order by p.namaProduk;");
            $Produs = $produkYear;
        }
            
            // dd($produkMonth);
            
            // dd($produkYear);
            // dd();
            // dd(date("Y"));
            // if()
            // dd(count($Produs));
            // dd($this->hitung($Today[0]));
            // dd($year[0]->TerjualKeseluruhan=="0");
            // dd($year[0]->TerjualKeseluruhan!="0" && $this->hitung($Produs)>0);
            // dd($year[0]);
            // dd($year[0]->TerjualKeseluruhan!="0" && $this->hitung($Produs)>0);
            try{
                if($Today[0]->TerjualKeseluruhan!="0" && $month[0]->TerjualKeseluruhan!="0" && $year[0]->TerjualKeseluruhan!="0" && $this->hitung($Produs)>0){
                    // dd($month);
                    // dd('masuk');
                    // dd($Today[0]);
                    // dd($this->hitung($Today)>0);
                        return view('dp',['DataToday'=>$Today[0],'DataMonth'=>$month[0],'DataYear'=>$year[0],'produs'=>$Produs,'startdate'=>$startdate,'apa'=>$apa]);

                }
            }
            catch(Exception $e){
                try{
                    if($month[0]->TerjualKeseluruhan!="0" && $year[0]->TerjualKeseluruhan!="0" && $this->hitung($Produs)>0){
                        // dd('masukbulan');
                            return view('dp',['DataToday'=>[],'DataMonth'=>$month,'DataYear'=>$year,'produs'=>$Produs,'startdate'=>$startdate,'apa'=>$apa]);
        
                    }
                }
                catch(Exception $e){
                    try{
                        if($year[0]->TerjualKeseluruhan!="0" && $this->hitung($Produs)>0){
                            // dd('masuktahun');
                            return view('dp',['DataToday'=>[],'DataMonth'=>[],'DataYear'=>$year,'produs'=>$Produs,'startdate'=>$startdate,'apa'=>$apa]);
                            
                        }
                    }
                    catch(Exception $e){
                        // dd('masukelse');
        
                        $ary = [];
                        return view('dp',['DataToday'=>$ary,'DataMonth'=>$ary,'DataYear'=>$ary,'produs'=>$ary,'apa'=>$apa]);
        
                    }
                }

                
            }
        
        $ary = [];
        return view('dp',['DataToday'=>$ary,'DataMonth'=>$ary,'DataYear'=>$ary,'produs'=>$ary,'apa'=>$apa]);
        }
        
    }

    

    public function ChartMonth(){
        $data = DB::select("SELECT p.namaProduk,p.idPKL idPKL,sum(case when h.statusIsi=0 then h.stokAkhir+h.TerjualOnline when h.statusIsi=1 then (h.stokAwal-h.stokAkhir-h.TerjualOnline)+h.TerjualOnline end) semua
        from produks p 
        join history_stoks h on p.id=h.idProduk
        WHERE p.idPKL=2 and (month(h.created_at)=4 or month(h.updated_at)=4)
        GROUP BY p.id");
        // dd($data);
    }
    public function hitung($array){
        $itg = 0;
        foreach($array as $ar){
            $itg = $itg+1;
        }
        return $itg;
    }
}
