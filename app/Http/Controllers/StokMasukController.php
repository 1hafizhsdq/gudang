<?php

namespace App\Http\Controllers;

use App\Models\HistoryStok;
use App\Models\HistoryStokDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class StokMasukController extends Controller
{
    public function index(){
        $data['title'] = 'Stok Masuk';

        return view('stok_masuk.index',$data);
    }

    public function listMasuk(){
        if(Auth::user()->role == 1){
            $data = HistoryStok::with('user')->whereStatus('1')->orderBy('tanggal','desc')->get();
        }else{
            $data = HistoryStok::with('user')->whereStatus('1')->whereUser_id(Auth::user()->id)->orderBy('tanggal','desc')->get();
        }
        
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($data) {
                $formatedDate = Carbon::createFromFormat('Y-m-d', $data->tanggal)->format('d-m-Y');
                return $formatedDate;
            })
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="/detail-stok-masuk/'.$data->id.'" id="btn-detail" class="btn btn-sm btn-warning" title="Detail Data"><i class="bi bi-eye-fill"></i></a>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function detail($id){
        $data['title'] = 'Stok Masuk';
        $data['history'] = HistoryStok::with('user')->find($id);
        $data['historyDetail'] = HistoryStokDetail::with('sku.barang.satuan')->whereHistory_id($id)->get();

        return view('stok_masuk.detail',$data);
    }
}
