@extends('layouts.app')
@section('content')
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Plot History</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form id="Plot_history_Form" autocomplete="off">
                            @csrf
                            @method('POST')
                            <div class="row mt-2">
                                <div class="col-12">
                                    <h4 class="fw-bold mt-1" style="color: #6259ca; text-align:center;">Project Details</h4>
                                </div>
                            </div>
                            <div class="row border border-light-subtle" style="border-radius:5px;">
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label">Project Name <span class="text-red">*</span></label>
                                    <select name="get_project_id" id="get_project_id" class="form-control SlectBox"
                                        onchange="PlotNoView()">
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
                                    <label class="form-label">Plot No. <span class="text-red">*</span></label>
                                    <select name="plot_no" id="plot_no" class="form-control SlectBox"
                                        onchange="get_plot_history()">
                                        <option value="">Select Plot No</option>
                                    </select>
                                    <span id="plot_no_validation" class="text-danger" style="display:none;">Plot
                                        No Field is Required</span>
                                </div>

                               <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label" style="color:white;">.</label>
                                     @php
                                     $permission = new \App\Models\Permission();
                                    $print_check = $permission->checkPermission('plothistory.print');
                                @endphp
                                @if($print_check == 1) 
                                     <a class="btn btn-primary me-2 btnprn" id="plot_history_print" href="#" title="Project History Print" style="padding: 4px;width:45px;border-radius:5px;">
                                                Print</a>
                                @endif
                                </div> 
                            </div>
                        </form>
                    </div>
                    <div class="container">
                        <div class="row border border-light-subtle mt-3" style="border-radius:5px;">
                            <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12">
                                <div class="card border border-1">
                                    <div class="card-header border-bottom-0">
                                        <h4 class="fw-bold" style="color: #6259ca;">Customer Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label"> Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <label class="form-label text-success text-start" id="customer_name"> </label>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" id="relation_ship"> </label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <label class="form-label text-success" id="gender"> </label>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Mobile &nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <label class="form-label text-success" id="mobile"> </label>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" id="alternate_no">Alternate No
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <label class="form-label text-success" id="alternate_mobile"> </label>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label">Address &nbsp;
                                                &nbsp;&nbsp;&nbsp;:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <label class="form-label text-success" id="address"> </label>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12">
                                <div class="card border border-1">
                                    <div class="card-header border-bottom-0">
                                        <h4 class="fw-bold" style="color: #6259ca;">Plot Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Plot No &nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <label class="form-label text-success" id="plot_no_detail"> </label>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Plot Sq.Ft
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <label class="form-label text-success" id="total_plot_sqft"> </label>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Cent &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <label class="form-label text-success" id="cent"> </label>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Sq.Ft. Rate &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <label class="form-label text-success" id="sqft_rate"> </label>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Plot Value &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <label class="form-label text-success" id="plot_value"> </label>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12">
                                <div class="card border border-1">
                                    <div class="card-header border-bottom-0">
                                        <h4 class="fw-bold" style="color: #6259ca;">Marketer Details</h4>
                                    </div>
                                    <div class="card-body">
                                        
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">ID &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <label class="form-label text-success" id="marketer_id"> </label>

                                                </div>
                                            </div>
                                                 <div class="col-md-3">
                                                <label class="form-label">Mobile &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <label class="form-label text-success" id="marketer_mobile"> </label>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-3">
                                                <label class="form-label">Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                :</label>
                                            </div>
                                            <div class="col-md-9 ">
                                                <div class="input-group">
                                                    <label class="form-label text-success" id="marketer_name"></label>
                                                </div>
                                            </div>
                                            <!--<div class="col-md-3">-->
                                            <!--    <h6 class="d-inline fw-bold">ID :</h6>-->
                                            <!--    <h6 class="d-inline text-success" id="marketer_id"></h6>-->
                                            <!--</div>-->
                                            <!--<div class="col-md-5">-->
                                            <!--    <h6 class="d-inline fw-bold text-start">Name :</h6>-->
                                            <!--    <h6 class="d-inline text-success" id="marketer_name"></h6>-->
                                            <!--</div>-->
                                            <!--<div class="col-md-4">-->
                                            <!--    <h6 class="d-inline fw-bold text-start">Mobile :</h6>-->
                                            <!--    <h6 class="d-inline text-success" id="marketer_mobile"></h6>-->
                                            <!--</div>-->
                                        </div>
                                        <div class="row">
                                            <div class="table-responsive">
                                                <br>
                                                <table id="marketer_table"
                                                    class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Designation</th>
                                                            <th>Marketer ID</th>
                                                            <th>Name</th>
                                                            <th>Mobile</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="marketer_details">
                                                        <tr id="table_row_1">
                                                            <td colspan="5" style="text-align:center">No Data Found
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12">
                                <div class="card border border-1">
                                    <div class="card-header border-bottom-0">
                                        <h4 class="fw-bold" style="color: #6259ca;">Registration Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Reg No &nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <label class="form-label text-success" id="reg_no"> </label>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Reg Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <label class="form-label text-success" id="reg_date"> </label>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Doc.Collected By &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <label class="form-label text-success" id="doc_col_by"> </label>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Mobile &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <label class="form-label text-success" id="doc_col_mobile"> </label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Doc.Collected Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <label class="form-label text-success" id="doc_col_date"> </label>

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <h5 id="registration_detail" class="text-center fw-bold"></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card border border-1">
                                    <div class="card-header border-bottom-0">
                                        <h4 class="fw-bold" style="color: #6259ca;">Payment Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="table-responsive">
                                                <br>
                                                <table id="payment_detail_table"
                                                    class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th style="text-align:center;">Receipt Date</th>
                                                            <th style="text-align:center;">Receipt #</th>
                                                            <th style="text-align:center;">Receipt Type</th>
                                                            <th style="text-align:center;">Payment Source</th>
                                                            <th style="text-align:center;">Paymode</th>
                                                            <th style="text-align:center;">Narration</th>
                                                            <th style="text-align:center;">Amount</th>
                                                            <th style="text-align:center;">Discount</th>
                                                            <th rowspan="2" style="text-align:center;">Total Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="border" id="payment_body">
                                                        <tr id="table_row_1">
                                                            <td colspan="11" style="text-align:center">No Data Found
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="4">
                                                                <h6 class="fw-bold text-end">No.of Days : <span
                                                                        class="text-success" id="number_of_days"></span>
                                                                </h6>
                                                            </td>
                                                            <td colspan="2">
                                                                <h6 class="fw-bold text-end">Balance : <span
                                                                        class="text-success" id="balance"></span></h6>
                                                            </td>
                                                            <td colspan="2" style="text-align:right;">
                                                                <h6 class="fw-bold text-end">Paid : <span
                                                                        class="text-success" id="total_paid_amt"></span>
                                                                </h6>
                                                            </td>
                                                                  <td colspan="" style="text-align:right;">
                                                                <h6 class="fw-bold"><span class="text-success text-center"
                                                                        id="total_discount_amt">0</span>
                                                                </h6>
                                                            </td>
                                                            <td colspan="" style="text-align:right;">
                                                                <h6 class="fw-bold"><span class="text-success text-center"
                                                                        id="grand_total_amt">0</span>
                                                                </h6>
                                                            </td>
                                                            <td class="">
                                                                
                                                                <a class="btn-info border-0 me-1" target="" href="#"  id="payment_print_btn" style="padding: 4px;width:45px ; border-radius:5px;">
                                                                    <i class="fa fa-print" data-bs-toggle="tooltip" title="" data-bs-original-title="Receipt Print" aria-label="Receipt Print"></i> 
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12">
                                <div class="card border border-1">
                                    <div class="card-header border-bottom-0">
                                        <h4 class="fw-bold" style="color: #6259ca;">Payment Term Details</h4>
                                    </div>
                                    <div class="card-body"> 
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label">Payment Term
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                            </div>
                                            <div class="col-md-6"  style="text-align:left">
                                                <div class="input-group">
                                                    <label class="form-label text-success" id="pay_term"> </label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label">Loan Company
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                            </div>
                                            <div class="col-md-6" style="text-align:left">
                                                <div class="input-group">
                                                    <label class="form-label text-success" id="bank_name"> </label>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Loan Section Date &nbsp;:</label>
                                            </div>
                                            <div class="col-md-6"  style="text-align:left">
                                                <div class="input-group" style="text-align:left">
                                                    <label class="form-label text-success" id="cheque_nos"> </label>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label">Loan Amount
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </label>
                                            </div>
                                            <div class="col-md-6"  style="text-align:left">
                                                <div class="input-group">
                                                    <label class="form-label text-success" id="loan_amount"> </label>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Remarks
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                            </div>
                                            <div class="col-md-6" style="text-align:left">
                                                <div class="input-group">
                                                    <label class="form-label text-success" id="remarks"> </label>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        // get the plot_nos
        function PlotNoView() {
            var project_id = $("#get_project_id").val();
            var url = "{{ url('/') }}/get_plot_history_plots";
            $("#plot_no").html("<option value=''>Select Plot No</option>");
            $("#plot_history_print").attr('href','#');
            clear_plot_history();
            if (project_id != "") {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        project_id: project_id
                    },
                    success: function(res) {
                        if (res.status == true) {
                            if (res.plot_nos.length > 0) {
                                $.each(res.plot_nos, function(key, value) {
                                    $("#plot_no").append('<option value="' + value
                                        .id +
                                        '">' +
                                        value.plot_no + '</option>')
                                });
                            } else {
                                $("#plot_no").html(
                                    "<option value=''>Select Plot No</option><option value=''>No Data Found</option>"
                                );
                            }
                        }
                    }
                });
            } else {
                $("#plot_no").val('').trigger('change');
                $("#marketer_details").html('<tr><td colspan="5" style="text-align:center">No Data Found</td></tr>');
            }
        }

        function get_plot_history() {
            var project_id = $("#get_project_id").val();
            var plot_id = $("#plot_no").val();
            $("#plot_history_print").attr('href','#');
            var url = "{{ url('/') }}/get_plot_history";
            if (project_id != "" && plot_id != "") {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        project_id: project_id,
                        plot_id: plot_id
                    },
                    success: function(res) {
                        if (res.status == true) {
                           var payment_print_url = '{{ url('/') }}/part_payment/' + res.project_id + '/' + res.plot_id + '/list';
                           $("#payment_print_btn").attr('href',payment_print_url).attr('target','_blank');
                           
                            if(res.project_id != null && res.project_id != "" && res.project_id != null &&  res.plot_id != ""){
                              var url = '{{ url('/') }}/plot_history_print/'  + res.project_id + '/' + res.plot_id + '/list';
                             $("#plot_history_print").attr('href',url);
                            }else{
                             $("#plot_history_print").attr('href','#');
                            }
                            
                            $("#customer_name").text(res.customer_name); // customer details
                            $("#gender").text(res.relation_name);
                            $('#relation_ship').text(res.relation_ship);
                            $("#mobile").text(res.mobile);
                            if(res.alternate_mobile != '')
                            {
                                 $("#alternate_mobile").text(res.alternate_mobile);
                                 $("#alternate_no").text('');
                            }else{
                                 $("#alternate_mobile").text(res.alternate_mobile);
                                 $("#alternate_no").text('Alternate No');
                            }
                            
                            $("#address").text(res.customer_address);


                            $("#plot_no_detail").text(res.plot_no); //plot details
                            $("#total_plot_sqft").text(res.total_plot_sqft);
                 if(res.cent == null)
                 { 
                     cent = 0;
                 }else{
                     cent = res.cent.toFixed(2);
                 }
                            $("#cent").text(cent);
                            $("#sqft_rate").text(res.sqft_rate);
                            $("#plot_value").text(res.plot_value);

                            $("#marketer_id").text(res.marketer_id);
                            $("#marketer_name").text(res.marketer_name);
                            $("#marketer_mobile").text(res.marketer_mobile);

                            if (res.marketer_details != '') {
                                $("#marketer_details").html(res.marketer_details);
                            } else {
                                $("#marketer_details").html(
                                    '<tr><td colspan="5" style="text-align:center">No Data Found</td></tr>');
                            }

                            if(res.reg_no != null && res.reg_no != ""){
                                $("#reg_no").text(res.reg_no);
                            }else{
                                 $("#reg_no").text('');
                            }
                            if(res.reg_date != null && res.reg_date != ""){
                                $("#reg_date").text(res.reg_date);
                            }else{
                                $("#reg_date").text('');
                            }
                           
                            if(res.doc_collected_by != null && res.doc_collected_by != ""){
                                $("#doc_col_by").text(res.doc_collected_by);
                            }else{
                                $("#doc_col_by").text('');
                            }
                            if(res.doc_collected_mobile != null && res.doc_collected_mobile != ""){
                                 $("#doc_col_mobile").text(res.doc_collected_mobile);
                            }else{
                                 $("#doc_col_mobile").text('');
                            }
                            if(res.doc_collected_date != null && res.doc_collected_date != ""){
                                $("#doc_col_date").text(res.doc_collected_date);
                            }else{
                                 $("#doc_col_date").text('');
                            }
                                
                            
                            if (res.customer_doc_list === 1) {
                                $("#registration_detail").text('Document Issued To Customer').addClass(
                                    'text-info').removeClass('text-danger');
                            } else if (res.customer_doc_list === 0) {
                                $("#registration_detail").text('Document Not Issued To Customer').addClass(
                                    'text-danger').removeClass('text-info');
                            } else {
                                $("#registration_detail").text('');
                            }
                            
                            const arr = res.pay_towards;
                            const substr_for_gl = 'GL';
 
                            const gl_check = arr.some(substr_for_gl => substr_for_gl.includes(substr_for_gl));
                            if(gl_check == true)
                            {
                                $('#remarks').text('Bank loan is for GL value only');
                            }else{
                            const arr = res.pay_towards;
                            const substr_for_mv = 'MV';
 
                            const mv_check = arr.some(substr_for_mv => substr_for_mv.includes(substr_for_mv)); 
                            if(mv_check == true)
                            {
                            $('#remarks').text('Bank loan is for MV value only');
                            }else{
                            const arr = res.pay_towards;
                            const substr_for_mv_gl = 'MV,GL';
 
                            const mv_gl_check = arr.some(substr_for_mv_gl => substr_for_mv_gl.includes(substr_for_mv_gl)); 
                            if(mv_check == true)
                            {
                            $('#remarks').text('Bank loan is for MV & GL value');
                            }else{
                                $('#remarks').text('');
                            }
                            }
                            }
                             if(res.pay_towards == '')
                             {
                                 $('#remarks').text('');
                             }
 
                      
                             if(res.loan_amount != '')
                             {
                             $('#pay_term').text('Bank Loan');
                             $('#bank_name').text(res.bank_name);
                             $('#cheque_nos').text(res.cheque_nos);
                             $('#loan_amount').text(res.loan_amount);   
                             }else{
                             $('#pay_term').text('Own Fund');
                             $('#bank_name').text('');
                             $('#cheque_nos').text('');
                             $('#loan_amount').text('');    
                             }
                             
                            //payment details
                            if (res.payment_details != '') {
                                $("#payment_body").html(res.payment_details);
                                $("#number_of_days").text(res.number_of_days);
                                $("#balance").text(res.balance);
                                $("#total_paid_amt").text(res.total_paid_amt);
                                $("#total_discount_amt").text(res.total_discount_amount);
                                $("#grand_total_amt").text(res.grant_total_amt);
                            } else {
                                 console.log('irrf'+res.total_discount_amount);
                                $("#payment_body").html(
                                    '<tr><td colspan="10" style="text-align:center">No Data Found</td></tr>'
                                );
                                $("#number_of_days").text(0);
                                $("#balance").text(0.00);
                                $("#total_paid_amt").text(0.00);
                                $("#total_discount_amt").text(0.00);
                                $("#grand_total_amt").text(0.00);
                            }
                            



                        }
                    }
                });
            } else {
                clear_plot_history();
            }
        }

        function clear_plot_history() {
            $("#customer_name").text('');
            $("#gender").text('');
            $("#mobile").text('');
            $("#alternate_mobile").text('');
            $("#customer_phone").text('');
            $("#address").text('');

            $("#plot_no_detail").text('');
            $("#total_plot_sqft").text('');
            $("#cent").text('');
            $("#sqft_rate").text('');
            $("#description").text('');
            $("#plot_value").text('');

            $("#marketer_id").text('');
            $("#marketer_name").text('');
            $("#marketer_mobile").text('');
            $("#marketer_details").html('<tr><td colspan="5" style="text-align:center">No Data Found</td></tr>');

            $("#reg_no").text('');
            $("#reg_date").text('');
            $("#doc_col_by").text('');
            $("#doc_col_mobile").text('');
            $("#doc_col_date").text('');
            $("#registration_detail").text('');
            $("#number_of_days").text('');
            $("#balance").text('');
            $("#total_paid_amt").text('');
            $('#pay_term').text('');
            $('#bank_name').text('');
            $('#cheque_nos').text('');
            $('#loan_amount').text('');   
            $('#remarks').text('');
            $("#payment_body").html(
                '<tr><td colspan="10" style="text-align:center">No Data Found</td></tr>');
           $("#total_discount_amt").text(0);
            $("#grand_total_amt").text(0);
        }
    </script>
@endsection
