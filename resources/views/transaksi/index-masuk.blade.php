@extends('layouts.layout')

@section('title', $title)

@push('css')
<link href="{{ asset('select2') }}/dist/css/select2.css" rel="stylesheet" />
@endpush

@section('content')
<div class="pagetitle">
    <h1>{{ $title }}</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <form class="mt-3" id="form-transaksi">
                        @csrf
                        <input type="hidden" name="id" id="id" value="">
                        <div class="row">
                            <div class="col">
                                <div class="row mb-3" style="display: none;">
                                    <label class="col-sm-3 col-form-label">Tipe</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" class="form-control" name="tipe" id="tipe" value="1">
                                    </div>
                                </div>
                                <div class="row mb-3 st-masuk">
                                    <label for="no_surat_jalan" class="col-sm-3 col-form-label">No Surat Jalan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="no_surat_jalan" id="no_surat_jalan">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="tanggal" id="tanggal">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" style="height: 100px" name="deskripsi" id="deskripsi" placeholder="Deskripsi"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="pic" class="col-sm-3 col-form-label">PIC</label>
                                    <div class="col-sm-9">
                                        <select class="form-select select2" aria-label="Default select example" name="user_id" id="user_id" {{ (Auth::user()->kategori_admin != 1)?'disabled':'' }}>
                                            <option selected="">-- Pilih PIC --</option>
                                            @foreach ($pic as $p)
                                                <option value="{{$p->id}}" {{ (Auth::user()->id == $p->id)?'selected':'' }}>{{$p->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" style="height: 100px" name="keterangan" id="keterangan" placeholder="keterangan"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <a id="sv" class="btn btn-primary">Simpan</a>
                                </div>
                            </div>
                            <div class="col">
                                <a id="add-barang" class="btn btn-primary mb-2">Tambah Barang</a>
                                <table class="table">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>Barang</th>
                                            <th>SKU</th>
                                            <th>Baru</th>
                                            <th>Bekas</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@includeIf('transaksi.modal')
@endsection

@push('script')
<script src="{{ asset('select2') }}/dist/js/select2.min.js"></script>
<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode> 57)) {
            return false;
            }
            return true;
    }

    $(document).ready(function() {
        $('.select2').select2();
        $(".select2-modal").select2({
            dropdownParent: $("#modal-barang"),
            width: '100%'
        });

        $('#add-barang').click(function(){
            if($('#id').val() == ''){
                errorMsg('Tipe dan keterangan belum tersimpan/tidak ada, simpan terlibh dahulu tipe & keterangan anda!');
            }else{
                $('#history_id').val($('#id').val());
                $('#status_tipe').val($('#status').val());
                $('#modal-barang').modal('show');
            }
        });
    }).on('click','#sv',function(){
        var form = $('#form-transaksi'),
            data = form.serializeArray();

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/post-tr-stok',
            method: 'POST',
            data: data,
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
                } else {
                    errorMsg(result.errors);
                    
                    $("#loading").replaceWith(`
                        <button type="button" id="sv" class="btn btn-primary">Simpan</button>
                    `);
                }
            },
        });
    }).on('change','#barang_id',function(){
        var barang = $(this).val();
        
        $.ajax({
            url: '/get-sku/' + barang,
            method: 'GET',
            success: function(result) {
                var option = '<option>-- Pilih SKU --</option>'
                $.each(result, function(key, val) {
                    option += '<option value="'+val.id+'">'+val.sku+' - '+val.varian+'</option>'
                });
                $('#sku_id').html(option);
            },
        });
    }).on('change','#sku_id',function(){
        var sku = $(this).val();
        
        $.ajax({
            url: '/get-stok-now/' + sku,
            method: 'GET',
            success: function(result) {
                $('#gudang_bekas').val(result.stok_bekas)
                $('#gudang_baru').val(result.stok_baru)
            },
        });
    }).on('click','#sv-barang',function(){
        var tipe = $('#status').val(),
            gudang_bekas = $('#gudang_bekas').val(),
            gudang_baru = $('#gudang_baru').val(),
            bekas = $('#bekas').val(),
            baru = $('#baru').val();

        Swal.fire({
            icon: 'warning',
            title: 'Apakah anda yakin akan menyimpan data ini? Setelah disimpan data tidak dapat diubah!',
            showCancelButton: true,
            confirmButtonText: 'Yakin',
            confirmButtonColor: '#d3455b',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                if(tipe == 2){
                    if(parseInt(bekas) > parseInt(gudang_bekas)){
                        errorMsg("stok barang bekas di gudang lebih kecil, silahkan turunkan jumlah anda!");
                        return false;
                    }
                    if(parseInt(gudang_baru) < parseInt(baru)){
                        errorMsg("stok barang baru di gudang lebih kecil, silahkan turunkan jumlah anda!");
                        return false;
                    }
                }
        
                var form = $('#form-barang'),
                    data = form.serializeArray();
                
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/post-barang',
                    method: 'POST',
                    data: data,
                    beforeSend: function() {
                        $("#sv-barang").replaceWith(`
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
                                <button type="button" id="sv-barang" class="btn btn-primary">Simpan</button>
                            `);
                            var tbody = '';
                            $.each(result.tbl, function(key, val) {
                            tbody += `
                                <tr>
                                    <td>`+val.sku.barang.nama_barang+`</td>
                                    <td>`+val.sku.sku+` - `+val.sku.varian+`</td>
                                    <td>`+val.stok_baru+`</td>
                                    <td>`+val.stok_bekas+`</td>
                                </tr>`
                            });
                            $('#tbody').html(tbody)
                            $('#modal-barang').modal('hide');
                        } else {
                            errorMsg(result.errors);
                            
                            $("#loading").replaceWith(`
                                <button type="button" id="sv-barang" class="btn btn-primary">Simpan</button>
                            `);
                        }
                    },
                });
            }
        });
        
    });
</script>
@endpush