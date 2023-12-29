@extends('layouts.user.apps')

@section('content')
    <!-- ======= Breadcrumbs ======= -->
    {{-- <div class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Sample Inner Page</h2>
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>Sample Inner Page</li>
                </ol>
            </div>

        </div>
    </div> --}}
    <!-- End Breadcrumbs -->

    <section class="sample-page">
        <div class="container" data-aos="fade-up">
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img height="500px" src={{ asset('assets/img/events-1.jpg') }} class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img height="500px" src={{ asset('assets/img/events-1.jpg') }} class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img height="500px" src={{ asset('assets/img/events-1.jpg') }} class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            {{-- <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img height="500px" src={{ asset('assets/img/events-1.jpg') }} class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <img height="500px" src={{ asset('assets/img/events-1.jpg') }} class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <img height="500px" src={{ asset('assets/img/events-1.jpg') }} class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div> --}}

            <div class="mt-5">
                <div class="row align-center wow fadeInUp pb-5 mb-5" data-wow-delay="0.3s">
                    <div class="col-lg-2 col-md-4"></div>
                    <div class="col-lg-8 col-md-4">
                        <input style="border-radius: 1cm" type="text" class="form-control"
                            placeholder="Mau makan apa hari ini?" value="">
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <button style="border-radius: 1cm" type="submit" class="btn btn-outline-danger">CARI</button>
                    </div>
                </div>
            </div>

            <div class="m-4">
                <div class="row align-center">
                    <h2>Resto/Cafe</h2>
                    @foreach ($toko as $item)
                        <div class="col-md-3 mt-5">
                            <div class="card" style="width: 18rem;">
                                <img style="height: 12rem;width: 18rem; object-fit: cover; object-position: center;"
                                    src="{{ asset('assets/img/toko/' . $item->foto . '') }}" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->nama_toko }}</h5>
                                    <p class="card-text"><i style="color: red"
                                            class="bi bi-geo-fill"></i>&nbsp;&nbsp;{{ $item->alamat }}</p>
                                    <a href="{{ url('menu/toko/' . $item->id . '') }}" class="btn btn-danger">Lihat
                                        Menu</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
@endsection
