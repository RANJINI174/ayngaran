@extends('layouts.app')
@section('content')
    <div class="row row-sm mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Commission Cash Issue</div>
                </div>
                <div class="card-body">
                    <div class="container">
                        {{-- <form class="p-3" autocomplete="off"> --}}
                        <div class="row mt-3">
                            <div class="col-12">
                                <h5 class="fw-bold" style="color: #6259ca; text-align:center;">Project Details</h5>
                            </div>
                        </div>
                        <div class="row border border-light-subtle mt-1" style="border-radius:5px;">
                            <div class="col-md-6 col-xl-3">
                                <label class="form-label mt-0">Project Name <span class="text-red">*</span></label>
                                <select name="g_project_id" id="g_project_id" class="form-control SlectBox"
                                    onchange="get_commission_plot_nos()">
                                    <option value="">Select Project</option>
                                    @if (isset($projects))
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->short_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                {{-- <input type="hidden" id="mv_plot_rate"> --}}
                                <label class="form-label mt-0">Plot No.<span class="text-red">*</span></label>
                                <select name="plot_no" id="plot_no" class="form-control SlectBox"
                                    onchange="get_plot_square_feet()">
                                    <option value="">Select Plot No</option>
                                    @if (isset($plot_nos))
                                        @foreach ($plot_nos as $val)
                                            <option value="{{ $val->id }}">{{ $val->plot_no }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <label class="form-label mt-0">Plan <span class="text-red">*</span></label>
                                <select name="plan" id="plan" class="form-control SlectBox"
                                    onchange="get_marketer_detail()">
                                    <option value="">Select Plan</option>
                                    <option value="1">Plan A</option>
                                    <option value="2">Plan B</option>
                                    <option value="3">Plan C</option>
                                </select>
                                <span id="plan_validation" class="text-danger" style="display:none;">Plan Field
                                    is Required</span>
                                <span id="exist_plan_validation" class="text-danger" style="display:none;">Plan Already
                                    Exist!.</span>
                            </div>
                            <div class="col-md-6 col-xl-3">
                                <label class="form-label mt-0">Plot Sq.Ft</label>
                                <input type="hidden" name="mv_sq_ft" id="mv_sq_ft" class="form-control" readonly>
                                <input type="text" name="plot_sq_ft" id="plot_sq_ft" class="form-control" value="0.00"
                                    readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <h5 class="fw-bold" style="color: #6259ca; text-align:center;">Commission List</h5>
                            </div>
                        </div>

                        <div class="row border border-light-subtle mt-1" style="border-radius:5px;">
                            <div class="col-md-3">
                                <label class="form-label">Marketer ID <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="marketer_id" id="marketer_id"
                                    placeholder="Marketer ID" readonly="">
                                <span style="display:none" class="text-danger" id="marketer_id_validation">Marketer ID Field
                                    is
                                    Required</span>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label"> Name </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="marketer_name" id="marketer_name"
                                        placeholder="Name" readonly="">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Designation </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="designation" id="designation"
                                        placeholder="Designation" readonly="">
                                </div>

                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Mobile No</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="marketer_mobile" id="marketer_mobile"
                                        placeholder="Mobile No" readonly="">
                                </div>

                            </div>
                            <div class="table-responsive">
                                <br>

                                <table id="commission_cash_issue_table"
                                    class="table border text-nowrap text-center text-md-nowrap table-striped mg-b-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Marketer ID</th>
                                            <th>Designation</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Comm.Amount</th>
                                            <th>Comm.Issued</th>
                                            <th>comm.Balance</th>
                                            <th>History</th>
                                            <th>Sms</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_body">
                                        <tr>
                                            <td colspan="10">Data No Found</td>
                                        </tr>

                                        <tr>
                                            <td colspan="5">
                                                <h6 class="fw-bold text-end text-danger">Total :</h6>
                                            </td>
                                            <td>
                                                <h6 class="fw-bold text-success">0.00</h6>
                                            </td>
                                            <td colspan="3">
                                                <h6 class="fw-bold text-success">0.00</h6>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Commission issue modal -->
        <div class="modal fade" id="Comm_issuedModel" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Designation Details</h5>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="comm_issued_form">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="comm_issued" id="commission_issued">
                            <input type="hidden" name="comm_balance" id="commission__balance">
                            <div class="table-responsive">
                                <table id="comm_List_table" class="table table-bordered text-nowrap text-center mb-0">
                                    <thead class="border">
                                        <tr>
                                            <th class="bg-transparent">S.No</th>
                                            <th class="bg-transparent ">Project Name</th>
                                            <th class="bg-transparent ">Plot No.</th>
                                            <th class="bg-transparent ">Comm ID</th>
                                            <th class="bg-transparent ">Marker ID</th>
                                            <th class="bg-transparent ">Marketer Name</th>
                                            <th class="bg-transparent ">Comm.Balance</th>
                                            <th class="bg-transparent ">Amount</th>
                                            <th class="bg-transparent ">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border" id="com_body">

                                        <tr>
                                            <td colspan="9">Data no Found</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div id="submit_issue_com"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- marketer histroy maintanance --}}
        <div class="modal fade" id="Marketr_histroy_Model" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Marketer Histroy</h5>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="comm_List_table" class="table table-bordered text-nowrap text-center mb-0">
                                <thead class="border">
                                    <tr>
                                        <th class="bg-transparent">S.No</th>
                                        <th class="bg-transparent ">Issued Date</th>
                                        <th class="bg-transparent ">Project Name</th>
                                        <th class="bg-transparent ">Plot No.</th>
                                        <th class="bg-transparent ">Comm ID</th>
                                        <th class="bg-transparent ">Marker ID</th>
                                        <th class="bg-transparent ">Marketer Name</th>
                                        <th class="bg-transparent ">Comm. Amount</th>
                                        <th class="bg-transparent ">Issued Amount</th>
                                        <th class="bg-transparent ">Comm Balance</th>
                                    </tr>
                                </thead>
                                <tbody class="border" id="marketer_history_body">

                                    <tr>
                                        <td colspan="10">Data no Found</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function clear_commission_cash_history() {
            $("#marketer_id").val("");
            $("#marketer_name").val('');
            $("#designation").val('');
            $("#marketer_mobile").val('');
            $("#table_body").html('<tr><td colspan="10">Data No Found</td></tr>');
            $("#plan").val('').trigger('change');
            $("#mv_sq_ft").val('');
             $("#plot_sq_ft").val('0.00');
        }
        // get the plot_nos
        function get_commission_plot_nos() {
            $("#marketer_id").val("");
            $("#marketer_name").val('');
            $("#designation").val('');
            $("#marketer_mobile").val('');
            $("#table_body").html('<tr><td colspan="10">Data No Found</td></tr>');
            $("#plot_no").html("<option value=''>Select Plot No</option>");
            $("#plan").val('').trigger('change');
            $("#mv_sq_ft").val('');
             $("#plot_sq_ft").val('0.00');
            var project_id = $("#g_project_id").val();
            var url = "{{ url('/') }}/commission-cash-get-plots";
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
                                        .plot_id +
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
                $("#marketer_id").val("");
                $("#marketer_name").val('');
                $("#designation").val('');
                $("#marketer_mobile").val('');
                $("#table_body").html('<tr><td colspan="10">Data No Found</td></tr>');
                $("#plot_no").html("<option value=''>Select Plot No</option>");
                $("#plan").val('').trigger('change');
                $("#mv_sq_ft").val('');
            }

        }

     //get_plot_sqft
        function get_plot_square_feet() {
            $("#marketer_id").val("");
            $("#marketer_name").val('');
            $("#designation").val('');
            $("#marketer_mobile").val('');
            $("#table_body").html('<tr><td colspan="10">Data No Found</td></tr>');
            $("#plan").val('').trigger('change');
            $("#mv_sq_ft").val('');
            $("#plot_sq_ft").val('0.00');
            
            var project_id = $("#g_project_id").val();
            var plot_id = $("#plot_no").val();
            $("#plot_sq_ft").val('0.00');
            if (plot_id != "") {
                let url = $('meta[name="base_url"]').attr("content") +
                    "/get-commission-cash-plot-sqft/" + project_id;
                $.ajax({
                    url: url,
                    method: "GET",
                    data: {
                        project_id: project_id,
                        plot_id: plot_id,
                    },
                    success: function(res) {
                        if (res.status == true) {
                            if (res.plot_sqft != null && res.plot_sqft != "") {
                                $("#plot_sq_ft").val(res.plot_sqft);
                            } else {
                                $("#plot_sq_ft").val('0.00');
                            }
                        } else {
                            $("#plot_sq_ft").val('0.00');
                        }

                    },
                });
            } else {
                $("#plot_no").val('');
            }
        }
        function get_marketer_detail() {
            var plot_id = $("#plot_no").val();
            var project_id = $("#g_project_id").val();
            var plan = $("#plan").val();

            if (project_id != "" && plot_id != "" && plan != "") {
                var url = "{{ url('/') }}/commission-cash-get-marketer";
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        plot_id: plot_id,
                        project_id: project_id,
                        plan: plan,
                    },
                    success: function(res) {
                        if (res.status == true) {
                            console.log(res.mv_per_sqft);
                            $("#mv_sq_ft").val(res.mv_per_sqft);
                            // $("#mv_plot_rate").val(res.plot_detail.market_value_plot_rate);
                            $("#marketer_id").val(res.marketer.reference_code);
                            $("#marketer_name").val(res.marketer.name);
                            $("#designation").val(res.marketer.designation);
                            $("#marketer_mobile").val(res.marketer.mobile_no);
                            if (res.html != '') {
                                $("#table_body").html(res.html);
                                total_sum_calculation();
                            } else {

                                $("#table_body").html('<tr><td colspan="10">Data No Found</td></tr>');
                            }
                        } else {

                            $("#mv_sq_ft").val('');
                            $("#table_body").html('<tr><td colspan="10">Data No Found</td></tr>');
                        }
                    }
                });
            } else {
                $("#marketer_id").val("");
                $("#marketer_name").val('');
                $("#designation").val('');
                $("#marketer_mobile").val('');
                $("#table_body").html('<tr><td colspan="10">Data No Found</td></tr>');
                $("#mv_sq_ft").val('');
            }
        }

        function total_sum_calculation() {
            var com_amt = 0;

            $(".commission_amt").each(function() { // commission amount
                var com_amt_rows = $(this).val();
                var com_amt_values = parseFloat(com_amt_rows);
                com_amt += com_amt_values;
            });
            var tot_com_amt = com_amt.toFixed(2);
            $("#total_com_amt").text(tot_com_amt);
            $("#total_marketer_com_amt").text(tot_com_amt);

            var com_bal = 0;
            $(".commission_balance").each(function() { // commission balance
                var com_bal_rows = $(this).val();
                var com_bal_values = parseFloat(com_bal_rows);
                com_bal += com_bal_values;
            });
            var tot_com_bal = com_bal.toFixed(2);
            $("#total_com_bal").text(tot_com_bal);
        }


        function marketer_total_amt() {
            var com_amt = 0;
            $(".m_commission_amt").each(function() { // markter commission amount
                var com_amt_rows = $(this).val();
                var com_amt_values = parseFloat(com_amt_rows);
                com_amt += com_amt_values;
            });
            var tot_com_amt = com_amt.toFixed(2);
            $("#total_marketer_com_amt").text(tot_com_amt);
        }


        $(document).on('keyup', '#com_issued', function() {
            var id = $(this).data("user_id");
            var com_amt = $("#m_comm_amt_1").val();
            var com_issued = $("#com_issued").val();
            var total = com_amt - com_issued;
            var bal = total.toFixed();
            var remain_bal = parseFloat(bal);
            if (com_issued.length > 0 && com_issued != 0) {
                $("#total_marketer_com_issue_amt").text(remain_bal + '.00');
                $("#tot_remain_bal").val(remain_bal);
                $("#commission_issued").val(com_issued);
                $("#commission__balance").val(remain_bal);
            } else {
                $("#total_marketer_com_issue_amt").text('0.00');
                $("#tot_remain_bal").val('');
                $("#commission_issued").val('');
                $("#commission__balance").val('');
            }
        });

        function isCheckedById(id, project_id, plot_id, commission_val) {

            // if ($("#comm_issued_1_" + id).is(":checked")) {
            $("#Comm_issuedModel").modal("show");
            var plan = $("#plan").val();
            var type = 'marketer-commission-type';
            var url = "{{ url('/') }}/get-marketer-comm";
            if (id != "") {
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        user_id: id,
                        project_id: project_id,
                        plot_id: plot_id,
                        plan: plan
                    },
                    success: function(res) {
                        if (res.status == true) {
                            if (res.html != '') {
                                $("#com_body").html(res.html);
                                var input_length = $("#m_comm_amt_1").val();
                                if (input_length == '') {
                                    $("#m_comm_amt_1").val(commission_val);
                                    $("#marketer_commission_amt_text").text(commission_val);
                                }
                                $("#submit_issue_com").html(res.btn);
                                marketer_total_amt();
                            } else {
                                $("#com_body").html('<tr><td colspan="10">Data No Found</td></tr>');
                            }
                        }
                    }
                });
            }

            // }
        }

        function issuedCheckedCom() {
            if ($("#issue_com_1").is(":checked")) {
                $(".comm_issue_btn").attr("disabled", false);
            } else {
                $(".comm_issue_btn").attr("disabled", true);
            }
        }



        function comm_issued_submit(id) {
            $("#Comm_issuedModel").modal("hide");
            var issue_amt = $("#tot_remain_bal").val();
            // var remin_bal = issue_amt.toFixed(2);
            $("#comm_bal_1_" + id).val(issue_amt);
            $("#comm_text_1_" + id).text(issue_amt + '.00');
            total_sum_calculation();
        }


        //commission issue store
        $("#comm_issued_form").submit(function(e) {
            e.preventDefault();

            if ($("#com_issued").val() == "" || $("#com_issued").val() == null) {
                $("#com_issued")
                    .removeClass("form-control")
                    .addClass("form-control mb-4 is-invalid state-invalid")
                    .focus();
                return;
            } else {
                $("#com_issued")
                    .removeClass("form-control mb-4 is-invalid state-invalid")
                    .addClass("form-control");
            }
            var plan = $("#plan").val();
            var form = $("#comm_issued_form")[0];
            var formData = new FormData(form);
            formData.append('plan', plan);
            var url = $('meta[name="base_url"]').attr("content") + "/commission-cash-issue-store";
            $.ajax({
                url: url,
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == true) {
                        swal("Created!", data.message, "success");
                        $("#comm_issued_form")[0].reset();
                        comm_issued_submit(data.id);
                        // setTimeout(function() {
                        //     window.location.reload();
                        // }, 2000);
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


        function Marketer_history_show(project_id, plot_id, user_id) {
            $("#Marketr_histroy_Model").modal("show");
            var plan = $("#plan").val();
            var url = "{{ url('/') }}/get-marketer-history";
            if (project_id != "") {
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        project_id: project_id,
                        plot_id: plot_id,
                        plan: plan,
                        user_id: user_id,
                    },
                    success: function(res) {
                        if (res.status == true) {
                            if (res.html != '') {
                                $("#marketer_history_body").html(res.html);
                            } else {
                                $("#marketer_history_body").html(
                                    '<tr><td colspan="10">Data No Found</td></tr>');
                            }
                        }
                    }
                });
            }
        }
    </script>
@endsection
