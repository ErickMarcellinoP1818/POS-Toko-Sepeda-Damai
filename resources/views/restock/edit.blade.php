<!DOCTYPE html>
<html lang="en">

<head>
    <title>Program Toko - Edit Produk</title>
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
                                    <h1 class="h4 text-gray-900 mb-4">Edit Produk</h1>
                                </div>

                                <!-- FORM EDIT PRODUK -->
                                <form class="user" action="{{ route('produks.update', $produk->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')

                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label class="font-weight-bold">Nama Produk</label>
                                            <input type="text"
                                                class="form-control form-control-user @error('nama') is-invalid @enderror"
                                                id="InputNamaProduk" placeholder="Nama Produk"
                                                value="{{ old('nama', $produk->nama) }}" name="nama" required>
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6">
                                            <label class="font-weight-bold">Jumlah Stok</label>
                                            <input type="number"
                                                class="form-control form-control-user @error('stok') is-invalid @enderror"
                                                id="InputJumlahStok" placeholder="Jumlah Stok"
                                                value="{{ old('stok', $produk->stok) }}" name="stok" required>
                                            @error('stok')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label class="font-weight-bold">Harga</label>
                                            <input type="number"
                                                class="form-control form-control-user @error('harga') is-invalid @enderror"
                                                id="InputHarga" placeholder="Harga Produk"
                                                value="{{ old('harga', $produk->harga) }}" name="harga" required>
                                            @error('harga')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6">
                                            <label class="font-weight-bold">Kode Produk</label>
                                            <input type="text"
                                                class="form-control form-control-user @error('Kode') is-invalid @enderror"
                                                id="InputKodeProduk" placeholder="Kode Produk"
                                                value="{{ old('Kode', $produk->Kode) }}" name="Kode" required>
                                            @error('Kode')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold">Gambar Produk</label>
                                        <input type="file"
                                            class="form-control @error('gambar') is-invalid @enderror"
                                            id="InputGambar" name="gambar">
                                        @error('gambar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-success btn-user btn-block">
                                        Simpan
                                    </button>
                                    <hr>
                                </form>
                                <!-- END FORM EDIT PRODUK -->

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
