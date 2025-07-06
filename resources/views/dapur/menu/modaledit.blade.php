<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Menu</h5>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/menu/update') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 ms-auto">
                                <input type="hidden" id="id" name="id" value="">
                                <input type="hidden" id="url_getdata" name="url_getdata"
                                    value="{{ url('/menu/getdata/') }}">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nama Menu</label>
                                    <input type="text" class="form-control" name="nama_produk" id="nama_produk"
                                        value="{{ old('nama_produk') }}" placeholder="Nama Menu ...">
                                    @error('nama_produk')
                                        <div class="text-danger ml-3 mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Kategori</label>
                                    <select class="form-control" name="kategori" id="kategori">
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
                                    <input type="number" class="form-control" name="harga" id="harga"
                                        value="{{ old('harga') }}" placeholder="Harga ...">
                                    @error('harga')
                                        <div class="text-danger ml-3 mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Qty</label>
                                    <input type="number" class="form-control" name="qty" id="qty"
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
<script>
    function getdata(id) {
        console.log(id)
        var url = $('#url_getdata').val() + '/' + id
        console.log(url);

        $.ajax({
            url: url,
            cache: false,
            success: function(response) {
                console.log(response);

                $('#id').val(response.id);
                $('#nama_produk').val(response.nama_produk);
                $('#kategori').val(response.kategori);
                $('#harga').val(response.harga);
                $('#qty').val(response.qty);
            }
        });
    }
</script>
