<!DOCTYPE html>
<html lang="en">

<head>
    <title>Program Toko - Tambah Supplier</title>
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

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('ADMTemplate.navbar')
                <!-- End of Topbar -->

                <div class="container">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Tambah Supplier</h1>
                                </div>
                                <form class="user" action="{{ route('supplier.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label class="font-weight-bold">Nama Supplier</label>
                                            <input type="text"
                                                class="form-control form-control-user @error('nama') is-invalid @enderror"
                                                id="InputNamaProduk" placeholder="Nama Supplier"
                                                value="{{ old('nama') }}" name="nama" required>
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="font-weight-bold">Alamat</label>
                                            <input type="text"
                                                class="form-control form-control-user @error('alamat') is-invalid @enderror"
                                                id="alamat" placeholder="Alamat"
                                                value="{{ old('alamat') }}" name="alamat">
                                            @error('stok')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label class="font-weight-bold">Nomor Telepon</label>
                                            <input type="number"
                                                class="form-control form-control-user @error('telepon') is-invalid @enderror"
                                                id="telepon" placeholder="Nomor Telepon" value="{{ old('telepon') }}"
                                                name="telepon" >
                                            @error('telepon')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="font-weight-bold">Keterangan</label>
                                            <input type="text"
                                                class="form-control form-control-user @error('keterangan') is-invalid @enderror"
                                                id="keterangan" placeholder="Masukkan Keterangan" value="{{ old('keterangan') }}"
                                                name="keterangan" >
                                            @error('keterangan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-sm-5">
                                            <button type="submit" class="btn btn-success btn-user btn-block">
                                                Simpan
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>


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
