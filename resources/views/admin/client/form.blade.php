<div class="modal fade" id="modal-client" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" id="form-client">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                            <label for="nama">Nama</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="telp" name="telp" placeholder="Telepon">
                            <label for="telp">Telepon</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Alamat"></textarea>
                            <label for="alamat">Alamat</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="tgl_terdaftar" name="tgl_terdaftar">
                            <label for="tgl_terdaftar">Tanggal Terdaftar</label>
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
