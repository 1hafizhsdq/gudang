<div class="modal fade" id="modal-type" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" id="form-type">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="col-md-12">
                        <div class="form-floating mb-2">
                            <select class="form-select select2" aria-label="Default select example" name="merk_id" id="merk_id">
                                <option selected="">-- Pilih Merk --</option>
                                @foreach ($merk as $m)
                                    <option value="{{ $m->id }}">{{ $m->merk }}</option>
                                @endforeach
                            </select>
                            <label for="merk_id">Merk</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="type" name="type" placeholder="Type">
                            <label for="type">Type</label>
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
