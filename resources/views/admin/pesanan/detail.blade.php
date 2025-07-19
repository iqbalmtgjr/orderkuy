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
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header bg-primary">
                    <h3 class="card-title text-white">Detail Pesanan</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama Menu</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($order->carts as $item)
                                <tr>
                                    <td>{{ $item->menu->nama_produk }}</td>
                                    <td>Rp{{ number_format($item->harga) }}</td>
                                    <td class="text-center">{{ $item->qty }}</td>
                                    <td class="text-right">Rp{{ number_format($item->harga * $item->qty) }}</td>
                                </tr>
                                @php
                                    $total += $item->harga * $item->qty;
                                @endphp
                            @endforeach
                            <tr class="bg-gray-200">
                                <th colspan="3" class="text-right">Total</th>
                                <th class="text-right">Rp{{ number_format($total) }}</th>
                            </tr>
                        </tbody>
                    </table>
                    <tr>
                        <td colspan="4" class="text-right">
                            <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </td>
                    </tr>

                </div>
            </div>
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
