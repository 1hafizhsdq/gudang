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
                    <button type="button" class="btn btn-primary mt-4 mb-4" id="add"><i class="bi bi-plus"></i> Tambah Lokasi</button>
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th scope="col" width="10%">#</th>
                                <th scope="col">Lokasi</th>
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
    @includeIf('admin.lokasi.form')
</section>
@endsection

@push('script')
<script>
    $('#datatable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("list-lokasi") }}',
        },
        columns: [
            { data: 'DT_RowIndex', class: 'text-center'},
            { data: 'lokasi'},
            { data: 'aksi', class: 'text-center'}
        ]
    });

    $(document).ready(function() {
        $('#add').click(function(){
            $('#form-lokasi').find('input').val('');
            $('#modal-lokasi').modal('show');
            $('.modal-title').html('Form Tambah Lokasi');
            $('#sv').html('Simpan');
        });
    }).on('click','#sv', function(){
        var id = $('#id').val(),
            url = '',
            method = '';

        var form = $('#form-lokasi'),
            data = form.serializeArray();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('lokasi.store')}}",
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
                    $('#modal-lokasi').modal('hide');
                    $('#form-lokasi').find('input').val('');
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
        var form = $('#form-lokasi');
        $.ajax({
            url : 'lokasi/' + id + '/edit',
            type: 'GET',
            success:function(result){
                form.find('#id').val(result.id)
                form.find('#lokasi').val(result.lokasi)
                $('#modal-lokasi').modal('show');
                $('.modal-title').html('Form Edit Lokasi');
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
                    url: "lokasi/" + id,
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