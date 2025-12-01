<!DOCTYPE html>
<html lang="en">
<head>
    <title>Program Toko - Laba Rugi</title>
    @include('ADMTemplate.head')

</head>
<body id="page-top">
    <div id="wrapper">
        @include('ADMTemplate.left-sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('ADMTemplate.navbar')

                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Laba Rugi</h1>
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <button type="button" class="btn btn-primary mb-3" onclick="showoption()">
                                <i class="bi bi-printer"></i> Print Detail Laba Rugi
                            </button>
                        </div>
                        <div class="card-body">
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($nota as $item)
                            @foreach ($item->detilnota as $detail)
                                @php
                                    $total += ($detail->harga - $detail->hpp) * $detail->jumlah - $detail->diskon; 
                                @endphp
                            @endforeach
                            @endforeach
                            <div>
                                <h2>Total Keuntungan: Rp. {{ number_format($total, 0, ',', '.') }}</h2>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="notaTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Nomor Invoice</th>
                                            <th>Pendapatan</th>
                                            <th>Keuntungan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @forelse ($nota as $index => $item)
                                        @php
                                        $neto=0;
                                        @endphp
                                            <tr class="nota-row" data-index="{{ $index }}">
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-M-Y') }}</td>
                                                <td class="text-center">{{ $item->inv_num ?? 'Nomor Invoice Tidak Ditemukan' }}</td>
                                                <td class="text-center">Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                                                @foreach ($item->detilnota as $items => $detail)
                                                @php
                                                    $neto += ($detail->harga - $detail->hpp) * $detail->jumlah - $detail->diskon;
                                                @endphp
                                                @endforeach
                                                <td class="text-center">Rp. {{ number_format($neto, 0, ',', '.') }}</td>
                                                <td class="text-center">
                                                   <button class="btn btn-info btn-sm" onclick="showNotaDetail({{ $item->id }})">Detail</button>
                                                </td>
                                            </tr>
                                            
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-danger">Belum Memiliki Transaksi</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center mt-3">
                                    <button class="btn btn-sm btn-primary me-2" id="prevPage">Sebelumnya</button>
                                    <span id="pageInfo" class="align-self-center mx-2"></span>
                                    <button class="btn btn-sm btn-primary ms-2" id="nextPage">Berikutnya</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Container -->
            <div class="modal fade" id="notaDetailModal" tabindex="-1" aria-labelledby="notaDetailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content"id="modal-nota-content">
                    <div class="modal-body text-center">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-2">Memuat data nota...</p>
                    </div>
                </div>
            </div>
            </div>
            <!-- modal option -->
            <div class="modal fade" id="option" tabindex="-1" aria-labelledby="optionLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div id="option-content" class="modal-content">
                    <div class="modal-body text-center">
                        <div class="spinner-border text-primary" role="status"></div>
                        <p class="mt-2">Memuat opsi...</p>
                    </div>
                </div>
            </div>
            </div>
            @include('ADMTemplate.footer')
        </div>
    </div>

    

    @include('ADMTemplate.logoutModal')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    
    

    <script>
        function showNotaDetail(id) {
            fetch(`/labarugi/${id}/detail`)
                .then(response => {
                    if (!response.ok) throw new Error("Gagal memuat data.");
                    return response.text();
                })
                .then(html => {
                    document.getElementById('modal-nota-content').innerHTML = html;
                    const modal = new bootstrap.Modal(document.getElementById('notaDetailModal'));
                    modal.show();
                })
                .catch(err => {
                    document.getElementById('modal-nota-content').innerHTML = `<div class="p-3"><p class="text-danger">${err.message}</p></div>`;
                });
        }
    </script>

    <script>
        function closeNotaModal() {
            const modalEl = document.getElementById('notaDetailModal');
            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.hide();
        }
    </script>

    <script>
        function showoption()
        {
            fetch("{{ route('labarugi.option') }}")
            .then(response => response.text())
            .then(html => {
                document.getElementById('option-content').innerHTML = html;
                const modal = new bootstrap.Modal(document.getElementById('option'));
                modal.show();
            })
        .catch(error => {
                console.error('Error fetching option:', error);
                document.getElementById('option-content').innerHTML = '<div class="alert alert-danger">Gagal memuat opsi.</div>';
            });
        }
    </script>


    @include('ADMTemplate.script')
</body>
</html>
