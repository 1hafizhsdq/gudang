<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TypeController extends Controller
{
    public function index()
    {
        $data['title'] = "Type";
        $data['merk'] = Merk::get();

        return view('admin.type.index',$data);
    }

    public function listtype(){
        $data = Type::with('merk')->get();
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
            'merk_id' => 'required',
            'type' => 'required',
        ], [
            'merk_id.required' => 'Merk tidak boleh kosong!',
            'type.required' => 'Type tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            if ($request->id == null) {
                Type::create(['merk_id' => $request->merk_id,'type' => $request->type]);
            } else {
                Type::where('id', $request->id)->update(['merk_id' => $request->merk_id, 'type' => $request->type]);
            }
            return response()->json(['success' => 'Berhasil menyimpan data.']);
        }
    }

    public function show(Type $type)
    {
        //
    }

    public function edit($id)
    {
        $data = Type::find($id);
        return response()->json($data);
    }

    public function update(Request $request, Type $type)
    {
        //
    }

    public function destroy($id)
    {
        Type::find($id)->delete();
        return response()->json(['success' => 'berhasil menghapus data']);
    }
}
