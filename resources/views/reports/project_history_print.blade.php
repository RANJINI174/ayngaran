<table   width='100%' style="font-size:16px "  cellspacing='1'  >
        <tr>
          <th style="text-align:center;font-size:18px !important;text-transform: uppercase;">
               <h4> Project History</h4>
            </th>
        </tr>
    </table>
    
    <?php
    
       $first_booking_date = '';
        $last_booking_date = '';
        $project = \App\Models\ProjectDetail::where('id',$id)->first();
        
        $first_booking = \App\Models\Booking::where('project_id',$id)->orderby('id','asc')->first();
        if(isset($first_booking))
        {
            $first_booking_date = date('d-m-Y',strtotime($first_booking->receipt_date));
        }
        $last_booking = \App\Models\Booking::where('project_id',$id)->orderby('id','desc')->first();
        if(isset($last_booking))
        {
            $last_booking_date = date('d-m-Y',strtotime($last_booking->receipt_date));
        }
         
         
        $project_date = date('d-m-Y',strtotime($project->project_start_date));
        
        
        $startTimeStamp = strtotime($project->project_start_date);
        $endTimeStamp = strtotime(date('Y-m-d'));

           $timeDiff = abs($endTimeStamp - $startTimeStamp);

          $numberDays = $timeDiff/86400;  // 86400 seconds in one day

             $numberDays = intval($numberDays);
 
         
        $plots = \App\Models\PlotManagement::where('project_id',$id)->where('deleted_at',0)->get()->count();
        
        
        $total_booking = \App\Models\Booking::where('project_id',$id)->whereNull('booking_status')->get()->count();
         
        $vacant_plots = $plots - $total_booking;
         
        $booking_count = \App\Models\Booking::whereNull('confirm_status')
                        ->whereNull('register_status')
                        ->whereNull('booking_status')->where('project_id',$id)->get()->count();
        
        $reg_pending_count = \App\Models\Booking::whereNotNull('fully_paid_status')->whereNotNull('confirm_status')
                             ->whereNull('register_status')->where('project_id',$id)->get()->count();
        
        $registered_plots = \App\Models\Booking::whereNotNull('register_status')->where('project_id',$id)->get()->count();
        
        $registered_plots_sqft = \App\Models\Booking::leftjoin('plot_management','plot_management.id','booking.plot_id')
                                ->whereNotNull('register_status')->where('booking.project_id',$id)
                                ->select(DB::raw('SUM(plot_management.plot_sq_ft) as plot_sqft_sum'))->first();
        
        if(isset($registered_plots_sqft))
        {
            $reg_sqft = $registered_plots_sqft->plot_sqft_sum;
        }
        
        $total_plot_sqft = \App\Models\PlotManagement::where('project_id',$id)->where('deleted_at',0)
                        ->select(DB::raw('SUM(plot_sq_ft) as plot_sqft_sum'))->first();
        if(isset($total_plot_sqft))
        {
            $total_sqft = $total_plot_sqft->plot_sqft_sum;
        }
        
        $total_booking_sqft_get = \App\Models\Booking::leftjoin('plot_management','plot_management.id','booking.plot_id')
                                  ->where('booking.project_id',$id)->whereNull('booking_status') 
                                  ->select(DB::raw('SUM(plot_sq_ft) as plot_sqft_sum'))->first();
         if(isset($total_booking_sqft_get))
        {
            $filled_sqft = $total_booking_sqft_get->plot_sqft_sum;
        }
        
        $vacant_sqft = $total_sqft - $filled_sqft;
        
        $booking_sqft_get = \App\Models\Booking::leftjoin('plot_management','plot_management.id','booking.plot_id')
                          ->whereNull('confirm_status')
                         ->whereNull('register_status')
                          ->whereNull('booking_status')->where('booking.project_id',$id)
                         ->select(DB::raw('SUM(plot_sq_ft) as plot_sqft_sum'))->first();
        
        if(isset($booking_sqft_get))
        {
            $booking_sqft = $booking_sqft_get->plot_sqft_sum;
        }
        
        
        $reg_pending_plots = \App\Models\Booking::leftjoin('plot_management','plot_management.id','booking.plot_id')
                              ->whereNotNull('fully_paid_status')->whereNotNull('confirm_status')
                             ->whereNull('register_status')->where('booking.project_id',$id)
                             ->select(DB::raw('SUM(plot_sq_ft) as plot_sqft_sum'))->first();
        if(isset($reg_pending_plots))
        {
            $reg_pending_sqft = $reg_pending_plots->plot_sqft_sum;
        }
        
       
       
    
    ?>
     <table   width='100%'    style="border-right: 1px solid black;border-left: 1px solid black;;border-top: 1px solid black;font-size:14px;padding-top:6px !important;padding-bottom:6px !important;">
         
            <th colspan='2' style="text-align:center;">
                <b>PROJECT DETAILS</b>
            </th>
         
    </table>
    
      <table   width='100%'    style="border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;font-size:13px;padding-top:6px !important;padding-bottom:6px !important;">
         <tr>
         
            <td style="width: 30%;text-transform: uppercase;border-width: 1px !important;font-size:13px !important; ">
                
                    
                    <b style="width: 50%;"> Project Name &nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;{{ $project->short_name }}
                    <br>
                    <b style="width: 50%;"> Total Days  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;{{ $numberDays }}
                     
                 
            </td>

           <td style="width: 39.9%;text-transform: uppercase;border-width: 1px !important;font-size:13px !important; ">
                
                    
                    <b style="width: 50%;"> Full Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;{{ $project->full_name }}
                    <br>
                    <b style="width: 50%;"> First Booking Date &nbsp;&nbsp;: </b> &nbsp;{{$first_booking_date }}
                     
                    
               

            </td>
            <td style="width: 30%;text-transform: uppercase;border-width: 1px !important;font-size:13px !important; ">
                
                    
                     <b style="width: 50%;"> Start Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;{{ $project_date }}
                    <br>
                    <b style="width: 50%;"> Last Booking Date &nbsp;&nbsp;: </b> &nbsp;{{ $last_booking_date }}
                     
             
            </td>

         </tr>
    </table>
    
     <table   width='100%'    style="border-right: 1px solid black;border-left: 1px solid black;;border-top: 1px solid black;font-size:13px;padding-top:6px !important;padding-bottom:6px !important;">
         
            <th colspan='2' style="text-align:center;">
                <b>PLOT DETAILS</b>
            </th>
         
    </table>
    <table   width='100%'    style="border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;font-size:14px;padding-top:6px !important;
    padding-bottom:6px !important;">
             
         <tr>
          <td style="width: 20%;text-transform: uppercase;border-width: 1px !important;font-size:13px !important; ">
                
                    
                    <b style="width: 50%;"> Total Plots &nbsp;&nbsp;: </b> &nbsp;{{ $plots }}
                    <br>
                    <b style="width: 50%;"> Total Sqft  &nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;{{ $total_sqft }}
                    
                    
                 
            </td>
             <td style="width: 20%;text-transform: uppercase;border-width: 1px !important;font-size:13px !important; ">
                
                    
                       <b style="width: 50%;"> Booked Plots &nbsp;&nbsp;: </b> &nbsp;{{ $booking_count }}
                    </br>
                     
                    <b style="width: 50%;"> Booked Sqft &nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;{{ $booking_sqft }}
                    
                 
            </td>
             <td style="width: 20%;text-transform: uppercase;border-width: 1px !important;font-size:13px !important; ">
                
                    
                   <b style="width: 50%;"> Registered  Plots &nbsp;&nbsp;: </b> &nbsp;{{ $registered_plots }}
                    <br>
                    <b style="width: 50%;">Registered Sqft  &nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;{{ $reg_sqft }}
                    
                 
            </td>
             <td style="width: 20%;text-transform: uppercase;border-width: 1px !important;font-size:13px !important; ">
                
               
                    <b style="width: 50%;"> Reg Pending Plots &nbsp;&nbsp;&nbsp;: </b> &nbsp;{{ $reg_pending_count }}
                    <br>
                    <b style="width: 50%;"> Reg Pending Sqft  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;{{ $reg_pending_sqft }}
                    
                 
            </td>
             <td style="width: 20%;text-transform: uppercase;border-width: 1px !important;font-size:13px !important; ">
                
                 
                      <b style="width: 50%;"> Vacant Plots &nbsp;&nbsp;&nbsp;: </b> &nbsp;{{ $vacant_plots }}
                      <br>
                      <b style="width: 50%;"> Vacant Plots &nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;{{ $vacant_sqft }}
                 
            </td>
          

         
        
          
  
         </tr>
    </table>
      <table class="custom-table border-bottom-0" width='100%' border='1' bordercolor="black" style="border-collapse: collapse;  ">
        <tr>
            <th colspan="13" style="width: 100%;text-align:center;font-size:13px !important;padding-top:6px !important;padding-bottom:6px !important;">CUSTOMER DETAILS</th>
        </tr>

       <tr>
                                                                    <th style="text-align:center">S.No</th>
                                                                    <th style="text-align:left" >Customer Name</th>
                                                                    <th style="text-align:center">Booked Date</th>
                                                                    <th style="text-align:center">Marketer <br>ID</th>
                                                                    <th style="text-align:left">Marketer <br>Name</th>
                                                                    <th style="text-align:center">Plot No</th>
                                                                    <th style="text-align:center">Sq Ft</th>
                                                                    <th style="text-align:center">Rate</th>
                                                                    <th style="text-align:center">Total Value</th>
                                                                    <th style="text-align:center">Total Paid</th>
                                                                    <th style="text-align:center">Discount</th>
                                                                    <th style="text-align:center">Balance</th>
                                                                    <!--<th style="text-align:center">Reg.No</th>-->
                                                                    <th style="text-align:center">Reg.Date</th>
                                                                </tr>
                                                                
                                                                <?php
                                                                $bookings =\App\Models\Booking::where('project_id',$id)->whereNull('booking_status')->get();
         $table_data = '';
        if(isset($bookings))
        {
        $plot_rate = 0;
        $total_value = 0;
        $paid_value = 0;
        $discount_value = 0;
        $balance_value = 0;
        $reg_date = '';
            $i =1;
            foreach($bookings as $booking)
            {
                 if(isset($booking->customer_id))
         {
            $customer_id = $booking->customer_id;
           $get_customer_details = \App\Models\Booking::where('id',$booking->customer_id)->first();
           if(isset($get_customer_details))
           {
           $customer_name = $get_customer_details->customer_name;
           $customer_mobile = $get_customer_details->mobile;
           $alternate_mobile = $get_customer_details->alternate_mobile;   
           }
          
        }else{
           $customer_id = $booking->id;
           $customer_name = $booking->customer_name;
           $customer_mobile = $booking->mobile;
           $alternate_mobile = $booking->alternate_mobile;
           
       }
       
       $get_marketer = \App\Models\User::where('id',$booking->marketer_id)->first();  
       if(isset($get_marketer))
       {
           $marketer_name = $get_marketer->name;
           $marketer_id = $get_marketer->reference_code;
       }
       
       $plots_data = \App\Models\PlotManagement::where('project_id',$booking->project_id)
                    ->where('id',$booking->plot_id)->where('deleted_at',0)->first();
                    
       $total_val = \App\Models\Payment::where('project_id',$booking->project_id)->where('plot_id',$booking->plot_id)->select(DB::raw('SUM(amount) as paid_amount'),
       DB::raw('SUM(discount) as discount_amount'))->first();
        
       $balance = \App\Models\Payment::where('project_id',$booking->project_id)->where('plot_id',$booking->plot_id)->select('balance')->orderby('id','desc')->first();
       
       if(isset($booking->register_date))
       {
           $reg_date = date('d-m-Y',strtotime($booking->register_date));
       }else{
           $reg_date = '';
       }
       
       ?>
                            <tr style=" font-size:13px !important">
                             <td style="text-align:center">{{ $i }}</td>
                             <td style="text-align:left">{{$customer_name}}</td>
                             <td style="text-align:center">{{  date('d-m-Y',strtotime($booking->receipt_date)) }}</td>
                             <td style="text-align:center">{{$marketer_id}}</td>
                              <td style="text-align:left">{{$marketer_name}}</td>
                              <td style="text-align:center">{{$plots_data->plot_no}}</td>
                               <td style="text-align:center">{{$plots_data->plot_sq_ft}}</td>
                                <td style="text-align:center">{{ IND_money_format(round($plots_data->market_value_sq_ft)) }}</td>
                              <td style="text-align:center">{{ IND_money_format(round($plots_data->market_value_plot_rate))}}</td>
                              <td style="text-align:center">{{ IND_money_format(round($total_val->paid_amount)) }}</td>
                              <td style="text-align:center">{{ IND_money_format(round($total_val->discount_amount)) }}</td>
                              <td style="text-align:center">{{ IND_money_format(round($balance->balance)) }}</td>
                              <!--<td style="text-align:center">{{$booking->reg_no}}</td>-->
                              <td style="text-align:center">{{ $reg_date }}</td></tr>
       
       <?php
        $plot_rate = $plot_rate + $plots_data->plot_sq_ft;
        $total_value = $total_value + $plots_data->market_value_plot_rate;
        $paid_value = $paid_value + $total_val->paid_amount;
        $discount_value = $discount_value + $total_val->discount_amount;
        $balance_value = $balance_value + $balance->balance;
        
        $i++;
        
            }
        }
        ?>
        <tr>
            <td colspan="5" style="text-align:center"><b>Total</b></td>
            <td>
           <b>{{ IND_money_format(round($plot_rate)) }}</b>
            </td>
            <td></td>
            <td>
           <b>{{ IND_money_format(round($total_value)) }}</b>
            </td>
            <td>
          <b> {{ IND_money_format(round($paid_value)) }}</b>
            </td>
            <td>
           <b>{{ IND_money_format(round($discount_value)) }}</b>
            </td>
        <td>
        <b> {{ IND_money_format(round($balance_value)) }}</b>
        </td>
        <td colspan="1"></td>
        </tr>
     </table>
   