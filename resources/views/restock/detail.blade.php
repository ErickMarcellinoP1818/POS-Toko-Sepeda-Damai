<div class="modal-header bg-primary text-white">
  <h5 class="modal-title">Detail Pembelian</h5>
</div>

<div class="modal-body">
    <!-- Informasi Nota -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <h6 class="mb-0 text-primary"><i class="fas fa-info-circle me-2"></i>Informasi Pembelian</h6>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <p><strong>No. Faktur:</strong> {{ $pembelian->no_trans }}</p>
                    <p><strong>Tanggal Pembelian:</strong> {{ \Carbon\Carbon::parse($pembelian->tanggal)->format('d-m-Y') ?? '-'}}</p>
                    @if($pembelian->tanggal_tempo)
                    <p><strong>Jatuh Tempo:</strong> {{ \Carbon\Carbon::parse($pembelian->tanggal_tempo)->format('d-m-Y') ?? '-'}}</p>
                    @endif
                    <p><strong>Tanggal Pembayaran:</strong> {{ $pembelian->tbayar ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Supplier:</strong> {{ $pembelian->supplier->nama }}</p>
                    <p><strong>Total:</strong> Rp{{ number_format($pembelian->total, 0, ',', '.') }}</p>
                    <p><strong>Status:</strong>
                        @if($pembelian->tbayar)
                        Lunas
                        @else
                        Belum Lunas
                        @endif
                    </p>
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
                        <th>Kuantitas</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($pembelian->DetailPembelian as $item)
                        <tr class="text-center">
                            <td class="text-center">{{ $item->produk->nama ?? '-' }} {{ $item->varian->nama_varian ?? '' }}</td>
                            <td class="text-center">{{ $item->jumlah }}</td>
                            <td class="text-end">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="text-end">Rp{{ number_format($item->total, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr class="text-center">
                        <th class="text-center table-primary" colspan="3">Total</th>
                        <th class="text-end table-success">Rp{{ number_format($pembelian->total, 0, ',', '.') }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal-footer">
    <!-- <a href="{{ route('pembelian.print', $pembelian->id) }}" class="btn btn-success" target="_blank">
        Cetak PDF
        <i class="bi bi-printer ms-1"></i>
    </a> -->
    @if(Route::is('pembelian.tempod'))
     <a href="{{ route('pembelian.bayar', $pembelian->id) }}" 
       onclick="event.preventDefault(); if(confirm('Yakin sudah dibayar?')) { window.location=this.href }" 
       class="btn btn-success" target="_blank">
        <i class="bi bi-check-lg"></i> Sudah Dibayar
    </a>
    @endif
    <button type="button" class="btn btn-danger" data-dismiss="modal">
        <i class="fas fa-times me-2"></i> Close
    </button>
</div>