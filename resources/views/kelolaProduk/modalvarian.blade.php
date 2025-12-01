<div class="modal-header bg-primary text-white justify-content-center">
  <h5 class="modal-title">Detail Varian</h5>
</div>


<div class="modal-body">
     <form method="POST" action="{{ route('produk.varian.temp') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label class="font-weight-bold">Nama Varian</label>
                <input type="text"
                    class="form-control form-control-user @error('namas') is-invalid @enderror"
                    id="InputNamaProduk" placeholder="Nama Varian"
                    value="{{ old('namas') }}" name="namas" required>
                @error('namas')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="font-weight-bold">Jumlah Stok</label>
                <input type="number"
                    class="form-control form-control-user @error('stok') is-invalid @enderror"
                    id="InputJumlahStok" placeholder="Jumlah Stok"
                    value="{{ old('stok') }}" name="stok" required>
                @error('stok')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
        </div>
        <div class="form-group row">

            <div class="col-sm-6 mb-3 mb-sm-0">
                <label class="font-weight-bold">Harga Beli</label>
                <input type="number"
                class="form-control form-control-user @error('hargab') is-invalid @enderror"
                id="inputHargab" placeholder="Masukkan Harga Beli"
                value="{{ old('hargab') }}" name="hargab" required>
                @error('hargab')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            
            <div class="col-sm-6">
                <label class="font-weight-bold">Gambar Produk</label>
            <input type="file"
                class="form-control @error('gambars') is-invalid @enderror"
                id="InputGambars" name="gambars" >
            @error('gambars')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
               <label class="font-weight-bold">Stok Minimal di Gudang</label>
                <input type="number"
                    class="form-control form-control-user @error('stokm') is-invalid @enderror"
                    id="InputJumlahStokm" placeholder="Stok Minimal"
                    value="{{ old('stokm') }}" name="stokm" required>
                @error('stokm')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror                
            </div>
        </div>
        <div class="modal-footer justify-content-center">
        <button type= "submit" class="btn btn-success">
            <i class="bi bi-check-lg me-2"></i> Konfirmasi
        </button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i class="fas fa-times me-2"></i> Batal
        </button>
        </div>
    </form>
</div>

