 
 
<div style="margin:20px;" id="print_book">
	<table  style="border-width: 1px !important;"  width='100%' cellspacing='1'   style="border-width: thin;"  bordercolor='black'  >
	<tr >
		<th   style="text-align:center;">
			<b>RECEIPT</b></th>
			<th   style="text-align:center;">
			<b> {{ date('d-m-Y',strtotime($booking->receipt_date)) }}</b></th>
	</tr>
	<tr >
		<th colspan='2' style="text-align:center;">
			<b>BOOKING DETAILS</b></th>
</tr>
 
	</table>
	<table style="border-width: 1px !important;"  width='100%' cellspacing='1'   border='1' bordercolor='transparent'  >
	<tr>
		<td  style="width: 50%;text-transform: uppercase;border-width: 1px !important;">
		 <p style="margin:5px 0px 0px 0px;">
        <b>Receipt No :</b> {{ $payment->receipt_no}}
        </p>
        <p style="margin:5px 0px 0px 0px;">
	    <b> Project Name : </b>  {{ $booking->short_name}} 
	    </p>
	    <p style="margin:5px 0px 0px 5px;">
		<b> Plot No : </b> {{ $booking->plot_no}}    &nbsp;&nbsp;&nbsp;<b> Sq.Ft : {{ number_format($booking->plot_sq_ft,2) }} </b> 
		</p>
		
	</td>
	   
	<td  style="width: 50%;text-transform: uppercase;border-width: 1px !important;">
	<p style="margin:5px 0px 0px 0px;">
	    <b>Location :</b> {{ $booking->landmark}} 
	    </p>
	    	<p style="margin:5px 0px 0px 0px;">
	    <b>Sq.Ft Rate : </b>  {{ number_format($booking->market_value_sq_ft,2) }}  
	    </p>
	    	<p style="margin:5px 0px 0px 5px;">
		<b> Plot Value : </b> {{ number_format($booking->market_value_plot_rate,2) }}  
		</p>
				
	</td>
	
	</tr>
	</table>
	
	<table style="border-width: 1px !important;"  width='100%' cellspacing='1'   border='1' bordercolor='transparent'  >
	 <tr>
	     <th style="width: 50%;text-align:center;">CUSTOMER DETAILS</th>
	     <th style="width: 50%;text-align:center;">OFFICE DETAILS</th>
	     </tr>
	<tr>
	<td  style="width: 50%;text-transform: uppercase;">
		<p style="margin:5px 0px 0px 0px;">
        <b>Customer Name :</b> {{ $customer_name}}
        </p>
        <p style="margin:5px 0px 0px 0px;">
	    <b> Address : </b>  {{ $street}} <br> {{ $area}} <br> {{ $city}} - {{ $pincode}}
	                        
	    </p>
	    <p style="margin:5px 0px 0px 0px;">
		<b> District : </b> {{ $city}}   
		</p>
		<p style="margin:5px 0px 0px 5px;">
		    <b> Mobile : {{ $customer_mobile }} </b> 
		 </p>
		
	</td>
	
	<td  style="width: 50%;text-transform: uppercase;">

	    <p style="margin:5px 0px 0px 0px;">
        <b>Marketer Id :</b> {{ $marketer_details->reference_code}}
        </p>
        <p style="margin:5px 0px 0px 0px;">
	    <b> Marketer Name : </b>  {{ $marketer_details->name}}  
	    </p>
	    <p style="margin:5px 0px 0px 0px;">
		<b> Director Id : </b> {{ $director_details->reference_code}}    
		</p>
		<p style="margin:5px 0px 0px 0px;">
		<b> Director Name : </b> {{ $director_details->name}}    
		</p>
		<p style="margin:5px 0px 0px 5px;">
	    <b> Mobile No :  </b> {{ $marketer_details->mobile_no }}
		 </p>
				
	</td>
	
	</tr>
	</table>
	
	<table style="border-width: 1px !important;"  width='100%' cellspacing='1'   border='1' bordercolor='transparent'  >
	 <tr>
	  <th colspan="6" style="width: 100%;text-align:center;">PAYMENT DETAILS</th>
	 </tr>
	
	<tr>
	 <th>#</th>
	 <th>Receipt</th>
	 <th>Date</th>
	 <th>Type</th>
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
                
              
     ?>
     <td> {{ $type }}</td>
     <td> By {{ $paymode }}</td>
     <td> {{ $payment->amount }} </td>
     </tr>
     <tr>
         <th colspan="5" style="text-align:right !important;padding-right:15px !important;">TOTAL</th>
         <th>{{ number_format($payment->amount,2) }}</th>
     </tr>
      <tr>
         <th colspan="5" style="text-align:right !important;padding-right:15px !important;">BALANCE</th>
         <th>{{ number_format($balance,2) }}</th>
     </tr>
	</table>
	
	<table style="border-width: 1px !important;"  width='100%' cellspacing='1'   border='1' bordercolor='transparent'  >
	 <tr>
	     <th style="width: 100%;text-align:center;">'- நிபந்தனைகள் -</th>
	     
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
		<table style="border-width: 1px !important;"  width='100%' cellspacing='1'   border='1' bordercolor='transparent'  >
	 
	<tr>
		<td  style="width: 50%;text-align:left;">
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

<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script>
        $(document).ready(function() {
//   var contents = $("#print_book").html();
   var wb = {SheetNames:[],Sheets:{}};
        var ws9 = XLSX.utils.table_to_sheet(document.getElementById('print_book'),{raw:true});
        wb.SheetNames.push('Temp Table'); wb.Sheets["Temp Table"] = ws9;
        XLSX.writeFile(wb,"Ayngaran.xlsx",{cellStyles:true});
        });
        
</script>