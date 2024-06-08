<table   width='100%' style="font-size:16px "  cellspacing='1'  >
        <tr>
          <th style="text-align:center;font-size:18px !important;text-transform: uppercase;">
               <h4> Plot Booking and Registered Details</h4>
            </th>
        </tr>
    </table>
<?php


            $plots = '';
            $project_id =  $project_id;
            
            $plot_id =  $plot_id;
            $projects = \App\Models\ProjectDetail::all();
            // $marketer = User::where('user_type','!=','staff')->where('user_type','!=','admin')->where('user_type','!=','gl_admin')->get();
            $marketer = \App\Models\User::where('user_type', '!=', 'staff')->where('user_type', '!=', 'admin')->where('user_type','!=','gl_admin');
            if ($team != "" && isset($team)) {
                $marketer->whereIn('team_name', $team);
            }
            $marketer = $marketer->get();
            
            if(isset($project_id) && !empty($project_id))
            {
            $plots = \App\Models\PlotManagement::whereIn('project_id',$project_id)->where('deleted_at',0)->get();    
            }
            
            $team_name = \App\Models\User::where('user_type','!=','staff')->where('user_type','!=','admin')->where('user_type','!=','gl_admin')->groupby('team_name')->get();
            
            $from_date =  $from_date;
            $to_date =  $to_date;
            if($from_date == '')
            {
            $from_date = date('Y-m-d');
            }
            if($to_date == '')
            {
             $to_date = date('Y-m-d');
            }
            
            $marketer_id = $marketer_id;
            $status      = $status;
            $team_id     = $team;
         
          $payments = \App\Models\Booking::leftjoin('project_details','project_details.id','booking.project_id')
                       ->leftjoin('plot_management','plot_management.id','booking.plot_id')
                       ->leftjoin('users','users.id','booking.marketer_id')
                       ->whereBetween('booking.receipt_date',[$from_date,$to_date])
                       ->select('booking.*','plot_management.plot_no','plot_management.plot_sq_ft','project_details.short_name','users.team_name');
        
                   
        if(isset($marketer_id) && !empty($marketer_id))
         
        {
            $payments = $payments->whereIn('booking.marketer_id',$marketer_id);
        }
        
        
        if(isset($team_id) && !empty($team_id))
        
        {
            $payments = $payments->whereIn('users.team_name',$team_id);
        }
        
        if($status == 1 && !empty($status))
        
        {
            $payments = $payments->whereNull('booking.fully_paid_status')->whereNull('booking.booking_status');
        }
        
         if($status == 2 && !empty($status))
        
        {
            $payments = $payments->where('fully_paid_status',1)->whereNull('register_status');
        }
        
         if($status == 3 && !empty($status))
        
        {
            $payments = $payments->where('fully_paid_status',1)->whereNotNull('register_status');
        }
        
         if($status == 4 && !empty($status))
        
        {
            $payments = $payments->where('booking_status',1);
        }
                       
        if(isset($project_id) && !empty($project_id))
        
        {
            $payments = $payments->whereIn('booking.project_id',$project_id);
        }
        
         $query = $payments->orderby('booking.id','asc')->get();
         
         
         $total_plots = 0;
                            $total_sqft = 0;
                            $booking_count_query = \App\Models\Booking::leftjoin('users','users.id','booking.marketer_id')
                                                  ->whereNull('booking.booking_status')
                                                  ->whereNull('fully_paid_status')->whereNull('booking_status')
                                                 ->whereBetween('receipt_date',[$from_date,$to_date]);
                                                 
         
                             
                            $booking_sum_query   = \App\Models\Booking::leftjoin('users','users.id','booking.marketer_id')
                                                 ->leftjoin('plot_management','plot_management.id','booking.plot_id')
                                                 ->whereNull('fully_paid_status')->whereNull('booking_status')
                                                 ->whereNull('booking.booking_status')
                                                 ->whereBetween('receipt_date',[$from_date,$to_date])
                                                ->select(DB::raw('SUM(plot_management.plot_sq_ft) as plot_sqft_sum'));
                                              
                                                 
                            $fully_paid_count_query = \App\Models\Booking::leftjoin('users','users.id','booking.marketer_id')
                                                  ->where('fully_paid_status',1)->whereNull('register_status')
                                                  ->whereNull('booking.booking_status')
                                                 ->whereBetween('receipt_date',[$from_date,$to_date]);
                            $fully_paid_sum_query   = \App\Models\Booking::leftjoin('plot_management','plot_management.id','booking.plot_id')
                                                 ->leftjoin('users','users.id','booking.marketer_id')
                                                 ->where('fully_paid_status',1)->whereNull('register_status')
                                                 ->whereNull('booking.booking_status')
                                                 ->whereBetween('receipt_date',[$from_date,$to_date])
                                                ->select(DB::raw('SUM(plot_management.plot_sq_ft) as plot_sqft_sum'));
                            
                             
                             
                            $registered_count_query = \App\Models\Booking::leftjoin('users','users.id','booking.marketer_id')->where('fully_paid_status',1)
                                                 ->whereNotNull('register_status')->whereNull('booking_status')
                                                 ->whereBetween('receipt_date',[$from_date,$to_date]);
                            $registered_sum_query   = \App\Models\Booking::leftjoin('plot_management','plot_management.id','booking.plot_id')
                                                   ->leftjoin('users','users.id','booking.marketer_id')
                                                 ->where('fully_paid_status',1)->whereNotNull('register_status')->whereNull('booking.booking_status')
                                                 ->whereBetween('receipt_date',[$from_date,$to_date])
                                                ->select(DB::raw('SUM(plot_management.plot_sq_ft) as plot_sqft_sum'));
                            
                            
                            
                            $cancelled_count_query = \App\Models\Booking::leftjoin('users','users.id','booking.marketer_id')->where('booking_status',1)
                                               ->whereBetween('receipt_date',[$from_date,$to_date]);
                            $cancelled_sum_query   = \App\Models\Booking::leftjoin('plot_management','plot_management.id','booking.plot_id')
                                                 ->leftjoin('users','users.id','booking.marketer_id')
                                                 ->where('booking_status',1)->whereBetween('receipt_date',[$from_date,$to_date])
                                                ->select(DB::raw('SUM(plot_management.plot_sq_ft) as plot_sqft_sum'));
                            
                             
                            
                             
                             
         if(isset($marketer_id) && !empty($marketer_id))
        
        {
            $booking_count_query = $booking_count_query->whereIn('booking.marketer_id',$marketer_id);
            $booking_sum_query = $booking_sum_query->whereIn('booking.marketer_id',$marketer_id);
            $fully_paid_count_query = $fully_paid_count_query->whereIn('booking.marketer_id',$marketer_id);
            $fully_paid_sum_query = $fully_paid_sum_query->whereIn('booking.marketer_id',$marketer_id);
            $registered_count_query = $registered_count_query->whereIn('booking.marketer_id',$marketer_id);
            $registered_sum_query = $registered_sum_query->whereIn('booking.marketer_id',$marketer_id);
            $cancelled_count_query = $cancelled_count_query->whereIn('booking.marketer_id',$marketer_id);
            $cancelled_sum_query = $cancelled_sum_query->whereIn('booking.marketer_id',$marketer_id);
        }
        
        
        if(isset($team_id) && !empty($team_id))
        
        {
            $booking_count_query = $booking_count_query->whereIn('users.team_name',$team_id);
            $booking_sum_query = $booking_sum_query->whereIn('users.team_name',$team_id);
            $fully_paid_count_query = $fully_paid_count_query->whereIn('users.team_name',$team_id);
            $fully_paid_sum_query = $fully_paid_sum_query->whereIn('users.team_name',$team_id);
            $registered_count_query = $registered_count_query->whereIn('users.team_name',$team_id);
            $registered_sum_query = $registered_sum_query->whereIn('users.team_name',$team_id);
            $cancelled_count_query = $cancelled_count_query->whereIn('users.team_name',$team_id);
            $cancelled_sum_query = $cancelled_sum_query->whereIn('users.team_name',$team_id);
        }
        
        if($status == 1 && !empty($status))
        
        {
            $booking_count_query = $booking_count_query->whereNull('booking.fully_paid_status');
            $booking_sum_query = $booking_sum_query->whereNull('booking.fully_paid_status');
            $fully_paid_count_query = $fully_paid_count_query->whereNull('booking.fully_paid_status');
            $fully_paid_sum_query = $fully_paid_sum_query->whereNull('booking.fully_paid_status');
            $registered_count_query = $registered_count_query->whereNull('booking.fully_paid_status');
            $registered_sum_query = $registered_sum_query->whereNull('booking.fully_paid_status');
            $cancelled_count_query = $cancelled_count_query->whereNull('booking.fully_paid_status');
            $cancelled_sum_query = $cancelled_sum_query->whereNull('booking.fully_paid_status');
        }
        
         if($status == 2 && !empty($status))
        
        {
            $booking_count_query = $booking_count_query->where('fully_paid_status',1)->whereNull('register_status');
            $booking_sum_query = $booking_sum_query->where('fully_paid_status',1)->whereNull('register_status');
            $fully_paid_count_query = $fully_paid_count_query->where('fully_paid_status',1)->whereNull('register_status');
            $fully_paid_sum_query = $fully_paid_sum_query->where('fully_paid_status',1)->whereNull('register_status');
            $registered_count_query = $registered_count_query->where('fully_paid_status',1)->whereNull('register_status');
            $registered_sum_query = $registered_sum_query->where('fully_paid_status',1)->whereNull('register_status');
            $cancelled_count_query = $cancelled_count_query->where('fully_paid_status',1)->whereNull('register_status');
            $cancelled_sum_query = $cancelled_sum_query->where('fully_paid_status',1)->whereNull('register_status');
        }
        
         if($status == 3 && !empty($status))
        
        {
            $booking_count_query = $booking_count_query->where('fully_paid_status',1)->whereNotNull('register_status');
            $booking_sum_query = $booking_sum_query->where('fully_paid_status',1)->whereNotNull('register_status');
            $fully_paid_count_query = $fully_paid_count_query->where('fully_paid_status',1)->whereNotNull('register_status');
            $fully_paid_sum_query = $fully_paid_sum_query->where('fully_paid_status',1)->whereNotNull('register_status');
            $registered_count_query = $registered_count_query->where('fully_paid_status',1)->whereNotNull('register_status');
            $registered_sum_query = $registered_sum_query->where('fully_paid_status',1)->whereNotNull('register_status');
            $cancelled_count_query = $cancelled_count_query->where('fully_paid_status',1)->whereNotNull('register_status');
            $cancelled_sum_query = $cancelled_sum_query->where('fully_paid_status',1)->whereNotNull('register_status');
        }
        
         if($status == 4 && !empty($status))
        
        {
            $booking_count_query = $booking_count_query->where('booking_status',1);
            $booking_sum_query = $booking_sum_query->where('booking_status',1);
            $fully_paid_count_query = $fully_paid_count_query->where('booking_status',1);
            $fully_paid_sum_query = $fully_paid_sum_query->where('booking_status',1);
            $registered_count_query = $registered_count_query->where('booking_status',1);
            $registered_sum_query = $registered_sum_query->where('booking_status',1);
            $cancelled_count_query = $cancelled_count_query->where('booking_status',1);
            $cancelled_sum_query = $cancelled_sum_query->where('booking_status',1);
        }
                       
        if(isset($project_id) && !empty($project_id))
        
        {
            $booking_count_query = $booking_count_query->whereIn('booking.project_id',$project_id);
            $booking_sum_query = $booking_sum_query->whereIn('booking.project_id',$project_id);
            $fully_paid_count_query = $fully_paid_count_query->whereIn('booking.project_id',$project_id);
            $fully_paid_sum_query = $fully_paid_sum_query->whereIn('booking.project_id',$project_id);
            $registered_count_query = $registered_count_query->whereIn('booking.project_id',$project_id);
            $registered_sum_query = $registered_sum_query->whereIn('booking.project_id',$project_id);
            $cancelled_count_query = $cancelled_count_query->whereIn('booking.project_id',$project_id);
            $cancelled_sum_query = $cancelled_sum_query->whereIn('booking.project_id',$project_id);
        }
        
         $booking_count = $booking_count_query->orderby('booking.id','asc')->get()->count();
         $booking_sum = $booking_sum_query->first();
         $fully_paid_count = $fully_paid_count_query->orderby('booking.id','asc')->get()->count();
         $fully_paid_sum = $fully_paid_sum_query->first();
         $registered_count = $registered_count_query->orderby('booking.id','asc')->get()->count();
         $registered_sum = $registered_sum_query->first();
         $cancelled_count = $cancelled_count_query->orderby('booking.id','asc')->get()->count();
         $cancelled_sum = $cancelled_sum_query->first();
         
                             
                             
                              $booking_sqft = $booking_sum->plot_sqft_sum;
                             if($booking_sqft == '')
                             {
                                 $booking_sqft = 0;
                             }
                              $fully_paid_sqft = $fully_paid_sum->plot_sqft_sum;
                             if($fully_paid_sqft == '')
                             {
                                 $fully_paid_sqft = 0;
                             }
                              $registered_sqft = $registered_sum->plot_sqft_sum;
                             if($registered_sqft == '')
                             {
                                 $registered_sqft = 0;
                             }
                              $cancelled_sqft = $cancelled_sum->plot_sqft_sum;
                             if($cancelled_sqft == '')
                             {
                                 $cancelled_sqft = 0;
                             }
                             
                             $total_plots = $booking_count + $fully_paid_count + $registered_count + $cancelled_count;
                             $total_sqft = $booking_sqft + $fully_paid_sqft + $registered_sqft + $cancelled_sqft;
         
                             
    ?>
    
      <table class="custom-table border-bottom-0" width='100%' border='1' bordercolor="black" style="border-collapse: collapse;  ">
      <thead>
       <tr>
             <th class="bg-transparent border-bottom-0">S.no</th>
                                    <th class="bg-transparent border-bottom-0">From Date</th>
                                    <th class="bg-transparent border-bottom-0">To Date</th>
                                    <th class="bg-transparent border-bottom-0">Team</th>
                                    <th class="bg-transparent border-bottom-0">Marketer</th>
                                    <th class="bg-transparent border-bottom-0">Project Name</th>
                                    <th class="bg-transparent border-bottom-0">Plot No</th>
                                    <th class="bg-transparent border-bottom-0">Plot Sq.Ft</th>
                                    <th class="bg-transparent border-bottom-0">Status</th>
                                                                </tr>
               </thead>
               <tbody>
              
        @php $i = 1; @endphp
                                 @if(isset($query) && !empty($query))
                                 <?php
                                 $marketer_name = '';
                                 $fully_paid_status = '';
                                 $status = 'Booked';
                                 ?>
                                @foreach ($query as $books)
                                <?php
                                $get_marketer = \App\Models\User::where('id',$books->marketer_id)->first();
                                if(isset($get_marketer))
                                {
                                    $marketer_name = $get_marketer->name;
                                }
                                
                               
                                if($books->fully_paid_status == 1 && !isset($books->register_status)  && !isset($books->booking_status) )
                                {
                                    $status = "Fully Paid";
                                }
                                
                                 else if($books->register_status == 1 && !isset($books->booking_status))
                                {
                                    $status = "Registered";
                                }
                                  
                                 else if($books->booking_status == 1)
                                {
                                    $status = "Cancelled";
                                }else{
                                     $status = "Booked";
                                }
                                
                                 
                                 
                                 
                                
                                ?>
                                    <tr class="border-bottom">
                                        <td class="text-muted fs-12 fw-semibold text-center"> {{ $i++ }} </td>
                                        <td>
                                            {{ date('d-m-Y',strtotime($from_date)) }}
                                        </td>
                                         <td>
                                            {{ date('d-m-Y',strtotime($to_date)) }}
                                        </td>
                                         <td>
                                            {{ $books->team_name }}
                                        </td>
                                         <td>
                                            {{ $marketer_name }}
                                        </td>
                                        <td>
                                            {{ $books->short_name }}
                                        </td>
                                        
                                        <td>
                                            {{ $books->plot_no }}
                                        </td>
                                        <td>
                                            {{ $books->plot_sq_ft }}
                                        </td>
                                         <td>
                                            {{ $status }}
                                        </td>
                                      
                                        
                                    </tr>
                                    @endforeach
                                    @else
                                    
                                    @endif
                                    <!--<tr>-->
                                    <!--    <td colspan="9">NO Data Found</td>-->
                                    <!--</tr>-->
                                    
                                         
               </tbody>
               <tfoot>
                   
             
                                    <tr class="text-end">
                                                <td colspan="5">
                                                 </td>
                                                  <td style="text-align:center !important"><h6 class="text-end fw-bold text-danger">Plots Booked </h6></td>
                                                 <td style="text-align:center !important"> <span class="text-success"> {{ $booking_count }} </span></td>
                                                  <td style="text-align:center !important"> <h6 class="text-end fw-bold text-danger">Sq.Ft Booked  </h6> </td>
                                                  <td style="text-align:center !important"> <span class="text-success"> {{ $booking_sqft }} </span></td>
                                                 
                                            </tr>
                                            <tr class="text-end">
                                                 <td colspan="5">
                                                 </td>
                                                 <td style="text-align:center !important"><h6 class="text-end fw-bold text-danger">Plots Fully Paid  </h6></td>
                                                 <td style="text-align:center !important"><span class="text-success"> {{ $fully_paid_count }} </span></td>
                                                  <td style="text-align:center !important"> <h6 class="text-end fw-bold text-danger">Sq.Ft Fully Paid  </h6> </td>
                                                  <td style="text-align:center !important"> <span class="text-success"> {{ $fully_paid_sqft }} </span></td>
                                            </tr>
                                            <tr class="text-end">
                                                 <td colspan="5">
                                                 </td>
                                                 <td style="text-align:center !important"> <h6 class="text-end fw-bold text-danger">Plots Registered  </h6></td>
                                                 <td style="text-align:center !important"><span class="text-success"> {{ $registered_count }} </span></td>
                                                  <td style="text-align:center !important"> <h6 class="text-end fw-bold text-danger">Sq.Ft Registered  </h6>   </td>
                                                  <td style="text-align:center !important"> <span class="text-success"> {{ $registered_sqft }} </span></td>
                                            </tr>
                                            <tr class="text-end">
                                                 <td colspan="5">
                                                 </td>
                                                 <td style="text-align:center !important"><h6 class="text-end fw-bold text-danger">Plots Cancelled  </h6></td>
                                                 <td style="text-align:center !important"><span class="text-success"> {{ $cancelled_count }} </span></td>
                                                  <td style="text-align:center !important"> <h6 class="text-end fw-bold text-danger">Sq.Ft Cancelled  </h6>  </td>
                                                  <td style="text-align:center !important"> <span class="text-success">{{ $cancelled_sqft }} </span></td>
                                            </tr>
                                            <tr class="text-end">
                                                 <td colspan="5">
                                                 </td>
                                                 <td style="text-align:center !important"><h6 class="text-end fw-bold text-danger">Total No.of Plots  </h6></td>
                                                 <td style="text-align:center !important"><span class="text-success"> {{ $total_plots }} </span></td>
                                                  <td style="text-align:center !important"><h6 class="text-end fw-bold text-danger">Total No.of Sq.Ft  </h6>  </td>
                                                  <td style="text-align:center !important"><span class="text-success"> {{ $total_sqft }} </span></td>
                                            </tr>
                                            
                                              </tfoot>
     </table>