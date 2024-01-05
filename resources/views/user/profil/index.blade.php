@extends('layouts.user.apps')
@section('content')
    <div class="row">
        <h1>AKUN SAYA</h1>
    </div>
    <div class="row col-12 mb-5 mt-5">
        <div class="text-center">
            <a class="hover-effect" href="#" data-bs-toggle="modal" data-bs-target="#avatar">
                @if (Auth::user()->avatar == null)
                    <img class="imagee" id="fotoprofil"
                        style="border-radius: 50%; box-shadow: rgba(0, 0, 0, 0.2) 0px 3px 3px -2px, rgba(0, 0, 0, 0.14) 0px 3px 4px 0px, rgba(0, 0, 0, 0.12) 0px 1px 8px 0px;"
                        width="15%" src="{{ asset('assets/img/profile/user.png') }}" alt="Foto Profil">
                    <div class="middle">
                        <div class="text"><i class="bi bi-camera-fill"></i></div>
                    </div>
                @else
                    @if (!empty(Auth::user()->google_id || Auth::user()->facebook_id))
                        @if (file_exists('assets/img/profile/' . Auth::user()->avatar))
                            <img class="imagee" id="fotoprofil"
                                style="border-radius: 50%; box-shadow: rgba(0, 0, 0, 0.2) 0px 3px 3px -2px, rgba(0, 0, 0, 0.14) 0px 3px 4px 0px, rgba(0, 0, 0, 0.12) 0px 1px 8px 0px;"
                                width="15%" src="{{ asset('assets/img/profile/' . Auth::user()->avatar) }}"
                                alt="Foto Profil">
                            <div class="middle">
                                <div class="text"><i class="bi bi-camera-fill"></i></div>
                            </div>
                        @else
                            <img class="imagee" id="fotoprofil"
                                style="border-radius: 50%; box-shadow: rgba(0, 0, 0, 0.2) 0px 3px 3px -2px, rgba(0, 0, 0, 0.14) 0px 3px 4px 0px, rgba(0, 0, 0, 0.12) 0px 1px 8px 0px;"
                                width="15%" src="{{ Auth::user()->avatar }}" alt="Foto Profil">
                            <div class="middle">
                                <div class="text"><i class="bi bi-camera-fill"></i></div>
                            </div>
                        @endif
                    @elseif (!empty(Auth::user()->facebook_id && Auth::user()->google_id))
                        @if (file_exists('assets/img/profile/' . Auth::user()->avatar))
                            <img class="imagee" id="fotoprofil"
                                style="border-radius: 50%; box-shadow: rgba(0, 0, 0, 0.2) 0px 3px 3px -2px, rgba(0, 0, 0, 0.14) 0px 3px 4px 0px, rgba(0, 0, 0, 0.12) 0px 1px 8px 0px;"
                                width="15%" src="{{ asset('assets/img/profile/' . Auth::user()->avatar) }}"
                                alt="Foto Profil">
                            <div class="middle">
                                <div class="text"><i class="bi bi-camera-fill"></i></div>
                            </div>
                        @else
                            <img class="imagee" id="fotoprofil"
                                style="border-radius: 50%; box-shadow: rgba(0, 0, 0, 0.2) 0px 3px 3px -2px, rgba(0, 0, 0, 0.14) 0px 3px 4px 0px, rgba(0, 0, 0, 0.12) 0px 1px 8px 0px;"
                                width="15%" src="{{ Auth::user()->avatar }}" alt="Foto Profil">
                            <div class="middle">
                                <div class="text"><i class="bi bi-camera-fill"></i></div>
                            </div>
                        @endif
                    @else
                        @if (file_exists('assets/img/profile/' . Auth::user()->avatar))
                            <img class="imagee" id="fotoprofil"
                                style="border-radius: 50%; box-shadow: rgba(0, 0, 0, 0.2) 0px 3px 3px -2px, rgba(0, 0, 0, 0.14) 0px 3px 4px 0px, rgba(0, 0, 0, 0.12) 0px 1px 8px 0px;"
                                width="15%" src="{{ asset('assets/img/profile/' . Auth::user()->avatar) }}"
                                alt="Foto Profil">
                            <div class="middle">
                                <div class="text"><i class="bi bi-camera-fill"></i></div>
                            </div>
                        @else
                            <img class="imagee" id="fotoprofil"
                                style="border-radius: 50%; box-shadow: rgba(0, 0, 0, 0.2) 0px 3px 3px -2px, rgba(0, 0, 0, 0.14) 0px 3px 4px 0px, rgba(0, 0, 0, 0.12) 0px 1px 8px 0px;"
                                width="15%" src="{{ Auth::user()->avatar }}" alt="Foto Profil">
                            <div class="middle">
                                <div class="text"><i class="bi bi-camera-fill"></i></div>
                            </div>
                        @endif
                    @endif
                @endif
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-6">
            <form action="{{ url('/profile/input') }}" method="post">
                @csrf
                <div class="row g-3">
                    <h3>Data Lengkap</h3>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="name" placeholder="Nama Lengkap"
                                value="{{ Auth::user()->name }}">
                            <label for="name">Nama Lengkap</label>
                            @error('name')
                                <div class="text-danger ml-3 mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username"
                                value="{{ Auth::user()->pelanggan->username == true ? Auth::user()->pelanggan->username : old('username') }}">
                            <label for="username">Username</label>
                            @error('username')
                                <div class="text-danger ml-3 mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email"
                                value="{{ Auth::user()->email }}">
                            <label for="name">Email</label>
                            @error('email')
                                <div class="text-danger ml-3 mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="number" class="form-control" name="no_hp" id="no_hp"
                                placeholder="No Handphone"
                                value="{{ Auth::user()->pelanggan->no_hp == true ? Auth::user()->pelanggan->no_hp : old('no_hp') }}">
                            <label for="name">No Handphone</label>
                            @error('no_hp')
                                <div class="text-danger ml-3 mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir"
                                value="{{ Auth::user()->pelanggan->tgl_lahir == true ? Auth::user()->pelanggan->tgl_lahir : old('tgl_lahir') }}">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            @error('tgl_lahir')
                                <div class="text-danger ml-3 mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
                                <option value="">--Pilih Jenis Kelamin--</option>
                                <option value="L"
                                    @if (Auth::user()->pelanggan->jenis_kelamin != null) {{ Auth::user()->pelanggan->jenis_kelamin == 'L' ? 'selected' : '' }}
                                @else
                                    {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }} @endif>
                                    Laki-laki</option>
                                <option value="P"
                                    @if (Auth::user()->pelanggan->jenis_kelamin != null) {{ Auth::user()->pelanggan->jenis_kelamin == 'P' ? 'selected' : '' }}
                                @else
                                    {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }} @endif>
                                    Perempuan</option>
                            </select>
                            <label for="select1">Jenis Kelamin</label>
                            @error('jenis_kelamin')
                                <div class="text-danger ml-3 mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea name="alamat" class="form-control" placeholder="Special Request" id="message" style="height: 100px">{{ Auth::user()->pelanggan->alamat == true ? Auth::user()->pelanggan->alamat : old('alamat') }}</textarea>
                            <label for="alamat">Alamat</label>
                            @error('alamat')
                                <div class="text-danger ml-3 mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button style="border-radius: 1cm" class="btn btn-danger w-100 py-3" type="submit">Simpan
                            Data</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12 col-lg-6" id="profil">
            <form action="{{ url('/profile/update-password') }}" method="post">
                @csrf
                <div class="row g-3">
                    <h3>Ubah Password</h3>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="password" class="form-control" name="password_lama" placeholder="Password Lama"
                                value="">
                            <label for="password_lama">Password Lama</label>
                            @error('password_lama')
                                <div class="text-danger ml-3 mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="password" class="form-control" name="password_baru" placeholder="Password Baru"
                                value="">
                            <label for="password_baru">Password Baru</label>
                            @error('password_baru')
                                <div class="text-danger ml-3 mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="password" class="form-control" name="konfirmasi_password"
                                placeholder="Konfirmasi Password" value="">
                            <label for="konfirmasi_password">Konfirmasi Password</label>
                            @error('konfirmasi_password')
                                <div class="text-danger ml-3 mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button style="border-radius: 1cm" class="btn btn-danger w-100 py-3" type="submit">Ubah
                            Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('user.profil.modal')
@endsection
