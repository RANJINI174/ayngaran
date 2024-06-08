<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="base_url" content="{{ url('/') }}" />
    <meta name="description" content="Neophron Technologies">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="admin, admin dashboard template, bootstrap 5, dashboard, laravel, laravel admin, laravel admin panel, laravel admin template, laravel blade, laravel dashboard, laravel dashboard template, laravel mvc, laravel php, laravel ui template, ui kit">

    <!-- TITLE -->
    <title>Ayngaran</title>

    @include('layouts.vertical.styles')

</head>

<body class="app sidebar-mini">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="{{ asset('assets/images/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            @include('layouts.vertical.app-sidebar')

            @include('layouts.vertical.mobile-header')

            <!--app-content open-->
            <div class="app-content">
                <div class="side-app">

                    @yield('content')

                </div>
            </div>
            <!-- CONTAINER END -->
        </div>

        @include('layouts.sidebar-right')

        @include('layouts.footer')

        @yield('modal')

    </div>

    @include('layouts.vertical.scripts')

</body>

</html>
