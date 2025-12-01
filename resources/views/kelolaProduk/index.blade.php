<!DOCTYPE html>
<html lang="en">

<head>
    <title>Program Toko - Produk</title>
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
                    <h1 class="h3 mb-2 text-gray-800">Produk</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">

                            <a href="{{ route('produks.create') }}" class="btn btn-md btn-success mb-3">TAMBAH
                                PRODUK
                                BARU</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Gambar</th>
                                            <th>Kategori</th>
                                            <th>Harga Jual</th>
                                            <th>Jumlah Stok</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($produk as $index => $item)
                                            <tr class="text-center">
                                                <td class=" align-middle text-center">{{ $index + 1 }}</td>

                                                <td>{{ $item->nama }}</td>
                                                 <td><img src="{{ asset('storage/' . $item->gambar) }}" width="150px" height="150px"></td>
                                                <td>
                                                @if ($item->kategori == null)
                                                    <span class="badge badge-danger">Belum Memiliki Kategori</span>
                                                @else
                                                {{ $item->kategori->nama }}
                                                @endif
                                                </td>
                                                <td class="text-end">Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                                                <td>{{ $stok[$item->id] ?? 0 }}</td>
                                                <td>
                                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                        action="{{ route('produks.destroy', $item->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('produks.edit', $item->id) }}"
                                                            class="btn btn-sm btn-primary">Edit</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                            </tr>
                                        @empty
                                            <div class="alert alert-danger">
                                                Belum Memiliki Produk
                                            </div>
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
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('ADMTemplate.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    @include('ADMTemplate.logoutModal')

    @include('ADMTemplate.script')
    
</body>


</html>
