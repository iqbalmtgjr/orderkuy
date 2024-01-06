@include('layouts.user.header')
@include('layouts.user.navbar')
<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container my-5 py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <img class="mx-auto mb-3" width="150px" src="{{ asset('assets/img/logo.png') }}" alt="logo">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Mau makan apa hari ini?"
                        aria-label="Search">
                    <button style="background-color: #ce1212;" class="btn btn-danger" type="submit">Cari</button>
                </form>
            </div>
        </div>
    </div>
</section><!-- End Hero Section -->

<main id="main">
    <!-- ======= Book A Table Section ======= -->
    <section id="book-a-table" class="book-a-table">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Pesan Tempat Duduk</h2>
                <p>Pesan <span>Tempat Duduk Kalian</span> Dengan Kami</p>
            </div>

            <div class="row g-0">

                <div class="col-lg-4 reservation-img" style="background-image: url(assets/img/reservation.jpg);"
                    data-aos="zoom-out" data-aos-delay="200"></div>

                <div class="col-lg-8 d-flex align-items-center reservation-form-bg">
                    <form action="forms/book-a-table.php" method="post" role="form" class="php-email-form"
                        data-aos="fade-up" data-aos-delay="100">
                        <div class="row gy-4">
                            <div class="col-lg-4 col-md-6">
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Your Name" data-rule="minlen:4"
                                    data-msg="Please enter at least 4 chars">
                                <div class="validate"></div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email">
                                <div class="validate"></div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <input type="text" class="form-control" name="phone" id="phone"
                                    placeholder="Your Phone" data-rule="minlen:4"
                                    data-msg="Please enter at least 4 chars">
                                <div class="validate"></div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <input type="text" name="date" class="form-control" id="date"
                                    placeholder="Date" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                                <div class="validate"></div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <input type="text" class="form-control" name="time" id="time"
                                    placeholder="Time" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                                <div class="validate"></div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <input type="number" class="form-control" name="people" id="people"
                                    placeholder="# of people" data-rule="minlen:1"
                                    data-msg="Please enter at least 1 chars">
                                <div class="validate"></div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message"></textarea>
                            <div class="validate"></div>
                        </div>
                        <div class="mb-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your booking request was sent. We will call back or send an Email
                                to confirm your reservation. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Book a Table</button></div>
                    </form>
                </div><!-- End Reservation Form -->

            </div>

        </div>
    </section><!-- End Book A Table Section -->

</main><!-- End #main -->

@include('layouts.user.footer')
