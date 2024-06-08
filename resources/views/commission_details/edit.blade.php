@extends('layouts.app')
@section('content')
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Edit Commission Updation</h3>
                </div>
                <div class="card-body">
                    <form id="Edit_CommissionForm" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="row mt-3">
                            <div class="col-sm-6 col-md-3 mb-2">
                                <input type="hidden" id="com_update_id" value="{{ $project_detail->id }}">
                                <label class="form-label">Project Name <span class="text-red">*</span></label>
                                <input type="hidden" name="project_id_val" id="project_id_val"
                                    value="{{ !empty($project_detail->id) ? $project_detail->id : '' }}">
                                <select name="project_id" id="project_id" class="form-control SlectBox"
                                    onchange="get_commission_type()" disabled>
                                    <option value="">Select Project</option>
                                    @if (isset($projects))
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}"
                                                @if ($project->id == $project_detail->id) {{ 'selected' }} @endif>
                                                {{ $project->short_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span id="project_name_validation" class="text-danger" style="display:none;">Project Field
                                    is Required</span>
                            </div>
                            <div class="col-sm-6 col-md-3 mb-2">
                                <label class="form-label">Commission Type <span class="text-red">*</span></label>
                                <input type="hidden" name="commission_type_val" id="commission_type_val"
                                    value="{{ !empty($commission_detail->commission_type) ? $commission_detail->commission_type : '' }}">
                                <select name="commission_type" id="commission_type" class="form-control SlectBox" disabled>
                                    <option value="">Select Commission Type</option>
                                    <option value="1" @if ($commission_detail->commission_type == 1) {{ 'selected' }} @endif>By
                                        Percentage</option>
                                    <option value="2" @if ($commission_detail->commission_type == 2) {{ 'selected' }} @endif>By
                                        value</option>
                                </select>
                                <span id="commission_type_validation" class="text-danger" style="display:none;">Commission
                                    Type Field is Required</span>
                            </div>
                            <div class="col-sm-6 col-md-3 mb-2">
                                <label class="form-label">Plan <span class="text-red">*</span></label>
                                <input type="hidden" name="plan_val" id="plan_val"
                                    value="{{ !empty($commission_detail->plan) ? $commission_detail->plan : '' }}">
                                <select name="plan" id="plan" class="form-control SlectBox"
                                    onchange="get_mv_value()" disabled>
                                    <option value="">Select Plan</option>
                                    <option value="1" @if ($commission_detail->plan == 1) {{ 'selected' }} @endif>Plan
                                        A</option>
                                    <option value="2" @if ($commission_detail->plan == 2) {{ 'selected' }} @endif>
                                        Plan
                                        B</option>
                                    <option value="3" @if ($commission_detail->plan == 3) {{ 'selected' }} @endif>
                                        Plan
                                        C</option>
                                </select>
                                <span id="plan_validation" class="text-danger" style="display:none;">Plan Field
                                    is Required</span>
                                <span id="exist_plan_validation" class="text-danger" style="display:none;">Plan Already
                                    Exist!.</span>
                            </div>
                            <div class="col-sm-6 col-md-3 mb-2">
                                <label class="form-label">Market Value/Sq.Ft<span class="text-red">*</span></label>
                                <input type="text" name="mv_sq_ft" id="mv_sq_ft" class="form-control"
                                    value=" @if (isset($plan_detail)) {{ $plan_detail[0]['marketvalue_sqft'] }} @endif"
                                    readonly>
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
                                        @if (isset($get_commission_detail))
                                            @if ($commission_detail->commission_type == 1)
                                                @php $i=1; @endphp
                                                @foreach ($get_commission_detail as $val)
                                                    <tr>
                                                        <td>{{ $i++ }} <input type="hidden" id="per_update_id"
                                                                name="per_update_id[]" value="{{ $val->id }}"></td>
                                                        <td><input type="hidden" name="designation_id[]"
                                                                id="designation_id"
                                                                value="{{ $val->designation_id }}">{{ $val->designation->designation }}
                                                        </td>
                                                        <td><input class='form-control percentage_sum percentage_validation'
                                                                name='percentage[]' Placeholder='%'
                                                                value="{{ !empty($val->percentage) ? $val->percentage : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" name='percentage_val[]'
                                                                class='form-control percentage_val'
                                                                value="{{ !empty($val->percentage_val) ? $val->percentage_val : '' }}">
                                                        </td>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="4" style="padding:4px;">
                                                        <div class="d-flex align-items-center justify-content-end">Total :
                                                            <input type='hidden' name='type' value='percentage_type'>
                                                            <input class="form-control" id="total_percentage_amt"
                                                                name="total_percentage_amt"
                                                                value="{{ !empty($commission_detail->total_percentage_amt) ? $commission_detail->total_percentage_amt : '' }}"
                                                                readonly style="width:100px;">
                                                        </div>
                                                    </td>
                                                </tr>
                                            @else
                                                <?php $i = 1; ?>
                                                @foreach ($get_commission_detail as $val)
                                                    <tr>
                                                        <td>{{ $i++ }}<input type="hidden" id="cash_update_id"
                                                                name="cash_update_id[]" value="{{ $val->id }}"></td>
                                                        <td><input type="hidden" name="designation_id[]"
                                                                id="designation_id"
                                                                value="{{ $val->designation_id }}">{{ $val->designation->designation }}
                                                        </td>
                                                        <td><input type='text'
                                                                class='form-control cash_sum cash_validation'
                                                                name='cash[]' Placeholder='0.00'
                                                                value="{{ !empty($val->cash) ? $val->cash : '' }}"
                                                                onkeyup='cash_sum_value()'>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                '<tr>
                                                    <td colspan="4" style="padding:4px;">
                                                        <input type='hidden' name='type' value='cash_type'>
                                                        <div class="d-flex align-items-center justify-content-end">Total :
                                                            <input type="text" class="form-control"
                                                                id="total_cash_amt" name="total_cash_amt"
                                                                value="{{ !empty($commission_detail->total_cash_amt) ? $commission_detail->total_cash_amt : '' }}"
                                                                readonly style="width:100px;">
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-1">

                                <button type="submit" class="btn btn-primary me-2">Update</button>
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
            var commission_type = $("#commission_type").val();
            if (commission_type == 1) {
                $("#hidd_cash").text("Value");
            } else {
                $("#hidd_percentage").css("display", "none");
            }

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
                            $("#commission_type").val(res.plot_detail.commission_type);
                            var com_type = $("#commission_type").val();
                            if (com_type == 1) {
                                $("#hidd_percentage").css("display", "block");
                                $("#hidd_cash").text("Value");
                            } else {
                                $("#hidd_cash").text("Cash");
                                $("#hidd_percentage").css("display", "none");
                            }
                            $("#table_tbody_row").html(res.html);
                        }

                    },
                });
            } else {
                $("#commission_type").val('');
                $("#plan").val('');
                $("#mv_sq_ft").val('');
                $("#hidd_percentage").css("display", "block");
                $("#table_tbody_row").html(
                    "<tr><td colspan='4' class='text-center'>No Data Found</td></tr>"
                );
            }

        }
        //mv value
        function get_mv_value() {
            var id = $("#project_id_val").val();
            var plan = $("#plan").val();
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
                                var plan = $("#plan").val();
                                if (plan == 1) {
                                    $("#mv_sq_ft").val(res.plot_detail.market_value);
                                } else if (plan == 2) {
                                    $("#mv_sq_ft").val(res.plot_detail.market_value_b);
                                } else {
                                    $("#mv_sq_ft").val(res.plot_detail.market_value_c);
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
