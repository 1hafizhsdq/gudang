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
                    {{-- <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" class="mt-3" id="form-barang"> --}}
                    <form class="mt-3" id="form-barang">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ (!empty($barang)) ? $barang->id : '' }}">
                        <div class="row mb-3">
                            <label for="kode_barang" class="col-sm-2 col-form-label">Kode Barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="kode_barang" name="kode_barang" value="{{ (!empty($barang)) ? $barang->kode_barang : '' }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_barang" name="nama_barang" value="{{ (!empty($barang)) ? $barang->nama_barang : '' }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <select class="form-select select2" aria-label="Default select example" name="kategori_id" id="kategori_id">
                                    <option selected="">-- Pilih Kategori --</option>
                                    @foreach ($kategori as $kt)
                                        <option value="{{ $kt->id }}" {{ (!empty($barang)) ? ($barang->kategori_id == $kt->id) ? 'selected' : '' : '' }}>{{ $kt->kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="merk" class="col-sm-2 col-form-label">Merk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="merk" name="merk" value="{{ (!empty($barang)) ? $barang->merk : '' }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="type" class="col-sm-2 col-form-label">Type</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="type" name="type" value="{{ (!empty($barang)) ? $barang->type : '' }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Satuan</label>
                            <div class="col-sm-10">
                                <select class="form-select select2" aria-label="Default select example" name="satuan_id" id="satuan_id">
                                    <option selected="">-- Pilih Satuan --</option>
                                    @foreach ($satuan as $st)
                                        <option value="{{ $st->id }}" {{ (!empty($barang)) ? ($barang->satuan_id == $st->id) ? 'selected' : '' : '' }}>{{ $st->satuan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 div-foto">
                            <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                @if(empty($barang->foto))
                                <input class="form-control" type="file" id="foto" name="foto">
                                @else
                                <a href="/foto_barang/{{ $barang->foto }}" class="btn btn-primary" target="_blank">Lihat Foto</a>
                                <a class="btn btn-danger" id="del-foto" data-id="{{ $barang->id }}"><i class="bi bi-trash-fill"></i></a>
                                <input style="display: none" class="form-control" type="file" id="foto" name="foto">
                                @endif
                            </div>
                        </div>
                        <button type="button" id="sv" class="btn btn-primary mt-3">Simpan</button>
                    </form>
                        <hr>
                    <div class="row mb-3">
                        <label class="col-sm-12 col-form-label"><b>SKU & Varian</b></label>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-primary mt-4 mb-4" id="add-sku">Tambah Varian</button>
                            <table class="table">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>SKU</th>
                                        <th>Varian</th>
                                        <th width="15%">*</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    @if (!empty($sku))
                                        @foreach ($sku as $sku)
                                            <tr>
                                                <td>{{ $sku->sku }}</td>
                                                <td>{{ $sku->varian }}</td>
                                                <td>
                                                    <a class="btn btn-warning edit-sku" data-id="{{ $sku->id }}" data-barang="{{ $sku->barang_id }}"><i class="bi bi-pencil-fill"></i></a>
                                                    <a class="btn btn-danger del-sku" data-id="{{ $sku->id }}" data-barang="{{ $sku->barang_id }}"><i class="bi bi-trash-fill"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@includeIf('admin.barang.modal')
@endsection

@push('script')
<script src="{{ asset('select2') }}/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();

        $('#add-sku').click(function(){
            if($('#id').val() == ''){
                errorMsg('Barang belum tersimpan/tidak ada, simpan terlibh dahulu barang anda!');
            }else{
                $('#sku').val('');
                $('#varian').val('');
                $('#idbarang').val($('#id').val());
                $('#modal-barang').modal('show');
                $('.modal-title').html('Form Tambah SKU & Varian');
            }
        });
    }).on('click','#sv-sku',function(){
        var form = $('#form-sku'),
        data = form.serializeArray();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('sku-store')}}",
            method: "POST",
            data: data,
            beforeSend: function() {
                $("#sv-sku").replaceWith(`
                <button class="btn btn-primary" type="button" id="loading-sku" disabled="">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
                `)
            },
            success: function(result) {
                if (result.success) {
                    successMsg(result.success)
                    $('#modal-barang').modal('hide');
                    $('#form-sku').find('input').val('');
                    $("#loading-sku").replaceWith(`
                        <button type="submit" id="sv-sku" class="btn btn-primary">Simpan</button>
                    `);
                    
                    var tbody = '';
                    $.each(result.sku, function( key, val ) {
                        tbody +=`
                            <tr>
                                <td>`+val.sku+`</td>
                                <td>`+val.varian+`</td>
                                <td>
                                    <a class="btn btn-warning edit-sku" data-id="`+val.id+`" data-barang="`+val.barang_id+`"><i
                                            class="bi bi-pencil-fill"></i></a>
                                    <a class="btn btn-danger del-sku" data-id="`+val.id+`" data-barang="`+val.barang_id+`"><i
                                            class="bi bi-trash-fill"></i></a>
                                </td>
                            </tr>
                        `;
                    })
                    $('#tbody').html(tbody);
                } else {
                    errorMsg(result.errors)
                    $("#loading-sku").replaceWith(`
                        <button type="submit" id="sv-sku" class="btn btn-primary">Simpan</button>
                    `);
                }
            },
        });
    }).on('click','.del-sku',function(){
        var id = $(this).data('id'),
            barang = $(this).data('barang')
        Swal.fire({
            icon: 'warning',
            title: 'Apakah anda yakin akan menghapus data ini?',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            confirmButtonColor: '#d3455b',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/del-sku/" + id + "/" + barang,
                    method: 'GET',
                    success: function(result) {
                        if (result.success) {
                            successMsg(result.success)
                            
                            var tbody = '';
                            $.each(result.sku, function( key, val ) {
                            tbody +=`
                            <tr>
                                <td>`+val.sku+`</td>
                                <td>`+val.varian+`</td>
                                <td>
                                    <a class="btn btn-warning edit-sku" data-id="`+val.id+`" data-barang="`+val.barang_id+`"><i
                                            class="bi bi-pencil-fill"></i></a>
                                    <a class="btn btn-danger del-sku" data-id="`+val.id+`" data-barang="`+val.barang_id+`"><i
                                            class="bi bi-trash-fill"></i></a>
                                </td>
                            </tr>
                            `;
                            })
                            $('#tbody').html(tbody);
                        } else {
                            errorMsg(result.errors)
                        }
                    }
                });
            }
        });
    }).on('click','.edit-sku',function(){
        var id = $(this).data('id')
        $.ajax({
            url: "/edit-sku/" + id,
            method: 'GET',
            success: function(result) {
                $('#idsku').val(result.id);
                $('#sku').val(result.sku);
                $('#varian').val(result.varian);
                $('#idbarang').val($('#id').val());
                $('#modal-barang').modal('show');
                $('.modal-title').html('Form Edit SKU & Varian');
            }
        });
    }).on('click','#sv',function(){
        var id = $('#id').val();

        var form = $('#form-barang'),
            data = new FormData(form[0]);
        
        var files = $('#foto')[0].files;
        
        if(files.length > 0){
            data.append('foto',files[0]);
        }

        // if(id == ''){
        //     var url = "{{route('barang.store')}}",
        //         method = "POST";
        // }else{
        //         var url = "/barang/"+id+"",
        //         method = "PUT";
        // }

        var url = "{{route('barang.store')}}",
            method = "POST";
        
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            method: method,
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $("#sv").replaceWith(`
                <button class="btn btn-primary" type="button" id="loading" disabled="">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
                `)
            },
            success: function(result) {
                if (result.success) {
                    successMsg(result.success)
                    $("#loading").replaceWith(`
                        <button type="button" id="sv" class="btn btn-primary">Simpan</button>
                    `);
                    $('#id').val(result.id);
                    $('.div-foto').html(`
                        <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10 lihat-foto mt-2">
                            <a href="/foto_barang/`+result.foto+`" class="btn btn-primary" target="_blank">Lihat Foto</a>
                            <a class="btn btn-danger" id="del-foto" data-id="`+result.id+`" data-foto="`+result.foto+`"><i class="bi bi-trash-fill"></i></a>
                            <input style="display: none" class="form-control" type="file" id="foto" name="foto">
                        </div>
                    `);
                } else {
                    errorMsg(result.errors);
                    
                    $("#loading").replaceWith(`
                    <button type="button" id="sv" class="btn btn-primary">Simpan</button>
                    `);
                }
            },
        });
    }).on('click','#del-foto',function(){
        var id = $(this).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('del-foto')}}",
            method: "POST",
            data: {
                id : id, 
            },
            success: function(result) {
                if (result.success) {
                    successMsg(result.success)
                    $('.div-foto').html(`
                        <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10 lihat-foto mt-2">
                            <input class="form-control" type="file" id="foto" name="foto">
                        </div>
                    `);
                } else {
                    errorMsg(result.errors)
                }
            },
        });
    });
</script>
@endpush