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
                    <button type="button" class="btn btn-primary mt-4 mb-4" id="add"><i class="bi bi-plus"></i> Tambah Supplier</button>
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th scope="col" width="10%">#</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Tgl Terdaftar</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Telp</th>
                                <th scope="col">PIC Sales</th>
                                <th scope="col" width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
    </div>
    @includeIf('admin.supplier.form')
</section>
@endsection

@push('script')
<script>
    $('#datatable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("list-supplier") }}',
        },
        columns: [
            { data: 'DT_RowIndex', class: 'text-center'},
            { data: 'kode_supplier'},
            { data: 'tgl_terdaftar'},
            { data: 'nama'},
            { data: 'alamat'},
            { data: 'telp'},
            { data: 'pic_sales'},
            { data: 'aksi', class: 'text-center'}
        ]
    });

    $(document).ready(function() {
        $('#add').click(function(){
            $('#form-supplier').find('input').val('');
            $('#modal-supplier').modal('show');
            $('.modal-title').html('Form Tambah Supplier');
            $('#sv').html('Simpan');
        });
    }).on('click','#sv', function(){
        var id = $('#id').val(),
            url = '',
            method = '';

        var form = $('#form-supplier'),
            data = form.serializeArray();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('supplier.store')}}",
            method: "POST",
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
                    $('#modal-supplier').modal('hide');
                    $('#form-supplier').find('input').val('');
                    $('#datatable').DataTable().ajax.reload();
                    $("#loading").replaceWith(`
                        <button type="submit" id="sv" class="btn btn-primary">Simpan</button>
                    `);
                } else {
                    errorMsg(result.errors)
                    $("#loading").replaceWith(`
                        <button type="submit" id="sv" class="btn btn-primary">Simpan</button>
                    `);
                }

            },
        });
    });

    function editData(id) {
        var form = $('#form-supplier');
        $.ajax({
            url : 'supplier/' + id + '/edit',
            type: 'GET',
            success:function(result){
                form.find('#id').val(result.id)
                form.find('#nama').val(result.nama)
                form.find('#telp').val(result.telp)
                form.find('#alamat').val(result.alamat)
                form.find('#tgl_terdaftar').val(result.tgl_terdaftar)
                form.find('#pic_sales').val(result.pic_sales)
                $('#modal-supplier').modal('show');
                $('.modal-title').html('Form Edit Supplier');
                $('#sv').html('Update');
            }
        });
    }

    function deleteData(id) {
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
                    url: "supplier/" + id,
                    method: 'DELETE',
                    success: function(result) {
                        if (result.success) {
                            successMsg(result.success)
                            $('#datatable').DataTable().ajax.reload();
                        } else {
                            errorMsg(result.errors)
                        }
                    }
                });
            }
        });
    }
</script>
@endpush