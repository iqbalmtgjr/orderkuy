@include('layouts.user.header')
@include('layouts.user.navbar')

<main>
    <section class="sample-page mt-2">
        <div class="container" data-aos="fade-up">
            {{ $slot }}
        </div>
    </section>
</main>
@include('layouts.user.footer')
