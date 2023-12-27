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
            <div class="pt-4">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="10000">
                            <img height="500px" src={{ asset('assets/img/events-1.jpg') }} class="d-block w-100"
                                alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img height="500px" src={{ asset('assets/img/events-1.jpg') }} class="d-block w-100"
                                alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img height="500px" src={{ asset('assets/img/events-1.jpg') }} class="d-block w-100"
                                alt="...">
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
                </div>
            </div>
            <div class="mt-5">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-5">Daftar Restoran</h1>
                </div>
                <div class="row align-center wow fadeInUp pb-5 mb-5" data-wow-delay="0.3s">
                    <div class="col-lg-2 col-md-4"></div>
                    <div class="col-lg-8 col-md-4">
                        <input style="border-radius: 1cm" type="text" class="form-control"
                            placeholder="Mau makan dimana hari ini?" value="">
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <button style="border-radius: 1cm" type="submit" class="btn btn-outline-primary">CARI</button>
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
                                    <p class="card-text"><i style="color:red"
                                            class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;{{ $item->alamat }}</p>
                                    <center><a href="{{ url('menu/toko/' . $item->id . '') }}" class="btn btn-primary">Lihat
                                            Menu</a></center>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
@endsection
