<div class="modal-header bg-primary text-white">
  <h5 class="modal-title">Detail Tanggal</h5>
</div>

<div class="modal-body">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0 text-primary text-center justify-content-center"><i class="bi bi-calendar"></i> Opsi Pembayaran Tempo</h6>
            </div>
            <div class="card-body row g-3 text-center justify-content-center">
                <div class="col-md-3 text-center">
                    <label class="row align-item-center d-flex flex-column text-center" for="tempo" class="form-label mb-0 me-2">Tanggal Jatuh Tempo</label>
                    <input type="date" class="form-control" id="tempo" name="tempo"
                        value="{{ request('tempo') ?? now()->format('Y-m-d') }}"
                        min="{{ now()->format('Y-m-d') }}">
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type= "submit" class="btn btn-success">
            <i class="bi bi-check-lg"></i> Konfirmasi
        </button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i class="fas fa-times me-2"></i> Batal
        </button>
        </div>
</div>

