@extends('layouts.app')

@section('styles')

@endsection

@section('content')

						<!-- PAGE-HEADER -->
						<div class="page-header">
							<div>
								<h1 class="page-title">Alerts</h1>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Elements</a></li>
									<li class="breadcrumb-item active" aria-current="page">Alerts</li>
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

						
						<!-- ROW-1 OPEN -->
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Default alerts</h3>
									</div>
									<div class="card-body">
										<div class="text-wrap">
											<div class="example">
												<div class="alert alert-primary alert-dismissible fade show" role="alert">
													<span class="alert-inner--text">Primary alert—At vero eos et accusamus praesentium!</span>
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="alert alert-secondary alert-dismissible fade show" role="alert">
													<span class="alert-inner--text">Secondary alert—At vero eos et accusamus praesentium!</span>
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="alert alert-success alert-dismissible fade show" role="alert">
													<span class="alert-inner--text">Success alert—At vero eos et accusamus praesentium!</span>
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="alert alert-warning alert-dismissible fade show" role="alert">
													<span class="alert-inner--text">Warning alert—At vero eos et accusamus praesentium!</span>
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="alert alert-info alert-dismissible fade show" role="alert">
													<span class="alert-inner--text">Info alert—At vero eos et accusamus praesentium!</span>
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
													<span class="alert-inner--text">Danger alert—At vero eos et accusamus praesentium!</span>
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- COL END -->
						</div>
						<!-- ROW-1 CLOSED -->

						<!-- ROW-2 OPEN -->
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Links in alerts</h3>
									</div>
									<div class="card-body">
										<div class="text-wrap">
											<div class="example">
												<div class="alert alert-success alert-dismissible fade show" role="alert">
													<strong>Well done!</strong> You successfully read <a href="#" class="alert-link">this important alert message.</a>
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="alert alert-info alert-dismissible fade show" role="alert">
													<strong>Well done!</strong> You successfully read <a href="#" class="alert-link">this important alert message.</a>
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="alert alert-warning alert-dismissible fade show" role="alert">
													<strong>Warning! </strong> Better check yourself, you're <a href="#" class="alert-link">not looking too good.</a>
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="alert alert-danger alert-dismissible fade show" role="alert">
													<strong>Oh snap!</strong> <a href="#" class="alert-link">Change a few things up </a>and try submitting again.
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- COL END -->
						</div>
						<!-- ROW-2 CLOSED -->

						<!-- ROW-3 OPEN -->
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Alert with icon</h3>
									</div>
									<div class="card-body">
										<div class="text-wrap">
											<p>Add <code class="highlighter-rouge">.alert-icon</code> class.</p>
											<div class="example">
												<div class="alert alert-success alert-dismissible fade show" role="alert">
													<i class="fa fa-check-circle-o me-2" aria-hidden="true"></i> Well done! You successfully read this important alert message.
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="alert alert-info alert-dismissible fade show" role="alert">
													<i class="fa fa-bell-o me-2" aria-hidden="true"></i>Heads up! This alert needs your attention, but it's not super important.
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="alert alert-warning alert-dismissible fade show" role="alert">
													<i class="fa fa-exclamation me-2" aria-hidden="true"></i> Warning! Better check yourself, you're not looking too good.
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="alert alert-danger alert-dismissible fade show" role="alert">
													<i class="fa fa-frown-o me-2" aria-hidden="true"></i>Oh snap!Change a few things up and try submitting again.
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- COL END -->
						</div>
						<!-- ROW-3 CLOSED -->

						<!-- ROW-4 OPEN -->
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Alert with avatar</h3>
									</div>
									<div class="card-body">
										<div class="text-wrap">
											<div class="example">
												<div class="alert alert-avatar alert-primary alert-dismissible">
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
													<span class="avatar brround cover-image" data-bs-image-src="{{ asset('assets/images/users/14.jpg')}}"></span>
													Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
												</div>
												<div class="alert alert-avatar  alert-success alert-dismissible">
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
													<span class="avatar brround cover-image" data-bs-image-src="{{ asset('assets/images/users/5.jpg')}}"></span>
													Lorem ipsum dolor sit amet, consectetur adipisicing elit.
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- COL END -->
						</div>
						<!-- ROW-4 CLOSED -->

						<!-- ROW-5 OPEN -->
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Alerts With Icons</h3>
									</div>
									<div class="card-body">
										<div class="text-wrap">
											<div class="example">
												<div class="alert alert-default" role="alert">
													<span class="alert-inner--icon"><i class="fe fe-download"></i></span>
													<span class="alert-inner--text"><strong>Default!</strong> This is a warning alert—check it out that has an icon too!</span>
												</div>
												<div class="alert alert-primary" role="alert">
													<span class="alert-inner--icon"><i class="fe fe-check-square"></i></span>
													<span class="alert-inner--text"><strong>Primary!</strong> This is a warning alert—check it out that has an icon too!</span>
												</div>
												<div class="alert alert-success" role="alert">
													<span class="alert-inner--icon"><i class="fe fe-thumbs-up"></i></span>
													<span class="alert-inner--text"><strong>Success!</strong> This is a warning alert—check it out that has an icon too!</span>
												</div>
												<div class="alert alert-info" role="alert">
													<span class="alert-inner--icon"><i class="fe fe-bell"></i></span>
													<span class="alert-inner--text"><strong>Info!</strong> This is a warning alert—check it out that has an icon too!</span>
												</div>
												<div class="alert alert-warning" role="alert">
													<span class="alert-inner--icon"><i class="fe fe-info"></i></span>
													<span class="alert-inner--text"><strong>Warning!</strong> This is a warning alert—check it out that has an icon too!</span>
												</div>
												<div class="alert alert-danger mb-0" role="alert">
													<span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
													<span class="alert-inner--text"><strong>Danger!</strong> This is a warning alert—check it out that has an icon too!</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header">
										<h3 class=" card-title mb-0">Alerts With Icons Dismissing</h3>
									</div>
									<div class="card-body">
										<div class="text-wrap">
											<div class="example">
												<div class="alert alert-default alert-dismissible fade show" role="alert">
													<span class="alert-inner--icon"><i class="fe fe-download"></i></span>
													<span class="alert-inner--text"><strong>Default!</strong> This is a default alert—check it out!</span>
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="alert alert-primary alert-dismissible fade show" role="alert">
													<span class="alert-inner--icon"><i class="fe fe-check-square"></i></span>
													<span class="alert-inner--text"><strong>Primary!</strong> This is a primary alert—check it out!</span>
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="alert alert-success alert-dismissible fade show" role="alert">
													<span class="alert-inner--icon"><i class="fe fe-thumbs-up"></i></span>
													<span class="alert-inner--text"><strong>Success!</strong> This is a success alert—check it out!</span>
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="alert alert-warning alert-dismissible fade show" role="alert">
													<span class="alert-inner--icon"><i class="fe fe-info"></i></span>
													<span class="alert-inner--text"><strong>Warning!</strong> This is a warning alert—check it out!</span>
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="alert alert-info alert-dismissible fade show" role="alert">
													<span class="alert-inner--icon"><i class="fe fe-bell"></i></span>
													<span class="alert-inner--text"><strong>Info!</strong> This is a info alert—check it out!</span>
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
													<span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
													<span class="alert-inner--text"><strong>Danger!</strong> This is a danger alert—check it out!</span>
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- COL END -->
						</div>
						<!-- ROW-5 CLOSED -->

						<!-- ROW-6 OPEN -->
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Alerts Popovers</h3>
									</div>
									<div class="card-body">
										<div class="text-wrap">
											<div class="example">
												<div class="row">
													<div class="col-xl-2 col-lg-4 col-md-6 mt-2 mb-2">
														<button type="button" class="btn btn-success d-grid" data-bs-container="body" data-bs-toggle="popover" data-bs-popover-color="popsuccess" data-bs-placement="bottom" title="alert sucess" data-bs-content="Well done! You successfully read this important alert message..">
															Show success
														</button>
													</div>
													<div class="col-xl-2 col-lg-4 col-md-6 mt-2 mb-2">
														<button type="button" class="btn btn-info d-grid" data-bs-container="body" data-bs-toggle="popover" data-bs-popover-color="popinfo" data-bs-placement="top" title="alert info" data-bs-content="Heads up! This alert needs your attention, but it's not super important...">
															Show info
														</button>
													</div>
													<div class="col-xl-2 col-lg-4 col-md-6 mt-2 mb-2">
														<button type="button" class="btn d-grid btn-warning" data-bs-container="body" data-bs-toggle="popover" data-bs-popover-color="popwarning" data-bs-placement="bottom" title="alert warning" data-bs-content="Warning! Best check yo self, you're not looking too good..">
															Show warning
														</button>
													</div>

													<div class="col-xl-2 col-lg-4 col-md-6 mt-2 mb-2">
														<button type="button" class="btn d-grid btn-danger" data-bs-container="body" data-bs-toggle="popover" data-bs-popover-color="popdanger" data-bs-placement="bottom" title="alert danger" data-bs-content="Oh snap! Change a few things up and try submitting again.">
															Show danger
														</button>
													</div>
													<div class="col-xl-2 col-lg-4 col-md-6 mt-2 mb-2">
														<button type="button" class="btn d-grid btn-secondary" data-bs-container="body" data-bs-toggle="popover" data-bs-popover-color="popsecondary" data-bs-placement="top" title="alert secondary" data-bs-content="Error! Please Check u r emial id..">
															Show secondary
														</button>
													</div>
													<div class="col-xl-2 col-lg-4 col-md-6 mt-2 mb-2">
														<button type="button" class="btn d-grid btn-primary" data-bs-container="body"  data-bs-toggle="popover" data-bs-popover-color="pop-primary" data-bs-placement="top" title="alert primary" data-bs-content="Cool! This alert will close in 3 seconds. The data-bs-delay attribute is in milliseconds.">
															Show primary
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- COL END -->
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Alerts style</h3>
									</div>
									<div class="card-body">
										<div class="text-wrap mb-4">
											<div class="example">
												<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
													<strong>Success Message</strong>
													<hr class="message-inner-separator">
													<p>You successfully read this important alert message.</p>
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
											</div>
										</div>
										<div class="text-wrap mb-4">
											<div class="example">
												<div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
													<strong>Info Message</strong>
													<hr class="message-inner-separator">
													<p>This alert needs your attention, but it's not super important.</p>
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
											    </div>
											</div>
										</div>
										<div class="text-wrap mb-4">
											<div class="example">
												<div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
													<strong>Warning Message</strong>
													<hr class="message-inner-separator">
													<p>Best check yo self, you're not looking too good</p>
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
											    </div>
											</div>
										</div>
										<div class="text-wrap">
											<div class="example">
												<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
													<strong>Danger Message</strong>
													<hr class="message-inner-separator">
													<p>Change a few things up and try submitting again.</p>
													<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
											    </div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- COL END -->
						</div>
						<!-- ROW-6 CLOSED -->

@endsection('content')

@section('scripts')

		<!-- SPARKLINE JS -->
		<script src="{{ asset('assets/js/jquery.sparkline.min.js')}}"></script>
		
		<!-- C3 CHART JS -->
		<script src="{{ asset('assets/plugins/charts-c3/d3.v5.min.js')}}"></script>
		<script src="{{ asset('assets/plugins/charts-c3/c3-chart.js')}}"></script>
</html>

@endsection
