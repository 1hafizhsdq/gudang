<div class="modal fade" id="modal-barang" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 mt-2" id="form-barang">
                    @csrf
                    <br>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Barang</label>
                        <div class="col-sm-10">
                            <select class="form-select select2-modal" aria-label="Default select example" name="barang_id" id="barang_id">
                                <option selected="">-- Pilih Barang --</option>
                                @foreach ($barang as $br)
                                    <option value="{{ $br->id }}">{{ $br->merk->merk }} - {{ $br->type->type }} - {{ $br->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">SKU Varian</label>
                        <div class="col-sm-10">
                            <select class="form-select select2-modal" aria-label="Default select example" name="sku_id" id="sku_id">
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-12 col-form-label">Stok</label>
                        <div class="row">
                            <div class="col-6">
                                <label class="col-sm-6 col-form-label">Stok</label>
                                <input type="text" class="form-control" name="stok_gudang" id="stok_gudang" readonly>
                            </div>
                            <div class="col-6">
                                <label class="col-sm-6 col-form-label">Jumlah</label>
                                <input type="text" class="form-control" name="stok" id="stok" onkeypress="return isNumber(event)" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Lokasi</label>
                        <div class="col-sm-10">
                            <select class="form-select select2-modal" aria-label="Default select example" name="lokasi_id" id="lokasi_id">
                                <option selected="">-- Pilih Lokasi --</option>
                                @foreach ($lokasi as $lk)
                                    <option value="{{ $lk->id }}">{{ $lk->lokasi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="history_id" id="history_id">
                    <input type="hidden" name="status_tipe" id="status_tipe">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" id="sv-barang" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
