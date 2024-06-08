@extends('layouts.app')
@section('content')
    <!-- PAGE-HEADER END -->
    <div class="row row-sm mt-2">
        <div class="col-lg-12">
             <form id="Add_plotbookinForm"  autocomplete="off">
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
                                    <input type="hidden" id="url" value="{{ route('booking_store') }}">
                                  <select name="project_id" id="project_id" class="form-control SlectBox">
                                        <option value="">Select Project</option>
                                        @if (isset($projects))
                                            @foreach ($projects as $pro)
                                                <option value="{{ $pro->id }} ">{{ $pro->short_name }}</option>
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
                                        
                                    </select>
                                </div>
                                <span style="display:none" class="text-danger" id="plot_validation">Plot No Field is
                                    Required</span>
                            </div>
                            
                             <div class="col-md-4">
                                <label class="form-label">Plan <span class="text-red">*</span></label>
                                <div class="input-group">
                                   <select name="plan" id="plan" class="form-control SlectBox "> 
                                        <option value="">Select Plan</option>
                                        <option value="1">Plan A</option>
                                        <option value="2">Plan B</option>
                                        <option value="3">Plan C</option>
                                        
                                    </select>
                                </div>
                                <span style="display:none" class="text-danger" id="plot_validation">Plot No Field is
                                    Required</span>
                                    
                                     <input type="hidden" class="form-control"   name="plan_id" id="plan_id"
                                       >
                            </div>
                                
                            <div class="col-md-4">
                                <label class="form-label">Guide Line Sq.Ft Rate <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="guide_line_sqft_rate" id="guide_line_sqft_rate"
                                        placeholder="Guide Line Sq.Ft Rate">
                                </div>
                                 <span style="display:none" class="text-danger" id="guide_line_sqft_rate_validation">Guide Line Sq.Ft Rate Field is
                                    Required</span>

                            </div>
                            @if(Auth::user()->designation_id != 11)
                            <div class="col-md-4">
                                <label class="form-label">Market Value Sq.ft Rate<span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="market_sqft_rate" id="market_sqft_rate"
                                        placeholder="Market Sq.ft Rate">
                                </div>
                                 <span style="display:none" class="text-danger" id="market_sqft_rate_validation">Market Sq.ft Rate Field is
                                    Required</span>

                            </div>
                            @endif
                        
                            
                            
                            <!--<div class="col-md-4">-->
                            <!--    <label class="form-label">Sq.Ft Rate <span class="text-red">*</span></label>-->
                            <!--    <div class="input-group">-->
                            <!--        <input type="text" class="form-control" name="sqft_rate" id="sqft_rate"-->
                            <!--            placeholder="Sq.Ft Rate">-->
                            <!--    </div>-->
                            <!--     <span style="display:none" class="text-danger" id="sqft_rate_validation">Sq.Ft Rate Field is-->
                            <!--        Required</span>-->

                            <!--</div>-->
                            
                              <div class="col-md-4">
                                <label class="form-label">Plot Size <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="plot_size_sqft" id="plot_size_sqft"
                                        placeholder="Plot Size Sq.Ft"> <div class="input-group-text">
                                        / Sq.Ft
                                    </div>
                                        </div>
                                        <br>
                                        <div class="input-group">
                                      
                                    <input type="text" class="form-control" name="plot_size_cent" id="plot_size_cent"
                                        placeholder="Plot Size Cent"> <div class="input-group-text">
                                        / Cents
                                    </div>
                                </div>
                                 <span style="display:none" class="text-danger" id="plot_size_validation">Plot Size Field is
                                    Required</span>

                            </div>
                            
                            
                              <div class="col-md-4">
                                <label class="form-label">Total Value (GL) <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="total_value_gl" id="total_value_gl"
                                        placeholder="Total Value">
                                </div>
                                 <span style="display:none" class="text-danger" id="total_value_gl_validation">Total Value Field is
                                    Required</span>

                            </div>
                            @if(Auth::user()->designation_id != 11)
                            <div class="col-md-4">
                                <label class="form-label">Total Value (MV) <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="total_value_mv" id="total_value_mv"
                                        placeholder="Total Value">
                                </div>
                                 <span style="display:none" class="text-danger" id="total_value_mv_validation">Total Value Field is
                                    Required</span>

                            </div>
                            @endif
                            
                            <!--  <div class="col-md-4">-->
                            <!--    <label class="form-label">Payable ( MV) <span class="text-red">*</span></label>-->
                            <!--    <div class="input-group">-->
                            <!--        <input type="text" class="form-control" name="payable" id="payable"-->
                            <!--            placeholder="Payable ( MV)">-->
                                        
                            <!--    </div>-->
                            <!--     <span style="display:none" class="text-danger" id="payable_validation">Payable ( MV) Field is-->
                            <!--        Required</span>-->

                            <!--</div>-->
                            
                            @if(Auth::user()->designation_id != 11)
                             <div class="col-md-4">
                                <label class="form-label">Balance <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="balance" id="balance"
                                        placeholder="Balance">
                                    
                                </div>
                                 <span style="display:none" class="text-danger" id="balance_validation">Balance Field is
                                    Required</span>

                            </div>
                            @endif
                            
                              <div class="col-md-4">
                                <label class="form-label">Description  </label>
                                <div class="input-group">
                                  <textarea class="form-control" placeholder="Description" name="description" id="description" rows="3"></textarea>
                                </div>
                                 <!--<span style="display:none" class="text-danger" id="description_validation">Description Field is-->
                                 <!--   Required</span>-->

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
                                    </div><input class="form-control fc-datepicker"  
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
                                    </div><input class="form-control fc-datepicker"  
                                        type="date" name="registration_due_date" id="registration_due_date">
                                        
                                        <input class="form-control "  
                                        type="hidden" name="registration_due_days" id="registration_due_days">
                                 </div>
                               <span style="display:none" class="text-danger" id="registration_due_date_validation">Registration Due Date Field is
                                    Required</span>
                            </div>
                            
                             <div class="col-md-4">
                                <label class="form-label">Booking Open <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker"  
                                        type="date" name="booking_open_date" id="booking_open_date">
                                        
                                        <input class="form-control  "  
                                        type="hidden" name="booking_open_days" id="booking_open_days">
                                 </div>
                               <span style="display:none" class="text-danger" id="booking_open_date_validation">Booking Open Field is
                                    Required</span>
                            </div>
                            
                             <div class="col-md-4">
                                <label class="form-label">Company Scope <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker"  
                                        type="date" name="company_scope" id="company_scope">
                                        <input class="form-control  "  
                                        type="hidden" name="company_scope_days" id="company_scope_days">
                                 </div>
                               <span style="display:none" class="text-danger" id="company_scope_validation">Company Scope Field is
                                    Required</span>
                            </div>
                            
                             <div class="col-md-4">
                                <label class="form-label">Customer Scope <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker"  
                                        type="date" name="customer_scope" id="customer_scope">
                                        <input class="form-control fc-datepicker"  
                                        type="hidden" name="customer_scope_days" id="customer_scope_days">
                                 </div>
                               <span style="display:none" class="text-danger" id="customer_scope_validation">Customer Scope Field is
                                    Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Amount <span class="text-red">*</span></label>
                                <div class="input-group">
                                 <input type="text" class="form-control" name="amount" id="booking_amount"
                                        placeholder="Amount">
                                    <input type="hidden" class="form-control" name="old_amount" id="old_amount"
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
                                        <option value="1">Cash</option>
                                        <option value="2">Cheque</option>
                                        <option value="3">DD</option>
                                        <option value="4">Online Transfer</option>
                                        <option value="5">Cash Deposit</option>
                                    </select>
                                </div>
                                 <span style="display:none" class="text-danger" id="pay_mode_validation">Pay Mode Field is
                                    Required</span>

                            </div>
                             <div class="col-md-4" id="dd_no_div" style="display:none" >
                                <label class="form-label">DD No <span class="text-red"></span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="dd_no" id="dd_no"
                                        placeholder="DD No">
                                </div>
                                </div>
                                
                                
                                 <div class="col-md-4" id="dd_date_div" style="display:none" >
                                <label class="form-label">DD Date <span class="text-red"></span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker"  placeholder="MM/DD/YYYY"
                                        type="date" name="dd_date" id="dd_date">
                                </div>
                                </div>
                                
                            
                                      <div class="col-md-4" id="cheque_no_div" style="display:none" >
                                <label class="form-label">Cheque No <span class="text-red"></span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control"  name="cheque_no" id="cheque_no"
                                        placeholder="Cheque No">
                                </div>
                                </div>
                                
                                
                                <div class="col-md-4" id="cheque_date_div"  style="display:none" >
                                <label class="form-label">Cheque Date <span class="text-red"></span></label>
                                <div class="input-group">
                                  <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker"  placeholder="MM/DD/YYYY"
                                        type="date" name="cheque_date" id="cheque_date">
                                </div>
                                </div>
                                
                                 <div class="col-md-4" id="online_trans_no_div"  style="display:none" >
                                <label class="form-label">Online Transfer No<span class="text-red"></span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="online_trans_no" id="online_trans_no"
                                        placeholder="Online Transfer No">
                                </div>
                                </div>
                                
                                
                                 <div class="col-md-4" id="online_trans_date_div"  style="display:none" >
                                <label class="form-label">Online Transfer Date<span class="text-red"></span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker"  placeholder="MM/DD/YYYY"
                                        type="date" name="online_trans_date" id="online_trans_date">
                                </div>
                                </div>
                                
                                
                                 <div class="col-md-4" id="transfer_no_div"  style="display:none" >
                                <label class="form-label">Transfer No<span class="text-red"></span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="transfer_no" id="transfer_no"
                                        placeholder="Transfer No">
                                </div>
                                </div>
                                
                                
                                 <div class="col-md-4" id="transfer_date_div"  style="display:none" >
                                <label class="form-label">Transfer Date<span class="text-red"></span></label>
                                <div class="input-group">
                                   <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker"  placeholder="MM/DD/YYYY"
                                        type="date" name="transfer_date" id="transfer_date">
                                </div>
                                </div>
                                
                              <div class="col-md-4" id="bank_name_div" style="display:none">
                                <label class="form-label">Bank Name </label>
                                <div class="input-group">
                                 
                                   <select name="bank_name" id="bank_name" class="form-control SlectBox" >
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
                            
                            
                          </div>
                   </div>
                 
            </div>
            
              <div class="card" style="padding:8px !important;">
                <div class="card-header">
                    <div class="card-title">Marketer Details</div>
                </div>
                
                <div class="card-body">
                 
                        <div class="row">
                             <div class="col-md-3">
                                <label class="form-label">Marketer ID <span class="text-red">*</span></label>
                                <div class="input-group">
                                     <input type="hidden" class="form-control" name="marketer_id" id="marketer_id">
                                 <!--<input type="text" class="form-control" name="marketer_code" id="marketer_code"-->
                                 <!--       placeholder="Marketer ID">-->
                                    <select name="marketer_code" id="marketer_code" class="form-control SlectBox">
                                   <option value="">Select Marketer</option>
                                        @foreach ($markertes as $val)
                                            <option value="{{ $val->id }}" >{{ $val->reference_code }} - {{ $val->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span style="display:none" class="text-danger" id="marketer_id_validation">Marketer ID Field is
                                    Required</span>
                            </div>
                           
                               <div class="col-md-3"  >
                                <label class="form-label"> Name </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="marketer_name" id="marketer_name"
                                        placeholder="Name">
                                  
                                </div>
                             </div>
                               <div class="col-md-3"  >
                                <label class="form-label">Designation </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="designation" id="designation"
                                        placeholder="Designation">
                                </div>
                               
                            </div>
                            
                             <div class="col-md-3"  >
                                <label class="form-label">Mobile No</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="marketer_mobile" id="marketer_mobile"
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
												<tbody>
												<tr id="table_row_1" >
												    <td colspan="5" style="text-align:center">No Data Found</td>
												</tr>
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
                 
                        <div class="row">
                             <div class="col-md-3" style="display:none">
                                 <label class="form-label">Check if Existing Customer </label>
                                 <div class="input-group">
                                    
                                 	<label class="custom-control custom-checkbox">
									 	<input type="checkbox" class="custom-control-input" id="existing" name="existing" value="1">
										 <span class="custom-control-label">is Existing Customer</span></label>
                                </div>
                               
                            </div>
                              <div class="col-md-4">
                                <label class="form-label">Mobile No </label>
                                <div class="input-group">
                                  <select name="customer_id" id="customer_id" class="form-control SlectBox">
                                   <option value="">Select</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}" >{{ $customer->mobile }}</option>
                                        @endforeach
                                    </select>
                                </div>
                              
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Customer Name</label>
                                <div class="input-group">
                                  <input type="text" class="form-control"  name="existing_cusotmer" id="existing_cusotmer"
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
                                        <option value="1">Mr</option>
                                        <option value="2">Mrs</option>
                                        <option value="3">Miss </option>
                                        <option value="4">Dr</option>
                                        <option value="5">Prof</option>
                                    </select>
                                 </div>
                               <span style="display:none" class="text-danger" id="title_validation">Title Field is
                                    Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Customer Name <span class="text-red">*</span></label>
                                <div class="input-group">
                                 <input type="text" class="form-control" name="customer_name" id="customer_name"
                                        placeholder="Customer Name">
                                </div>
                                <span style="display:none" class="text-danger" id="customer_name_validation">Customer Name Field is
                                    Required</span>
                            </div>
                            <div class="col-md-1"><br><br>
                                <div class="input-group">
                                   <select name="select" id="select" class="form-control SlectBox">
                                        <option value="">Select</option>
                                        <option value="1">S/O</option>
                                        <option value="2">D/O</option>
                                        <option value="3">W/O</option>
                                        <option value="4">C/O</option>
                                       
                                    </select>
                                </div>
                          </div>     
                                <div class="col-md-3"><br><br>
                                <div class="input-group">
                                 <input type="text" class="form-control" name="relation_name" id="relation_name"
                                        placeholder="Name">
                                </div>
                        </div>
                           <div class="col-md-4">
                                <label class="form-label">DOB </label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" max="<?php echo date('Y-m-d'); ?>"
                                        type="date" name="dob" id="dob">
                                 </div>
                               <span style="display:none" class="text-danger" id="dob_date_validation">DOB Field is
                                    Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Gender</label>
                                <div class="input-group">
                                    <select name="gender" id="gender" class="form-control SlectBox">
                                        <option value="">Select Gender</option>
                                        <option value="1">Male</option>
                                        <option value="0">Female</option>
                                    </select>
                                </div>
                                 
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label">Email </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="email" id="email"
                                        placeholder="Email">
                                </div>
                                <!--<span class="text-danger" id="email_name_validation"></span>-->
                                <!--<span style="display:none" class="text-danger" id="email_validation">Email Already-->
                                <!--    Exist</span>-->

                            </div>
                            
                               <div class="col-md-4">
                                <label class="form-label">Mobile No <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="mobile" id="mobile"
                                        placeholder="Mobile No">
                                </div>
                                <span style="display:none" class="text-danger" id="mobile_validation">
                                    Mobile No Field is Required</span>

                            </div>
                             <div class="col-md-4">
                                <label class="form-label">Alternate Mobile </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="alternate_mobile"
                                        id="alternate_mobile" placeholder="Alternate Mobile">
                                </div>
                            </div>
                            
                             <div class="col-md-4">
                                <label class="form-label">Street </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="street" id="street"
                                        placeholder="Street">
                                </div>
                               <!--<span style="display:none" class="text-danger" id="street_validation">Street Field is-->
                               <!--     Required</span>-->
                            </div>
                            
                           <div class="col-md-4">
                                <label class="form-label">Pincode </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="pincode" id="pincode"
                                        placeholder="Pincode">
                                </div>
                                 
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Area </label>
                                <div class="input-group">
                                    <select name="area" id="area" class="form-control SlectBox">
                                        <option value="">Select area</option>
                                    </select>
                                </div>
                                 
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">City </label>
                                <div class="input-group">
                                    <select name="city_id" id="city_id" class="form-control SlectBox">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                                 
                            </div>
                            
                              <div class="col-md-4">
                                <label class="form-label">State </label>
                                <div class="input-group">
                                    <select name="state_id" id="state_id" class="form-control SlectBox">
                                        <option value="">Select State</option>
                                    </select>
                                </div>
                                <small class="text-danger state_id"></small>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Country </label>
                                <div class="input-group">
                                    <select name="country_id" id="country_id" class="form-control SlectBox">
                                        <option value="">Select Country</option>
                                        <option value="1">India</option>
                                    </select>
                                </div>
                                <small class="text-danger country_id"></small>
                            </div>
                          </div>
                          
                                                    <br>
                           <div class="row">
                            <div class="col-md-4 mt-3">
                                <button type="submit" class="btn btn-primary me-2" id="add_booking">Add</button>
                                <a href="{{ url('plot-booking') }}" class="btn btn-light">Cancel</a>
                            </div>
                        </div>
                   </div>
                 
            </div>
            
            
              <div class="card" style="padding:8px !important;display:none;">
                <div class="card-header">
                    <div class="card-title"> Payment Source Details</div>
                </div>
                
                <div class="card-body">
                 
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label"> Payment Source <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="payment_term" id="payment_term" disabled class="form-control SlectBox">
                                        <!--<option value="">Select Title</option>-->
                                        <option value="1">Own Fund</option>
                                        <option value="2">Bank Loan</option>
                                     </select>
                                 </div>
                               <span style="display:none" class="text-danger" id="payment_term_validation"> Payment Source Field is
                                    Required</span>
                            </div>
                             <div class="col-md-4" id="loan_company_div" style="display:none" >
                              <label class="form-label">Loan Company <span class="text-red">*</span></label>
                                <div class="input-group">
                                 <input type="text" class="form-control" name="loan_company" id="loan_company"
                                        placeholder="Loan Company">
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
