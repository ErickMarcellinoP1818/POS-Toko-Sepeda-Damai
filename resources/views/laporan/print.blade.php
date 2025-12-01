<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nota #{{ $nota->inv_num }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 40px;
        }
        h1, h2 {
            text-align: center;
            margin: 0;
        }
        h1 {
            font-size: 22px;
            text-transform: uppercase;
        }
        h2 {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .alamat {
            text-align: center;
            font-size: 12px;
            margin-bottom: 30px;
        }
        .info {
            margin-bottom: 20px;
            font-size: 13px;
        }
        .info p {
            margin: 4px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        table th, table td {
            border: 1px solid #000;
            padding: 6px;
        }
        table th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .text-end { text-align: right; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <h1 style="text-align: center;">
        <img src="{{ public_path('images/damai.jpeg') }}" alt="Logo" 
            style="height: 50px; width: 50px; border-radius: 50%; vertical-align: middle; margin-right: 10px;">
        <span style="vertical-align: middle;">TOKO SEPEDA DAMAI</span>
    </h1>
    <div class="alamat">Jl. Pemuda No.86, Kemirirejo, Magelang Tengah, Kota Magelang, Jawa Tengah 56122</div>
    <h2>Nota</h2>

    <div class="info">
        <p><strong>Nomor Invoice:</strong> {{ $nota->inv_num }}</p>
        <p><strong>Kasir:</strong> {{ $nota->kasir->name ?? 'Tidak Diketahui' }}</p>
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($nota->tanggal)->format('d M Y') }}</p>
        <p><strong>Metode Pembayaran:</strong> {{ strtoupper($nota->metode) }}</p>
        <p><strong>Bayar:</strong> Rp {{ number_format($nota->bayar, 0, ',', '.') }}</p>
        <p><strong>Kembali:</strong> Rp {{ number_format($nota->kembali, 0, ',', '.') }}</p>
        <p><strong>Status Pembayaran:</strong> {{ $nota->status }}</p>
    </div>

    <table>
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga Satuan</th>
                <th>Kuantitas</th>
                <th>Subtotal</th>
                <th>Diskon</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @php
            $subtotal = 0;
            $tdisk = 0;
            @endphp
            @forelse($detilnota as $index => $item)
            @php
            $subtotal += $item->subtotal;
            $tdisk += $item->diskon;
            @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->produk->nama ?? 'Produk Tidak Ditemukan' }} {{ $item->varian->nama_varian ?? '' }}</td>
                    <td class="text-end">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $item->jumlah }}</td>
                    <td class="text-end">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format($item->diskon, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format($item->subtotal - $item->diskon, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-danger">Tidak ada data</td>
                </tr>
            @endforelse
            <tr>
                <th colspan="4">Total</th>
                <td class="text-end">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($tdisk, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($nota->total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

</body>
</html>
