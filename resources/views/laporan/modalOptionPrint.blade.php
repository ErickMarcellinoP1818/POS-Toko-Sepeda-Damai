<div class="modal-header bg-primary text-white">
  <h5 class="modal-title">Opsi Print</h5>
</div>

@php
$formAction = '#';
    if (Route::is('pembelian.option')) {
        $formAction = route('pembelian.print');
    } elseif (Route::is('penjualan.option')) {
        $formAction = route('penjualan.print');
    } else{
        $formAction = route('labarugi.print');
    }
@endphp

<div class="modal-body">
     <form method="GET" action="{{ $formAction }}">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0 text-primary text-center justify-content-center"><i class="bi bi-calendar"></i> Rentang Tanggal</h6>
            </div>
            <div class="card-body row g-3 text-center justify-content-center">
                <div class="col-md-3 ms-2 text-center">
                    <label class="row align-item-center d-flex flex-column text-center" for="filterDate1" class="form-label mb-0 me-2">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="filterDate1" name="filterDate1"
                        value="{{ request('filterDate1') ?? now()->format('Y-m-d') }}"
                        max="{{ now()->format('Y-m-d') }}">
                </div>
                <div class="col-md-3 ms-2 text-center">
                    <label class="row align-item-center d-flex flex-column text-center" for="filterDate1" class="form-label mb-0 me-2">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="filterDateDone1" name="filterDateDone1"
                        value="{{ request('filterDateDone1') ?? now()->format('Y-m-d') }}" max="{{ now()->format('Y-m-d') }}">
                </div>
            </div>
        </div>
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0 text-primary text-center justify-content-center"><i class="fas fa-wrench"></i> Opsi Lanjutan </h6>
            </div>
            <div class="card-body row g-3 text-center justify-content-center">
                <input type="checkbox" name="detail" id="detail" value="1"> Detail
            </div>
        </div>
        <div class="modal-footer">
        <button type= "submit" class="btn btn-success">
            <i class="bi bi-printer"></i> Cetak
        </button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i class="fas fa-times me-2"></i> Close
        </button>
        </div>
    </form>
</div>

