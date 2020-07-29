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
        <link href="{{ asset('assets/css/summernote-bs4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/morris.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="/js/plugins.js"></script>
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
            @yield('content')
        </div>


        @switch (true)
        @case (Request::is('activities/campaign/*'))
        <script src="{{ mix('js/activity-app.js') }}"></script>
        @break
        @case (Request::is('reporting'))
        <script src="{{ mix('js/reporting-app.js') }}"></script>
        @break
        @case (Request::is('lead*'))
        <script src="{{ mix('js/create-lead-app.js') }}"></script>
        @break
        @case (Request::is('settings'))
        <script src="{{ mix('js/settings-app.js') }}"></script>
        @break
        @case (Request::is('admin*'))
        <script src="{{ mix('js/admin-app.js') }}"></script>
        @break
        @endswitch
        @include('layouts.flash-swal')
    </body>

</html>
