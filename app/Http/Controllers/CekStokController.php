<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CekStokController extends Controller
{
    public function index(){
        $data['title'] = 'Cek Stok';

        return view('cek_stok.index',$data);
    }
}
