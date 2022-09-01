<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    public function index()
    {
        $data['title'] = "Supplier";

        return view('admin.supplier.index', $data);
    }

    public function listSupplier()
    {
        $data = Supplier::get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('tgl_terdaftar', function ($data) {
                $formatedDate = Carbon::createFromFormat('Y-m-d', $data->tgl_terdaftar)->format('d-m-Y');
                return $formatedDate;
            })
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
            'nama' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
            'pic_sales' => 'required',
            'tgl_terdaftar' => 'required',
        ], [
            'nama.required' => 'Nama tidak boleh kosong!',
            'telp.required' => 'Telepon tidak boleh kosong!',
            'alamat.required' => 'Alamat tidak boleh kosong!',
            'pic_sales.required' => 'PIC Sales tidak boleh kosong!',
            'tgl_terdaftar.required' => 'Tanggal terdaftar tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            if ($request->id == null) {
                $supplier = Supplier::create([
                    'nama' => $request->nama,
                    'telp' => $request->telp,
                    'alamat' => $request->alamat,
                    'pic_sales' => $request->pic_sales,
                    'tgl_terdaftar' => $request->tgl_terdaftar,
                ]);
                Supplier::where('id',$supplier->id)->update(['kode_supplier' => 'SPL0'.$supplier->id]);
            } else {
                Supplier::where('id', $request->id)->update([
                    'nama' => $request->nama,
                    'telp' => $request->telp,
                    'alamat' => $request->alamat,
                    'pic_sales' => $request->pic_sales,
                    'tgl_terdaftar' => $request->tgl_terdaftar,
                ]);
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
        $data = Supplier::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        Supplier::find($id)->delete();
        return response()->json(['success' => 'berhasil menghapus data']);
    }
}
