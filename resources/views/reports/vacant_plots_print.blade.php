<div style="margin:2cm 0cm 2cm 0cm">
     
  <table   width='100%'  cellspacing='1'  style="border-right: 1px solid black;border-top: 1px solid black;
  border-left: 1px solid black;padding-top:6px !important;padding-bottom:6px !important;">
        <tr>
            <th style="text-align:center !important;width: 75%;font-size:18px" >
                <b>&nbsp;
                   Vacant Plots Details</b>
            </th>
        </tr>
    </table>
     <table    width='100%'  cellspacing='1'  style="border-right: 1px solid black;border-top: 1px solid black;
  border-left: 1px solid black;padding-top:6px !important;padding-bottom:6px !important;">
         
            <th colspan='2' style="text-align:center;">
                <b>Plot(s) Details</b>
            </th>
         
    </table>
    <?php
           $project = \App\Models\ProjectDetail::where('id', $project_id)->first();
            $project_name = '';
            $start_date = '';

            $project_start_days = '';
            if (isset($project)) {
                $project_name = $project->short_name;
                $start_date = date('d-m-Y', strtotime($project->project_start_date));
                $project_start_days = $project->project_start_date;
            }
            $current_date = new DateTime(date('Y-m-d'));
            $project_start_date = new DateTime($project_start_days);

            $interval = $current_date->diff($project_start_date);
            $project_start_total_days = $interval->days;
            
            $booking_open = \App\Models\Booking::where('project_id',$project_id)->orderBy('id', 'asc')->first();
            $booking_start_date = '';
            if (isset($booking_open)) {
                $booking_start_date =   date('d-m-Y', strtotime($booking_open->receipt_date));
            }
            $booking_last = \App\Models\Booking::where('project_id',$project_id)->orderBy('id', 'desc')->first();
            $booking_last_date = '';
            if (isset($booking_last)) {
                $booking_last_date =  date('d-m-Y', strtotime($booking_last->receipt_date));
            }
            
            $booking_plots = \App\Models\Booking::where('project_id', $project_id)->whereNull('booking_status')->get()->count(); // booking plots
            $booking_plots_sqft = 0;
            $booking_plot_lists = DB::table('booking')->leftJoin('plot_management', 'booking.plot_id', '=', 'plot_management.id')
                ->whereNull('booking.booking_status')->where('booking.project_id', $project_id)->select(DB::raw('SUM(plot_management.plot_sq_ft) as booking_total_sqft'))->first();
            if (isset($booking_plot_lists)) {
                $booking_plots_sqft = $booking_plot_lists->booking_total_sqft;
            }
    
          $total_plots = \App\Models\PlotManagement::where('project_id', $project_id)->where('deleted_at', '=', 0)->get()->count(); 
          $total_booking = \App\Models\Booking::where('project_id', $project_id)->whereNull('booking_status')->get()->count();
          $vacant_plots = $total_plots - $total_booking;
         
        $total_plot_sqfts = 0;
        $total_plots_sqft = 0;
        $total_plot_lists = \App\Models\PlotManagement::where('project_id', $project_id)->where('deleted_at', '=', 0)->select(DB::raw('SUM(plot_sq_ft) as total_plot_sqft'))->first();
        if (isset($total_plot_lists)) {
            $total_plots_sqft = $total_plot_lists->total_plot_sqft;
            $total_plot_sqfts = $total_plot_lists->total_plot_sqft;
        }

        $filled_sqft = 0;
        $total_booking_sqft_get = \App\Models\Booking::leftJoin('plot_management', 'plot_management.id', '=', 'booking.plot_id')
            ->where('booking.project_id', $project_id)
            ->whereNull('booking_status')
            ->select(DB::raw('SUM(plot_sq_ft) as plot_sqft_sum'))
            ->first();

        if ($total_booking_sqft_get) {
            $filled_sqft = $total_booking_sqft_get->plot_sqft_sum;
        }

        $vacant_sqft = $total_plot_sqfts - $filled_sqft;
        $vacant_total_sqft = $vacant_sqft;
    ?>
    <table class="custom-table border-bottom-0" width='100%' cellspacing='1' border='1' bordercolor='transparent' style="padding:3px !important;">
            <td style="width: 34%;text-transform: uppercase;border-width: 1px !important;font-size:13px !important; ">
                
                    <b style="width: 50%;">Project Name   </b> &nbsp;<b>:</b>&nbsp;&nbsp;&nbsp;{{$project_name;}}
                   <br>
               
                    <b style="width: 50%;"> Start Date  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;&nbsp;{{$start_date}}
                <br>
                <b style="width: 50%;"> First Booking  &nbsp;: &nbsp;</b>{{$booking_start_date }}
                  <br>
                <b style="width: 50%;"> Last Booking &nbsp;&nbsp;: &nbsp;&nbsp;</b>{{$booking_last_date}}
            </td>
       
            <td style="width: 33%;text-transform: uppercase;border-width: 1px !important;font-size:13px !important;">
                <b style="width: 50%;">Days Since Start Date</b> &nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$project_start_total_days}}
                   <br>
                    <b>Booked Plots  &nbsp;:</b> &nbsp;&nbsp;&nbsp;&nbsp;{{$booking_plots}}
                 <br>
                
                    <b>Vacant Plots    &nbsp;&nbsp;: </b>  &nbsp;&nbsp;&nbsp;&nbsp;{{$vacant_plots}}
                 <br>
                
                    <b>Total Plots  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;&nbsp;&nbsp;&nbsp;{{$total_plots}}
               

            </td>

             <td style="width: 33%;text-transform: uppercase;border-width: 1px !important;font-size:13px !important;">
                  
                    <b>Booked Sq.Ft.  &nbsp;:</b> &nbsp;&nbsp;&nbsp;&nbsp;{{$booking_plots_sqft}}
                 <br>
                
                    <b>Vacant Sq.Ft.     &nbsp;&nbsp;: </b>  &nbsp;&nbsp;&nbsp;&nbsp;{{ $vacant_total_sqft }}
                 <br>
                
                    <b> Total Sq.Ft.  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;&nbsp;&nbsp;&nbsp;{{$total_plots_sqft}}
               
    
            </td>
    </table>


        <?php
          $get_booked_plots = \App\Models\Booking::where('project_id', $project_id)->whereNull('booking_status')->get();
            $booked_ids = array();
            
            if(isset($get_booked_plots))
            {
                foreach($get_booked_plots as $book_plots)
                {
                    array_push($booked_ids,$book_plots->plot_id);
                }
            }
            $vacant_plot_nos = \App\Models\PlotManagement::where('project_id',$project_id)->where('deleted_at', 0)
                              ->WhereNotIn('id',$booked_ids)->get();
            $html = '';
            $sno = 1;
            $total_vacant_plots = 0;
           
         ?>
<BR><BR>
        <table class="custom-table border-bottom-0" width='100%' cellspacing='1' style="font-size:13px !important;" border='1' bordercolor='transparent'>
            <tr>
                <th colspan="4" style="width: 100%;text-align:center;font-size:14px !important;padding-top:6px !important;padding-bottom:6px !important; background-color: red !important;">Vacant Plots</th>
            </tr>
            <tr>
                <th style="background-color: red;">SNO</th>
                <th>PLOT NO</th>
                <th>SQ.FT</th>
                <th>DIRECTION</th>
            </tr>
            <?php
            if (isset($vacant_plot_nos)) {
                foreach ($vacant_plot_nos as $val) {
                    $direction = \App\Models\Direction::where('id', $val->direction_id)->first();
                    $total_vacant_plots += $val->plot_sq_ft;
                    echo '<tr>
                            <td>'.$sno++.'</td>
                            <td>'.$val->plot_no.'</td>
                            <td>'.$val->plot_sq_ft.'</td>
                            <td>'.$direction->direction_name.'</td>
                          </tr>';
                }
            }
            ?>
            <tr>
                <td colspan="2" style="text-align:end;"><b>Total :</b></td>
                <td colspan="2"><b>{{$total_vacant_plots}}</b></td>
            </tr>
        </table>

    <!--<table class="custom-table border-bottom-0" width='100%' cellspacing='1' border='1' bordercolor='transparent'>-->

    <!--    <tr>-->
    <!--        <td style="width: 50%;text-align:left;">-->
    <!--            <br><br><br>-->
    <!--            Customer Signature-->
    <!--        </td>-->
    <!--        <td style="width: 50%;text-align:right;">-->
    <!--            <br><br><br>-->
    <!--            Authorized Signature-->
    <!--        </td>-->

    <!--    </tr>-->
    <!--</table>-->

</div>
<style>
    /* .right {
        text-align: right;
    }

    .center {
        text-align: center;
    }

    td {
        padding: 5px;
    }

    .col-sm-12 {
        border: 0px solid green !important;
    } */
    .custom-table {
        border: 1px solid black;
        border-collapse: collapse;
        width: 100%;
    }

    .custom-table th,
    .custom-table td {
        border: 1px solid black;
        padding: 5px;
        text-align: start;
    }
</style>