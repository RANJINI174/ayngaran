 
 
<div style="margin:20px;">
	<table  width='100%' cellspacing='1' style="border-right: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;border-left: 1px solid black;"  >
	<tr >
		<th  style="text-align:center;">
			<b>RECEIPT</b></th>
			<th   style="text-align:center;">
			<b> {{ date('d-m-Y',strtotime($booking->receipt_date)) }}</b></th>
	</tr>
 
	</table>
	 <table   width='100%'    style="border-right: 1px solid black;border-left: 1px solid black;font-size:13px;">
         
            <th colspan='2' style="text-align:center;">
                <b>BOOKING DETAILS</b>
            </th>
         
    </table>
 <table class="custom-table border-bottom-0" width='100%' cellspacing='1' style="border-top: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;font-size:13px">
         
            <td style="width: 50%;text-transform: uppercase;border-right: 1px solid black;">
                
                    <b style="width: 50%;">Receipt No </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;{{ $payment->receipt_no }}
                   <br>
               
                    <b style="width: 50%;"> Project Name &nbsp;&nbsp;: </b> &nbsp;&nbsp;{{ $booking->short_name }}
                
                <p style="margin:5px 0px 0px 0px;">
                    <b> Plot No &nbsp;&nbsp;: </b> {{ $booking->plot_no }} &nbsp;&nbsp;&nbsp;<b> Sq.Ft &nbsp;&nbsp;:
                        &nbsp;&nbsp;{{ number_format($booking->plot_sq_ft, 2) }} </b>
                </p>

            </td>

            <td style="width: 50%;text-transform: uppercase;border-width: 1px !important;font-size:13px">
                
                    <b>Location  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;&nbsp;&nbsp;{{ $booking->landmark }}
                 <br>
                
                    <b>Sq.Ft Rate  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b>  &nbsp;&nbsp;&nbsp;&nbsp;{{ number_format($booking->market_value_sq_ft, 2) }}
                 <br>
                
                    <b> Plot Value  &nbsp;&nbsp;&nbsp;: </b> &nbsp;&nbsp;&nbsp;{{ number_format($booking->market_value_plot_rate, 2) }}
               

            </td>

         
    </table>
	
	
	
	<table width='100%'  cellspacing='1'  style="border-right: 1px solid black;border-left: 1px solid black;font-size:13px">
	 <tr>
	     <th style="width: 50%;text-align:center;border-right: 1px solid black;border-bottom: 1px solid black;">CUSTOMER DETAILS</th>
	     <th style="width: 50%;text-align:center;border-bottom: 1px solid black;">OFFICE DETAILS</th>
	     </tr>
	<tr>
	    <td style="width: 50%;text-transform: uppercase;border-right: 1px solid black;">
                
                    <b>Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $customer_name }}
                    <br>
                 
                    <b> Address &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </b>  &nbsp;&nbsp;&nbsp;{{ $street }} <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $area }} <br> 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $city }} -
                    {{ $pincode }}

                   <br>
                <p style="margin:5px 0px 0px 0px;">
                    <b> District &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b> &nbsp;&nbsp;&nbsp;{{ $city }}
                </p>
                <p style="margin:5px 0px 0px 0px;">
                    <b> Mobile &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;{{ $customer_mobile }} </b>
                </p>

            </td>
 
	<td style="width: 50%;text-transform: uppercase;">

                <p style="margin:5px 0px 0px 0px;">
                    <b>Marketer Id &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;&nbsp;{{ $marketer_details->reference_code }}
                </p>
                <p style="margin:5px 0px 0px 0px;">
                    <b> Marketer Name : </b> &nbsp; &nbsp;{{ $marketer_details->name }}
                </p>
                <p style="margin:5px 0px 0px 0px;">
                    <b> Director Id &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;&nbsp;@if(isset($director_details))
                    {{ $director_details->reference_code }} @endif
                </p>
                <p style="margin:5px 0px 0px 0px;">
                    <b> Director Name &nbsp;&nbsp;:</b> &nbsp;&nbsp;@if(isset($director_details)) {{ $director_details->name }} @endif
                </p>
                <p style="margin:5px 0px 0px 0px;">
                    <b> Mobile No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;{{ $marketer_details->mobile_no }}
                </p>

            </td>
	 
	</tr>
	</table>
	
	 <table class="custom-table border-bottom-0" width='100%' border='1' bordercolor="black" style="border-collapse: collapse;  ">
	 <tr>
	  <th colspan="6" style="width: 100%;text-align:center;">PAYMENT DETAILS</th>
	 </tr>
	
	<tr>
	 <th>#</th>
	 <th>Receipt</th>
	 <th>Date</th>
	 <th>Type</th>
	 <th>Narration</th>
	 <th>Particulars</th>
	 <th>Amount</th>
     </tr>
     
         <tr>
     <td>1</td>
     <td> {{ $payment->receipt_no }}</td>
     <td> {{ date('d-m-Y',strtotime($payment->receipt_date)) }}</td>
     <?php
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
                
                $balance = $booking->market_value_plot_rate - $payment->amount;
                
                
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
                                                
                                                
                                                if($payment->fully_paid != 1)
                                                {
                                                    $new_narration = $narration;
                                                }else{
                                                    $new_narration = "Fully Paid";
                                                }
                
              
     ?>
     <td> {{ $type }}</td>
     <td> {{ $new_narration }}</td>
     <td> By {{ $paymode }}</td>
     <td> {{ $payment->amount }} </td>
     </tr>
     <tr>
         <th colspan="6" style="text-align:right !important;padding-right:15px !important;">TOTAL</th>
         <th>{{ number_format($payment->amount,2) }}</th>
     </tr>
      <tr>
         <th colspan="6" style="text-align:right !important;padding-right:15px !important;">BALANCE</th>
         <th>{{ number_format($balance,2) }}</th>
     </tr>
	</table>
	
 <table   width='100%'  cellspacing='1'  style="border-right: 1px solid black;border-left: 1px solid black;">
	 <tr>
	     <th style="width: 100%;text-align:center;">- நிபந்தனைகள் -</th>
	     
	     </tr>
  		<tr>
  	    <?php
  	     $print_template = \App\Models\PrintTemplateContent::where('id',$booking->template_id)->first();
       
         $print_template->print_template_content_name;
        
       
  	    ?>
  	   <td>{!! nl2br($print_template->print_template_content_name) !!}
  	   </td>
  	   </tr>
		
      

	</table>
		<table   width='100%' cellspacing='1'   style="border-right: 1px solid black;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">
	 
	<tr>
		<td  style="width: 50%;text-align:left;border-right: 1px solid black;">
		    <br><br><br>
		    Customer Signature
		</td>
	 	<td  style="width: 50%;text-align:right;">
	 	    <br><br><br>
	    Authorized Signature
	    </td>
 	
	</tr>
	</table>

</div>
<style>
    .right{ text-align:right;}
    .center{ text-align:center;}
    td { padding:5px; }
    .col-sm-12{
        border:0px  solid green !important;
    }
</style>