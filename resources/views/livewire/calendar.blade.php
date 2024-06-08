@extends('layouts.app')

@section('styles')

		<!-- CALENDAR CSS -->
		<link href="{{ asset('assets/plugins/calendar/clndr.css') }}" rel="stylesheet"/>

@endsection

@section('content')

						<!-- PAGE-HEADER -->
						<div class="page-header">
							<div>
								<h1 class="page-title">Default Calender</h1>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Components</a></li>
									<li class="breadcrumb-item active" aria-current="page">Default Calender</li>
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

						<!-- ROW OPEN-->
						<div class="">
							<div class="card">
								<div class="card-body">
									<div class="cal1"></div>
								</div>
							</div>
						</div>
						<!-- ROW CLOSE-->

@endsection('content')

@section('scripts')

		<!-- DEFAULT CALENDAR JS-->
		<script src="{{ asset('assets/plugins/calendar/underscore-min.js')}}"></script>
		<script src="{{ asset('assets/plugins/calendar/moment.js')}}"></script>
		<script src="{{ asset('assets/plugins/calendar/clndr.js')}}"></script>
		<script src="{{ asset('assets/plugins/calendar/demo.js')}}"></script>

@endsection
