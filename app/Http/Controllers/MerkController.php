<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MerkController extends Controller
{
    public function index()
    {
        $data['title'] = "Merk";

        return view('admin.merk.index',$data);
    }

    public function listmerk(){
        $data = Merk::get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                return '
                <a href="javascript:void(0)" id="btn-delete" onclick="editData(' . $data->id . ')" class="btn btn-sm btn-warning" data-id="' . $data->id . '" title="Edit Data"><i class="bi bi-pencil-fill"></i></a>
                <a href="javascript:void(0)" id="btn-delete" onclick="deleteData(' . $data->id . ')" class="btn btn-sm btn-danger" data-id="' . $data->id . '" title="Hapus Data"><i class="bi bi-trash-fill"></i></a>
            ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'merk' => 'required',
        ], [
            'merk.required' => 'Merk tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            if ($request->id == null) {
                Merk::create(['merk' => $request->merk]);
            } else {
                Merk::where('id', $request->id)->update(['merk' => $request->merk]);
            }
            return response()->json(['success' => 'Berhasil menyimpan data.']);
        }
    }

    public function show(Merk $merk)
    {
        //
    }

    public function edit($id)
    {
        $data = Merk::find($id);
        return response()->json($data);
    }

    public function update(Request $request, Merk $merk)
    {
        //
    }

    public function destroy($id)
    {
        Merk::find($id)->delete();
        return response()->json(['success' => 'berhasil menghapus data']);
    }
}
