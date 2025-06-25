<div>
    @push('header')
        @livewireStyles
    @endpush

    <div class="row">
        <h2>Menu {{ $toko->nama_toko }}</h2>
        <strong class="text-danger" style="margin-top: -10px">{{ $toko->alamat }}</strong>
    </div>
    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="card py-4 px-4">
                <div class="row">
                    @if ($makanan->count() > 0)
                        <h4>Menu Makanan</h4>
                    @else
                    @endif
                    @foreach ($makanan as $item)
                        <div class="col-lg-4 col-md-4 col-sm-6 mt-3">
                            <div class="card">
                                <img class="card-img-top"
                                    style="height: 12rem; object-fit: cover; object-position: center;"
                                    src="{{ asset('assets/img/menu/' . $item->foto) }}" alt="{{ $item->nama_produk }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->nama_produk }}</h5>
                                    <p class="card-text"><strong>@rupiah($item->harga)</strong></p>
                                    <button wire:click="addToCart({{ $item->id }})"
                                        class="btn btn-sm btn-danger">Tambah</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card py-4 px-4 mt-5">
                <div class="row">
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
                                    <h5 class="card-title">{{ $item->nama_produk }}</h5>
                                    <p class="card-text"><strong>@rupiah($item->harga)</strong></p>
                                    <button wire:click="addToCart({{ $item->id, $toko->id }})"
                                        class="btn btn-sm btn-danger">Tambah</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
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
                                <h5 class="card-title">{{ $item->nama_produk }}</h5>
                                <p class="card-text"><strong>@rupiah($item->harga)</strong></p>
                                <button wire:click="addToCart({{ $item->id, $toko->id }})"
                                    class="btn btn-sm btn-danger">Tambah</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4>Checkout</h4>
                    <div class="row mt-4 px-2">
                        <h6>Pilih Jenis Order</h6>
                    </div>
                    <div class="row text-center px-2">
                        <div class="col-lg-6 py-1">
                            <input wire:model='jenisOrder' wire:click="colorChange(1)" type="radio" class="btn-check"
                                id="option1" autocomplete="off" value="1"
                                {{ $jenisOrder == 1 ? 'checked' : '' }}>
                            <label
                                class="col-12 btn btn-md 
                                @if ($jenisOrder == 1) {
                                     {{ 'btn-danger' }}
                                @else
                                    {{ $selectedOption1 == 'btn-danger' ? 'btn-danger' : 'btn-secondary' }} @endif
                                "
                                for="option1">Ditempat</label>
                        </div>
                        <div class="col-lg-6 py-1">
                            <input wire:model='jenisOrder' wire:click="colorChange(0)" type="radio" class="btn-check"
                                id="option2" autocomplete="off" value="0"
                                {{ $jenisOrder == 0 ? 'checked' : '' }}>
                            <label
                                class="btn btn-md @if ($jenisOrder == 0) {
                                    {{ 'btn-danger' }}
                               @else
                                   {{ $selectedOption2 == 'btn-danger' ? 'btn-danger' : 'btn-secondary' }} @endif col-12"
                                for="option2">Dibungkus</label>
                        </div>
                    </div>

                    <div class="row mt-4 px-3">
                        <table class="table" style="width: 100%; font-size: 14px">
                            <tr>
                                <th style="width: 30%">Nama Pesanan</th>
                                <th>Jumlah</th>
                                <th style="width: 25%">Harga</th>
                            </tr>
                            @foreach ($carts as $cart)
                                <tr>
                                    <td style="width: 30%">{{ $cart->menu->nama_produk }}</td>
                                    <td>
                                        <div class="d-flex align-items-center align-content-center align-middle">
                                            <button wire:click='decrement({{ $cart->id }})'
                                                style="width: 17%; margin-right: 5%"
                                                class="btn btn-sm btn-danger">-</button>
                                            {{-- <input disabled class="form-control text-center" style="width: 30%"
                                            type="text" value="{{ $cart->qty }}"> --}}
                                            <strong style="width: 20%"
                                                class="text-center ">{{ $cart->qty }}</strong>
                                            <button wire:click='increment({{ $cart->id }})'
                                                style="width: 17%; margin-left: 5%"
                                                class="btn btn-sm btn-danger">+</button>
                                            <button wire:click='note({{ $cart->id }})'
                                                style="width: 20%; margin-left: 5%"
                                                class="btn btn-sm btn-secondary text-center" data-bs-toggle="modal"
                                                data-bs-target="#tambah" data-placement="top"
                                                title="Tambah dengan catatan"><i
                                                    class="bi bi-pencil-square"></i></button>
                                        </div>
                                    </td>
                                    <td style="width: 25%">@rupiah($cart->menu->harga * $cart->qty)</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    @php
                        $totalQty = App\Models\Cart::sum(\DB::raw('qty * harga'));
                    @endphp
                    <div class="row mt-4 px-3">
                        <table style="width: 100%">
                            <tr>
                                <td>Sub Total</td>
                                <th>@rupiah($totalQty)</th>
                            </tr>
                            <tr>
                                <td>PPN 0%</td>
                                <th></th>
                            </tr>
                            <tr>
                                <td>Total Harga</td>
                                <th>@rupiah($totalQty)</th>
                            </tr>
                        </table>
                    </div>
                    <div class="row mt-4 px-3">
                        <button
                            wire:click='order({{ empty($carts) ? $carts[0]->user_id : auth()->user()->id }}, {{ $toko->id }})'
                            class="btn btn-danger btn-lg">Order
                            Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
        @include('livewire.menu.modalcatatan')

    </div>

    @push('footer')
        {{-- @livewireScripts --}}
        @script
            <script type="text/javascript">
                $wire.on('order-stored', (data) => {
                    toastr.success(data[0].message, 'Sukses');
                });

                $wire.on('dataUpdated', () => {
                    $('#tambah').modal('hide');
                });
            </script>
        @endscript

    @endpush
</div>
