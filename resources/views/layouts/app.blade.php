<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>
<body>
    <div id="app">
        @include("navbar")

        <main class="py-4">
            <div class="container">
                <div class="row">
                    @auth
                        <div class="col-md-2">
                            @include('shared.sidebar')
                        </div>
                    @endauth

                    <div class="@auth col-md-10 @else col-md-12 @endauth">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>

    @livewireScripts

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
