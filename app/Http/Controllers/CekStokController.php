<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Sku;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CekStokController extends Controller
{
    public function index(){
        $data['title'] = 'Cek Stok';

        return view('cek_stok.index',$data);
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
}
