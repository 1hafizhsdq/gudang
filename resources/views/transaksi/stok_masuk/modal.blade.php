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
                        <label class="col-sm-2 col-form-label">Lokasi Barang Akan Disimpan</label>
                        <div class="col-sm-10">
                            <select class="form-select select2-modal" aria-label="Default select example" name="lokasi_id" id="lokasi_id">
                                <option selected="">-- Pilih Lokasi --</option>
                                @foreach ($lokasi as $lk)
                                    <option value="{{ $lk->id }}">{{ $lk->lokasi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Merk</label>
                        <div class="col-sm-10">
                            <select class="form-select select2-modal" aria-label="Default select example" name="merk" id="merk">
                                <option selected="">-- Pilih Merk --</option>
                                @foreach ($merk as $mr)
                                    <option value="{{ $mr->id }}">{{ $mr->merk }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-10">
                            <select class="form-select select2-modal" aria-label="Default select example" name="type" id="type">
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_barang" id="nama_barang" readonly>
                            <input type="hidden" class="form-control" name="barang_id" id="barang_id" readonly>
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
                                <label class="col-sm-6 col-form-label">Stok Gudang</label>
                                <input type="text" class="form-control" name="stok_gudang" id="stok_gudang" readonly>
                            </div>
                            <div class="col-6">
                                <label class="col-sm-6 col-form-label">Jumlah</label>
                                <input type="text" class="form-control" name="stok" id="stok" onkeypress="return isNumber(event)" value="0">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="transaksi_id" id="transaksi_id">
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
