@extends('layouts.app')
@section('content')
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Vacant Plot Details</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form>
                            @csrf
                            @method('POST')
                            <div class="container">
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <h4 class="fw-bold mt-1" style="color: #6259ca; text-align:center;">Project Details
                                        </h4>
                                    </div>
                                </div>
                                <div class="row border border-light-subtle" style="border-radius:5px;">
                                    <div class="col-sm-6 col-md-4 mb-2">
                                        <label class="form-label">Project Name <span class="text-red">*</span></label>
                                        <select name="get_project_id" id="get_project_id" class="form-control SlectBox"
                                            onchange="vacant_plot_details()">
                                            <option value="">Select Project</option>
                                            @if (isset($projects))
                                                @foreach ($projects as $project)
                                                    <option value="{{ $project->id }}">{{ $project->short_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span id="project_name_validation" class="text-danger" style="display:none;">Project
                                            Field is Required</span>
                                    </div>

                                    <div class="col-sm-6 col-md-4 mb-2">
                                        <label class="form-label" style="color:white;">.</label>
                                        <!--<a id="vacant_plots_print" class="btn-info border-0 me-1 btnprn" href="#" style="padding: 4px;width:25px ; border-radius:5px;">-->
                                        <!-- <i class="fa fa-print" data-bs-toggle="tooltip" title="" data-bs-original-title="Print" aria-label="Print"></i>-->
                                        <!--  </a>-->
                                            @php
                                                 $permission = new \App\Models\Permission();
                                                $print_check = $permission->checkPermission('vacantplotdetails.print');
                                            @endphp
                                            @if($print_check == 1)
                                            <a class="btn btn-primary me-2 btnprn" id="vacant_plots_print" href="#" title="Vacant Print" 
                                            style="padding: 4px;width:45px;border-radius:5px;">Print</a>
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <h4 class="fw-bold mt-1" style="color: #6259ca; text-align:center;">Plot(s) Details
                                        </h4>
                                    </div>
                                </div>
                                <!--<div class="row border border-light-subtle" style="border-radius:5px;">-->
                                <!--    <div class="col-12">-->
                                <!--        <div class="card p-2">-->
                                <!--            <div class="card-body">-->
                                <!--                <div class="row">-->
                                <!--                    <div class="col-md-8">-->
                                <!--                        <div class="row">-->
                                <!--                            <div class="col-md-3">-->
                                <!--                                <label class="form-label">Project Name-->
                                <!--                                    &nbsp;&nbsp;&nbsp;&nbsp;-->
                                <!--                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                <!--                                    :</label>-->
                                <!--                            </div>-->
                                <!--                            <div class="col-md-8">-->
                                <!--                                <div class="input-group">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                <!--                                    <label class="form-label text-success"-->
                                <!--                                        id="project_name">-->
                                <!--                                    </label>-->

                                <!--                                </div>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </div>-->
                                <!--                    <div class="col-md-4">-->
                                <!--                        <div class="row">-->
                                <!--                            <div class="col-md-6">-->
                                <!--                                <label class="form-label">-->
                                <!--                                    Start Date-->
                                <!--                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                <!--                                    &nbsp;&nbsp;:-->
                                <!--                                </label>-->
                                <!--                            </div>-->
                                <!--                            <div class="col-md-6">-->
                                <!--                                <div class="input-group">-->
                                <!--                                    <label class="form-label text-success" id="start_date">-->
                                <!--                                    </label>-->

                                <!--                                </div>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </div>-->

                                <!--                </div>-->
                                <!--                <div class="row">-->
                                <!--                    <div class="col-md-4">-->
                                <!--                        <div class="row">-->
                                <!--                            <div class="col-md-7">-->
                                <!--                                <label class="form-label text-start"># Days Since Start-->
                                <!--                                    <br> Date-->
                                <!--                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                <!--                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                <!--                                    &nbsp;&nbsp;&nbsp;&nbsp;:</label>-->
                                <!--                            </div>-->
                                <!--                            <div class="col-md-5">-->
                                <!--                                <div class="input-group">-->
                                <!--                                    <label class="form-label text-success"-->
                                <!--                                        id="start_date_days">-->
                                <!--                                    </label>-->

                                <!--                                </div>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </div>-->
                                <!--                    <div class="col-md-4">-->
                                <!--                        <div class="row">-->
                                <!--                            <div class="col-md-6">-->
                                <!--                                <label class="form-label">First Booking Date :</label>-->
                                <!--                            </div>-->
                                <!--                            <div class="col-md-6">-->
                                <!--                                <div class="input-group">-->
                                <!--                                    <label class="form-label text-success"-->
                                <!--                                        id="booking_start_date">-->
                                <!--                                    </label>-->

                                <!--                                </div>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </div>-->
                                <!--                    <div class="col-md-4">-->
                                <!--                        <div class="row">-->
                                <!--                            <div class="col-md-6">-->
                                <!--                                <label class="form-label">Last Booking Date :</label>-->
                                <!--                            </div>-->
                                <!--                            <div class="col-md-6">-->
                                <!--                                <div class="input-group">-->
                                <!--                                    <label class="form-label text-success"-->
                                <!--                                        id="booking_last_date">-->
                                <!--                                    </label>-->

                                <!--                                </div>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </div>-->
                                <!--                </div>-->
                                <!--                <div class="row">-->
                                <!--                    <div class="col-md-4">-->
                                <!--                        <div class="row">-->
                                <!--                            <div class="col-md-7">-->
                                <!--                                <label class="form-label text-start">Booked Plots-->
                                <!--                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                <!--                                    &nbsp;&nbsp;:</label>-->
                                <!--                            </div>-->
                                <!--                            <div class="col-md-5">-->
                                <!--                                <div class="input-group">-->
                                <!--                                    <label class="form-label text-success"-->
                                <!--                                        id="booking_plots">-->
                                <!--                                    </label>-->

                                <!--                                </div>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </div>-->
                                <!--                    <div class="col-md-4">-->
                                <!--                        <div class="row">-->
                                <!--                            <div class="col-md-6">-->
                                <!--                                <label class="form-label">Vacant Plots-->
                                <!--                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                <!--                                    :</label>-->
                                <!--                            </div>-->
                                <!--                            <div class="col-md-6">-->
                                <!--                                <div class="input-group">-->
                                <!--                                    <label class="form-label text-success"-->
                                <!--                                        id="vacant_plots">-->
                                <!--                                    </label>-->

                                <!--                                </div>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </div>-->
                                <!--                    <div class="col-md-4">-->
                                <!--                        <div class="row">-->
                                <!--                            <div class="col-md-6">-->
                                <!--                                <label class="form-label">Total Plots-->
                                <!--                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>-->
                                <!--                            </div>-->
                                <!--                            <div class="col-md-6">-->
                                <!--                                <div class="input-group">-->
                                <!--                                    <label class="form-label text-success"-->
                                <!--                                        id="total_plots">-->
                                <!--                                    </label>-->

                                <!--                                </div>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </div>-->
                                <!--                </div>-->
                                <!--                <div class="row">-->
                                <!--                    <div class="col-md-4">-->
                                <!--                        <div class="row">-->
                                <!--                            <div class="col-md-7">-->
                                <!--                                <label class="form-label">Booked Sq.Ft.-->
                                <!--                                    &nbsp;-->
                                <!--                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                <!--                                    :</label>-->
                                <!--                            </div>-->
                                <!--                            <div class="col-md-5">-->
                                <!--                                <div class="input-group">-->
                                <!--                                    <label class="form-label text-success"-->
                                <!--                                        id="booking_plots_sqft">-->
                                <!--                                    </label>-->

                                <!--                                </div>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </div>-->
                                <!--                    <div class="col-md-4">-->
                                <!--                        <div class="row">-->
                                <!--                            <div class="col-md-6">-->
                                <!--                                <label class="form-label">Vacant Sq.Ft.-->
                                <!--                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>-->
                                <!--                            </div>-->
                                <!--                            <div class="col-md-6">-->
                                <!--                                <div class="input-group">-->
                                <!--                                    <label class="form-label text-success"-->
                                <!--                                        id="vacant_plots_sqft">-->
                                <!--                                    </label>-->

                                <!--                                </div>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </div>-->
                                <!--                    <div class="col-md-4">-->
                                <!--                        <div class="row">-->
                                <!--                            <div class="col-md-6">-->
                                <!--                                <label class="form-label text-start">Total Sq.Ft.-->
                                <!--                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>-->
                                <!--                            </div>-->
                                <!--                            <div class="col-md-6">-->
                                <!--                                <div class="input-group">-->
                                <!--                                    <label class="form-label text-success"-->
                                <!--                                        id="total_plots_sqft">-->
                                <!--                                    </label>-->

                                <!--                                </div>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                                <!--                    </div>-->
                                <!--                </div>-->
                                <!--            </div>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                             <div class="row mt-2">
                                <div class="col-lg-4 col-md-12 mt-2">
                                <table class="table table-borderless">
                                    <tbody>
                                          <tr>
                                            <td class="text-start border-0" style="width:160px;"><label class="form-label mb-0">Project Name &nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;:</label></td>
                                            <td class="text-start border-0"><label class="form-label text-success border-0" id="project_name"></label></td>
                                        </tr>
                                        <tr>
                                            <td class="text-start border-0"><label class="form-label mb-0">Start Date &nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label></td>
                                            <td class="text-start border-0"><label class="form-label text-success border-0" id="start_date"></label></td>
                                        </tr>
                                        <tr>
                                            <td class="text-start border-0"><label class="form-label mb-0">First Booking &nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;:</label></th>
                                            <td class="text-start border-0"> <label class="form-label text-success border-0" id="booking_start_date"></label></td>
                                        </tr>
                                          <tr>
                                            <td class="text-start border-0"><label class="form-label mb-0">Last Booking &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;:</label></td>
                                            <td class="text-start border-0"> <label class="form-label text-success border-0" id="booking_last_date"></label></td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                                <div class="col-lg-4 col-md-12 mt-2">
                               <table class="table table-borderless">
                                <tbody>
                                   <tr>
                                            <td class="text-start border-0" style="width:160px"><label class="form-label mb-0">Days Since Start  Date :</label></td>
                                            <td class="text-start border-0">  <label class="form-label text-success" id="start_date_days"></label></td>
                                        </tr>
                                    <tr>
                                        <td class="text-start border-0"><label class="form-label mb-0">Booked Plots &nbsp;&nbsp;&nbsp;&nbsp;:</label></td>
                                        <td class="text-start border-0"><label class="form-label text-success border-0" id="booking_plots"></label></td>
                                    </tr>
                                    <tr>
                                        <td class="text-start border-0"><label class="form-label mb-0">Vacant Plots &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label></td>
                                        <td class="text-start border-0">  <label class="form-label text-success border-0" id="vacant_plots"></label></td>
                                    </tr>
                                      <tr>
                                            <td class="text-start border-0"><label class="form-label mb-0">Total Plots &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;:</label></td>
                                            <td class="text-start border-0">  <label class="form-label text-success border-0" id="total_plots"></label></td>
                                        </tr>
                                  </tbody>
                               </table>

                                </div>
                                <div class="col-lg-4 col-md-12 mt-2">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td class="text-start border-0" style="width:160px"><label class="form-label text-white mb-0">.</label></td>
                                            <td class="text-start border-0"><label class="form-label text-white mb-0">.</label></td>
                                        </tr>
                                        <tr>
                                            <td class="text-start border-0"><label class="form-label mb-0">Booked Sq.Ft. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                                            &nbsp;&nbsp;&nbsp;&nbsp;:</label></td>
                                            <td class="text-start border-0"> <label class="form-label text-success border-0" id="booking_plots_sqft"></label></td>
                                        </tr>
                                        <tr>
                                            <td class="text-start border-0"><label class="form-label mb-0">Vacant Sq.Ft. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;:</label></td>
                                            <td class="text-start border-0"> <label class="form-label text-success border-0" id="vacant_plots_sqft"></label></td>
                                        </tr>
                                          <tr>
                                            <td class="text-start border-0"><label class="form-label mb-0">Total Sq.Ft.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; :</label></td>
                                            <td class="text-start border-0"><label class="form-label text-success border-0" id="total_plots_sqft"></label></td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                                </div>

                            </div>
                            <div class="container">
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <h4 class="fw-bold mt-1" style="color: #6259ca; text-align:center;">Vacant Plot
                                            Details
                                        </h4>
                                    </div>
                                </div>
                                <div class="row border border-light-subtle" style="border-radius:5px;">
                                    <div class="col-12">
                                        <div class="card p-2">
                                            <div class="card-body">

                                                <div class="row">
                                                    <div class="table-responsive">
                                                        <br>
                                                        <table id="vacant_plot_table"
                                                            class="table border table-bordered text-nowrap text-md-nowrap table-striped mg-b-0">
                                                            <tbody>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>Plot No</th>
                                                                    <th>Sq.Ft</th>
                                                                    <th>Direction</th>
                                                                </tr>
                                                            </tbody>
                                                            <tbody id="vacant_plot_body" class="border">
                                                                <tr id="table_row_1">
                                                                    <td colspan="4" style="text-align:center">No Data
                                                                        Found</td>
                                                                </tr>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <h5 class="fw-bold text-end text-danger">Total :
                                                                        </h5>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <h5 id="total_vacant_plot_sqfts"
                                                                            class="text-primary fw-bold text-start">0</h5>
                                                                    </td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // $(document).ready(function() {
        //     expense_lists();
        // });
        // function select2_list() {
        //     $(document).ready(function() {
        //         $(".reg_expense_select").select2();
        //     });
        // }
        function vacant_plot_details() {
            var project_id = $("#get_project_id").val();
            $("#vacant_plots_print").attr('href','#');
            var url = "{{ url('/') }}/get_vacant_plots";
            if (project_id != "") {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        project_id: project_id
                    },
                    success: function(res) {
                        if (res.status == true) {
                             if(res.project_id != null && res.project_id != ""){
                                var vacant_print_url = '{{ url('/') }}/vacant_plots_print/' + res.project_id +'/list';
                             $("#vacant_plots_print").attr('href',vacant_print_url);
                            }else{
                             $("#vacant_plots_print").attr('href','#');
                            }
                             
                            
                             if(res.project_name != null && res.project_name != ""){
                                $("#project_name").text(res.project_name);
                            }else{
                                 $("#project_name").text('');
                            }
                             if(res.start_date != null && res.start_date != ""){
                                $("#start_date").text(res.start_date);
                            }else{
                                $("#start_date").text('');
                            }
                             if(res.days != null && res.days != ""){
                                $("#start_date_days").text(res.days);
                            }else{
                                $("#start_date_days").text('');
                            }
                             if(res.booking_start_date != null && res.booking_start_date != ""){
                                  $("#booking_start_date").text(res.booking_start_date);
                            }else{
                                   $("#booking_start_date").text('');
                            }
                            if(res.booking_last_date != null && res.booking_last_date != ""){
                                 $("#booking_last_date").text(res.booking_last_date);
                            }else{
                                  $("#booking_last_date").text('');
                            }
                            if(res.booking_plots != null && res.booking_plots != ""){
                                 $("#booking_plots").text(res.booking_plots);
                            }else{
                                  $("#booking_plots").text('');
                            }
                            if(res.vacant_plots != null && res.vacant_plots != ""){
                                $("#vacant_plots").text(res.vacant_plots);
                            }else{
                                  $("#vacant_plots").text('');
                            }
                            if(res.total_plots != null && res.total_plots != ""){
                                $("#total_plots").text(res.total_plots);
                            }else{
                                 $("#total_plots").text('');
                            }
                            if(res.booking_plots_sqft != null && res.booking_plots_sqft != ""){
                               $("#booking_plots_sqft").text(res.booking_plots_sqft.toFixed(2));
                            }else{
                                 $("#booking_plots_sqft").text('');
                            }
                            
                             if(res.vacant_plots_sqft != null && res.vacant_plots_sqft != ""){
                                  $("#vacant_plots_sqft").text(res.vacant_plots_sqft.toFixed(2));
                            }else{
                                   $("#vacant_plots_sqft").text('');
                            }
                             if(res.total_plots_sqft != null && res.total_plots_sqft != ""){
                                  $("#total_plots_sqft").text(res.total_plots_sqft.toFixed(2));
                            }else{
                                   $("#total_plots_sqft").text('');
                            }
                          
                            if (res.vacant_pot_nos != "") {
                                $("#vacant_plot_body").html(res.vacant_pot_nos);
                                $("#total_vacant_plot_sqfts").text(res.total_vacant_plots.toFixed(2));
                            } else {
                                $("#vacant_plot_body").html(
                                    '<tr> <td colspan="4" style="text-align:center">No Data Found</td></tr>'
                                );
                                $("#total_vacant_plot_sqfts").text(0);
                            }

                        } else {
                            clear_vacant_plot_details();
                        }
                    }
                });
            } else {
                clear_vacant_plot_details();
            }
        }

        function clear_vacant_plot_details() {
            $("#project_name").text('');
            $("#start_date").text('');
            $("#start_date_days").text('');
            $("#booking_start_date").text('');
            $("#booking_last_date").text('');
            $("#booking_plots").text('');
            $("#vacant_plots").text('');
            $("#total_plots").text('');
            $("#booking_plots_sqft").text('');
            $("#vacant_plots_sqft").text('');
            $("#total_plots_sqft").text('');
            $("#vacant_plot_body").html(
                '<tr> <td colspan="4" style="text-align:center">No Data Found</td></tr>'
            );
            $("#total_vacant_plot_sqfts").text(0);
        }
    </script>
@endsection
