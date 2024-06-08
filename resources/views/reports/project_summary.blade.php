@extends('layouts.app')
@section('content')
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Project Summary</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form id="project_summary_Form" action="" method="GET">

                            <div class="container">
                                {{-- <div class="row mt-2">
                                    <div class="col-12">
                                        <h4 class="fw-bold mt-1" style="color: #6259ca; text-align:center;">Project Details
                                        </h4>
                                    </div>
                                </div> --}}
                                <div class="row border border-light-subtle" style="border-radius:5px;">
                                    <div class="col-sm-6 col-md-4 mb-2">
                                        <label class="form-label">Project Name <span class="text-red">*</span></label>
                                        <select name="get_project_id" id="get_project_id" class="form-control SlectBox"
                                            onchange="project_summary_sumbit()">
                                            <option value="">Select Project</option>
                                            @if (isset($projects))
                                                @foreach ($projects as $project)
                                                    <option value="{{ $project->id }}"  @if (isset($id) && $project->id == $id) {{ 'selected' }} @endif>{{ $project->short_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span id="project_name_validation" class="text-danger" style="display:none;">Project
                                            Field is Required</span>
                                    </div>

                                    <!--<div class="col-sm-6 col-md-4 mb-2">-->
                                    <!--    <label class="form-label" style="color:white;">.</label>-->
                                    <!--    <button type="button" class="btn btn-primary"-->
                                    <!--        onclick="project_summary_sumbit()">Search</button>-->
                                    <!--</div>-->
                                   <div class="row mt-2 border border-light-subtle" style="border-radius:5px;">
                                <div class="table-responsive export-table">
                                    <table id="project_abstract_detail_lists" class="table table-bordered text-nowrap mb-0">
                                           <thead>
                                                <!--<tr>-->
                                                <!--    <th rowspan="2">S.No</th>-->
                                                <!--    <th rowspan="2">Project Name</th>-->
                                                <!--    <th rowspan="2">Start Date</th>-->
                                                <!--    <th rowspan="2">Days</th>-->
                                                <!--    <th colspan="2" class="text-center border-bottom:1px solid black !important;">Booking</th>-->
                                                <!--    <th rowspan="2">Booked</th>-->
                                                <!--    <th rowspan="2">Fully Paid</th>-->
                                                <!--    <th rowspan="2">Registered</th>-->
                                                <!--    <th rowspan="2">Reg. Pending</th>-->
                                                <!--    <th colspan="2" class="text-center">Total</th>-->
                                                <!--    <th colspan="2" class="text-center">Booked</th>-->
                                                <!--    <th colspan="2" class="text-center">Registered</th>-->
                                                <!--    <th colspan="2" class="text-center">Fully Paid</th>-->
                                                <!--    <th colspan="2" class="text-center">Vacant</th>-->
                                                <!--</tr>-->
                                                <!--<tr>-->
                                                <!--    <th style="border-top :1px solid #eaedf1 !important;">First</th>-->
                                                <!--    <th style="border-top :1px solid #eaedf1 !important;">Last</th>-->
                                                <!--    <th style="border-top :1px solid #eaedf1 !important;">Plots</th>-->
                                                <!--    <th style="border-top :1px solid #eaedf1 !important;">Sq. Ft</th>-->
                                                <!--    <th style="border-top :1px solid #eaedf1 !important;">Plots</th>-->
                                                <!--    <th style="border-top :1px solid #eaedf1 !important;">Sq. Ft</th>-->
                                                <!--    <th style="border-top :1px solid #eaedf1 !important;">Plots</th>-->
                                                <!--    <th style="border-top :1px solid #eaedf1 !important;">Sq. Ft</th>-->
                                                <!--    <th style="border-top :1px solid #eaedf1 !important;">Plots</th>-->
                                                <!--    <th style="border-top :1px solid #eaedf1 !important;">Sq. Ft</th>-->
                                                <!--    <th style="border-top :1px solid #eaedf1 !important;">Plots</th>-->
                                                <!--    <th style="border-top :1px solid #eaedf1 !important;">Sq. Ft</th>-->
                                                <!--</tr>-->
                                                   <tr>
                                                    <th>S.No</th>
                                                    <th>Project Name</th>
                                                    <th>Start Date</th>
                                                    <th>Days</th>
                                                    <th>Booking <br>First</th>
                                                    <th>Booking<br> Last</th>
                                                    <th>Booked</th>
                                                    <th>Fully <br>Paid</th>
                                                    <th>Registered</th>
                                                    <th>Vacant</th>
                                                    <!--<th>Reg. Pending</th>-->
                                                    <th>Total<br> Plots</th>
                                                    <th>Booked <br>Sq.ft</th>
                                                     <th>Fully Paid<br> Sq.ft</th>
                                                     <th>Reg. <br>Sq.ft</th>
                                                     <th>Vacant <br> Sq.ft</th>
                                                    <th>Total<br> Sq.ft</th>
                                                </tr>
                                        </thead>
                                        <tbody id="project_abstract_body" class="border">
                                            <?php
                                            $sno = 1;
                                           
                                            $no_of_plots = 0;
                                            $booking_plots = 0;
                                            $fuly_paid_plots = 0;
                                            $registered_plots = 0;
                                            $registered_pending_plots = 0;
                                            $vacant_plots = 0;
                                            $vacant_sqft = 0;
                                            $total_sqft = 0;
                                            $booking_total_sqft = 0;
                                            $fully_paid_sqft = 0;
                                            $total_fully_paid_plots =0;
                                            $reg_pending_total_sqft =0;
                                            
                                            $booking_plot_count = 0;
                                            $fully_paid_plot_count = 0;
                                            $registered_plot_count = 0;
                                            $reg_pending_plot_count = 0;
                                            $vacant_plot_count = 0;
                                            $vacant_plot_sqft_count = 0;
                                            $total_plots_count = 0;
                                            $total_plot_sqft_count = 0;
                                            $total_booking_plot_sqft_count = 0;
                                            $register_total_sqft = 0;
                                            $register_total_sqft_count = 0;
                                            $fully_paid_total_sqft_count = 0;
                                            
                                            ?>
                                            @if (isset($reports))
                                                @foreach ($reports as $report)
                                                    <?php
                                                    
                                                        $project_id = $report->id;
                                                        $project = \App\Models\ProjectDetail::where('id', $project_id)->first();
                                                        $site = '';
                                                        $start_date = '';
                                                        $project_start_total_days = '';
                                            
                                                        if (isset($project)) {
                                                            $site = $project->short_name;
                                                            $start_date = date('d-m-Y',strtotime($project->project_start_date));
                                                            $project_start_days = $project->project_start_date;
                                                        }
                                                 
                                                        $current_date = new DateTime(date('Y-m-d'));
                                                        $project_start_date = new DateTime($project_start_days);
                                            
                                                        $interval = $current_date->diff($project_start_date);
                                                        $project_start_total_days = $interval->days;
                                                        
                                                        
                                                        $booking_open = \App\Models\Booking::where('project_id', $project_id)->orderBy('id', 'asc')->first();
                                                        $book_open_date = '';
                                                        if (isset($booking_open)) {
                                                            $book_open_date =  date('d-m-Y', strtotime($booking_open->receipt_date));
                                                        }
                                                        $booking_last = \App\Models\Booking::where('project_id', $project_id)->orderBy('id', 'desc')->first();
                                                        $booking_last_date = '';
                                                        if (isset($booking_last)) {
                                                            $booking_last_date =  date('d-m-Y', strtotime($booking_last->receipt_date));
                                                        }
                                                    
                                                      $booking_plots = \App\Models\Booking::whereNull('booking_status') // booking plots
                                                        ->whereNull('fully_paid_status')
                                                        ->whereNull('confirm_status')
                                                        ->whereNull('register_status')
                                                        ->where('project_id', $project_id)
                                                        ->get()
                                                        ->count();
                                                    
                                                    $fuly_paid_plots = \App\Models\Booking::where('project_id', $project_id) // fully paid plots
                                                        ->whereNull('booking_status')
                                                        ->whereNotNull('fully_paid_status')
                                                        ->whereNull('confirm_status')
                                                        ->whereNull('register_status')
                                                        ->get()
                                                        ->count();
                                                     $registered_pending_plots = \App\Models\Booking::whereNotNull('fully_paid_status') // registered pending plots
                                                        ->whereNotNull('confirm_status')
                                                        ->whereNull('register_status')
                                                        ->where('project_id', $project_id)
                                                         ->whereNull('booking_status')
                                                        ->get()
                                                        ->count();
                                                        
                                                     $total_fully_paid_plots =  $fuly_paid_plots + $registered_pending_plots;
                                                     
                                                     
                                                    $registered_plots = \App\Models\Booking::whereNotNull('register_status') // registered plots
                                                        ->where('project_id', $project_id)
                                                        ->get()
                                                        ->count();

                                                    
                                                    $no_of_plots = \App\Models\PlotManagement::where('project_id', $project_id)
                                                        ->where('deleted_at', '=', 0)
                                                        ->get()
                                                        ->count();
                                                        
                                                     $total_plot_sqft = \App\Models\PlotManagement::where('project_id', $report->id)
                                                        ->where('deleted_at', 0)
                                                        ->select(DB::raw('SUM(plot_sq_ft) as plot_sqft_sum'))
                                                        ->first();
                                                    if (isset($total_plot_sqft)) {
                                                        $total_sqft = $total_plot_sqft->plot_sqft_sum;
                                                    }
                                                    
                                                    
                                                    $booking_plots_sqft_total = \Illuminate\Support\Facades\DB::table('booking')->whereNull('booking_status')->whereNull('fully_paid_status')->whereNull('confirm_status') // booking plots sqft
                                                        ->whereNull('register_status')->leftJoin('plot_management', 'booking.plot_id', '=', 'plot_management.id')
                                                        ->where('booking.project_id', $project_id)->select(DB::raw('SUM(plot_management.plot_sq_ft) as booking_total_sqft'))->first();
                                                    if (isset($booking_plots_sqft_total)) {
                                                        $booking_total_sqft = $booking_plots_sqft_total->booking_total_sqft;
                                                    }
                                                    
                                                    
                                                    $register_total_plots =  \Illuminate\Support\Facades\DB::table('booking')->leftJoin('plot_management', 'booking.plot_id', '=', 'plot_management.id')
                                                        ->where('booking.project_id', $project_id)->whereNull('booking.booking_status')->where('booking.fully_paid_status', 1)
                                                        ->whereNotNull('booking.confirm_status')->whereNotNull('booking.register_status')
                                                        ->select(DB::raw('SUM(plot_management.plot_sq_ft) as register_total_sqft'))->first();
                                                    if (isset($register_total_plots)) {
                                                        $register_total_sqft = $register_total_plots->register_total_sqft;
                                                    }
                                                                                            
                                                    
                                                    $fully_paid_plots = DB::table('booking')->whereNull('booking_status')->where('fully_paid_status', 1)
                                                    ->whereNull('register_status')->whereNull('confirm_status')
                                                    ->leftJoin('plot_management', 'booking.plot_id', '=', 'plot_management.id')
                                                    ->where('booking.project_id', $project_id)->select(DB::raw('SUM(plot_management.plot_sq_ft) as booking_total_sqft'))
                                                    ->first();
                                                    if (isset($fully_paid_plots)) {
                                                        $fully_paid_total_sqft = $fully_paid_plots->booking_total_sqft;
                                                    }
                                                    
                                                    $register_pending_plots = DB::table('booking')->whereNull('booking_status')->where('fully_paid_status', 1)
                                                    ->whereNull('register_status')->whereNotNull('confirm_status')
                                                    ->leftJoin('plot_management', 'booking.plot_id', '=', 'plot_management.id')
                                                    ->where('booking.project_id', $project_id)->select(DB::raw('SUM(plot_management.plot_sq_ft) as booking_total_sqft'))
                                                    ->first();
                                                    if (isset($fully_paid_plots)) {
                                                        $reg_pending_total_sqft = $register_pending_plots->booking_total_sqft;
                                                    }
                                                             
                                                    $total_fully_paid_plot_sqft =   $fully_paid_total_sqft +  $reg_pending_total_sqft;  
                                                    
                                                    $total_booking = \App\Models\Booking::where('project_id', $report->id)
                                                        ->whereNull('booking_status')
                                                        ->get()
                                                        ->count();
                                                    $vacant_plots = $no_of_plots - $total_booking;
                                                    
                                                    
                                                    $total_booking_sqft_get = \App\Models\Booking::leftjoin('plot_management', 'plot_management.id', 'booking.plot_id')
                                                        ->where('booking.project_id', $project_id)
                                                        ->whereNull('booking_status')
                                                        ->select(DB::raw('SUM(plot_sq_ft) as plot_sqft_sum'))
                                                        ->first();
                                                    if (isset($total_booking_sqft_get)) {
                                                        $filled_sqft = $total_booking_sqft_get->plot_sqft_sum;
                                                    }
                                                    
                                                    $vacant_sqft = $total_sqft - $filled_sqft;
                                                    
                                                    // footer count
                                                    $booking_plot_count += $booking_plots;
                                                    $fully_paid_plot_count += $fuly_paid_plots;
                                                    $registered_plot_count += $registered_plots;
                                                    $reg_pending_plot_count += $registered_pending_plots;
                                                    $total_plots_count += $no_of_plots;
                                                    $total_plot_sqft_count += $total_sqft;
                                                    $total_booking_plot_sqft_count += $booking_total_sqft;
                                                    $register_total_sqft_count += $register_total_sqft;
                                                    $fully_paid_total_sqft_count += $total_fully_paid_plot_sqft;
                                                    $vacant_plot_count += $vacant_plots;
                                                    $vacant_plot_sqft_count += $vacant_sqft;
                                                    ?>
                                                    <tr class="border-bottom">
                                                        <td>{{ $sno++ }}</td>
                                                        <td>{{$report->short_name}}</td>
                                                        <td>{{$start_date}}</td>
                                                        <td>{{$project_start_total_days}}</td>
                                                        <td>{{$book_open_date}}</td>
                                                        <td>{{$booking_last_date}}</td>
                                                        <td>{{$booking_plots}}</td>
                                                        <td>{{$total_fully_paid_plots}}</td>
                                                        <td>{{$registered_plots}}</td>
                                                        <td>{{$vacant_plots}}</td>
                                                        <!--<td>{{$registered_pending_plots}}</td>-->
                                                        <td>{{$no_of_plots}}</td>
                                                        <td>{{IND_money_format(round($booking_total_sqft))}}</td>
                                                        <td>{{IND_money_format(round($total_fully_paid_plot_sqft))}}</td>
                                                        <td>{{IND_money_format(round($register_total_sqft))}}</td>
                                                        <td>{{IND_money_format(round($vacant_sqft)) }}</td>
                                                        <td>{{IND_money_format(round($total_sqft))}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                              
                                                <td>
                                                    <h5 class="fw-bold text-end text-danger">Total :</h5>
                                                </td>
                                                <td colspan="">
                                                    <h5 class="fw-bold text-success">
                                                        {{ $booking_plot_count }}</h5>
                                                </td>
                                                <td>
                                                    <h5 class="fw-bold text-success">
                                                        {{ $fully_paid_plot_count }}
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5 class="fw-bold text-success">
                                                        {{ $registered_plot_count }}
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5 class="fw-bold text-success">
                                                        {{ $vacant_plot_count }}
                                                    </h5>
                                                </td>
                                                <!--<td>-->
                                                <!--    <h5 class="fw-bold text-success">-->
                                                <!--        {{ $reg_pending_plot_count }}-->
                                                <!--    </h5>-->
                                                <!--</td>-->
                                                <td>
                                                    <h5 class="fw-bold text-success">
                                                        {{ $total_plots_count }}
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5 class="fw-bold text-success">
                                                        {{ IND_money_format(round($total_booking_plot_sqft_count)) }}
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5 class="fw-bold text-success">
                                                        {{ IND_money_format(round($fully_paid_total_sqft_count)) }}
                                                    </h5>
                                                </td>
                                                 <td>
                                                    <h5 class="fw-bold text-success">
                                                        {{ IND_money_format(round($register_total_sqft_count)) }}
                                                    </h5>
                                                </td>
                                                 <td>
                                                    <h5 class="fw-bold text-success">
                                                        {{ IND_money_format(round($vacant_plot_sqft_count)) }}
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5 class="fw-bold text-success">
                                                        {{ IND_money_format(round($total_plot_sqft_count)) }}
                                                    </h5>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
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
        $(document).ready(function() {
        //     expense_lists();
                    var table = $('#project_abstract_detail_lists').DataTable({
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
           "iDisplayLength" : 100,
            buttons:[ "excel","pdf"],
            buttons: [
              {
                extend: 'excelHtml5',
                footer: true,
              },
              {
                extend: 'pdfHtml5',
                footer: true,
                 orientation:'landscape',
                  pageSize: 'LEGAL',
              },
             ]
            
            
        }).buttons().container().appendTo("#project_abstract_detail_lists_wrapper .col-md-6:eq(0)");
        
        });
        
         function project_summary_sumbit() {
            $("#project_summary_Form").submit();
        }
        
        
        
        
        // function select2_list() {
        //     $(document).ready(function() {
        //         $(".reg_expense_select").select2();
        //     });
        // }

        function project_summary() {
            var project_id = $("#get_project_id").val();
            var url = "{{ url('/') }}/get_project_summary";
            if (project_id != "") {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        project_id: project_id
                    },
                    success: function(res) {
                        if (res.status == true) {
                            if (res.html != '') {
                                $("#project_summary_body").html(res.html);
                                $("#booking_plots_count").text(res.book_plots);
                                $("#fullypaid_plots_count").text(res.fully_paid_count);
                                $("#register_plots_count").text(res.register_plots);
                                $("#reg_pending_count").text(res.register_pending_count);
                                $("#total_plots").text(res.total_plots);
                                $("#total_plot_sqft").text(res.total_sqft);
                                $("#booking_plots").text(res.book_plots);
                                $("#booking_total_sqft").text(res.booking_total_sqft);
                                $("#register_plots").text(res.register_plots);
                                $("#register_total_sqft").text(res.register_total_sqft);
                                $("#vacant_plots").text(res.vacant_plots);
                                $("#vacant_total_sqft").text(res.vacant_total_sqft);
                                $("#fully_paid_plots").text(res.fully_paid_plots);
                                $("#fully_paid_total_sqft").text(res.fully_paid_total_sqft);
                            } else {
                                $("#project_summary_body").html(
                                    '<tr> <td colspan="16" style="text-align:center">No DataFound</td> </tr>'
                                );
                                $("#booking_plots_count").text(0);
                                $("#fullypaid_plots_count").text(0);
                                $("#register_plots_count").text(0);
                                $("#reg_pending_count").text(0);
                                $("#total_plots").text(0);
                                $("#total_plot_sqft").text(0);
                                $("#booking_plots").text(0);
                                $("#booking_total_sqft").text(0);
                                $("#register_plots").text(0);
                                $("#register_total_sqft").text(0);
                                $("#vacant_plots").text(0);
                                $("#vacant_total_sqft").text(0);
                                $("#fully_paid_plots").text(0);
                                $("#fully_paid_total_sqft").text(0);
                            }
                        }
                    }
                });
            } else {
                $("#project_summary_body").html(
                    '<tr> <td colspan="16" style="text-align:center">No DataFound</td> </tr>'
                );
                $("#total_plots").text(0);
                $("#total_plot_sqft").text(0);
                $("#booking_plots").text(0);
                $("#booking_total_sqft").text(0);
                $("#register_plots").text(0);
                $("#register_total_sqft").text(0);
                $("#vacant_plots").text(0);
                $("#vacant_total_sqft").text(0);
                $("#fully_paid_plots").text(0);
                $("#fully_paid_total_sqft").text(0);
            }
        }
    </script>
@endsection
