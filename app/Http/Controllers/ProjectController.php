<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    public function index()
    {
        $data['title'] = "Project";

        return view('admin.project.index', $data);
    }

    public function listProject()
    {
        $data = Project::get();
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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_project' => 'required',
            'alamat_project' => 'required',
            'nama_perusahaan' => 'required',
            'alamat_perusahaan' => 'required',
        ], [
            'nama_project.required' => 'Nama Project tidak boleh kosong!',
            'alamat_project.required' => 'Alamat Project tidak boleh kosong!',
            'nama_perusahaan.required' => 'Nama Perusahaan tidak boleh kosong!',
            'alamat_perusahaan.required' => 'Alamat Perusahaan tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            if ($request->id == null) {
                $project = Project::create([
                    'nama_project' => $request->nama_project,
                    'alamat_project' => $request->alamat_project,
                    'nama_perusahaan' => $request->nama_perusahaan,
                    'alamat_perusahaan' => $request->alamat_perusahaan,
                ]);
                Project::where('id', $project->id)->update(['kode_project' => 'PRJ0' . $project->id]);
            } else {
                Project::where('id', $request->id)->update([
                    'nama_project' => $request->nama_project,
                    'alamat_project' => $request->alamat_project,
                    'nama_perusahaan' => $request->nama_perusahaan,
                    'alamat_perusahaan' => $request->alamat_perusahaan,
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
        $data = Project::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        Project::find($id)->delete();
        return response()->json(['success' => 'berhasil menghapus data']);
    }
}
