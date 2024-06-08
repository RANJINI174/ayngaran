@extends('layouts.app')
@section('content')
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Add Commission Updation</h3>
                </div>
                <div class="card-body">
                    <form id="Add_CommissionForm" autocomplete="off">
                        @csrf
                        @method('POST')
                        <div class="row mt-3">
                            <div class="col-sm-6 col-md-3 mb-2">
                                <input type="hidden" id="url" value="{{ route('commission_detail_store') }}">
                                <label class="form-label">Project Name <span class="text-red">*</span></label>
                                <select name="project_id" id="project_id" class="form-control SlectBox"
                                    onchange="get_commission_type()">
                                    <option value="">Select Project</option>
                                    @if (isset($projects))
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->short_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span id="project_name_validation" class="text-danger" style="display:none;">Project Field
                                    is Required</span>
                            </div>
                            <div class="col-sm-6 col-md-3 mb-2">
                                <input type="hidden" name="commission_type_val" id="commission_type_val">
                                <label class="form-label">Commission Type <span class="text-red">*</span></label>
                                <select name="commission_type" id="commission_type" class="form-control" disabled>
                                    <option value="">Select Commission Type</option>
                                    <option value="1">By Percentage</option>
                                    <option value="2">By value</option>
                                </select>
                                <span id="commission_type_validation" class="text-danger" style="display:none;">Commission
                                    Type Field is Required</span>
                            </div>
                            <div class="col-sm-6 col-md-3 mb-2">
                                <label class="form-label">Plan <span class="text-red">*</span></label>
                                <select name="plan_id" id="plan_id" class="form-control SlectBox"
                                    onchange="get_mv_value()">
                                    <option value="">Select Plan</option>
                                    <option value="1">Plan A</option>
                                    <option value="2">Plan B</option>
                                    <option value="3">Plan C</option>
                                    <option value="4">Plan D</option>
                                    <option value="5">Plan E</option>
                                </select>
                                <span id="plan_validation" class="text-danger" style="display:none;">Plan Field
                                    is Required</span>
                                <span id="exist_plan_validation" class="text-danger" style="display:none;">Plan Already
                                    Exist!.</span>
                            </div>
                            <div class="col-sm-6 col-md-3 mb-2">
                                <label class="form-label">Market Value/Sq.Ft<span class="text-red">*</span></label>
                                <input type="text" name="mv_sq_ft" id="mv_sq_ft" class="form-control" readonly>
                                <span id="mv_sq_ft_validation" class="text-danger" style="display:none;">Market value Square
                                    Feet is
                                    Required</span>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="table-responsive">
                                <table id="commission_detail_lists" class="table table-bordered text-nowrap mb-0 p-0">
                                    <thead class="border text-center">
                                        <tr>
                                            <th class="bg-transparent border-bottom-0 ">S.no</th>
                                            <th class="bg-transparent border-bottom-0">Designation</th>
                                            <th class="bg-transparent border-bottom-0" id="hidd_percentage">Percentage</th>
                                            <th class="bg-transparent border-bottom-0" id="hidd_cash">Cash</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_tbody_row" class="border" style="padding: 0px !important;">
                                        <tr id="table_row_1">
                                            <td colspan="5" style="text-align:center">No Data Found</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-1">

                                <button type="submit" class="btn btn-primary me-2">Add</button>
                                <a class="btn btn-light" href="{{ url('commission-details') }}">Cancel</a>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function cash_sum_value() {
            var sum = 0;
            $(".cash_sum").each(function() {
                var cash_sum = $(this).val();
                var total_cash = parseFloat(cash_sum);
                if (!isNaN(total_cash)) {
                    sum += total_cash;
                }
            });
            var sum_amount = sum.toFixed(2);
            $("#total_cash_amt").val(sum_amount);
        }

        $(document).ready(function() {
            $('#commission_detail_lists').on('keyup', '.percentage_sum, .percentage_val', function() {
                var row = $(this).closest("tr");
                var market_val = $("#mv_sq_ft").val();
                var percentageSum = row.find('.percentage_sum').val();
                var per_val = (percentageSum * market_val) / 100;
                var percentageVal = row.find('.percentage_val').val(per_val);
                updateTotals();
            });
        });

        function updateTotals() {
            var totalPercentage = 0;
            var totalValue = 0;

            $('.percentage_val').each(function() {
                var percentage = parseFloat($(this).val()) || 0;
                totalPercentage += percentage;
            });
            var total_per_val = totalPercentage.toFixed(2);
            if (!isNaN(total_per_val)) {
                $("#total_percentage_amt").val(total_per_val);
            } else {
                $("#total_percentage_amt").val(0);
            }
        }
        //commission value
        function get_commission_type() {
            var id = $("#project_id").val();

           $("#plan_id").html('<option value="">Select Plan</option>' +
                   '<option value="1">Plan A</option>' +
                   '<option value="2">Plan B</option>' +
                   '<option value="3">Plan C</option>' +
                   '<option value="4">Plan D</option>' +
                   '<option value="5">Plan E</option>').trigger('change');

            $("#mv_sq_ft").val('');
            $("#mv_sq_ft")
                .removeClass("form-control is-invalid state-invalid")
                .addClass("form-control");
            $("#mv_sq_ft_validation").css("display", "none");
            $("#plan_id")
                .removeClass("form-control is-invalid state-invalid")
                .addClass("form-control");
            $("#plan_validation").css("display", "none");
            
            if (id != "") {
                let url = $('meta[name="base_url"]').attr("content") +
                    "/get-commission-details/" + id;
                $.ajax({
                    url: url,
                    method: "GET",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        if (res.status == true) {
                            $("#commission_type_val").val(res.plot_detail.commission_type);
                            $("#commission_type").val(res.plot_detail.commission_type);
                            var com_type = $("#commission_type").val();
                            if (com_type == 1) {
                                $("#hidd_percentage").css("display", "block");
                                $("#hidd_cash").text("Value");
                            } else {
                                $("#hidd_cash").text("Cash");
                                $("#hidd_percentage").css("display", "none");
                            }

                            if (res.plan_data != "" && res.plan_data != null) {
                                $("#plan_id").html('option value="">Select Plan</option>' + res.plan_data);
                            } else {
                                $("#plan_id").html('<option value="">No Data Found</option>');
                            }

                            $("#table_tbody_row").html(res.html);
                        }

                    },
                });
            } else {
                $("#commission_type").val('');
                $("#plan_id").val('').trigger('change');
                $("#mv_sq_ft").val('');
                $("#hidd_percentage").css("display", "block");
                $("#table_tbody_row").html(
                    "<tr><td colspan='4' class='text-center'>No Data Found</td></tr>"
                );
            }

        }
        //mv value
        function get_mv_value() {
            var id = $("#project_id").val();
            var plan = $("#plan_id").val();
            if (id != "") {
                if (plan != "") {
                    let url = $('meta[name="base_url"]').attr("content") +
                        "/get-commission-details/" + id;
                    $.ajax({
                        url: url,
                        method: "GET",
                        data: {
                            id: id
                        },
                        success: function(res) {
                            if (res.status == true) {
                                var plan = $("#plan_id").val();
                                if (plan == 1) {
                                    $("#mv_sq_ft").val(res.plot_detail.market_value);
                                } else if (plan == 2) {
                                    $("#mv_sq_ft").val(res.plot_detail.market_value_b);
                                } else if (plan == 3) {
                                    $("#mv_sq_ft").val(res.plot_detail.market_value_c);
                                } else if (plan == 4) {
                                    $("#mv_sq_ft").val('');
                                } else {
                                    $("#mv_sq_ft").val('');
                                }

                            }

                        },
                    });
                } else {
                    $("#mv_sq_ft").val('');
                }
            } else {
                console.log("project name is not selected");
            }
        }
    </script>
@endsection
