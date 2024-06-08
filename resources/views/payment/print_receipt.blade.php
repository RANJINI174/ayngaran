 
 <div style="margin:4cm 0cm 3cm 0cm">
     
  <table   width='100%'  cellspacing='1'  style="border-right: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;
  border-left: 1px solid black;padding-top:6px !important;padding-bottom:6px !important;">
        <tr>
            <th style="text-align:center !important;width: 75%;font-size:16px" >
                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RECEIPT</b>
            </th>
            <th style="text-align:end;width: 25%;">
                <b> Date: {{ date('d-m-Y', strtotime($single_pay->receipt_date)) }}</b>
            </th>
        </tr>
    </table>
     <table   width='100%'    style="border-right: 1px solid black;border-left: 1px solid black;font-size:14px;padding-top:6px !important;padding-bottom:6px !important;">
         
            <th colspan='2' style="text-align:center;">
                <b>BOOKING DETAILS</b>
            </th>
         
    </table>
    <table class="custom-table border-bottom-0" width='100%' cellspacing='1' border='1' bordercolor='transparent'>
         
            <td style="width: 50%;text-transform: uppercase;border-width: 1px !important;font-size:13px !important; ">
                
                    <b style="width: 50%;">Receipt No </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>:</b>&nbsp;&nbsp;{{ $single_pay->receipt_no }}
                   <br>
               
                    <b style="width: 50%;"> Project Name &nbsp;&nbsp;: </b> &nbsp;{{ $booking->short_name }}
                
                <p style="margin:5px 0px 0px 0px;">
                    <b> Plot No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> &nbsp;{{ $booking->plot_no }} 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> Sq.Ft &nbsp;&nbsp;:</b>
                        &nbsp;&nbsp;{{ $booking->plot_sq_ft }} 
                </p>

            </td>

            <td style="width: 50%;text-transform: uppercase;border-width: 1px !important;font-size:13px !important;">
                
                    <b>Location  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;&nbsp;&nbsp;{{ $booking->landmark }}
                 <br>
                
                    <b>Sq.Ft Rate  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b>  &nbsp;&nbsp;&nbsp;&nbsp;{{ IND_money_format($booking->market_value_sq_ft) }}
                 <br>
                
                    <b> Plot Value  &nbsp;&nbsp;&nbsp;: </b> &nbsp;&nbsp;&nbsp;&nbsp;{{ IND_money_format($booking->market_value_plot_rate) }}
               

            </td>

         
    </table>

    <table   width='100%'  cellspacing='1'  style="border-right: 1px solid black;border-left: 1px solid black;">
        <tr >
            <th style="width: 50%;text-align:center;border-right: 1px solid black;border-bottom: 1px solid black;font-size:14px;
            padding-top:6px !important;padding-bottom:6px !important;">CUSTOMER DETAILS</th>
            <th style="width: 50%;text-align:center;border-bottom: 1px solid black;font-size:14px;
            padding-top:6px !important;padding-bottom:6px !important;">OFFICE DETAILS</th>
        </tr>
        <tr>
            <td style="width: 50%;text-transform: uppercase;border-right: 1px solid black;font-size:13px !important;">
                 <p style="margin:5px 0px 0px 0px;">
                    <b> Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </b>&nbsp;&nbsp;&nbsp;&nbsp;{{ $customer_name }}
                    </p>
                 <p style="margin:5px 0px 0px 0px;">
                    <b> Address &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </b>  &nbsp;&nbsp;&nbsp;&nbsp;{{ $street }} <br> 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $area }} <br> 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $city }} -
                    {{ $pincode }}
              </p>
                <p style="margin:5px 0px 0px 0px;">
                    <b> District &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b> &nbsp;&nbsp;&nbsp;&nbsp;{{ $city }}
                </p>
                <p style="margin:5px 0px 0px 0px;">
                    <b> Mobile &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b> &nbsp;&nbsp;&nbsp;&nbsp;{{ $customer_mobile }} 
                </p>

            </td>

            <td style="width: 50%;text-transform: uppercase;font-size:13px !important;">

                <p style="margin:5px 0px 0px 0px;">
                    <b>Marketer Id &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b> &nbsp;&nbsp;&nbsp;{{ $marketer_details->reference_code }}
                </p>
                <p style="margin:5px 0px 0px 0px;">
                    <b> Marketer Name &nbsp;: </b> &nbsp; &nbsp;{{ $marketer_details->name }}
                </p>
                 <p style="margin:5px 0px 0px 0px;">
                    <b> Mobile No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b>&nbsp;&nbsp;&nbsp;&nbsp;{{ $marketer_details->mobile_no }}
                </p>
                
                <p style="margin:5px 0px 0px 0px;">
                    <b> Director Id &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;@if(isset($director_details))
                    {{ $director_details->reference_code }} @else {{ $marketer_details->reference_code }} @endif
                </p>
                <p style="margin:5px 0px 0px 0px;">
                    <b> Director Name &nbsp;&nbsp;&nbsp;:</b> &nbsp;&nbsp;@if(isset($director_details)) {{ $director_details->name }} @else {{ $marketer_details->name }} @endif
                </p>
               

            </td>

        </tr>
    </table>

    <table class="custom-table border-bottom-0" width='100%' cellspacing='1' style="font-size:13px !important;" border='1' bordercolor='transparent'>
        <tr>
            <th colspan="7" style="width: 100%;text-align:center;font-size:14px !important;padding-top:6px !important;padding-bottom:6px !important;">PAYMENT DETAILS</th>
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
        <?php
      if(isset($payments))
      {
          $total_amount = 0;
          $i = 1;
          $narration = '';
          $new_narration = '';
          foreach($payments as $payment)
          {
              
              
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
        <tr>
            <td> {{ $i++ }}</td>
            <td> {{ $payment->receipt_no }}</td>
            <td> {{ date('d-m-Y', strtotime($payment->receipt_date)) }}</td>
            <?php
            if ($payment->pay_mode == 1) {
                $paymode = 'Cash';
            }
            if ($payment->pay_mode == 2) {
                $paymode = 'Cheque';
            }
            if ($payment->pay_mode == 3) {
                $paymode = 'DD';
            }
            if ($payment->pay_mode == 4) {
                $paymode = 'Online Transfer';
            }
            if ($payment->pay_mode == 5) {
                $paymode = 'Cash Deposite';
            }

            if ($payment->account_type == 1) {
                $type = 'Part Payment';
            } else {
                $type = 'Advance';
            }

            $total_amount = $total_amount + $payment->amount;

            $balance = $booking->market_value_plot_rate - $total_amount;

            ?>
            <td> {{ $type }}</td>
            <td> {{ $new_narration }} </td>
            <td> By {{ $paymode }}</td>
            <td style="text-align:right"> {{ IND_money_format($payment->amount) }} </td>
        </tr>
        <?php
          }
      }

     ?>
        <tr>
            <th colspan="6" style="text-align:right !important;padding-right:15px !important;">TOTAL</th>
            <th style="text-align:right">{{ IND_money_format($total_amount) }}</th>
        </tr>
        <tr>
            <th colspan="6" style="text-align:right !important;padding-right:15px !important;">BALANCE</th>
            <th style="text-align:right">{{ IND_money_format($balance) }}</th>
        </tr>
    </table>

    <table   width='100%'  cellspacing='1'  style="border-right: 1px solid black;border-left: 1px solid black;">
        <tr>
            <th style="width: 100%;text-align:center;font-size:14px">- நிபந்தனைகள் -</th>

        </tr>
        <tr style="font-size:13px">
            <?php
            $print_template = \App\Models\PrintTemplateContent::where('id', $booking->template_id)->first();

            $print_template->print_template_content_name;

            ?>
            <td>{!! nl2br($print_template->print_template_content_name) !!}
            </td>
        </tr>




    </table>
    <table class="custom-table border-bottom-0" width='100%' cellspacing='1' border='1' bordercolor='transparent'>

        <tr>
            <td style="width: 50%;text-align:left;">
                <br><br><br>
                Customer Signature
            </td>
            <td style="width: 50%;text-align:right;">
                <br><br><br>
                Authorized Signature
            </td>

        </tr>
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
