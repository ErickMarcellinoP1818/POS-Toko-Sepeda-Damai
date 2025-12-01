<!DOCTYPE html>
<html lang="en">
<head>
    
    @include('template.header')
    @include('template.navbar')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Toko Sepeda Damai - Nota Pembelian</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }
        table, th, td {
            border: 2px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            font-size: 17px;
            font-weight: bold;
        }
        h2 { font-size: 28px; }
        h3 { font-size: 22px; text-decoration: underline; margin-top: 50px; }
        p { font-size: 16px; margin-bottom: 10px; }
        .btn { font-size: 16px; padding: 10px 20px; }
        #qrCodeImage {
            max-width: 100%;
            height: auto;
            border: 1px solid #eee;
            padding: 10px;
            background: white;
        }
        #qrCodeModal .modal-dialog { max-width: 350px; }
    </style>
</head>
<body>
   
    <div class="container" style="margin-top: 100px;">
        <h2>Toko Sepeda Damai</h2>
        <p>Jl. Pemuda No.86, Kemirirejo, Kec. Magelang Tengah, Kota Magelang, Jawa Tengah 56122</p>
        <h3>NOTA PEMBELIAN</h3>
        <p>Tanggal cetak: {{ $date }}</p>

        <form method="POST" action="{{ route('update.diskon') }}">
            @csrf
            @method('PATCH')

        <table class="table table-bordered table-striped text-center align-middle text-center">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Harga Satuan</th>
                    <th>Harga Total</th>
                    <th>Diskon</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                $hargaAkhir=0;
                $tHargaAkhir=0;
                @endphp
                @forelse ($cart as $id => $item)
                @php
                $hargaAkhir=($item['harga'] * $item['jumlah']) - $item['diskon'];
                $tHargaAkhir+=$hargaAkhir;
                @endphp
                    <tr>
                        <td>{{ $item['nama'] }} {{ $item['varian'] }}</td>
                        <td>{{ $item['jumlah'] }}</td>
                        <td><strong>Rp. {{ number_format($item['harga'], 0, ',', '.') }}</strong></td>
                        <td><strong>Rp. {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</strong></td>
                        <td>
                            <input type="number" 
                                name="cart[{{ $id }}][diskon]" 
                                value="{{ $item['diskon'] ?? 0 }}"
                                min="0"
                                max="{{ $item['harga'] * $item['jumlah'] }}"
                                class="form-control diskon-input text-end"
                                data-id="{{ $id }}"
                                data-harga="{{ $item['harga'] }}"
                                data-jumlah="{{ $item['jumlah'] }}">
                        </td>
                        <td><strong>Rp. {{ number_format($hargaAkhir, 0, ',', '.') }}</strong></td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="alert alert-danger">Data tidak ditemukan</td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="3" class="text-center"><strong>Subtotal:</strong></td>
                    <td><strong>Rp. {{ number_format($total, 0, ',', '.') }}</strong></td>
                    <td><strong>Rp. {{ number_format($total - $tHargaAkhir, 0, ',', '.') }}</strong></td>
                    <td><strong>Rp. {{ number_format($tHargaAkhir, 0, ',', '.') }}</strong></td>

                </tr>
            </tbody>
        </table>


        <div class="text-end mt-4 d-flex justify-content-end gap-3">
            @if(empty(session('cart')) && session('print_id'))
                <a href="{{ route('nota.print', session('print_id')) }}" class="btn btn-primary" target="_blank">
                    Cetak Nota
                </a>
            @elseif(session('cart'))
                <button class="btn btn-primary btn-block" type="submit"><i class="bi bi-wrench-adjustable-circle"></i> Simpan Perubahan</button>
                <a href="#" class="btn btn-success px-4 py-2 shadow-sm d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#inputNominalModal">
                    <i class="bi bi-cash-stack"></i> Cash
                </a>
                <a href="#" id="payWithQRISBtn" class="btn btn-warning text-dark px-4 py-2 shadow-sm d-flex align-items-center gap-2">
                    <i class="bi bi-qr-code-scan"></i> QRIS
                </a>
            @endif
        </div>
        </form>
    </div>

    <div class="modal fade" id="inputNominalModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('bayar') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Masukkan Nominal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="uang" class="form-label">Nominal (Rp)</label>
                            <input type="number" name="uang" id="uang" class="form-control" min="0" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="qrCodeModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bayar dengan QRIS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="qrCodeLoading" class="text-center py-4">
                        <div class="spinner-border text-primary"></div>
                        <p>Menyiapkan pembayaran QRIS...</p>
                    </div>
                    <div id="qrCodeDisplay" style="display:none;">
                        <img id="qrCodeImage" src="" alt="QR Code QRIS" class="img-fluid mb-3">
                        <p class="text-muted">Scan QR code ini menggunakan aplikasi mobile banking atau e-wallet Anda</p>
                        <div class="alert alert-info">
                            <small>Total Pembayaran: Rp <span id="paymentAmount"></span></small><br>
                            <small>Nomor Invoice: <span id="invoiceNumber"></span></small>
                        </div>
                    </div>
                    <div id="qrCodeError" class="alert alert-danger" style="display:none;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    @include('template.foot')
    @include('template.script')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
            });
        @elseif(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
            });
        @endif

        document.getElementById('payWithQRISBtn').addEventListener('click', function(e) {
            e.preventDefault();

            const modal = new bootstrap.Modal(document.getElementById('qrCodeModal'));
            const loadingEl = document.getElementById('qrCodeLoading');
            const qrDisplayEl = document.getElementById('qrCodeDisplay');
            const errorEl = document.getElementById('qrCodeError');
            const qrImage = document.getElementById('qrCodeImage');
            const paymentAmountEl = document.getElementById('paymentAmount');
            const invoiceNumberEl = document.getElementById('invoiceNumber');

            loadingEl.style.display = 'block';
            qrDisplayEl.style.display = 'none';
            errorEl.style.display = 'none';
            errorEl.textContent = '';

            modal.show();

            let tdiskon = 0;
             document.querySelectorAll('.diskon-input').forEach(input => {
                tdiskon += parseFloat(input.value) || 0;
            });
            const total = parseFloat({{ $total }});
            const bayar = total-tdiskon;
            const invNum = 'INV-' + Date.now();

            fetch('/pembayaran-qr', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    total: bayar,
                    bayar: bayar,
                    metode: 'qris',
                    inv_num: invNum
                })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        throw new Error(err.message || 'Gagal memproses pembayaran');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (!data.success || !data.qr) {
                    throw new Error(data.message || 'QR code tidak tersedia');
                }

                qrImage.src = data.qr;
                paymentAmountEl.textContent = bayar.toLocaleString('id-ID');
                invoiceNumberEl.textContent = invNum;

                loadingEl.style.display = 'none';
                qrDisplayEl.style.display = 'block';

                checkPaymentStatus(data.transaction_id);
            })
            .catch(error => {
                console.error('Payment Error:', error);
                loadingEl.style.display = 'none';
                errorEl.textContent = error.message;
                errorEl.style.display = 'block';
            });
        });

    function checkPaymentStatus(transactionId) {
        const interval = setInterval(() => {
            fetch(`/check-payment-status?transaction_id=${transactionId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal memeriksa status');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log("STATUS MIDTRANS:", data.transaction_status);

                    if (data.transaction_status === 'settlement') {
                        clearInterval(interval);
                        fetch('/qris-sukses', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                transaction_id: transactionId,
                                order_id: data.order_id
                            })
                        })
                        .then(res => res.json())
                        .then(result => {
                            console.log("Response result:", result);

                            if (result.success) {
                                console.log("✅ Pembayaran berhasil diproses");
                                window.location.href = result.redirect;
                            } else {
                                console.error("❌ Pembayaran gagal:", result.message);
                                alert('Pembayaran gagal: ' + result.message);
                            }
                        })
                    }else if (['expire', 'cancel', 'deny'].includes(data.transaction_status)) {
                        clearInterval(interval);
                        alert('Pembayaran QRIS dibatalkan atau kadaluarsa. Silakan coba lagi.');
                    }
                })
                .catch(err => console.error("Error polling status:", err));
        }, 3000);
    }
    });

    document.querySelectorAll('.diskon-input').forEach(input => {
        input.addEventListener('input', function() {
            const id = this.dataset.id;
            const harga = parseFloat(this.dataset.harga);
            const jumlah = parseFloat(this.dataset.jumlah);
            const diskon = parseFloat(this.value) || 0;
            
            const total = (harga * jumlah) - diskon;
            document.getElementById(`total-${id}`).textContent = 'Rp. ' + total.toLocaleString('id-ID');
            
            updateGrandTotal();
        });
    });

    function updateGrandTotal() {
        let totalDiskon = 0;
        let subtotal = 0;
        
        document.querySelectorAll('.diskon-input').forEach(input => {
            const harga = parseFloat(input.dataset.harga);
            const jumlah = parseFloat(input.dataset.jumlah);
            const diskon = parseFloat(input.value) || 0;
            
            totalDiskon += diskon;
            subtotal += (harga * jumlah);
        });
        
        document.getElementById('total-diskon').textContent = 'Rp. ' + totalDiskon.toLocaleString('id-ID');
        document.getElementById('grand-total').textContent = 'Rp. ' + (subtotal - totalDiskon).toLocaleString('id-ID');
    }

    document.getElementById('diskonForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire('Berhasil!', data.message, 'success');
            } else {
                Swal.fire('Error!', data.message, 'error');
            }
        })
        .catch(error => {
            Swal.fire('Error!', 'Terjadi kesalahan', 'error');
        });
    });
    </script>
</body>
</html>
