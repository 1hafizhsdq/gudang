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
                                <th scope="col">Tanggal</th>
                                <th scope="col">No Surat Jalan</th>
                                <th scope="col">PIC</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Keterangan</th>
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
            url: '{{ route("list-stok-masuk") }}',
        },
        columns: [
            { data: 'tanggal'},
            { data: 'no_surat_jalan'},
            { data: 'user.name'},
            { data: 'deskripsi'},
            { data: 'keterangan'},
            { data: 'aksi', class: 'text-center'},
        ]
    });
</script>
@endpush