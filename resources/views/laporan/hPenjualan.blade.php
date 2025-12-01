<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Laporan Penjualan  @if($detail) Detail @endif {{ \Carbon\Carbon::parse($tanggalM)->format('d M Y') }} - {{ \Carbon\Carbon::parse($tanggalD)->format('d M Y') }}</title>
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
    <h2>Laporan Penjualan @if($detail) Detail @endif</h2>
    <h2>Periode {{ \Carbon\Carbon::parse($tanggalM)->format('d M Y') }} - {{ \Carbon\Carbon::parse($tanggalD)->format('d M Y') }}</h2>

    <div class="info">
        <p><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::parse(today())->format('d M Y') }}</p>
    </div>

    <table>
        @if(!$detail)
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Tanggal</th>
                <th>No Invoice</th>
                <th>Kasir</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        @endif
        <tbody>
            @if($detail)
            <tr class="text-center">
                <th>No</th>
                <th>Tanggal</th>
                <th>Qty</th>
                <th>No Invoice</th>
                <th>Kasir</th>
            </tr>
            @endif
            @forelse($penjualan as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                    @if($detail)
                    <td></td>
                    @endif
                    <td class="text-center">{{ $item->inv_num }}</td>
                    <td class="text-center">{{ $item->kasir->name ?? '-'}}</td>
                    @if($detail)
                    @foreach($item->detilnota as $counter => $itemdetail)
                    <tr>
                        <td></td>
                        <td class="text-center">
                            {{ $itemdetail->produk->nama ?? '-' }} {{ $itemdetail->varian->nama_varian  ?? '-'}}
                        </td>
                        <td class="text-center">{{ $itemdetail->jumlah }}</td>
                        <td class="text-end">Rp {{ number_format(($itemdetail->subtotal - $itemdetail->diskon)/$itemdetail->jumlah, 0, ',', '.') }}</td>
                        <td class="text-end">Rp {{ number_format($itemdetail->subtotal - $itemdetail->diskon, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th 
                        colspan="4"
                        class="text-center">Subtotal</th>
                        <td class="text-end">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                    </tr>
                    @else
                    <td class="text-end">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-danger">Tidak ada data</td>
                </tr>
            @endforelse
            <tr>
                
                <th
                colspan="4"
                >Total</th>
                <td class="text-end">Rp {{ number_format($totalAll, 0, ',', '.')  }}</td>
            </tr>
        </tbody>
    </table>

</body>
</html>
