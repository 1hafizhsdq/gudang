<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Merk;
use App\Models\Satuan;
use App\Models\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index()
    {
        $data['title'] = 'Barang';

        return view('admin.barang.index',$data);
    }

    public function listBarang()
    {
        $data = Barang::with('kategori','satuan','merk','type')->get();
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

    public function create()
    {
        $data['title'] = 'Barang';
        $data['kategori'] = Kategori::get();
        $data['satuan'] = Satuan::get();

        return view('admin.barang.form', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'merk_id' => [
                'required',
                Rule::unique('barangs')->where(function ($q) use ($request){
                    return $q->where('type_id',$request->type_id);
                })
            ],
            'type_id' => 'required',
            'satuan_id' => 'required',
            // 'foto' => 'required|max:2048|mimes:jpeg,jpg,png',
        ], [
            'nama_barang.required' => 'Nama Barang tidak boleh kosong!',
            'kategori_id.required' => 'Kategori tidak boleh kosong!',
            'merk_id.required' => 'Merk tidak boleh kosong!',
            'merk_id.unique' => 'Merk dan Type ini sudah pernah di input',
            'type_id.required' => 'Type tidak boleh kosong!',
            'satuan_id.required' => 'Satuan tidak boleh kosong!',
            // 'foto.required' => 'Foto tidak boleh kosong!',
            // 'foto.max' => 'Ukuran maksimal foto 2MB!',
            // 'foto.mimes' => 'Tipe file foto harus jpg atau png!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            if($request->id == null){
                $file = $request->file('foto');
                $filename = time() . '_' . $file->getClientOriginalName();
                $location = 'foto_barang';
                $file->move($location, $filename);

                $barang = Barang::create([
                    'kode_barang' => $request->kode_barang,
                    'nama_barang' => $request->nama_barang,
                    'kategori_id' => $request->kategori_id,
                    'merk_id' => $request->merk_id,
                    'type_id' => $request->type_id,
                    'satuan_id' => $request->satuan_id,
                    'foto' => $filename,
                ]);

                return response()->json([
                    'success' => 'Berhasil menyimpan data.', 
                    'id' => $barang->id, 
                    'foto' => $filename
                ]);
            }else{
                $data = [
                    'kode_barang' => $request->kode_barang,
                    'nama_barang' => $request->nama_barang,
                    'kategori_id' => $request->kategori_id,
                    'merk_id' => $request->merk_id,
                    'type_id' => $request->type_id,
                    'satuan_id' => $request->satuan_id,
                ];
                if($request->file('foto')){
                    $file = $request->file('foto');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $location = 'foto_barang';
                    $file->move($location, $filename);
                    $data = array_merge($data,['foto' => $filename]);
                }

                $barang = Barang::where('id',$request->id)->update($data);

                $data = Barang::find($request->id);

                return response()->json([
                    'success' => 'Berhasil menyimpan data.',
                    'id' => $request->id,
                    'foto' => $data->foto
                ]);
            }
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['title'] = 'Barang';
        $data['kategori'] = Kategori::get();
        $data['satuan'] = Satuan::get();
        $data['barang'] = Barang::find($id);
        $data['sku'] = Sku::where('barang_id',$id)->get();

        return view('admin.barang.form', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'merk_id' => 'required',
            'type_id' => 'required',
            'satuan_id' => 'required',
        ], [
            'kode_barang.required' => 'Kode Barang tidak boleh kosong!',
            'nama_barang.required' => 'Nama Barang tidak boleh kosong!',
            'kategori_id.required' => 'Kategori tidak boleh kosong!',
            'merk_id.required' => 'Merk tidak boleh kosong!',
            'type_id.required' => 'Type tidak boleh kosong!',
            'satuan_id.required' => 'Satuan tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $data = [
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'kategori_id' => $request->kategori_id,
                'merk_id' => $request->merk_id,
                'type_id' => $request->type_id,
                'satuan_id' => $request->satuan_id,
            ];

            if($request->foto != null){
                $file = $request->file('foto');
                $filename = time() . '_' . $file->getClientOriginalName();
                $location = 'foto_barang';
                $file->move($location, $filename);
                $data[] = ['foto' => $filename];
            }

            $barang = Barang::create();

            return response()->json([
                'success' => 'Berhasil menyimpan data.',
                'id' => $barang->id,
                'foto' => $filename
            ]);
        }
    }

    public function storeSku(Request $request){
        if($request->idsku == null){
            Sku::create([
                'barang_id' => $request->idbarang,
                'sku' => $request->sku,
                'varian' => $request->varian,
            ]);
        }else{
            Sku::where('id',$request->idsku)->update([
                'barang_id' => $request->idbarang,
                'sku' => $request->sku,
                'varian' => $request->varian,
            ]);
        }
        return response()->json([
            'success' => 'Berhasil menyimpan data.',
            'sku' => Sku::where('barang_id',$request->idbarang)->get(),
        ]);
    }

    public function editSku($id){
        $sku = Sku::find($id);
        return response()->json($sku);
    }

    public function destroy($id)
    {
        Sku::where('barang_id',$id)->delete();
        Barang::find($id)->delete();
        return response()->json(['success' => 'Berhasil menghapus data']);
    }

    public function delFoto(Request $request){
        $foto = Barang::find($request->id);
        File::delete('foto_barang/'.$foto->foto);
        Barang::where('id',$request->id)->update(['foto' => null]);
        return response()->json(['success' => 'Berhasil menghapus foto']);
    }
    
    public function delSku($id,$barang){
        Sku::find($id)->delete();
        $sku = Sku::where('barang_id',$barang)->get();
        return response()->json(['success' => 'Berhasil menghapus SKU','sku' => $sku]);
    }

    public function findMerk(Request $request){
        $data = Merk::with('type')->where('merk', 'LIKE', '%' . $request->term . '%')->get();
        return response()->json($data);
    }

}
