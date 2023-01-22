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
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-3 col-sm-12">
                                <img src="{{ asset('foto_barang') }}/{{ $barang->foto }}" class="img-fluid rounded-start" alt="foto barang" style="width:300px;height:300px">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                                    <div class="card-text">
                                        <div class="row">
                                            <div class="col-lg-2 col-sm-4"><b>Merk</b></div>
                                            <div class="col-10 col-sm-8">{{ $barang->merk->merk }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2 col-sm-4"><b>Type</b></div>
                                            <div class="col-10 col-sm-8">{{ $barang->type->type }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2 col-sm-4"><b>Stok Total</b></div>
                                            <div class="col-10 col-sm-8">{{ $barang->stok_total }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table" id="datatable" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">SKU</th>
                                <th scope="col">Varian</th>
                                <th scope="col">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
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
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: '/list-sku/'+{{ $barang->id }},
        },
        columns: [
            { data: 'DT_RowIndex', class: 'text-center'},
            { data: 'sku'},
            { data: 'varian'},
            { data: 'stok_baru'},
        ]
    });
</script>
@endpush