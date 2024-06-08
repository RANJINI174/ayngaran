@extends('layouts.custom-app')

@section('styles')

@endsection

@section('content')

		<!-- PAGE -->
		<div class="page">
			<!-- PAGE-CONTENT OPEN -->
			 <div class="page-content error-page error2">
				 <div class="container text-center">
					 <div class="error-template">
						 <h1 class="display-1 text-dark mb-2">400<span class="fs-20">error</span></h1>
						 <h5 class="error-details text-dark">
							 Sorry, an error has occured, Requested page not found!
						 </h5>
						 <div class="text-center">
							 <a class="btn btn-primary mt-5 mb-5" href="{{url('index')}}"> <i class="fa fa-long-arrow-left"></i> Back to Home </a>
						 </div>
					 </div>
				 </div>
			 </div>
			 <!-- PAGE-CONTENT OPEN CLOSED -->
		 </div>
		 <!-- End PAGE -->

@endsection('content')

@section('scripts')

@endsection
