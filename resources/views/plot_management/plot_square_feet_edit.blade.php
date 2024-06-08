@extends('layouts.app')
@section('content')
    <div class="row row-sm mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Plot Square Feet</div>
                </div>
                <div class="card-body">
                    <form id="Plot_sqft_edit_Form" class="p-3" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" name="edit_plot_id" id="edit_plot_id">
                                <label class="form-label">Project Name <span class="text-red">*</span></label>
                                <select name="edit_project_id" id="edit_project_id" class="form-control SlectBox"
                                    onchange="Plot_No_View()">
                                    <option value="">Select Project</option>
                                    @if (isset($projects))
                                        @foreach ($projects as $val)
                                            <option value="{{ $val->id }}">{{ $val->short_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <span id="project_name_validation" class="text-danger" style="display:none;">Project
                                    Name
                                    Field is Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Initial Plot No. <span class="text-red">*</span></label>
                                <select name="edit_ini_plot_no" id="edit_ini_plot_no" class="form-control SlectBox">
                                    <option value="">Select Plot No</option>
                                </select>
                                <span id="ini_plot_no_validation" class="text-danger" style="display:none;">Initial Plot
                                    No Field is Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Initial Plot Sq.Ft <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="edit_ini_plot_sq_ft"
                                        id="edit_ini_plot_sq_ft" placeholder="" readonly>

                                    <input type="hidden" class="form-control" name="old_edit_ini_plot_sq_ft"
                                        id="old_edit_ini_plot_sq_ft" placeholder="" readonly>
                                </div>
                                <span style="display:none" class="text-danger" id="ini_plot_sq_ft_validation">Initail Plot
                                    Square Feet
                                    Field is
                                    Required</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">New Plot No. <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="edit_new_plot_no" id="edit_new_plot_no"
                                        placeholder="">
                                </div>
                                <span style="display:none" class="text-danger" id="new_plot_no_validation">New Plot No Feild
                                    is Required.</span>
                                <span id="exist_plot_no_validation" class="text-danger" style="display:none;">Plot No
                                    Already Exist.</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">New Plot Sq.Ft <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="edit_new_plot_sq_ft"
                                        id="edit_new_plot_sq_ft" placeholder="">
                                </div>
                                <span style="display:none" class="text-danger" id="new_plot_sq_ft_validation"> New Plot
                                    Square Feet
                                    Field is
                                    Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Reason <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <textarea class="form-control" placeholder="Kindly Enter Valid Reason..." name="valid_reason" id="valid_reason"
                                        rows="3"></textarea>
                                </div>
                                <span style="display:none" class="text-danger" id="valid_reason_validation">
                                    Reason Field is Required</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                @php
                                    $permission = new \App\Models\Permission();
                                    $edit_check = $permission->checkPermission('editplotsquarefeet.create');
                                @endphp
                                @if($edit_check == 1)
                                <button type="submit" class="btn btn-primary me-2">Save</button>
                                @endif
                                <!-- <a href="{{ url('plot-create') }}" class="btn btn-light">Cancel</a> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="plot_square_feet_edit_lists"
                    class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Project Name</th>
                            <th>Initial Plot No</th>
                            <th>Initial Plot Sq.Ft</th>
                            <th>New Plot No</th>
                            <th>New Plot Sq.Ft</th>
                            <th>Reason</th>
                        </tr>
                    </thead>
                    <tbody id="Table_body">
                        <!-- <tr id="table_row_1">
                                                                                                                                                                                                                                <td colspan="6" style="text-align:center">No Data Found</td>
                    <?php
                    $count = \App\Models\PlotSqftEdit::count();
                    ?>
                    </tr> -->
                      @if ($count > 0)
                            @if (isset($plot_sqft_edits))
                                <?php $i = 1; ?>
                                @foreach ($plot_sqft_edits as $val)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $val->short_name }}</td>
                                        <td>{{ $val->plot_no }}</td>
                                        <td>{{ $val->initial_plot_sq_ft }}</td>
                                        <td>{{ $val->new_plot_no }}</td>
                                        <td>{{ $val->new_plot_sq_ft }}</td>
                                        <td>{{ $val->reason }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        @else
                            <tr>
                                <td colspan='7' class='text-center'>No Data Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function Plot_No_View() {
            var id = $('#edit_project_id').val();
            var url = "{{ url('/') }}/get-plot-list/" + id + "/edit";
            $("#edit_ini_plot_no").html("<option value=''>Select Plot No</option>");
            $("#edit_ini_plot_sq_ft").val("");
            $("#old_edit_ini_plot_sq_ft").val("");
            $("#Table_body").html("<tr><td colspan='7' class='text-center'>No Data Found</td></tr>");
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    id: id
                },
                success: function(res) {
                    if (res.data.length > 0) {
                        $.each(res.data, function(key, value) {
                            $("#edit_ini_plot_no").append('<option value="' + value
                                .id +
                                '">' +
                                value.plot_no + '</option>')
                        });
                        if (res.exist_edits.length > 0) {
                            var html = '';
                            var sno = 1;
                            $.each(res.exist_edits, function(key, value) {
                                html += "<tr>";
                                html += "<td>" + sno++ + "</td>";
                                html += "<td>" + value.short_name + "</td>";
                                html += "<td>" + value.plot_no + "</td>";
                                html += "<td>" + value.initial_plot_sq_ft + "</td>";
                                html += "<td>" + value.new_plot_no + "</td>";
                                html += "<td>" + value.new_plot_sq_ft + "</td>";
                                html += "<td>" + value.reason + "</td>";
                                html += "</tr>";
                            });
                            $("#Table_body").html(html);
                        } else {
                            $("#Table_body").html(
                                "<tr><td colspan='7' class='text-center'>No Data Found</td></tr>");
                        }
                    } else {
                        $("#edit_ini_plot_no").html(
                            "<option value=''>Select Plot No</option>");
                    }
                }
            });
        }
        $(document).ready(function() {
            $('#edit_ini_plot_no').on('change', function() {
                var id = $(this).val();
                var url = "{{ url('/') }}/get-plot-sqft/" + id;
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        id: id
                    },
                    success: function(res) {
                        console.log(res.data);
                        $("#edit_plot_id").val(res.data.id);
                        $("#edit_ini_plot_sq_ft").val(res.plot_sqft);
                        $("#old_edit_ini_plot_sq_ft").val(res.plot_sqft);
                    }
                });
            });

            //new plot sq.ft calcultion
            $(document).on("keyup", "#edit_new_plot_sq_ft", function() {
                var ini_plot_sqft = $("#old_edit_ini_plot_sq_ft").val();
                var new_plot_sqft = $("#edit_new_plot_sq_ft").val();

                var remain_sqft = ini_plot_sqft - new_plot_sqft;

                $("#edit_ini_plot_sq_ft").prop("readonly", "false");
                $("#edit_ini_plot_sq_ft").val(remain_sqft).prop("readonly", "true");
            });

        });
    </script>
@endsection
