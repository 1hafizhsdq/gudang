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
                    <a href="{{ route('barang.create') }}" type="button" class="btn btn-primary mt-4 mb-4" id="add"><i class="bi bi-plus"></i> Tambah Barang</a>
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
            { data: 'aksi', class: 'text-center'}
        ]
    });

    // $(document).ready(function() {
    //     $('#add').click(function(){
    //         $('#form-satuan').find('input').val('');
    //         $('#modal-satuan').modal('show');
    //         $('.modal-title').html('Form Tambah Satuan');
    //         $('#sv').html('Simpan');
    //     });
    // }).on('click','#sv', function(){
    //     var id = $('#id').val(),
    //         url = '',
    //         method = '';

    //     var form = $('#form-satuan'),
    //         data = form.serializeArray();

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         url: "{{route('satuan.store')}}",
    //         method: "POST",
    //         data: data,
    //         beforeSend: function() {
    //             $("#sv").replaceWith(`
    //                 <button class="btn btn-primary" type="button" id="loading" disabled="">
    //                     <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    //                     Loading...
    //                 </button>
    //             `)
    //         },
    //         success: function(result) {
    //             if (result.success) {
    //                 successMsg(result.success)
    //                 $('#modal-satuan').modal('hide');
    //                 $('#form-satuan').find('input').val('');
    //                 $('#datatable').DataTable().ajax.reload();
    //                 $("#loading").replaceWith(`
    //                     <button type="submit" id="sv" class="btn btn-primary">Simpan</button>
    //                 `);
    //             } else {
    //                 errorMsg(result.errors)
    //                 $("#loading").replaceWith(`
    //                     <button type="submit" id="sv" class="btn btn-primary">Simpan</button>
    //                 `);
    //             }

    //         },
    //     });
    // });

    // function editData(id) {
    //     var form = $('#form-satuan');
    //     $.ajax({
    //         url : 'satuan/' + id + '/edit',
    //         type: 'GET',
    //         success:function(result){
    //             form.find('#id').val(result.id)
    //             form.find('#satuan').val(result.satuan)
    //             $('#modal-satuan').modal('show');
    //             $('.modal-title').html('Form Edit Satuan');
    //             $('#sv').html('Update');
    //         }
    //     });
    // }

    // function deleteData(id) {
    //     Swal.fire({
    //         icon: 'warning',
    //         title: 'Apakah anda yakin akan menghapus data ini?',
    //         showCancelButton: true,
    //         confirmButtonText: 'Hapus',
    //         confirmButtonColor: '#d3455b',
    //         cancelButtonText: 'Batal',
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajaxSetup({
    //                 headers: {
    //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                 }
    //             });
    //             $.ajax({
    //                 url: "satuan/" + id,
    //                 method: 'DELETE',
    //                 success: function(result) {
    //                     if (result.success) {
    //                         successMsg(result.success)
    //                         $('#datatable').DataTable().ajax.reload();
    //                     } else {
    //                         errorMsg(result.errors)
    //                     }
    //                 }
    //             });
    //         }
    //     });
    // }
</script>
@endpush