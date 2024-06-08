@extends('layouts.custom-app')

@section('custom-styles')
    <!-- SINGLE-PAGE CSS -->
    <link href="{{ asset('assets/plugins/single-page/css/main.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('class')
    <div class="login-img">
    @endsection

    @section('content')
        <!-- PAGE -->
        <div class="page">
            <div class="">
                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto">
                    <div class="text-center">
                        {{-- <img src="{{ asset('assets/images/neo_logo_new.jpeg') }}" class="header-brand-img" alt=""> --}}
                    </div>
                </div>
                <div class="container-login100">
                    <div class="wrap-login100 p-0">
                        <div class="card-body">
                            <div id="login_err" class="pb-2"></div>
                            <form id="login_form" class="login100-form validate-form p-2">
                                @csrf
                                @method('POST')
                                <span class="login100-form-title">
                                    <img src="{{ asset('assets/images/neophron_log_1.png') }}" class="header-brand-img"
                                        alt="">
                                </span>
                                <span class="login100-form-title">
                                    Login
                                </span>
                                <div class="wrap-input100 validate-input"
                                    data-bs-validate = "Valid email is required: ex@abc.xyz">
                                    <input type="hidden" id="url" value="{{ route('admin_login') }}">
                                    <input class="input100" type="text" name="email" placeholder="Email">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="zmdi zmdi-email" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <span class="text-danger email"></span>
                                <div class="wrap-input100 validate-input mt-2" data-bs-validate = "Password is required">
                                    <input class="input100" type="password" name="password" placeholder="Password">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <span class="text-danger password"></span>
                                <div class="text-end pt-1">
                                    <p class="mb-0"><a href="#" class="text-primary ms-1">Forgot Password?</a></p>
                                </div>
                                <div class="container-login100-form-btn">
                                    <button type="submit" class="login100-form-btn btn-primary">
                                        Login
                                    </button>
                                </div>
                                <div class="text-center pt-3">
                                    {{-- <p class="text-dark mb-0">Not a member?<a href="{{ url('register') }}"
                                            class="text-primary ms-1">Create an Account</a></p> --}}
                                </div>
                            </form>
                        </div>
                        <div class="card-footer" style="border:none;">
                            {{-- <div class="d-flex justify-content-center my-3">
                                <a href="" class="social-login  text-center me-4">
                                    <i class="fa fa-google"></i>
                                </a>
                                <a href="" class="social-login  text-center me-4">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="" class="social-login  text-center">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->
    @endsection('content')

    @section('custom-scripts')
    @endsection
