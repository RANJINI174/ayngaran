@extends('layouts.app')
@section('content')
    <!-- PAGE-HEADER END -->
    <div class="row row-sm mt-2">
        <div class="col-lg-12">
             <form id="Edit_plotbookinForm"  autocomplete="off">
                    @csrf
                        @method('POST')
            <div class="card" style="padding:8px !important;">
                <div class="card-header">
                    <div class="card-title">Plot Summary</div>
                </div>
                
                <div class="card-body">
                 
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Project <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="hidden" id="booking_id" value="{{ $booking->id }}">
                                  <select name="project_id" id="project_id" class="form-control SlectBox">
                                        <option value="">Select Project</option>
                                        @if (isset($projects))
                                            @foreach ($projects as $pro)
                                                <option value="{{ $pro->id }}" @if($booking->project_id == $pro->id) {{"selected"}} @endif>{{ $pro->short_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                               <span style="display:none" class="text-danger" id="project_validation">Project Field is
                                    Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Plot No <span class="text-red">*</span></label>
                                <div class="input-group">
                                   <select name="plot_id" id="booking_plot_id" class="form-control SlectBox ">
                                        <option value="">Select Plot No</option>
                                         @if (isset($plots))
                                            @foreach ($plots as $plot)
                                             <option value="{{ $plot->id }}" @if($booking->plot_id == $plot->id) {{"selected"}} @endif>{{ $plot->plot_no }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <span style="display:none" class="text-danger" id="plot_validation">Plot No Field is
                                    Required</span>
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label">Plan <span class="text-red">*</span></label>
                                <div class="input-group">
                                   <select name="plan" id="plan" class="form-control SlectBox " >
                                        <option value="">Select Plan</option>
                                        <option value="1" @if($booking->plan == 1) {{"selected"}} @endif>Plan A</option>
                                        <option value="2" @if($booking->plan == 2) {{"selected"}} @endif>Plan B</option>
                                        <option value="3" @if($booking->plan == 3) {{"selected"}} @endif>Plan C</option>
                                        
                                    </select>
                                </div>
                                <span style="display:none" class="text-danger" id="plot_validation">Plot No Field is
                                    Required</span>
                                    
                                    <input type="hidden" class="form-control"  value="{{ $booking->plan }}" name="plan_id" id="plan_id"
                                       >
                            </div>
                            
                             <div class="col-md-4">
                                <label class="form-label">Guide Line Sq.Ft Rate <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly value="{{ $booking->guide_line_sqft }}" name="guide_line_sqft_rate" id="guide_line_sqft_rate"
                                        placeholder="Guide Line Sq.Ft Rate">
                                </div>
                                 <span style="display:none" class="text-danger" id="guide_line_sqft_rate_validation">Guide Line Sq.Ft Rate Field is
                                    Required</span>

                            </div>
                            @if(Auth::user()->designation_id != 11)
                             <div class="col-md-4">
                                <label class="form-label">Market Sq.ft Rate<span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly value="{{ $booking->market_value_sqft }}" name="market_sqft_rate" id="market_sqft_rate"
                                        placeholder="Market Sq.ft Rate">
                                </div>
                                 <span style="display:none" class="text-danger" id="market_sqft_rate_validation">Market Sq.ft Rate Field is
                                    Required</span>

                            </div>
                            @endif
                           
                            
                            
                            <!--<div class="col-md-4">-->
                            <!--    <label class="form-label">Sq.Ft Rate <span class="text-red">*</span></label>-->
                            <!--    <div class="input-group">-->
                            <!--        <input type="text" class="form-control" readonly value="{{ $booking->sqft_rate }}" name="sqft_rate" id="sqft_rate"-->
                            <!--            placeholder="Sq.Ft Rate">-->
                            <!--    </div>-->
                            <!--     <span style="display:none" class="text-danger" id="sqft_rate_validation">Sq.Ft Rate Field is-->
                            <!--        Required</span>-->

                            <!--</div>-->
                            
                              <div class="col-md-4">
                                <label class="form-label">Plot Size <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ $booking->plot_size_sqft }}" readonly name="plot_size_sqft" id="plot_size_sqft"
                                        placeholder="Plot Size Sq.Ft"><div class="input-group-text">
                                        / Sq.Ft
                                    </div>
                                    </div>
                                    <br>
                                    <div class="input-group">
                                    <input type="text" class="form-control" value="{{ $booking->plot_size_cent }}" readonly name="plot_size_cent" id="plot_size_cent"
                                        placeholder="Plot Size Cent"><div class="input-group-text">
                                        / Cents
                                    </div>
                                </div>
                                 <!--<span style="display:none" class="text-danger" id="sqft_rate_validation">Plot Size Field is-->
                                 <!--   Required</span>-->

                            </div>
                            
                            
                             <div class="col-md-4">
                                <label class="form-label">Total Value (GL) <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly value="{{ $booking->total_value_gl }}" name="total_value_gl" id="total_value_gl"
                                        placeholder="Total Value">
                                </div>
                                 <span style="display:none" class="text-danger" id="total_value_gl_validation">Total Value Field is
                                    Required</span>

                            </div>
                            @if(Auth::user()->designation_id != 11)
                            <div class="col-md-4">
                                <label class="form-label">Total Value (MV) <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly value="{{ $booking->total_value_mv }}" name="total_value_mv" id="total_value_mv"
                                        placeholder="Total Value">
                                </div>
                                 <span style="display:none" class="text-danger" id="total_value_mv_validation">Total Value Field is
                                    Required</span>

                            </div>
                            @endif
                            
                            
                            <!--  <div class="col-md-4">-->
                            <!--    <label class="form-label">Payable ( MV) <span class="text-red">*</span></label>-->
                            <!--    <div class="input-group">-->
                            <!--        <input type="text" class="form-control" readonly value="{{ $booking->payable }}" name="payable" id="payable"-->
                            <!--            placeholder="Payable ( MV)">-->
                            <!--    </div>-->
                            <!--     <span style="display:none" class="text-danger" id="payable_validation">Payable ( MV) Field is-->
                            <!--        Required</span>-->

                            <!--</div>-->
                            @if(Auth::user()->designation_id != 11)
                              <div class="col-md-4">
                                <label class="form-label">Balance <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ $booking->balance }}" name="balance" id="balance"
                                        placeholder="Balance">
                                </div>
                                 <span style="display:none" class="text-danger" id="balance_validation">Balance Field is
                                    Required</span>

                            </div>
                            @endif
                            
                              <div class="col-md-4">
                                <label class="form-label">Description </label>
                                <div class="input-group">
                                  <textarea class="form-control" placeholder="Description" readonly name="description" id="description" rows="3">{{ $booking->description }}</textarea>
                                </div>
                                 <span style="display:none" class="text-danger" id="description_validation">Description Field is
                                    Required</span>

                            </div>
                        </div>
                  
                       
                   
                </div>
                 
            </div>
            <div class="card" style="padding:8px !important;">
                <div class="card-header">
                    <div class="card-title">Payment Details</div>
                </div>
                
                <div class="card-body">
                 
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Receipt Date <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" value="<?php echo $booking->receipt_date; ?>"
                                        type="date" name="receipt_date" id="receipt_date">
                                 </div>
                               <span style="display:none" class="text-danger" id="receipt_date_validation">Receipt Date Field is
                                    Required</span>
                            </div>
                              <div class="col-md-4">
                                <label class="form-label">Registration Due Date <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" value="<?php echo $booking->registration_due_date; ?>"
                                        type="date" name="registration_due_date" id="registration_due_date">
                                        
                                        <input class="form-control "  
                                        type="hidden" name="registration_due_days" id="registration_due_days" value="<?php echo $booking->registration_due_days; ?>">
                                 </div>
                               <span style="display:none" class="text-danger" id="registration_due_date_validation">Registration Due Date Field is
                                    Required</span>
                            </div>
                            
                             <div class="col-md-4">
                                <label class="form-label">Booking Open <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" value="<?php echo $booking->booking_open_date; ?>"
                                        type="date" name="booking_open_date" id="booking_open_date">
                                        
                                        <input class="form-control  "  
                                        type="hidden" name="booking_open_days" id="booking_open_days" value="<?php echo $booking->booking_open_days; ?>">
                                 </div>
                               <span style="display:none" class="text-danger" id="booking_open_date_validation">Booking Open Field is
                                    Required</span>
                            </div>
                            
                             <div class="col-md-4">
                                <label class="form-label">Company Scope <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" value="<?php echo $booking->company_scope; ?>"
                                        type="date" name="company_scope" id="company_scope">
                                        <input class="form-control  "  
                                        type="hidden" name="company_scope_days" id="company_scope_days" value="<?php echo $booking->company_scope_days; ?>">
                                 </div>
                               <span style="display:none" class="text-danger" id="company_scope_validation">Company Scope Field is
                                    Required</span>
                            </div>
                            
                             <div class="col-md-4">
                                <label class="form-label">Customer Scope <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" value="<?php echo $booking->customer_scope; ?>"
                                        type="date" name="customer_scope" id="customer_scope">
                                        <input class="form-control fc-datepicker"  
                                        type="hidden" name="customer_scope_days" id="customer_scope_days" value="<?php echo $booking->customer_scope_days; ?>">
                                 </div>
                               <span style="display:none" class="text-danger" id="customer_scope_validation">Customer Scope Field is
                                    Required</span>
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label">Amount <span class="text-red">*</span></label>
                                <div class="input-group">
                                 <input type="text" class="form-control" name="amount" value="{{ $booking->amount }}" id="booking_amount"
                                        placeholder="Amount">
                                <input type="hidden" class="form-control" value="{{ $booking->amount }}" name="old_amount" id="old_amount"
                                        placeholder="Amount">
                                </div>
                                <span style="display:none" class="text-danger" id="amount_validation">Amount Field is
                                    Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Pay Mode <span class="text-red">*</span></label>
                                <div class="input-group">
                                   <select name="pay_mode" id="pay_mode" class="form-control SlectBox">
                                        <option value="">Select Pay Mode</option>
                                        <option value="1" @if($booking->pay_mode == 1) {{"selected"}} @endif>Cash</option>
                                        <option value="2" @if($booking->pay_mode == 2) {{"selected"}} @endif>Cheque</option>
                                        <option value="3" @if($booking->pay_mode == 3) {{"selected"}} @endif>DD</option>
                                        <option value="4" @if($booking->pay_mode == 4) {{"selected"}} @endif>Online Transfer</option>
                                        <option value="5" @if($booking->pay_mode == 5) {{"selected"}} @endif>Cash Deposit</option>
                                    </select>
                                </div>
                                 <span style="display:none" class="text-danger" id="pay_mode_validation">Pay Mode Field is
                                    Required</span>

                            </div>
                            
                             <div class="col-md-4" id="dd_no_div" <?php if($booking->pay_mode != 3){ ?> style="display:none" <?php } else { ?> 
                              style="display:block" <?php } ?> >
                                <label class="form-label">DD No <span class="text-red"></span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ $booking->dd_no }}" name="dd_no" id="dd_no"
                                        placeholder="DD No">
                                </div>
                                </div>
                                
                                
                                 <div class="col-md-4" id="dd_date_div" <?php if($booking->pay_mode != 3){ ?> style="display:none" <?php } else { ?> 
                              style="display:block" <?php } ?> >
                                <label class="form-label">DD Date <span class="text-red"></span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" value="{{ $booking->dd_date }}" 
                                        type="date" name="dd_date" id="dd_date">
                                </div>
                                </div>
                                
                            
                                      <div class="col-md-4" id="cheque_no_div" <?php if($booking->pay_mode != 2){ ?> style="display:none" <?php } else { ?> 
                              style="display:block" <?php } ?> >
                                <label class="form-label">Cheque No <span class="text-red"></span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ $booking->cheque_no }}" name="cheque_no" id="cheque_no"
                                        placeholder="Cheque No">
                                </div>
                                </div>
                                
                                
                                <div class="col-md-4" id="cheque_date_div" <?php if($booking->pay_mode != 2){ ?> style="display:none" <?php } else { ?> 
                              style="display:block" <?php } ?>>
                                <label class="form-label">Cheque Date <span class="text-red"></span></label>
                                <div class="input-group">
                                  <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" value="{{ $booking->cheque_date }}"  
                                        type="date" name="cheque_date" id="cheque_date">
                                </div>
                                </div>
                                
                                 <div class="col-md-4" id="online_trans_no_div" <?php if($booking->pay_mode != 4){ ?> style="display:none" <?php } else { ?> 
                              style="display:block" <?php } ?>>
                                <label class="form-label">Online Transfer No<span class="text-red"></span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ $booking->online_trans_no }}"  name="online_trans_no" id="online_trans_no"
                                        placeholder="Online Transfer No">
                                </div>
                                </div>
                                
                                
                                 <div class="col-md-4" id="online_trans_date_div" <?php if($booking->pay_mode != 4){ ?> style="display:none" <?php } else { ?> 
                              style="display:block" <?php } ?>>
                                <label class="form-label">Online Transfer Date<span class="text-red"></span></label>
                                <div class="input-group">
                                 <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" value="{{ $booking->online_trans_date }}" placeholder="MM/DD/YYYY"
                                        type="date" name="online_trans_date" id="online_trans_date">
                                </div>
                                </div>
                                
                                
                                <div class="col-md-4" id="transfer_no_div" <?php if($booking->pay_mode != 5){ ?> style="display:none" <?php } else { ?> 
                              style="display:block" <?php } ?>>
                                <label class="form-label">Transfer No<span class="text-red"></span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ $booking->transfer_no }}"  name="transfer_no" id="transfer_no"
                                        placeholder="Transfer No">
                                </div>
                                </div>
                                
                                
                                 <div class="col-md-4" id="transfer_date_div" <?php if($booking->pay_mode != 5){ ?> style="display:none" <?php } else { ?> 
                              style="display:block" <?php } ?>>
                                <label class="form-label">Transfer Date<span class="text-red"></span></label>
                                <div class="input-group">
                                  <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" value="{{ $booking->trans_date }}" placeholder="MM/DD/YYYY"
                                        type="date" name="trans_date" id="trans_date">
                                </div>
                                </div>
                         
                              <div class="col-md-4" id="bank_name_div" <?php if($booking->pay_mode == 3 || $booking->pay_mode == 5 || $booking->pay_mode == 4 || $booking->pay_mode == 2)
                              { ?> style="display:block" <?php } else { ?> 
                              style="display:none" <?php } ?>>
                                <label class="form-label">Bank Name </label>
                                <div class="input-group">
                                
                                   <select name="bank_name" id="bank_name" class="form-control SlectBox" >
                                        <option value="">Select Bank</option>
                                        @if (isset($banks))
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }} " @if($booking->bank_name == $bank->id) {{"selected"}} @endif>{{ $bank->bank_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>   
                                </div>
                             </div>
                               <div class="col-md-4" id="bank_branch_div" <?php if($booking->pay_mode == 3 || $booking->pay_mode == 5 || $booking->pay_mode == 4 || $booking->pay_mode == 2){ ?> style="display:block" <?php } else { ?> 
                              style="display:none" <?php } ?>>
                                <label class="form-label">Bank Branch </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="bank_branch" value="{{ $booking->bank_branch }}" id="bank_branch"
                                        placeholder="Bank Branch">
                                </div>
                               
                            </div>
                            
                             <div class="col-md-4" id="account_no_div" <?php if($booking->pay_mode == 3 || $booking->pay_mode == 5 || $booking->pay_mode == 4 || $booking->pay_mode == 2){ ?> style="display:block" <?php } else { ?> 
                              style="display:none" <?php } ?>>
                                <label class="form-label">Account No</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="account_no" value="{{ $booking->account_no }}" id="account_no"
                                        placeholder="Account No">
                                </div>
                               
                            </div>
                           
                             <div class="col-md-4" id="ifsc_code_div" <?php 
                             if($booking->pay_mode == 3 || $booking->pay_mode == 5 || $booking->pay_mode == 4 || $booking->pay_mode == 2) { ?> style="display:block" <?php 
                             } else { ?>   style="display:none" <?php } ?> >
                                <label class="form-label">IFSC Code</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="ifsc_code" value="{{ $booking->ifsc_code }}" id="ifsc_code"
                                        placeholder="IFSC Code">
                                </div>
                               
                            </div>
                             
                    
                          </div>
                   </div>
                 
            </div>
            
              <div class="card" style="padding:8px !important;">
                <div class="card-header">
                    <div class="card-title">Marketer Details</div>
                </div>
                
                <div class="card-body">
                        <?php
                            $marketer_name = '';
                            $marketer_mobile = '';
                            $marketer_ref = '';
                            $designation = '';
                        $market = \App\Models\User::where('users.id',$booking->marketer_id)
                                     ->leftjoin('designation','designation.id','users.designation_id')->select('users.*','designation.designation')->first();
                        if(isset($market))
                        {
                            $marketer_name = $market->name;
                            $marketer_mobile = $market->mobile_no;
                            $marketer_ref = $market->reference_code;
                            $designation = $market->designation;
                            
                        }
                        
                        ?>
                        <div class="row">
                             <div class="col-md-3">
                                <label class="form-label">Marketer ID <span class="text-red">*</span></label>
                                <div class="input-group">
                                     <input type="hidden" class="form-control" name="marketer_id" id="marketer_id" value="{{$booking->marketer_id}}">
                                 <!--<input type="text" class="form-control" value="{{$marketer_ref}}" name="marketer_code" id="marketer_code"-->
                                 <!--       placeholder="Marketer ID">-->
                                   <select name="marketer_code" id="marketer_code" class="form-control SlectBox">
                                   <option value="">Select Marketer</option>
                                        @foreach ($markertes as $val)
                                            <option value="{{ $val->id }}" @if($booking->marketer_id == $val->id) {{ "selected" }} @endif>{{ $val->reference_code }} - {{ $val->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span style="display:none" class="text-danger" id="marketer_id_validation">Marketer ID Field is
                                    Required</span>
                            </div>
                           
                               <div class="col-md-3"  >
                                <label class="form-label"> Name </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly value="{{$marketer_name}}" name="marketer_name" id="marketer_name"
                                        placeholder="Name">
                                  
                                </div>
                             </div>
                               <div class="col-md-3"  >
                                <label class="form-label">Designation </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly value="{{$designation}}" name="designation" id="designation"
                                        placeholder="Designation">
                                </div>
                               
                            </div>
                            
                             <div class="col-md-3"  >
                                <label class="form-label">Mobile No</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly value="{{$marketer_mobile}}" name="marketer_mobile" id="marketer_mobile"
                                        placeholder="Mobile No">
                                </div>
                               
                            </div>
                            			<div class="table-responsive">
                            			    <br>
                            			   
											<table id="marketer_table" class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
												<thead>
													<tr>
														<th>#</th>
														<th>Marketer ID</th>
														<th>Designation</th>
														<th>Name</th>
														<th>Mobile</th>
													</tr>
												</thead>
												<tbody id="tbodyid">
											
												<?php
												if(isset($market->director_id)){
												$get_director_details = \App\Models\User::where('users.id',$market->director_id)
												->leftjoin('designation','designation.id','users.designation_id')->select('users.*','designation.designation')->first();   	    
												 
		                                        ?>
		                                        <tr id="table_row_1" >
												   <td>#</td>
												   <td>{{ $get_director_details->reference_code }}</td>
												   <td>{{ $get_director_details->designation }}</td>
												   <td>{{ $get_director_details->name }}</td>
												   <td>{{ $get_director_details->mobile_no }}</td>
												</tr>
		                                        <?php
		                                        }
		                                         if(isset($market->marketing_manager_id))
		                                         {
		                                           $get_marketing_manager_details = \App\Models\User::where('users.id',$market->marketing_manager_id)
		                                           ->leftjoin('designation','designation.id','users.designation_id')->select('users.*','designation.designation')->first();   
		                                          ?>
		                                             <tr id="table_row_1" >
												   <td>#</td>
												   <td>{{ $get_marketing_manager_details->reference_code }}</td>
												   <td>{{ $get_marketing_manager_details->designation }}</td>
												   <td>{{ $get_marketing_manager_details->name }}</td>
												   <td>{{ $get_marketing_manager_details->mobile_no }}</td>
												</tr>
		                                         <?php
		                                         }
		                                           if(isset($market->marketing_supervisor_id))
		                                         {
		                                           $get_marketing_supervisor_details = \App\Models\User::where('users.id',$market->marketing_supervisor_id)
		                                           ->leftjoin('designation','designation.id','users.designation_id')->select('users.*','designation.designation')->first();   
		                                          ?>
		                                             <tr id="table_row_1" >
												   <td>#</td>
												   <td>{{ $get_marketing_supervisor_details->reference_code }}</td>
												   <td>{{ $get_marketing_supervisor_details->designation }}</td>
												   <td>{{ $get_marketing_supervisor_details->name }}</td>
												   <td>{{ $get_marketing_supervisor_details->mobile_no }}</td>
												</tr>
		                                         <?php
		                                         }
		                                         if(!isset($market->director_id) && !isset($market->marketing_manager_id) && !isset($market->marketing_supervisor_id)){
		                                         ?>
		                                         <tr id="table_row_1" >
												    <td colspan="5" style="text-align:center">No Data Found</td>
												</tr>
												<?php
												}
												?>
		                                       </tbody>
											</table>
										 
						</div>
                             
                          </div>
                   </div>
                 
            </div>
              
              <div class="card" style="padding:8px !important;">
                <div class="card-header">
                    <div class="card-title">Existing Customer</div>
                </div>
                
                <div class="card-body">
                 
                        <div class="row" >
                            <div class="col-md-3" style="display:none">
                                 <label class="form-label">Check if Existing Customer </label>
                                 <div class="input-group">
                                    
                                 	<label class="custom-control custom-checkbox">
									 	<input type="checkbox" class="custom-control-input" <?php if(isset($booking->customer_id)){ echo "checked"; } ?> id="existing" name="existing" value="1">
										 <span class="custom-control-label">is Existing Customer</span></label>
                                </div>
                               
                            </div>
                              <div class="col-md-4">
                                <label class="form-label">Mobile No <span class="text-red">*</span></label>
                                <div class="input-group">
                                  <select name="customer_id" id="customer_id" class="form-control SlectBox">
                                   <option value="">Select</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ !empty($customer->id == $booking->customer_id) ? 'selected' : '' }}>
                                                {{ $customer->mobile }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
                            <?php
                            $customer_name = '';
                            $get_name = \App\Models\Booking::where('id',$booking->customer_id)->first();
                            if(isset($get_name))
                            {
                               $customer_name = $get_name->customer_name; 
                            }
                            ?>
                            <div class="col-md-4">
                                <label class="form-label">Customer Name</label>
                                <div class="input-group">
                                  <input type="text" class="form-control"  value="{{ $customer_name }}" name="existing_cusotmer" id="existing_cusotmer"
                                        placeholder="Customer Name">
                                 </div>
                               
                            </div>
                          
                         
                          </div>
                   </div>
                 
            </div>
           
             
              <div class="card" style="padding:8px !important;" id="customer_details_div">
                <div class="card-header">
                    <div class="card-title">Customer Details</div>
                </div>
                
                <div class="card-body">
                 
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Title </label>
                                <div class="input-group">
                                    <select name="title" id="title" class="form-control SlectBox">
                                        <option value="">Select Title</option>
                                        <option value="1" @if($booking->title == 1) {{"selected"}} @endif>Mr</option>
                                        <option value="2" @if($booking->title == 2) {{"selected"}} @endif>Mrs</option>
                                        <option value="3" @if($booking->title == 3) {{"selected"}} @endif>Miss </option>
                                        <option value="4" @if($booking->title == 4) {{"selected"}} @endif>Dr</option>
                                        <option value="5" @if($booking->title == 5) {{"selected"}} @endif>Prof</option>
                                    </select>
                                 </div>
                               <span style="display:none" class="text-danger" id="title_validation">Title Field is
                                    Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Customer Name <span class="text-red">*</span></label>
                                <div class="input-group">
                                 <input type="text" class="form-control" value="{{$booking->customer_name}}" name="customer_name" id="customer_name"
                                        placeholder="Customer Name">
                                </div>
                                <span style="display:none" class="text-danger" id="customer_name_validation">Customer Name Field is
                                    Required</span>
                            </div>
                            <div class="col-md-1"><br><br>
                                <div class="input-group">
                                   <select name="select" id="select" class="form-control SlectBox">
                                        <option value="">Select</option>
                                        <option value="1" @if($booking->select == 1) {{"selected"}} @endif>S/O</option>
                                        <option value="2" @if($booking->select == 2) {{"selected"}} @endif>D/O</option>
                                        <option value="3" @if($booking->select == 3) {{"selected"}} @endif>W/O</option>
                                        <option value="4" @if($booking->select == 4) {{"selected"}} @endif>C/O</option>
                                       
                                    </select>
                                </div>
                          </div>     
                                <div class="col-md-3"><br><br>
                                <div class="input-group">
                                 <input type="text" class="form-control" value="{{$booking->relation_name}}" name="relation_name" id="relation_name"
                                        placeholder="Name">
                                </div>
                        </div>
                           <div class="col-md-4">
                                <label class="form-label">DOB </label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" max="<?php echo date('Y-m-d'); ?>"
                                        type="date" name="dob" id="dob" value="{{$booking->dob}}">
                                 </div>
                               <span style="display:none" class="text-danger" id="dob_date_validation">DOB Field is
                                    Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Gender</label>
                                <div class="input-group">
                                    <select name="gender" id="gender" class="form-control SlectBox">
                                        <option value="">Select Gender</option>
                                        <option value="1" @if($booking->gender == 1) {{"selected"}} @endif>Male</option>
                                        <option value="0" @if($booking->gender == 0) {{"selected"}} @endif>Female</option>
                                    </select>
                                </div>
                                 
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label">Email  </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{$booking->email}}" name="email" id="email"
                                        placeholder="Email">
                                </div>
                                <!--<span class="text-danger" id="email_name_validation"></span>-->
                                <!--<span style="display:none" class="text-danger" id="email_validation">Email Already-->
                                <!--    Exist</span>-->

                            </div>
                            
                               <div class="col-md-4">
                                <label class="form-label">Mobile No <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{$booking->mobile}}" name="mobile" id="mobile"
                                        placeholder="Mobile No">
                                </div>
                                <span style="display:none" class="text-danger" id="mobile_validation">
                                    Mobile No Field is Required</span>
                           
                            </div>
                             <div class="col-md-4">
                                <label class="form-label">Alternate Mobile </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{$booking->alternate_mobile}}" name="alternate_mobile"
                                        id="alternate_mobile" placeholder="Alternate Mobile">
                                </div>
                            </div>
                            
                             <div class="col-md-4">
                                <label class="form-label">Street </label>
                                <div class="input-group">
                                    <input type="text" class="form-control"  value="{{$booking->street}}"  name="street" id="street"
                                        placeholder="Street">
                                </div>
                               <!--<span style="display:none" class="text-danger" id="street_validation">Street Field is-->
                               <!--     Required</span>-->
                            </div>
                            
                           <div class="col-md-4">
                                <label class="form-label">Pincode </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{$booking->pincode}}" name="pincode" id="pincode"
                                        placeholder="Pincode">
                                </div>
                                 
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Area </label>
                                <div class="input-group">
                                    <select name="area" id="area" class="form-control SlectBox">
                                         <option value="">Select area</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}"
                                                {{ !empty($area->id == $booking->area) ? 'selected' : '' }}>
                                                {{ $area->area }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                 
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">City </label>
                                <div class="input-group">
                                    <select name="city_id" id="city_id" class="form-control SlectBox">
                                         <option value="">Select City</option>
                                        @if(isset($city) && !empty($city))
                                        <option value="{{ $city->id }}" selected>{{ $city->city }}</option>
                                        @endif
                                    </select>
                                </div>
                                 
                            </div>
                            
                              <div class="col-md-4">
                                <label class="form-label">State </label>
                                <div class="input-group">
                                    <select name="state_id" id="state_id" class="form-control SlectBox">
                                        <option value="">Select State</option>
                                         @if(isset($state) && !empty($state))
                                        <option value="{{ $state->id }}" selected>{{ $state->state }}</option>
                                        @endif
                                    </select>
                                </div>
                               
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Country </label>
                                <div class="input-group">
                                    <select name="country_id" id="country_id" class="form-control SlectBox">
                                        <option value="">Select Country</option>
                                        <option value="1" {{ $booking->country == 1 ? 'selected' : '' }}>India
                                        </option>
                                    </select>
                                </div>
                               
                            </div>
                          </div>
                          
                           <br>
                           <div class="row">
                            <div class="col-md-4 mt-3">
                                <button type="submit" class="btn btn-primary me-2" id="edit_booking">Update</button>
                                <a href="{{ url('plot-booking') }}" class="btn btn-light">Cancel</a>
                            </div>
                        </div>
                   </div>
                 
            </div>
            
              <div class="card" style="padding:8px !important;display:none;">
                <div class="card-header">
                    <div class="card-title">Payment Source Details</div>
                </div>
                
                <div class="card-body">
                 
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Payment Source <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="payment_term" id="payment_term" disabled class="form-control SlectBox">
                                        <option value="">Select Payment Source</option>
                                        <option value="1" @if($booking->payment_term == 1) {{"selected"}} @endif>Own Fund</option>
                                        <option value="2" @if($booking->payment_term == 2) {{"selected"}} @endif>Bank Loan</option>
                                     </select>
                                 </div>
                               <span style="display:none" class="text-danger" id="payment_term_validation">Payment Source Field is
                                    Required</span>
                            </div>
                             <div class="col-md-4" id="loan_company_div" @if($booking->payment_term == 1) style="display:none" @else style="display:block" @endif>
                              <label class="form-label">Loan Company <span class="text-red">*</span></label>
                                <div class="input-group">
                                 <input type="text" class="form-control" name="loan_company" id="loan_company"
                                        placeholder="Loan Company" value="{{$booking->loan_company}}">
                                </div>
                                 <span style="display:none" class="text-danger" id="loan_company_validation">Loan Company Field is
                                    Required</span>
                          </div>     
                               
                          </div>
                         
                   </div>
                 
            </div>
            
            </form>
        </div>
    </div>
@endsection

 
@section('scripts')
    <script>
    var customer_id = $('#customer_id').val();
    
    if(customer_id != '')
    {
     $(document).ready(function() {
           $('#customer_id').trigger("change");
      });   
    }
     
     
      $('#receipt_date').on('change', function() {  

  var registration_due_days = parseInt($("#registration_due_days").val());
  var targetDate = new Date($("#receipt_date").val());
  targetDate.setDate(targetDate.getDate() + registration_due_days);
  month = '' + (targetDate.getMonth() + 1),
        day = '' + targetDate.getDate(),
        year = targetDate.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    var date =  [year, month, day].join('-');
    $('#registration_due_date').val(date);
    
    var registration_due_days = parseInt($("#booking_open_days").val());
  var targetDate = new Date($("#receipt_date").val());
  targetDate.setDate(targetDate.getDate() + registration_due_days);
  month = '' + (targetDate.getMonth() + 1),
        day = '' + targetDate.getDate(),
        year = targetDate.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    var date =  [year, month, day].join('-');
    $('#booking_open_date').val(date);
    
    
    
    var registration_due_days = parseInt($("#customer_scope_days").val());
  var targetDate = new Date($("#receipt_date").val());
  targetDate.setDate(targetDate.getDate() + registration_due_days);
  month = '' + (targetDate.getMonth() + 1),
        day = '' + targetDate.getDate(),
        year = targetDate.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    var date =  [year, month, day].join('-');
    $('#customer_scope').val(date);
    
    
    var registration_due_days = parseInt($("#company_scope_days").val());
  var targetDate = new Date($("#receipt_date").val());
  targetDate.setDate(targetDate.getDate() + registration_due_days);
  month = '' + (targetDate.getMonth() + 1),
        day = '' + targetDate.getDate(),
        year = targetDate.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    var date =  [year, month, day].join('-');
    $('#company_scope').val(date);

});
      
        function isValidEmail(email) {
            var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            return emailRegex.test(email);
        }

        $(document).on('keyup', '#email', function() {

            var email = $(this).val();
            var isValid = isValidEmail(email);

            if (isValid) {
                $('#email_name_validation').text('');
            } else {
                $('#email_name_validation').text('The Email must be  a valid Email Address!');
            }
        });
    </script>
@endsection
