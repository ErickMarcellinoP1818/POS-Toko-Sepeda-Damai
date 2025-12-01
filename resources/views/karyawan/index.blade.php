<!DOCTYPE html>
<html lang="en">
<head>
    <title>Program Toko - Karyawan</title>
    @include('ADMTemplate.head')

</head>
<body id="page-top">
    <div id="wrapper">
        @include('ADMTemplate.left-sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('ADMTemplate.navbar')

                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Karyawan</h1>
                    
                    <form action="{{ route('karyawan.upjabatan') }}" method="POST">
                        @csrf
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <button type="submit" class="btn btn-success">Update Jabatan</button>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="userRolesDataTable" class="table table-striped table-bordered" width="100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th >No</th>
                                            <th> Foto</th>
                                            <th >Nama</th>
                                            <th >Email</th>
                                            <th >Jabatan Sekarang</th>
                                            <th >Pilihan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($karyawan as $index => $user)
                                        <tr class="text-center">
                                            <td>{{ $index + 1 }}</td>
                                            @if($user->foto)
                                                <td><img src="{{ asset('storage/' . $user->foto) }}" width="150px" height="150px"></td>
                                            @else
                                                <td><img src="{{ asset('images/noPhoto.png') }}" width="150px" height="150px"></td>
                                            @endif
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td class="text-white">
                                                <span class="badge bg-{{ strtolower($user->jabatan) === 'admin' ? 'success' : (strtolower($user->jabatan) === 'kasir' ? 'warning' : 'info') }}">
                                                    {{ $user->jabatan ?: 'Belum Ada Jabatan' }}
                                                </span>
                                            </td>
                                            <td>
                                                <select name="jabatan[{{ $user->id }}]" class="form-select form-select-sm" @if($user->id === auth()->id()) disabled @endif>
                                                    <option value="">-- Pilih Jabatan --</option>
                                                    <option value="kasir" {{ $user->jabatan == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                                    <option value="admin" {{ $user->jabatan == 'admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="non" {{ $user->jabatan == 'non' ? 'selected' : '' }}>Nonaktif</option>
                                                </select>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No users found</td>
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
                </form>
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
            fetch(`/nota/${id}/detail`)
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
            fetch("{{ route('penjualan.option') }}")
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
