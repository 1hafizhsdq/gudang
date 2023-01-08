<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\HistoryStok;
use App\Models\HistoryStokDetail;
use App\Models\Project;
use App\Models\Sku;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index(){
        $data['title'] = "Transaksi Stok";
        $data['barang'] = Barang::get();

        return view('transaksi.index',$data);
    }

    public function indexMasuk(){
        $data['title'] = "Stok Masuk";
        $data['barang'] = Barang::get();
        $data['pic'] = User::get();
        $data['project'] = Project::orderBy('id','desc')->get();

        return view('transaksi.index-masuk',$data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'keterangan' => 'required',
            'user_id' => 'required',
            'tanggal' => 'required',
        ], [
            'status.required' => 'Tipe tidak boleh kosong!',
            'keterangan.required' => 'Keterangan tidak boleh kosong!',
            'user_id.required' => 'PIC tidak boleh kosong!',
            'tanggal.required' => 'Tanggal tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $data = [
                'tanggal' =>$request->tanggal,
                'user_id' => $request->user_id,
                'status' => $request->status,
                'keterangan' => $request->keterangan,
                'deskripsi' => $request->deskripsi,
            ];

            if($request->status == 1){
                $data = array_merge($data,['no_surat_jalan' => $request->no_surat_jalan]);
            }else{
                $jumlahSuratJalan = (HistoryStok::where('status',2)->count())+1;
                $bulan = $this->getRomawi(date("n", strtotime($request->tanggal)));
                $noSurat = "0".$jumlahSuratJalan."/SJ/".$request->project_id."/".$bulan."/".date("Y", strtotime($request->tanggal));
                $data = array_merge($data,[
                    'project_id' => $request->project_id,
                    'driver' => $request->driver,
                    'nopol' => $request->nopol,
                    'penerima' => $request->penerima,
                    'no_surat_jalan' => $noSurat
                ]);
            }
            
            if($request->id == null){
                $history = HistoryStok::create($data);
                return response()->json(['success' => 'Berhasil menyimpan data!', 'id' => $history->id]);
            }else{
                if($request->status == 2){
                    unset($data['no_surat_jalan']);
                }
                HistoryStok::where('id',$request->id)->update($data);
                return response()->json(['success' => 'Berhasil menyimpan data!', 'id' => $request->id]);
            }
        }
    }

    public function getSku($id){
        $data = Sku::where('barang_id',$id)->get();

        return response()->json($data);
    }
    
    public function getStok($id){
        $data = Sku::find($id);

        return response()->json($data);
    }
    
    public function storeBarang(Request $request){
        $validator = Validator::make($request->all(), [
            'barang_id' => 'required',
            'sku_id' => 'required',
        ], [
            'barang_id.required' => 'Barang tidak boleh kosong!',
            'sku_id.required' => 'SKU Varian tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $sku = Sku::find($request->sku_id);
            if($request->status_tipe == 1){
                $htgStokBaru = $sku->stok_baru + $request->baru;
                $htgStokBekas = $sku->stok_bekas + $request->bekas;
            }else{
                $htgStokBaru = $sku->stok_baru - $request->baru;
                $htgStokBekas = $sku->stok_bekas - $request->bekas;
            }
            
            HistoryStokDetail::create([
                'history_id' => $request->history_id,
                'barang_id' => $request->barang_id,
                'sku_id' => $request->sku_id,
                'stok_baru' => $request->baru,
                'stok_bekas' => $request->bekas,
                'update_stok_baru' => $htgStokBaru,
                'update_stok_bekas' => $htgStokBekas,
            ]);

            Sku::where('id',$request->sku_id)->update([
                'stok_baru' => $htgStokBaru,
                'stok_bekas' => $htgStokBekas,
            ]);

            $stokTotalBekas = Sku::where('barang_id',$request->barang_id)->sum('stok_bekas');
            $stokTotalBaru = Sku::where('barang_id',$request->barang_id)->sum('stok_baru');
            $stokTotal = $stokTotalBekas+$stokTotalBaru;
            Barang::where('id',$request->barang_id)->update(['stok_total' => $stokTotal]);

            $tbl = HistoryStokDetail::with('sku.barang')->where('history_id', $request->history_id)->get();

            return response()->json(['success' => 'Berhasil menyimpan data!', 'tbl' => $tbl]);
        }
    }

    public function getForm($id){
        $data['pic'] = User::get();
        $data['project'] = Project::orderBy('id','desc')->get();

        $contents = view(($id == 1) ? 'transaksi.masuk' :'transaksi.keluar', $data)->render();
        return response()->json(['content' => $contents]);
    }

    public function getRomawi($bln){
        switch ($bln){
            case 1: 
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
        }
    }
}
