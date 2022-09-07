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
                    <table class="table" id="datatable" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Merk</th>
                                <th scope="col">Type</th>
                                <th scope="col">Stok Total</th>
                                <th scope="col">Aksi</th>
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
            url: '{{ route("list-barang") }}',
        },
        columns: [
            { data: 'DT_RowIndex', class: 'text-center'},
            { data: 'kode_barang'},
            { data: 'kategori.kategori'},
            { data: 'nama_barang'},
            { data: 'merk'},
            { data: 'type'},
            { data: 'stok_total'},
            { data: 'aksi1', class: 'text-center'}
        ]
    });
</script>
@endpush