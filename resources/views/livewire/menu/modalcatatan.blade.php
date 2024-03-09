<div wire:ignore.self class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Catatan {{ $produk }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="addNote">
                    <div class="form-group">
                        <input wire:model="produk_id" type="hidden" value="{{ $produk_id }}">
                        <textarea wire:model="catatan" class="form-control @error('catatan') is-invalid @enderror"
                            placeholder="contoh: baksonya gak pake sayur"></textarea>
                        @error('catatan')
                            <div class="text-danger ml-3 mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-danger">Tambah Catatan</button>
                </form>
            </div>
        </div>
    </div>
</div>
