  
 <div>
     
  <table   width='100%' style="font-size:16px "  cellspacing='1'  >
        <tr>
          <th style="text-align:center;font-size:18px !important;text-transform: uppercase;">
              <h4>  Project wise Sales List</h4>
            </th>
        </tr>
    </table>
    <br>
        <!--<table   width='100%'    style="font-size:13px !important;" border='1' bordercolor='transparent'>-->
            <table class="custom-table border-bottom-0" width='100%' cellspacing='1' style="font-size:13px !important;text-transform: uppercase;" border='1' bordercolor='transparent'>
                                     <thead>
                                  <tr>
                                            <th  rowspan="3">S.No</th>
                                            <th  rowspan="3">Project Name</th>
                                            <th colspan="4" style="text-align:center;">Booking</th>
                                            <th colspan="4" style="text-align:center;">Registered</th>
                                             
                                            <th colspan="2" style="text-align:center;">Total</th>
                                        </tr>
                                         <tr>
                                             
                                            <th colspan="2" style="text-align:center;">Cash</th>
                                            <th colspan="2" style="text-align:center;">Bank</th>
                                            <th colspan="2" style="text-align:center;">Cash</th>
                                            <th colspan="2" style="text-align:center;">Bank</th>
                                            <th rowspan="2" style="text-align:center;">Count</th>
                                            <th rowspan="2" style="text-align:center;">Amount</th>
                                        </tr>
                                       <tr>
                                             
                                            <th style="text-align:center;">Count</th>
                                            <th style="text-align:center;">Amount</th>
                                            <th style="text-align:center;">Count</th>
                                            <th style="text-align:center;">Amount</th>
                                            <th style="text-align:center;">Count</th>
                                            <th style="text-align:center;">Amount</th>
                                            <th style="text-align:center;">Count</th>
                                            <th style="text-align:center;">Amount</th>
                                        </tr> 
                                        </thead>
                                      
                                        <tbody  class="border">
                                        @php
                                       $i = 1;
                                       $booking_cash_amt = 0;
                                       $booking_bank_amt = 0;
                                       $total_count = 0;
                                       $total_amount = 0;
                                       $total_booking_cash_count = 0;
                                       $total_booking_cash_amount = 0;
                                       $total_booking_bank_count = 0;
                                       $total_booking_bank_amount = 0;
                                       $total_register_cash_count = 0;
                                       $total_register_cash_amount = 0;
                                       $total_register_bank_count = 0;
                                       $total_register_bank_amount = 0;
                                       $overall_total_count = 0;
                                       $overall_total_amount = 0;
                                       @endphp
                                        @if(isset($bookings))
                                        @foreach($bookings as $books)
                                        
                                        <?php
                                        
                                        $get_booking_cash_count = \App\Models\Payment::leftjoin('booking','part_payment.plot_id','booking.plot_id')
                                                                    ->whereNull('booking.confirm_status')
                                                                    ->where('part_payment.pay_mode',1)
                                                                    ->whereNull('booking.register_status')
                                                                    ->whereNull('booking.booking_status')->where('part_payment.project_id',$books->project_id)->get()->count();
                                                                    
                                        
                                        $get_booking_cash_amount = \App\Models\Payment::leftjoin('booking','part_payment.plot_id','booking.plot_id')
                                                                    ->whereNull('booking.confirm_status')
                                                                    ->where('part_payment.pay_mode',1)
                                                                    ->whereNull('booking.register_status')
                                                                    ->whereNull('booking.booking_status')->where('part_payment.project_id',$books->project_id)
                                                                    ->select(DB::raw('SUM(part_payment.amount) as cash_amount'))->first();
                                        if($get_booking_cash_amount)
                                        {
                                            $booking_cash_amt = $get_booking_cash_amount->cash_amount;
                                        }
                                        
                                        if($booking_cash_amt)
                                        {
                                            $booking_cash_amt = $booking_cash_amt;
                                        }else{
                                            $booking_cash_amt = 0;
                                        }
                                                                    
                                        
                                         $get_booking_bank_count = \App\Models\Payment::leftjoin('booking','part_payment.plot_id','booking.plot_id')
                                                                    ->whereNull('booking.confirm_status')
                                                                    ->where('part_payment.pay_mode','!=',1)
                                                                    ->whereNull('booking.register_status')
                                                                    ->whereNull('booking.booking_status')->where('part_payment.project_id',$books->project_id)->get()->count();
                                        $get_booking_bank_amount = \App\Models\Payment::leftjoin('booking','part_payment.plot_id','booking.plot_id')
                                                                    ->whereNull('booking.confirm_status')
                                                                    ->where('part_payment.pay_mode','!=',1)
                                                                    ->whereNull('booking.register_status')
                                                                    ->whereNull('booking.booking_status')->where('part_payment.project_id',$books->project_id)
                                                                    ->select(DB::raw('SUM(part_payment.amount) as bank_amount'))->first();
                                        if($get_booking_bank_amount)
                                        {
                                            $booking_bank_amt = $get_booking_bank_amount->bank_amount;
                                        }
                                        
                                        if($booking_bank_amt)
                                        {
                                            $booking_bank_amt = $booking_bank_amt;
                                        }else{
                                            $booking_bank_amt = 0;
                                        }
                                        
                                        
                                        $get_register_cash_count = \App\Models\Payment::leftjoin('booking','part_payment.plot_id','booking.plot_id')
                                                                     ->where('part_payment.pay_mode',1)
                                                                    ->whereNotNull('booking.register_status')
                                                                    ->whereNull('booking.booking_status')->where('part_payment.project_id',$books->project_id)->get()->count();
                                                                    
                                        
                                        $get_register_cash_amount = \App\Models\Payment::leftjoin('booking','part_payment.plot_id','booking.plot_id')
                                                                    ->where('part_payment.pay_mode',1)
                                                                    ->whereNotNull('booking.register_status')
                                                                    ->whereNull('booking.booking_status')->where('part_payment.project_id',$books->project_id)
                                                                    ->select(DB::raw('SUM(part_payment.amount) as cash_amount'))->first();
                                        if($get_register_cash_amount)
                                        {
                                            $register_cash_amt = $get_register_cash_amount->cash_amount;
                                        }
                                        
                                        if($register_cash_amt)
                                        {
                                            $register_cash_amt = $register_cash_amt;
                                        }else{
                                            $register_cash_amt = 0;
                                        }
                                                                    
                                        
                                         $get_register_bank_count = \App\Models\Payment::leftjoin('booking','part_payment.plot_id','booking.plot_id')
                                                                    ->where('part_payment.pay_mode','!=',1)
                                                                    ->whereNotNull('booking.register_status')
                                                                    ->whereNull('booking.booking_status')->where('part_payment.project_id',$books->project_id)->get()->count();
                                        $get_register_bank_amount = \App\Models\Payment::leftjoin('booking','part_payment.plot_id','booking.plot_id')
                                                                    ->where('part_payment.pay_mode','!=',1)
                                                                    ->whereNotNull('booking.register_status')
                                                                    ->whereNull('booking.booking_status')->where('part_payment.project_id',$books->project_id)
                                                                    ->select(DB::raw('SUM(part_payment.amount) as bank_amount'))->first();
                                        if($get_register_bank_amount)
                                        {
                                            $register_bank_amt = $get_register_bank_amount->bank_amount;
                                        }
                                        
                                        if($register_bank_amt)
                                        {
                                            $register_bank_amt = $register_bank_amt;
                                        }else{
                                            $register_bank_amt = 0;
                                        }
                                          
                                        $total_count = $total_count + $get_booking_cash_count + $get_booking_bank_count + $get_register_cash_count
                                                       + $get_register_bank_count;
                                        
                                        $total_amount = $total_amount + $booking_cash_amt + $booking_bank_amt + $register_cash_amt
                                                       + $register_bank_amt;
                                                       
                                         $total_booking_cash_count += $get_booking_cash_count;
                                         $total_booking_cash_amount += $booking_cash_amt;
                                         $total_booking_bank_count += $get_booking_bank_count;
                                         $total_booking_bank_amount += $booking_bank_amt;
                                         
                                         $total_register_cash_count += $get_register_cash_count;
                                         $total_register_cash_amount += $register_cash_amt;
                                         $total_register_bank_count += $get_register_bank_count;
                                         $total_register_bank_amount += $register_bank_amt;
                                         
                                         $overall_total_count = $total_booking_cash_count + $total_booking_bank_count + $total_register_cash_count + $total_register_bank_count;
                                         $overall_total_amount = $total_booking_cash_amount + $total_booking_bank_amount + $total_register_cash_amount + $total_register_bank_amount;
                                        
                                        ?>
                                        
                                        <tr>
                                                    <td style="text-align:center;"> {{ $i++ }}</td>
                                                     
                                                    <td  style="font-size:14px;text-align:center;">
                                                        {{ $books->short_name }}
                                                    </td>
                                                    <td  style="font-size:14px;text-align:center;">
                                                        {{ $get_booking_cash_count }}
                                                    </td>
                                                    <td  style="font-size:14px;text-align:center;">
                                                        {{ IND_money_format(round($booking_cash_amt)) }}
                                                    </td>
                                                    <td  style="font-size:14px;text-align:center;">
                                                        {{ $get_booking_bank_count }}
                                                    </td>
                                                    <td style="font-size:14px;text-align:center;">
                                                        {{ IND_money_format(round($booking_bank_amt)) }}
                                                    </td>
                                                    <td  style="font-size:14px;text-align:center;">
                                                        {{ $get_register_cash_count }}
                                                    </td>
                                                    <td  style="font-size:14px;text-align:center;">
                                                        {{ IND_money_format(round($register_cash_amt)) }}
                                                    </td>
                                                    <td  style="font-size:14px;text-align:center;">
                                                        {{ $get_register_bank_count }}</td>
                                                    <td  style="font-size:14px;">
                                                        {{ IND_money_format(round($register_bank_amt)) }}</td>
                                                    
                                                    <td  style="font-size:14px;text-align:center;">
                                                        {{ $total_count }}</td>
                                                    <td  style="font-size:14px;text-align:center;">
                                                        {{ IND_money_format(round($total_amount)) }}</td>
                                                </tr>

                                             @endforeach
                                             @endif
                                             <tr style="font-size:14px;font-weight:bold">
                                            
                                            <td class="text-end fw-bold text-danger" colspan="2" style="font-size:14px;font-weight:bold"> Total</td>
                                                     
                                                    <td  style="text-align:center;" >
                                                        {{ $total_booking_cash_count }} 
                                                    </td>
                                                    <td style="text-align:center;">
                                                      {{ IND_money_format(round($total_booking_cash_amount)) }} 
                                                    </td>
                                                    <td style="text-align:center;">
                                                       {{ $total_booking_bank_count }} 
                                                    </td>
                                                    <td style="text-align:center;">
                                                       {{ IND_money_format(round($total_booking_bank_amount)) }} 
                                                    </td>
                                                    <td style="text-align:center;">
                                                       {{ $total_register_cash_count }} 
                                                    </td>
                                                    <td style="text-align:center;">
                                                      {{ IND_money_format(round($total_register_cash_amount)) }} 
                                                    </td>
                                                    <td style="text-align:center;">
                                                       {{ $total_register_bank_count }}</td>
                                                    <td style="text-align:center;">
                                                       {{ IND_money_format(round($total_register_bank_amount)) }}  </td>
                                                    
                                                    <td style="text-align:center;">
                                                       {{ $overall_total_count }}  </td>
                                                    <td style="text-align:center;">
                                                     {{ IND_money_format(round($overall_total_amount)) }} </td>
                                                        
                                            
                                        </tr>
                                              </tbody>
      
       
    </table>
   
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

    
    
