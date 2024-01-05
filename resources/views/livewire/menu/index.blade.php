<div>
    @push('header')
        @livewireStyles
    @endpush
    @if (session('sukses'))
        <?php toastr()->success(session('sukses'), 'Sukses'); ?>
    @endif

    @if (session('gagal'))
        <?php toastr()->error(session('gagal'), 'Gagal'); ?>
    @endif

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
                        @else --}}
                        <button wire:click="addToCart({{ $item->id }})" class="btn btn-danger">Order</button>
                        {{-- @endif --}}
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
