<!doctype html>
<html lang="en" dir="ltr">
	<head>

		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Zanex – Laravel Admin & Dashboard Template">
		<meta name="author" content="Spruko Technologies Private Limited">
		<meta name="keywords" content="admin, admin dashboard template, bootstrap 5, dashboard, laravel, laravel admin, laravel admin panel, laravel admin template, laravel blade, laravel dashboard, laravel dashboard template, laravel mvc, laravel php, laravel ui template, ui kit">

        <!-- TITLE -->
        <title>Zanex – Laravel Admin & Dashboard Template </title>

        @include('layouts.horizontal.styles')

	</head>

	<body class="dark-mode">

		<!-- GLOBAL-LOADER -->
		<div id="global-loader">
			<img src="{{ asset('assets/images/loader.svg') }}" class="loader-img" alt="Loader">
		</div>
		<!-- /GLOBAL-LOADER -->

		<!-- PAGE -->
		<div class="page">
			<div class="page-main">


            @include('layouts.horizontal.header')
           

            @include('layouts.horizontal.mobile-header')
            
           
            @include('layouts.horizontal.main')
           

                <!--app-content open-->
				<div class="app-content hor-content">
					<div class="container">

                        @yield('content')

					</div>
				</div>
				<!-- CONTAINER END -->
            </div>

            @include('layouts.sidebar-right')

            @include('layouts.footer')
			
            @yield('modal')

		</div>

        @include('layouts.horizontal.scripts')

	</body>
</html>