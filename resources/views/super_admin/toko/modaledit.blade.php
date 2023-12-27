<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Toko</h5>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/toko/update') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" id="id" name="id" value="">
                                <input type="hidden" id="url_getdata" name="url_getdata"
                                    value="{{ url('/toko/getdata/') }}">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nama Toko</label>
                                    <input type="text" class="form-control" id="nama_toko" name="nama_toko"
                                        value="{{ old('nama_toko') }}" placeholder="Nama Toko ...">
                                    @error('nama_toko')
                                        <div class="text-danger ml-3 mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Aktif" {{ old('status') ? 'selected' : '' }}>Aktif</option>
                                        <option value="Tidak Aktif" {{ old('status') ? 'selected' : '' }}>Tidak Aktif
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
                                    <textarea class="form-control" name="alamat_toko" id="alamat_toko" cols="30" rows="5"
                                        placeholder="Alamat ...">{{ old('alamat_toko') }}</textarea>
                                    @error('alamat_toko')
                                        <div class="text-danger ml-3 mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Foto Toko</label> <br>
                                    {{-- <img style="height: 120px; width: 180px;"
                                        src="{{ asset('assets/img/toko/1689342932065-bakso.jpg') }}" alt=""> --}}
                                    <input disabled class="form-control" type="text" id="foto">
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
                $('#nama_toko').val(response.nama_toko);
                $('#alamat_toko').val(response.alamat);
                $('#status').val(response.status);
                $('#foto').val(response.foto);
            }
        });
    }
</script>
