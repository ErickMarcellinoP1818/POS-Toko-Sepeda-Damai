<!DOCTYPE html>
<html lang="en">

<head>
    <title>Program Toko - Supplier</title>
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
                    <h1 class="h3 mb-2 text-gray-800">Supplier</h1>

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

                            <a href="{{ route('supplier.create') }}" class="btn btn-md btn-success mb-3">TAMBAH
                                DATA 
                                SUPPLIER</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Nomor Telepon</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($suppliers as $item)
                                            <tr>
                                                <td>{{ $item->nama }}</td>

                                                    <td>{{ $item->alamat ?? ''}}</td>
                                                    <td>{{ $item->telepon ?? '' }}</td>
                                                    <td>{{ $item->keterangan ?? ''}}</td>

                                                <td class="align-middle text-center">
                                                    <a href="https://wa.me/+62{{ $item->telepon }}" class="btn btn-sm btn-success"><i class="bi bi-whatsapp"></i> Hubungi</a>
                                                    <a href="{{ route('supplier.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pen"></i> Edit</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <div class="alert alert-danger">
                                                Belum Memiliki Supplier
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
