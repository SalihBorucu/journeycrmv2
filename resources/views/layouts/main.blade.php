<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Journey CRM</title>
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body>
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="rect1"></div>
                    <div class="rect2"></div>
                    <div class="rect3"></div>
                    <div class="rect4"></div>
                    <div class="rect5"></div>
                </div>
            </div>
        </div>
        @include('layouts.nav-bar')
        <div class="wrapper">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

        <script src="/js/plugins.js"></script>
        <script src="{{ mix('js/app.js') }}"></script>
        {{-- @switch (true)
        @case (Request::is('spot/create') || Request::is('spot/*/portal'))
        <script src="{{ mix('js/spot-model-portal-app.js') }}"></script>
        @break
        @case (Request::is('spot/*'))
        <script src="{{ mix('js/spot-app.js') }}"></script>
        @break
        @case (Request::is('oldspot') || Request::is('oldspot/*'))
        <script src="{{ mix('js/old-spot-app.js') }}"></script>
        @break
        @case (Request::is('target-earth-model') || Request::is('target-earth-model/*'))
        <script src="{{ mix('js/target-earth-model-app.js') }}"></script>
        @break
        @case (Request::is('lv-model') || Request::is('lv-model/*'))
        <script src="{{ mix('js/lv-model-app.js') }}"></script>
        @break
        @endswitch --}}
    </body>

</html>
