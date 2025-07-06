<div>
    <div class="row">
        {{-- Kolom Form Pesanan --}}
        <div class="col-md-6">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">Form Pesanan</h3>
                </div>
                <div class="card-body">
                    @if (session()->has('gagal'))
                        <div class="alert alert-danger">{{ session('gagal') }}</div>
                    @endif
                    @if (session()->has('sukses'))
                        <div class="alert alert-success">{{ session('sukses') }}</div>
                    @endif

                    <div class="form-group">
                        <label>Pilih Meja</label>
                        <select wire:model="meja_id" class="form-control">
                            <option value="">-- Pilih Meja --</option>
                            @foreach ($mejas as $meja)
                                <option value="{{ $meja->id }}">Meja Nomor {{ $meja->no_meja }}</option>
                            @endforeach
                        </select>
                        @error('meja_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Catatan Umum</label>
                        <textarea wire:model="catatan" class="form-control" rows="2" placeholder="Catatan umum pesanan..."></textarea>
                    </div>

                    <button wire:click.prevent="store" class="btn btn-primary">Simpan Pesanan</button>
                </div>
            </div>
        </div>

        {{-- Kolom Daftar Menu --}}
        <div class="col-md-6">
            <div class="card card-custom">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Daftar Menu</h3>
                    <button wire:click="addItem" class="btn btn-sm btn-success">+ Tambah Item</button>
                </div>
                <div class="card-body">
                    @foreach ($items as $index => $item)
                        <div class="border rounded p-3 mb-3">
                            <div class="form-group">
                                <label>Pilih Menu</label>
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>Nama Menu</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Pilih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($menus as $menu)
                                            <tr>
                                                <td>{{ $menu->nama }}</td>
                                                <td>Rp{{ number_format($menu->harga) }}</td>
                                                <td>{{ $menu->stok }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        wire:click="pilihMenu({{ $index }}, {{ $menu->id }})">
                                                        Pilih
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if ($items[$index]['menu_id'])
                                    <p><strong>Menu Terpilih:</strong>
                                        {{ $menus->firstWhere('id', $items[$index]['menu_id'])?->nama ?? 'Tidak ditemukan' }}
                                    </p>
                                @endif
                                @error("items.$index.menu_id")
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group d-flex align-items-center">
                                <label class="mr-3 mb-0">Qty</label>
                                <button wire:click="decrementQty({{ $index }})" type="button"
                                    class="btn btn-sm btn-light mr-2">-</button>
                                <input type="text" class="form-control text-center mr-2" style="width: 60px;"
                                    wire:model="items.{{ $index }}.qty" readonly>
                                <button wire:click="incrementQty({{ $index }})" type="button"
                                    class="btn btn-sm btn-light">+</button>
                                @error("items.$index.qty")
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Catatan Item</label>
                                <textarea wire:model="items.{{ $index }}.catatan_item" class="form-control" rows="1"
                                    placeholder="Catatan khusus menu ini..."></textarea>
                            </div>

                            <button wire:click="removeItem({{ $index }})" type="button"
                                class="btn btn-sm btn-danger">Hapus Item</button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
