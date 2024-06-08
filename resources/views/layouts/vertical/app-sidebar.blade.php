    <!--APP-SIDEBAR-->
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ url('index') }}">

                <img src="{{ asset('assets/images/ayngaran_logo_1.png') }}" class="header-brand-img light-logo1"
                    alt="logo">
            </a><!-- LOGO -->
        </div>
        <ul class="side-menu">
            <li style='visibility:hidden'>
                <h3>Main</h3>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="{{ url('index') }}"><i
                        class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
            </li>
                  @php
                        $permission = new \App\Models\Permission();
                        $projecttype_check = $permission->checkPermission('projecttype.read');
                        $branch_check = $permission->checkPermission('branch.read');
                        $banks_check = $permission->checkPermission('banks.read');
                        $relationship_check = $permission->checkPermission('relationship.read');
                        $directions_check = $permission->checkPermission('directions.read');
                        $marketingtypes_check = $permission->checkPermission('marketingtypes.read');
                        $printtemplatecontents_check = $permission->checkPermission('printtemplatecontents.read');
                        $mainledgers_check = $permission->checkPermission('mainledgers.read');
                        $subledgers_check = $permission->checkPermission('subledgers.read');
                        $vehicles_check = $permission->checkPermission('vehicles.read');
                        $designation_check = $permission->checkPermission('designation.read');
                        $pages_check = $permission->checkPermission('pages.read');
                    @endphp
                  @if ($projecttype_check == 1 || $branch_check == 1 || $banks_check == 1 || $relationship_check == 1 || $directions_check == 1
                  || $marketingtypes_check == 1 || $printtemplatecontents_check == 1 || $mainledgers_check == 1 || $subledgers_check == 1 || $vehicles_check == 1 ||
                   $designation_check == 1 || $pages_check == 1)
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="#"><i
                        class="side-menu__icon fe fe-list"></i><span class="side-menu__label">Masters</span><i
                        class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                     @if ($projecttype_check == 1)
                    <li><a href="{{ url('/project-type') }}"
                            class="slide-item {{ Request::is('project-type') ? 'active' : '' }}">Project
                            Type</a></li>
                            @endif
                    @php
                        $permission = new \App\Models\Permission();
                        $check = $permission->checkPermission('branch.read');
                    @endphp
                     @if ($check == 1)
                    <li><a href="{{ url('/branch') }}"
                            class="slide-item {{ Request::is('branch') ? 'active' : '' }}">Branch</a></li>
                    @endif
                     @php
                        $permission = new \App\Models\Permission();
                        $check = $permission->checkPermission('relationship.read');
                    @endphp
                     @if ($check == 1)
                    <li><a href="{{ url('/relationship') }}"
                            class="slide-item {{ Request::is('relationship') ? 'active' : '' }}">Relationship</a></li>
                    @endif
                   @if ($pages_check == 1)
                    <li><a href="{{ url('/pages') }}"
                            class="slide-item {{ Request::is('pages') ? 'active' : '' }}">Pages</a></li>
                    @endif
                   @if ($designation_check == 1)
                    <li><a href="{{ url('/designation') }}"
                            class="slide-item {{ Request::is('designation') ? 'active' : '' }}">Designation</a></li>
                    @endif
                    @if ($directions_check == 1)
                    <li><a href="{{ url('/direction') }}"
                            class="slide-item {{ Request::is('direction') ? 'active' : '' }}">Direction</a></li>
                            @endif
                    @if ($marketingtypes_check == 1)
                    <li><a href="{{ url('/marketing') }}"
                            class="slide-item {{ Request::is('marketing') ? 'active' : '' }}">Marketing Type</a></li>
                    @endif
                    @php
                        $permission = new \App\Models\Permission();
                        $check = $permission->checkPermission('banks.read');
                    @endphp
                     @if ($banks_check == 1)
                    <li><a href="{{ url('/bank') }}"
                            class="slide-item {{ Request::is('bank') ? 'active' : '' }}">Banks</a></li>
                    @endif
                    @if ($printtemplatecontents_check == 1)
                    <li><a href="{{ url('/print-template') }}"
                            class="slide-item {{ Request::is('print-template') ? 'active' : '' }}">Print Template
                            Content</a></li>
                    @endif
                    @if ($mainledgers_check == 1)
                    <li><a href="{{ url('/main-ledger') }}"
                            class="slide-item {{ Request::is('main-ledger') ? 'active' : '' }}">Main Ledger</a></li>
                    @endif
                    @if ($subledgers_check == 1)
                    <li><a href="{{ url('/sub-ledger') }}"
                            class="slide-item {{ Request::is('sub-ledger') ? 'active' : '' }}">Sub Ledger</a></li>
                    @endif
                    @if ($vehicles_check == 1)
                    <li><a href="{{ url('/vehicle') }}"
                            class="slide-item {{ Request::is('vehicle') ? 'active' : '' }}">Vehicle</a></li>
                    @endif
                    @if ($vehicles_check == 1)
                    <li><a href="{{ url('/suppliers') }}"
                            class="slide-item {{ Request::is('suppliers') ? 'active' : '' }}">Suppliers</a></li>
                    @endif
                </ul>
            </li>
            @endif
                   @php
                        $permission = new \App\Models\Permission();
                        $check = $permission->checkPermission('staff.read');
                    @endphp
                     @if ($check == 1)
            <li class="slide">
                <!-- add active class -->
                <a class="side-menu__item {{ Request::is('staff-detail-create', 'staff-detail/*/edit') ? 'active' : '' }}"
                    data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-user"></i>
                    <span class="side-menu__label">Users</span><i class="angle fa fa-angle-right"></i></a>

                <!-- add open class and display block property -->
                <ul class="slide-menu {{ Request::is('staff-detail-create', 'staff-detail/*/edit') ? 'open' : '' }}"
                    style="display: none; {{ Request::is('staff-detail-create', 'staff-detail/*/edit') ? 'display:block' : '' }}">
                    <!--<li><a href="{{ url('/user-type') }}" class="slide-item">User Type</a></li>-->
                    <li><a href="{{ url('/staff-details') }}"
                            class="slide-item {{ Request::is('staff-detail-create', 'staff-detail/*/edit') ? 'active' : '' }}">Staff
                            Details</a></li>

                </ul>
            </li>
            @endif
                   @php
                        $permission = new \App\Models\Permission();
                        $director_check = $permission->checkPermission('directors.read');
                        $mm_check = $permission->checkPermission('marketingmanagers.read');
                        $ms_check = $permission->checkPermission('marketingsupervisors.read');
                        $me_check = $permission->checkPermission('marketingexecutives.read');
                    @endphp
                     @if ($director_check == 1 || $mm_check == 1 || $ms_check == 1 || $me_check == 1)
            <li class="slide">
                <!-- add active class -->
                <a class="side-menu__item {{ Request::is('director-create', 'director/*/edit', 'marketing-manager-create', 'marketing-manager/*/edit', 'marketing-supervisor-create', 'marketing-supervisor/*/edit', 'marketing-executive-create', 'marketing-executive/*/edit') ? 'active' : '' }}"
                    data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-user"></i>
                    <span class="side-menu__label">Managing Team</span><i class="angle fa fa-angle-right"></i></a>

                <!-- add open class and display block property -->
                <ul class="slide-menu {{ Request::is('director-create', 'director/*/edit', 'marketing-manager-create', 'marketing-manager/*/edit', 'marketing-supervisor-create', 'marketing-supervisor/*/edit', 'marketing-executive-create', 'marketing-executive/*/edit') ? 'open' : '' }}"
                    style="display: none; {{ Request::is('director-create', 'director/*/edit', 'marketing-manager-create', 'marketing-manager/*/edit', 'marketing-supervisor-create', 'marketing-supervisor/*/edit', 'marketing-executive-create', 'marketing-executive/*/edit') ? 'display:block' : '' }}">
                    @if ($director_check == 1)
                    <li><a href="{{ url('/director-lists') }}"
                            class="slide-item {{ Request::is('director-create', 'director/*/edit') ? 'active' : '' }}">Directors</a>
                    </li>
                    @endif
                    @if ($mm_check == 1)
                    <li><a href="{{ url('marketing-manager-lists') }}"
                            class="slide-item {{ Request::is('marketing-manager-create', 'marketing-manager/*/edit') ? 'active' : '' }}">Marketing
                            Managers</a></li>
                    @endif
                    @if ($ms_check == 1)
                    <li><a href="{{ url('marketing-supervisor-lists') }}"
                            class="slide-item {{ Request::is('marketing-supervisor-create', 'marketing-supervisor/*/edit') ? 'active' : '' }}">Marketing
                            Supervisors</a>
                    </li>
                    @endif
                    @if ($me_check == 1)
                    <li><a href="{{ url('/marketing-executive-lists') }}"
                            class="slide-item  {{ Request::is('marketing-executive-create', 'marketing-executive/*/edit') ? 'active' : '' }}">Marketing
                            Executives</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            <!--<li class="slide">-->
            <!--     <a class="side-menu__item" data-bs-toggle="slide" href="#"><i-->
            <!--             class="side-menu__icon fe fe-user"></i>-->
            <!--         <span class="side-menu__label">Roles & Permissions</span><i class="angle fa fa-angle-right"></i></a>-->
            <!--     <ul class="slide-menu" style="display: none;">-->

            <!--         <li><a href="{{ url('/permissions') }}" class="slide-item">Permissions</a></li>-->

            <!--     </ul>-->
            <!-- </li>-->

                     @php
                        $permission = new \App\Models\Permission();
                        $project_check = $permission->checkPermission('projectmanagement.read');
                        $plot_check = $permission->checkPermission('plotmanagement.read');
                        $edit_plot_check = $permission->checkPermission('editplotsquarefeet.read');
                        $book_check = $permission->checkPermission('bookings.read');
                        $payment_check = $permission->checkPermission('partpaymentlist.read');
                        $site_check = $permission->checkPermission('sitevisits.read');
                        $bill_check = $permission->checkPermission('customerbillprint.read');
                        $commission_check = $permission->checkPermission('commissionupdation.read');
                        $cancel_check = $permission->checkPermission('plotcancellationlist.read');


                    @endphp
                    @if ($project_check == 1 || $plot_check == 1 || $edit_plot_check == 1 || $book_check == 1 ||
                    $payment_check == 1 || $site_check == 1 || $bill_check == 1 || $commission_check == 1 || $cancel_check == 1)
            <li class="slide">
                <!-- add active class -->
                <a class="side-menu__item {{ Request::is('project_create', 'project/*/edit', 'plot-create', 'project-plot-edit/*', 'booking_create', 'booking/*/edit'
                , 'create_part_payment', 'part_payment/*/edit', 'commission-detail-create', 'commission-detail/*/*/edit','plots/*/*/edit') ? 'active' : '' }}"
                    data-bs-toggle="slide" href="#" id="project_mamagement_side_bar"><i
                        class="side-menu__icon fe fe-user"></i>
                    <span class="side-menu__label">Project Management</span><i class="angle fa fa-angle-right"></i></a>
                <!-- add open class and display block property -->
                <ul class="slide-menu {{ Request::is('project_create', 'project/*/edit', 'plot-create', 'project-plot-edit/*', 'booking_create', 'booking/*/edit', 'create_part_payment', 'part_payment/*/edit', 'commission-detail-create', 'commission-detail/*/*/edit') ? 'open' : '' }}"
                    style="display: none; {{ Request::is('project_create', 'project/*/edit', 'plot-create', 'project-plot-edit/*', 'booking_create', 'booking/*/edit',
                    'create_part_payment', 'part_payment/*/edit', 'commission-detail-create', 'commission-detail/*/*/edit','plots/*/*/edit') ? 'display:block' : '' }}">
                      @if ($project_check == 1)
                    <li class="{{ Request::is('project_create', 'project/*/edit') ? 'active' : '' }}"><a
                            href="{{ url('/projects') }}"
                            class="slide-item {{ Request::is('project_create', 'project/*/edit') ? 'active' : '' }}">Projects</a>
                    </li>
                    @endif
                    @if ($plot_check == 1)
                    <li class="{{ Request::is('plot-create', 'project-plot-edit/*') ? 'active' : '' }}">
                        <a href="{{ url('/plot-management') }}"
                            class="slide-item {{ Request::is('plot-create', 'project-plot-edit/*') ? 'active' : '' }}">
                            Plot Management
                        </a>
                    </li>
                   @endif
                    @if ($edit_plot_check == 1)
                    <li class="{{ Request::is('plot-square-feet/edit') ? 'active' : '' }}"><a
                            href="{{ url('/plot-square-feet/edit') }}"
                            class="slide-item {{ Request::is('plot-square-feet/edit') ? 'active' : '' }}">Edit Plot
                            Square Feet</a></li>
                    @endif
                    @if ($book_check == 1)
                    <li class="{{ Request::is('booking_create', 'booking/*/edit') ? 'active' : '' }}"><a
                            href="{{ url('/plot-booking') }}"
                            class="slide-item {{ Request::is('booking_create', 'booking/*/edit') ? 'active' : '' }}">Plot
                            Booking</a></li>
                     @endif
                      @if ($payment_check == 1)
                    <li class="{{ Request::is('create_part_payment', 'part_payment/*/edit', 'part_payment/*/*/list') ? 'active' : '' }}"><a
                            href="{{ url('/part_payment_list') }}"
                            class="slide-item {{ Request::is('create_part_payment', 'part_payment/*/edit') ? 'active' : '' }}">Part
                            Payment</a></li>
                     @endif
                      @if ($site_check == 1)
                     <li><a href="{{ url('/project_visit_list') }}" class="slide-item">Site Visit</a></a></li>
                      @endif
                    @if ($bill_check == 1)
                        <li><a href="{{ url('/customer_bill_list') }}" class="slide-item">Customer Bill Print</a></li>
                      @endif
                      @if ($commission_check == 1)

                    <li
                        class="{{ Request::is('commission-detail-create', 'commission-detail/*/*/edit') ? 'active' : '' }}">
                        <a href="{{ url('/commission-details') }}"
                            class="slide-item {{ Request::is('commission-detail-create', 'commission-detail/*/*/edit') ? 'active' : '' }}">Commission
                            Updation</a>
                    </li>

                    @endif
                      @if ($cancel_check == 1)
                   <li class="{{ Request::is('plots/*/*/edit') ? 'active' : '' }}"><a
                            href="{{ url('/plots-list') }}"
                            class="slide-item {{ Request::is('plots/*/*/edit') ? 'active' : '' }}">Plot Cancellation</a></li>
                    @endif
                </ul>
            </li>
            @endif
                @php
                        $permission = new \App\Models\Permission();
                        $fullypaid_check = $permission->checkPermission('registrationfullypaidlist.read');
                        $expenseconfirm_check = $permission->checkPermission('registrationexpenseconfirm.read');
                        $registrationcompleted_check = $permission->checkPermission('plotregistrationcompletedupdated.read');
                        $receiveregistration_check = $permission->checkPermission('receiveregistrationdocument.read');
                        $documentissue_check = $permission->checkPermission('plotdocumentissue.read');
                        $plotdocumentissue_document_check = $permission->checkPermission('plotdocumentissue-document.read');
                        $legalbook_check = $permission->checkPermission('legalbookissue.read');
                        $legaldocumentabstract_check = $permission->checkPermission('legaldocumentabstract.read');


                    @endphp
                    @if ($fullypaid_check == 1 || $expenseconfirm_check == 1 || $registrationcompleted_check == 1 ||
                    $receiveregistration_check == 1 || $documentissue_check == 1 || $plotdocumentissue_document_check == 1 || $legalbook_check == 1 ||
                    $legaldocumentabstract_check == 1)
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="#"><i
                        class="side-menu__icon fe fe-user"></i>
                    <span class="side-menu__label">Plot Registration</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu" style="display: none;">
                     @if ($fullypaid_check == 1)
                    <li><a href="{{ url('/fullypaid_list') }}"
                            class="slide-item {{ Request::is('fullypaid_list') ? 'active' : '' }}">Fully
                            Paid List</a></li>
                      @endif
                      @if ($expenseconfirm_check == 1)
                    <li><a href="{{ url('/plot-registration-expense') }}"
                            class="slide-item {{ Request::is('plot-registration-expense') ? 'active' : '' }}">Registration
                            Expense Confirm</a></li>
                        @endif

                    @if ($registrationcompleted_check == 1)
                    <li><a href="{{ url('/registration-completed-updated') }}"
                            class="slide-item {{ Request::is('registration-completed-updated') ? 'active' : '' }}">Registration
                            Completed Updation</a></li>
                    @endif
                    @if ($receiveregistration_check == 1)
                    <li><a href="{{ url('/receive-registration-document') }}"
                            class="slide-item {{ Request::is('receive-registration-document') ? 'active' : '' }}">Receive
                            Registration Document</a></li>
                    @endif
                    @if ($documentissue_check == 1)
                    <li><a href="{{ url('/plot-document-issue') }}"
                            class="slide-item {{ Request::is('plot-document-issue') ? 'active' : '' }}">Plot Document
                            Issue</a></li>
                    @endif
                    @if ($plotdocumentissue_document_check == 1)
                     <li><a href="{{ url('/plot-doc-issue-document') }}"
                            class="slide-item {{ Request::is('plot-doc-issue-document') ? 'active' : '' }}">Plot
                            Document
                            Issue - Document</a></li>
                    @endif
                    @if ($legalbook_check == 1)
                    <li><a href="{{ url('/legal-book-issue') }}"
                            class="slide-item {{ Request::is('legal-book-issue') ? 'active' : '' }}">Legal Book
                            Issue</a></li>
                    @endif
                    @if ($legaldocumentabstract_check == 1)
                    <li><a href="{{ url('/legal-document-abstract') }}"
                            class="slide-item {{ Request::is('legal-document-abstract') ? 'active' : '' }}">Legal
                            Document Abstract
                        </a></li>
                    @endif
                    <!--<li><a href="{{ url('/commission-cash-issue') }}"-->
                    <!--        class="slide-item {{ Request::is('commission-cash-issue') ? 'active' : '' }}">Commission-->
                    <!--        Cash Issue </a></li>-->
                </ul>
            </li>
            @endif
                   @php
                        $permission = new \App\Models\Permission();
                        $check = $permission->checkPermission('commissioncashissue.read');
                    @endphp
                     @if ($check == 1)
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="#"><i
                        class="side-menu__icon fe fe-user"></i>
                    <span class="side-menu__label">Commission</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu" style="display: none;">

                    <li><a href="{{ url('/commission-cash-issue') }}"
                            class="slide-item {{ Request::is('commission-cash-issue') ? 'active' : '' }}">Commission
                            Cash Issue </a></li>
                </ul>
            </li>
            @endif
                   @php
                        $permission = new \App\Models\Permission();
                        $voucher_check_1 = $permission->checkPermission('voucherentry.read');
                        $voucher_check_2 = $permission->checkPermission('voucherlist.read');
                        $daybookclose_check = $permission->checkPermission('daybookclose.read');
                        $suspense_check = $permission->checkPermission('suspensedaybooklist.read');
                    @endphp
                    @if ($voucher_check_1 == 1 || $voucher_check_2 == 1 || $daybookclose_check == 1 || $suspense_check == 1)
            <li class="slide">
                <a class="side-menu__item {{ Request::is('account-voucher-entry-add') ? 'active' : '' }}"
                    data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-user"></i>
                    <span class="side-menu__label">Accounts</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu {{ Request::is('account-voucher-entry-add') ? 'open' : '' }}"
                    style="display: none; {{ Request::is('account-voucher-entry-add') ? 'display:block' : '' }}">
                      @if ($voucher_check_1 == 1)
                    <li><a href="{{ url('/account-voucher-entry') }}"
                            class="slide-item {{ Request::is('account-voucher-entry', 'account-voucher-entry-add') ? 'active' : '' }}">Voucher
                            Entry</a></li>
                        @endif
                    @if ($voucher_check_2 == 1)
                    <li><a href="{{ url('/account-voucher-list') }}"
                            class="slide-item {{ Request::is('account-voucher-list') ? 'active' : '' }}">Voucher
                            List</a></li>
                    @endif
                    @if ($daybookclose_check == 1)
                    <li><a href="{{ url('/account-day-close-book') }}"
                            class="slide-item {{ Request::is('account-day-close-book') ? 'active' : '' }}">Day
                            Book Close</a></li>
                    @endif
                    @if ($suspense_check == 1)
                     <li><a href="{{ url('/account-suspense-day-book') }}"
                            class="slide-item {{ Request::is('account-suspense-day-book') ? 'active' : '' }}">Suspense Day Book</a></li>
                        @endif
                    <!-- <li><a href="{{ url('/receive-registration-document') }}"
                            class="slide-item {{ Request::is('receive-registration-document') ? 'active' : '' }}">Receive
                            Registration Document</a></li> -->
                </ul>
            </li>
            @endif


                @php
                        $permission = new \App\Models\Permission();
                        $check = $permission->checkPermission('staff.read');
                    @endphp
                     @if ($check == 1)
            <li class="slide">
                <!-- add active class -->
                <a class="side-menu__item {{ Request::is('message-template') ? 'active' : '' }}"
                    data-bs-toggle="slide" href="#"><i class="side-menu__icon fa fa-comment"></i>
                    <span class="side-menu__label">Message</span><i class="angle fa fa-angle-right"></i></a>

                <!-- add open class and display block property -->
                <ul class="slide-menu {{ Request::is('message-template') ? 'open' : '' }}"
                    style="display: none; {{ Request::is('message-template') ? 'display:block' : '' }}">
                   <li><a href="{{ url('/message-template') }}"
                            class="slide-item {{ Request::is('message-template') ? 'active' : '' }}">Message Templates</a></li>

                </ul>
            </li>
            @endif

                   @php
                        $permission = new \App\Models\Permission();
                        $plotbookingandregistereddetails_check = $permission->checkPermission('plotbookingandregistereddetails.read');
                        $projectsummary_check = $permission->checkPermission('projectsummary.read');
                        $projecthistory_check = $permission->checkPermission('projecthistory.read');
                        $projectdetails_check = $permission->checkPermission('projectdetails.read');
                        $sitevisitdetails_check = $permission->checkPermission('sitevisitdetails.read');
                        $projectabstract_check = $permission->checkPermission('projectabstract.read');
                        $plothistory_check = $permission->checkPermission('plothistory.read');
                        $projectwisesaleslist_check = $permission->checkPermission('projectwisesaleslist.read');
                        $cancelledplotlist_check = $permission->checkPermission('cancelledplotlist.read');
                        $vacantplotdetails_check = $permission->checkPermission('vacantplotdetails.read');
                        $marketerstatusreport_check = $permission->checkPermission('marketerstatusreport.read');

                    @endphp

                @if ($plotbookingandregistereddetails_check == 1 || $projectsummary_check == 1 || $projecthistory_check == 1 ||
                    $projectdetails_check == 1 || $sitevisitdetails_check == 1 || $projectabstract_check == 1 || $plothistory_check == 1 ||
                    $projectwisesaleslist_check == 1 || $cancelledplotlist_check == 1 || $vacantplotdetails_check == 1 || $marketerstatusreport_check == 1)
            <li class="slide">
                <a class="side-menu__item"
                    data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-user"></i>
                    <span class="side-menu__label">Reports</span><i class="angle fa fa-angle-right"></i></a>

                <ul class="slide-menu"
                    style="display: none;">
                    @if ($plotbookingandregistereddetails_check == 1)
                      <li><a href="{{ url('/plots-booking-registered-list') }}"
                            class="slide-item {{ Request::is('plots-booking-registered-list') ? 'active' : '' }}">Booking and Registered Details</a></li>
                    @endif
                     @if ($projectsummary_check == 1)
                       <li><a href="{{ url('/project_summary') }}"
                            class="slide-item {{ Request::is('project_summary') ? 'active' : '' }}">Project
                            Summary</a></li>
                     @endif
                      @if ($projecthistory_check == 1)
                      <li><a href="{{ url('/project-history') }}"
                            class="slide-item {{ Request::is('project-history') ? 'active' : '' }}">Project History</a></li>
                       @endif
                       @if ($projectdetails_check == 1)
                      <li><a href="{{ url('/project-details') }}"
                            class="slide-item {{ Request::is('project-details') ? 'active' : '' }}">Project Details</a></li>
                    @endif
                       @if ($sitevisitdetails_check == 1)
                      <li><a href="{{ url('/site-visit-details') }}"
                            class="slide-item {{ Request::is('site-visit-details') ? 'active' : '' }}">Site Visit Details</a></li>
                     @endif
                     @if ($projectabstract_check == 1)
                      <li><a href="{{ url('/project_abstract') }}"
                            class="slide-item {{ Request::is('project_abstract') ? 'active' : '' }}">Project
                            Abstract</a></li>
                       @endif
                      @if ($plothistory_check == 1)
                       <li><a href="{{ url('/plot_history') }}"
                            class="slide-item {{ Request::is('plot_history') ? 'active' : '' }}">Plot History</a>
                       </li>
                      @endif
                      @if ($projectwisesaleslist_check == 1)
                        <li><a href="{{ url('/project-sales-list') }}"
                            class="slide-item {{ Request::is('project-sales-list') ? 'active' : '' }}">Project wise Sales List</a></li>
                       @endif
                       @if ($cancelledplotlist_check == 1)
                      <li><a href="{{ url('/cancel-plots-list') }}"
                            class="slide-item {{ Request::is('cancel-plots-list') ? 'active' : '' }}">Cancelled Plots</a></li>

                     @endif
                     @if ($vacantplotdetails_check == 1)
                      <li><a href="{{ url('/vacant_plot_detail') }}"
                            class="slide-item {{ Request::is('vacant_plot_detail') ? 'active' : '' }}">Vacant
                            Plots</a></li>
                    @endif
                    @if ($marketerstatusreport_check == 1)
                       <li><a href="{{ url('/marketer-status-report') }}"
                            class="slide-item {{ Request::is('marketer-status-report') ? 'active' : '' }}">Marketer Status Report</a></li>
                         @endif

                </ul>
            </li>

            @endif


            <!--<li class="slide">-->
            <!--    <a class="side-menu__item {{ Request::is('account-voucher-entry-add') ? 'active' : '' }}"-->
            <!--        data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-user"></i>-->
            <!--        <span class="side-menu__label">Accounts</span><i class="angle fa fa-angle-right"></i></a>-->
            <!--    <ul class="slide-menu {{ Request::is('account-voucher-entry-add') ? 'open' : '' }}"-->
            <!--        style="display: none; {{ Request::is('account-voucher-entry-add') ? 'display:block' : '' }}">-->

            <!--        <li><a href="{{ url('/account-voucher-entry') }}"-->
            <!--                class="slide-item {{ Request::is('account-voucher-entry', 'account-voucher-entry-add') ? 'active' : '' }}">Voucher-->
            <!--                Entry</a></li>-->
                    <!-- <li><a href="{{ url('/receive-registration-document') }}"
                            class="slide-item {{ Request::is('receive-registration-document') ? 'active' : '' }}">Receive
                            Registration Document</a></li> -->
            <!--    </ul>-->
            <!--</li>-->
            <!-- <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="#"><i
                        class="side-menu__icon fe fe-user"></i>
                    <span class="side-menu__label">PLot Registration Expense</span><i
                        class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu" style="display: none;">
                    <li><a href="{{ url('/plot-registration-expense') }}" class="slide-item">Plot Registration
                            Expense</a></li>
                </ul>
            </li> -->

        </ul>
    </aside>
    <!--/APP-SIDEBAR-->
