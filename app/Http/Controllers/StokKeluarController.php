<?php

namespace App\Http\Controllers;

use App\Models\HistoryStok;
use App\Models\HistoryStokDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
// use Barryvdh\DomPDF\PDF as PDF;
use \PDF;

class StokKeluarController extends Controller
{
    public function index(){
        $data['title'] = 'Stok Keluar';
        $data['bulan'] = $this->_bulan();

        return view('stok_keluar.index',$data);
    }

    public function listKeluar(){
        if(Auth::user()->role == 1){
            $data = HistoryStok::with('user')->whereStatus('2')->whereMonth('tanggal',date('m'))->whereYear('tanggal', date('Y'))->orderBy('tanggal','desc')->get();
        }else{
            $data = HistoryStok::with('user')->whereStatus('2')->whereUser_id(Auth::user()->id)->whereMonth('tanggal', date('m'))->whereYear('tanggal', date('Y'))->orderBy('tanggal','desc')->get();
        }
        
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($data) {
                $formatedDate = Carbon::createFromFormat('Y-m-d', $data->tanggal)->format('d-m-Y');
                return $formatedDate;
            })
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="/detail-stok-keluar/'.$data->id.'" id="btn-detail" class="btn btn-sm btn-warning" title="Detail Data"><i class="bi bi-eye-fill"></i></a>
                    <a href="#" id="surat-jalan" class="btn btn-sm btn-primary surat-jalan" data-id="'.$data->id.'" onclick="suratJalan(' . $data->id . ')" title="surat Jalan"><i class="bi bi-card-text"></i></a>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    
    public function listKeluarFilter(Request $request){
        if(Auth::user()->role == 1){
            $data = HistoryStok::with('user')->whereStatus('2');
        }else{
            $data = HistoryStok::with('user')->whereStatus('2')->whereUser_id(Auth::user()->id);
        }

        $bulan = join(",",$request->bulan);
        $tahun = join(",",$request->tahun);
        $data = $data->whereRaw('EXTRACT(MONTH FROM tanggal) in ('.$bulan.')');
        $data = $data->whereRaw('EXTRACT(YEAR FROM tanggal) in ('.$tahun.')');
        // foreach($request->tahun as $th){
        //     $data = $data->whereYear('tanggal',$th);
        // }

        $data = $data->get();
        
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($data) {
                $formatedDate = Carbon::createFromFormat('Y-m-d', $data->tanggal)->format('d-m-Y');
                return $formatedDate;
            })
            ->addColumn('aksi', function ($data) {
                return '
                    <a href="/detail-stok-keluar/'.$data->id.'" id="btn-detail" class="btn btn-sm btn-warning" title="Detail Data"><i class="bi bi-eye-fill"></i></a>
                    <a href="#" id="surat-jalan" class="btn btn-sm btn-primary surat-jalan" data-id="'.$data->id.'" onclick="suratJalan(' . $data->id . ')" title="surat Jalan"><i class="bi bi-card-text"></i></a>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function detail($id){
        $data['title'] = 'Stok Keluar';
        $data['history'] = HistoryStok::with('user','project')->find($id);
        $data['historyDetail'] = HistoryStokDetail::with('sku.barang.satuan')->whereHistory_id($id)->get();

        return view('stok_keluar.detail',$data);
    }

    public function suratJalan(Request $request){
        $data['data'] = HistoryStok::with('historyStokDetail.sku.barang.satuan','project','user')->find($request->id);
        $data['kop'] = $request->kop;

        // return view('stok_keluar.suratjalan',$data);
        $pdf = \PDF::loadview('stok_keluar.suratjalan', $data);
        return $pdf->download('suratjalan.pdf');
    }

    private function _bulan()
    {
        $daftar_bulan = array(
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        );
        return $daftar_bulan;
    }
}
