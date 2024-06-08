@extends('layouts.app')
@section('content')
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Registration Expense Confirm</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form id="Add_RegistrationExpenseConfirm_Form" autocomplete="off">
                            @csrf
                            @method('POST')
                            <div class="row mt-2">
                                <div class="col-12">
                                    <h5 class="fw-bold mt-1" style="color: #6259ca; text-align:center;">Project Details</h5>
                                </div>
                            </div>
                            <div class="row border border-light-subtle" style="border-radius:5px;">
                                <div class="col-sm-6 col-md-2 mb-2">
                                    <input type="hidden" id="store_url"
                                        value="{{ route('plot_registration_expense_store') }}">
                                    <label class="form-label">Project Name <span class="text-red">*</span></label>
                                    <select name="get_project_id" id="get_project_id" class="form-control SlectBox"
                                        onchange="PlotNoView()">
                                        <option value="">Select Project</option>
                                        @if (isset($projects))
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->project_id }}">{{ $project->short_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span id="project_name_validation" class="text-danger" style="display:none;">Project
                                        Field is Required</span>
                                </div>
                                <div class="col-sm-6 col-md-2 mb-2">
                                    <label class="form-label">Reg. Expense By. <span class="text-red">*</span></label>
                                    <input type="hidden" name="reg_expense_by" id="reg_expense_by" value="">
                                    <select name="registration_expense_by" id="registration_expense_by"
                                        class="form-control SlectBox" disabled>
                                        <option value="">Select Expense</option>
                                        <option value="1">Company</option>
                                        <option value="2">Customer</option>
                                    </select>
                                    <span id="registration_expense_by_validation" class="text-danger"
                                        style="display:none;">Registration Expense By
                                        Field is Required</span>
                                </div>
                                <div class="col-sm-6 col-md-2 mb-2">
                                    <label class="form-label">Plot No. <span class="text-red">*</span></label>
                                    <select name="plot_no" id="plot_no" class="form-control SlectBox"
                                        onchange="get_gl_value()">
                                        <option value="">Select Plot No</option>
                                    </select>
                                    <span id="plot_no_validation" class="text-danger" style="display:none;">Plot
                                        No Field is Required</span>
                                </div>
                                <div class="col-sm-6 col-md-2 mb-2">
                                    <label class="form-label">Status </label>
                                    <div class="input-group">
                                        <select name="status" id="status" class="form-control SlectBox">
                                            <option value="">All</option>
                                            <option value="1">Completed </option>
                                            <option value="0">Pending </option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-sm-6 col-md-2 mb-2">
                                    <label class="form-label" style="color:white;">.</label>
                                    <button type="button" class="btn btn-primary" onclick="expense_lists()">Search</button>
                                </div>
                                <div class="col-sm-6 col-md-2 mb-2">
                                    <label class="form-label">Guide Line Value <span class="text-red">*</span></label>
                                    <input type="text" class="form-control" id="gl_value" name="gl_value"
                                        placeholder="0.00" readonly>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h5 class="fw-bold mt-1" style="color: #6259ca; text-align:center;">
                                        Expenses Confirm Details</h5>
                                </div>
                            </div>
                            <div class="row border border-light-subtle mt-1" style="border-radius:5px;">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table id="plot_expense_lists"
                                            class="table table-bordered text-center text-nowrap mb-0">
                                            <thead class="border text-center">
                                                <tr>
                                                    <th class="bg-transparent border-bottom-0">S.no</th>
                                                    <th class="bg-transparent border-bottom-0">Project Name</th>
                                                    <th class="bg-transparent border-bottom-0">Customer Name</th>
                                                    <th class="bg-transparent border-bottom-0">Plot No.</th>
                                                    <th class="bg-transparent border-bottom-0">Plot Sq.ft</th>
                                                    <th class="bg-transparent border-bottom-0">Stamp Duty</th>
                                                    <th class="bg-transparent border-bottom-0">DD. Charge </th>
                                                    <th class="bg-transparent border-bottom-0">Extra Page Charge</th>
                                                    <th class="bg-transparent border-bottom-0">Computer Fees</th>
                                                    <th class="bg-transparent border-bottom-0">CD Fees</th>
                                                    <th class="bg-transparent border-bottom-0">Sub Dev Fees</th>
                                                    <th class="bg-transparent border-bottom-0">Reg. Office</th>
                                                    <th class="bg-transparent border-bottom-0">Doc. Writer</th>
                                                    <th class="bg-transparent border-bottom-0">EC
                                                        Charge</th>
                                                    <th class="bg-transparent border-bottom-0">Others
                                                    </th>
                                                    <th class="bg-transparent border-bottom-0">Total Expenses
                                                    </th>
                                                    <th class="bg-transparent border-bottom-0">Reg Expense By
                                                    </th>
                                                    <th class="bg-transparent border-bottom-0">Status
                                                    </th>
                                                    <th class="bg-transparent border-bottom-0">Option
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="table_tbody_row" class="border">
                                                <tr>
                                                    <td colspan="18" style="text-align:center">No Data Found</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col d-flex align-items-center justify-content-end">
                                    <button type="submit" class="btn btn-primary con_sub_btn me-2"
                                        disabled>Submit</button>
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
            expense_lists();
        });
        function select2_list() {
            $(document).ready(function() {
                $(".reg_expense_select").select2();
            });
        }
        // plot registration expense confirm lists
        function expense_lists() {

            var project_id = $("#get_project_id").val();
            var plot_no_id = $("#plot_no").val();
            var status = $("#status").val();
            var url =
                $("meta[name='base_url']").attr("content") +
                "/plot-no-expense-table-lists";
            var data = "lists";
            $.ajax({
                url: url,
                method: "GET",
                data: {
                    data: data,
                    project_id: project_id,
                    plot_no_id: plot_no_id,
                    status: status,
                },
                success: function(res) {
                    if (res.status == true) {
                        if (res.count > 0) {
                            select2_list(); // select2
                            $("#table_tbody_row").html(res.html);
                            if ($("#sel_count_r").val() == 0) {
                                $(".con_sub_btn").attr("disabled", true);
                            }
                            total_sum_calculation();
                        } else {
                            $("#table_tbody_row").html(
                                '<tr><td colspan="18" style="text-align:center">No Data Found</td></tr>'
                            );
                            $(".con_sub_btn").attr("disabled", true);
                        }
                    } else {
                        $("#table_tbody_row").html(
                            '<tr><td colspan="18" style="text-align:center">No Data Found</td></tr>'
                        );

                    }
                },
            });

        }
        // get the plot_nos
        function PlotNoView() {
            var project_id = $("#get_project_id").val();
            $("#status").val('').trigger("change");
            var url = "{{ url('/') }}/get-registration-expense-detail";
            $("#plot_no").html("<option value=''>Select Plot No</option>");
            if (project_id != "") {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        project_id: project_id
                    },
                    success: function(res) {
                        if (res.status == true) {
                            $("#reg_expense_by").val(res.res_expense_by.reg_expense);
                            $("#registration_expense_by").val(res.res_expense_by.reg_expense).trigger("change");
                            $("#gl_value").val(res.res_expense_by.guide_line);
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
                expense_lists();
                $("#registration_expense_by").val('').trigger("change");
                $("#gl_value").val('');
                $("#status").val("").trigger("change");
            }
        }
        // Total sum calculation

        function total_sum_calculation() {
            var plot_sqft = 0; // plot sqft
            $(".plot_sq_ft").each(function() {
                var plot_sqft_rows = $(this).val();
                var total_plot_rows = parseFloat(plot_sqft_rows);
                if (!isNaN(total_plot_rows)) {
                    plot_sqft += total_plot_rows;
                }
            });
            var plot_sqft_total_amt = plot_sqft.toFixed(2);
            $("#total_plot_sqft").val(plot_sqft_total_amt);

            var stamp_duty = 0; // stamp_duty
            $(".stamp_duty").each(function() {
                var stamp_duty_rows = $(this).val();
                var total_stamp_duty_rows = parseFloat(stamp_duty_rows);
                if (!isNaN(total_stamp_duty_rows)) {
                    stamp_duty += total_stamp_duty_rows;
                }
            });
            var stamp_duty_total_amt = stamp_duty.toFixed(2);
            $("#total_stamp_duty").val(stamp_duty_total_amt);

            var dd_charge = 0; // dd_charge
            $(".dd_charge").each(function() {
                var dd_charge_rows = $(this).val();
                var total_dd_charge_values = parseFloat(dd_charge_rows);
                if (!isNaN(total_dd_charge_values)) {
                    dd_charge += total_dd_charge_values;
                }
            });
            var dd_charge_total_amt = dd_charge.toFixed(2);
            $("#total_dd_charge").val(dd_charge_total_amt);

            var extra_page_fees = 0; // extra_page_fees
            $(".extra_page_fees").each(function() {
                var extra_page_fees_rows = $(this).val();
                var extra_page_fees_rows_values = parseFloat(extra_page_fees_rows);
                if (!isNaN(extra_page_fees_rows_values)) {
                    extra_page_fees += extra_page_fees_rows_values;
                }
            });
            var extra_page_fees_total_amt = extra_page_fees.toFixed(2);
            $("#total_extra_page_fees").val(extra_page_fees_total_amt);

            var computer_fees = 0; // computer fees
            $(".computer_fees").each(function() {
                var computer_fees_values = $(this).val();
                var computer_tot_values = parseFloat(computer_fees_values);
                computer_fees += computer_tot_values;
            });
            var com_fees_tot_amt = computer_fees.toFixed(2);
            $("#total_computer_fees").val(com_fees_tot_amt);

            var cd = 0; // cd
            $(".cd").each(function() {
                var cd_rows = $(this).val();
                var cd_values = parseFloat(cd_rows);
                cd += cd_values;
            });
            var cd_total_amt = cd.toFixed(2);
            $("#total_cd").val(cd_total_amt);

            var sub_div = 0; // sub div fees
            $(".sub_division_fees").each(function() {
                var sub_div_fees = $(this).val();
                var sub_div_fees_values = parseFloat(sub_div_fees);
                sub_div += sub_div_fees_values;
            });
            var sub_div_fees_tot_amt = sub_div.toFixed(2);
            $("#total_sub_division_fees").val(sub_div_fees_tot_amt);

            var register_office = 0; //register_office
            $(".register_office").each(function() {
                var register_office_rows = $(this).val();
                var register_office_rows_values = parseFloat(register_office_rows);
                register_office += register_office_rows_values;
            });
            var register_office_tot_amt = register_office.toFixed(2);
            $("#total_register_office").val(register_office_tot_amt);

            var doc_writter = 0; // doc writter_fees
            $(".writter_fees").each(function() {
                var doc_writter_fees = $(this).val();
                var doc_writter_values = parseFloat(doc_writter_fees);
                doc_writter += doc_writter_values;
            });
            var doc_writter_tot_amt = doc_writter.toFixed(2);
            $("#total_writter_fees").val(doc_writter_tot_amt);

            var ec = 0; // ec
            $(".ec").each(function() {
                var ec_rows = $(this).val();
                var ec_values = parseFloat(ec_rows);
                ec += ec_values;
            });
            var ec_total_amt = ec.toFixed(2);
            $("#total_ec").val(ec_total_amt);

           var other_expense = 0; // Initialize other_expense variable
            $(".other_expense").each(function() {
                var other_expense_rows = $(this).val();
              
                if (!isNaN(other_expense_rows)) {
                    var other_expense_rows_values = parseFloat(other_expense_rows);
                    other_expense += other_expense_rows_values;
                }
            });
            var other_expense_tot_amt = other_expense.toFixed(2);
            $("#total_other_expense").val(other_expense_tot_amt); 



            var v_tot_exp = 0; // total expenses
            $(".total_expense").each(function() {
                var total_expense_rows = $(this).val();
                var total_expense_row_values = parseFloat(total_expense_rows);
                v_tot_exp += total_expense_row_values;

            });
            var total_expenses = v_tot_exp.toFixed(2);
            $("#total_expenses").val(total_expenses);


        }
        // particular plot no expense details

        // function PlotNo_ExpenseDetails() {
        //     var project_id = $("#get_project_id").val();
        //     var plot_no_id = $("#plot_no").val();
        //     var status = $("#status").val();
        //     var reg_exp_by = $("#registration_expense_by").val();
        //     var url = $("meta[name='base_url']").attr("content") + "/plot-no-expense-details";
        //     if (project_id != "") {
        //         $.ajax({
        //             url: url,
        //             method: 'POST',
        //             data: {
        //                 project_id: project_id,
        //                 plot_no_id: plot_no_id,
        //                 status: status,
        //                 reg_expense_by: reg_exp_by
        //             },
        //             success: function(res) {
        //                 if (res.status == true) {
        //                     if (res.html != "") {
        //                         $("#table_tbody_row").html(res.html);
        //                         total_sum_calculation();

        //                     } else {
        //                         $("#table_tbody_row").html(
        //                             '<tr><td colspan="16" style="text-align:center">No Data Found</td></tr>'
        //                         );
        //                     }
        //                 }
        //             }
        //         });
        //     }
        // }
         function regExpenseChange(id) {
             
             
            var _value = $("#reg_expense_" + id + '_' + 1).val();
            
            if(_value == 1)
            {
            swal({
                    title: "Warning",
                    text: " Are you sure you want change Customer Reg expense to Company ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $("#selected_val" + id + '_' + 1).prop('checked',true);
                        $("#reg_expense_" + id + '_' + 1).val(1).trigger('change');
                        
                    } else {
                        $("#selected_val" + id + '_' + 1).prop('checked',true);
                        $("#reg_expense_" + id + '_' + 1).val(2).trigger('change');
                    }
                });
            } 
         }
        
       

        function isCheckedById(id) {
            
              var booking_date = $("#booking_date_" + id + "_1").val();
            
              userDate = new Date();
              var omar= new Date(userDate);
 
              targetDate = omar.toISOString().split('T')[0];
              var one_day=1000*60*60*24; 
              var x=booking_date.split("-");     
              var y=targetDate.split("-");

              var date1=new Date(x[0],(x[1]-1),x[2]);
              var date2=new Date(y[0],(y[1]-1),y[2]);

             var month1=x[1]-1;
             var month2=y[1]-1;

            _Diff=Math.ceil((date2.getTime()-date1.getTime())/(one_day));
            if ($("#selected_val" + id + '_' + 1).is(":checked")) {
            if(_Diff > 30) 
            {
                  swal("Warning!",'Reg Expense Shifted to Customer Expense since Booking was Over dated', "warning");
                //   $("#selected_val" + id + '_' + 1).prop('checked',false);
                //   $("#reg_expense_" + id + '_' + 1).val(2).trigger('change');
             }
            }
            //  else{
                 
            if ($("#selected_val" + id + '_' + 1).is(":checked")) {
                var sno = 1;
                var c = parseFloat($("#sel_count_r").val()) || 0;
                var tot_sel = sno + c;
                $("#sel_count_r").val(tot_sel);
                $("#change_count").text(tot_sel);

                var val = parseFloat($("#selected_val" + id + '_' + 1).val()) || 0;

                if ($("#sel_count_r").val() != 0) {
                    $(".con_sub_btn").attr("disabled", false);
                } else {
                    $(".con_sub_btn").attr("disabled", true);
                }
            } else {
                var sno = 1;
                var c = parseFloat($("#sel_count_r").val()) || 0;
                var tot_sel = c - sno;
                $("#sel_count_r").val(tot_sel);
                $("#change_count").text(tot_sel);
                $("#selected_val" + id + '_' + 1).val()

                if ($("#sel_count_r").val() == 0) {
                    $(".con_sub_btn").attr("disabled", true);
                }
            }
            if ($("#selected_val" + id + '_' + 1).is(":checked")) {
                var sel_sq_val = parseFloat($("#select_plot_sqft").val()) || 0; // sq ft
                var sq_val = parseFloat($("#plot_sq_ft_" + id + "_1").val()) || 0;
                var sq_t = sel_sq_val + sq_val;
                var sq_tot = sq_t.toFixed(2);
                $("#select_plot_sqft").val(sq_tot);
            } else {
                var sel_sq_val = parseFloat($("#select_plot_sqft").val()) || 0; // sq ft
                var sq_val = parseFloat($("#plot_sq_ft_" + id + "_1").val()) || 0;
                var sq_t = Number(sel_sq_val) - Number(sq_val);
                var sq_tot = sq_t.toFixed(2);
                $("#select_plot_sqft").val(sq_tot);
            }

            if ($("#selected_val" + id + '_' + 1).is(":checked")) {
                var sel_stam_val = parseFloat($("#select_stamp_duty").val()) || 0; // stamp duty
                var stam_val = parseFloat($("#stamp_duty_" + id + "_1").val()) || 0;
                var stamp_t = sel_stam_val + stam_val;
                var stamp_tot = stamp_t.toFixed(2);
                $("#select_stamp_duty").val(stamp_tot);
            } else {
                var sel_stam_val = parseFloat($("#select_stamp_duty").val()) || 0; // stamp duty
                var stam_val = parseFloat($("#stamp_duty_" + id + "_1").val()) || 0;
                var stamp_t = Number(sel_stam_val) - Number(stam_val);
                var stamp_tot = stamp_t.toFixed(2);
                $("#select_stamp_duty").val(stamp_tot);
            }

            if ($("#selected_val" + id + '_' + 1).is(":checked")) {
                var sel_dd_val = parseFloat($("#select_dd_charge").val()) || 0; // dd charge
                var dd_val = parseFloat($("#dd_charge_" + id + "_1").val()) || 0;
                var dd_t = sel_dd_val + dd_val;
                var dd_tot = dd_t.toFixed(2);
                $("#select_dd_charge").val(dd_tot);
            } else {
                var sel_dd_val = parseFloat($("#select_dd_charge").val()) || 0; // dd charge
                var dd_val = parseFloat($("#dd_charge_" + id + "_1").val()) || 0;
                var dd_t = Number(sel_dd_val) - Number(dd_val);
                var dd_tot = dd_t.toFixed(2);
                $("#select_dd_charge").val(dd_tot);
            }

            if ($("#selected_val" + id + '_' + 1).is(":checked")) {
                var sel_ex_val = parseFloat($("#select_extra_page_fees").val()) || 0; // extra page fees
                var ex_val = parseFloat($("#extra_page_" + id + "_1").val()) || 0;
                var ex_t = sel_ex_val + ex_val;
                var ex_tot = ex_t.toFixed(2);
                $("#select_extra_page_fees").val(ex_tot);
            } else {
                var sel_ex_val = parseFloat($("#select_extra_page_fees").val()) || 0; // extra page fees
                var ex_val = parseFloat($("#extra_page_" + id + "_1").val()) || 0;
                var ex_t = Number(sel_ex_val) - Number(ex_val);
                var ex_tot = ex_t.toFixed(2);
                $("#select_extra_page_fees").val(ex_tot);
            }

            if ($("#selected_val" + id + '_' + 1).is(":checked")) {
                var sel_com_val = parseFloat($("#select_computer_fees").val()) || 0; // computer fees
                var com_val = parseFloat($("#computer_fees_" + id + "_1").val()) || 0;
                var com_t = sel_com_val + com_val;
                var com_tot = com_t.toFixed(2);
                $("#select_computer_fees").val(com_tot);
            } else {
                var sel_com_val = parseFloat($("#select_computer_fees").val()) || 0; // computer fees
                var com_val = parseFloat($("#computer_fees_" + id + "_1").val()) || 0;
                var com_t = Number(sel_com_val) - Number(com_val);
                var com_tot = com_t.toFixed(2);
                $("#select_computer_fees").val(com_tot);
            }

            if ($("#selected_val" + id + '_' + 1).is(":checked")) {
                var sel_cd_val = parseFloat($("#select_cd").val()) || 0; // cd
                var cd_val = parseFloat($("#cd_" + id + "_1").val()) || 0;
                var cd_t = sel_cd_val + cd_val;
                var cd_tot = cd_t.toFixed(2);
                $("#select_cd").val(cd_tot);
            } else {
                var sel_cd_val = parseFloat($("#select_cd").val()) || 0; // cd
                var cd_val = parseFloat($("#cd_" + id + "_1").val()) || 0;
                var cd_t = Number(sel_cd_val) - Number(cd_val);
                var cd_tot = cd_t.toFixed(2);
                $("#select_cd").val(cd_tot);
            }
            if ($("#selected_val" + id + '_' + 1).is(":checked")) {
                var sel_sub_val = parseFloat($("#select_sub_division_fees").val()) || 0; // sub division fees
                var sub_val = parseFloat($("#sub_division_" + id + "_1").val()) || 0;
                var sub_t = sel_sub_val + sub_val;
                var sub_tot = sub_t.toFixed(2);
                $("#select_sub_division_fees").val(sub_tot);
            } else {
                var sel_sub_val = parseFloat($("#select_sub_division_fees").val()) || 0; // sub division fees
                var sub_val = parseFloat($("#sub_division_" + id + "_1").val()) || 0;
                var sub_t = Number(sel_sub_val) - Number(sub_val);
                var sub_tot = sub_t.toFixed(2);
                $("#select_sub_division_fees").val(sub_tot);
            }

            if ($("#selected_val" + id + '_' + 1).is(":checked")) {
                var sel_rg_val = parseFloat($("#select_register_office").val()) || 0; // register office
                var rg_val = parseFloat($("#reg_off_" + id + "_1").val()) || 0;
                var rg_t = sel_rg_val + rg_val;
                var rg_tot = rg_t.toFixed(2);
                $("#select_register_office").val(rg_tot);
            } else {
                var sel_rg_val = parseFloat($("#select_register_office").val()) || 0; // register office
                var rg_val = parseFloat($("#reg_off_" + id + "_1").val()) || 0;
                var rg_t = Number(sel_rg_val) - Number(rg_val);
                var rg_tot = rg_t.toFixed(2);
                $("#select_register_office").val(rg_tot);
            }

            if ($("#selected_val" + id + '_' + 1).is(":checked")) {
                var sel_wr_val = parseFloat($("#select_writter_fees").val()) || 0; // writer fees
                var wr_val = parseFloat($("#writer_fees_" + id + "_1").val()) || 0;
                var wr_t = sel_wr_val + wr_val;
                var wr_tot = wr_t.toFixed(2);
                $("#select_writter_fees").val(wr_tot);
            } else {
                var sel_wr_val = parseFloat($("#select_writter_fees").val()) || 0; // writer fees
                var wr_val = parseFloat($("#writer_fees_" + id + "_1").val()) || 0;
                var wr_t = Number(sel_wr_val) - Number(wr_val);
                var wr_tot = wr_t.toFixed(2);
                $("#select_writter_fees").val(wr_tot);
            }

            if ($("#selected_val" + id + '_' + 1).is(":checked")) {
                var sel_ec_val = parseFloat($("#select_ec").val()) || 0; // ec
                var ec_val = parseFloat($("#ec_" + id + "_1").val()) || 0;
                var ec_t = sel_ec_val + ec_val;
                var ec_tot = ec_t.toFixed(2);
                $("#select_ec").val(ec_tot);
            } else {
                var sel_ec_val = parseFloat($("#select_ec").val()) || 0; // ec
                var ec_val = parseFloat($("#ec_" + id + "_1").val()) || 0;
                var ec_t = Number(sel_ec_val) - Number(ec_val);
                var ec_tot = ec_t.toFixed(2);
                $("#select_ec").val(ec_tot);
            }

            if ($("#selected_val" + id + '_' + 1).is(":checked")) {
                var sel_ot_val = parseFloat($("#select_other_expense").val()) || 0; // other expense
                var ot_val = parseFloat($("#other_exp_" + id + "_1").val()) || 0;
                var ot_t = sel_ot_val + ot_val;
                var ot_tot = ot_t.toFixed(2);
                $("#select_other_expense").val(ot_tot);
            } else {

                var sel_ot_val = parseFloat($("#select_other_expense").val()) || 0; // other expense
                var ot_val = parseFloat($("#other_exp_" + id + "_1").val()) || 0;
                var ot_t = Number(sel_ot_val) - Number(ot_val);
                var ot_tot = ot_t.toFixed(2);
                $("#select_other_expense").val(ot_tot);
            }

            if ($("#selected_val" + id + '_' + 1).is(":checked")) {
                var sel_tot_exp = parseFloat($("#select_total_expenses").val()) || 0; // total expense
                var tot_exp = parseFloat($("#total_expenses_" + id + "_1").val()) || 0;
                var ot_t = sel_tot_exp + tot_exp;
                var ot_tot = ot_t.toFixed(2);
                $("#select_total_expenses").val(ot_tot);
            } else {

                var sel_ot_val = parseFloat($("#select_total_expenses").val()) || 0; // other expense
                var ot_val = parseFloat($("#total_expenses_" + id + "_1").val()) || 0;
                var ot_t = Number(sel_ot_val) - Number(ot_val);
                var ot_tot = ot_t.toFixed(2);
                $("#select_total_expenses").val(ot_tot);
            }
            
            //  }

        }
        // expense store
        $("#Add_RegistrationExpenseConfirm_Form").submit(function(e) {
            e.preventDefault();
            var optionsChecked = [];
            $('.selected_val:checkbox:checked').each(function() {
                optionsChecked.push($(this).val());
            });
            var form = $("#Add_RegistrationExpenseConfirm_Form")[0];
            var url = $("#store_url").val();
            var formData = new FormData(form);
            formData.append('book_up_id', optionsChecked);

            $.ajax({
                url: url,
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == true) {
                        swal("Created!", data.message, "success");
                        $("#get_project_id").val("").trigger("change");
                        $("#registration_expense_by").val("").trigger("change");
                        $("#reg_expense_by").val("");
                        $("#plot_no").val("").trigger("change");
                        expense_lists();
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

        function get_gl_value() {
            var project_id = $("#get_project_id").val();
            var plot_id = $("#plot_no").val();
            var url = "{{ url('/') }}/get-registration-expense-detail";
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
                            $("#gl_value").val(res.gl_value);

                        }
                    }
                });
            } else {
                PlotNoView();
                // $("#status").val('').trigger('change');
            }
        }

        function New_expense_val(book_id) {
            var id = book_id;

            var stamp = parseFloat($('#stamp_duty_' + id + '_1').val()) || 0;
            var dd = parseFloat($('#dd_charge_' + id + '_1').val()) || 0;
            var extra_page = parseFloat($('#extra_page_' + id + '_1').val()) || 0;
            var com_fees = parseFloat($('#computer_fees_' + id + '_1').val()) || 0;
            var cd = parseFloat($('#cd_' + id + '_1').val()) || 0;
            var sub_div = parseFloat($('#sub_division_' + id + '_1').val()) || 0;
            var reg_office = parseFloat($('#reg_off_' + id + '_1').val()) || 0;
            var writter_fee = parseFloat($('#writer_fees_' + id + '_1').val()) || 0;
            var ec = parseFloat($('#ec_' + id + '_1').val()) || 0;
            var other_expense = parseFloat($('#other_exp_' + id + '_1').val()) || 0;

            var total = stamp + dd + extra_page + com_fees + cd + sub_div + reg_office + writter_fee + ec + other_expense;

            $('#total_expenses_' + id + '_1').val(total);
            total_sum_calculation(); //sum call back function
        }
    </script>
@endsection
