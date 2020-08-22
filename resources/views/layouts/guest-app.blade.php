<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no"
    >
    <meta name="description"
          content=""
    >
    <meta name="author"
          content=""
    >

    <title> {{ config("app.name") }} </title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset("css/app.css") }}"
          rel="stylesheet"
    >
    <link href="{{ asset("css/landing-page.js") }}"
          rel="stylesheet"
    >
    @livewireStyles
</head>

<body>

<!-- Navigation -->
@include('navbar-guest')

@yield("content")

<footer class="footer bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
                {{--                <ul class="list-inline mb-2">--}}
                {{--                    <li class="list-inline-item">--}}
                {{--                        <a href="#">About</a>--}}
                {{--                    </li>--}}
                {{--                    <li class="list-inline-item">&sdot;</li>--}}
                {{--                    <li class="list-inline-item">--}}
                {{--                        <a href="#">Contact</a>--}}
                {{--                    </li>--}}
                {{--                    <li class="list-inline-item">&sdot;</li>--}}
                {{--                    <li class="list-inline-item">--}}
                {{--                        <a href="#">Terms of Use</a>--}}
                {{--                    </li>--}}
                {{--                    <li class="list-inline-item">&sdot;</li>--}}
                {{--                    <li class="list-inline-item">--}}
                {{--                        <a href="#">Privacy Policy</a>--}}
                {{--                    </li>--}}
                {{--                </ul>--}}
{{--                <p class="text-muted small mb-4 mb-lg-0">&copy; {{ config("app.name") }} {{ now()->format("Y") }}. All--}}
{{--                    Rights Reserved.</p>--}}
{{--            </div>--}}
{{--            <div class="col-lg-6 h-100 text-center text-lg-right my-auto">--}}
{{--                <ul class="list-inline mb-0">--}}
{{--                    <li class="list-inline-item mr-3">--}}
{{--                        <a href="#">--}}
{{--                            <i class="fab fa-facebook fa-2x fa-fw"></i>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="list-inline-item mr-3">--}}
{{--                        <a href="#">--}}
{{--                            <i class="fab fa-twitter-square fa-2x fa-fw"></i>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="list-inline-item">--}}
{{--                        <a href="#">--}}
{{--                            <i class="fab fa-instagram fa-2x fa-fw"></i>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
@livewireScripts
<script src="{{ asset("js/app.js") }}"></script>

</body>
</html>