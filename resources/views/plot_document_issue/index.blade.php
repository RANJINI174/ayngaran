@extends('layouts.app')
@section('content')
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Plot Document Issue</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form id="Add_PlotDocumentIssue_Form" autocomplete="off">
                            @csrf
                            @method('POST')
                            <div class="row mt-2">
                                <div class="col-12">
                                    <h5 class="fw-bold" style="color: #6259ca; text-align:center;">Project Details</h5>
                                </div>
                            </div>
                            <div class="row p-2" style="border-radius:5px; border:1px solid #212326ad;">
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <input type="hidden" id="store_url" value="{{ route('plot_document_issue_store') }}">
                                    <input type="hidden" name="booking_id" id="booking_id">
                                    <label class="form-label mt-0">Project Name <span class="text-red">*</span></label>
                                    <select name="get_project_id" id="get_project_id" class="form-control SlectBox"
                                        onchange="PlotNoView()">
                                        <option value="">Select Project</option>
                                        @if (isset($projects))
                                           @if (count($projects) > 0)
                                                @foreach ($projects as $project)
                                                    <option value="{{ $project->id }}">{{ $project->short_name }}</option>
                                                @endforeach
                                                @else
                                                 <option value="">No Data Found</option>
                                            @endif
                                        @endif
                                    </select>
                                    <span id="project_name_validation" class="text-danger" style="display:none;">Project
                                        Field
                                        is Required</span>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label mt-0">Plot No.<span class="text-red">*</span></label>
                                    <select name="get_plot_no" id="get_plot_no" class="form-control SlectBox"
                                        onchange="get_plot_sqft()">
                                        <option value="">Select Plot No</option>
                                        <option value="">No Data Found</option>
                                    </select>
                                    <span id="get_plot_no_validation" class="text-danger" style="display:none;">Plot No
                                        Field
                                        is Required</span>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h5 class="fw-bold" style="color: #6259ca; text-align:center;">Plot Details</h5>
                                </div>
                            </div>
                            <div class="row p-2"style="border-radius:5px; border:1px solid #212326ad;">
                                <div class="col-sm-6 col-md-6 mb-2">
                                    <div class="row">
                                        <label for="" class="col-6 col-md-6 col-lg-3 form-label">Plot Sq.Ft.</label>
                                        <div class="col-6 col-md-6 col-lg-9">
                                            <input type="hidden" class="form-control" name="plot_sq_val" id="plot_sq_val">
                                            <label class="form-label text-success" id="get_plot_sqft"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h5 class="fw-bold" style="color: #6259ca; text-align:center;">Customer Details</h5>
                                </div>
                            </div>
                            <div class="row mt- p-2" style="border-radius:5px; border:1px solid #212326ad;">
                                <div class="col-md-6 mb-2">
                                    <div class="row">
                                        <label for="" class="col-6 col-md-6 col-lg-3 form-label">Name.</label>
                                        <div class="col-6 col-md-6 col-lg-9">
                                            <input type="hidden" class="form-control" name="customer_name"
                                                id="customer_name">
                                            <label class="form-label text-success" id="cust_name"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 mb-2">
                                    <div class="row">
                                        <label for="" class="col-6 col-md-6 col-lg-3 form-label">Mobile.</label>
                                        <div class="col-6 col-md-6 col-lg-9">
                                            <input type="hidden" class="form-control" name="mobile_no" id="mobile_no">
                                            <label class="form-label text-success" id="mob_text"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 mb-2">
                                    <div class="row">
                                        <label for="" class="col-6 col-md-6 col-lg-3 form-label">Reg.No.</label>
                                        <div class="col-6 col-md-6 col-lg-9">
                                            <input type="hidden" class="form-control" name="reg_no" id="reg_no">
                                            <label class="form-label text-success" id="reg_no_text"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 mb-2">
                                    <div class="row">
                                        <label for="" class="col-6 col-md-6 col-lg-3 form-label">Reg.Date</label>
                                        <div class="col-6 col-md-6 col-lg-9">
                                            <input type="hidden" class="form-control" name="reg_date" id="reg_date">
                                            <label class="form-label text-success" id="reg_date_text"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 mb-2">
                                    <div class="row">
                                        <label for="" class="col-6 col-md-6 col-lg-3 form-label">Collected
                                            By</label>
                                        <div class="col-6 col-md-6 col-lg-9">
                                            <input type="hidden" class="form-control" name="doc_collected_by"
                                                id="doc_collected_by">
                                            <label class="form-label text-success" id="collected_by"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 mb-2">
                                    <div class="row">
                                        <label for="" class="col-6 col-md-6 col-lg-3 form-label">Collected
                                            Date</label>
                                        <div class="col-6 col-md-6 col-lg-9">
                                            <input type="hidden" class="form-control" name="doc_collected_date"
                                                id="doc_collected_date">
                                            <label class="form-label text-success" id="doc_collected_date_text"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 mb-2">
                                    <div class="row">
                                        <label for="" class="col-6 col-md-6 col-lg-3 form-label">Reg. Expense
                                            By</label>
                                        <div class="col-6 col-md-6 col-lg-9">
                                            <input type="hidden" class="form-control" name="reg_expense_by"
                                                id="reg_expense_by">
                                            <label class="form-label text-info fw-bold" style="font-size: 18px;"
                                                id="reg_exp_by"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h5 class="fw-bold" style="color: #6259ca; text-align:center;">Issued To</h5>
                                </div>
                            </div>
                            <div class="row mt-1 p-2" style="border-radius:5px; border:1px solid #212326ad;">
                                <div class="col-sm-6 col-md-6 mb-2">
                                    <label for="" class="form-label mt-0">Name.</label>
                                    <input type="text" class="form-control" name="issue_to_name" id="issue_to_name"
                                        placeholder="Name" readonly>
                                    <span id="issue_to_name_validation" class="text-danger" style="display:none;"> Name
                                        Field is Required</span>
                                </div>
                                <div class="col-sm-6 col-md-6 mb-2">

                                    <label for="" class="form-label mt-0">Mobile.</label>

                                    <input type="text" class="form-control" name="issue_to_mobile_no"
                                        id="issue_to_mobile_no" placeholder="Mobile" readonly>
                                    <!-- <label class="form-label text-success">897645332</label> -->
                                    <span id="issue_to_mob_validation" class="text-danger" style="display:none;"> Mobile
                                        Field is Required</span>

                                </div>
                            </div>
                            
                            <div class="row mt-2">
                                <div class="col d-flex align-items-center justify-content-end">
                                    <button type="submit" class="btn btn-primary me-2 doc_sub_btn">Submit</button>
                                    <!-- <a class="btn btn-light" href="#">Cancel</a> -->

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
        $(document).ready(function() {
            // $(".doc_sub_btn").attr("disabled", true);
        });
        // get the plot_nos
        function PlotNoView() {
            var project_id = $("#get_project_id").val();
            var url = "{{ url('/') }}/plot-document-get-plot-nos";

            $("#get_plot_no").html("<option value=''>Select Plot No</option>");
            $("#get_plot_sqft").text('0.00');
            $("#table_tbody_row").html('<tr><td colspan="16" style="text-align:center">No Data Found</td></tr>');
            if (project_id != "") {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        project_id: project_id
                    },
                    success: function(res) {
                        if (res.plot_nos.length > 0) {
                            $.each(res.plot_nos, function(key, value) {
                                $("#get_plot_no").append('<option value="' + value
                                    .plot_id +
                                    '">' +
                                    value.plot_no + '</option>')
                            });
                        } else {
                            $("#get_plot_no").html(
                                "<option value=''>Select Plot No</option><option value=''>No Data Found</option>"
                            );
                        }
                    }
                });
            } else {
                field_list_empty();
            }
        }
        // get plot sqft
        function get_plot_sqft() {
            var plot_id = $("#get_plot_no").val();
            var url = "{{ url('/') }}/plot-document-get-plot-sqft";
            if (plot_id != "") {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        plot_id: plot_id
                    },
                    success: function(res) {
                        if (res.status == true) {
                            $("#booking_id").val(res.get_plot.booking_id);
                            $("#plot_sq_val").val(res.get_plot.plot_sq_ft); // plot sqft
                            $("#get_plot_sqft").text(res.get_plot.plot_sq_ft + '.00');
                            $("#customer_name").val(res.customer_name); // customer name
                            $("#cust_name").text(res.customer_name);
                            $("#mob_text").text(res.mobile); //mobile
                            $("#mobile_no").val(res.mobile);
                            $("#reg_no_text").text(res.get_plot.reg_no); //reg no
                            $("#reg_no").val(res.get_plot.reg_no);
                            $("#reg_date_text").text(res.register_date); //register date
                            $("#reg_date").val(res.register_date);
                            $("#collected_by").text(res.doc_collected_by); //doc collected by
                            $("#doc_collected_by").val(res.doc_collected_by);
                            $("#doc_collected_date").val(res.doc_collected_date);
                            $("#doc_collected_date_text").text(res.doc_collected_date); //doc collected date
                            $("#issue_to_name").val(res.customer_name);
                            $("#issue_to_mobile_no").val(res.mobile);
                            console.log(res.get_plot.reg_expense);
                            if (res.get_plot.reg_expense == 1) {
                                $("#reg_exp_by").text('Company'); //reg exp by
                                $("#reg_expense_by").val(res.get_plot.reg_expense);
                            } else if (res.get_plot.reg_expense == 2){
                                $("#reg_exp_by").text('Customer'); //reg exp by
                                $("#reg_expense_by").val(res.get_plot.reg_expense);
                            }


                        } else {
                            field_list_empty();
                        }
                    }
                });
            } else {
                field_list_empty();
            }
        }

        function field_list_empty() {
            $("#plot_sq_val").val(''); // plot sqft
            $("#get_plot_sqft").text('0.00');
            $("#customer_name").val(''); // customer name
            $("#cust_name").text('');
            $("#mob_text").text(''); //mobile
            $("#mobile_no").val('');
            $("#reg_no_text").text(''); //reg no
            $("#reg_no").val('');
            $("#collected_by").text(''); //doc collected by
            $("#doc_collected_by").val('');
            $("#reg_date").val(''); //register date
            $("#reg_date_text").text("");
            $("#doc_collected_date").val(''); //doc collected date
            $("#doc_collected_date_text").text('');
            $("#reg_exp_by").text(''); //reg exp by
            $("#reg_expense_by").val('');
            $("#issue_to_name").val('');
            $("#issue_to_mobile_no").val('');
            $("#legal_document_issue")
                .removeClass("form-control mb-4 is-invalid state-invalid")
                .addClass("form-control");
            $("#plot_doc_issue_validation").css("display", "none");
            $("#exist_doc_issue_validation")
                .removeClass("form-control mb-4 is-invalid state-invalid")
                .addClass("form-control");
            $("#exist_doc_issue_validation").css("display", "none");


        }


        // plot document store
        $("#Add_PlotDocumentIssue_Form").submit(function(e) {
            e.preventDefault();
            if ($("#get_plot_no").val() == "" || $("#get_plot_no").val() == null) {
                $("#get_plot_no")
                    .removeClass("form-control")
                    .addClass("form-control mb-4 is-invalid state-invalid")
                    .focus();
                $("#get_plot_no_validation").css("display", "block");
            } else {
                $("#get_plot_no")
                    .removeClass("form-control mb-4 is-invalid state-invalid")
                    .addClass("form-control");
                $("#get_plot_no_validation").css("display", "none");
            }

            if ($("#get_project_id").val() == "" || $("#get_project_id").val() == null) {
                $("#get_project_id")
                    .removeClass("form-control")
                    .addClass("form-control mb-4 is-invalid state-invalid")
                    .focus();
                $("#project_name_validation").css("display", "block");
            } else {
                $("#get_project_id")
                    .removeClass("form-control mb-4 is-invalid state-invalid")
                    .addClass("form-control");
                $("#project_name_validation").css("display", "none");
            }
            var form = $("#Add_PlotDocumentIssue_Form")[0];
            var url = $("#store_url").val();
            var formData = new FormData(form);
            $.ajax({
                url: url,
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == true) {
                        swal("Created!", data.message, "success");
                         setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                        // $("#get_plot_no").html("<option value=''>Select Plot No</option>");
                        // $("#get_project_id").val("").trigger("change");
                        // $("#issue_to_name").val('');
                        // $("#issue_to_mobile_no").val('');
                        // $("#legal_document_issue").prop("checked", false);
                        // field_list_empty();
                    } else {

                        if (data.message == "Plot Document Issued Already Issued!") {
                            if ($("#legal_document_issue").is(":checked")) {
                                $("#legal_document_issue")
                                    .removeClass("form-control")
                                    .addClass("form-control mb-4 is-invalid state-invalid")
                                    .focus();

                                $("#exist_doc_issue_validation").css("display", "block");
                            } else {
                                $("#exist_doc_issue_validation")
                                    .removeClass("form-control mb-4 is-invalid state-invalid")
                                    .addClass("form-control");
                                $("#exist_doc_issue_validation").css("display", "none");
                            }
                        }
                    }
                },
                error: function(xhr) {
                    $(".err").html("");
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $("." + key).append(
                            '<div class="err text-danger">' + value + "</div>"
                        );
                    });
                },
            });
        });
    </script>
@endsection
