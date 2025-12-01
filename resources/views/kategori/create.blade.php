<!DOCTYPE html>
<html lang="en">

<head>
    <title>Program Toko - Tambah Produk</title>
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
                                    <h1 class="h4 text-gray-900 mb-4">Tambah Kategori</h1>
                                </div>
                                <form class="user" action="{{ route('kategori.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="font-weight-bold">Nama Kategori</label>
                                            <input type="text"
                                                class="form-control form-control-user @error('nama') is-invalid @enderror"
                                                id="InputNamaProduk" placeholder="Nama Kategori"
                                                value="{{ old('nama') }}" name="nama" required>
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        
                                        <hr>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-sm-3">
                                            <button type="submit" class="btn btn-success btn-user btn-block">
                                                Simpan
                                            </button>
                                        </div>
                                    </div>
                                </form>

                        </div>
                    </div>
                </div>
                
                
            </div>
            <!-- End of Main Content -->
            
            <!-- Footer -->
            <!-- End of Footer -->
            
        </div>
        @include('ADMTemplate.footer')
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    @include('ADMTemplate.logoutModal')

    @include('ADMTemplate.script')

</body>

</html>
