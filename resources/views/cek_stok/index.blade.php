@extends('layouts.layout')

@section('title', $title)

@push('css')
    <link href="{{ asset('select2') }}/dist/css/select2.css" rel="stylesheet" />
@endpush

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
                    <div class="row mb-3" id="div-gudang">
                        <label for="gudang" class="col-sm-2 col-form-label">Pilih Gudang</label>
                        <div class="col-sm-3">
                            <select class="form-select select2" aria-label="Default select example" name="gudang" id="gudang">
                                <option value="" selected>-- Pilih Gudang --</option>
                                <option value="0">GUDANG PUSAT</option>
                                @foreach ($project as $p)
                                    <option value="{{ $p['id'] }}">{{ $p['project'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <table class="table" id="datatable" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
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
<script src="{{ asset('select2') }}/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    }).on('change','#gudang',function(){
        var id = $(this).val();
        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: '/list-barang-gudang/'+id,
            },
            columns: [
                { data: 'DT_RowIndex', class: 'text-center'},
                { data: 'kategori.kategori'},
                { data: 'nama_barang'},
                { data: 'merk.merk'},
                { data: 'type.type'},
                { data: 'stok_total'},
                { data: 'aksi1', class: 'text-center'}
            ],
            destroy: true
        });
    });

</script>
@endpush