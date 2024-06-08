@extends('layouts.app')
@section('content')
    <div class="row row-sm mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Voucher Details</h3>
                             @php
                                $permission = new \App\Models\Permission();
                               $create_check = $permission->checkPermission('voucherentry.create');
                               $edit_check = $permission->checkPermission('voucherentry.edit');
                               $print_check = $permission->checkPermission('voucherentry.print');
                                 @endphp
                           @if($create_check == 1)    
                    <a class="btn-primary add_master_btn" href="{{ route('account-voucher-entry-add') }}">Add New</a>
                          @endif
                </div>
                <div class="card-body">
                    <div class="container">
                         <div class="table-wrapper-scroll-y my-custom-scrollbar">
                            <div class="table-responsive mt-3" style="overflow-y: auto; height:480px;">
                                <table id="Voucher_entry_Lists" class="table table-bordered table-striped mb-0" cellspacing="0" style="width:100%">
                                    <thead class="border text-center">
                                        <tr>
                                            <th @if(Auth::user()->designation_id != 11) colspan="9" @else colspan="8"  @endif class="border-left-0"></th>
                                            <th colspan="2">Bank</th>
                                            <th colspan="2">Cash</th>
                                            
                                            <th colspan="1"></th>
                                        </tr>
                                        <tr>
                                            <th class="bg-transparent" style="width:5% !important;">S.No</th>
                                            <th class="bg-transparent" style="width:10% !important;">Date</th>
                                            <th class="bg-transparent" style="width:5% !important;">Voucher No</th>
                                            @if(Auth::user()->designation_id != 11)
                                            <th class="bg-transparent" style="width:5% !important;">Account<br>on</th>
                                            @endif
                                            <th class="bg-transparent" style="width:5% !important;">Trans. Type</th>
                                            <th class="bg-transparent" style="width:5% !important;">Main Ledger</th>
                                            <th class="bg-transparent" style="width:10% !important;">Sub Ledger</th>
                                            <th class="bg-transparent" style="width:20% !important;">Narration</th>
                                            <th class="bg-transparent" style="width:10% !important;">Paymode</th>
                                            <th class="bg-transparent" style="width:5% !important;">Debit</th>
                                            <th class="bg-transparent" style="width:5% !important;">Credit</th>
                                            <th class="bg-transparent" style="width:5% !important;">Debit</th>
                                            <th class="bg-transparent" style="width:5% !important;">Credit</th>
                                            <th class="bg-transparent" style="width:5% !important;">Action</th>
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
                                                    @if(Auth::user()->designation_id != 11)
                                                    <td>{{ $account_on }}</td>
                                                    @endif
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
                                                        @if($edit_check == 1)   
                                                        <a class="btn-primary border-0 me-1"
                                                href="{{ url('/') }}/account-voucher-entry-edit/{{ $account->id }}/edit"
                                                style="padding: 4px; border-radius:5px;">
                                                <i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="12"
                                                        viewBox="0 0 24 24" width="12">
                                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                                        <path
                                                            d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z" />
                                                    </svg></i>
                                            </a><br><br>
                                            @endif
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
                                         @if(Auth::user()->designation_id != 11)
                                        <tr>
                                            <td colspan="15" style="text-align:center"> No Data Found</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td colspan="14" style="text-align:center"> No Data Found</td>
                                        </tr>
                                        @endif
                                        
                                        @endif
                                        <tr>
                                            
                                            <td @if(Auth::user()->designation_id != 11) colspan="9" @else colspan="8" @endif>
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
