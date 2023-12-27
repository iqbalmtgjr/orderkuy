@extends('layouts.admin.app')
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label">Dashboard
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non quibusdam temporibus consequatur
                            placeat iure explicabo deleniti tempora ad, error ea culpa reprehenderit ratione asperiores
                            delectus facere possimus suscipit ab facilis.</p>
                    </div>
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
@endsection
