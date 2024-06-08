@extends('layouts.app')

@section('styles')

        <!--SWEET ALERT CSS-->
		<link href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet" />

@endsection

@section('content')

						<!-- PAGE-HEADER -->
						<div class="page-header">
							<div>
								<h1 class="page-title">Sweet Alert</h1>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Components</a></li>
									<li class="breadcrumb-item active" aria-current="page">Sweet Alert</li>
								</ol>
							</div>
							<div class="ms-auto pageheader-btn">
								<a href="#" class="btn btn-primary btn-icon text-white me-2">
									<span>
										<i class="fe fe-plus"></i>
									</span> Add Account
								</a>
								<a href="#" class="btn btn-success btn-icon text-white">
									<span>
										<i class="fe fe-log-in"></i>
									</span> Export
								</a>
							</div>
						</div>
						<!-- PAGE-HEADER END -->

						<!-- Row -->
						<div class="row">
							<div class="col-sm-12">
								<div class="card">
									<div class="card-header border-bottom-0">
										<h3 class="card-title">Sample Sweet Alerts</h3>
									</div>
									<div class="card-body">
										<input type='button' class="btn btn-success mt-2" value='success alert' id='click'>
										<input type='button' class="btn btn-warning mt-2" value='Warning alert' id='click1'>
										<input type='button' class="btn btn-danger mt-2" value='Danger alert' id='click2'>
										<input type='button' class="btn btn-info mt-2" value='Info alert' id='click3'>
									</div>
								</div>
								<div class="card">
									<div class="card-header border-bottom-0">
										<h3 class="card-title">Forms Sweet-alert</h3>
									</div>
									<div class="card-body">
										<div class="form-group">
											<label>Title</label>
											<input type='text' class="form-control" placeholder='Title text' id='title'>
										</div>
										<div class="form-group">
											<label>Message</label>
											<input type='text' class="form-control" placeholder='Your message' id='message'>
										</div>
										<input type='button' class="btn btn-primary mt-2" value='Simple alert' id='but1'>&nbsp;
										<input type='button' class="btn btn-secondary mt-2" value='Alert with title' id='but2'>&nbsp;
										<input type='button' class="btn btn-info mt-2" value='Alert with image' id='but3'>&nbsp;
										<input type='button' class="btn btn-warning mt-2" value='With timer' id='but4'>
									</div>
								</div>
							</div>
						</div>
						<!-- End Row -->

@endsection('content')

@section('scripts')

        <!-- SWEET-ALERT JS -->
		<script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
		<script src="{{ asset('assets/js/sweet-alert.js') }}"></script>

@endsection
