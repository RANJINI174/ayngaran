 
<?php
$project_id = $project_id;
        $plot_id = $plot_id;
 
        $customer_name = '';
        $gender = '';
        $mobile = '';
        $alternate_mobile = '';
        $customer_address = '';
         $project = \App\Models\ProjectDetail::where('id', $project_id)->first();
        if (!empty($project_id) && !empty($plot_id)) {

            //customer details
            $booking = \App\Models\Booking::where('project_id', $project_id)->where('plot_id', $plot_id)->first();

            if (isset($booking->customer_id)) {
                $get_customer_details =  \App\Models\Booking::where('id', $booking->customer_id)->first();
                if (isset($get_customer_details)) {
                    $customer_name = $get_customer_details->customer_name;
                    $mobile = $get_customer_details->mobile;
                    $alternate_mobile = $get_customer_details->alternate_mobile;
                    $customer_address = $get_customer_details->street;
                    if ($get_customer_details->gender == 1) {
                        $gender = 'Male';
                    } else if ($get_customer_details->gender == 0) {
                        $gender = 'Female';
                    }
                }
            } else {
                $customer_name = $booking->customer_name;
                $gender = $booking->gender;
                $mobile = $booking->mobile;
                $alternate_mobile = $booking->alternate_mobile;
                $customer_address = $booking->street;
                if ($booking->gender == 1) {
                    $gender = 'Male';
                } else if ($booking->gender == 0) {
                    $gender = 'Female';
                }
            }

            //plot details
            $plot =  \Illuminate\Support\Facades\DB::table('plot_management')
                ->where('project_id', $project_id)->where('id', $plot_id)->where('deleted_at', '=', 0)->first();

            $plot_no = '';
            $total_plot_sqft = '';
            $cent_value = '';
            $sqft_rate = '';
            $plot_value = '';
            if (isset($plot)) {
                $plot_no = $plot->plot_no;
                $total_plot_sqft = $plot->plot_sq_ft;

                $cent = $total_plot_sqft / 435.56;
                $cent_value = number_format($cent,2);
                $sqft_rate = IND_money_format(round($plot->market_value_sq_ft));
                $plot_value = IND_money_format(round($plot->market_value_plot_rate));
            }
            // marketer details
            $marketer_name = '';
            $marketer_id = '';
            $marketer_mobile = '';
            $html = '';
            if (isset($booking->marketer_id)) {
                $markter = \App\Models\User::where('id', $booking->marketer_id)->first();
                if($markter->user_type != 'director')
                {
                if (isset($markter)) {
                    $marketer_id = $markter->reference_code;
                    $marketer_name = $markter->name;
                    $marketer_mobile = $markter->mobile_no;
                } else {
                    $marketer_id = $booking->marketer_code;
                    $marketer_name = $booking->marketer_name;
                    $marketer_mobile = $booking->marketer_mobile;
                }
                if (isset($markter->director_id)) {
                    $director = \App\Models\User::where('id', $markter->director_id)->first();
                    $html .= '<tr><td style="font-size:13px;text-align:center;">#</td><td style="font-size:13px;text-align:center;">' . $director->user_type . '</td><td style="font-size:13px;text-align:center;">' . $director->reference_code . '</td>
                    <td style="font-size:13px;text-align:center;">' . $director->name . '</td><td style="font-size:13px;text-align:center;">'
                        . $director->mobile_no . '</td></tr>';
                }
                if (isset($markter->marketing_manager_id)) {
                    $manager = \App\Models\User::where('id', $markter->marketing_manager_id)->first();
                    $html .= '<tr><td style="font-size:13px;text-align:center;">#</td><td style="font-size:13px;text-align:center;">' . $manager->user_type . '</td><td style="font-size:13px;text-align:center;">' . $manager->reference_code . '</td>
                    <td style="font-size:13px;text-align:center;">' . $manager->name . '</td><td style="font-size:13px;text-align:center;">'
                        . $manager->mobile_no . '</td></tr>';
                }
                if (isset($markter->marketing_supervisor_id)) {
                    $supervisor = \App\Models\User::where('id', $markter->marketing_supervisor_id)->first();
                    $html .= '<tr><td style="font-size:13px;text-align:center;">#</td><td style="font-size:13px;text-align:center;">' . $supervisor->user_type . '</td><td style="font-size:13px;text-align:center;">' . $supervisor->reference_code . '</td>
                    <td style="font-size:13px;text-align:center;">' . $supervisor->name . '</td><td style="font-size:13px;text-align:center;">'
                        . $supervisor->mobile_no . '</td></tr>';
                }
                if (isset($markter->marketing_executive_id)) {
                    $executive = \App\Models\User::where('id', $markter->marketing_executive_id)->first();
                    $html .= '<tr><td style="font-size:13px;text-align:center;">#</td><td style="font-size:13px;text-align:center;">' . $executive->user_type . '</td><td style="font-size:13px;text-align:center;">' . $executive->reference_code . '</td>
                    <td style="font-size:13px;text-align:center;">' . $executive->name . '</td><td>'
                        . $executive->mobile_no . '</td></tr>';
                }
                }else{
                    $get_director = \App\Models\User::where('id', $markter->id)->first();
                    $html .= '<tr><td style="font-size:13px;text-align:center;">#</td><td style="font-size:13px;text-align:center;">' . $get_director->user_type . '</td>
                    <td style="font-size:13px;text-align:center;">' . $get_director->reference_code . '</td>
                    <td style="font-size:13px;text-align:center;">' . $get_director->name . '</td><td>'
                        . $get_director->mobile_no . '</td></tr>';
                        
                    $marketer_id = $get_director->reference_code;
                    $marketer_name = $get_director->name;
                    $marketer_mobile = $get_director->mobile_no;
                }
            }

            // registration details
            $reg_no = '';
            $reg_date = '';
            $doc_collected_by = '';
            $reg_mobile = '';
            $doc_collected_date = '';
            $doc_collected_mobile = '';
            $reg_count = \App\Models\Booking::where('project_id', $project_id)->where('plot_id', $plot_id)->whereNotnull('register_status')->get()->count();
            if (isset($booking)) {
                $reg_no = $booking->reg_no;
                if(isset($booking->register_date))
                {
                 $reg_date = date('d-m-Y',strtotime($booking->register_date));   
                }else{
                 $reg_date = '';
                }
                
                $doc_collected_date = date('d-m-Y',strtotime( $booking->doc_collected_date));
                if(isset($booking->doc_collected_date))
                {
                 $doc_collected_date = date('d-m-Y',strtotime($booking->register_date));   
                }else{
                 $doc_collected_date = '';
                }
                $doc_collected = \App\Models\User::where('id', $booking->doc_collected_by)->first();
                if (isset($doc_collected)) {
                    $doc_collected_by = $doc_collected->name;
                    $doc_collected_mobile = $doc_collected->mobile_no;
                }
            }
            $get_customer_doc_list = '';
            $customer_doc_list = \App\Models\Booking::where('project_id', $project_id)->where('plot_id', $plot_id)
                ->whereNotnull('doc_issue_status')->whereNotnull('legal_issue_status')->get()->count();
            if($customer_doc_list == 1){
                $get_customer_doc_list = 'Document Issued To Customer';
            }else{
                $get_customer_doc_list = 'Document Not Issued To Customer';
            }

            // payment details
            $payment_details = '';
            $pay_mode = '';
            $type = '';
            $narration = '';
            $total_amt = 0;
            $sno = 1;
            $total_discount_amt = 0;
            $grant_total_amt = 0;
            $total_paid_amt = 0;
            $payments = \App\Models\Payment::where('project_id', $project_id)->where('plot_id', $plot_id)->get();

            // if (isset($payments)) {
            //     foreach ($payments as $val) {
            //         if ($val->pay_mode == 1) {
            //             $pay_mode = 'Cash';
            //         }
            //         if ($val->pay_mode == 2) {
            //             $pay_mode = 'Cheque';
            //         }
            //         if ($val->pay_mode == 3) {
            //             $pay_mode = 'DD';
            //         }
            //         if ($val->pay_mode == 4) {
            //             $pay_mode = 'Online Transfer';
            //         }
            //         if ($val->pay_mode == 5) {
            //             $pay_mode = 'Cash Deposite';
            //         }

            //         if ($val->account_type == 1) {
            //             $type = 'Part Payment';
            //         } else {
            //             $type = 'Advance';
            //         }

            //         if (isset($val->narration)) {
            //             $narration = $val->narration;
            //         } else {
            //             if ($val->pay_mode != 1) {
            //                 if (isset($val->bank_name)) {
            //                     $bank = \App\Models\Bank::where('id', $val->bank_name)->first();
            //                     $narration = $bank->bank_name;
            //                 } else {
            //                     $narration = $val->narration;
            //                 }
            //             } else {
            //                 $narration = $val->narration;
            //             }
            //         }



            //         // $total_amt = $val->amount - $val->discount;
            //         $total_amt =  $val->discount + $val->amount;
            //         $total_paid_amt += $val->amount;
            //         $total_discount_amt += $val->discount;
                    
            //         $payment_details .= '<tr>
            //          <td>' . $sno++ . '</td>
            //         <td>' . date('d-m-Y', strtotime($val->receipt_date)) . '</td>
            //         <td>' . $val->receipt_no . '</td>
            //         <td>' . $type . '</td>
            //         <td>' . $pay_mode . '</td>
            //         <td>' . $narration . '</td>
            //         <td>' . IND_money_format(round($val->amount)) . '</td>
            //         <td>' . IND_money_format(round($val->discount)) . '</td>
            //         <td colspan="2">' . IND_money_format(round($total_amt)) . '</td>
            //         </tr>';
                    
            //         $grant_total_amt += $total_amt;
                    
            //     }
            // }

            $start_payment = \App\Models\Payment::where('project_id', $project_id)->where('plot_id', $plot_id)->orderBy('receipt_date', 'asc')->first();
            $end_payment = \App\Models\Payment::where('project_id', $project_id)->where('plot_id', $plot_id)->orderBy('receipt_date', 'desc')->first();
            $datetime1 = new DateTime($start_payment->receipt_date);
            $datetime2 = new DateTime($end_payment->receipt_date);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');
            $balance_amt = 0;
            $balance = \App\Models\Payment::where('project_id', $project_id)->where('plot_id', $plot_id)->orderBy('id', 'desc')->first();
            if (isset($end_payment)) {
                $balance_amt =  IND_money_format(round($balance->balance));
            }
            
      

?>







 <div >
     <h3 style="text-align:center;">PLOT HISTORY</h3>
  <table   width='100%'  cellspacing='1'  style="border-right: 1px solid black;border-top: 1px solid black;
  border-left: 1px solid black;padding-top:6px !important;padding-bottom:6px !important;">
        <tr>
            <th style="text-align:center !important;width: 75%;font-size:14px" >
                <b>PROJECT NAME : {{!empty($project->short_name) ? $project->short_name :'' }}</b>
            </th>
        </tr>
    </table>

    <table class="custom-table border-bottom-0" width='100%' cellspacing='1' border='1' bordercolor='transparent'>
          <tr >
            <th style="width: 50%;text-align:center;border-right: 1px solid black;border-bottom: 1px solid black;font-size:14px;
            padding-top:6px !important;padding-bottom:6px !important;">CUSTOMER DETAILS</th>
            <th style="width: 50%;text-align:center;border-bottom: 1px solid black;font-size:14px;
            padding-top:6px !important;padding-bottom:6px !important;">PLOT DETAILS</th>
        </tr>
            <td style="width: 50%;text-transform: uppercase;border-width: 1px !important;font-size:13px !important; ">
                
                    <b style="width: 50%;font-size:13px">Name </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;&nbsp;{{$customer_name}}
                   <br>
               
                    <b style="width: 50%;font-size:13px"> S/O-W/O &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;&nbsp;{{$gender}}
                    <br>
                 <b>Mobile  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;{{$mobile}}
                <br>
                
                    <b>Alternate<br> Mobile  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b>  &nbsp;&nbsp;{{$alternate_mobile}}
                 <br>
                
                    <b> Address  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;&nbsp; {{$customer_address}}
            </td>

            <td style="width: 50%;text-transform: uppercase;border-width: 1px !important;font-size:13px !important;">
                
                <b style="width: 50%;">Plot No. </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;&nbsp;{{$plot_no}}
                   <br>
               
                    <b style="width: 50%;"> Plot Sq.ft &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp; {{$total_plot_sqft}}
                    <br>
                 <b>Cent  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;{{$cent_value}}
                <br>
                
                    <b>Sq.ft Rate &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b>  &nbsp;&nbsp;{{$sqft_rate}}
                 <br>
                
                    <b> Plot Value  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;&nbsp;{{$plot_value}}

            </td>

         
    </table>

    <table class="custom-table border-bottom-0" width='100%' cellspacing='1' 
    style="font-size:13px !important; border-bottom: 0px solid black;border-top: 1px solid white;" border='1' bordercolor='transparent'>
        <tr>
            <th colspan="5" style="width: 100%;text-align:center;font-size:14px !important;padding-top:6px !important;padding-bottom:6px !important;">MARKETER DETAILS</th>
        </tr>
    </table>
     <table class="custom-table border-bottom-0" width='100%' cellspacing='1' 
     style="font-size:13px !important; border-bottom: 0px solid black;border-top: 1px solid white;" border='1' bordercolor='transparent'>
          <tr>
            <td colspan="" style="border:none !important;font-size:13px">
             <b> ID</b> &nbsp;
             &nbsp;&nbsp;&nbsp;<b>:</b> &nbsp;&nbsp;&nbsp;&nbsp;{{$marketer_id}}
            </td>
            <td style="border:none !important;font-size:13px"><b> &nbsp;Name &nbsp;&nbsp; :
            &nbsp;&nbsp;&nbsp;</b>&nbsp;&nbsp;&nbsp;&nbsp;{{$marketer_name}}</td>
            <td  style="border:none !important;font-size:13px"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
            &nbsp; Mobile :</b>&nbsp;&nbsp;&nbsp;&nbsp;{{$marketer_mobile}}</td>
          </tr>
          
   </table>
     <table class="custom-table border-bottom-0" width='100%' cellspacing='1' 
     style="font-size:13px !important; border-bottom: 0px solid black;border-top: 1px solid white;" border='1' bordercolor='transparent'>
        <tr>
            <th style="font-size:13px;text-align:center;" width="5%">#</th>
            <th style="font-size:13px;text-align:center;" width="23.5%">Designation</th>
            <th style="font-size:13px;text-align:center;" width="23.5%">Marketer ID</th>
            <th style="font-size:13px;text-align:center;" width="23.5%">Name</th>
            <th style="font-size:13px;text-align:center;" width="23.5%">Mobile</th>
        </tr>

       <?php echo $html; ?>
    </table>
    
    <table class="custom-table border-bottom-0" width='100%' cellspacing='1' style="font-size:13px !important;border-top: 1px solid white;
    border-bottom: 1px solid white;" border='1' bordercolor='transparent'>
        <tr>
            <th colspan="5" style="width: 100%;text-align:center;font-size:14px !important;border-top: 1px solid white;padding-top:6px !important;
            padding-bottom:6px !important;">REGISTRATION DETAILS</th>
        </tr>

          <tr>
            <td colspan="" style="border:none !important;">
             <b>Reg No </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;<b>:</b> {{$reg_no}}
            </td>
            <td style="border:none !important;"><b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;Reg Date &nbsp;&nbsp; :
            &nbsp;&nbsp;&nbsp;</b> {{$reg_date}}</td>
            <td  style="border:none !important;"><b>Doc Collected By : &nbsp;&nbsp;</b>{{$doc_collected_by}} </td>
          </tr>
          
          <tr>
            <td colspan="" style="border:none !important;">
             <b>Mobile</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             &nbsp;&nbsp;&nbsp;<b>:</b> {{$doc_collected_mobile}}
            </td>
            <td style="border:none !important;"><b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;Doc Collected Date &nbsp;&nbsp; :
            &nbsp;&nbsp;&nbsp;</b>{{$doc_collected_date}}</td>
          </tr>
          <tr>
              <td style="border:none !important;text-align:center;font-size:14px"><h3>{{$get_customer_doc_list}}</h3></td>
          </tr>
         
    </table>
    
      <table class="custom-table border-bottom-0" style="border-top: 1px solid black;" width='100%' cellspacing='1' border='1' bordercolor='transparent'>
        <tr>
            <th colspan="9" style="width: 100%;text-align:center;font-size:14px">PAYMENT DETAILS</th>
        </tr>

        <tr>
            <th style="text-align:center;font-size:13px">#</th>
            <th style="text-align:center;font-size:13px"> Date</th>
            <th style="text-align:center;font-size:13px">Receipt</th>
            <th style="text-align:center;font-size:13px">Type</th>
            <th style="text-align:center;font-size:13px">Paymode</th>
            <th style="text-align:center;font-size:13px">Narration</th>
            <th style="text-align:center;font-size:13px">Amount</th>
            <th style="text-align:center;font-size:13px">Discount</th>
            <th style="text-align:center;font-size:13px">Total Amount</th>
        </tr>

       <?php 
       $sno = 1;
       
       if (isset($payments)) {
           $grant_total_amt = 0;
            $pay_term = '';
            $cheque_nos = '';
            $loan_amount = '';
            $bank_name = '';
            $new_pay_term = '';
            $pay_towards = [];
            $amount_towards = '';
                foreach ($payments as $val) {
                    if ($val->pay_mode == 1) {
                        $pay_mode = 'Cash';
                    }
                    if ($val->pay_mode == 2) {
                        $pay_mode = 'Cheque';
                    }
                    if ($val->pay_mode == 3) {
                        $pay_mode = 'DD';
                    }
                    if ($val->pay_mode == 4) {
                        $pay_mode = 'Online Transfer';
                    }
                    if ($val->pay_mode == 5) {
                        $pay_mode = 'Cash Deposite';
                    }

                    if ($val->account_type == 1) {
                        $type = 'Part Payment';
                    } else {
                        $type = 'Advance';
                    }

                    if (isset($val->narration)) {
                        $narration = $val->narration;
                    } else {
                        if ($val->pay_mode != 1) {
                            if (isset($val->bank_name)) {
                                $bank = \App\Models\Bank::where('id', $val->bank_name)->first();
                                $narration = $bank->bank_name;
                            } else {
                                $narration = $val->narration;
                            }
                        } else {
                            $narration = $val->narration;
                        }
                    }
                      
                      
                      
                       if(isset($val->payment_term))
            {
              if($val->payment_term == 1)
                {
                    $pay_term = 'Own Fund';
                }else{
                    $pay_term = 'Bank Loan';
                }  
            }
             
                if(isset($val->payment_term))
              {
                if(isset($val->cheque_no))
                {
                
                
                if($pay_term == 'Bank Loan')
                {
                    if($cheque_nos)
                {
                    $cheque_nos .= ',';
                }
                
                    $cheque_nos .= $val->cheque_no;
                }   
                }
              }
                
                if(isset($val->payment_term))
            {
                if($pay_term == 'Bank Loan')
                {
               if($val->amount_towards == 1)
                {
                    $amount_towards = 'MV';
                }else{
                    $amount_towards = 'GL';
                }
                
                array_push($pay_towards,$amount_towards);
                }
        
            }
                
                if(isset($val->payment_term))
            {
               
                if($pay_term == 'Bank Loan')
                {
                     if($loan_amount)
                {
                    $loan_amount .= ',';
                }
                
                    $loan_amount .=  IND_money_format(round($val->amount));
                }
                
            }
            
            if(isset($val->payment_term))
            {
                
                if(isset($val->narration))
                {
                    if($bank_name)
                {
                    $bank_name .= ',';
                }
                
                if($pay_term == 'Bank Loan')
                {
                    $bank_name .=  $val->narration;
                }    
                }else {
                    if($bank_name)
                {
                    $bank_name .= ',';
                }
                
                  if (isset($val->bank_name)) {
                      if($pay_term == 'Bank Loan')
                  {
                   $bank = \App\Models\Bank::where('id', $val->bank_name)->first();
                    $bank_name .= $bank->bank_name;
                    
                }
                  } 
                }
                
            }
            
            
            $total_amt =  $val->discount + $val->amount;
                    $total_paid_amt += $val->amount;
                    $total_discount_amt += $val->discount;
            
            if(isset($val->payment_term))
            {
                if($pay_term == 'Bank Loan')
                {
                    $new_pay_term =  $pay_term;
                }else{
                    $new_pay_term = 'Own Fund';
                }
            } 
                    
          

                    $total_amt =  $val->discount + $val->amount;
                    echo '<tr style="text-align:center;font-size:13px">
                     <td style="text-align:center;font-size:13px">' . $sno++ . '</td>
                    <td style="text-align:center;font-size:13px">' . date('d-m-Y', strtotime($val->receipt_date)) . '</td>
                    <td style="text-align:center;font-size:13px">' . $val->receipt_no . '</td>
                    <td style="text-align:center;font-size:13px">' . $type . '</td>
                    <td style="text-align:center;font-size:13px">' . $pay_mode . '</td>
                    <td style="text-align:center;font-size:13px">' . $narration . '</td>
                    <td style="text-align:center;font-size:13px">' . IND_money_format(round($val->paid)) . '</td>
                    <td style="text-align:center;font-size:13px">' . IND_money_format(round($val->discount)) . '</td>
                    <td style="text-align:center;font-size:13px" colspan="2">' . IND_money_format(round($total_amt)) . '</td>
                    </tr>';

                    $grant_total_amt =$grant_total_amt +  $total_amt;
                }
            }
       ?>
        <tr>
           <td colspan="3" style="text-align:center;font-size:13px"><b>No.of Days : {{$days}}</b></td>
            <td colspan="2" style="text-align:center;font-size:13px"><b>Balance : {{$balance_amt}}</b></td>
            <td colspan="2" style="text-align:right;font-size:13px"><b>Paid : {{IND_money_format(round($total_paid_amt))}}</b> </td>
            <td style="text-align:center;font-size:13px"> {{IND_money_format(round($total_discount_amt))}} </td>
             <td style="text-align:center;font-size:13px">{{IND_money_format(round($grant_total_amt))}}</td>
        </tr>
    </table>
    
    <table class="custom-table border-bottom-0" width='100%' cellspacing='1' style="font-size:13px !important;" border='1' bordercolor='transparent'>
    <tr>
        <th colspan="5" style="width: 100%; text-align: center; font-size: 14px !important;padding-top: 6px !important;
        padding-bottom: 6px !important;">PAYMENT TERM DETAILS</th>
    </tr>
    <tr>
        <?php
        if($loan_amount != '' || isset($loan_amount) && $loan_amount != 0)
         {
          $term = 'Bank Loan';
         }else{
          $term = 'Own Fund';
         }
        ?>
        <td colspan="" style="border: none !important;">
            <b>Payment Term  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </b>  {{ $term }}
        </td>
        <td style="border: none !important;">
            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;Loan Company &nbsp;&nbsp; :</b>  {{ $bank_name }} &nbsp;&nbsp;&nbsp;
        </td>
        <td style="border: none !important;">
            <b>Loan Section Date : </b>&nbsp;&nbsp; {{ $cheque_nos }}
        </td>
    </tr>
    <tr>
        <td colspan="" style="border: none !important;">
            <b>Loan Amount  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b> {{ $loan_amount }}  
        </td>
        <?php
        $remarks = '';
        if(in_array('GL',$pay_towards))
        {
            $remarks = 'Bank loan is for GL value only';
        }else if(in_array('MV',$pay_towards))
        {
            $remarks = 'Bank loan is for MV value only';
        }
        
        $new_pay =array('MV','GL');
        $Diff = array_intersect($new_pay, $pay_towards);
        $show_str = implode(",", $Diff);
        if($show_str == 'MV,GL')
        {
            $remarks = 'Bank loan is for MV & GL value';
        }
        ?>
        <td style="border: none !important;">
            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;Remarks &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b> &nbsp;{{ $remarks }}
            </td>
    </tr>
</table>


</div>

<?php
  }
?>
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