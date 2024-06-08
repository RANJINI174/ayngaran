@extends('layouts.app')
@section('content')
    <div class="row row-sm mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add Voucher Detail</div>
                </div>
                <form id="account_voucher_entry_add" autocomplete="off">
                <div class="card-body">
                    
                        <div class="row">
                             <div class="col-md-4">
                                <label class="form-label ">Voucher Date <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" type="date" name="voucher_date"
                                        id="voucher_date" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <span style="display:none" class="text-danger" id="voucher_date_validation">Voucher Date Field is
                                    Required</span>
                            </div>
                            @if(Auth::user()->designation_id != 11)
                             <div class="col-md-4">
                                <label class="form-label  ">Account On <span class="text-red">*</span></label>
                                <select name="account_on" id="account_on" class="form-control SlectBox">
                                    <option value="">Select  </option>
                                    <option value="1">GL</option>
                                    <option value="2">MV</option>
                                </select>
                                <span id="account_on_validation" class="text-danger" style="display:none;">Account On
                                    Field is Required</span>
                            </div>
                            @endif
                            <div class="col-md-4">
                                <label class="form-label  ">Voucher Type <span class="text-red">*</span></label>
                                <select name="voucher_type" id="voucher_type" class="form-control SlectBox">
                                    <option value="">Select Voucher Type</option>
                                    <option value="1">Regular</option>
                                    <option value="2">Suspense</option>
                                    <option value="3">Admin</option>
                                </select>
                                <span id="voucher_type_validation" class="text-danger" style="display:none;">Voucher Type
                                    Field
                                    is Required</span>
                            </div>
                            
                             <div class="col-md-4">
                                <label class="form-label ">Transaction Type <span class="text-red">*</span></label>
                                <select name="transaction_type" id="transaction_type" class="form-control SlectBox">
                                    <option value="">Select Transaction Type</option>
                                    <option value="1">Income</option>
                                    <option value="2">Expense</option>
                                </select>
                                <span id="transaction_type_validation" class="text-danger" style="display:none;">Transaction
                                    Type Field is Required</span>
                            </div>
                            <div class="col-md-4" style="display:none">
                                <label class="form-label  ">Account For </label>
                                <select name="account_for" id="account_for" class="form-control SlectBox">
                                    <option value="">Select Ledger</option>
                                    @if(isset($users))
                                    @foreach($users as $val)
                                    <option value="{{ $val->id}} ">{{ $val->name}}</option>
                                    @endforeach
                                    @endif
                                 </select>
                                <span id="account_for_validation" class="text-danger" style="display:none;">Account For
                                    Field is Required</span>
                            </div>
                            <div class="col-md-4" id="main_ledger_div">
                                <label class="form-label  ">Main Ledger <span class="text-red">*</span></label>
                                <select name="main_ledger" id="main_ledger" class="form-control SlectBox">
                                    <option value="">Select Main Ledger</option>
                                     @if(isset($main_ledger))
                                    @foreach($main_ledger as $val)
                                    <option value="{{ $val->id}} ">{{ $val->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <span id="main_ledger_validation" class="text-danger" style="display:none;">Team
                                    Field is Required</span>
                            </div>
                           
                        
                             <div class="col-md-4" id="sub_ledger_div">
                                <label class="form-label">Sub Ledger <span class="text-red">*</span></label>
                                 <select name="sub_ledger" id="sub_ledger" class="form-control SlectBox">
                                    <option value="">Select Sub Ledger</option>
                                    <!-- @if(isset($sub_ledger))-->
                                    <!--@foreach($sub_ledger as $val)-->
                                    <!--<option value="{{ $val->id}} ">{{ $val->name}}</option>-->
                                    <!--@endforeach-->
                                    <!--@endif-->
                                </select>
                                <span id="sub_ledger_validation" class="text-danger" style="display:none;">Select
                                    Type Field is Required</span>
                            </div>
                            
                            <div class="col-md-4" id="purpose_div" style="display:none">
                                <label class="form-label">Purpose <span class="text-red">*</span></label>
                                 <textarea name="purpose" id="purpose" cols="30" rows="2" class="form-control"></textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Branch <span class="text-red">*</span></label>
                                <select name="branch" id="branch" class="form-control SlectBox">
                                    <!--<option value="">Select Branch</option>-->
                                    @if(isset($branch))
                                    @foreach($branch as $val)
                                    <option value="{{ $val->id }} ">{{ $val->branch_name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <span id="branch_validation" class="text-danger" style="display:none;">Branch
                                    Field is Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Amount <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="amount" id="suspense_amount" placeholder="0.00">
                                <span id="amount_validation" class="text-danger" style="display:none;">Amount
                                    Field is Required</span>
                                    
                            </div>
                            
                       
                            <div class="col-md-2">
                                <label class="form-label">TDS % </label>
                                <input type="text" class="form-control" name="tds" id="tds"
                                    placeholder="0.00">
                                <span id="tds_validation" class="text-danger" style="display:none;">TDS
                                    Field is Required</span>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">RS </label>
                                <input type="text" class="form-control" name="rs" id="rs"
                                    placeholder="0.00">
                                <span id="rs_validation" class="text-danger" style="display:none;">RS
                                    Field is Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Pay Mode <span class="text-red">*</span></label>
                                <select name="pay_mode" id="pay_mode" class="form-control SlectBox">
                                    <option value="">Select Pay Mode</option>
                                    <option value="1">Cash</option>
                                    <option value="2">Cheque</option>
                                    <option value="3">DD</option>
                                    <option value="4">Online Transfer</option>
                                    <option value="5">Cash Deposit</option>
                                </select>
                                <span id="pay_mode_validation" class="text-danger" style="display:none;">Pay Mode
                                    Type Field is Required</span>
                            </div>
                            <!-- check -->
                            <div class="col-md-4" id="cheque_no_div" style="display:none">
                                <label class="form-label">Cheque No <span class="text-red"></span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="cheque_no" id="cheque_no"
                                        placeholder="Cheque No">
                                </div>
                            </div>
                            <div class="col-md-4" id="cheque_date_div" style="display:none">
                                <label class="form-label">Cheque Date <span class="text-red"></span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" placeholder="MM/DD/YYYY"
                                        type="date" name="cheque_date" id="cheque_date">
                                </div>
                            </div>
                            <!-- dd-->
                            <div class="col-md-4" id="dd_no_div" style="display:none">
                                <label class="form-label">DD No <span class="text-red"></span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="dd_no" id="dd_no"
                                        placeholder="DD No">
                                </div>
                            </div>


                            <div class="col-md-4" id="dd_date_div" style="display:none">
                                <label class="form-label">DD Date <span class="text-red"></span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" placeholder="MM/DD/YYYY"
                                        type="date" name="dd_date" id="dd_date">
                                </div>
                            </div>
                            <!-- online transfer -->
                            <div class="col-md-4" id="online_trans_no_div" style="display:none">
                                <label class="form-label">Online Transfer No<span class="text-red"></span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="online_trans_no"
                                        id="online_trans_no" placeholder="Online Transfer No">
                                </div>
                            </div>


                            <div class="col-md-4" id="online_trans_date_div" style="display:none">
                                <label class="form-label">Online Transfer Date<span class="text-red"></span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" placeholder="MM/DD/YYYY"
                                        type="date" name="online_trans_date" id="online_trans_date">
                                </div>
                            </div>
                            <!-- transfer -->
                            <div class="col-md-4" id="transfer_no_div" style="display:none">
                                <label class="form-label">Transfer No<span class="text-red"></span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="transfer_no" id="transfer_no"
                                        placeholder="Transfer No">
                                </div>
                            </div>


                            <div class="col-md-4" id="transfer_date_div" style="display:none">
                                <label class="form-label">Transfer Date<span class="text-red"></span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" placeholder="MM/DD/YYYY"
                                        type="date" name="transfer_date" id="transfer_date">
                                </div>
                            </div>
                            <div class="col-md-4" id="bank_name_div" style="display:none">
                                <label class="form-label">Bank Name </label>
                                <div class="input-group">

                                    <select name="bank_name" id="bank_name" class="form-control SlectBox">
                                        <option value="">Select Bank</option>
                                        @if (isset($banks))
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }} ">{{ $bank->bank_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" id="bank_branch_div" style="display:none">
                                <label class="form-label">Bank Branch </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="bank_branch" id="bank_branch"
                                        placeholder="Bank Branch">
                                </div>
                            </div>

                            <div class="col-md-4" id="account_no_div" style="display:none">
                                <label class="form-label">Account No</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="account_no" id="account_no"
                                        placeholder="Account No">
                                </div>
                            </div>

                            <div class="col-md-4" id="ifsc_code_div" style="display:none">
                                <label class="form-label">IFSC Code</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="ifsc_code" id="ifsc_code"
                                        placeholder="IFSC Code">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label mt-0">Narration <span class="text-red">*</span></label>
                                <textarea name="narration" id="narration" cols="30" rows="3" class="form-control"></textarea>
                                <span id="narration_validation" class="text-danger" style="display:none;">Narration
                                    Field is Required</span>
                            </div>
                        </div>
                        <div class="row p-3">
                            <div class="col-md-4">

                                <button type="submit" class="btn btn-primary me-2">Add</button>
                                <a class="btn btn-light" href="{{ url('account-voucher-entry') }}">Cancel</a>

                            </div>
                        </div>
                    
                    <!-- <div class="row p-3">
                                            <div class="table-responsive mt-3">
                                                <table id="LegalDocumentAbstract_Lists"
                                                    class="table table-bordered text-nowrap text-center mb-0">
                                                    <thead class="border text-center">
                                                        <tr>
                                                            <th colspan="7" class="border-left-0"></th>
                                                            <th colspan="2">Bank</th>
                                                            <th colspan="2">Cash</th>
                                                            <th colspan="1"></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="bg-transparent">S.No</th>
                                                            <th class="bg-transparent ">Voucher #</th>
                                                            <th class="bg-transparent ">Trans. Type</th>
                                                            <th class="bg-transparent ">Ledger Name</th>
                                                            <th class="bg-transparent ">Narration</th>
                                                            <th class="bg-transparent ">Description</th>
                                                            <th class="bg-transparent ">Paymode</th>
                                                            <th class="bg-transparent ">Debit</th>
                                                            <th class="bg-transparent ">Credit</th>
                                                            <th class="bg-transparent ">Debit</th>
                                                            <th class="bg-transparent ">Credit</th>
                                                            <th class="bg-transparent ">Print</th>
                                                        </tr>
                                                        <tr>

                                                            <th colspan="1" class="bg-transparent"></th>
                                                            <th class="bg-transparent">
                                                                <input type="text" id="search_voucher" class="form-control">
                                                            </th>
                                                            <th class="bg-transparent">
                                                                <select id="search_trans_type" class="form-control SlectBox">
                                                                    <option value="">Select</option>
                                                                    <option value="1">Income</option>
                                                                    <option value="2">Expense</option>
                                                                </select>
                                                            </th>
                                                            <th class="bg-transparent">
                                                                <input type="text" id="search_legder_name" class="form-control">
                                                            </th>
                                                            <th class="bg-transparent">
                                                                <input type="text" id="search_narration" class="form-control">
                                                            </th>
                                                            <th class="bg-transparent">
                                                                <input type="text" id="search_description" class="form-control">
                                                            </th>
                                                            <th class="bg-transparent">
                                                                <select id="search_pay_mode" class="form-control SlectBox">
                                                                    <option value="">Select</option>
                                                                    <option value="1">Cash</option>
                                                                    <option value="2">Cheque</option>
                                                                    <option value="3">DD</option>
                                                                    <option value="4">Online Transfer</option>
                                                                    <option value="5">Cash Deposit</option>
                                                                </select>
                                                            </th>
                                                            <th class="bg-transparent">
                                                                <input type="text" id="search_bank_debit" class="form-control">
                                                            </th>
                                                            <th class="bg-transparent">
                                                                <input type="text" id="search_bank_credit" class="form-control">
                                                            </th>
                                                            <th class="bg-transparent">
                                                                <input type="text" id="search_cash_debit" class="form-control">
                                                            </th>
                                                            <th class="bg-transparent" class="border-left-0">
                                                                <input type="text" id="search_cash_credit" class="form-control">
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="border">
                                                        <tr>
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
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> -->
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
