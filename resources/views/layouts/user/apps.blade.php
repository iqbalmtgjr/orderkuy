@include('layouts.user.header')
@include('layouts.user.navbar')

<main>
    <section class="sample-page mt-2">
        <div class="container" data-aos="fade-up">
            @yield('content')
        </div>
    </section>
</main>
@include('layouts.user.footer')
