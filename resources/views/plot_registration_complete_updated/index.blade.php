@extends('layouts.app')
@section('content')
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Plot Registration Completed Updated</h3>
                </div>
                <div class="card-body">
                    <div class="container">

                        <div class="row mt-2">
                            <div class="col-12">
                                <h5 class="fw-bold mt-1" style="color: #6259ca; text-align:center;">Project Details</h5>
                            </div>
                        </div>
                        <?php
                        $project_id = Request::input('project_id');
                        $plot_id = Request::input('plot_no');
                        ?>
                        <?php
                            $status =Request::input('status');
                            ?>
                        <form id="Reg_com_update_list" autocomplete="off" url="{{ route('registration_com_update') }}">

                            <div class="row p-2" style="border-radius:5px; border:1px solid #212326ad;">
                                <div class="col-sm-6 col-md-3 mb-2">
                                    <label class="form-label">Project Name </label>
                                    <select name="project_id" id="project_id" class="form-control SlectBox"
                                        onchange="Reg_com_update_filter()">
                                        <option value="">Select Project</option>
                                        @if (isset($projects))
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}"
                                                    @if ($project_id == $project->id) {{ 'selected' }} @endif>
                                                    {{ $project->short_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-6 col-md-3 mb-2">
                                    <label class="form-label">Plot No.</label>
                                    <select name="plot_no" id="plot_no" class="form-control SlectBox" onchange="Reg_com_update_filter()">
                                        <option value="">Select Plot No</option>
                                        @if (isset($plot_nos))
                                            @foreach ($plot_nos as $val)
                                                <option value="{{ $val->id }}"
                                                    @if ($plot_id == $val->id) {{ 'selected' }} @endif>
                                                    {{ $val->plot_no }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span id="plot_no_validation" class="text-danger" style="display:none;">Plot
                                        No Field is Required</span>
                                </div>
                                
                                 <div class="col-sm-6 col-md-3 mb-2">
                                <label class="form-label">Status </label>
                                <div class="input-group">
                                   <select name="status" id="status" class="form-control SlectBox" onchange="Reg_com_update_filter()">
                                       <option value="">All</option>
                                       <option value="1"  <?php if($status == 1){ echo  "selected"; } ?> >Completed </option>
                                       <option value="2" <?php if($status == 2){ echo  "selected"; } ?> >Pending </option>
                                    </select>
                                </div>
                             
                            </div>
                                <div class="col-sm-6 col-md-3 mb-2">
                                    <label class="form-label" style="color:white;">.</label>
                                    <button type="button" class="btn btn-primary"
                                        onclick="Reg_com_update_filter()">Search</button>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h5 class="fw-bold" style="color: #6259ca; text-align:center;">Registration List</h5>
                                </div>
                            </div>
                        </form>
                        <form id="Add_RegistrationComUpdate_Form" autocomplete="off">
                            @csrf
                            @method('POST')
                            <div class="row p-2" style="border-radius:5px; border:1px solid #212326ad;">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="hidden" id="store_url"
                                                value="{{ route('registration_com_update_store') }}">
                                            <label for="register_date" class="form-label mt-0">Reg. Date</label>
                                            <input type="date" name="register_date" id="register_date"
                                                class="form-control" value="{{ date('Y-m-d') }}">

                                            <span id="register_date_validation" class="text-danger"
                                                style="display:none;">Register Date
                                                is Required</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="table-responsive">
                                        <table id="plot_expense_lists" class="table table-bordered text-nowrap mb-0">
                                            <thead class="border text-center">
                                                <tr>
                                                    <th class="bg-transparent border-bottom-0">S.no</th>
                                                    <th class="bg-transparent border-bottom-0">Project Name</th>
                                                    <th class="bg-transparent border-bottom-0">Plot No.</th>
                                                    <th class="bg-transparent border-bottom-0">Customer Name</th>
                                                    <th class="bg-transparent border-bottom-0">Mobile</th>
                                                    <th class="bg-transparent border-bottom-0">Booked Date</th>
                                                    <th class="bg-transparent border-bottom-0">Fully Paid Date</th>
                                                    <th class="bg-transparent border-bottom-0">Plot Sq.Ft.</th>
                                                    <th class="bg-transparent border-bottom-0">GL. value</th>
                                                    <th class="bg-transparent border-bottom-0">Status</th>
                                                    <th class="bg-transparent border-bottom-0">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table_tbody_row" class="border">

                                                @if (count($list) > 0)
                                                    <?php
                                                    $i = 1;
                                                    ?>
                                                    @foreach ($list as $val)
                                                    <?php
                                                    if($val->register_status == 1){
                                                        
                                                        $status = "Completed";
                                                    }else{
                                                        $status = "Pending";
                                                    }
                                                    
                                                    
                                                     if(isset($val->customer_id))
                                                     {
                                                      $get_customer = \App\Models\Booking::where('id',$val->customer_id)->first();   
                                                       $customer_name = $get_customer->customer_name;
                                                         $customer_mobile = $get_customer->mobile;
                                                     }else{
                                                         $customer_name = $val->customer_name;
                                                         $customer_mobile = $val->mobile;
                                                     }
                                                    ?>
                                                        <tr class="tr_row">
                                                            <td style="vertical-align: middle;">{{ $i++ }}</td>
                                                            <td style="vertical-align: middle;">{{ $val->short_name }}</td>
                                                            <td style="vertical-align: middle;">{{ $val->plot_no }}</td>
                                                            <td style="vertical-align: middle;">{{ $customer_name }}
                                                            </td>
                                                            <td style="vertical-align: middle;">{{ $customer_mobile }}</td>
                                                            <td style="vertical-align: middle;">
                                                                {{ date('d-m-Y', strtotime($val->receipt_date)) }}</td>
                                                            @php
                                                                $paid_date = \App\Models\Payment::where('project_id', $val->n_project_id)
                                                                    ->where('plot_id', $val->n_plot_id)
                                                                    ->orderby('id', 'desc')
                                                                    ->first();
                                                            @endphp
                                                            @if (isset($paid_date))
                                                                <td style="vertical-align: middle;">
                                                                    {{ date('d-m-Y', strtotime($paid_date->receipt_date)) }}
                                                                </td>
                                                            @else
                                                                <td style="vertical-align: middle;">
                                                                    {{ date('d-m-Y', strtotime($val->receipt_date)) }}</td>
                                                            @endif
                                                            <td class="text-success" style="vertical-align: middle;"><input
                                                                    type="hidden" id="plot_sq_ft_{{ $val->booking_id }}_1"
                                                                    class="plot_sq_ft"
                                                                    value="{{ $val->plot_sq_ft }}">{{ $val->plot_sq_ft }}
                                                            </td>
                                                            <?php
                                                            if(isset($val->new_update_gl_val))
                                                            {
                                                                $gl_value = $val->new_update_gl_val;
                                                            }else{
                                                                $gl_value = $val->guide_line_sq_ft;
                                                            }
                                                            ?>
                                                            <td>
                                                                <input type="text" class="form-control gl_val"
                                                                    value="{{ $gl_value }}">
                                                            </td>
                                                            
                                                            <td>
                                                            <h6 class="fs-14 fw-bold text-end pt-2 text-success">{{ $status }}</h6>
                                                           </td>

                                                            <td><label class="custom-control custom-checkbox mt-2"><input
                                                                        name="selected_val[]"
                                                                        class="custom-control-input selected_val"
                                                                        id="selected_val_{{ $val->booking_id }}_1"
                                                                        type="checkbox"  <?php if($val->register_status == 1){?> disabled  checked <?php } ?>
                                                                        onclick="isCheckedById({{ $val->booking_id }})"
                                                                        value="{{ $val->booking_id }}"
                                                                        data-gl_value="{{ $val->guide_line_sq_ft }}"
                                                                        data-plot_id="{{ $val->n_plot_id }}"><span
                                                                        class="custom-control-label "> </span></label></td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <td colspan="11" class="text-center">Data No Found</td>
                                                @endif

                                                <tr>
                                                    <td colspan="7">
                                                        <h6 class="text-end fw-bold text-danger">Total :</h6>
                                                    </td>
                                                    <td colspan="4"><input type="text" name="total_plot_sqft"
                                                            id="total_plot_sqft" class="form-control"
                                                            style="width: 90px;" readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan='7'>
                                                        <h6 class='text-end text-danger fw-bold'>Selected(<span
                                                                id='change_count'>0</span>) : </h6>
                                                        <input type='hidden' id='sel_count_r' value='0'>

                                                    </td>
                                                    <td colspan="4"><input text='text' id='select_plot_sqft'
                                                            class='form-control' value='0' style="width: 90px;" readonly>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-2 d-flex align-items-center justify-content-end">

                                    <button type="submit" class="btn btn-primary me-2 con_sub_btn"
                                        disabled>Complete</button>
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
        function Reg_com_update_filter() {
            $("#Reg_com_update_list").submit();
        }


        var plot_sq_ft = 0;
        $(".plot_sq_ft").each(function() { // commission amount
            var plot_sq_ft_rows = $(this).val();
            var plot_sq_ft_values = parseFloat(plot_sq_ft_rows);
            plot_sq_ft += plot_sq_ft_values;
        });
        var tot_plot_sq_ft = plot_sq_ft.toFixed(2);
        $("#total_plot_sqft").val(tot_plot_sq_ft);

        function isCheckedById(id) {

            if ($("#selected_val_" + id + '_' + 1).is(":checked")) {
                var sno = 1;
                var c = parseFloat($("#sel_count_r").val()) || 0;
                var tot_sel = sno + c;
                $("#sel_count_r").val(tot_sel);
                $("#change_count").text(tot_sel);

                var val = parseFloat($("#selected_val" + id + '_' + 1).val()) || 0;

                if ($("#sel_count_r").val() != 0) {
                    $(".con_sub_btn").attr("disabled", false);
                } else {
                    alert("else");
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

            if ($("#selected_val_" + id + '_' + 1).is(":checked")) {
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
        }

        // get the plot_nos
        function PlotNoView() {
            var project_id = $("#project_id").val();
            var url = "{{ url('/') }}/registration-completed-get-plots";
            $("#plot_no").html("<option value=''>Select Plot No</option>");
            if (project_id != "") {
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        project_id: project_id,
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
            }
        }
        $("#Add_RegistrationComUpdate_Form").submit(function(e) {
            e.preventDefault();
            var optionsChecked = [];
            var plot_ids = [];
            var gl_values = [];
            var c = 0;
            $('.selected_val:checkbox:checked').each(function() {
                optionsChecked.push($(this).val());
                plot_ids.push($(this).data('plot_id'));
                c++;
                var gl_val = $(this).closest(".tr_row").find(".gl_val").val();
                // var gl_val = $("#guide_line_1_" + c).val();
                gl_values.push(gl_val);

            });
            var form = $("#Add_RegistrationComUpdate_Form")[0];
            var url = $("#store_url").val();
            var redirect = "{{ url('/') }}/registration-completed-updated";
            var formData = new FormData(form);
            formData.append('book_up_id', optionsChecked);
            formData.append('plot_id', plot_ids);
            formData.append('gl_value', gl_values);

            $.ajax({
                url: url,
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == true) {
                        swal("Created!", data.message, "success");
                        setTimeout(function() {
                            window.location.href = redirect;
                        }, 2000);
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
