<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="tambah" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/menu/input') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 ms-auto">
                                <input type="hidden" name="daftar_resto_id"
                                    value="{{ auth()->user()->dapur->toko->id }}">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nama Menu</label>
                                    <input type="text" class="form-control" name="nama_produk"
                                        value="{{ old('nama_produk') }}" placeholder="Nama Menu ...">
                                    @error('nama_produk')
                                        <div class="text-danger ml-3 mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Kategori</label>
                                    <select class="form-control" name="kategori">
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="makanan" @selected(old('kategori') == 'makanan')>Makanan</option>
                                        <option value="minuman" @selected(old('kategori') == 'minuman')>Minuman</option>
                                        <option value="snack" @selected(old('kategori') == 'snack')>Snack</option>
                                    </select>
                                    @error('kategori')
                                        <div class="text-danger ml-3 mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Harga</label>
                                    <input type="number" class="form-control" name="harga"
                                        value="{{ old('harga') }}" placeholder="Harga ...">
                                    @error('harga')
                                        <div class="text-danger ml-3 mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Qty</label>
                                    <input type="number" class="form-control" name="qty"
                                        value="{{ old('qty') }}" placeholder="Banyaknya Menu ...">
                                    @error('qty')
                                        <div class="text-danger ml-3 mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Foto Produk</label>
                                    <input type="file" class="form-control" name="foto"
                                        value="{{ old('foto') }}">
                                    @error('foto')
                                        <div class="text-danger ml-3 mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
