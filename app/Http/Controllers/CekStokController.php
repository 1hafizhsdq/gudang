<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Sku;
use App\Models\Stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class CekStokController extends Controller
{
    public function index(){
        $data['title'] = 'Cek Stok';
        $data['project'] = $this->getProject();

        return view('cek_stok.index',$data);
    }

    public function listBarang($idgudang)
    {
        $gudang = Stok::where('project_id',$idgudang)->pluck('id');
        $data = Barang::with('kategori','satuan','merk','type')->whereIn('id',$gudang)->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                return '
                <a href="'.url('barang').'/'.$data->id.'/edit" id="btn-delete" onclick="editData(' . $data->id . ')" class="btn btn-sm btn-warning" data-id="' . $data->id . '" title="Edit Data"><i class="bi bi-pencil-fill"></i></a>
                <a href="javascript:void(0)" id="btn-delete" onclick="deleteData(' . $data->id . ')" class="btn btn-sm btn-danger" data-id="' . $data->id . '" title="Hapus Data"><i class="bi bi-trash-fill"></i></a>
            ';
            })
            ->addColumn('aksi1', function ($data) {
                return '
                <a href="/cek-stok-detail/'.$data->id.'" id="btn-detail" class="btn btn-sm btn-warning" title="Detail Data"><i class="bi bi-eye-fill"></i></a>
            ';
            })
            ->editColumn('stok_total',function($data){
                if($data->stok_total == null){
                    return '0 '.$data->satuan->satuan;
                }else{
                    return $data->stok_total.' ' . $data->satuan->satuan;
                }
            })
            ->rawColumns(['aksi','aksi1'])
            ->make(true);
    }

    public function detail($id){
        $data['title'] = 'Cek Stok';
        $data['barang'] = Barang::find($id);
        $data['sku'] = Sku::whereBarang_id($id)->get();
        
        return view('cek_stok.detail',$data);
    }

    public function listSku($id)
    {
        $data = Sku::whereBarang_id($id)->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->rawColumns([])
            ->make(true);
    }

    public function getProject(){
        try {
            $res = Http::withHeaders([
                'Authorization' =>  'Bearer ' . Auth::user()->remember_token,
                'Content-Type' => 'application/json' 
            ])->get('htk.test/api/project-list');
        } catch (\Throwable $th) {
            return 'Terjadi Kesalahan';
        }
        $data = json_decode($res->body(),true);

        return $data['data'];
    }
}
