@extends('layouts.app')
@section('content')

    <!-- edit plot  -->
    <!-- edit plot popup -->
    <div class="modal fade" id="Edit_plotModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Plot</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="Edit_PlotForm" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <h4>Project Detail</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" id="edit_plot_id" value="">
                                <input type="hidden" name="edit_project_id" id="edit_project_id">
                                <label class="form-label">Project Name <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select id="get_project_id" class="form-control SlectBox" disabled>
                                        <option value="">Select Project</option>
                                        @if (isset($projects))
                                            @foreach ($projects as $val)
                                                <option value="{{ $val->id }}">{{ $val->short_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <span id="edit_project_name_validation" class="text-danger" style="display:none;">Project
                                    Name
                                    Field is Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Type <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="edit_type_id" id="edit_type_id" class="form-control SlectBox">
                                        <option value="">Select Type</option>
                                        @if (isset($types))
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->project_type }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <span id="edit_type_validation" class="text-danger" style="display:none;">Type Field is
                                    Required</span>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Guide Line value / Sq.Ft.<span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="edit_guide_line_sq_ft"
                                        id="edit_guide_line_sq_ft" placeholder="0.00" readonly>
                                </div>
                                <span id="edit_guide_line_sq_ft_validation" class="text-danger" style="display:none;">Guide
                                    Line
                                    value Sq.Ft
                                    Field is Required</span>
                            </div>
                            @if(Auth::user()->designation_id != 11)
                            <div class="col-md-4">
                                <label class="form-label">Market value / Sq.Ft.<span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="edit_market_value_sq_ft"
                                        id="edit_market_value_sq_ft" placeholder="0.00" readonly>
                                </div>
                                <span id="edit_market_value_sq_ft_validation" class="text-danger"
                                    style="display:none;">Market
                                    value
                                    Field is Required</span>
                            </div>
                            @endif
                        </div>
                        <div class="row mt-4">
                            <h4>Plot Detail</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Plot No. <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="edit_plot_no" id="edit_plot_no"
                                        placeholder="Plot No">
                                </div>
                                <span id="edit_plot_no_validation" class="text-danger" style="display:none;">Plot No
                                    Field is
                                    Required</span>
                                <span id="edit_exist_plot_no_validation" class="text-danger" style="display:none;">Plot No
                                    Already Exist!.</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Plot Sq.Ft. <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="edit_plot_sq_ft" id="edit_plot_sq_ft"
                                        placeholder="Plot Square Feet" readonly>
                                </div>
                                <span id="edit_plot_sq_ft_validation" class="text-danger" style="display:none;">Plot No
                                    Field is
                                    Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Direction <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="edit_direction_id" id="edit_direction_id"
                                        class="form-control SlectBox">
                                        <option value="">Select Type</option>
                                        @if (isset($directions))
                                            @foreach ($directions as $val)
                                                <option value="{{ $val->id }}">{{ $val->direction_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <span id="edit_direction_validation" class="text-danger" style="display:none;">Direction
                                    Field
                                    is Required</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Plot Rate(GL) <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="edit_guide_line_plot_rate"
                                        id="edit_guide_line_plot_rate" placeholder="0.00" readonly>
                                </div>
                                <span id="edit_guide_line_plot_rate_validation" class="text-danger"
                                    style="display:none;">Guide Line
                                    Plot Rate Field is
                                    Required</span>
                            </div>
                            @if(Auth::user()->designation_id != 11)
                            <div class="col-md-4">
                                <label class="form-label">Plot Rate(MV) <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="edit_market_value_plot_rate"
                                        id="edit_market_value_plot_rate" placeholder="0.00" readonly>
                                    <span id="edit_market_value_plot_rate_validation" class="text-danger"
                                        style="display:none;">Guide Line
                                        Plot Rate Field is
                                        Required</span>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row mt-5">
                            <div class="col d-flex align-items-center justify-content-end">
                                <div>
                                    <button type="submit" class="btn me-1"
                                        style="background-color: #5a51c7; color:white;">Update</button>
                                    <a class="btn btn-light" data-bs-dismiss="modal">Close</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card ">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Add Plot Management</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form id="Add_PlotForm" autocomplete="off">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Project Name <span
                                                        class="text-red">*</span></label>
                                                <select name="project_id" id="project_id" class="form-control SlectBox">
                                                    <option value="">Select Project</option>
                                                    @if (isset($projects))
                                                        @foreach ($projects as $val)
                                                            <option value="{{ $val->id }}">{{ $val->short_name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <span id="project_name_validation" class="text-danger"
                                                    style="display:none;">Project Name
                                                    Field is Required</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Type <span class="text-red">*</span></label>
                                                <select name="type_id" id="type_id" class="form-control SlectBox">
                                                    <option value="">Select Type</option>
                                                    @if (isset($types))
                                                        @foreach ($types as $type)
                                                            <option value="{{ $type->id }}">{{ $type->project_type }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <span id="type_validation" class="text-danger" style="display:none;">Type
                                                    Field is
                                                    Required</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Guide Line value / Sq.Ft.<span
                                                        class="text-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="guide_line_sq_ft"
                                                        id="guide_line_sq_ft" placeholder="0.00" readonly>
                                                </div>
                                                <span id="guide_line_sq_ft_validation" class="text-danger"
                                                    style="display:none;">Guide Line value Sq.Ft
                                                    Field is Required</span>
                                            </div>
                                        </div>
                                        @if(Auth::user()->designation_id != 11)
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Market value / Sq.Ft.<span
                                                        class="text-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="market_value_sq_ft"
                                                        id="market_value_sq_ft" placeholder="0.00" readonly>
                                                </div>
                                                <span id="market_value_sq_ft_validation" class="text-danger"
                                                    style="display:none;">Market value
                                                    Field is Required</span>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12  col-md-6">
                                    <div class="row">
                                        <div class="panel panel-primary">
                                            <div class=" tab-menu-heading">
                                                <div class="tabs-menu1 ">
                                                    <!-- Tabs -->
                                                    <ul class="nav panel-tabs">
                                                        <li><a href="#tab6" data-bs-toggle="tab"
                                                                class="me-1 active">Add
                                                                Plot</a>
                                                        </li>
                                                        <!-- <li><a href="{{ url('plot-square-feet/edit') }}"
                                                                                                                    class="me-1">Plot
                                                                                                                    Sq.Ft Edit</a>
                                                                                                            </li> -->
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="panel-body tabs-menu-body">
                                                <div class="tab-content">

                                                    <div class="tab-pane active" id="tab6">
                                                        <div class="row">
                                                            <div class="col-sm-6 col-md-4">
                                                                <label class="form-label">Plot No. <span
                                                                        class="text-red">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control"
                                                                        name="plot_no" id="plot_no"
                                                                        placeholder="Plot No">
                                                                </div>
                                                                <span id="plot_no_validation" class="text-danger"
                                                                    style="display:none;">Plot No Field is
                                                                    Required</span>
                                                                <span id="exist_plot_no_validation" class="text-danger"
                                                                    style="display:none;">Plot No Already Exist.</span>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <label class="form-label">Plot Sq.Ft. <span
                                                                        class="text-red">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control"
                                                                        name="plot_sq_ft" id="plot_sq_ft"
                                                                        placeholder="Plot Square Feet">
                                                                </div>
                                                                <span id="plot_sqft_validation" class="text-danger"
                                                                    style="display:none;">Plot Square Feet
                                                                    Field is Required</span>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <label class="form-label">Direction <span
                                                                        class="text-red">*</span></label>
                                                                <div class="input-group">
                                                                    <select name="direction_id" id="direction_id"
                                                                        class="form-control SlectBox">
                                                                        <option value="">Select Direction</option>
                                                                        @if (isset($directions))
                                                                            @foreach ($directions as $val)
                                                                                <option value="{{ $val->id }}">
                                                                                    {{ $val->direction_name }}
                                                                                </option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                                <span id="direction_validation" class="text-danger"
                                                                    style="display:none;">Direction Field
                                                                    is Required</span>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6 col-md-4">
                                                                <label class="form-label">Plot Rate(GL) <span
                                                                        class="text-red">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control"
                                                                        name="guide_line_plot_rate"
                                                                        id="guide_line_plot_rate" placeholder="0.00"
                                                                        readonly>
                                                                </div>
                                                                <span id="guide_line_plot_rate_validation"
                                                                    class="text-danger" style="display:none;">Guide Line
                                                                    Plot Rate Field is
                                                                    Required</span>
                                                            </div>
                                                            @if(Auth::user()->designation_id != 11)
                                                            <div class="col-sm-6 col-md-4">
                                                                <label class="form-label">Plot Rate(MV) <span
                                                                        class="text-red">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control"
                                                                        name="market_value_plot_rate"
                                                                        id="market_value_plot_rate" placeholder="0.00"
                                                                        readonly>
                                                                </div>
                                                                <span id="market_value_plot_rate_validation"
                                                                    class="text-danger" style="display:none;">Guide Line
                                                                    Plot Rate Field is
                                                                    Required</span>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6 col-md-4 mt-2">
                                                                <button type="submit" class="btn mt-5"
                                                                    style="background-color: #5a51c7; color:white;">Add</button>
                                                            </div>
                                                        </div>
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
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card ">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="plot_management_lists" class="table table-bordered text-nowrap mb-0">
                            <thead class="border-top">
                                <tr>
                                    <th class="bg-transparent border-bottom-0 w-5">S.no</th>
                                    <th class="bg-transparent border-bottom-0">Plot No.</th>
                                    <th class="bg-transparent border-bottom-0">Plot.Sq.Ft</th>
                                    <th class="bg-transparent border-bottom-0">GL Value / Sq.Ft</th>
                                    @if(Auth::user()->designation_id  != 11)
                                    <th class="bg-transparent border-bottom-0">MV Value / Sq.Ft</th>
                                    @endif
                                    <th class="bg-transparent border-bottom-0">GL. Plot Rate</th>
                                    <th class="bg-transparent border-bottom-0">MV. Plot Rate</th>
                                    <th class="bg-transparent border-bottom-0">Direction</th>
                                    <th class="bg-transparent border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table_body" class="border">
                                <tr>
                                    <td colspan="9" class="text-center">No data found</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // var plot_table = $('#plot_management_lists').DataTable();
        });

      


        function responsePlotChange() {
            var plot_id = $("#res_plot_no_search").val();
            if (plot_id != "") {
                var url = "{{ url('/') }}/plot-no-auto-fill/" + plot_id;
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        id: plot_id
                    },
                    success: function(res) {
                        if (res.status == true) {
                            $("#res_plot_sq_ft_search").val(res.plot.plot_sq_ft);
                            $("#res_gl_sq_ft_search").val(res.plot.guide_line_sq_ft);
                            $("#res_mv_sq_ft_search").val(res.plot.market_value_sq_ft);
                            $("#res_gl_plot_rate_search").val(res.plot.guide_line_plot_rate);
                            $("#res_mv_plot_rate_search").val(res.plot.market_value_plot_rate);
                            $("#res_seacrh_direction_id").val(res.plot.direction_id).trigger("change");
                        }
                    }
                });
            } else {
                $("#res_plot_sq_ft_search").val('');
                $("#res_gl_sq_ft_search").val('');
                $("#res_mv_sq_ft_search").val('');
                $("#res_gl_plot_rate_search").val('');
                $("#res_mv_plot_rate_search").val('');
                $("#res_seacrh_direction_id").val('').trigger("change");
            }
        }

        function SearchPlotNo() {
            var plot_id = $(".plot_no_search").val();
            if (plot_id != "") {
                var url = "{{ url('/') }}/plot-no-auto-fill/" + plot_id;
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        id: plot_id
                    },
                    success: function(res) {
                        if (res.status == true) {
                            $("#res_plot_sq_ft").val(res.plot.plot_sq_ft);
                            $("#res_gl_line_sq_ft").val(res.plot.guide_line_sq_ft);
                            $("#res_mv_sq_ft").val(res.plot.market_value_sq_ft);
                            $("#res_gl_plot_rate").val(res.plot.guide_line_plot_rate);
                            $("#res_mv_plot_rate").val(res.plot.market_value_plot_rate);
                            $("#res_direction_id").val(res.plot.direction_id).trigger("change");
                        } else {

                        }
                    }
                });
            } else {
                $("#res_plot_sq_ft").val('');
                $("#res_gl_line_sq_ft").val('');
                $("#res_mv_sq_ft").val('');
                $("#res_gl_plot_rate").val('');
                $("#res_mv_plot_rate").val('');
                $("#res_direction_id").val('').trigger("change");
            }
        }
        $("#plot_no_search").change(function() {
            var plot_id = $(this).val();
            var url = "{{ url('/') }}/plot-no-auto-fill/" + plot_id;
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    id: plot_id
                },
                success: function(res) {
                    if (res.status == true) {
                        $("#plot_sq_rate_search").val(res.sq_ft_rate);
                        $("#plot_rate_search").val(res.plot_rate);
                        $("#plot_sq_ft_search").val(res.plot_sq_ft);
                        $("#seacrh_direction_id").val(res.plot.direction_id).trigger("change");
                        $("#search_status").val(res.plot.status);
                    } else {

                    }
                }
            });
        });
      $('#project_id').on('change', function() {
            var id = $(this).val();
            var url = "{{ url('/') }}/plot-type-get-val/" + id;
            if (id != "") {
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        id: id
                    },
                    success: function(res) {
                        $("#type_id").val(res.data.project_type).trigger("change");
                        $("#guide_line_sq_ft").val(res.data.guide_line);
                        $("#market_value_sq_ft").val(res.data.market_value);
                        if (res.plots.length > 0) {
                            var html = '';
                            var index = 0;
                            html += '<tr>';
                            html += '<td>#</td>';
                            html +=
                                '<td><select name="plot_no_search" id="plot_no_search" class="form-control plot_no_search SlectBox" onchange="SearchPlotNo()"><option value="">Plot No</option>';
                            $.each(res.plots, function(key, value) {
                                html += '<option value=' + value.id + '>' + value.plot_no +
                                    '</option>';
                            });
                            html += '</select></td>';
                            html +=
                                '<td><input type="text" class="form-control" id="res_plot_sq_ft" readonly></td>';
                            html +=
                                '<td><input type="text" class="form-control" id="res_gl_line_sq_ft" readonly></td>';
                            html +=
                                '<td><input type="text" class="form-control" id="res_mv_sq_ft" readonly></td>';
                            html +=
                                '<td><input type="text" class="form-control" id="res_gl_plot_rate" readonly></td>';
                            html +=
                                '<td><input type="text" class="form-control" id="res_mv_plot_rate" readonly></td>';
                            html +=
                                '<td colspan="2"><select name="seacrh_direction_id" id="res_direction_id" class="form-control"><option value="">Direction</option>';
                            $.each(res.directions, function(key, value) {
                                html += '<option value=' + value.id + '>' + value
                                    .direction_name +
                                    '</option>';
                            });
                            html += '</tr>';

                            var plot_sqft = 0;
                            var guide_line_sqft = 0;
                            var mv_sqft = 0;
                            var gl_plot_rate = 0;
                            var mv_plot_rate = 0;

                            var total_plot_sqft = 0;
                            var total_gl_sqft = 0;
                            var total_mv_sqft = 0;
                            var total_gl_plot_rate = 0;
                            var total_mv_plot_rate = 0;
                            for (var i = 0; i < res.plots.length; i++) {
                                index++;
                                html += '<tr class="table_rows_count"><td>' + index +
                                    '</td><td>' +
                                    res.plots[i][
                                        'plot_no'
                                    ] + '</td><td>' + res.plots[i]['plot_sq_ft'] + '</td><td>' + res
                                    .plots[i]['guide_line_sq_ft'] + '</td><td>' + res.plots[i][
                                        'market_value_sq_ft'
                                    ] +
                                    '</td><td>' + res.plots[i][
                                        'guide_line_plot_rate'
                                    ] +
                                    '</td><td>' + res.plots[i]['market_value_plot_rate'] +
                                    '</td><td>' + res.plots[i]['direction_name'] +
                                    '</td><td><a class="btn-primary border-0 me-1" href="#"data-bs-toggle="modal" onclick="EditPlot(' +
                                    res.plots[i]['id'] +
                                    ')"style="padding: 4px; border-radius:5px;"><i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg"height="12" viewBox="0 0 19 24" width="12"><path d="M0 0h24v24H0V0z" fill="none" /><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-. 45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z" /></svg></i></a></td></tr>';

                                //footer count
                                plot_sqft += res.plots[i]['plot_sq_ft'];
                                total_gl_sqft += res.plots[i]['guide_line_sq_ft'];
                                total_mv_sqft += res.plots[i]['market_value_sq_ft'];
                                total_gl_plot_rate += res.plots[i]['guide_line_plot_rate'];
                                total_mv_plot_rate += res.plots[i]['market_value_plot_rate'];
                            }
                            var grand_plot_sqft = plot_sqft.toFixed(2);
                            var grand_gl_sqft = total_gl_sqft.toFixed(2);
                            var grand_mv_sqft = total_mv_sqft.toFixed(2);
                            var grand_gl_plot_rate = total_gl_plot_rate.toFixed(2);
                            var grand_mv_plot_rate = total_mv_plot_rate.toFixed(2);
                            // html += '<tr>' +
                            //     '<td>' +
                            //     '<h5 class="fw-bold text-end text-danger">Total:</h5>' +
                            //     '</td>' +
                            //     '<td>' +
                            //     '<h5 class="fw-bold text-success">' + res.plot_count + '</h5>' +
                            //     '</td>' +
                            //     '<td>' +
                            //     '<h5 class="fw-bold text-success">' + grand_plot_sqft + '</h5>' +
                            //     '</td>' +
                            //     '<td>' +
                            //     // '<h5 class="fw-bold text-success">' + grand_gl_sqft + '</h5>' +
                            //     '</td>' +
                            //     '<td>' +
                            //     // '<h5 class="fw-bold text-success">' + grand_mv_sqft + '</h5>' +
                            //     '</td>' +
                            //     '<td>' +
                            //     '<h5 class="fw-bold text-success">' + grand_gl_plot_rate + '</h5>' +
                            //     '</td>' +
                            //     '<td colspan="3">' +
                            //     '<h5 class="fw-bold text-success">' + grand_mv_plot_rate + '</h5>' +
                            //     '</td>' +
                            //     '</tr>';
                            search_bar(); // call back function
                            $("#table_body").html(html);
                        } else {
                            $("#table_body").html(
                                '<tr><td colspan="9" class="text-center">No data found.</td></tr>');
                        }
                    }
                });
            } else {

                $("#type_id").val("").trigger("change");
                $("#guide_line_sq_ft").val("");
                $("#market_value_sq_ft").val("");
                $("#table_body").html('<tr><td colspan="9" class="text-center">No data found.</td></tr>');
                $(".table_rows_count").html("");
                $("#new_table_body").css("display", "block");

            }
        });

        $('#get_project_id').on('change', function() {
            var id = $(this).val();
            var url = "{{ url('/') }}/plot-type-get-val/" + id;
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    id: id
                },
                success: function(res) {
                    $("#edit_type_id").val(res.data.project_type).trigger("change");
                    $("#edit_sq_ft_rate").val(res.data.market_value);
                }
            });
        });

        $(document).on("keyup", "#plot_sq_ft", function() {
            var gl_value = $("#guide_line_sq_ft").val();
            var mv_value = $("#market_value_sq_ft").val();
            var plot_sqft = $("#plot_sq_ft").val();
            var gl_plot_rate = gl_value * plot_sqft;
            var mv_plot_rate = mv_value * plot_sqft;
            $("#guide_line_plot_rate").val(gl_plot_rate);
            $("#market_value_plot_rate").val(mv_plot_rate);
        });

        $(document).on("keyup", "#edit_plot_sq_ft", function() {
            var gl_value = $("#edit_guide_line_sq_ft").val();
            var mv_value = $("#edit_market_value_sq_ft").val();
            var plot_sqft = $("#edit_plot_sq_ft").val();
            var gl_plot_rate = gl_value * plot_sqft;
            var mv_plot_rate = mv_value * plot_sqft;
            $("#edit_guide_line_plot_rate").val(gl_plot_rate);
            $("#edit_market_value_plot_rate").val(mv_plot_rate);
        });

        function EditPlot(id) {
            $('#Edit_plotModal').modal('show');
            $.ajax({
                url: '{{ url('/') }}' + "/plot/" + id + "/edit/",
                method: "GET",
                data: {
                    id: id
                },
                contentType: false,
                processData: false,
                success: function(res) {
                    
                     if (res.register_plot_count > 0) {
                        $("#edit_plot_sq_ft").attr('readonly', true);
                    } else {
                        $("#edit_plot_sq_ft").attr('readonly', false);
                    }
                    $("#edit_plot_id").val(res.data.id);
                    $('#edit_project_id').val(res.data.project_id);
                    $('#get_project_id').val(res.data.project_id).trigger("change");
                    $("#edit_type_id").val(res.data.type_id).trigger('change');
                    $("#edit_plot_no").val(res.data.plot_no);
                    $("#edit_plot_sq_ft").val(res.data.plot_sq_ft);
                    $("#edit_guide_line_sq_ft").val(res.project.guide_line);
                    $("#edit_market_value_sq_ft").val(res.project.market_value);
                    $("#edit_guide_line_plot_rate").val(res.data.guide_line_plot_rate);
                    $("#edit_market_value_plot_rate").val(res.data.market_value_plot_rate);
                    $("#edit_direction_id").val(res.data.direction_id).trigger('change');
                },
            });
        }
    </script>
@endsection
