@extends("layouts.guest-app")

@section("content")
    <!-- Masthead -->
    <header class="masthead text-white text-center"
            style="background: url('{{ asset("front.jpg") }}')"
    >
        <div class="overlay"></div>
        <div class="container">
            <div class="row mx-auto"
                 style="max-width: 600px"
            >
                @guest
                    <div class="col-12 mb-5">
                        <h1> ¡Regístrate ahora!</h1>
                    </div>

                    <div class="col-md-6">
                        <a href="{{ route("penyewa-registration") }}"
                           class="btn btn-block btn-lg btn-primary"
                        >
                            Registro de Clientes
                        </a>
                    </div>

                    <div class="col-md-6">
                        <a href="{{ route("tempat-penyewaan-registration") }}"
                           class="btn btn-block btn-lg btn-primary"
                        >
                        Registro de Canchitas
                        </a>
                    </div>
                @else
                    <div class="col-12 mb-5">
                        <h1> ¡Bienvenidos! </h1>
                    </div>
                @endguest

                <div class="col-md-12">
                    <livewire:front-page-search-tempat-penyewaan/>
                </div>

                <div class="col-md-12">
                    <a href="{{ route("guest-tempat-penyewaan-index") }}" class="btn btn-block btn-primary">
                        Todas las ubicaciones de alquiler
                        <i class="fas fa-list"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Icons Grid -->
    <section class="features-icons bg-light text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <div class="features-icons-icon d-flex">
                            <i class="icon-screen-desktop m-auto text-primary"></i>
                        </div>
                        <h3> Online </h3>
                        <p class="lead mb-0">
                            Se puede acceder en cualquier lugar y en cualquier momento
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <div class="features-icons-icon d-flex">
                            <i class="icon-layers m-auto text-primary"></i>
                        </div>
                        <h3> Fácil de usar </h3>
                        <p class="lead mb-0">
                            Sitio web <em>diseñado</em> de manera que se maximice la facilidad de uso
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                        <div class="features-icons-icon d-flex">
                            <i class="icon-check m-auto text-primary"></i>
                        </div>
                        <h3> Rápido </h3>
                        <p class="lead mb-0">
                            Acelere su proceso de <em>reserva</em>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center"
             id="app"
    >
        <div class="container">
            <h1 class="my-3"> Mapa de Distribución de las Canchas de Alquiler </h1>
        </div>

        <div class="bg-dark">
            <peta-welcome
                    :map_config='{{ json_encode(config('map')) }}'
                    :tempat_penyewaans='{{ json_encode($tempatPenyewaans) }}'
            ></peta-welcome>
        </div>
    </section>

        <!-- Image Showcases -->
        {{-- <section class="showcase">--}}
        {{--    <div class="container-fluid p-0">--}}
        {{--        <div class="row">--}}

        {{--            <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('{{ asset('img/bg-showcase-1.jpg') }}');"></div>--}}
        {{--            <div class="col-lg-6 order-lg-1 my-auto showcase-text">--}}
        {{--                <h2>Fully Responsive Design</h2>--}}
        {{--                <p class="lead mb-0">When you use a theme created by Start Bootstrap, you know that the theme will look great on any device, whether it's a phone, tablet, or desktop the page will behave responsively!</p>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        <div class="row">--}}
        {{--            <div class="col-lg-6 text-white showcase-img" style="background-image: url('{{ asset('img/bg-showcase-2.jpg') }}');"></div>--}}
        {{--            <div class="col-lg-6 my-auto showcase-text">--}}
        {{--                <h2>Updated For Bootstrap 4</h2>--}}
        {{--                <p class="lead mb-0">Newly improved, and full of great utility classes, Bootstrap 4 is leading the way in mobile responsive web development! All of the themes on Start Bootstrap are now using Bootstrap 4!</p>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        <div class="row">--}}
        {{--            <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('{{ asset('img/bg-showcase-3.jpg') }}');"></div>--}}
        {{--            <div class="col-lg-6 order-lg-1 my-auto showcase-text">--}}
        {{--                <h2>Easy to Use &amp; Customize</h2>--}}
        {{--                <p class="lead mb-0">Landing Page is just HTML and CSS with a splash of SCSS for users who demand some deeper customization options. Out of the box, just add your content and images, and your new landing page will be ready to go!</p>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--    </div>--}}
        {{--</section>--}}

        {{--<!-- Testimonials -->--}}
        {{--<section class="testimonials text-center bg-light">--}}
        {{--    <div class="container">--}}
        {{--        <h2 class="mb-5">What people are saying...</h2>--}}
        {{--        <div class="row">--}}
        {{--            <div class="col-lg-4">--}}
        {{--                <div class="testimonial-item mx-auto mb-5 mb-lg-0">--}}
        {{--                    <img class="img-fluid rounded-circle mb-3" src="{{ asset("img/testimonials-1.jpg") }}" alt="">--}}
        {{--                    <h5>Margaret E.</h5>--}}
        {{--                    <p class="font-weight-light mb-0">"This is fantastic! Thanks so much guys!"</p>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <div class="col-lg-4">--}}
        {{--                <div class="testimonial-item mx-auto mb-5 mb-lg-0">--}}
        {{--                    <img class="img-fluid rounded-circle mb-3" src="{{ asset("img/testimonials-2.jpg") }}" alt="">--}}
        {{--                    <h5>Fred S.</h5>--}}
        {{--                    <p class="font-weight-light mb-0">"Bootstrap is amazing. I've been using it to create lots of super nice landing pages."</p>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <div class="col-lg-4">--}}
        {{--                <div class="testimonial-item mx-auto mb-5 mb-lg-0">--}}
        {{--                    <img class="img-fluid rounded-circle mb-3" src="{{ asset("img/testimonials-3.jpg") }}" alt="">--}}
        {{--                    <h5>Sarah W.</h5>--}}
        {{--                    <p class="font-weight-light mb-0">"Thanks so much for making these free resources available to us!"</p>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--    </div>--}}
        {{--</section>--}}

        <!-- Call to Action -->
        {{--<section class="call-to-action text-white text-center">--}}
        {{--    <div class="overlay"></div>--}}
        {{--    <div class="container">--}}
        {{--        <div class="row">--}}
        {{--            <div class="col-xl-9 mx-auto">--}}
        {{--                <h2 class="mb-4">Ready to get started? Sign up now!</h2>--}}
        {{--            </div>--}}
        {{--            <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">--}}
        {{--                <form>--}}
        {{--                    <div class="form-row">--}}
        {{--                        <div class="col-12 col-md-9 mb-2 mb-md-0">--}}
        {{--                            <input type="email" class="form-control form-control-lg" placeholder="Enter your email...">--}}
        {{--                        </div>--}}
        {{--                        <div class="col-12 col-md-3">--}}
        {{--                            <button type="submit" class="btn btn-block btn-lg btn-primary">Sign up!</button>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </form>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--    </div>--}}
        {{--</section> --}}

        <!-- Footer -->
@endsection