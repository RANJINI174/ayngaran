 
<?php
  
       $booking = \App\Models\Booking::where('project_id',$project_id)->where('plot_id',$id)->first();
       
       $plots = \App\Models\PlotManagement::where('id',$id)->where('deleted_at',0)->first();
       
       if(isset($booking))
       {
       
        $customer_name = '';
        $customer_mobile = '';
        $alternate_mobile = '';
        $area = '';
        $city = '';
        $state = '';
        $pincode = '';
       if(isset($booking->customer_id))
       {
            $customer_id = $booking->customer_id;
           $get_customer_details = \App\Models\Booking::where('id',$booking->customer_id)->first();
           if(isset($get_customer_details))
           {
           $customer_name = $get_customer_details->customer_name;
           $street = $get_customer_details->street;
           $pincode = $get_customer_details->pincode;
           
           if($get_customer_details->gender ==1)
           {
               $gender = "Male";
           }else{
               $gender = "Female";
           }
           
           $get_area = \App\Models\Pincode::where('id',$get_customer_details->area)->first();
           if(isset($get_area))
           {
           $area = $get_area->area;
           $city = $get_area->city;
           $state = $get_area->state;
           }
           $customer_mobile = $get_customer_details->mobile;
           $alternate_mobile = $get_customer_details->alternate_mobile;   
           }
           $st = "<br>";
          $address =  $street ."\n" . $area .  "\n". $city  .'-'. $pincode  ;
          
        }else{
           $customer_id = $booking->id;
           $customer_name = $booking->customer_name;
           $street = $booking->street;
           $pincode = $booking->pincode;
           
           if($booking->gender ==1)
           {
               $gender = "Male";
           }else{
               $gender = "Female";
           }
           
           $get_area = \App\Models\Pincode::where('id',$booking->area)->first();
           if(isset($get_area))
           {
           $area = $get_area->area;
           $city = $get_area->city;
           $state = $get_area->state;
           }
           $customer_mobile = $booking->mobile;
           $alternate_mobile = $booking->alternate_mobile;
           
           $address =  $street ."\n" . $area .  "\n". $city  .'-'. $pincode  ;
           
       }
       
       
       
       $user_details = \App\Models\User::where('users.id',$booking->marketer_id)->first();
                                 
       $marketer = '';
        if(isset($user_details))
        {
            if($user_details->user_type != 'director')
            {
                if(isset($user_details->director_id))
        {
         $get_director_details = \App\Models\User::where('users.id',$user_details->director_id)->leftjoin('designation','designation.id','users.designation_id')
                                 ->select('users.*','designation.designation')->first();   
        $marketer = '<tr><td  style="font-size: 14px; text-align:center;">#</td><td  style="font-size: 14px; text-align:center;">'.$get_director_details->reference_code.'</td><td  style="font-size: 14px; text-align:center;">'.$get_director_details->designation.'</td>
                              <td  style="font-size: 14px; text-align:center;">'.$get_director_details->name.'</td><td  style="font-size: 14px; text-align:center;">'.$get_director_details->mobile_no.'</td></tr>';
                                 
        }
        if(isset($user_details->marketing_manager_id))
        {
         $get_marketing_manager_details = \App\Models\User::where('users.id',$user_details->marketing_manager_id)->leftjoin('designation','designation.id','users.designation_id')
                                 ->select('users.*','designation.designation')->first();   
        if(isset($get_marketing_manager_details))
        {
        $marketer .= '<tr><td  style="font-size: 14px; text-align:center;">#</td><td  style="font-size: 14px; text-align:center;">'.$get_marketing_manager_details->reference_code.'</td><td  style="font-size: 14px; text-align:center;">'.$get_marketing_manager_details->designation.'</td>
                              <td  style="font-size: 14px; text-align:center;">'.$get_marketing_manager_details->name.'</td><td  style="font-size: 14px; text-align:center;">'.$get_marketing_manager_details->mobile_no.'</td></tr>';    
        }
        
        }
        if(isset($user_details->marketing_supervisor_id))
        {
         $get_marketing_supervisor_details = \App\Models\User::where('users.id',$user_details->marketing_supervisor_id)->leftjoin('designation','designation.id','users.designation_id')
                                 ->select('users.*','designation.designation')->first();   
        if(isset($get_marketing_supervisor_details))
        {
        $marketer .= '<tr><td  style="font-size: 14px; text-align:center;">#</td><td  style="font-size: 14px; text-align:center;">'.$get_marketing_supervisor_details->reference_code.'</td><td  style="font-size: 14px; text-align:center;">'.$get_marketing_supervisor_details->designation.'</td>
                              <td  style="font-size: 14px; text-align:center;">'.$get_marketing_supervisor_details->name.'</td><td  style="font-size: 14px; text-align:center;">'.$get_marketing_supervisor_details->mobile_no.'</td></tr>';    
        }
        }  
            }else{
              $get_user_details = \App\Models\User::where('users.id',$user_details->id)->leftjoin('designation','designation.id','users.designation_id')
                                 ->select('users.*','designation.designation')->first();  
            if(isset($get_user_details))
            {
             $marketer .= '<tr><td  style="font-size: 14px; text-align:center;">#</td><td  style="font-size: 14px; text-align:center;">'.$get_user_details->reference_code.'</td><td  style="font-size: 14px; text-align:center;">'.$get_user_details->designation.'</td>
                              <td  style="font-size: 14px; text-align:center;">'.$get_user_details->name.'</td><td  style="font-size: 14px; text-align:center;">'.$get_user_details->mobile_no.'</td></tr>';   
            }
                
           }
        
        
        
        }
        $paid_amount = \App\Models\Payment::where('project_id',$project_id)->where('plot_id',$id)->select( DB::raw('SUM(amount) as paid_amount'))->first();
        
        if(isset($paid_amount))
        {
            $paid = $paid_amount->paid_amount;
        }else{
            $paid = 0;
        }
        
        $guide_line = 0;
        $project_name = '';
        $project_details = \App\Models\ProjectDetail::where('id',$project_id)->first();
        
        if(isset($project_details))
        {
            $guide_line = $project_details->guide_line;
            $project_name = $project_details->full_name;
        }
       
        $payment = '';
        $payments = '';
        $payment_list = \App\Models\Payment::where('project_id',$project_id)->where('plot_id',$id)->get();
        if(isset($payment_list))
        {
            $paymode = '';
            $type = '';
            $i =   1 ;
            foreach($payment_list as $payment)
            {
                if($payment->pay_mode == 1)
                {
                    $paymode = 'Cash';
                }
                 if($payment->pay_mode == 2)
                {
                    $paymode = 'Cheque';
                }
                 if($payment->pay_mode == 3)
                {
                    $paymode = 'DD';
                }
                 if($payment->pay_mode == 4)
                {
                    $paymode = 'Online Transfer';
                }
                 if($payment->pay_mode == 5)
                {
                    $paymode = 'Cash Deposite';
                }
                
                
                 if($payment->account_type == 1)
                {
                    $type = 'Part Payment';
                }else{
                    $type = 'Advance';
                }
                

                  if (isset($payment->narration)) {
                        $narration = $payment->narration;
                    } else {
                        if($payment->pay_mode != 1)
                        {
                         if (isset($payment->bank_name)) {
                            $bank = \App\Models\Bank::where('id', $payment->bank_name)->first();
                            $narration = $bank->bank_name;
                        }else{
                            $narration = $payment->narration;
                        }
                        }else{
                            $narration = $payment->narration;
                        }
                        
                    }
                    
                    if($payment->fully_paid == 1)
                    {
                        $new_narration = 'Fully Paid';
                    }else{
                        $new_narration = $narration;
                    }
                    
                    
                   if($payment->payment_term == 1)
                {
                    $pay_term = 'Own Fund';
                }else{
                    $pay_term = 'Bank Loan';
                }
                
                if($payment->amount_towards == 1)
                {
                    $amount_towards = 'MV';
                }else{
                    $amount_towards = 'GL';
                }
              
                $payment = '<tr><td style="font-size: 14px; text-align:center;">'.$i++.'</td><td style="font-size: 14px; text-align:center;">'.$payment->receipt_no.'</td><td style="font-size: 14px; text-align:center;">'.date('d-m-Y',strtotime($payment->receipt_date)).'</td>
                              <td style="font-size: 14px; text-align:center;">'.IND_money_format(round($payment->amount)).'</td><td style="font-size: 14px; text-align:center;">'.$payment->discount.'</td><td style="font-size: 14px; text-align:center;">'.$type.'</td>
                              <td style="font-size: 14px; text-align:center;">'.$paymode.'</td><td style="font-size: 14px; text-align:center;">'.$pay_term.'</td><td style="font-size: 14px; text-align:center;">'.$amount_towards.'</td><td style="font-size: 14px;">'.$new_narration.'
                              <input type="hidden" class="form-control" name="payment_id[]" id="payment_id" value="' . $payment->id . '" ></td></tr>';
                              
                $payments .= $payment;
            }
        }
        
?>


 <div>
     <h3 style="text-align:center;">CANCELLED PLOT CUSTOMER DETAILS</h3>
  <table   width='100%'  cellspacing='1'  style="border-right: 1px solid black;border-top: 1px solid black;
  border-left: 1px solid black;padding-top:6px !important;padding-bottom:6px !important;">
        <tr>
            <th style="text-align:center !important;width: 75%;font-size:14px" >
                <b>PROJECT NAME : {{!empty($project_name) ? $project_name :'' }}</b>
            </th>
        </tr>
    </table>
<table class="custom-table" width='100%' cellspacing='1' border='1' bordercolor='transparent'>
    <tr>
        <th style="width: 40%; text-align: center;  border-bottom: 1px solid black; font-size: 14px; padding: 6px;">CUSTOMER DETAILS</th>
        <th colspan="2" style="width: 60%%; text-align: center; border-right: 1px solid black; border-bottom: 1px solid black; font-size: 14px; padding: 6px;">PLOT DETAILS </th>
    </tr>
    <tr>
        <td style="width:40%; text-transform: uppercase; border-width: 1px !important; font-size: 13px !important; padding: 6px; border-bottom:1px solid white !important;">
            <b>Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;&nbsp;{{$customer_name}}<br>
            <b>Gender &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;&nbsp;{{$gender}}<br>
            <b>Mobile &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;&nbsp;{{$customer_mobile}}<br>
            <b>Alternate <br>Mobile &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             :</b> &nbsp;&nbsp;&nbsp;{{$alternate_mobile}}<br>
             
            <b>Address &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;&nbsp;{{$street}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$area}}<br>&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$city}} - {{$pincode}}
                
        </td> 
         <!--<td style="width: 40%;text-transform: uppercase;">-->
         <!--       <p style="margin:5px 0px 0px 0px;">-->
         <!--           <b>Customer Name :</b> {{ $customer_name }}-->
         <!--       </p>-->
         <!--       <p style="margin:5px 0px 0px 0px;">-->
         <!--           <b> Gender : {{ $gender }} </b>-->
         <!--       </p>-->
         <!--       <p style="margin:5px 0px 0px 0px;">-->
         <!--           <b> Mobile : {{ $customer_mobile }} </b>-->
         <!--       </p>-->
         <!--       <p style="margin:5px 0px 0px 0px;">-->
         <!--           <b> Alternate Number : </b> 8765626221-->
         <!--       </p>-->

         <!--       <p style="margin:5px 0px 0px 0px;">-->
         <!--           <b> Address : </b> {{ $address}}-->
         <!--       </p>-->
                
         <!--   </td>-->
        <td style="width: 30%; border-bottom:1px solid white;">
            <b>Plot No. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;{{$plots->plot_no}}<br>
            <b>GV Sq.ft &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;&nbsp;{{IND_money_format(round($guide_line))}}<br>
            <b>Sq.Ft Rate &nbsp;&nbsp;:</b> &nbsp;&nbsp;{{IND_money_format(round($plots->market_value_sq_ft))}}<br>
            <b>Total Paid &nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;{{IND_money_format(round($paid))}}<br>
        </td>
        <td style="width: 30%; text-transform: uppercase; border-width: 1px !important; font-size: 13px !important; padding: 6px; border-bottom:1px solid white;">
            <b>Plot Sq.Ft &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>  &nbsp;&nbsp;&nbsp;{{ $plots->plot_sq_ft }}<br>
            <b>GV Plot Rate  &nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;&nbsp;{{IND_money_format(round($plots->guide_line_plot_rate))}} <br>
            <b>Plot Rate &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;&nbsp;{{IND_money_format(round($plots->market_value_plot_rate))}}<br>
            <?php $total_balance = $plots->market_value_plot_rate -  $paid?>
            <b>Balance &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            :</b> &nbsp;&nbsp;&nbsp;{{IND_money_format(round($total_balance))}}<br>
         
        </td>
    </tr>
</table>


    <table class="custom-table" width='100%' cellspacing='1' 
    style="font-size: 14px !important; border-collapse: collapse; border-top: 1px solid white;" border='1' bordercolor='transparent'>
    <tr>
        <th colspan="5" style="width: 100%; text-align:center; font-size:14px; padding-top:1px solid white !important; padding-bottom:6px !important; ">MARKETER DETAILS</th>
    </tr>
</table>

<table class="custom-table" width='100%' cellspacing='1' 
     style="font-size: 14px !important; border-collapse: collapse; border-top: 1px solid white; border-bottom:1px solid white !important;"  border='1' bordercolor='transparent'>
    <tr>
        <th style="font-size: 14px; text-align:center;" width="5%">#</th>
        <th style="font-size: 14px; text-align:center;" width="23.5%">Marketer ID</th>
        <th style="font-size: 14px; text-align:center;" width="23.5%">Designation</th>
        <th style="font-size: 14px; text-align:center;" width="23.5%">Name</th>
        <th style="font-size: 14px; text-align:center;" width="23.5%">Mobile</th>
    </tr>
    <?php 
        echo $marketer; 
    ?>
</table>

    
<table class="custom-table" style="border-collapse: collapse; border-top: none;" width='100%' cellspacing='0' border='1' bordercolor='black'>
    <tr>
        <th colspan="10" style="text-align:center; font-size:14px; border-top: 1px solid white;">PAYMENT DETAILS</th>
    </tr>
    <tr>
        <th style="text-align:center; font-size: 14px; border: 1px solid black;">#</th>
        <th style="text-align:center; font-size: 14px; border: 1px solid black;">Receipt No</th>
        <th style="text-align:center; font-size: 14px; border: 1px solid black;">Date</th>
        <th style="text-align:center; font-size: 14px; border: 1px solid black;">Amount</th>
        <th style="text-align:center; font-size: 14px; border: 1px solid black;">Discount</th>
        <th style="text-align:center; font-size: 14px; border: 1px solid black;">Type</th>
        <th style="text-align:center; font-size: 14px; border: 1px solid black;">Paymode</th>
        <th style="text-align:center; font-size: 14px; border: 1px solid black;">Payment Source</th>
        <th style="text-align:center; font-size: 14px; border: 1px solid black;">Amount Towards</th>
        <th style="text-align:center; font-size: 14px; border: 1px solid black;">Narration</th>
    </tr>
   <?php 
   echo $payments;
   ?>
</table>


<table class="custom-table" width='100%' cellspacing='1' style="font-size: 14px !important; border-top: none;" >
    <tr>
        <th colspan="5" style="text-align: center; font-size: 14px !important; padding-top: 6px !important; border-top: 1px solid white; padding-bottom: 6px !important;">CANCELLATION REASON</th>
    </tr>
    <tr>
        <td colspan="5" style="border: 1px solid black;">
            <b>Cancellation Reason :</b> {{!empty($booking->cancel_reason) ? $booking->cancel_reason : ''}}
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