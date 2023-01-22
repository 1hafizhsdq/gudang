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
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" class="form-control" name="status" id="status" value="2">
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
                                    <label for="asal" class="col-sm-3 col-form-label">Asal Kirim</label>
                                    <div class="col-sm-9">
                                        <select class="form-select select2" aria-label="Default select example" name="asal_tujuan" id="asal_tujuan">
                                            <option selected>-- Pilih Asal Kirim --</option>
                                            <option value="1">Project / Gudang Cabang</option>
                                            <option value="3">Client</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3" id="div-client">
                                    <label for="client" class="col-sm-3 col-form-label">Client</label>
                                    <div class="col-sm-9">
                                        <select class="form-select select2" aria-label="Default select example" name="client" id="client" disabled>
                                            <option selected>-- Pilih Client --</option>
                                            @foreach ($client as $cl)
                                                <option value="{{ $cl->id }}">{{ $cl->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3" id="div-project">
                                    <label for="project" class="col-sm-3 col-form-label">Project / Gudang Cabang</label>
                                    <div class="col-sm-9">
                                        <select class="form-select select2" aria-label="Default select example" name="project" id="project" disabled>
                                        </select>
                                        <input type="hidden" class="form-control" name="nama_project" id="nama_project">
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
                                    <label for="driver" class="col-sm-3 col-form-label">Driver</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="driver" id="driver">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nopol" class="col-sm-3 col-form-label">Nopol</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nopol" id="nopol">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="penerima" class="col-sm-3 col-form-label">Penerima</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="penerima" id="penerima">
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
                                {{-- <a id="add-barang" class="btn btn-primary mb-2">Tambah Barang</a> --}}
                                <table class="table">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>Barang</th>
                                            <th>SKU</th>
                                            <th>Lokasi</th>
                                            <th>Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-6">
                                        <a id="add-barang" class="btn w-100 btn-block btn-primary mb-2">Tambah Barang</a>
                                    </div>
                                    <div class="col-6">
                                        <a id="selesai" class="btn w-100 btn-block btn-primary mb-2">Selesai</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@includeIf('transaksi.stok_masuk.modal')
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
                $('#transaksi_id').val($('#id').val());
                $('#status_tipe').val($('#status').val());
                $('#modal-barang').modal('show');
            }
            $('#lokasi_id').val('').trigger('change');
            $('#merk').val('').trigger('change');
            $('#type').html('');
            $('#nama_barang').val('');
            $('#barang_id').val('');
            $('#sku_id').html('');
            $('#stok_gudang').val('');
            $('#stok').val('');
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
    }).on('change','#sku_id',function(){
        var sku = $(this).val();
        var lokasi = $('#lokasi_id').val();

        if(lokasi == null){
            errorMsg("Lokasi Barang Akan Disimpan tidak boleh kosong!");
            return false;
        }
        
        $.ajax({
            url: '/get-stok-now-by-lokasi/' + sku + '/' + lokasi,
            method: 'GET',
            success: function(result) {
                $('#stok_gudang').val(result)
            },
        });
    }).on('click','#sv-barang',function(){
        var tipe = $('#status').val(),
            stok_gudang = $('#stok_gudang').val(),
            stok = $('#stok').val();

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
                    if(parseInt(stok) > parseInt(stok_gudang)){
                        errorMsg("stok barang bekas di gudang lebih kecil, silahkan turunkan jumlah anda!");
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
                                    <td>`+val.lokasi.lokasi+`</td>
                                    <td>`+val.qty+`</td>
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
    }).on('change','#asal_tujuan',function(){
        var asal = $(this).val();

        if(asal == 1){
            $('#project').removeAttr('disabled');
            $('#client').attr('disabled','disabled');
            
            $.ajax({
                url: '/get-project/',
                method: 'GET',
                success: function(result) {
                    var option = '<option>-- Pilih Project --</option>'
                    $.each(result, function(key, val) {
                        option += '<option value="'+val.id+'" data-nama="'+val.project+'">'+val.project+'</option>'
                    });
                    $('#project').html(option);
                },
            });
        }else{
            $('#project').attr('disabled','disabled');
            $('#client').removeAttr('disabled');
        }
    }).on('change','#project',function(){
        var project = $(this).find(':selected').data('nama');
        $('#nama_project').val(project);
    }).on('change','#merk',function(){
        var idmerk = $(this).val();
        
        $.ajax({
            url: '/get-type/'+idmerk,
            method: 'GET',
            success: function(result) {
                var option = '<option>-- Pilih Type --</option>'
                $.each(result, function(key, val) {
                    option += '<option value="'+val.id+'">'+val.type+'</option>'
                });
                $('#type').html(option);
            },
        });
    }).on('change','#type',function(){
        var idmerk = $('#merk').val();
        var idtype = $(this).val();
        $('#sku_id').html();
        
        $.ajax({
            url: '/get-barang/'+idmerk+'/'+idtype,
            method: 'GET',
            success: function(result) {
                $('#barang_id').val(result.id);
                $('#nama_barang').val(result.nama_barang);

                var option = '<option>-- Pilih SKU --</option>'
                $.each(result.sku, function(key, val) {
                    option += '<option value="'+val.id+'">'+val.sku+' - '+val.varian+'</option>'
                });
                $('#sku_id').html(option);
            },
        });
    }).on('click','#selesai',function(){
        if($('#id').val() == ''){
            errorMsg('Tipe dan keterangan belum tersimpan/tidak ada, simpan terlibh dahulu tipe & keterangan anda!');
        }
        location.href = '/detail-stok-keluar/'+$('#id').val();
    });

</script>
@endpush