<!DOCTYPE html>
<html lang="en">

<head>
    <title>Program Toko - Pembelian</title>
    @include('ADMTemplate.head')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('ADMTemplate.left-sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <!-- Topbar -->
                @include('ADMTemplate.navbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Pembelian</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <!-- <a href="{{ route('restock.create') }}" class="btn btn-md btn-success mb-3"><i class="bi bi-bag-plus-fill"></i> TAMBAH DATA PEMBELIAN</a> -->
                           <button type="button" class="btn btn-primary mb-3" onclick="showoption()">
                                <i class="bi bi-printer"></i> Print Detail Pembelian
                            </button>
                             <a href="{{ route('rincianbeli') }}" class="btn btn-md btn-success mb-3">TAMBAH
                                PEMBELIAN
                                BARANG
                            </a>
                        </div>
                        <div class="card-body">
                            <div>
                                <H2>Total Pembelian: Rp. {{ number_format($total, 0, ',', '.') }}</H2>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>No Pembelian</th>
                                            <th>Nama Supplier</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @forelse ($restock as $index => $item)
                                        <tr class="nota-row text-center" data-index="{{ $loop->index }}">
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                            <td>{{ $item->no_trans ?? 'Nomor pembelian tidak ada' }}</td>
                                            <td>{{ $item->supplier->nama }}</td>
                                            <td>Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                                            <td>
                                                <button class="btn btn-info btn-sm" onclick="showDetail({{ $item->id }})">Detail Pembelian </button>

                                                <!-- <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('produks.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('produks.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form> -->
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-danger">Belum Memiliki Data Pembelian</td>
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
            <!-- End of Main Content -->
             <!-- Modal Container -->
            <div class="modal fade" id="DetailModal" tabindex="-1" aria-labelledby="DetailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content"id="modal-content">
                    <div class="modal-body text-center">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-2">Memuat data nota...</p>
                    </div>
                </div>
            </div>
            </div>
             <!-- Modal Container -->
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
            <!-- Footer -->
            @include('ADMTemplate.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    @include('ADMTemplate.logoutModal')

    @include('ADMTemplate.script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const rows = document.querySelectorAll('.nota-row');
            const rowsPerPage = 10;
            let currentPage = 1;

            function showPage(page) {
                const start = (page - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                const totalPages = Math.max(1, Math.ceil(rows.length / rowsPerPage));

                rows.forEach((row, index) => {
                    row.style.display = index >= start && index < end ? '' : 'none';
                });

                document.getElementById('pageInfo').innerText = `Halaman ${page} dari ${totalPages}`;
                document.getElementById('prevPage').disabled = page === 1;
                document.getElementById('nextPage').disabled = end >= rows.length;
            }

            document.getElementById('prevPage').addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    showPage(currentPage);
                }
            });

            document.getElementById('nextPage').addEventListener('click', () => {
                if ((currentPage * rowsPerPage) < rows.length) {
                    currentPage++;
                    showPage(currentPage);
                }
            });

            showPage(currentPage);
        });
    </script>

    <script>
        function showoption()
        {
            fetch("{{ route('pembelian.option') }}")
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

    <script>
        function showDetail(id) {
            fetch(`/pembelian/${id}/detail`)
                .then(response => {
                    if (!response.ok) throw new Error("Gagal memuat data.");
                    return response.text();
                })
                .then(html => {
                    document.getElementById('modal-content').innerHTML = html;
                    const modal = new bootstrap.Modal(document.getElementById('DetailModal'));
                    modal.show();
                })
                .catch(err => {
                    document.getElementById('modal-content').innerHTML = `<div class="p-3"><p class="text-danger">${err.message}</p></div>`;
                });
        }
    </script>

    <script>
        function closeModal() {
            const modalEl = document.getElementById('DetailModal');
            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.hide();
        }
    </script>


</body>

</html>
