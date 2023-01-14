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
                        <div class="col-sm-10">{{ $transaksi->no_surat_jalan }}</div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"><b>Tanggal</b></label>
                        <div class="col-sm-10">{{ $transaksi->tanggal }}</div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"><b>PIC</b></label>
                        <div class="col-sm-10">{{ $transaksi->user->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"><b>Deskripsi</b></label>
                        <div class="col-sm-10">{{ $transaksi->deskripsi }}</div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label"><b>Keterangan</b></label>
                        <div class="col-sm-10">{{ $transaksi->keterangan }}</div>
                    </div>
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Barang</th>
                                <th scope="col">SKU</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksiDetail as $td)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $td->sku->barang->nama_barang }}</td>
                                    <td>{{ $td->sku->sku }} {{ $td->sku->varian }}</td>
                                    <td>{{ $td->qty }} {{ $td->sku->barang->satuan->satuan }}</td>
                                    <td>{{ $td->lokasi->lokasi }}</td>
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