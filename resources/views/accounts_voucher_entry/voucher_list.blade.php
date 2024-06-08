@extends('layouts.app')
@section('content')
    <div class="row row-sm mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Voucher Details</h3>
                    <!--<a class="btn-primary add_master_btn" href="{{ route('account-voucher-entry-add') }}">Add New</a>-->
                </div>
<?php

$from_date = Request::input('from_date');
$to_date=Request::input('to_date');
if($from_date == '')
{
    $from_date = date('Y-m-d');
}
if($to_date == '')
{
    $to_date = date('Y-m-d');
}

?>
                <div class="card-body">
                   
                    <div class="container">
                         <form  method="get"  autocomplete="off" url ="{{ route('account-voucher-list') }}">
                    <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">From Date  </label>
                                <div class="input-group">
                                <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker"  value="{{ $from_date }}" 
                                        type="date" name="from_date" id="from_date">
                                </div>
                             
                            </div>
                            
                             <div class="col-md-4">
                                <label class="form-label">To Date </label>
                                <div class="input-group">
                                   <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker"  value="{{ $to_date }}" 
                                        type="date" name="to_date" id="to_date">
                                </div>
                             
                            </div>
                             <div class="col-md-4 mt-3">
                                 <br>
                                <button type="submit" class="btn btn-primary me-2">Search</button>
                               
                            </div>
                            </div>
                            </form>
                            <br>
                         <div class="table-wrapper-scroll-y my-custom-scrollbar">
                            <div class="table-responsive mt-3" style="overflow-y: auto; height:480px;">
                                <table id="Voucher_entry_Lists" class="table table-bordered table-striped mb-0" cellspacing="0" style="width:100%">
                                    <thead class="border text-center">
                                        <tr>
                                            <th colspan="9" class="border-left-0"></th>
                                            <th colspan="2">Bank</th>
                                            <th colspan="2">Cash</th>
                                            <th colspan="1"></th>
                                        </tr>
                                        <tr>
                                            <th class="bg-transparent" style="width:5% !important;">S.No</th>
                                            <th class="bg-transparent" style="width:10% !important;">Date</th>
                                            <th class="bg-transparent" style="width:5% !important;">Voucher No</th>
                                            <th class="bg-transparent" style="width:5% !important;">Account<br>on</th>
                                            <th class="bg-transparent" style="width:5% !important;">Trans. Type</th>
                                            <th class="bg-transparent" style="width:5% !important;">Main Ledger</th>
                                            <th class="bg-transparent" style="width:10% !important;">Sub Ledger</th>
                                            <th class="bg-transparent" style="width:20% !important;">Narration</th>
                                            <th class="bg-transparent" style="width:10% !important;">Paymode</th>
                                            <th class="bg-transparent" style="width:5% !important;">Debit</th>
                                            <th class="bg-transparent" style="width:5% !important;">Credit</th>
                                            <th class="bg-transparent" style="width:5% !important;">Debit</th>
                                            <th class="bg-transparent" style="width:5% !important;">Credit</th>
                                            <th class="bg-transparent" style="width:5% !important;">Print</th>
                                        <!--<tr>-->

                                        <!--    <th colspan="1" class="bg-transparent"></th>-->
                                        <!--    <th class="bg-transparent">-->
                                        <!--        <input type="text" id="search_voucher" class="form-control">-->
                                        <!--    </th>-->
                                        <!--    <th class="bg-transparent">-->
                                        <!--        <select id="search_trans_type" class="form-control SlectBox">-->
                                        <!--            <option value="">Select</option>-->
                                        <!--            <option value="1">Income</option>-->
                                        <!--            <option value="2">Expense</option>-->
                                        <!--        </select>-->
                                        <!--    </th>-->
                                        <!--    <th class="bg-transparent">-->
                                        <!--        <input type="text" id="search_legder_name" class="form-control">-->
                                        <!--    </th>-->
                                        <!--    <th class="bg-transparent">-->
                                        <!--        <input type="text" id="search_narration" class="form-control">-->
                                        <!--    </th>-->
                                        <!--    <th class="bg-transparent">-->
                                        <!--        <input type="text" id="search_description" class="form-control">-->
                                        <!--    </th>-->
                                        <!--    <th class="bg-transparent">-->
                                        <!--        <select id="search_pay_mode" class="form-control SlectBox">-->
                                        <!--            <option value="">Select</option>-->
                                        <!--            <option value="1">Cash</option>-->
                                        <!--            <option value="2">Cheque</option>-->
                                        <!--            <option value="3">DD</option>-->
                                        <!--            <option value="4">Online Transfer</option>-->
                                        <!--            <option value="5">Cash Deposit</option>-->
                                        <!--        </select>-->
                                        <!--    </th>-->
                                        <!--    <th class="bg-transparent">-->
                                        <!--        <input type="text" id="search_bank_debit" class="form-control">-->
                                        <!--    </th>-->
                                        <!--    <th class="bg-transparent">-->
                                        <!--        <input type="text" id="search_bank_credit" class="form-control">-->
                                        <!--    </th>-->
                                        <!--    <th class="bg-transparent">-->
                                        <!--        <input type="text" id="search_cash_debit" class="form-control">-->
                                        <!--    </th>-->
                                        <!--    <th class="bg-transparent" class="border-left-0">-->
                                        <!--        <input type="text" id="search_cash_credit" class="form-control">-->
                                        <!--    </th>-->
                                        <!--</tr>-->
                                    </thead>
                                    <tbody class="border">
                                        <?php
                                        $i = 1;
                                        $cash_dedit = 0;
                                        $cash_credit = 0;
                                        $bank_dedit = 0;
                                        $bank_credit = 0;
                                        $cash_dedit_total = 0;
                                        $cash_credit_total = 0;
                                        $bank_dedit_total = 0;
                                        $bank_credit_total = 0;
                                        
                                        $count = count($accounts);
                                        ?>
                                        @if($count > 0)
                                        @if (isset($accounts))
                                            @foreach ($accounts as $account)
                                                <?php
                                                if ($account->transaction_type == 1) {
                                                    $trans_type = 'Income';
                                                } else {
                                                    $trans_type = 'Expense';
                                                }
                                                
                                                if ($account->account_on == 1) {
                                                    $account_on = 'GL';
                                                } else {
                                                    $account_on = 'MV';
                                                }
                                                
                                                if ($account->pay_mode == 1) {
                                                    $paymode = 'Cash';
                                                }
                                                if ($account->pay_mode == 2) {
                                                    $paymode = 'Cheque';
                                                }
                                                if ($account->pay_mode == 3) {
                                                    $paymode = 'DD';
                                                }
                                                if ($account->pay_mode == 4) {
                                                    $paymode = 'Online Transfer';
                                                }
                                                if ($account->pay_mode == 5) {
                                                    $paymode = 'Cash Deposite';
                                                }
                                                
                                                if ($account->pay_mode == 1) {
                                                    if ($account->transaction_type == 1) {
                                                        $cash_dedit = $account->amount;
                                                        $cash_credit = 0;
                                                        $bank_dedit = 0;
                                                        $bank_credit = 0;
                                                    } else {
                                                        $cash_credit = $account->amount;
                                                        $cash_dedit = 0;
                                                        $bank_dedit = 0;
                                                        $bank_credit = 0;
                                                    }
                                                } else {
                                                    if ($account->transaction_type == 1) {
                                                        $bank_dedit = $account->amount;
                                                        $bank_credit = 0;
                                                        $cash_dedit = 0;
                                                        $cash_credit = 0;
                                                    } else {
                                                        $bank_credit = $account->amount;
                                                        $bank_dedit = 0;
                                                        $cash_dedit = 0;
                                                        $cash_credit = 0;
                                                    }
                                                }
                                                
                                                $cash_dedit_total = $cash_dedit_total + $cash_dedit;
                                                $cash_credit_total = $cash_credit_total + $cash_credit;
                                                $bank_dedit_total = $bank_dedit_total + $bank_dedit;
                                                $bank_credit_total = $bank_credit_total + $bank_credit;
                                                
                                                ?>
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($account->voucher_date)) }}</td>
                                                    <td>{{ $account->transaction_no }}</td>
                                                    <td>{{ $account_on }}</td>
                                                    <td>{{ $trans_type }}</td>
                                                    <td>{{ $account->main_ledger }}</td>
                                                    <td>{{ $account->sub_ledger }}</td>
                                                    <td>{{ $account->narration }}</td>
                                                    <td>{{ $paymode }}</td>
                                                    <td>{{ number_format($bank_credit, 2) }}</td>
                                                    <td>{{ number_format($bank_dedit, 2) }}</td>
                                                    <td>{{ number_format($cash_credit, 2) }}</td>
                                                    <td>{{ number_format($cash_dedit, 2) }}</td>
                                                    <td>
                                                        @php
                                                        $permission = new \App\Models\Permission();
                                                        $print_check = $permission->checkPermission('voucherlist.print');
                                                        @endphp
                                                        @if($print_check == 1)
                                                        <a class="btn-info border-0 me-1 btnprn"
                                                            href="{{ url('/voucher_print/' . $account->id) }}"
                                                            style="padding: 4px;width:30px ; border-radius:5px;">
                                                            <i class="fa fa-print" data-bs-toggle="tooltip" title=""
                                                                data-bs-original-title="Print" aria-label="Print"></i>
                                                        </a>
                                                        @endif
                                                        {{-- <a class="btn-danger border-0 me-1 btnprn" href="#"
                                                            style="padding: 4px;width:30px ; border-radius:5px;">
                                                            <i class="fa fa-print" data-bs-toggle="tooltip" title=""
                                                                data-bs-original-title="Print" aria-label="Print"></i>
                                                        </a> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                         @else
                                        <tr>
                                            <td colspan="15" style="text-align:center"> No Data Found</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td colspan="9">
                                                <h6 class="text-end fw-bold">Total :</h6>
                                            </td>
                                            <td>
                                                <h6 class="fw-bold">{{ number_format($bank_credit_total, 2) }}</h6>
                                            </td>
                                            <td>
                                                <h6 class="fw-bold">{{ number_format($bank_dedit_total, 2) }}</h6>
                                            </td>
                                            <td>
                                                <h6 class="fw-bold">{{ number_format($cash_credit_total, 2) }}</h6>
                                            </td>
                                            <td>
                                                <h6 class="fw-bold">{{ number_format($cash_dedit_total, 2) }}</h6>
                                            </td>
                                            <td colspan="2"></td>
                                        </tr>
                                       
                                    </tbody>
                                </table>
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
