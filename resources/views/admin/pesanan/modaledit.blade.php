<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Meja</h5>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/meja/update') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 ms-auto">
                                <input type="hidden" id="id" name="id" value="">
                                <input type="hidden" id="url_getdata" name="url_getdata"
                                    value="{{ url('/meja/getdata/') }}">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nomor Meja</label>
                                    <input type="number" class="form-control" name="no_meja" id="no_mejaa"
                                        value="{{ old('no_meja') }}" placeholder="Nomor Meja ...">
                                    @error('no_meja')
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
                $('#no_mejaa').val(response.no_meja);
            }
        });
    }
</script>
