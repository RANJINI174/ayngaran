<!doctype html>
<html lang="en" dir="ltr">
	<head>

		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Zanex – Laravel Admin & Dashboard Template">
		<meta name="author" content="Spruko Technologies Private Limited">
		<meta name="keywords" content="aadmin, admin dashboard template, bootstrap 5, dashboard, laravel, laravel admin, laravel admin panel, laravel admin template, laravel blade, laravel dashboard, laravel dashboard template, laravel mvc, laravel php, laravel ui template, ui kit">

        <!-- TITLE -->
        <title>Zanex – Laravel Admin & Dashboard Template </title>

        @include('layouts.vertical.styles')

	</head>

	<body class="app sidebar-mini dark-mode">

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