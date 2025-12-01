<div class="modal-header bg-primary text-white">
    @if(Route::is('tambahbeli'))
  <h5 class="modal-title">Beli Produk</h5>
  @else
  <h5 class="modal-title">Beli</h5>
  @endif
</div>

<div class="modal-body">
    <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Tambah Data Pembelian</h1>
            </div>
            <form class="user"  @if(isset($editItem))
                action="{{ route('pembelian.edit') }}" 
            @else
                action="{{ route('pembelian.add') }}" 
            @endif
            method="POST"
                enctype="multipart/form-data">
                @csrf
                    @php
                        $produkTerbeli = collect($beli)->pluck('id_produk')->toArray();
                    @endphp
                <div class="form-group">
                    <label for="id_produk">Pilih Produk</label>
                    <select name="id_produk" id="id_produk" class="form-control">
                        <option value="">-- Pilih Produk --</option>
                        @foreach ($produk as $p)
                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>

   
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label class="font-weight-bold">Harga</label>
                        <input type="number"
                            class="form-control form-control-user @error('harga') is-invalid @enderror"
                            id="InputHarga" placeholder="Harga Produk" value="{{ old('harga', $editItem['harga'] ?? '') }}"
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
                            id="InputJumlah" name="jumlah" placeholder="Kuantitas"
                            value="{{ old('jumlah', $editItem['jumlah'] ?? '') }}" required>
                        @error('jumlah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-success btn-user btn-block">
                    Simpan
                </button>
            </form>

        </div>
    </div>
    <script>
        document.getElementById('id_produk').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const previewImg = document.getElementById('product-preview');
            const hargaInput = document.getElementById('InputHarga');
            
            previewImg.src = selectedOption.dataset.image || '{{ asset("img/default-product.png") }}';
            
        });
    </script>
</div>


