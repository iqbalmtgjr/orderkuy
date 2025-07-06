@extends('layouts.admin.app')
@section('header')
    {{-- Datatables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" type="text/css">
@endsection
@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">Data Pesanan {{ auth()->user()->admin->toko->nama_toko }}
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="{{ route('pesanan.create') }}" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                        <path
                                            d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z"
                                            fill="#000000" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            Tambah Pesanan
                        </a>
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <div class="row gy-5 py-3">
                        @foreach ($data as $user_id => $orders)
                            @foreach ($orders as $order)
                                <div class="col-md-4">
                                    <div class="card shadow-sm mt-5 mb-5" style="width: 100%;">
                                        <div
                                            class="card-header text-white bg-primary d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5 class="card-title mb-0">Meja {{ $order->meja->no_meja }}</h5>
                                                <small
                                                    class="text-white-50">{{ date('Y-m-d H:i', strtotime($order->created_at)) }}</small>
                                            </div>
                                            <div class="card-toolbar">
                                                <a href="{{ route('pesanan.show', $order->id) }}"
                                                    class="btn btn-sm btn-light btn-icon" title="Detail">
                                                    <i class="la la-eye"></i>
                                                </a>
                                                <a href="{{ route('pesanan.edit', $order->id) }}"
                                                    class="btn btn-sm btn-light btn-icon" title="Edit">
                                                    <i class="la la-edit"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                @foreach ($order->carts as $key => $cart)
                                                    <li class="list-group-item">
                                                        <strong>{{ $key + 1 }}. Menu:</strong>
                                                        {{ $cart->menu->nama_produk ?? '-' }}<br>
                                                        <strong>Jumlah:</strong> {{ $cart->qty }}<br>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <hr>
                                            <strong>Catatan:</strong> {{ $order->catatan ?? '-' }}<br>
                                            <strong>Total Bayar:</strong>
                                            Rp{{ number_format($order->bill->total_bayar ?? 0, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
    {{-- @include('admin/meja/modaltambah')
    @include('admin/meja/modaledit') --}}
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
        $('.data-table').on('click', '.delete', function() {
            let data = $(this).data()
            let Id = data.id
            let Nama = data.nama
            // console.log(Id);
            Swal.fire({
                    title: 'Yakin?',
                    text: "Mau Hapus Meja Nomor " + Nama + "?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                })
                .then((result) => {
                    console.log(result);
                    if (result.value) {
                        window.location = `{{ url('/meja/hapus/') }}/${Id}`;
                    }
                });
        })

        $(function() {
            var table = $('.data-table').DataTable({
                // responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ url('/kelola_meja') }}",
                columns: [{
                        // data: 'id',
                        // name: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'no_meja',
                        name: 'no_meja'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                    }
                ],
                order: [
                    [0, "desc"]
                ]
            });
        });
    </script>
@endsection
