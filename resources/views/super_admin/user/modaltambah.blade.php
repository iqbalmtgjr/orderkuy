<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="tambah" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/user/input') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 ms-auto">
                                <input type="hidden" id="role" name="role" value="admin">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ old('name') }}" placeholder="Nama Lengkap ...">
                                    @error('name')
                                        <div class="text-danger ml-3 mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Nama Pengguna</label>
                                    <input type="text" class="form-control" name="username"
                                        value="{{ old('username') }}" placeholder="Nama Pengguna ...">
                                    @error('username')
                                        <div class="text-danger ml-3 mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">E-mail</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ old('email') }}" placeholder="E-mail ...">
                                    @error('email')
                                        <div class="text-danger ml-3 mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Jenis Kelamin</label>
                                    <select class="form-control" name="jenis_kelamin">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="L" @selected(old('jenis_kelamin') == 'L')>Laki-laki</option>
                                        <option value="P" @selected(old('jenis_kelamin') == 'P')>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="text-danger ml-3 mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Toko</label>
                                    <select class="form-control" name="toko">
                                        <option value="">-- Pilih Toko --</option>
                                        @foreach ($toko as $item)
                                            <option value="{{ $item->id }}" @selected(old('toko'))>
                                                {{ $item->nama_toko }}</option>
                                        @endforeach
                                    </select>
                                    @error('toko')
                                        <div class="text-danger ml-3 mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 ms-auto">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Role</label>
                                    <select class="form-control" name="role">
                                        <option value="">-- Pilih Role --</option>
                                        <option value="admin" @selected(old('role') == 'admin')>Admin</option>
                                        <option value="kasir" @selected(old('role') == 'kasir')>Kasir</option>
                                        <option value="dapur" @selected(old('role') == 'dapur')>Dapur</option>
                                        <option value="user" @selected(old('role') == 'user')>User</option>
                                    </select>
                                    @error('role')
                                        <div class="text-danger ml-3 mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">No Whatsapp</label>
                                    <input type="number" class="form-control" name="no_hp"
                                        value="{{ old('no_hp') }}" placeholder="No Whatsapp ...">
                                    @error('no_hp')
                                        <div class="text-danger ml-3 mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Alamat Pemilik</label>
                                    <textarea class="form-control" name="alamat" cols="30" rows="5" placeholder="Alamat Pemilik ...">{{ old('alamat') }}</textarea>
                                    @error('alamat')
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
