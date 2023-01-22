<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    public function index()
    {
        $data['title'] = "Client";

        return view('admin.client.index', $data);
    }

    public function listClient()
    {
        $data = Client::get();
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
            'tgl_terdaftar' => 'required',
        ], [
            'nama.required' => 'Nama tidak boleh kosong!',
            'telp.required' => 'Telepon tidak boleh kosong!',
            'alamat.required' => 'Alamat tidak boleh kosong!',
            'tgl_terdaftar.required' => 'Tanggal terdaftar tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            if ($request->id == null) {
                $client = Client::create([
                    'nama' => $request->nama,
                    'telp' => $request->telp,
                    'alamat' => $request->alamat,
                    'tgl_terdaftar' => $request->tgl_terdaftar,
                ]);
                Client::where('id',$client->id)->update(['kode_client' => 'CL0'.$client->id]);
            } else {
                Client::where('id', $request->id)->update([
                    'nama' => $request->nama,
                    'telp' => $request->telp,
                    'alamat' => $request->alamat,
                    'tgl_terdaftar' => $request->tgl_terdaftar,
                ]);
            }
            return response()->json(['success' => 'Berhasil menyimpan data.']);
        }
    }

    public function show(Client $client)
    {
        //
    }

    public function edit($id)
    {
        $data = Client::find($id);
        return response()->json($data);
    }

    public function update(Request $request, Client $client)
    {
        //
    }

    public function destroy($id)
    {
        Client::find($id)->delete();
        return response()->json(['success' => 'berhasil menghapus data']);
    }
}
