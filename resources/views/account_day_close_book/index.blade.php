@extends('layouts.app')
@section('content')
    <div class="row row-sm mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Day Book Close</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form id="Day_close_bookForm">
                            @method('POST')
                            @csrf
                            <div class="row mt-3">
                                <div class="col-12">
                                    <input type="hidden" id="url" value="{{ route('day_book_close_store') }}">
                                    <?php
                                    $current_date = '';
                                    if (isset($transaction)) {
                                        $current_date = $transaction->voucher_date;
                                    } else {
                                        $current_date = date('d-m-Y');
                                    }
                                    ?>
                                    <h5 class="fw-bold" style="color: #6259ca; text-align:center;">Day Book Report For
                                        <?php echo date('d-m-Y', strtotime($current_date)); ?>
                                    </h5>
                                </div>
                            </div>
                             <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                <div class="table-responsive mt-3" style="overflow-y: auto; height:450px;">
                                    <table id="day_book_voucher_Lists" class="table table-bordered table-striped mb-0">
                                        <thead class="border text-center">
                                            <tr colspan="12" class="text-end">
                                                <?php
                                                $yester_date = \Carbon\Carbon::yesterday();
                                                $voucher_entries = \App\Models\Account::whereNotNull('closing_status')
                                                    // where('closing_date', $yester_date)
                                                    ->orderBy('closing_date', 'desc')->orderBy('id', 'desc')->first();
                                                
                                                $opening_balance = 0;
                                                if (isset($voucher_entries)) {
                                                    $opening_balance = $voucher_entries->closing_balance;
                                                }
                                                
                                                 $sespense_return_amt = \App\Models\Account::where('voucher_date',date('Y-m-d'))
                                                    ->whereNotNull('suspense_id')
                                                    ->whereNull('closing_status')
                                                    ->select(DB::raw('SUM(amount) as sespense_return'))
                                                  ->first();
                                                  
                                                  $sespense_return_value = $sespense_return_amt->sespense_return;
                                                  
                                                  $get_suspense_amt = \App\Models\Account::where('voucher_date',date('Y-m-d'))
                                                    ->whereNotNull('suspense_id')
                                                    ->whereNull('closing_status')
                                                    ->select(DB::raw('SUM(old_amount) as old_sespense'))
                                                  ->first();
                                                    if (isset($get_suspense_amt)) {
                                                        $total_suspense_amt = $get_suspense_amt->old_sespense;
                                                    }
                                                    
                                                    $total_suspense = $total_suspense_amt - $sespense_return_value;
                                                    
                                                    $opening_balance = $opening_balance + $total_suspense;
                                                    
                                                ?>
                                                <h6 class="text-end fw-bold text-danger">Opening Balance : <span
                                                        class="text-success">
                                                        <input type="hidden" name="opening_balance" id="opening_balance"
                                                            value="<?php echo $opening_balance; ?>">
                                                        <?php echo number_format($opening_balance, 2); ?></span></h6>
                                            </tr>
                                            <tr>
                                                <th colspan="9" class="border-left-0"></th>
                                                <th colspan="2">Bank</th>
                                                <th colspan="2">Cash</th>
                                                <th colspan="1"></th>
                                            </tr>
                                            <tr>
                                                <th class="bg-transparent">S.No</th>
                                                <th class="bg-transparent">Date</th>
                                                <th class="bg-transparent ">Voucher No</th>
                                                <th class="bg-transparent ">Account<br> on</th>
                                                <th class="bg-transparent ">Trans. Type</th>
                                                <th class="bg-transparent ">Main Ledger</th>
                                                <th class="bg-transparent ">Sub Ledger</th>
                                                <th class="bg-transparent ">Narration</th>
                                                <th class="bg-transparent ">Paymode</th>
                                                <th class="bg-transparent ">Debit</th>
                                                <th class="bg-transparent ">Credit</th>
                                                <th class="bg-transparent ">Debit</th>
                                                <th class="bg-transparent ">Credit</th>
                                                <th class="bg-transparent ">Print</th>
                                            </tr>
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
                                            @php
                                                $i = 1;
                                                $cash_dedit = 0;
                                                $cash_credit = 0;
                                                $bank_dedit = 0;
                                                $bank_credit = 0;
                                                $cash_dedit_total = 0;
                                                $cash_credit_total = 0;
                                                $bank_dedit_total = 0;
                                                $bank_credit_total = 0;
                                            @endphp
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
                                                        <td><input type="hidden" name="voucher_id[]" id="voucher_id"
                                                                value="{{ $account->id }}">{{ $i++ }}</td>
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
                                                                    $print_check = $permission->checkPermission('daybookclose.print');
                                                                    
                                                                @endphp
                                                                @if($print_check == 1)
                                                                    <a class="btn-info border-0 me-1 btnprn"
                                                                        href="{{ url('/voucher_print/' . $account->id) }}"
                                                                        style="padding: 4px;width:30px ; border-radius:5px;">
                                                                        <i class="fa fa-print" data-bs-toggle="tooltip"
                                                                            title="" data-bs-original-title="Print"
                                                                            aria-label="Print"></i>
                                                                    </a>
                                                                @endif
                                                            {{-- <a class="btn-danger border-0 me-1 btnprn" href="#"
                                                                style="padding: 4px;width:30px ; border-radius:5px;">
                                                                <i class="fa fa-print" data-bs-toggle="tooltip"
                                                                    title="" data-bs-original-title="Print"
                                                                    aria-label="Print"></i>
                                                            </a> --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
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
                                            <tr class="text-end">
                                                <td colspan="14">
                                                    <?php
                                                    $total_income_receipt = \App\Models\Account::where('transaction_type', 1);
                                                    if ($previous_data > 0) {
                                                        $total_income_receipt->where('voucher_date', '=', $transaction->voucher_date);
                                                    } else {
                                                        $total_income_receipt->where('voucher_date', '=', date('Y-m-d'));
                                                    }
                                                    $total_income_receipt = $total_income_receipt
                                                        ->whereNull('closing_status')
                                                        ->whereNull('is_suspense')
                                                        ->get()
                                                        ->count();

                                                    $total_expense_receipt = \App\Models\Account::where('transaction_type', 2);
                                                    if ($previous_data > 0) {
                                                        $total_expense_receipt->where('voucher_date', '=', $transaction->voucher_date);
                                                    } else {
                                                        $total_expense_receipt->where('voucher_date', '=', date('Y-m-d'));
                                                    }
                                                    $total_expense_receipt = $total_expense_receipt
                                                        ->whereNull('closing_status')
                                                        ->whereNull('is_suspense')
                                                        ->get()
                                                        ->count();

                                                    $total_income_amount = \App\Models\Account::where('transaction_type', 1);
                                                    if ($previous_data > 0) {
                                                        $total_income_amount->where('voucher_date', '=', $transaction->voucher_date);
                                                    } else {
                                                        $total_income_amount->where('voucher_date', '=', date('Y-m-d'));
                                                    }
                                                    $total_income_amount = $total_income_amount
                                                        ->whereNull('closing_status')
                                                        ->whereNull('is_suspense')
                                                        ->select(DB::raw('SUM(amount) as receipt_amount'))
                                                        ->first();

                                                    $total_expense_amount = \App\Models\Account::where('transaction_type', 2);
                                                    if ($previous_data > 0) {
                                                        $total_expense_amount->where('voucher_date', '=', $transaction->voucher_date);
                                                    } else {
                                                        $total_expense_amount->where('voucher_date', '=', date('Y-m-d'));
                                                    }
                                                    $total_expense_amount = $total_expense_amount
                                                        ->whereNull('closing_status')
                                                        ->whereNull('is_suspense')
                                                        ->select(DB::raw('SUM(amount) as receipt_amount'))
                                                        ->first();

                                                    ?>

                                                    <h6 class="text-end fw-bold text-danger">Total Income : <span
                                                            class="text-success"><?php echo $total_income_receipt; ?></span></h6>
                                                </td>
                                            </tr>
                                            <tr class="text-end">
                                                <td colspan="14">
                                                    <h6 class="text-end fw-bold text-danger">Total Expense : <span
                                                            class="text-success"><?php echo $total_expense_receipt; ?></span></h6>
                                                </td>
                                            </tr>
                                            <tr class="text-end">
                                                <td colspan="14">
                                                    <h6 class="text-end fw-bold text-danger">Total Income Amount : <span
                                                            class="text-success"><?php echo number_format($total_income_amount->receipt_amount, 2); ?></span></h6>
                                                </td>
                                            </tr>
                                            <tr class="text-end">
                                                <td colspan="14">
                                                    <h6 class="text-end fw-bold text-danger">Total Expense Amount : <span
                                                            class="text-success"><?php echo number_format($total_expense_amount->receipt_amount, 2); ?></span></h6>
                                                </td>
                                            </tr>
                                            <tr class="text-end">
                                                <td colspan="14">
                                                    <?php
                                                    $total_plot_booking_amt = 0;
                                                    
                                                    $plot_booking = \App\Models\Account::whereNull('closing_status');
                                                    if ($previous_data > 0) {
                                                        $plot_booking->where('account_transactions.voucher_date', '=', $transaction->voucher_date);
                                                    } else {
                                                        $plot_booking->where('account_transactions.voucher_date', '=', $current_date);
                                                    }
                                                    $plot_booking = $plot_booking
                                                        ->where('main_ledger', '=', 3)->where('sub_ledger', '=', 2)->whereNull('closing_status')
                                                        ->select(DB::raw('SUM(amount) as total_plot_booking_amt'))->first();
                                                    
                                                    if (isset($plot_booking)) {
                                                        $total_plot_booking_amt = $plot_booking->total_plot_booking_amt;
                                                    }
                                                    
                                                    ?>
                                                    <h6 class="text-end fw-bold text-danger">Total Plot Booking Amount :
                                                        <span class="text-success"><?php echo number_format($total_plot_booking_amt, 2); ?></span>
                                                    </h6>
                                                </td>
                                            </tr>
                                            <tr class="text-end">
                                                <td colspan="14">
                                                    <?php
                                                    $total_partpayment_amt = 0;
                                                    $partpayment_amt = \App\Models\Account::whereNull('closing_status');
                                                    if ($previous_data > 0) {
                                                        $partpayment_amt->where('account_transactions.voucher_date', '=', $transaction->voucher_date);
                                                    } else {
                                                        $partpayment_amt->where('account_transactions.voucher_date', '=', $current_date);
                                                    }
                                                    $partpayment_amt = $partpayment_amt
                                                        ->where('main_ledger', '=', 3)->where('sub_ledger', '=', 5)->whereNull('closing_status')
                                                        ->select(DB::raw('SUM(amount) as total_partpayment_amt'))->first();
                                                    if (isset($partpayment_amt)) {
                                                        $total_partpayment_amt = $partpayment_amt->total_partpayment_amt;
                                                    }
                                                    ?>
                                                    <h6 class="text-end fw-bold text-danger">Total Part Payment Amount :
                                                        <span class="text-success"><?php echo number_format($total_partpayment_amt, 2); ?></span>
                                                    </h6>
                                                </td>
                                            </tr>
                                            <tr class="text-end">
                                                <td colspan="14">
                                                    <?php
                                                    $total_income_suspense_amt = 0;
                                                    $get_income_suspense_amt = \App\Models\Account::whereNull('closing_status')->whereNull('suspense_status');
                                                    if ($previous_data > 0) {
                                                        if(isset($get_suspense_date))
                                                     {
                                                         $get_income_suspense_amt->whereBetween('account_transactions.voucher_date', [$get_suspense_date->voucher_date, $transaction->voucher_date]);
                                                    }else{
                                                          $get_income_suspense_amt->where('account_transactions.voucher_date', '=', $transaction->voucher_date);
                                                    }
             
                                                    
                                                    } else {
                                                        
                                                           if(isset($get_suspense_date))
                                                     {
                                                         $get_income_suspense_amt->whereBetween('account_transactions.voucher_date', [ $get_suspense_date->voucher_date ,$current_date]);
                                                    }else{
                                                          $get_income_suspense_amt->where('account_transactions.voucher_date', '=', $current_date);
                                                    }
                                                    
                                                    }
                                                    $get_income_suspense_amt = $get_income_suspense_amt
                                                        ->where('voucher_type', '=', 2)
                                                        ->where('transaction_type',1)
                                                        ->whereNull('suspense_id')
                                                        ->select(DB::raw('SUM(amount) as total_suspense_amt'))
                                                        ->first();
                                                    if (isset($get_income_suspense_amt)) {
                                                        $total_income_suspense_amt = $get_income_suspense_amt->total_suspense_amt;
                                                    }
                                                    ?>
                                                    <h6 class="text-end fw-bold text-danger">Suspense Income : <span
                                                            class="text-success"><?php echo number_format($total_income_suspense_amt, 2); ?></span></h6>
                                                </td>
                                            </tr>
                                            <tr class="text-end">
                                                <td colspan="14">
                                                    <?php
                                                    $total_exp_suspense_amt = 0;
                                                    $get_expe_suspense_amt = \App\Models\Account::whereNull('closing_status')->whereNull('suspense_status');
                                                    if ($previous_data > 0) {
                                                         if(isset($get_suspense_date))
                                                     {
                                                         $get_expe_suspense_amt->whereBetween('account_transactions.voucher_date', [$get_suspense_date->voucher_date,$transaction->voucher_date]);
                                                    }else{
                                                          $get_expe_suspense_amt->where('account_transactions.voucher_date', '=', $transaction->voucher_date);
                                                    }
                                                    } else {
                                                        if(isset($get_suspense_date))
                                                     {
                                                         $get_expe_suspense_amt->whereBetween('account_transactions.voucher_date', [$get_suspense_date->voucher_date, $current_date]);
                                                    }else{
                                                         $get_expe_suspense_amt->where('account_transactions.voucher_date', '=', $current_date);
                                                    }
                                                    }
                                                    $get_expe_suspense_amt = $get_expe_suspense_amt
                                                        ->where('voucher_type', '=', 2)
                                                        ->where('transaction_type',2)
                                                        ->whereNull('suspense_id')
                                                        ->select(DB::raw('SUM(amount) as total_suspense_amt'))
                                                        ->first();
                                                    if (isset($get_expe_suspense_amt)) {
                                                        $total_exp_suspense_amt = $get_expe_suspense_amt->total_suspense_amt;
                                                    }
                                                    ?>
                                                    <h6 class="text-end fw-bold text-danger">Suspense Expense : <span
                                                            class="text-success"><?php echo number_format($total_exp_suspense_amt, 2); ?></span></h6>
                                                </td>
                                            </tr>
                                            <tr class="text-end">
                                                <td colspan="14">
                                                     <?php
                                                    $admin = \App\Models\Account::where('voucher_type', 3);
                                                    if ($previous_data > 0) {
                                                        $admin->where('account_transactions.voucher_date', '=', $transaction->voucher_date);
                                                    } else {
                                                        $admin->where('account_transactions.voucher_date', '=', $current_date);
                                                    }
                                                    $admin = $admin->select(DB::raw('SUM(amount) as admin_amount'))->first();

                                                    $admin_amount = 0;
                                                    if (isset($admin)) {
                                                        $admin_amount = $admin->admin_amount;
                                                    }
                                                    ?>
                                                    <h6 class="text-end fw-bold text-danger">Admin Amount : <span
                                                            class="text-success"><?php echo number_format($admin_amount, 2); ?></span></h6>
                                                </td>
                                            </tr>
                                            <tr class="text-end">
                                                <td colspan="14">
                                                    <?php
  
                                                    $get_total_income_amt = $total_income_amount->receipt_amount; // incomes
                                                    
                                                    
                                                    $get_expense_amt = $total_expense_amount->receipt_amount; // expenses
                                                    $get_total_expesne_amt = $get_expense_amt + $total_exp_suspense_amt;
                                                    
                                                    $total_income = $get_total_income_amt + $total_income_suspense_amt;
                                                    
                                                    $balance_amount = $total_income - $get_total_expesne_amt; // balance amount
                                                    
                                                    
                                                    
                                                    $total_income_amount = $opening_balance + $total_income_amount->receipt_amount + $total_income_suspense_amt; 
                                                    
                                                    $closing_balance = $total_income_amount - $get_total_expesne_amt; // closing balance
                                                    ?>
                                                    <h6 class="text-end fw-bold text-danger">Balance : <span
                                                            class="text-success"><?php echo number_format($balance_amount, 2); ?></span>
                                                    </h6>
                                                </td>
                                            </tr>
                                            <tr class="text-end">
                                                <td colspan="14">
                                                    <h6 class="text-end fw-bold text-danger">Closing Balance : <span
                                                            class="text-success">
                                                            <input type="hidden" name="closing_balance"
                                                                id="closing_balance" value="{{ $closing_balance }}">
                                                            <?php echo number_format($closing_balance, 2); ?></span></h6>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-md-4">
                                    <?php
                                    $ac_count = count($accounts);
                                    ?>
                                    <button type="submit"
                                        class="btn btn-primary me-2 {{ $ac_count == 0 ? 'disabled' : '' }}">Day Book
                                        Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Admin Account</h3>
                </div>
                <div class="card-body">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <div class="table-responsive mt-3" style="overflow-y: auto; height:450px;">
                            <table id="admin_day_book_Lists" class="table table-bordered table-striped mb-0">
                                <thead class="border text-center">
                                    <!--<tr colspan="12" class="text-end">-->
                                    <!--    <h6 class="text-end fw-bold text-danger">Opening Balance : <span-->
                                    <!--            class="text-success">1.00</span></h6>-->
                                    <!--</tr>-->
                                    <tr>
                                        <th colspan="9" class="border-left-0"></th>
                                        <th colspan="2">Bank</th>
                                        <th colspan="2">Cash</th>
                                        <th colspan="1"></th>
                                    </tr>
                                    <tr>
                                        <th class="bg-transparent">S.No</th>
                                        <th class="bg-transparent">Date</th>
                                        <th class="bg-transparent ">Voucher No</th>
                                        <th class="bg-transparent ">Account on</th>
                                        <th class="bg-transparent ">Trans. Type</th>
                                        <th class="bg-transparent ">Main Ledger</th>
                                        <th class="bg-transparent ">Sub Ledger</th>
                                        <th class="bg-transparent ">Narration</th>
                                        <th class="bg-transparent ">Paymode</th>
                                        <th class="bg-transparent ">Debit</th>
                                        <th class="bg-transparent ">Credit</th>
                                        <th class="bg-transparent ">Debit</th>
                                        <th class="bg-transparent ">Credit</th>
                                        <th class="bg-transparent ">Print</th>
                                    </tr>
                                    @php
                                        $i = 1;
                                        $a_cash_dedit = 0;
                                        $a_cash_credit = 0;
                                        $a_bank_dedit = 0;
                                        $a_bank_credit = 0;
                                        $a_cash_dedit_total = 0;
                                        $a_cash_credit_total = 0;
                                        $a_bank_dedit_total = 0;
                                        $a_bank_credit_total = 0;
                                    @endphp
                                    @if (isset($admin_accounts))
                                        @foreach ($admin_accounts as $admin)
                                            <?php
                                            if ($admin->transaction_type == 1) {
                                                $trans_type = 'Income';
                                            } else {
                                                $trans_type = 'Expense';
                                            }
                                            
                                            if ($admin->account_on == 1) {
                                                $account_on = 'GL';
                                            } else {
                                                $account_on = 'MV';
                                            }
                                            
                                            if ($admin->pay_mode == 1) {
                                                $paymode = 'Cash';
                                            }
                                            if ($admin->pay_mode == 2) {
                                                $paymode = 'Cheque';
                                            }
                                            if ($admin->pay_mode == 3) {
                                                $paymode = 'DD';
                                            }
                                            if ($admin->pay_mode == 4) {
                                                $paymode = 'Online Transfer';
                                            }
                                            if ($admin->pay_mode == 5) {
                                                $paymode = 'Cash Deposite';
                                            }
                                            
                                             if ($admin->pay_mode == 1) {
                                                if ($admin->transaction_type == 1) {
                                                    $a_cash_dedit = $admin->amount;
                                                    $a_cash_credit = 0;
                                                    $a_bank_dedit = 0;
                                                    $a_bank_credit = 0;
                                                } else {
                                                    $a_cash_credit = $admin->amount;
                                                    $a_cash_dedit = 0;
                                                    $a_bank_dedit = 0;
                                                    $a_bank_credit = 0;
                                                }
                                            } else {
                                                if ($admin->transaction_type == 1) {
                                                    $a_bank_dedit = $admin->amount;
                                                    $a_bank_credit = 0;
                                                    $a_cash_dedit = 0;
                                                    $a_cash_credit = 0;
                                                } else {
                                                    $a_bank_credit = $admin->amount;
                                                    $a_bank_dedit = 0;
                                                    $a_cash_dedit = 0;
                                                    $a_cash_credit = 0;
                                                }
                                            }
                                            $a_cash_dedit_total = $a_cash_dedit_total + $a_cash_dedit;
                                            $a_cash_credit_total = $a_cash_credit_total + $a_cash_credit;
                                            $a_bank_dedit_total = $a_bank_dedit_total + $a_bank_dedit;
                                            $a_bank_credit_total = $a_bank_credit_total + $a_bank_credit;
                                            
                                            ?>
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ date('d-m-Y', strtotime($admin->voucher_date)) }}</td>
                                                <td>{{ $admin->transaction_no }}</td>
                                                <td>{{ $account_on }}</td>
                                                <td>{{ $trans_type }}</td>
                                                <td>{{ $admin->main_ledger }}</td>
                                                <td>{{ $admin->sub_ledger }}</td>
                                                <td>{{ $admin->narration }}</td>
                                                <td>{{ $paymode }}</td>
                                                <td>{{ number_format($a_bank_credit, 2) }}</td>
                                                <td>{{ number_format($a_bank_dedit, 2) }}</td>
                                                <td>{{ number_format($a_cash_credit, 2) }}</td>
                                                <td>{{ number_format($a_cash_dedit, 2) }}</td>
                                                <td>
                                                    <a class="btn-info border-0 me-1 btnprn"
                                                        href="{{ url('/voucher_print/' . $admin->id) }}"
                                                        style="padding: 4px;width:30px ; border-radius:5px;">
                                                        <i class="fa fa-print" data-bs-toggle="tooltip" title=""
                                                            data-bs-original-title="Print" aria-label="Print"></i>
                                                    </a>
                                                    {{-- <a class="btn-danger border-0 me-1 btnprn" href="#"
                                                        style="padding: 4px;width:30px ; border-radius:5px;">
                                                        <i class="fa fa-print" data-bs-toggle="tooltip" title=""
                                                            data-bs-original-title="Print" aria-label="Print"></i>
                                                    </a> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    <tr>
                                        <td colspan="9">
                                            <h6 class="text-end fw-bold">Total :</h6>
                                        </td>
                                        <td>
                                            <h6 class="fw-bold">{{ number_format($a_bank_credit_total, 2) }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="fw-bold">{{ number_format($a_bank_dedit_total, 2) }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="fw-bold">{{ number_format($a_cash_credit_total, 2) }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="fw-bold">{{ number_format($a_cash_dedit_total, 2) }}</h6>
                                        </td>
                                        <td colspan="2"></td>
                                     <!-- <tr>
                                        <td>1</td>
                                        <td>786</td>
                                        <td>Income</td>
                                        <td>Sales Advance -1</td>
                                        <td>PRS Project plot nos</td>
                                        <td>By Cash</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>100,000.00</td>
                                        <td>100,000.00</td>
                                        <td>
                                            <a class="btn-info border-0 me-1 btnprn" href="#"
                                                style="padding: 4px;width:30px ; border-radius:5px;">
                                                <i class="fa fa-print" data-bs-toggle="tooltip" title=""
                                                    data-bs-original-title="Print" aria-label="Print"></i>
                                            </a>
                                            <a class="btn-danger border-0 me-1 btnprn" href="#"
                                                style="padding: 4px;width:30px ; border-radius:5px;">
                                                <i class="fa fa-print" data-bs-toggle="tooltip" title=""
                                                    data-bs-original-title="Print" aria-label="Print"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">
                                            <h6 class="text-end fw-bold">Total :</h6>
                                        </td>
                                        <td>
                                            <h6 class="fw-bold">0.00</h6>
                                        </td>
                                        <td>
                                            <h6 class="fw-bold">0.00</h6>
                                        </td>
                                        <td>
                                            <h6 class="fw-bold">100,000</h6>
                                        </td>
                                        <td>
                                            <h6 class="fw-bold">100,000</h6>
                                        </td>
                                    </tr>
                                </tbody> -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $("#Day_close_bookForm").submit(function(e) {
            e.preventDefault();
            var form = $("#Day_close_bookForm")[0];
            var url = $("#url").val();
            var formData = new FormData(form);
            $.ajax({
                url: url,
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == true) {
                        swal("Created!", data.message, "success");
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }
                },
                error: function(xhr) {
                    $(".err").html("");
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $("." + key).append(
                            '<div class="err text-danger">' + value + "</div>"
                        );
                    });
                },
            });
        });
    </script>
@endsection
