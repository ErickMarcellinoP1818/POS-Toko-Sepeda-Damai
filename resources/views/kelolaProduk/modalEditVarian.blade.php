<div class="modal-header bg-primary text-white justify-content-center">
  <h5 class="modal-title">Detail Varian</h5>
</div>


<div class="modal-body">
     <form method="POST" action="{{ route('varian.update', $varian->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label class="font-weight-bold">Nama Varian</label>
                <input type="text"
                    class="form-control form-control-user @error('nama') is-invalid @enderror"
                    id="InputNamaProduk" placeholder="Nama Varian"
                    value="{{ old('nama', $varian->nama_varian) }}" name="nama" required>
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            
            
            <div class="col-sm-6 mb-3">
                <label class="font-weight-bold required">Gambar Produk</label>
            <input type="file"
                class="form-control @error('gambar') is-invalid @enderror"
                id="InputGambar" name="gambar" >
            @error('gambar')
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
                    class="form-control form-control-user @error('min_stok') is-invalid @enderror"
                    id="InputJumlahStokm" placeholder="Stok Minimal"
                    value="{{ old('min_stok', $varian->min_stok) }}" name="min_stok" required>
                @error('min_stok')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror                
            </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
        <button type= "submit" class="btn btn-success button-user">
            <i class="bi bi-check-lg me-2"></i> Konfirmasi
        </button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i class="fas fa-times me-2"></i> Batal
        </button>
        </div>
    </form>
</div>

