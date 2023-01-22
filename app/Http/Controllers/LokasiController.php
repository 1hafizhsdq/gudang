<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class LokasiController extends Controller
{
    public function index()
    {
        $data['title'] = "Lokasi";

        return view('admin.lokasi.index',$data);
    }

    public function listLokasi()
    {
        $data = Lokasi::get();
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
            'lokasi' => 'required',
        ], [
            'lokasi.required' => 'Lokasi tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            if ($request->id == null) {
                Lokasi::create(['lokasi' => $request->lokasi]);
            } else {
                Lokasi::where('id', $request->id)->update(['lokasi' => $request->lokasi]);
            }
            return response()->json(['success' => 'Berhasil menyimpan data.']);
        }
    }

    public function show(Lokasi $lokasi)
    {
        //
    }

    public function edit($id)
    {
        $data = Lokasi::find($id);
        return response()->json($data);
    }

    public function update(Request $request, Lokasi $lokasi)
    {
        //
    }

    public function destroy($id)
    {
        Lokasi::find($id)->delete();
        return response()->json(['success' => 'berhasil menghapus data']);
    }
}
