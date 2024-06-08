@extends('layouts.app')
@section('content')
    <!-- PAGE-HEADER -->
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card ">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Project Abstract</h3>
                </div>
<?php
$team_id = Request::input('team');
$project_id=Request::input('get_project_id');
 
 
?>
                <div class="card-body">
                    <form id="Project_abstract_Form" action="{{ url('project_abstract') }}" method="GET">
                        <div class="container">
                            <div class="row mt-2">
                                <div class="col-12">
                                    <h4 class="fw-bold mt-1" style="color: #6259ca; text-align:center;">Project Details
                                    </h4>
                                </div>
                            </div>
                            <div class="row border border-light-subtle" style="border-radius:5px;">
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label">Project Name <span class="text-red">*</span></label>
                                    <select name="get_project_id[]" id="get_project_id"  class="form-control SlectBox" style="height:40px !important" multiple>
                                        <option value="">Select Project</option>
                                        @if (isset($projects))
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}"
                                                   @if(isset($project_id)) @if(in_array($project->id,$project_id)) {{ "selected" }} @endif @endif>
                                                    {{ $project->short_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span id="project_name_validation" class="text-danger" style="display:none;">Project
                                        Field is Required</span>
                                </div>
                                
                                <div class="col-md-2 mt-3">
                                 <br>
                                <button type="submit" class="btn btn-primary me-2">Search</button>
                               
                            </div>

                                <!--<div class="col-sm-6 col-md-4 mb-2">-->
                                <!--    <label class="form-label" style="color:white;">.</label>-->
                                <!--    <button type="button" class="btn btn-primary"-->
                                <!--        onclick="project_abstract_sumbit()">Search</button>-->
                                <!--</div>-->
                            </div>
                            <div class="row mt-2 border border-light-subtle" style="border-radius:5px;">
                                <div class="table-responsive export-table">
                                    <table id="project_abstract_detail_lists" class="table table-bordered text-nowrap mb-0">
                                        <thead class="border-top">
                                            <tr>
                                                <th>S.No</th>
                                                <th>Project</th>
                                                <th>Branch</th>
                                                <th>No of Plots</th>
                                                <th>Booked</th>
                                                <th>Fully Paid</th>
                                                <th>Registered</th>
                                                <!--<th>Reg. Pending</th>-->
                                                <th>Cancelled</th>
                                                <th>Vacant</th>
                                                <th>Vacant Sq.Ft</th>
                                                <th>Reg. Sq.Ft</th>
                                                <th>Total Sq.ft</th>
                                                <th>Stock Value</th>
                                                <th>Sold value</th>
                                                <th>Cancalled value</th>
                                                <th>total value</th>
                                            </tr>
                                        </thead>
                                        <tbody id="project_abstract_body" class="border">
                                            <?php
                                            $sno = 1;
                                            $branch_name = '';
                                            $no_of_plots = 0;
                                            $booking_plots = 0;
                                            $fuly_paid_plots = 0;
                                            $total_fully_paid_plots = 0;
                                            $registered_plots = 0;
                                            $cancelled_plots = 0;
                                            $cancelled_plot_sqft = 0;
                                            $registered_pending_plots = 0;
                                            $vacant_plots = 0;
                                            $total_vacant_plots = 0;
                                            $vacant_sqft = 0;
                                            $total_vacant_sqft = 0;
                                            $registered_plots_sqft= 0;
                                            
                                            $booking_plot_count = 0;
                                            $fully_paid_plot_count = 0;
                                            $total_fully_paid_plot_count = 0;
                                            $registered_plot_count = 0;
                                            $cancelled_plot_count = 0;
                                            $reg_pending_plot_count = 0;
                                            $vacant_plot_count = 0;
                                            $vacant_plot_sqft_count = 0;
                                            $total_plot_sqft_count = 0;
                                            $registered_plots_sqft_count= 0;
                                            $cancelled_plot_sqft_count = 0;
                                            
                                            $stock_value = 0;
                                            $total_stock_value = 0;
                                            $stock_value_count = 0;
                                            $sold_value_count = 0;
                                            $total_value = 0;
                                            $cancalled_value = 0;
                                            $total_cancel_value = 0;
                                            $total_value_count = 0;
                                            $total_no_of_plots = 0;
                                            ?>
                                            @if (isset($reports))
                                                @foreach ($reports as $report)
                                                    <?php
                                                    
                                                    $branch = \App\Models\Branch::find($report->branch_id);
                                                    $branch_name = $branch ? $branch->branch_name : '';
                                                    
                                                    $no_of_plots = \App\Models\PlotManagement::where('project_id', $report->id)
                                                        ->where('deleted_at', '=', 0)
                                                        ->get()
                                                        ->count();
                                                    $booking_plots = \App\Models\Booking::whereNull('booking_status')
                                                        ->whereNull('fully_paid_status')
                                                        ->whereNull('confirm_status')
                                                        ->whereNull('register_status')
                                                        ->where('project_id', $report->id)
                                                        ->get()
                                                        ->count();
                                                    
                                                    $fuly_paid_plots = \App\Models\Booking::where('project_id', $report->id)
                                                        ->whereNotNull('fully_paid_status')
                                                        ->whereNull('booking_status')
                                                        ->whereNull('confirm_status')
                                                        ->whereNull('register_status')
                                                        ->get()
                                                        ->count();
                                                    $registered_plots = \App\Models\Booking::whereNotNull('register_status')
                                                        ->whereNull('booking_status')
                                                        ->where('project_id', $report->id)
                                                        ->get()
                                                        ->count();
                                                   $registered_plots_sqft =  \App\Models\Booking::join('plot_management', 'plot_management.id', '=', 'booking.plot_id')
                                                            ->where('booking.project_id', $report->id)
                                                            ->whereNull('booking.booking_status')
                                                            ->where('booking.confirm_status', 1)
                                                            ->where('booking.register_status', 1)
                                                            ->sum('plot_management.plot_sq_ft');
                                                    $cancelled_plots = \App\Models\Booking::whereNotNull('booking_status')
                                                        // ->whereNull('register_status')
                                                        // -> whereNull('booking_status')
                                                        ->where('project_id', $report->id)
                                                        ->get()
                                                        ->count();
                                                    $registered_pending_plots = \App\Models\Booking::whereNotNull('fully_paid_status')
                                                        ->whereNotNull('confirm_status')
                                                        ->whereNull('register_status')
                                                        -> whereNull('booking_status')
                                                        ->where('project_id', $report->id)
                                                        ->get()
                                                        ->count();
                                                    $total_fully_paid_plots = $fuly_paid_plots + $registered_pending_plots; // total fully paid plots
                                                    
                                                    $total_booking = \App\Models\Booking::where('project_id', $report->id)
                                                        ->whereNull('booking_status')
                                                        ->get()
                                                        ->count();
                                                    $vacant_plots = $no_of_plots - $total_booking;
                                                    $total_vacant_plots = $vacant_plots;
                                                    
                                                    $total_plot_sqft = \App\Models\PlotManagement::where('project_id', $report->id)
                                                        ->where('deleted_at', 0)
                                                        ->select(DB::raw('SUM(plot_sq_ft) as plot_sqft_sum'))
                                                        ->first();
                                                    if (isset($total_plot_sqft)) {
                                                        $total_sqft = $total_plot_sqft->plot_sqft_sum;
                                                    }
                                                    
                                                    $total_booking_sqft_get = \App\Models\Booking::leftjoin('plot_management', 'plot_management.id', 'booking.plot_id')
                                                        ->where('booking.project_id', $report->id)
                                                        ->whereNull('booking_status')
                                                        ->select(DB::raw('SUM(plot_sq_ft) as plot_sqft_sum'))
                                                        ->first();
                                                    if (isset($total_booking_sqft_get)) {
                                                        $filled_sqft = $total_booking_sqft_get->plot_sqft_sum;
                                                    }
                                                    
                                                    
                                                    
                                                    $cancelled_plot_sqft =  \App\Models\Booking::join('plot_management', 'plot_management.id', '=', 'booking.plot_id')
                                                            ->where('booking.project_id', $report->id)
                                                            ->whereNotNull('booking.booking_status')
                                                            // ->where('booking.confirm_status', 1)
                                                            // ->where('booking.register_status', 1)
                                                            ->select(DB::raw('sum(plot_management.plot_sq_ft) as cancelled_plot_sqft'))->first();
                                                    $vacant_sqft = $total_sqft - $filled_sqft;    
                                                    $total_vacant_sqft = $vacant_sqft;
                                                    
                                                    // footer count
                                                    $booking_plot_count += $booking_plots;
                                                    $fully_paid_plot_count += $fuly_paid_plots;
                                                    $total_fully_paid_plot_count += $total_fully_paid_plots;
                                                    $registered_plot_count += $registered_plots;
                                                    $cancelled_plot_count += $cancelled_plots;
                                                    $reg_pending_plot_count += $registered_pending_plots;
                                                    $vacant_plot_count += $total_vacant_plots;
                                                    $vacant_plot_sqft_count += $total_vacant_sqft;
                                                    $total_plot_sqft_count += $total_sqft;
                                                    $registered_plots_sqft_count += $registered_plots_sqft;
                                                    $cancelled_plot_sqft_count += $cancelled_plot_sqft->cancelled_plot_sqft;
                                                    
                                                    
                                                    $stock_value = $vacant_sqft * $report->market_value; //get stock value
                                                   
                                                    
                                                    // $booking_val_sqft = DB::table('plot_management')
                                                    //                     ->join('booking', 'booking.plot_id', '=', 'plot_management.id')
                                                    //                     ->whereNull('booking.booking_status')
                                                    //                     ->where('plot_management.project_id', $report->id)
                                                    //                     ->select(DB::raw('SUM(plot_sq_ft) as booking_value'))
                                                    //                     ->first();
                                                                        
                                                    $booking_val_sqft = DB::table('part_payment')
                                                                         ->leftjoin('booking', 'booking.plot_id', '=', 'part_payment.plot_id')
                                                                         ->whereNull('booking.booking_status')
                                                                        ->where('part_payment.project_id', $report->id)
                                                                        ->select(DB::raw('SUM(part_payment.amount) as booking_value'),
                                                                        DB::raw('SUM(part_payment.discount) as discount_amt'))
                                                                        ->first();
                                                                        
                                                    // $booking_fully_paid_plot = \App\Models\Booking::where('project_id', $report->id)
                                                    //     ->whereNotNull('fully_paid_status')
                                                    //     ->whereNull('booking_status')
                                                    //     ->first();
                                                    
                                                    $booking_total_sold_val =  $booking_val_sqft->booking_value ; // sold value
                                                    $sold_value_count += $booking_total_sold_val;
                                                    
                                                    
                                                    $cancalled_value = $cancelled_plot_sqft->cancelled_plot_sqft * $report->market_value; // cancelled value
                                                    $total_cancel_value += $cancalled_value;
                                                    $total_stock_value = $stock_value;
                                                    $stock_value_count += $total_stock_value;
                                                    $total_value =  $stock_value_count + $booking_total_sold_val ;
                                                    $total_value_count += $total_value;
                                                    
                                                    $total_no_of_plots = $total_no_of_plots + $no_of_plots;
                                                    ?>
                                                    <tr class="border-bottom">
                                                        <td>{{ $sno++ }}</td>
                                                        <td>{{ $report->short_name }}</td>
                                                        <td>{{ $branch_name }}</td>
                                                        <td>{{ $no_of_plots }}</td>
                                                        <td>{{ $booking_plots }}</td>
                                                        <td>{{ $total_fully_paid_plots }}</td>
                                                        <td>{{ $registered_plots }}</td>
                                                        <td>{{ $cancelled_plots }}</td>
                                                        <td>{{ $total_vacant_plots }}</td>
                                                        <td>{{ IND_money_format(round($total_vacant_sqft)) }}</td>
                                                        <td>{{ IND_money_format(round($registered_plots_sqft)) }}</td>
                                                        <td>{{ IND_money_format(round($total_sqft)) }}</td>
                                                        <td>{{ IND_money_format(round($total_stock_value)) }}</td>
                                                        <td>{{ IND_money_format(round($booking_total_sold_val)) }}</td>
                                                        <td>{{IND_money_format(round($cancalled_value))}}</td>
                                                        <td>{{ IND_money_format(round($total_value)) }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td style="text-align:right !important;"><h5 class="fw-bold text-end text-danger">Total </h5></td>
                                                <td></td>
                                                <td >
                                                   <h5 class="fw-bold text-success">
                                                        {{ $total_no_of_plots }}</h5> 
                                                </td>
                                                <td colspan="">
                                                    <h5 class="fw-bold text-success">
                                                        {{ $booking_plot_count }}</h5>
                                                </td>
                                                <td>
                                                    <h5 class="fw-bold text-success">
                                                        {{ $total_fully_paid_plot_count }}
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5 class="fw-bold text-success">
                                                        {{ $registered_plot_count }}
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5 class="fw-bold text-success">
                                                        {{ $cancelled_plot_count }}
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5 class="fw-bold text-success">
                                                        {{ $vacant_plot_count }}
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5 class="fw-bold text-success">
                                                        {{ IND_money_format(round($vacant_plot_sqft_count)) }}
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5 class="fw-bold text-success">
                                                        {{ IND_money_format(round($registered_plots_sqft_count)) }}
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5 class="fw-bold text-success">
                                                        {{ IND_money_format(round($total_plot_sqft_count)) }}
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5 class="fw-bold text-success">
                                                        {{ IND_money_format(round($stock_value_count)) }}
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5 class="fw-bold text-success">
                                                        {{ IND_money_format(round($sold_value_count)) }}
                                                    </h5>
                                                </td>
                                                 <td>
                                                    <h5 class="fw-bold text-success">
                                                        {{ IND_money_format(round($total_cancel_value)) }}
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5 class="fw-bold text-success">
                                                        {{ IND_money_format(round($total_value_count)) }}
                                                    </h5>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div><!-- COL END -->
    </div><!-- ROW-5 END -->
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#project_abstract_detail_lists').DataTable({
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
           "iDisplayLength" : 100,
    // buttons:[ "excel","pdf"],
    buttons: [
      {
        extend: 'excelHtml5',
        footer: true,
      },
      {
        extend: 'pdfHtml5',
        footer: true,
         orientation:'landscape',
      },
     ]
    
}).buttons().container().appendTo("#project_abstract_detail_lists_wrapper .col-md-6:eq(0)");
          });
        
      
        
        function project_abstract_sumbit() {
            $("#Project_abstract_Form").submit();
        }
    </script>
@endsection
