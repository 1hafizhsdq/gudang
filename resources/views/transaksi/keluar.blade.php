<div class="row mb-3">
    <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
    <div class="col-sm-9">
        <input type="date" class="form-control" name="tanggal" id="tanggal">
    </div>
</div>
<div class="row mb-3 st-keluar">
    <label for="project" class="col-sm-3 col-form-label">Project</label>
    <div class="col-sm-9">
        <select class="form-select select2-modal" aria-label="Default select example" name="project_id" id="project_id">
            @foreach ($project as $pr)
                <option value="{{ $pr->id }}">{{ $pr->nama_project }}</option>
            @endforeach
        </select>
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
        <select class="form-select select2" aria-label="Default select example" name="user_id" id="user_id">
            @foreach ($pic as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row mb-3 st-keluar">
    <label for="driver" class="col-sm-3 col-form-label">Driver</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" name="driver" id="driver">
    </div>
</div>
<div class="row mb-3 st-keluar">
    <label for="nopol" class="col-sm-3 col-form-label">Nopol</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" name="nopol" id="nopol">
    </div>
</div>
<div class="row mb-3 st-keluar">
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