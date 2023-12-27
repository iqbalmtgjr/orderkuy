<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="tambah" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Toko</h5>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/toko/input') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 ms-auto">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nama Toko</label>
                                    <input type="text" class="form-control" name="nama_toko"
                                        value="{{ old('nama_toko') }}" placeholder="Nama Toko ...">
                                    @error('nama_toko')
                                        <div class="text-danger ml-3 mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Aktif" @selected(old('status') == 'Aktif')>Aktif</option>
                                        <option value="Tidak Aktif" @selected(old('status') == 'Tidak Aktif')>Tidak Aktif
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger ml-3 mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Alamat Toko</label>
                                    <textarea class="form-control" name="alamat_toko" cols="30" rows="5" placeholder="Alamat ...">{{ old('alamat_toko') }}</textarea>
                                    @error('alamat_toko')
                                        <div class="text-danger ml-3 mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Foto Toko</label>
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
