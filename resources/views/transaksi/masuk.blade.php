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
        <select class="form-select select2-modal" aria-label="Default select example" name="user_id" id="user_id">
            @foreach ($pic as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
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