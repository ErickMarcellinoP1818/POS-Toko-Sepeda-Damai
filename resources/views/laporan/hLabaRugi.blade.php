<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Laporan Laba Rugi  @if($detail) Detail @endif {{ \Carbon\Carbon::parse($tanggalM)->format('d M Y') }} - {{ \Carbon\Carbon::parse($tanggalD)->format('d M Y') }}</title>
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
    <h2>Laporan Laba Rugi @if($detail) Detail @endif</h2>
    <h2>Periode {{ \Carbon\Carbon::parse($tanggalM)->format('d M Y') }} - {{ \Carbon\Carbon::parse($tanggalD)->format('d M Y') }}</h2>

    <div class="info">
        <p><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::parse(today())->format('d M Y') }}</p>
    </div>

    <table>
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Tanggal</th>
                <th>No Faktur</th>
                @if($detail)
                <th>Nama Barang</th>
                <th>Kuantitas</th>
                <th>Harga Satuan</th>
                @else
                <th>Keterangan</th>
                @endif
                <th>Subtotal</th>
                <th>Harga Beli</th>
                <th>Diskon</th>
                <th>Keuntungan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $tdisk=0;
                $thjual=0;
                $tbeli=0;
            @endphp
            
            @if($detail)
            @php
                $num=1;
                $tuntung=0;
            @endphp
            @endif
            
            @forelse($penjualan as $index => $item)
            @if(!$detail)
            @php
            $hb=0;
            $dis=0;
            @endphp
            @endif
            
            @foreach($item->detilnota as $index => $items)
            
            @php
            $hjual = $items->harga * $items->jumlah;
            $hbeli = $items->hpp * $items->jumlah;
            $untung = $hjual - $hbeli - $item->diskon;
            $tbeli += $hbeli;
            
            $thjual += $hjual;
            $tdisk += $items->diskon;
            @endphp
            @if(!$detail)
            @php
            $hb += $hbeli;
            $dis += $items->diskon;
            @endphp
            @endif
            @if($detail)
                <tr>
                    <td class="text-center">{{ $num++}}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($items->nota->tanggal)->format('d M Y') }}</td>
                    <td class="text-center">{{ $items->nota->inv_num }}</td>
                    <td class="text-center">{{ $items->produk->nama }} {{ $items->varian->nama_varian ?? ''}}</td>
                    <td class="text-center">{{ $items->jumlah }}</td>
                    <td class="text-end">Rp {{ number_format($items->harga, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format($hjual, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format($hbeli, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format($items->diskon, 0, ',', '.') }}</td>
                    <td class="text-end">Rp {{ number_format($hjual - $hbeli - $items->diskon, 0, ',', '.') }}</td>
                </tr>
            @endif

            @endforeach

            @if(!$detail)

            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                <td class="text-center">{{ $item->inv_num }}</td>
                <td class="text-center">Penjualan Barang</td>
                <td class="text-end">Rp {{ number_format($item->total + $dis, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($hb, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($dis, 0, ',', '.') }}</td>
                <td class="text-end">Rp {{ number_format($item->total - $hb, 0, ',', '.') }}</td>
            </tr>

            @endif

            @empty
                <tr>
                    <td colspan="6" class="text-center text-danger">Tidak ada data</td>
                </tr>
            @endforelse
            <tr>
                
                <th @if($detail)
                colspan="6"
                @else
                colspan="4"
                @endif
                >Total</th>
                <th class="text-end">Rp {{ number_format($thjual, 0, ',', '.')  }}</th>
                <th class="text-end">Rp {{ number_format($tbeli, 0, ',', '.')  }}</th>
                <th class="text-end">Rp {{ number_format($tdisk, 0, ',', '.')  }}</th>
                <th class="text-end">Rp {{ number_format($totalAll - $tbeli, 0, ',', '.')  }}</th>
            </tr>
        </tbody>
    </table>

</body>
</html>
