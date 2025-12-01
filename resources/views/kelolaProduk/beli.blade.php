<!DOCTYPE html>
<html lang="en">
<head>
    <title>Program Toko - Pembelian</title>
    @include('ADMTemplate.head')
</head>
<body id="page-top">
    <div id="wrapper">
        @include('ADMTemplate.left-sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <form action="{{ route('restock.store') }}" method="POST">
            <div id="content">
                @include('ADMTemplate.navbar')

                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Pembelian</h1>
                                    @csrf
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 row">
                            <div class="col-sm-6">
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                <button type="button" class="btn btn-primary mb-3" onclick="showoption()">
                                    <i class="bi bi-bag-fill"></i> Tambah Barang
                                </button>
                            </div>
                            <div class="col-sm-3 ml-auto"> 
                                <select name="id_supplier" id="id_supplier" class="form-control select2" required>
                                    <option value="">-- Pilih Supplier --</option>
                                    @foreach ($supplier as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="notaTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Varian</th>
                                            <th>Qty</th>
                                            <th>Harga Satuan</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(session('beli'))
                                            @foreach (session('beli') as $id => $details)
                                                        @php
                                                            $produk = App\Models\Produk::with('varian')->find($details['id_produk']);
                                                        @endphp
                                                <tr class="text-center" data-id="{{ $id }}">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $details['nama'] }}</td>
                                                    <td>
                                                        <select name="varian[{{ $id }}]" class="form-select form-select-sm">
                                                            <option value="">-- Pilih Varian --</option>
                                                            @foreach ($produk->varian as $varian)
                                                                @if($varian->status == 1)
                                                                    <option value="{{ $varian->id }}" 
                                                                        {{ isset($details['id_varian']) && $details['id_varian'] == $varian->id ? 'selected' : '' }}>
                                                                        {{ $varian->nama_varian }} 
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    </td>
                                                    <td>{{ $details['jumlah'] }}</td>
                                                    <td class="text-end">Rp. {{ number_format($details['harga'], 0, ',', '.') }}</td>
                                                    <td class="text-end">Rp. {{ number_format($details['harga'] * $details['jumlah'], 0, ',', '.') }}</td>
                                                    <td>
                                                        <a href="#" class="delete-pembelian btn btn-danger">
                                                            <i class="bi bi-trash3-fill"></i> Hapus
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr class="text-center">
                                                <th colspan="5">Total Pembelian</th>
                                                <td class="text-end">Rp. {{ number_format($total, 0, ',', '.') }}</td>
                                                <td></td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center text-danger">Belum Menambah Barang</td>
                                            </tr>
                                        @endif
                                    </tbody>

                                </table>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success mb-3"
                                @if(!session('beli'))
                                    disabled
                                @endif
                                >
                                <i class="bi bi-bag-check-fill"></i> Termin</button>
                                <button type="button" class="btn btn-info mb-3" onclick="showsubmit()"
                                @if(!session('beli'))
                                    disabled
                                @endif
                                >
                                    <i class="bi bi-alarm-fill"></i> Tempo
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal fade" id="co" tabindex="-1" aria-labelledby="coLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div id="co-tempo" class="modal-content">
                            <div class="modal-body text-center">
                                <div class="spinner-border text-primary" role="status"></div>
                                <p class="mt-2">Memuat opsi...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="modal fade" id="beli" tabindex="-1" aria-labelledby="beliLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div id="beli-content" class="modal-content">
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

    @include('ADMTemplate.script')

    <script>

        function showoption() {
            fetch("{{ route('tambahbeli') }}")
                .then(response => response.text())
                .then(html => {
                    document.getElementById('beli-content').innerHTML = html;
                    const modal = new bootstrap.Modal(document.getElementById('beli'));
                    modal.show();

                    setTimeout(() => {
                        $('#id_produk').select2({
                            dropdownParent: $('#beli'),
                            placeholder: "Cari atau pilih produk",
                            allowClear: true
                        });
                    }, 200); 
                })
                .catch(error => {
                    console.error('Error fetching option:', error);
                    document.getElementById('beli-content').innerHTML = '<div class="alert alert-danger">Gagal memuat opsi.</div>';
                });
        }
    
    </script>

    <script>

        function showsubmit() {
            fetch("{{ route('pembelian.cotempo') }}")
            .then(response => response.text())
            .then(html => {
                document.getElementById('co-tempo').innerHTML = html;
                const modal = new bootstrap.Modal(document.getElementById('co'));
                modal.show();
            })
        .catch(error => {
                console.error('Error fetching option:', error);
                document.getElementById('co-tempo').innerHTML = '<div class="alert alert-danger">Gagal memuat opsi.</div>';
            });
        }
    
    </script>

    <script>

        $(document).ready(function() {
           
            $('#id_supplier').select2({
                placeholder: "Cari atau pilih supplier",
                allowClear: true
            });
        });

    </script>

    <script>

        $(document).ready(function () {
            $(document).on('click', '.delete-pembelian', function (e) {
                e.preventDefault();

                const row = $(this).closest('tr');
                const id = row.data('id');

                if (!id) return alert('ID tidak ditemukan');

                if (confirm('Yakin ingin menghapus item ini?')) {
                    $.ajax({
                        url: '{{ route("pembelian.delete") }}', // pastikan route POST/DELETE benar
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        success: function (res) {
                            if (res.success) {
                                row.remove();
                                alert(res.message);
                                if ($('#total-pembelian').length) {
                                    $('#total-pembelian').text(res.total);
                                }
                                location.reload();
                            } else {
                                alert(res.message);
                            }
                        },
                        error: function () {
                            alert('Terjadi kesalahan server.');
                        }
                    });
                }
            });
        });

    </script>

<script>

    $(document).ready(function() {
        $(document).on('change', 'select[name^="varian["]', function() {
            const selectElement = $(this);
            const itemId = selectElement.attr('name').match(/\[(.*?)\]/)[1];
            const varianId = selectElement.val();
            
            if (!varianId) return;

            selectElement.prop('disabled', true);
            const row = selectElement.closest('tr');
            row.css('opacity', '0.7');

            $.ajax({
                url: '{{ route("pembelian.update_varian") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    item_id: itemId,
                    varian_id: varianId
                },
                success: function(response) {
                    if (response.success) {
                        const originalColor = row.css('background-color');
                        row.css('background-color', '#e8f5e9')
                        .delay(500)
                        .animate({backgroundColor: originalColor}, 1000);
                    }
                },
                error: function() {
                    alert('Gagal menyimpan varian');
                    selectElement.val(selectElement.data('prev-value'));
                },
                complete: function() {
                    selectElement.prop('disabled', false);
                    row.css('opacity', '1');
                }
            });
        });

        $(document).on('focus', 'select[name^="varian["]', function() {
            $(this).data('prev-value', $(this).val());
        });
    });

</script>


</body>
</html>
