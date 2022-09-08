<div class="modal fade" id="modal-suratjalan" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 mt-2" id="form-suratjalan">
                    @csrf
                    <br>
                    <input type="hidden" name="id" id="id">
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-3 pt-0">Kop Surat Jalan</legend>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kop" id="kop1" value="1">
                                <label class="form-check-label" for="kop1">
                                    <div class="kop">
                                        <h3>MIA TEKNIK</h3>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kop" id="kop2" value="2">
                                <label class="form-check-label" for="kop2">
                                    <div class="kop">
                                        <h3>Haisa Tata Karya</h3>
                                </label>
                            </div>
                        </div>
                    </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" id="sv-kop" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
