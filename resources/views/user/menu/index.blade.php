@extends('layouts.user.apps')

@section('content')
    <div class="row">
        <h2>Menu {{ $toko->toko->nama_toko }}</h2>
        <p>{{ $toko->toko->alamat }}</p>
    </div>
    <div class="row">
        @if ($makanan->count() > 0)
            <h3>Menu Makanan</h3>
        @else
        @endif
        @foreach ($makanan as $item)
            <div class="col-lg-4 col-md-3 col-sm-4 mt-3">
                <div class="card" style="width: 18rem;">
                    <img style="height: 12rem;width: 18rem; object-fit: cover; object-position: center;"
                        src="{{ asset('assets/img/menu/' . $item->foto . '') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5>{{ $item->nama_produk }}</h5>
                        <p class="card-text">@rupiah($item->harga)</p>
                        <button class="btn btn-danger">Order</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row mt-5">
        @if ($minuman->count() > 0)
            <h3>Menu Minuman</h3>
        @else
        @endif
        @foreach ($minuman as $item)
            <div class="col-lg-4 col-md-3 col-sm-4 mt-3">
                <div class="card" style="width: 18rem;">
                    <img style="height: 12rem;width: 18rem; object-fit: cover; object-position: center;"
                        src="{{ asset('assets/img/menu/' . $item->foto . '') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5>{{ $item->nama_produk }}</h5>
                        <p class="card-text">@rupiah($item->harga)</p>
                        <button class="btn btn-danger">Order</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row mt-5">
        @if ($snack->count() > 0)
            <h3>Snack</h3>
        @else
        @endif
        @foreach ($snack as $item)
            <div class="col-lg-4 col-md-3 col-sm-4 mt-3">
                <div class="card" style="width: 18rem;">
                    <img style="height: 12rem;width: 18rem; object-fit: cover; object-position: center;"
                        src="{{ asset('assets/img/menu/' . $item->foto . '') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5>{{ $item->nama_produk }}</h5>
                        <p class="card-text">@rupiah($item->harga)</p>
                        <button class="btn btn-danger">Order</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
