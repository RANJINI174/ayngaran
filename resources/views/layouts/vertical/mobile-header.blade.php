    <!-- Mobile Header -->
    <div class="app-header header">
        <div class="container-fluid">
            <div class="d-flex">
                <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar"
                    href="#"></a><!-- sidebar-toggle-->
                <a class="header-brand1 d-flex d-md-none" href="{{ url('index') }}">
                    <img src="{{ asset('assets/images/ayngaran_logo_1.png') }}" class="header-brand-img desktop-logo"
                        alt="logo">
                    <img src="{{ asset('assets/images/ayngaran_logo_1.png') }}" class="header-brand-img toggle-logo"
                        alt="logo">
                    <img src="{{ asset('assets/images/ayngaran_logo_1.png') }}" class="header-brand-img light-logo"
                        alt="logo">
                    <img src="{{ asset('assets/images/ayngaran_logo_1.png') }}" class="header-brand-img light-logo1"
                        alt="logo">
                </a><!-- LOGO -->
                <?php
                 $current_date = date('d');
                 $current_month = date('m');

                $get_user = \App\Models\User::whereMonth('dob',$current_month)->whereDay('dob',$current_date)->where('status',1)->get();

                $get_wedding_user = \App\Models\User::whereMonth('wedding_date',$current_month)->whereDay('wedding_date',$current_date)->where('status',1)->get();

                $user_name = '';
                $user_name_1 = '';
                $user_name_con = '';
                $user_name_con_1 = '';
                ?>
                <marquee scrolldelay="200" style="font-size:15px !important;padding-top:5px !important"><img style="width:25px; height:15px" src="{{ asset('assets/images/cake_1.png') }}">Celebrating Birthday today &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                @if(isset($get_user))

                 <?php
                foreach($get_user as $user)
                {
                if($user_name)

                    {
                       $user_name_con = ' ,';
                    }

                    $user_name = $user->name;


                    echo $user_name.' ,';
                }


               ?>
                @endif<img src="{{ asset('assets/images/cake_2.png') }}" style="width:25px; height:15px">
                <br><img style="width:25px; height:15px" src="{{ asset('assets/images/part_1.png') }}">Celebrating Wedding day today &nbsp;:
                 @if(isset($get_wedding_user))
                <?php
                foreach($get_wedding_user as $user)
                {
                if($user_name_1)

                    {
                       $user_name_con_1 = ' ,';
                    }

                    $user_name_1 = $user->name;


                    echo $user_name_1.' ,';
                }


               ?>
                @endif<img style="width:25px; height:15px" src="{{ asset('assets/images/party_2.png') }}"></marquee>
                {{-- <div class="main-header-center ms-3 d-none d-md-block">
                    <input class="form-control" placeholder="Search for anything..." type="search"> <button
                        class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div> --}}
                <div class="d-flex order-lg-2 ms-auto header-right-icons">
                    <div class="dropdown d-lg-none d-md-block d-none">
                        <a href="#" class="nav-link icon" data-bs-toggle="dropdown">
                            <i class="fe fe-search"></i>
                        </a>
                        <div class="dropdown-menu header-search dropdown-menu-start">
                            <div class="input-group w-100 p-2">
                                <input type="text" class="form-control" placeholder="Search box....">
                                <div class="input-group-text btn btn-primary">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div><!-- SEARCH -->
                    <button class="navbar-toggler navresponsive-toggler d-md-none ms-auto" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                        aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon fe fe-more-vertical text-dark"></span>
                    </button>
                    <div class="dropdown d-none d-md-flex">
                        <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                            <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip"
                                title="Dark Theme"><i class="fe fe-moon"></i></span>
                            <span class="light-layout" data-bs-placement="bottom" data-bs-toggle="tooltip"
                                title="Light Theme"><i class="fe fe-sun"></i></span>
                        </a>
                    </div><!-- Theme-Layout -->
                    <div class="dropdown d-none d-md-flex">
                        <a class="nav-link icon full-screen-link nav-link-bg">
                            <i class="fe fe-minimize fullscreen-button"></i>
                        </a>
                    </div><!-- FULL-SCREEN -->
                    {{-- <div class="dropdown d-none d-md-flex notifications">
                        <a class="nav-link icon" data-bs-toggle="dropdown"><i class="fe fe-bell"></i><span
                                class=" pulse"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow ">
                            <div class="drop-heading border-bottom">
                                <div class="d-flex">
                                    <h6 class="mt-1 mb-0 fs-16 fw-semibold">You have Notification</h6>
                                    <div class="ms-auto">
                                        <span class="badge bg-success rounded-pill">3</span>
                                    </div>
                                </div>
                            </div>
                            <div class="notifications-menu">
                                <a class="dropdown-item d-flex" href="{{ url('chat') }}">
                                    <div class="me-3 notifyimg  bg-primary-gradient brround box-shadow-primary">
                                        <i class="fe fe-message-square"></i>
                                    </div>
                                    <div class="mt-1">
                                        <h5 class="notification-label mb-1">New review received</h5>
                                        <span class="notification-subtext">2 hours ago</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex" href="{{ url('chat') }}">
                                    <div class="me-3 notifyimg  bg-secondary-gradient brround box-shadow-primary">
                                        <i class="fe fe-mail"></i>
                                    </div>
                                    <div class="mt-1">
                                        <h5 class="notification-label mb-1">New Mails Received</h5>
                                        <span class="notification-subtext">1 week ago</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex" href="{{ url('cart') }}">
                                    <div class="me-3 notifyimg  bg-success-gradient brround box-shadow-primary">
                                        <i class="fe fe-shopping-cart"></i>
                                    </div>
                                    <div class="mt-1">
                                        <h5 class="notification-label mb-1">New Order Received</h5>
                                        <span class="notification-subtext">1 day ago</span>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-divider m-0"></div>
                            <a href="#" class="dropdown-item text-center p-3 text-muted">View all
                                Notification</a>
                        </div>
                    </div><!-- NOTIFICATIONS --> --}}
                    {{-- <div class="dropdown  d-none d-md-flex message">
                        <a class="nav-link icon text-center" data-bs-toggle="dropdown">
                            <i class="fe fe-message-square"></i><span class=" pulse-danger"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <div class="drop-heading border-bottom">
                                <div class="d-flex">
                                    <h6 class="mt-1 mb-0 fs-16 fw-semibold">You have Messages</h6>
                                    <div class="ms-auto">
                                        <span class="badge bg-danger rounded-pill">4</span>
                                    </div>
                                </div>
                            </div>
                            <div class="message-menu">
                                <a class="dropdown-item d-flex" href="{{ url('chat') }}">
                                    <span class="avatar avatar-md brround me-3 align-self-center cover-image"
                                        data-bs-image-src="{{ asset('') }}assets/images/users/1.jpg"></span>
                                    <div class="wd-90p">
                                        <div class="d-flex">
                                            <h5 class="mb-1">Madeleine</h5>
                                            <small class="text-muted ms-auto text-end">
                                                3 hours ago
                                            </small>
                                        </div>
                                        <span>Hey! there I' am available....</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex" href="{{ url('chat') }}">
                                    <span class="avatar avatar-md brround me-3 align-self-center cover-image"
                                        data-bs-image-src="{{ asset('assets/images/users/12.jpg') }}"></span>
                                    <div class="wd-90p">
                                        <div class="d-flex">
                                            <h5 class="mb-1">Anthony</h5>
                                            <small class="text-muted ms-auto text-end">
                                                5 hour ago
                                            </small>
                                        </div>
                                        <span>New product Launching...</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex" href="{{ url('chat') }}">
                                    <span class="avatar avatar-md brround me-3 align-self-center cover-image"
                                        data-bs-image-src="{{ asset('assets/images/users/4.jpg') }}"></span>
                                    <div class="wd-90p">
                                        <div class="d-flex">
                                            <h5 class="mb-1">Olivia</h5>
                                            <small class="text-muted ms-auto text-end">
                                                45 mintues ago
                                            </small>
                                        </div>
                                        <span>New Schedule Realease......</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex" href="{{ url('chat') }}">
                                    <span class="avatar avatar-md brround me-3 align-self-center cover-image"
                                        data-bs-image-src="{{ asset('assets/images/users/15.jpg') }}"></span>
                                    <div class="wd-90p">
                                        <div class="d-flex">
                                            <h5 class="mb-1">Sanderson</h5>
                                            <small class="text-muted ms-auto text-end">
                                                2 days ago
                                            </small>
                                        </div>
                                        <span>New Schedule Realease......</span>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-divider m-0"></div>
                            <a href="#" class="dropdown-item text-center p-3 text-muted">See all Messages</a>
                        </div>
                    </div><!-- MESSAGE-BOX --> --}}
                    <div class="dropdown d-none d-md-flex profile-1">
                        <a href="#" data-bs-toggle="dropdown" class="nav-link pe-2 leading-none d-flex">
                            <span>
                                <img src="{{ asset('assets/images/users/8.jpg') }}" alt="profile-user"
                                    class="avatar  profile-user brround cover-image">
                            </span>
                        </a>
                        <?php
                            // $user = \Illuminate\Support\Facades\Auth()->user();

                        ?>
                     @php
                        use Illuminate\Support\Facades\Auth;
                    @endphp

                    @php
                        $user_email = '';
                        $designation_nmme = '';

                        if (Auth::check()) {
                            $user_id =  Auth::user()->id;
                            $user_details = \App\Models\User::where('id',$user_id)->first();

                            if(!empty($user_details) && $user_details != null){
                              $user_email = $user_details->email;
                            }

                            if(!empty($user_details->designation_id) && $user_details->designation_id !=""){
                            $designation = \App\Models\Designation::where('id',$user_details->designation_id)->first();
                                if($designation->designation == "Marketing Managers"){
                                  $designation_nmme = "Marketing Manager";
                                }else{
                                  $designation_nmme = $designation->designation;
                                }
                            }
                        }
                    @endphp

                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <div class="drop-heading">
                                <div class="text-center">
                                    <h5 class="text-dark mb-0">{{$user_email}}</h5>
                                    <small class="text-muted">{{$designation_nmme}}</small>
                                </div>
                            </div>
                            <div class="dropdown-divider m-0"></div>
                            {{-- <a class="dropdown-item" href="{{ url('profile') }}">
                                <i class="dropdown-icon fe fe-user"></i> Profile
                            </a>
                            <a class="dropdown-item" href="{{ url('email') }}">
                                <i class="dropdown-icon fe fe-mail"></i> Inbox
                                <span class="badge bg-primary float-end">3</span>
                            </a>
                            <a class="dropdown-item" href="{{ url('emailservices') }}">
                                <i class="dropdown-icon fe fe-settings"></i> Settings
                            </a>
                            <a class="dropdown-item" href="{{ url('faq') }}">
                                <i class="dropdown-icon fe fe-alert-triangle"></i> Need help??
                            </a> --}}
                            <a class="dropdown-item" href="{{ url('logout') }}">
                                <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                            </a>
                        </div>
                    </div>
                    {{-- <div class="dropdown d-none d-md-flex header-settings">
                        <a href="javascript:void(0)" class="nav-link icon " data-bs-toggle="sidebar-right"
                            data-target=".sidebar-right">
                            <i class="fe fe-menu"></i>
                        </a>
                    </div><!-- SIDE-MENU --> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="mb-1 navbar navbar-expand-lg  responsive-navbar navbar-dark d-md-none bg-white">
        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
            <div class="d-flex order-lg-2 ms-auto">
                {{-- <div class="dropdown d-sm-flex">
                    <a href="#" class="nav-link icon" data-bs-toggle="dropdown">
                        <i class="fe fe-search"></i>
                    </a>
                    <div class="dropdown-menu header-search dropdown-menu-start">
                        <div class="input-group w-100 p-2">
                            <input type="text" class="form-control" placeholder="Search....">
                            <div class="input-group-text btn btn-primary">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- SEARCH -->
                <div class="dropdown d-md-flex">
                    <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                        <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip"
                            title="Dark Theme"><i class="fe fe-moon"></i></span>
                        <span class="light-layout" data-bs-placement="bottom" data-bs-toggle="tooltip"
                            title="Light Theme"><i class="fe fe-sun"></i></span>
                    </a>
                </div><!-- Theme-Layout -->
                <div class="dropdown d-md-flex">
                    <a class="nav-link icon full-screen-link nav-link-bg">
                        <i class="fe fe-minimize fullscreen-button"></i>
                    </a>
                </div><!-- FULL-SCREEN -->
                {{-- <div class="dropdown  d-md-flex notifications">
                    <a class="nav-link icon" data-bs-toggle="dropdown"><i class="fe fe-bell"></i><span
                            class=" pulse"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <div class="drop-heading border-bottom">
                            <div class="d-flex">
                                <h6 class="mt-1 mb-0 fs-16 fw-semibold">You have Notification</h6>
                                <div class="ms-auto">
                                    <span class="badge bg-success rounded-pill">3</span>
                                </div>
                            </div>
                        </div>
                        <div class="notifications-menu">
                            <a class="dropdown-item d-flex" href="{{ url('chat') }}">
                                <div class="me-3 notifyimg  bg-primary-gradient brround box-shadow-primary">
                                    <i class="fe fe-message-square"></i>
                                </div>
                                <div class="mt-1">
                                    <h5 class="notification-label mb-1">New review received</h5>
                                    <span class="notification-subtext">2 hours ago</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex" href="{{ url('chat') }}">
                                <div class="me-3 notifyimg  bg-secondary-gradient brround box-shadow-primary">
                                    <i class="fe fe-mail"></i>
                                </div>
                                <div class="mt-1">
                                    <h5 class="notification-label mb-1">New Mails Received</h5>
                                    <span class="notification-subtext">1 week ago</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex" href="{{ url('cart') }}">
                                <div class="me-3 notifyimg  bg-success-gradient brround box-shadow-primary">
                                    <i class="fe fe-shopping-cart"></i>
                                </div>
                                <div class="mt-1">
                                    <h5 class="notification-label mb-1">New Order Received</h5>
                                    <span class="notification-subtext">1 day ago</span>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-divider m-0"></div>
                        <a href="#" class="dropdown-item text-center p-3 text-muted">View all Notification</a>
                    </div>
                </div> --}}
                <!-- NOTIFICATIONS -->
                {{-- <div class="dropdown d-md-flex message">
                    <a class="nav-link icon text-center" data-bs-toggle="dropdown">
                        <i class="fe fe-message-square"></i><span class=" pulse-danger"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <div class="drop-heading border-bottom">
                            <div class="d-flex">
                                <h6 class="mt-1 mb-0 fs-16 fw-semibold">You have Messages</h6>
                                <div class="ms-auto">
                                    <span class="badge bg-danger rounded-pill">4</span>
                                </div>
                            </div>
                        </div>
                        <div class="message-menu">
                            <a class="dropdown-item d-flex" href="{{ url('chat') }}">
                                <span class="avatar avatar-md brround me-3 align-self-center cover-image"
                                    data-bs-image-src="{{ asset('assets/images/users/1.jpg') }}"></span>
                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1">Madeleine</h5>
                                        <small class="text-muted ms-auto text-end">
                                            3 hours ago
                                        </small>
                                    </div>
                                    <span>Hey! there I' am available....</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex" href="{{ url('chat') }}">
                                <span class="avatar avatar-md brround me-3 align-self-center cover-image"
                                    data-bs-image-src="{{ asset('assets/images/users/12.jpg') }}"></span>
                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1">Anthony</h5>
                                        <small class="text-muted ms-auto text-end">
                                            5 hour ago
                                        </small>
                                    </div>
                                    <span>New product Launching...</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex" href="{{ url('chat') }}">
                                <span class="avatar avatar-md brround me-3 align-self-center cover-image"
                                    data-bs-image-src="{{ asset('assets/images/users/4.jpg') }}"></span>
                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1">Olivia</h5>
                                        <small class="text-muted ms-auto text-end">
                                            45 mintues ago
                                        </small>
                                    </div>
                                    <span>New Schedule Realease......</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex" href="{{ url('chat') }}">
                                <span class="avatar avatar-md brround me-3 align-self-center cover-image"
                                    data-bs-image-src="{{ asset('assets/images/users/15.jpg') }}"></span>
                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1">Sanderson</h5>
                                        <small class="text-muted ms-auto text-end">
                                            2 days ago
                                        </small>
                                    </div>
                                    <span>New Schedule Realease......</span>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-divider m-0"></div>
                        <a href="#" class="dropdown-item text-center p-3 text-muted">See all Messages</a>
                    </div>
                </div> --}}
                <!-- MESSAGE-BOX -->
                <div class="dropdown d-md-flex profile-1">
                    <a href="#" data-bs-toggle="dropdown" class="nav-link pe-2 leading-none d-flex">
                        <span>
                            <img src="{{ asset('assets/images/users/8.jpg') }}" alt="profile-user"
                                class="avatar  profile-user brround cover-image">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <div class="drop-heading">
                            <div class="text-center">
                                <h5 class="text-dark mb-0">{{$user_email}}</h5>
                                <small class="text-muted">{{$designation_nmme}}</small>
                            </div>
                        </div>
                        <div class="dropdown-divider m-0"></div>
                        {{-- <a class="dropdown-item" href="{{ url('profile') }}">
                            <i class="dropdown-icon fe fe-user"></i> Profile
                        </a>
                        <a class="dropdown-item" href="{{ url('email') }}">
                            <i class="dropdown-icon fe fe-mail"></i> Inbox
                            <span class="badge bg-primary float-end">3</span>
                        </a>
                        <a class="dropdown-item" href="{{ url('emailservices') }}">
                            <i class="dropdown-icon fe fe-settings"></i> Settings
                        </a>
                        <a class="dropdown-item" href="{{ url('faq') }}">
                            <i class="dropdown-icon fe fe-alert-triangle"></i> Need help?
                        </a> --}}
                        <a class="dropdown-item" href="{{ url('logout') }}">
                            <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                        </a>
                    </div>
                </div>
                {{-- <div class="dropdown d-md-flex header-settings">
                    <a href="#" class="nav-link icon " data-bs-toggle="sidebar-right"
                        data-target=".sidebar-right">
                        <i class="fe fe-menu"></i>
                    </a>
                </div> --}}
                <!-- SIDE-MENU -->
            </div>
        </div>
    </div>
    <!-- /Mobile Header -->
