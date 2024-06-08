<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Admin & Dashboard">
    <meta name="author" content="Neophron Technologies Private Limited">
    <meta name="keywords" content="admin, admin dashboard,">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="base_url" content="{{ url('/') }}" />
    <!-- TITLE -->
    <title>Login</title>
    @include('layouts.custom-styles')

</head>

<body class="error-bg">

    @yield('class')

    <!-- GLOBAL-LOADER -->
    {{-- <div id="global-loader">
        <img src="{{ asset('assets/images/loader.svg') }}" class="loader-img" alt="Loader">
    </div> --}}
    <!-- End GLOBAL-LOADER -->

    @yield('content')

    @include('layouts.custom-scripts')

    </div>

</body>

</html>
