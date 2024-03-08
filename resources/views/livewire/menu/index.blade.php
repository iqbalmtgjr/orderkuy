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
                                <button wire:click="addToCart({{ $item->id }})"
                                    class="btn btn-danger">Tambah</button>
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
                <div class="card-body">
                    <h4>Checkout</h4>
                    <div class="row mt-4 px-2">
                        <h6>Pilih Jenis Order</h6>
                    </div>
                    <div class="row text-center px-2">
                        <div class="col-lg-6">
                            <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off"
                                checked>
                            <label class="btn btn-md btn-danger col-12" for="option1">Ditempat</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
                            <label class="btn btn-md btn-warning col-12" for="option2">Dibungkus</label>
                        </div>
                    </div>
                    <div class="row mt-4 px-3">
                        <table style="width: 100%">
                            <tr>
                                <th style="width: 40%">Nama Pesanan</th>
                                <th>Jumlah</th>
                                <th style="width: 30%">Harga</th>
                            </tr>
                            @foreach ($carts as $cart)
                                <tr>
                                    <td style="width: 40%">{{ $cart->menu->nama_produk }}</td>
                                    <td><input wire:model="quantity{{ $cart->id }}"
                                            id="quantity-{{ $cart->menu->id }}" class="form-control" style="width: 60%"
                                            type="number" value="{{ $cart->qty }}">
                                    </td>
                                    <td style="width: 30%">@rupiah($cart->menu->harga)</td>
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
                        <button class="btn btn-danger btn-lg">Order Sekarang</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('footer')
        {{-- @livewireScripts --}}
        @script
            <script type="text/javascript">
                $wire.on('cart-stored', (data) => {
                    toastr.success(data[0].message, 'Sukses');
                });
            </script>
        @endscript

        <script>
            //ubah warna pilih order
            const option1 = document.getElementById('option1');
            const option2 = document.getElementById('option2');

            option1.addEventListener('change', function() {
                if (this.checked) {
                    console.log('cek1')
                    document.getElementById('option1').classList.remove('btn-secondary');
                    document.getElementById('option1').classList.add('btn-danger');
                    document.getElementById('option2').classList.remove('btn-danger');
                    document.getElementById('option2').classList.add('btn-secondary');
                }
            });

            option2.addEventListener('change', function() {
                if (this.checked) {
                    console.log('cek2')
                    document.getElementById('option2').classList.remove('btn-secondary');
                    document.getElementById('option2').classList.add('btn-danger');
                    document.getElementById('option1').classList.remove('btn-danger');
                    document.getElementById('option1').classList.add('btn-secondary');
                }
            });

            //update total harga
            document.addEventListener('livewire:load', function() {
                Livewire.on('updateCartQuantity', (productId, quantity) => {
                    document.querySelector(`#quantity-${productId}`).value = quantity;
                });
            });
        </script>
    @endpush
</div>
