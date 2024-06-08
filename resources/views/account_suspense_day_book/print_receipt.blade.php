 
   <table   width='100%'  cellspacing='1'  style="border-right: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;
  border-left: 1px solid black;padding-top:6px !important;padding-bottom:6px !important;">
        <tr>
            <th style="text-align:center !important;width: 75%;font-size:16px" >
                <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Suspense Day Book </b>
            </th>
            <th style="text-align:end;width: 25%;">
                <b> </b>
            </th>
        </tr>
    </table>
    
    <table   width='100%'  cellspacing='1'  style="border-right: 1px solid black;border-left: 1px solid black;">
        <tr >
            <th style="width: 50%;text-align:center;border-right: 1px solid black; font-size:14px;
            padding-top:6px !important;padding-bottom:6px !important;">From Date : {{ date('d-m-Y',strtotime($from_date)) }}</th>
            <th style="width: 50%;text-align:center;  ;font-size:14px;
            padding-top:6px !important;padding-bottom:6px !important;">To Date : {{ date('d-m-Y',strtotime($to_date)) }}</th>
        </tr>
        
    </table>

    <table class="custom-table border-bottom-0" width='100%' cellspacing='1' style="font-size:13px !important;" border='1' bordercolor='transparent'>
       

        <tr>
                                        <th>S.No</th>
                                        <th>Voucher No</th>
                                        <th>Voucher Date</th>
                                        <th>Transaction Type</th>
                                        <th>Purpose</th>
                                        <th>Contact Name</th>
                                        <th>Mobile</th>
                                        <!--<th class="bg-transparent ">Narration</th>-->
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        
        </tr>
       @php
                                                $i = 1;
                                                $credit = 0;
                                                $debit = 0;
                                                $dedit_total = 0;
                                                $credit_total = 0;
                                                $name = "";
                                                $mobile = "";
                                                
                                            @endphp
                                    @if (isset($accounts))
                                    @foreach ($accounts as $account)
                                    <?php
                                    $get_contact_name = \App\Models\User::where('id',$account->account_for)->first();
                                    if(isset($get_contact_name))
                                    {
                                        $name = $get_contact_name->name;
                                        $mobile = $get_contact_name->mobile_no;
                                    }
                                
                                                        if ($account->transaction_type == 1) {
                                                            $debit = $account->amount;
                                                            $credit = 0;
                                                        } else {
                                                            $credit = $account->amount;
                                                            $debit = 0;
                                                        }
                                                        
                                                if ($account->transaction_type == 1) {
                                                    $trans_type = 'Income';
                                                } else {
                                                    $trans_type = 'Expense';
                                                }
                                       
                                                    
                                    ?>
                                    <tr>
                                        <td> {{ $i++ }} </td>
                                        <td> {{ $account->transaction_no}} </td>
                                        <td> {{ date('d-m-Y',strtotime($account->voucher_date))}} </td>
                                        <td> {{ $trans_type}} </td>
                                        <td> {{ $account->purpose}} </td>
                                        <td> {{ $name }} </td>
                                        <td> {{ $mobile}} </td>
                                        <td> {{ number_format($credit,2) }} </td>
                                        <!--<td>1.00</td>-->
                                        <td> {{ number_format($debit,2) }} </td>
                                        
                                    </tr>
                                    <?php
                                    $dedit_total = $dedit_total + $debit;
                                    $credit_total = $credit_total + $credit;
                                    ?>
                                    @endforeach
                                    @endif
                                    <tr>
            <th colspan="7" style="text-align:right !important;padding-right:15px !important;">TOTAL</th>
            <th style="text-align:right">{{ number_format($credit_total, 2) }}</th>
            <th style="text-align:right">{{ number_format($dedit_total, 2) }}</th>
        </tr>
        
                                    
     
    </table>

   
  

 
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
