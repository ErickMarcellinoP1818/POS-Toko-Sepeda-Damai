<!-- resources/views/partials/productBox.blade.php -->
<div class="image">
<img src="{{ asset('storage/' . $item->gambar) }}" width="150px">
</div>
<div class="content">
    <h3>{{ $item->nama }}</h3>
    <h2>
        Kategori:
    @if (!is_null($item->kategori))
        {{ $item->kategori->nama }}
    @endif
    </h2>
    <h2><span class="stock" style="font-size: larger;">Stok Tersedia: {{ $stok[$item->id] ?? 0 }}</span></h2>
    <br>
    <span class="price">Rp. {{ number_format($item->harga, 0, ',', '.') }}</span>
    <br>
    
</div>
