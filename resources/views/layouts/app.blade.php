<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

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
                    <div class="col-md-2">
                        <span class="text-uppercase">
                            Manajemen
                        </span>
                        <hr class="mt-0">

                        @can(\App\Providers\AuthServiceProvider::ACTION_VIEW_ANY, \App\TempatPenyewaan::class)
                            <a href="{{ route("tempat-penyewaan.index") }}">
                                Tempat Penyewaan
                            </a>
                        @endcan

                        @can(\App\Providers\AuthServiceProvider::ACTION_MANAGE_TEMPAT_PENYEWAAN_PROFILE)
                            <a href="{{ route("tempat-penyewaan-profile-management") }}">
                                Manajemen Profil
                            </a>
                        @endcan

                        @can(\App\Providers\AuthServiceProvider::ACTION_MANAGE_PENYEWA_PROFILE)
                            <a href="{{ route("penyewa-profile-management") }}">
                                Manajemen Profil
                            </a>
                        @endcan
                    </div>

                    <div class="col-md-10">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>

    @livewireScripts
</body>
</html>
