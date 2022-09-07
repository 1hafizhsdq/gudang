@extends('layouts.layout')

@section('title', $title)

@section('content')
<div class="pagetitle">
    <h1>{{ $title }}</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <br>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"><b>No Surat Jalan</b></label>
                        <div class="col-sm-10">{{ $history->no_surat_jalan }}</div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"><b>Tanggal</b></label>
                        <div class="col-sm-10">{{ $history->tanggal }}</div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"><b>PIC</b></label>
                        <div class="col-sm-10">{{ $history->user->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"><b>Project</b></label>
                        <div class="col-sm-10">{{ $history->project->nama_project }}</div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"><b>Driver</b></label>
                        <div class="col-sm-10">{{ $history->driver }}</div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"><b>Nopol</b></label>
                        <div class="col-sm-10">{{ $history->nopol }}</div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"><b>Penerima</b></label>
                        <div class="col-sm-10">{{ $history->penerima }}</div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"><b>Deskripsi</b></label>
                        <div class="col-sm-10">{{ $history->deskripsi }}</div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"><b>Keterangan</b></label>
                        <div class="col-sm-10">{{ $history->keterangan }}</div>
                    </div>
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Barang</th>
                                <th scope="col">SKU</th>
                                <th scope="col">Stok Baru</th>
                                <th scope="col">Stok Bekas</th>
                                <th scope="col">Update Stok Baru</th>
                                <th scope="col">Update Stok Bekas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($historyDetail as $hd)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $hd->sku->barang->nama_barang }}</td>
                                    <td>{{ $hd->sku->sku }} {{ $hd->sku->varian }}</td>
                                    <td>{{ $hd->stok_baru }} {{ $hd->sku->barang->satuan->satuan }}</td>
                                    <td>{{ $hd->stok_bekas }} {{ $hd->sku->barang->satuan->satuan }}</td>
                                    <td>{{ $hd->update_stok_baru }} {{ $hd->sku->barang->satuan->satuan }}</td>
                                    <td>{{ $hd->update_stok_bekas }} {{ $hd->sku->barang->satuan->satuan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    $('#datatable').DataTable({
        responsive: true
    });
</script>
@endpush