<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-lg-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('assets/img/logo.png') }}" alt="">
                <h1>OrderKuy<span>!</span></h1>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    @guest
                        <li><a href="{{ url('/') }}"><i class="bi bi-house-door-fill"></i>&nbsp;Home</a></li>
                    @else
                        <li><a href="{{ url('/home') }}"><i class="bi bi-house-door-fill"></i>&nbsp;Home</a></li>
                    @endguest
                    <li><a href="{{ url('/') }}"><i class="bi bi-heart-fill"></i>&nbsp;Menu Favorit</a></li>
                    <li><a href="{{ url('/') }}"><i class="bi bi-journal-text"></i>&nbsp;Booking Meja</a></li>
                    <li><a href="{{ url('/') }}"><i class="bi bi-clock-history"></i>&nbsp;Riwayat</a></li>
                    @if (auth()->user() == true)
                        <li><a href="menu.html" class="nav-item nav-link"><i class="bi bi-cart-fill"></i><span
                                    class="badge text-bg-danger" style="font-size: 7px">0</span></a></li>
                        <li class="dropdown"><a href="#"><span>Akun</span> <i
                                    class="bi bi-chevron-down dropdown-indicator"></i></a>
                            <ul>
                                <li><a href="{{ url('/profile') }}">Profile</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </nav><!-- .navbar -->

            @guest
                @if (Route::has('login'))
                    <a class="btn-book-a-table" href="{{ url('login') }}">Login</a>
                @endif
            @else
                <a class="btn-book-a-table" href="{{ url('logout') }}"
                    onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        </div>
    </header><!-- End Header -->

    {{-- Modal Login --}}
    <div class="modal fade" id="logins" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">MASUK</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="md-form mb-4">
                            <div class="row">
                                <div class="col-2">
                                    <i style="font-size: 30px" class="fas fa-envelope prefix grey-text"></i>
                                </div>
                                <div class="col-10">
                                    <input name="email" type="email" id="defaultForm-email"
                                        class="form-control validate @error('email') is-invalid @enderror"
                                        placeholder="Email Anda" value="{{ old('email') }}" autocomplete="email"
                                        autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="md-form mb-4">
                            <div class="row">
                                <div class="col-2">
                                    <i style="font-size: 30px" class="fas fa-lock prefix grey-text"></i>
                                </div>
                                <div class="col-10">
                                    <input name="password" type="password" id="defaultForm-pass"
                                        class="form-control validate @error('password') is-invalid @enderror"
                                        placeholder="Kata Sandi Anda" autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <a href="#">Lupa Kata Sandi?</a>
                        </div>
                        <div class="row mb-2">
                            <button type="submit" style="border-radius:17px;"
                                class="col-12 btn btn-primary">Login</button>
                        </div>
                    </form>
                    <div class="row">
                        <button type="button" style="border-radius:17px;" class="col-12 btn btn-success"
                            data-bs-toggle="modal" data-bs-target="#daftar">Daftar</button>
                    </div>
                    <div class="row mt-4 text-center">
                        <p>----------------------------------- atau -----------------------------------</p>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <div class="row">
                        <a href="{{ route('auth.google') }}" class="col-12 myButtonGoogle"><i
                                class="fab fa-google"></i>&nbsp;&nbsp;Login
                            Dengan
                            Google</a>
                    </div>
                    <div class="row">
                        <a href="{{ route('auth.facebook') }}" class="col-12 myButtonFacebook"><i
                                class="fab fa-facebook-f"></i>&nbsp;&nbsp;Login
                            Dengan
                            Facebook</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal Daftar --}}
    <div class="modal fade" id="daftar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">DAFTAR</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="md-form mb-4">
                            <div class="row">
                                <div class="col-2">
                                    <i style="font-size: 30px" class="fas fa-user prefix grey-text"></i>
                                </div>
                                <div class="col-10">
                                    <input name="name" type="text" id="name"
                                        class="form-control validate @error('name') is-invalid @enderror"
                                        placeholder="Nama Lengkap" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="md-form mb-4">
                            <div class="row">
                                <div class="col-2">
                                    <i style="font-size: 30px" class="fas fa-envelope prefix grey-text"></i>
                                </div>
                                <div class="col-10">
                                    <input name="email" type="email" id="email"
                                        class="form-control validate @error('email') is-invalid @enderror"
                                        placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="md-form mb-4">
                            <div class="row">
                                <div class="col-2">
                                    <i style="font-size: 30px" class="fas fa-lock prefix grey-text"></i>
                                </div>
                                <div class="col-10">
                                    <input name="password" type="password" id="defaultForm-pass"
                                        class="form-control 5validate @error('password') is-invalid @enderror"
                                        placeholder="Kata Sandi">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="md-form mb-4">
                            <div class="row">
                                <div class="col-2">
                                    <i style="font-size: 30px" class="fas fa-lock prefix grey-text"></i>
                                </div>
                                <div class="col-10">
                                    <input name="password_confirmation" type="password" id="password-confirm"
                                        class="form-control validate @error('password_confirmation') is-invalid @enderror"
                                        placeholder="Konfirmasi Kata Sandi">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <div class="row mb-2">
                        <button type="submit" style="border-radius:17px;" class="btn btn-primary">Daftar</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
