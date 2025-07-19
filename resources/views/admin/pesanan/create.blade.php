@extends('layouts.admin.app')
@section('header')
    {{-- Datatables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" type="text/css">
    <style>
        .qty-input {
            width: 60px;
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="row px-5">
        {{-- kiri: Daftar Menu --}}
        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">Daftar Menu</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Cari Menu..." wire:model="searchTerm">
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Menu</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Qty</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                                <tr data-id="{{ $menu->id }}" data-nama_produk="{{ $menu->nama_produk }}"
                                    data-harga="{{ $menu->harga }}" data-stok="{{ $menu->qty }}"> {{-- Simpan stok asli di data attribute --}}
                                    {{-- <td>
                                        @if ($menu->foto)
                                            <img src="{{ asset('assets/img/menu/' . $menu->foto) }}" alt="Foto"
                                                width="60" class="img-thumbnail">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td> --}}
                                    <td>{{ $menu->nama_produk }}</td>
                                    <td>Rp{{ number_format($menu->harga) }}</td>
                                    <td>{{ $menu->qty }}</td>
                                    <td width="100">
                                        <input type="number" min="1" class="form-control qty-input" value="1">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary btn-add"><i
                                                class="fa fa-plus text-white"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- kanan: Form Pemesanan --}}
        <div class="col-md-4">
            <form action="{{ route('pesanan.store') }}" method="POST" id="formPesanan">
                @csrf
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">Form Pesanan</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Pilih Meja</label>
                            <select name="meja_id" class="form-control">
                                <option value="">-- Pilih Meja --</option>
                                @foreach ($mejas as $meja)
                                    <option value="{{ $meja->id }}">Meja Nomor {{ $meja->no_meja }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Catatan Umum</label>
                            <textarea name="catatan" class="form-control" rows="2" placeholder="Catatan umum pesanan..."></textarea>
                        </div>

                        <hr>
                        <h4>Item yang Dipilih</h4>
                        <div id="selectedItems"></div>

                        <div class="mt-4 d-flex justify-content-end text-right">
                            <div>
                                <div><strong>Total Item:</strong> <span id="totalItem">0</span></div>
                                <div><strong>Total Harga:</strong> Rp <span id="totalHarga">0</span></div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4 justify-content-end text-right">Simpan
                            Pesanan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('footer')
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src={{ asset('admin/plugins/global/plugins.bundle.js') }}></script>
    <script src={{ asset('admin/plugins/custom/prismjs/prismjs.bundle.js') }}></script>
    <script src={{ asset('admin/js/scripts.bundle.js') }}></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Vendors(used by this page)-->
    <script src={{ asset('admin/plugins/custom/datatables/datatables.bundle.js') }}></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src={{ asset('admin/js/pages/crud/datatables/basic/basic.js') }}></script>
    <!--end::Page Scripts-->
    {{-- Datatables --}}
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        let selectedMenus = {};

        function updateDisplay() {
            let totalItem = 0;
            let totalHarga = 0;
            let html = '';

            // Update stok sisa di tabel berdasarkan stok asli dikurangi qty yang sudah dipilih
            $('tbody tr').each(function() {
                let id = $(this).data('id');
                let stokAsli = parseInt($(this).data('stok')) || 0;
                let qtyDipilih = selectedMenus[id] ? selectedMenus[id].qty : 0;

                let stokTersisa = stokAsli - qtyDipilih;
                $(this).find('td').eq(2).text(stokTersisa);
            });

            // Tampilkan item yang sudah dipilih di form
            Object.keys(selectedMenus).forEach(id => {
                let item = selectedMenus[id];
                totalItem += item.qty;
                totalHarga += item.qty * item.harga;

                html += `
<div class="border p-2 mb-3 mt-3 rounded bg-light d-flex justify-content-between align-items-center" data-id="${id}">
<input type="hidden" name="menu_id[]" value="${id}">
<input type="hidden" name="qty[]" value="${item.qty}">
<div><strong>${item.nama_produk}</strong> - Rp${item.harga.toLocaleString()} x ${item.qty}</div>
<button type="button" class="btn btn-sm btn-danger text-white btn-remove">
    <i class="fa fa-minus"></i>
</button>
</div>`;
            });

            $('#selectedItems').html(html);
            $('#totalItem').text(totalItem);
            $('#totalHarga').text(totalHarga.toLocaleString());
        }

        // Tambah item ke pesanan
        $(document).on('click', '.btn-add', function() {
            let row = $(this).closest('tr');
            let id = row.data('id');
            let nama_produk = row.data('nama_produk');
            let harga = parseInt(row.data('harga')) || 0;
            let stokAsli = parseInt(row.data('stok')) || 0;
            let qtyInput = parseInt(row.find('.qty-input').val()) || 1;

            // Hitung stok yang sudah dipilih
            let qtyDipilih = selectedMenus[id] ? selectedMenus[id].qty : 0;
            let stokTersisa = stokAsli - qtyDipilih;

            if (qtyInput > stokTersisa) {
                alert('Stok tidak cukup! Sisa stok: ' + stokTersisa);
                return;
            }

            if (selectedMenus[id]) {
                selectedMenus[id].qty += qtyInput;
            } else {
                selectedMenus[id] = {
                    nama_produk,
                    harga,
                    qty: qtyInput
                };
            }

            updateDisplay();

            // Reset input qty ke 1
            row.find('.qty-input').val(1);
        });

        // Hapus item dari pesanan
        $(document).on('click', '.btn-remove', function() {
            let id = $(this).closest('[data-id]').data('id');

            if (selectedMenus[id]) {
                delete selectedMenus[id];
                updateDisplay();
            }
        });
    </script>
@endsection
