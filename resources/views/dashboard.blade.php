<!DOCTYPE html>
<html lang="en">
<head>
    <title>Program Toko - Dashboard</title>
    @include('ADMTemplate.head')
</head>

<body>
    <div id="wrapper">
        @include('ADMTemplate.left-sidebar')
        
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('ADMTemplate.navbar')
                
                <div class="container-fluid px-4">
                    <h1 class="h3 mb-2 mt-4">Dashboard</h1>
                    
                    <div class="card-header py-3">
                        @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                    </div>
                    

                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Penjualan Hari Ini</div>
                                            <h4 id="ss" class="mb-0">Rp {{ number_format($penjualantd, 0, ',', '.')}}</h4>
                                        </div>
                                        <div class="card-icon">
                                            <span class="{{ $ghl >= 0 ? 'text-success' : 'text-danger' }}">
                                                {{ $ghl >= 0 ? '↑' : '↓' }}{{ abs(round($ghl, 1)) }}% dari kemarin
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Penjualan Bulan Ini</div>
                                            <h4 id="ss" class="mb-0">Rp {{ number_format($penjualan, 0, ',', '.')}}</h4>
                                        </div>
                                        <div class="card-icon">
                                            <span class="{{ $gp >= 0 ? 'text-success' : 'text-danger' }}">
                                                {{ $gp >= 0 ? '↑' : '↓' }}{{ abs(round($gp, 1)) }}% dari bulan lalu
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Keuntungan Bulan Ini</div>
                                            <h4 id="ss" class="mb-0">Rp {{ number_format($keuntungan, 0, ',', '.')}}</h4>
                                        </div>
                                        <div class="card-icon">
                                           <span class="{{ $gu >= 0 ? 'text-success' : 'text-danger' }}">
                                                {{ $gu >= 0 ? '↑' : '↓' }}{{ abs(round($gu, 1)) }}% dari bulan lalu
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pembelian Bulan Ini</div>
                                            <h4 id="ss" class="mb-0">Rp {{ number_format($pembelian, 0, ',', '.')}}</h4>
                                        </div>
                                        <div class="card-icon">
                                             <span class="{{ $gb >= 0 ? 'text-success' : 'text-danger' }}">
                                                {{ $gb >= 0 ? '↑' : '↓' }}{{ abs(round($gb, 1)) }}% dari bulan lalu
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm mt-4">
                <div class="card-body">
                    <h6 class="card-title">Grafik Penjualan 
                    <span class="{{ $growth >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ $growth >= 0 ? '↑' : '↓' }}{{ abs(round($growth, 1)) }}% dari tahun lalu
                    </span>
                    </h6>
                    <canvas id="salesChart" height="120"></canvas>
                </div>
                </div>
                <div class="card shadow-sm mt-4 mb-4">
                    <div class="card-header">
                        <h1>Stok Menipis</h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="tableStok" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-info text-white text-center">
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Varian</th>
                                        <th>Sisa Stok</th>
                                    </tr>
                                </thead>  
                                <tbody>
                                    @forelse($varian as $index => $item)
                                    <tr class="text-center" data-index="{{ $loop->index }}">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->produk->nama }}</td>
                                        <td>{{ $item->nama_varian }}</td>
                                        <td>{{ $item->totalStok() }}</td>
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td colspan="4">Belum ada barang yang kosong</td>
                                    </tr>
                                    @endforelse
                                </tbody>  
                            </table>
                        </div>
                    </div>
                </div>
                @if($laris->isNotEmpty())
                <div class="card shadow-sm mt-4 mb-4">
                    <div class="card-header">
                        <h1>Stok Terlaris</h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="tableStok" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-info text-white text-center">
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Nama Varian</th>
                                        <th>Banyak Terjual</th>
                                        <th>Stok Tersisa</th>
                                    </tr>
                                </thead>  
                                <tbody>
                                    @forelse($laris as $index => $item)
                                    <tr class="text-center" data-index="{{ $loop->index }}">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->varian->produk->nama }}</td>
                                        <td>{{ $item->varian->nama_varian }}</td>
                                        <td>{{ $item->laku}}</td>
                                        <td>{{ $stok[$item->id_varian] ?? 0 }}</td>
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td colspan="6">Belum ada jadwal pembayaran</td>
                                    </tr>
                                    @endforelse
                                </tbody>  
                            </table>
                        </div>
                    </div>
                </div>
                @endif
                @if($tempo->isNotEmpty())
                <div class="card shadow-sm mt-4 mb-4">
                    <div class="card-header">
                        <h1>Jadwal Pembayaran</h1>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="tableStok" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-info text-white text-center">
                                        <th>No</th>
                                        <th>No Pembelian</th>
                                        <th>Tanggal Pembelian</th>
                                        <th>Tanggal Tempo</th>
                                        <th>Nama Supplier</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>  
                                <tbody>
                                    @forelse($tempo as $index => $item)
                                    <tr class="text-center" data-index="{{ $loop->index }}">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->no_trans }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_tempo)->format('d-m-Y') ?? '-'}}</td>
                                        <td>{{ $item->supplier->nama }}</td>
                                        <td>Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td colspan="6">Belum ada jadwal pembayaran</td>
                                    </tr>
                                    @endforelse
                                </tbody>  
                            </table>
                        </div>
                    </div>
                </div>
                @endif
                
            </div>
            
            @include('ADMTemplate.footer')
        </div>
    </div>
    @include('ADMTemplate.logoutModal')

    @include('ADMTemplate.script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        new Chart(document.getElementById('salesChart'), {
          type: 'line',
          data: {
            labels: @json($salesOverview['labels']),
            datasets: [{
              data: @json($salesOverview['data']),
              borderColor: '#4e73df',
              backgroundColor: 'rgba(78, 115, 223, 0.1)',
              tension: 0.3,
              fill: true
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: { display: false },
              tooltip: {
                callbacks: {
                  label: function(context) {
                    return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                  }
                }
              }
            },
            scales: {
              y: {
                beginAtZero: true,
                ticks: {
                  callback: function(value) {
                    return 'Rp ' + value.toLocaleString('id-ID');
                  }
                }
              }
            }
          }
        });
      });
    </script>
</body>
</html>