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
                                    class="badge text-bg-danger"
                                    style="font-size: 7px">{{ auth()->user()->cart == true? auth()->user()->cart->count(): '0' }}</span></a>
                        </li>
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
