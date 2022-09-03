<div class="modal fade" id="modal-barang" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" id="form-sku">
                    @csrf
                    <input type="hidden" name="idsku" id="idsku">
                    <input type="hidden" name="idbarang" id="idbarang">
                    <div class="col-md-12">
                        <div class="row mb-3">
                            <label for="sku" class="col-sm-2 col-form-label">SKU</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="sku" id="sku">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row mb-3">
                            <label for="varian" class="col-sm-2 col-form-label">Varian</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="varian" id="varian">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" id="sv-sku" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
