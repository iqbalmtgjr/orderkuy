<div class="modal fade" id="avatar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Ganti Profile</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <form method="POST" action="{{ route('upload.avatar') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="md-form mb-4">
                        <div class="row">
                            <div class="col-12">
                                <input name="avatar" type="file" id="avatar"
                                    class="form-control validate @error('avatar') is-invalid @enderror">
                                @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="row mb-2">
                    <button type="submit" style="border-radius:17px;" class="btn btn-primary">Ganti Foto
                        Profile</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
