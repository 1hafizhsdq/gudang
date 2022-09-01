<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SatuanController extends Controller
{
    public function index()
    {
        $data['title'] = "Satuan";

        return view('admin.satuan.index', $data);
    }

    public function listSatuan()
    {
        $data = Satuan::get();
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
            'satuan' => 'required',
        ], [
            'satuan.required' => 'Satuan tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            if ($request->id == null) {
                Satuan::create(['satuan' => $request->satuan]);
            } else {
                Satuan::where('id', $request->id)->update(['satuan' => $request->satuan]);
            }
            return response()->json(['success' => 'Berhasil menyimpan data.']);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Satuan::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        Satuan::find($id)->delete();
        return response()->json(['success' => 'berhasil menghapus data']);
    }
}
