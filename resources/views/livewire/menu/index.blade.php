<div>
    <div class="row">
            <h2>Menu {{ $toko->nama_toko }}</h2>
            <p>{{ $toko->alamat }}</p>
    </div>
    <div class="row">
            @if ($makanan->count() > 0)
                <h3>Menu Makanan</h3>
            @else
            @endif
            @foreach ($makanan as $item)
                <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                    <div class="card">
                        <img class="card-img-top" style="height: 12rem; object-fit: cover; object-position: center;"
                            src="{{ asset('assets/img/menu/' . $item->foto) }}" alt="{{ $item->nama_produk }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->nama_produk }}</h5>
                            <p class="card-text">@rupiah($item->harga)</p>

                            @if($isClicked)
                                <div class="d-flex align-items-center">
                                    <div class="col-md-2">
                                        <button class="btn btn-outline-primary btn-sm" wire:click="decrement({{ $item->id }})">-</button>
                                    </div>
                                    <div class="col-md-1">
                                        <label>{{ $count }}</label>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-outline-primary btn-sm" wire:click="increment({{ $item->id }})">+</button>
                                    </div>
                                    {{-- <button class="btn btn-success btn-sm float-right" wire:click="addToCart({{ $item->id }})"><i class="fas fa-cart-plus"></i></button> --}}
                                </div>
                            @else
                                <button wire:click="handleClick({{ $item->id }})" class="btn btn-primary">Order</button>
                            @endif
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
                            <button class="btn btn-primary">Order</button>
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
                            <button class="btn btn-primary">Order</button>
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
</div>
