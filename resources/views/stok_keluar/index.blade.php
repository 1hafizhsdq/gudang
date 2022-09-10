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
@includeIf('stok_keluar.modal')
@endsection

@push('script')
<script>
    $(document).ready(function(){
        $('#kop1').change(function(){
            $('#kop2').prop('checked',false);
        })
        $('#kop2').change(function(){
            $('#kop1').prop('checked',false);
        })
    }).on('click','.surat-jalan',function(){
        var href = $(this).attr('href');
        
        if(href == "#"){
            $('#id').val($(this).data('id'));
            $('#modal-suratjalan').modal('show');
        }
    }).on('click','#sv-kop',function(){
        $('#modal-suratjalan').modal('hide');
    });
    
    $('#datatable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("list-stok-keluar") }}',
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

    function suratJalan(id){
        // var href = $(this).attr('href');
        // console.log(href)
        // if(href == "#"){
        //     $('#modal-suratjalan').modal('show');
        // }
    }
</script>
@endpush