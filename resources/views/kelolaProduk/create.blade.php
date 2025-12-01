<!DOCTYPE html>
<html lang="en">

<head>
    <title>Program Toko - Tambah Produk</title>
    @include('ADMTemplate.head')
    <style>
        .varian-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            padding: 20px;
        }
        .varian-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
        }
        .varian-img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }
        .varian-footer {
            padding: 10px;
            background: #f8f9fa;
            text-align: center;
        }
        .delete-varian {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255,0,0,0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            font-size: 12px;
            cursor: pointer;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
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
                                    <h1 class="h4 text-gray-900 mb-4">Tambah Produk</h1>
                                </div>
                                <form class="user" action="{{ route('produks.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-sm-2 mb-3 mb-sm-0">
                                            <button type="button" class="btn btn-primary mb-3" onclick="showoption()"> Tambah Varian</button>
                                        </div>
                                    </div>
                                     @if(!empty(session('varian')))
                                        <div class="varian-grid">
                                            @foreach (session('varian') as $index => $item)
                                                <div class="varian-card">
                                                    <button type="button" class="delete-varian" onclick="deleteTempVarian({{ $index }})">
                                                        <i class="fas fa-times"></i>
                                                    </button>

                                                    @if(!empty($item['gambars']))
                                                        <a onclick="editVarian({{ $index }})">
                                                            <img src="{{ asset('storage/'.$item['gambars']) }}" class="varian-img" alt="Varian {{ $item['namas'] ?? '' }}">
                                                        </a>
                                                    @else
                                                        <a onclick="editVarian({{ $index }})">                                                    
                                                            <div class="varian-img bg-light d-flex align-items-center justify-content-center">
                                                                <i class="fas fa-image fa-2x text-muted"></i>
                                                            </div>
                                                        </a>
                                                    @endif

                                                    <div class="varian-footer">
                                                        <a onclick="editVarian({{ $index }})">
                                                            <h5 class="text-dark">{{ $item['namas'] ?? '' }}</h5>
                                                            <h5 class="text-dark">Stok: {{ $item['stok'] ?? '' }}</h5>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label class="font-weight-bold">Nama Produk</label>
                                            <input type="text"
                                                class="form-control form-control-user @error('nama') is-invalid @enderror"
                                                id="InputNamaProduk" placeholder="Nama Produk"
                                                value="{{ old('nama') }}" name="nama" required>
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label class="font-weight-bold">Harga Jual</label>
                                            <input type="number"
                                                class="form-control form-control-user @error('harga') is-invalid @enderror"
                                                id="InputHarga" placeholder="Harga Jual Produk" value="{{ old('harga') }}"
                                                name="harga" required>
                                            @error('harga')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label class="font-weight-bold">Kategori</label>
                                            <select name="id_kategori"
                                                class="form-control form-control-user @error('id_kategori') is-invalid @enderror"
                                                id="InputKategori">
                                                <option value="">Pilih Kategori</option>
                                                @foreach ($kategori as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('id_kategori')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                    
                                    <div class="col-sm">
                                        
                                        <label class="font-weight-bold">Deskripsi</label>
                                        <textarea
                                            class="form-control form-control-user @error('deskripsi') is-invalid @enderror"
                                            id="InputDeskripsi"
                                            name="deskripsi"
                                            placeholder="Masukkan deskripsi"
                                            rows="4"
                                            >{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                
                                <hr>
                                <div class="row d-flex justify-content-center">
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-success btn-user btn-block btn-sm-3">
                                            Simpan
                                        </button>
                                    </div>
                                    <div class="col-sm-3">
                                        <a class="btn btn-danger btn-user btn-block" href="{{route('produks.cancel') }}">Batal</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                    <!-- Modal Container -->
                    <div class="modal fade" id="DetailModal" tabindex="-1" aria-labelledby="DetailModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                        <div class="modal-content"id="modal-content">
                            <div class="modal-body text-center">
                            <div class="spinner-border text-primary" role="status"></div>
                            <p class="mt-2">Memuat data...</p>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!-- Modal Container -->
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

                    <div class="modal fade" id="editVarian" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div id="editVarianModal" class="modal-content">
                            <div class="modal-body text-center">
                                <div class="spinner-border text-primary" role="status"></div>
                                <p class="mt-2">Memuat opsi...</p>
                            </div>
                        </div>
                    </div>
                    </div>
                    

                    </div>

                    </div>
                    </div>
                    @include('ADMTemplate.footer')
                </div>


            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    @include('ADMTemplate.logoutModal')

    @include('ADMTemplate.script')

    <script>
        function showoption()
        {
            fetch("{{ route('produk.varian') }}")
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
            fetch(``)
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
    <script>
    function deleteTempVarian(index) {
        if (confirm('Hapus varian ini?')) {
            fetch("{{ route('varian.temp.delete') }}", {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ index: index })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }
    }
    </script>

    <script>
        function editVarian(index) {
            fetch(`/varian/session/${index}`)
                .then(response => {
                    if (!response.ok) throw new Error("Gagal memuat data.");
                    return response.text();
                })
                .then(html => {
                    document.getElementById('editVarianModal').innerHTML = html;
                    const modal = new bootstrap.Modal(document.getElementById('editVarian'));
                    modal.show();
                })
                .catch(err => {
                    document.getElementById('editVarianModal').innerHTML = `<div class="p-3"><p class="text-danger">${err.message}</p></div>`;
                });
        }
    </script>
    
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
    
</body>

</html>
