@extends('layouts.app')
@section('content')
    <div class="row mt-2">
        <!-- get_plot_nos_modal -->
        <div class="modal fade" id="get_plotnos_ListModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
            role="dialog">
            <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Plot No's</h5>
                        <button class="btn-close bg-danger" onclick="Close_model()">
                            <span class="text-white">X</span>
                        </button>
                    </div>
                    <div class="modal-body" id="plots_modal_body">
                        <div class="row p-2">
                            <div class="col-sm-6 col-md-4 mb-2">
                                <label class="form-label">Project Name</label>
                                <input type="hidden" name="t_project_id" id="t_project_id">
                                <select name="project_id" id="project_id" class="form-control SlectBox" disabled>
                                    <option value="">Select Project</option>
                                    @if (isset($projects))
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">
                                                {{ $project->short_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-4 mb-2">
                                <label class="form-label">Plot No.</label>
                                <select name="plot_no" id="plot_no" class="form-control SlectBox">
                                    <option value="">Select Plot No</option>

                                </select>
                                <span id="plot_no_validation" class="text-danger" style="display:none;">Plot
                                    No Field is Required</span>
                            </div>
                            <!--<div class="col-sm-6 col-md-4 mb-2">-->
                            <!--    <label class="form-label" style="color:white;">.</label>-->
                            <!--    <button type="button" class="btn btn-primary" onclick="plot_search()">Search</button>-->
                            <!--</div>-->
                        </div>
                        <div class="table-responsive">
                            <table id="get_plot_nos_List_table" class="table table-bordered text-nowrap text-center mb-0">
                                <thead class="border">
                                    <tr>
                                        <th class="bg-transparent">S.No</th>
                                        <th class="bg-transparent ">Project Name</th>
                                        <th class="bg-transparent ">Plot No.</th>
                                        <th class="bg-transparent ">Plot Sq.Ft</th>
                                    </tr>
                                </thead>
                                <tbody class="border" id="plot_no_body">
                                    <tr>
                                        <td colspan="6">Data no Found</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- reg completed list modal -->
        <div class="modal fade" id="RegCompleted_ListModal" data-bs-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Registration Completed List</h5>
                        <button class="btn-close bg-danger" onclick="Close_model()">
                            <span class="text-white">X</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row p-2">
                            <div class="col-sm-6 col-md-4 mb-2">
                                <label class="form-label">Project Name</label>
                                <input type="hidden" id="r_project_id">
                                <select id="reg_project_id" class="form-control SlectBox" disabled>
                                    <option value="">Select Project</option>
                                    @if (isset($projects))
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">
                                                {{ $project->short_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-4 mb-2">
                                <label class="form-label">Plot No. <span class="text-red">*</span></label>
                                <select id="reg_plot_no" class="form-control SlectBox">
                                    <option value="">Select Plot No</option>
                                    @if (isset($plot_nos))
                                        @foreach ($plot_nos as $val)
                                            <option value="{{ $val->id }}">
                                                {{ $val->plot_no }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span id="plot_no_validation" class="text-danger" style="display:none;">Plot
                                    No Field is Required</span>
                            </div>
                            <!--<div class="col-sm-6 col-md-4 mb-2">-->
                            <!--    <label class="form-label" style="color:white;">.</label>-->
                            <!--    <button type="button" class="btn btn-primary" onclick="reg_plot_search()">Search</button>-->
                            <!--</div>-->
                        </div>
                        <div class="table-responsive">
                            <table id="RegCompleted_List_table" class="table table-bordered text-nowrap text-center mb-0">
                                <thead class="border">
                                    <tr>
                                        <th class="bg-transparent">S.No</th>
                                        <th class="bg-transparent ">Booked Date</th>
                                        <th class="bg-transparent ">Project Name</th>
                                        <th class="bg-transparent ">Plot No.</th>
                                        <th class="bg-transparent ">Plot Sq.Ft</th>
                                        <th class="bg-transparent ">Reg. Date</th>
                                    </tr>
                                </thead>
                                <tbody class="border" id="reg_com_body">
                                    <tr>
                                        <td colspan="6">Data no Found</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->

        <!-- reg document office list modal -->
        <div class="modal fade" id="RegDoc_Office_ListModal" data-bs-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Registration Document Office List</h5>
                        <button class="btn-close bg-danger" onclick="Close_model()">
                            <span class="text-white">X</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row p-2">
                            <div class="col-sm-6 col-md-4 mb-2">
                                <label class="form-label">Project Name</label>
                                <input type="hidden" id="off_project_id">
                                <select id="office_project_id" class="form-control SlectBox" disabled>
                                    <option value="">Select Project</option>
                                    @if (isset($projects))
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">
                                                {{ $project->short_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-4 mb-2">
                                <label class="form-label">Plot No. <span class="text-red">*</span></label>
                                <select id="office_plot_no" class="form-control SlectBox">
                                    <option value="">Select Plot No</option>
                                </select>
                                <span id="plot_no_validation" class="text-danger" style="display:none;">Plot
                                    No Field is Required</span>
                            </div>
                            <!--<div class="col-sm-6 col-md-4 mb-2">-->
                            <!--    <label class="form-label" style="color:white;">.</label>-->
                            <!--    <button type="button" class="btn btn-primary"-->
                            <!--        onclick="off_plot_search()">Search</button>-->
                            <!--</div>-->
                        </div>
                        <div class="table-responsive">
                            <table id="RegDoc_Office_List_table"
                                class="table table-bordered text-nowrap text-center mb-0">
                                <thead class="border">
                                    <tr>
                                        <th class="bg-transparent border-left-0" colspan="6"></th>
                                        <th class="bg-transparent" colspan="3">Document Collected By</th>
                                    </tr>
                                    <tr>
                                        <th class="bg-transparent">S.No</th>
                                        <th class="bg-transparent ">Booked Date</th>
                                        <th class="bg-transparent ">Project Name</th>
                                        <th class="bg-transparent ">Plot No.</th>
                                        <th class="bg-transparent ">Plot Sq.Ft</th>
                                        <th class="bg-transparent ">Reg. Date</th>
                                        <th class="bg-transparent ">Name</th>
                                        <th class="bg-transparent ">Mobile</th>
                                        <th class="bg-transparent ">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="border" id="reg_doc_off_tbody">
                                    <tr>
                                        <td colspan="9">Data no Found</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
        <!-- reg document issue list modal -->
        <div class="modal fade" id="RegDoc_Issued_ListModal" data-bs-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Registration Document Issued List</h5>
                        <button class="btn-close bg-danger" onclick="Close_model()">
                            <span class="text-white">X</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row p-2">
                            <div class="col-sm-6 col-md-4 mb-2">
                                <label class="form-label">Project Name</label>
                                <input type="hidden" id="off_issue_p_id">
                                <select id="office_issue_p_id" class="form-control SlectBox" disabled>
                                    <option value="">Select Project</option>
                                    @if (isset($projects))
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">
                                                {{ $project->short_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-4 mb-2">
                                <label class="form-label">Plot No. <span class="text-red">*</span></label>
                                <select id="office_issue_plot_no" class="form-control SlectBox">
                                    <option value="">Select Plot No</option>
                                </select>
                            </div>
                            <!--<div class="col-sm-6 col-md-4 mb-2">-->
                            <!--    <label class="form-label" style="color:white;">.</label>-->
                            <!--    <button type="button" class="btn btn-primary"-->
                            <!--        onclick="off_issue_plot_search()">Search</button>-->
                            <!--</div>-->
                        </div>
                        <div class="table-responsive">
                            <table id="RegDoc_Issued_List_table"
                                class="table table-bordered text-nowrap text-center mb-0">
                                <thead class="border">
                                    <tr>
                                        <th class="bg-transparent border-left-0" colspan="6"></th>
                                        <th class="bg-transparent" colspan="3">Document Issued To</th>
                                    </tr>
                                    <tr>
                                        <th class="bg-transparent">S.No</th>
                                        <th class="bg-transparent ">Booked Date</th>
                                        <th class="bg-transparent ">Project Name</th>
                                        <th class="bg-transparent ">Plot No.</th>
                                        <th class="bg-transparent ">Plot Sq.Ft</th>
                                        <th class="bg-transparent ">Reg. Date</th>
                                        <th class="bg-transparent ">Name</th>
                                        <th class="bg-transparent ">Mobile</th>
                                        <th class="bg-transparent ">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="border" id="reg_doc_issued_tbody">
                                    <tr>
                                        <td colspan="9">Data no Found</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
        <!-- legal book office list modal -->
        <div class="modal fade" id="LegalBook_Office_ListModal" data-bs-backdrop="static" tabindex="-1"
            role="dialog">
            <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Legal Book Office List</h5>
                        <button class="btn-close bg-danger" onclick="Close_model()">
                            <span class="text-white">X</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row p-2">
                            <div class="col-sm-6 col-md-4 mb-2">
                                <label class="form-label">Project Name</label>
                                <input type="hidden" id="legal_project_id">
                                <select id="legal_off_project_id" class="form-control SlectBox" disabled>
                                    <option value="">Select Project</option>
                                    @if (isset($projects))
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">
                                                {{ $project->short_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-4 mb-2">
                                <label class="form-label">Plot No. <span class="text-red">*</span></label>
                                <select id="legal_plot_no" class="form-control SlectBox">
                                    <option value="">Select Plot No</option>
                                </select>
                            </div>
                            <!--<div class="col-sm-6 col-md-4 mb-2">-->
                            <!--    <label class="form-label" style="color:white;">.</label>-->
                            <!--    <button type="button" class="btn btn-primary"-->
                            <!--        onclick="legal_office_plot_search()">Search</button>-->
                            <!--</div>-->
                        </div>
                        <div class="table-responsive">
                            <table id="LegalBook_Office_List_table"
                                class="table table-bordered text-nowrap text-center mb-0">
                                <thead class="border">
                                    <tr>
                                        <th class="bg-transparent border-left-0" colspan="6"></th>
                                        <th class="bg-transparent" colspan="3">Document Collected By</th>
                                    </tr>
                                    <tr>
                                        <th class="bg-transparent">S.No</th>
                                        <th class="bg-transparent ">Booked Date</th>
                                        <th class="bg-transparent ">Project Name</th>
                                        <th class="bg-transparent ">Plot No.</th>
                                        <th class="bg-transparent ">Plot Sq.Ft</th>
                                        <th class="bg-transparent ">Reg. Date</th>
                                        <th class="bg-transparent ">Name</th>
                                        <th class="bg-transparent ">Mobile</th>
                                        <th class="bg-transparent ">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="border" id="legal_book_off_tbody">
                                    <tr>
                                        <td colspan="9">Data no Found</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
        <!-- legal book issued list modal -->
        <div class="modal fade" id="LegalBook_Issued_ListModal" data-bs-backdrop="static" tabindex="-1"
            role="dialog">
            <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Legal Book Issued List</h5>
                        <button class="btn-close bg-danger" onclick="Close_model()">
                            <span class="text-white">X</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row p-2">
                            <div class="col-sm-6 col-md-4 mb-2">
                                <label class="form-label">Project Name</label>
                                <input type="hidden" id="legal_issue_p_id">
                                <select id="legal_issue_project_id" class="form-control SlectBox" disabled>
                                    <option value="">Select Project</option>
                                    @if (isset($projects))
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">
                                                {{ $project->short_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-4 mb-2">
                                <label class="form-label">Plot No. <span class="text-red">*</span></label>
                                <select id="legal_issue_plot_no" class="form-control SlectBox">
                                    <option value="">Select Plot No</option>
                                </select>
                            </div>
                            <!--<div class="col-sm-6 col-md-4 mb-2">-->
                            <!--    <label class="form-label" style="color:white;">.</label>-->
                            <!--    <button type="button" class="btn btn-primary"-->
                            <!--        onclick="legal_isssue_plot_search()">Search</button>-->
                            <!--</div>-->
                        </div>
                        <div class="table-responsive">
                            <table id="LegalBook_Issued_List_table"
                                class="table table-bordered text-nowrap text-center mb-0">
                                <thead class="border">
                                    <tr>
                                        <th class="bg-transparent border-left-0" colspan="6"></th>
                                        <th class="bg-transparent" colspan="3">Document Collected By</th>
                                    </tr>
                                    <tr>
                                        <th class="bg-transparent">S.No</th>
                                        <th class="bg-transparent ">Booked Date</th>
                                        <th class="bg-transparent ">Project Name</th>
                                        <th class="bg-transparent ">Plot No.</th>
                                        <th class="bg-transparent ">Plot Sq.Ft</th>
                                        <th class="bg-transparent ">Reg. Date</th>
                                        <th class="bg-transparent ">Name</th>
                                        <th class="bg-transparent ">Mobile</th>
                                        <th class="bg-transparent ">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="border" id='legal_book_issued_tbody'>

                                    <tr>
                                        <td colspan="9">Data no Found</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Legal Document Abstract</h3>
                </div>
                <div class="card-body">
                    <form id="Add_LegalDocumentAbstract_Form" autocomplete="off">
                        @csrf
                        @method('POST')
                        <div class="container">
                            <!--<div class="row border border-light-subtle mt-1" style="border-radius:5px;">-->
                            <div class="table-responsive mt-3">
                                <table id="LegalDocumentAbstract_Lists"
                                    class="table table-bordered text-nowrap text-center mb-0">
                                    <thead class="border text-center">
                                        <tr>
                                            <th colspan="4" class="border-left-0"></th>
                                            <th colspan="2">Reg. Doc</th>
                                            <th colspan="2">Legal Book</th>
                                        </tr>
                                        <tr>
                                            <th class="bg-transparent">S.No</th>
                                            <th class="bg-transparent ">Project</th>
                                            <th class="bg-transparent ">Total Plot</th>
                                            <th class="bg-transparent ">Reg.Completed</th>
                                            <th class="bg-transparent ">Office</th>
                                            <th class="bg-transparent ">Doc.Issued</th>
                                            <th class="bg-transparent ">Office</th>
                                            <th class="bg-transparent ">Doc.Issued</th>
                                        </tr>
                                        <!--<tr>-->
                                        <!--    <th></th>-->
                                        <!--    <th class="bg-transparent">-->
                                        <!--        <input type="text" name="project_name" id="project_name"-->
                                        <!--            class="form-control">-->
                                        <!--    </th>-->
                                        <!--    <th class="bg-transparent">-->
                                        <!--        <input type="text" name="total_plot" id="total_plot"-->
                                        <!--            class="form-control">-->
                                        <!--    </th>-->
                                        <!--    <th class="bg-transparent">-->
                                        <!--        <input type="text" name="reg_complete" id="reg_complete"-->
                                        <!--            class="form-control">-->
                                        <!--    </th>-->
                                        <!--    <th class="bg-transparent">-->
                                        <!--        <input type="text" name="reg_doc_office" id="reg_doc_office"-->
                                        <!--            class="form-control">-->
                                        <!--    </th>-->
                                        <!--    <th class="bg-transparent">-->
                                        <!--        <input type="text" name="reg_doc_issue" id="reg_doc_issue"-->
                                        <!--            class="form-control">-->
                                        <!--    </th>-->
                                        <!--    <th class="bg-transparent">-->
                                        <!--        <input type="text" name="legal_book_office" id="legal_book_office"-->
                                        <!--            class="form-control">-->
                                        <!--    </th>-->
                                        <!--    <th class="bg-transparent">-->
                                        <!--        <input type="text" name="legal_book_issue" id="legal_book_issue"-->
                                        <!--            class="form-control">-->
                                        <!--    </th>-->

                                        <!--</tr>-->
                                    </thead>
                                    <tbody class="border">
                                        <?php
                                        $i = 1;
                                        $total_plots = 0;
                                        $reg_completed = 0;
                                        $doc_received_pending = 0;
                                        $doc_received_completed = 0;
                                        $legal_issue_office = 0;
                                        $legal_issue_completed = 0;
                                        
                                        $total_plot_nos = 0;
                                        $total_reg_completed = 0;
                                        $total_doc_received_pending = 0;
                                        $total_doc_received_completed = 0;
                                        $total_legal_issue_office = 0;
                                        $total_legal_issue_completed = 0;
                                        ?>
                                        @if (isset($projects))
                                            @foreach ($projects as $project)
                                                <?php
                                                $total_plots = \App\Models\PlotManagement::where('project_id', $project->id)
                                                    ->where('deleted_at', '=', 0)
                                                    ->get()
                                                    ->count();
                                                $reg_completed = \App\Models\Booking::where('project_id', $project->id)
                                                    ->whereNotNull('register_status')
                                                    ->whereNull('booking_status')
                                                    ->get()
                                                    ->count();
                                                $doc_received_pending = \App\Models\Booking::where('project_id', $project->id)
                                                    ->whereNotNull('doc_receive_status')
                                                    ->whereNull('booking_status')
                                                    ->whereNull('doc_issue_status')
                                                    ->get()
                                                    ->count();
                                                $doc_received_completed = \App\Models\Booking::where('project_id', $project->id)
                                                    ->whereNotNull('doc_issue_status')
                                                    ->whereNull('booking_status')
                                                    ->get()
                                                    ->count();
                                                $legal_issue_office = \App\Models\Booking::where('project_id', $project->id)
                                                    ->whereNull('legal_issue_status')
                                                    ->whereNotNull('doc_issue_status')
                                                    ->whereNull('booking_status')
                                                    ->get()
                                                    ->count();
                                                $legal_issue_completed = \App\Models\Booking::where('project_id', $project->id)
                                                    ->whereNotNull('legal_issue_status')
                                                    ->whereNull('booking_status')
                                                    ->get()
                                                    ->count();
                                                ?>
                                                <tr>
                                                    <td> {{ $i++ }}</td>
                                                    <td> {{ $project->short_name }} </td>
                                                    <td onclick="plot_nos_view({{ $project->id }})" class="text-danger"
                                                        style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        {{ $total_plots }}
                                                    </td>
                                                    <td onclick="Registration_completed_lists({{ $project->id }})" class="text-danger"
                                                        style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        {{ $reg_completed }}
                                                    </td>
                                                    <td onclick="Reg_doc_office_lists({{ $project->id }})"
                                                        class="text-danger"
                                                        style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        {{ $doc_received_pending }}</td>
                                                    <td onclick="Reg_doc_issued_lists({{ $project->id }})"
                                                        class="text-danger"
                                                        style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        {{ $doc_received_completed }}</td>
                                                    <td onclick="Legal_book_office_lists({{ $project->id }})"
                                                        class="text-danger"
                                                        style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        {{ $legal_issue_office }}</td>
                                                    <td onclick="Legal_book_issued_lists({{ $project->id }})"
                                                        class="text-danger"
                                                        style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        {{ $legal_issue_completed }}</td>
                                                </tr>

                                                <?php
                                                $total_plot_nos = $total_plot_nos + $total_plots;
                                                $total_reg_completed = $total_reg_completed + $reg_completed;
                                                $total_doc_received_pending = $total_doc_received_pending + $doc_received_pending;
                                                $total_doc_received_completed = $total_doc_received_completed + $doc_received_completed;
                                                $total_legal_issue_office = $total_legal_issue_office + $legal_issue_office;
                                                $total_legal_issue_completed = $total_legal_issue_completed + $legal_issue_completed;
                                                ?>
                                            @endforeach
                                        @endif

                                        <tr>
                                            <td colspan="2">
                                                <h6 class="text-end fw-bold text-danger">Total :</h6>
                                            </td>
                                            <td style="color: #6259ca;">
                                                <h6 class="fw-bold">{{ $total_plot_nos }} </h6>
                                            </td style="color: #6259ca;">
                                            <td style="color: #6259ca;">
                                                <h6 class="fw-bold">{{ $total_reg_completed }} </h6>
                                            </td style="color: #6259ca;">

                                            <td style="color: #6259ca;">
                                                <h6 class="fw-bold">{{ $total_doc_received_pending }}</h6>
                                            </td>
                                            <td style="color: #6259ca;">
                                                <h6 class="fw-bold">{{ $total_doc_received_completed }}</h6>
                                            </td>
                                            <td style="color: #6259ca;">
                                                <h6 class="fw-bold">{{ $total_legal_issue_office }}</h6>
                                            </td>
                                            <td style="color: #6259ca;">
                                                <h6 class="fw-bold">{{ $total_legal_issue_completed }}</h6>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--</div>-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
    
   
     $('#plot_no').on('change', function() {
         plot_search();
     });
        function plot_search() {
            var id = $("#t_project_id").val();
            plot_nos_view(id);
        }

        function plot_nos_view(id) {
             $("#get_plotnos_ListModal").modal("show");
            $("#t_project_id").val(id);
            $("#project_id").val(id).trigger("change");
            var plot_id = $("#plot_no").val();
            var type = 'get-plot-nos';
            $.ajax({
                url: "{{ url('/') }}"+"/legal-document-abstract-list",
                method: "GET",
                data: {
                    project_id: id,
                    type: type,
                    plot_id: plot_id
                },
                success: function(res) {
                    if (res.status == true) {
                        
                            var text = "";
                            $("#plot_no").html(res.list);
                          
                            
                            // if (res.plots.length > 0) {
                            //     $("#plot_no").html(
                            //         "<option value=''>Select Plot No</option>"
                            //     );
                                
                            //     $.each(res.plots, function(key, value) {
                            //         $("#plot_no").append('<option value="' + value.id + '">' +
                            //             value.plot_no + '</option>')
                            //     });
                                
                               
                            // } else {
                            //     $("#plot_no").html(
                            //         "<option value=''>Select Plot No</option>"
                            //     );
                            // }
                            if (res.html != "") {
                            $("#plot_no_body").empty().html(res.html);
                        } else {
                            $("#plot_no_body").html('<tr><td colspan="6">Data no Found</td></tr>');
                        }
                    }
                },
            });
        }
        
         

       $('#reg_plot_no').on('change', function() {
         reg_plot_search();
        });
        function reg_plot_search() {
            var id = $("#r_project_id").val();
            Registration_completed_lists(id);
        }

        function Registration_completed_lists(id) {
           
            $("#RegCompleted_ListModal").modal("show");
            $("#r_project_id").val(id);
            $("#reg_project_id").val(id).trigger("change");
            var plot_id = $("#reg_plot_no").val();
            var type = 'register-completed-list';
            $.ajax({
                url: "{{ url('/') }}"+"/legal-document-abstract-list",
                method: "GET",
                data: {
                    project_id: id,
                    type: type,
                    plot_id: plot_id,
                },
                success: function(res) {
                    
                    if (res.status == true) {
                        if (res.html != "") {
                            $("#reg_plot_no").html(res.list);
                            // if (res.plots.length > 0) {
                            //     $.each(res.plots, function(key, value) {
                            //         $("#reg_plot_no").append('<option value="' + value.id + '">' +
                            //             value.plot_no + '</option>')
                            //     });
                            // } else {
                            //     $("#reg_plot_no").html(
                            //         "<option value=''>Select Plot No</option><option value=''>No Data Found</option>"
                            //     );
                            // }
                            $("#reg_com_body").empty().html(res.html);
                        } else {
                            $("#reg_com_body").html('<tr><td colspan="6">Data no Found</td></tr>');
                        }
                        
                    }
                        
                    // if (res.status == true) {
                    //     if (res.html != "") {
                    //          alert(res.plots.length)
                    //          if (res.plots.length > 0) {
                    //             $.each(res.plots, function(key, value) {
                    //                 $("#reg_plot_no").append('<option value="' + value.id + '">' +
                    //                     value.plot_no + '</option>')
                    //             });
                    //         } else {
                    //             $("#reg_plot_no").html(
                    //                 "<option value=''>Select Plot No</option><option value=''>No Data Found</option>"
                    //             );
                    //         }
                            
                            
                    //          $("#reg_com_body").html(res.html);
                    //     } else {
                    //         console.log("else");
                    //         $("#reg_com_body").html('<tr><td colspan="6">Data no Found</td></tr>');
                    //     }

                    // }
                },
            });

        }
        
         $('#office_plot_no').on('change', function() {
         off_plot_search();
     });

        function off_plot_search() {
            var id = $("#off_project_id").val();
            Reg_doc_office_lists(id);
        }

        function Reg_doc_office_lists(id) {
            $("#RegDoc_Office_ListModal").modal("show");
            $("#off_project_id").val(id);
            $("#office_project_id").val(id).trigger("change");
            var plot_id = $("#office_plot_no").val();
            var type = 'register-doc-office-list';
            $.ajax({
                url: "{{ url('/') }}"+"/legal-document-abstract-list",
                method: "GET",
                data: {
                    project_id: id,
                    type: type,
                    plot_id: plot_id
                },
                success: function(res) {
                    if (res.status == true) {
                        if (res.html != "") {
                               $("#office_plot_no").html(res.list);
                            // if (res.plots.length > 0) {
                            //     $.each(res.plots, function(key, value) {
                            //         $("#office_plot_no").append('<option value="' + value.plot_id +
                            //             '">' +
                            //             value.plot_no + '</option>')
                            //     });
                            // } else {
                            //     $("#office_plot_no").html(
                            //         "<option value=''>Select Plot No</option><option value=''>No Data Found</option>"
                            //     );
                            // }
                            $("#reg_doc_off_tbody").html(res.html);
                        } else {
                            $("#reg_doc_off_tbody").html('<tr><td colspan="9">Data no Found</td></tr>');
                        }
                    }
                },
            });
        }


    $('#office_issue_plot_no').on('change', function() {
         off_issue_plot_search();
     });
        function off_issue_plot_search() {
            var id = $("#off_issue_p_id").val();
            Reg_doc_issued_lists(id);
        }

        function Reg_doc_issued_lists(id) {
            $("#RegDoc_Issued_ListModal").modal("show");

            var plot_id = $("#office_issue_plot_no").val();
            $("#off_issue_p_id").val(id);
            $("#office_issue_p_id").val(id).trigger("change");
            var type = 'register-doc-issued-list';
            $.ajax({
                url: "{{ url('/') }}"+"/legal-document-abstract-list",
                method: "GET",
                data: {
                    project_id: id,
                    type: type,
                    plot_id: plot_id
                },
                success: function(res) {
                    if (res.status == true) {
                        if (res.html != "") {
                            
                            $("#office_issue_plot_no").html(res.list);

                            // if (res.plots.length > 0) {
                            //     $.each(res.plots, function(key, value) {
                            //         $("#office_issue_plot_no").append('<option value="' + value
                            //             .plot_id +
                            //             '">' +
                            //             value.plot_no + '</option>')
                            //     });
                            // } else {
                            //     $("#office_issue_plot_no").html(
                            //         "<option value=''>Select Plot No</option><option value=''>No Data Found</option>"
                            //     );
                            // }
                            $("#reg_doc_issued_tbody").html(res.html);
                        } else {
                            $("#reg_doc_issued_tbody").html('<tr><td colspan="9">Data no Found</td></tr>');
                        }
                    }
                },
            });
        }

          $('#legal_plot_no').on('change', function() {
         legal_office_plot_search();
         });
     
        function legal_office_plot_search() {
            var id = $("#legal_project_id").val();
            Legal_book_office_lists(id);
        }

        function Legal_book_office_lists(id) {
            $("#LegalBook_Office_ListModal").modal("show");

            var plot_id = $("#legal_plot_no").val();
            $("#legal_project_id").val(id);
            $("#legal_off_project_id").val(id).trigger("change");
            var type = 'legal-book-office-list';
            $.ajax({
                url: "{{ url('/') }}"+"/legal-document-abstract-list",
                method: "GET",
                data: {
                    project_id: id,
                    type: type,
                    plot_id: plot_id
                },
                success: function(res) {
                    if (res.status == true) {
                        if (res.html != "") {
                            
                             $("#legal_plot_no").html(res.list);

                            // if (res.plots.length > 0) {
                            //     $.each(res.plots, function(key, value) {
                            //         $("#legal_plot_no").append('<option value="' + value.plot_id +
                            //             '">' + value.plot_no + '</option>');
                            //     });
                            // } else {
                            //     $("#legal_plot_no").html(
                            //         "<option value=''>Select Plot No</option><option value=''>No Data Found</option>"
                            //     );
                            // }
                            $("#legal_book_off_tbody").html(res.html);
                        } else {
                            $("#legal_book_off_tbody").html('<tr><td colspan="9">Data no Found</td></tr>');
                        }
                    }
                },
            });
        }

         $('#legal_issue_plot_no').on('change', function() {
         legal_isssue_plot_search();
         });
         
         
        function legal_isssue_plot_search() {
            var id = $("#legal_issue_p_id").val();
            Legal_book_issued_lists(id);
        }

        function Legal_book_issued_lists(id) {
            $("#LegalBook_Issued_ListModal").modal("show");

            var plot_id = $("#legal_issue_plot_no").val();
            $("#legal_issue_p_id").val(id);
            $("#legal_issue_project_id").val(id).trigger("change");
            var type = 'legal-book-issued-list';
            $.ajax({
                url: "{{ url('/') }}"+"/legal-document-abstract-list",
                method: "GET",
                data: {
                    project_id: id,
                    type: type,
                    plot_id: plot_id
                },
                success: function(res) {
                    if (res.status == true) {
                        if (res.html != "") {
                            
                            $("#legal_issue_plot_no").html(res.list);

 
                            // if (res.plots.length > 0) {
                            //     $.each(res.plots, function(key, value) {
                            //         $("#legal_issue_plot_no").append('<option value="' + value.plot_id +
                            //             '">' + value.plot_no + '</option>');
                            //     });
                            // } else {
                            //     $("#legal_issue_plot_no").html(
                            //         "<option value=''>Select Plot No</option><option value=''>No Data Found</option>"
                            //     );
                            // }
                            $("#legal_book_issued_tbody").html(res.html);
                        } else {
                            $("#legal_book_issued_tbody").html('<tr><td colspan="9">Data no Found</td></tr>');
                        }
                    }
                },
            });
        }

        function Close_model() {
            // $("#get_plotnos_ListModal").modal('hide');
            // $("#RegCompleted_ListModal").modal('hide');
            // $("#RegDoc_Office_ListModal").modal('hide');
            // $("#LegalBook_Office_ListModal").modal('hide');
            // $("#LegalBook_Issued_ListModal").modal('hide');

            // $("#t_project_id").val('');
            // $("#r_project_id").val('');
            // $("#off_project_id").val('');
            // $("#off_issue_p_id").val('');
            // $("#legal_project_id").val('');
            // $("#legal_issue_p_id").val('');

            // $("#plot_no").val('').trigger('change');
            // $("#reg_plot_no").val('').trigger('change');
            // $("#office_plot_no").val('').trigger('change');
            // $("#office_issue_plot_no").val('').trigger('change');
            // $("#legal_plot_no").val('').trigger('change');
            // $("#legal_issue_plot_no").val('').trigger('change');
            window.location.reload();
        }
    </script>
@endsection
