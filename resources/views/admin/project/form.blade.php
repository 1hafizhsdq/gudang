<div class="modal fade" id="modal-project" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" id="form-project">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nama_project" name="nama_project" placeholder="Nama Project">
                            <label for="nama_project">Nama Project</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" name="alamat_project" id="alamat_project" rows="3" placeholder="Alamat Project"></textarea>
                            <label for="alamat_project">Alamat Project</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Nama Perusahaan">
                            <label for="nama_perusahaan">Nama Perusahaan</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" name="alamat_perusahaan" id="alamat_perusahaan" rows="3" placeholder="Alamat Perusahaan"></textarea>
                            <label for="alamat_perusahaan">Alamat Perusahaan</label>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" id="sv" class="btn btn-primary">Simpan</button>
                <button class="btn btn-primary" type="button" disabled="" style="display: none;">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
