<!DOCTYPE html>
<html lang="en">

<head>
    <title>Program Toko - Tambah Data Pembelian</title>
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
                                    <h1 class="h4 text-gray-900 mb-4">Tambah Data Pembelian</h1>
                                </div>
                                <form class="user" action="{{ route('restock.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="id_produk">Pilih Produk</label>
                                            <select name="id_produk" id="id_produk" class="form-control select2">
                                                <option value="">-- Pilih Produk --</option>
                                                @foreach ($produk as $produks)
                                                    <option value="{{ $produks->id }}">{{ $produks->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="id_supplier">Pilih Supplier</label>
                                            <select name="id_supplier" id="id_supplier" class="form-control select2">
                                                <option value="">-- Pilih Supplier --</option>
                                                @foreach ($supplier as $suppliers)
                                                    <option value="{{ $suppliers->id }}">{{ $suppliers->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label class="font-weight-bold">Harga Beli</label>
                                            <input type="number"
                                                class="form-control form-control-user @error('harga') is-invalid @enderror"
                                                id="InputHarga" placeholder="Harga Beli" value="{{ old('harga') }}"
                                                name="harga" required>
                                            @error('harga')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="font-weight-bold">Kuantitas</label>
                                            <input type="number"
                                                class="form-control form-control-user @error('jumlah') is-invalid @enderror"
                                                id="InputJumlah" placeholder="Kode Produk"
                                                value="{{ old('jumlah') }}" name="jumlah" required>
                                            @error('jumlah')
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

                            </div>

                        </div>
                    </div>
                </div>


            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

        @include('ADMTemplate.footer')
    </div>

    <!-- End of Page Wrapper -->

    @include('ADMTemplate.logoutModal')

    @include('ADMTemplate.script')
    <script>
        $(document).ready(function() {
            $('#id_produk').select2({
                placeholder: "Cari atau pilih produk",
                allowClear: true
            });
            $('#id_supplier').select2({
                placeholder: "Cari atau pilih supplier",
                allowClear: true
            });
        });
    </script>

    
</body>

</html>
