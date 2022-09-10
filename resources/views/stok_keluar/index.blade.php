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
                    <form id="form-filter">
                        <div class="row mt-2">
                            <label for="filter">Filter</label>
                            <div class="col-lg-3 col-sm-12">
                                <select class="form-select select2multiple" name="bulan" id="bulan">
                                    <option>-- Pilih Bulan --</option>
                                    @foreach ($bulan as $bl_key => $bl_val)
                                        <option value="{{ $bl_key }}" {{ ($bl_key == date('n')) ? 'selected' : '' }}>{{ $bl_val }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <select class="form-select select2multiple" name="tahun" id="tahun">
                                    @for ($i=2022;$i<=date('Y');$i++) <option value="{{ $i }}" {{ (date('Y')==$i) ? 'selected' : '' }}>{{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </form>
                    <a class="btn btn-primary mt-2 mb-2" id="btn-filter">Filter</a>
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
<script src="{{ asset('select2') }}/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $('.select2multiple').select2({
            multiple: true,
        });
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
    }).on('click','#btn-filter',function(){
        var bulan = $('#bulan').val(),
            tahun = $('#tahun').val();
        
        // var form = $('#form-filter'),
        // data = form.serializeArray();

        if((bulan == '')){
            errorMsg('Bulan dan tahun tidak boleh kosong!');
        }else{
            var data = {
                bulan:bulan,
                tahun:tahun,
            }
            filter(bulan,tahun);
        }
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
        ],
        destroy: true
    });

    function filter(bulan,tahun){
        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("list-stok-keluar-filter") }}',
                data: {
                    bulan:bulan,tahun:tahun
                }
            },
            columns: [
                { data: 'tanggal'},
                { data: 'no_surat_jalan'},
                { data: 'user.name'},
                { data: 'deskripsi'},
                { data: 'keterangan'},
                { data: 'aksi', class: 'text-center'},
            ],
            destroy: true
        });
    }
</script>
@endpush