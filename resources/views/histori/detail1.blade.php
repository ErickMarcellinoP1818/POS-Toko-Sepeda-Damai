<div class="modal-header bg-primary text-white">
  <h5 class="modal-title">Detail Nota</h5>
</div>

<div class="modal-body">
    <!-- Informasi Nota -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <h6 class="mb-0 text-primary"><i class="fas fa-info-circle me-2"></i>Informasi Nota</h6>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <p><strong>No. Invoice:</strong> {{ $nota->inv_num }}</p>
                    <p><strong>Tanggal:</strong> {{ $nota->tanggal }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($nota->status) }}</p>
                    <p><strong>Metode:</strong> {{ strtoupper($nota->metode) }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Total:</strong> Rp{{ number_format($nota->total, 0, ',', '.') }}</p>
                    <p><strong>Bayar:</strong> Rp{{ number_format($nota->bayar, 0, ',', '.') }}</p>
                    <p><strong>Kembali:</strong> Rp{{ number_format($nota->kembali, 0, ',', '.') }}</p>
                    <p><strong>Kasir:</strong> {{ $nota->kasir->name ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Detil Barang -->
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h6 class="mb-0 text-primary"><i class="fas fa-shopping-cart me-2"></i> Detil Barang</h6>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr class="text-center">
                        <th>Nama Produk</th>
                        <th>Harga Satuan</th>
                        <th>Kuantitas</th>
                        <th>Subtotal</th>
                        <th>Diskon</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $tdisk=0;
                    $subtotal=0;
                    @endphp
                    @foreach ($nota->detilnota as $item)
                    @php
                    $tdisk += $item->diskon;
                    $subtotal += $item->subtotal;
                    @endphp
                        <tr class="text-center">
                            <td>{{ $item->produk->nama ?? '-' }} {{ $item->varian->nama_varian ?? ''}}</td>
                            <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($item->diskon, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($item->subtotal - $item->diskon, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr class="text-center">
                        <th class="text-center table-primary" colspan="3">Total</th>
                        <th class="text-end table-success">Rp{{ number_format($subtotal, 0, ',', '.') }}</th>
                        <th class="text-end table-success">Rp{{ number_format($tdisk, 0, ',', '.') }}</th>
                        <th class="text-end table-success">Rp{{ number_format($nota->total, 0, ',', '.') }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal-footer">
    <a href="{{ route('nota.print', $nota->id) }}" class="btn btn-success" target="_blank">
        Cetak PDF
        <i class="bi bi-printer ms-1"></i>
    </a>
    <button type="button" class="btn btn-danger" data-dismiss="modal">
        <i class="fas fa-times me-2"></i> Close
    </button>
</div>