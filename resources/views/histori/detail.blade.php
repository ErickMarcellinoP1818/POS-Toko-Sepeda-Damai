<div class="modal-header bg-primary text-white">
  <h5 class="modal-title">Detail Laba Rugi</h5>
</div>

<div class="modal-body">
    <!-- Informasi Nota -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <h6 class="mb-0 text-primary"><i class="fas fa-info-circle me-2"></i>Informasi Detail</h6>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <p><strong>No. Faktur:</strong> {{ $nota->inv_num }}</p>
                    <p><strong>Tanggal:</strong> {{ $nota->tanggal }}</p>
                </div>
                <div class="col-md-6">
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
                    <tr>
                        <th>Nama Produk</th>
                        <th>Kuantitas</th>
                        <th>Jumlah</th>
                        <th>Harga Beli</th>
                        <th>Diskon</th>
                        <th>Keuntungan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $totalhpp=0;
                    $neto=0;
                    $laba=0;
                    $tdiskon =0;
                    @endphp
                    @foreach ($nota->detilnota as $item)
                        <tr>
                            <td>{{ $item->produk->nama ?? '-' }} {{  $item->varian->nama_varian ?? '' }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($item->hpp * $item->jumlah, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($item->diskon, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format(($item->harga - $item->hpp) * $item->jumlah - $item->diskon, 0, ',', '.') }}</td>
                            @php
                            $totalhpp += $item->hpp * $item->jumlah;
                            $tdiskon += $item->diskon;
                            @endphp
                        </tr>
                    @endforeach
                    @php
                    $neto = $nota->total - $totalhpp;
                    @endphp
                    <tr>
                        <th colspan="2" class=" text-center table-primary">Total</th>
                        <th class="text-end table-success">Rp{{ number_format($nota->total + $tdiskon, 0, ',', '.') }}</th>
                        <th class="text-end table-success">Rp{{ number_format($totalhpp, 0, ',', '.') }}</th>
                        <th class="text-end table-success">Rp{{ number_format($tdiskon, 0, ',', '.') }}</th>
                        <th class="text-end table-success">Rp{{ number_format($neto, 0, ',', '.') }} </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal-footer">
    <!-- <a href="{{ route('labarugi.print', $nota->id) }}" class="btn btn-success" target="_blank">
        Cetak PDF
        <i class="bi bi-printer ms-1"></i>
    </a> -->
    <button type="button" class="btn btn-danger" data-dismiss="modal">
        <i class="fas fa-times me-2"></i> Close
    </button>
</div>