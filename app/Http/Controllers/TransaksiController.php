<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\HistoryStok;
use App\Models\HistoryStokDetail;
use App\Models\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index(){
        $data['title'] = "Transaksi Stok";
        $data['barang'] = Barang::get();

        return view('transaksi.index',$data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'keterangan' => 'required',
        ], [
            'status.required' => 'Tipe tidak boleh kosong!',
            'keterangan.required' => 'Keterangan tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            if($request->id == null){
                $history = HistoryStok::create([
                    'user_id' => $request->user_id,
                    'status' => $request->status,
                    'keterangan' => $request->keterangan,
                ]);
                return response()->json(['success' => 'Berhasil menyimpan data!', 'id' => $history->id]);
            }else{
                HistoryStok::where('id',$request->id)->update([
                    'user_id' => $request->user_id,
                    'status' => $request->status,
                    'keterangan' => $request->keterangan,
                ]);
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

            $tbl = HistoryStokDetail::with('sku.barang')->where('history_id', $request->history_id)->get();

            return response()->json(['success' => 'Berhasil menyimpan data!', 'tbl' => $tbl]);
        }
    }
}
