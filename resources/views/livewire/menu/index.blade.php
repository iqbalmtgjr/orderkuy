<div>
    @push('header')
        @livewireStyles
    @endpush

    <div class="row">
        <h2>Menu {{ $toko->nama_toko }}</h2>
        <p>{{ $toko->alamat }}</p>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                @if ($makanan->count() > 0)
                    <h4>Menu Makanan</h4>
                @else
                @endif
                @foreach ($makanan as $item)
                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                        <div class="card">
                            <img class="card-img-top" style="height: 12rem; object-fit: cover; object-position: center;"
                                src="{{ asset('assets/img/menu/' . $item->foto) }}" alt="{{ $item->nama_produk }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->nama_produk }}</h5>
                                <p class="card-text"><strong>@rupiah($item->harga)</strong></p>

                                {{-- @if ($isClicked)
                                    <div class="d-flex text-center align-items-center">
                                        <div class="col-md-2">
                                            <button class="btn btn-outline-danger btn-sm"
                                                wire:click="decrement({{ $item->id }})">-</button>
                                        </div>
                                        <div class="col-md-1">
                                            <label>{{ $count }}</label>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-outline-danger btn-sm"
                                                wire:click="increment({{ $item->id }})">+</button>
                                        </div>
                                    </div>
                                @else
                                    <button wire:click="addToCart({{ $item->id }})"
                                        class="btn btn-danger">Tambah</button>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row mt-5">
                @if ($minuman->count() > 0)
                    <h4>Menu Minuman</h4>
                @else
                @endif
                @foreach ($minuman as $item)
                    <div class="col-lg-4 col-md-3 col-sm-4 mt-3">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top"
                                style="height: 12rem;width: 18rem; object-fit: cover; object-position: center;"
                                src="{{ asset('assets/img/menu/' . $item->foto . '') }}" class="card-img-top"
                                alt="...">
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
                    <h4>Snack</h4>
                @else
                @endif
                @foreach ($snack as $item)
                    <div class="col-lg-4 col-md-3 col-sm-4 mt-3">
                        <div class="card" style="width: 18rem;">
                            <img style="height: 12rem;width: 18rem; object-fit: cover; object-position: center;"
                                src="{{ asset('assets/img/menu/' . $item->foto . '') }}" class="card-img-top"
                                alt="...">
                            <div class="card-body">
                                <h5>{{ $item->nama_produk }}</h5>
                                <p class="card-text">@rupiah($item->harga)</p>
                                <button class="btn btn-danger">Order</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                {{-- <div class="card-header"> --}}
                {{-- </div> --}}
                <div class="card-body">
                    <h4>Checkout</h4>
                    <div class="row mt-4 px-2">
                        <h6>Jenis Order</h6>
                    </div>
                    <div class="row text-center px-2">
                        <div class="col-lg-6">
                            <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off"
                                checked>
                            <label class="btn btn-md btn-danger col-12" for="option1">Ditempat</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
                            <label class="btn btn-md btn-secondary col-12" for="option2">Dibungkus</label>
                        </div>
                    </div>
                    <div class="row mt-4 px-3">
                        <table style="width: 100%">
                            <tr>
                                <th style="width: 40%">Nama Pesanan</th>
                                <th>Jumlah</th>
                                <th style="width: 30%">Harga</th>
                            </tr>
                            <tr>
                                <td style="width: 40%">Bakso Urat</td>
                                <td><input class="form-control" style="width: 60%" type="number" value="0"></td>
                                <td style="width: 30%">Rp. 20.000</td>
                            </tr>
                            <tr>
                                <td style="width: 40%">Bakso Telur</td>
                                <td><input class="form-control" style="width: 60%" type="number" value="0"></td>
                                <td style="width: 30%">Rp. 15.000</td>
                            </tr>
                            <tr>
                                <td style="width: 40%">Bakso Lemak</td>
                                <td><input class="form-control" style="width: 60%" type="number" value="0"></td>
                                <td style="width: 30%">Rp. 18.000</td>
                            </tr>
                            <tr>
                                <td style="width: 40%">Es Teh</td>
                                <td><input class="form-control" style="width: 60%" type="number" value="0"></td>
                                <td style="width: 30%">Rp. 20.000</td>
                            </tr>
                        </table>
                    </div>
                    <div class="row mt-4 px-3">
                        <table style="width: 100%">
                            <tr>
                                <td>Sub Total</td>
                                <th>Rp. 80.000</th>
                            </tr>
                            <tr>
                                <td>PPN 0%</td>
                                <th></th>
                            </tr>
                            <tr>
                                <td>Total Harga</td>
                                <th>Rp. 80.000</th>
                            </tr>
                        </table>
                    </div>
                    <div class="row mt-4 px-3">
                        <button class="btn btn-danger btn-lg">Order Sekarang</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- <div class="row mt-5">
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
    </div> --}}

    {{-- @push('footer') --}}
    {{-- @livewireScripts --}}
    @script
        <script type="text/javascript">
            $wire.on('cart-stored', (data) => {
                toastr.success(data[0].message, 'Sukses');
            });
        </script>
    @endscript
    {{-- <script>
        document.addEventListener('livewire:load', function() {
            $wire.on('cart-stored', function(data) {
                console.log('bisa')
                toastr.success(data.message);
            });
        });
    </script> --}}
    {{-- @endpush --}}
</div>
