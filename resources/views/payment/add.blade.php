@extends('layouts.app')
@section('content')
    <!-- PAGE-HEADER END -->
    <div class="row row-sm mt-2">
        <div class="col-lg-12">
             <form id="Add_partpaymentForm"  autocomplete="off">
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
                                    <input type="hidden" id="url" value="{{ route('store-payment') }}">
                                  <select name="project_id" id="payment_project_id" class="form-control SlectBox">
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
                                <label class="form-label">Plots No<span class="text-red">*</span></label>
                                <div class="input-group">
                                   <select name="plot_id" id="payment_plot_id" class="form-control SlectBox">
                                        <option value="">Select Plot No</option>
                                        
                                    </select>
                                </div>
                                <span style="display:none" class="text-danger" id="plot_validation">Plot Field is
                                    Required</span>
                            </div>
                            
                             <div class="col-md-4">
                                <label class="form-label">Market Value Sq.ft Rate<span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="market_sqft_rate" id="market_sqft_rate"
                                        placeholder="Market Sq.ft Rate">
                                </div>
                                 <span style="display:none" class="text-danger" id="market_sqft_rate_validation">Market Sq.ft Rate Field is
                                    Required</span>

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
                            
                            <div class="col-md-4">
                                <label class="form-label">Total Value (MV) <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="total_value_mv" id="total_value_mv"
                                        placeholder="Total Value">
                                </div>
                                 <span style="display:none" class="text-danger" id="total_value_mv_validation">Total Value Field is
                                    Required</span>

                            </div>
                              <div class="col-md-4" style="display:none;">
                                <label class="form-label">GL.Rate <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="gl_rate" id="gl_rate"
                                        placeholder="GL.Rate">
                                </div>
                                 <span style="display:none" class="text-danger" id="gl_rate_validation">GL.Rate Field is
                                    Required</span>

                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label">GL.Balance  </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="gl_balance" id="gl_balance"
                                        placeholder="GL.Balance">
                                </div>
                                 <!--<span style="display:none" class="text-danger" id="gl_balance_validation">GL.Balance Field is-->
                                 <!--   Required</span>-->

                            </div>
                            
                            
                              <div class="col-md-4">
                                <label class="form-label">Paid <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="paid" id="paid"
                                        placeholder="Paid">
                                </div>
                                 <span style="display:none" class="text-danger" id="paid_validation">Paid Field is
                                    Required</span>

                            </div>
                            
                        
                              <div class="col-md-4">
                                <label class="form-label">Payable ( MV) <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="payable" id="payable"
                                        placeholder="Payable ( MV)">
                                </div>
                                 <span style="display:none" class="text-danger" id="payable_validation">Payable ( MV) Field is
                                    Required</span>

                            </div>
                            
                            
                              <div class="col-md-4">
                                <label class="form-label">Description  </label>
                                <div class="input-group">
                                  <textarea class="form-control" placeholder="Description" name="description" id="description" rows="3"></textarea>
                                </div>
                                 <span style="display:none" class="text-danger" id="description_validation">Description Field is
                                    Required</span>

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
                                <label class="form-label">Customer Name <span class="text-red">*</span></label>
                                <div class="input-group">
                                 <input type="text" class="form-control" name="customer_name" id="customer_name"
                                        placeholder="Customer Name">
                                 <input type="hidden" class="form-control" name="customer_id" id="customer_id"
                                        placeholder="Customer Name">
                                </div>
                                <span style="display:none" class="text-danger" id="customer_name_validation">Customer Name Field is
                                    Required</span>
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
                                 <input type="text" class="form-control" name="marketer_code" readonly id="marketer_code"
                                        placeholder="Marketer ID">
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
                    <div class="card-title">Payment Details</div>
                </div>
                
                <div class="card-body">
                 
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Receipt Date <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" value="<?php echo date('Y-m-d'); ?>"
                                        type="date" name="receipt_date" id="receipt_date">
                                 </div>
                               <span style="display:none" class="text-danger" id="receipt_date_validation">Receipt Date Field is
                                    Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Amount <span class="text-red">*</span></label>
                                <div class="input-group">
                                 <input type="text" class="form-control" name="amount" id="amount"
                                        placeholder="0.00">
                                     <input type="hidden" class="form-control" name="old_amount" id="old_amount" 
                                        placeholder="0.00">
                                </div>
                                <span style="display:none" class="text-danger" id="amount_validation">Amount Field is
                                    Required</span>
                            </div>
                             <div class="col-md-4">
                                <label class="form-label">Discount</label>
                                <div class="input-group">
                                 <input type="text" class="form-control" name="discount" id="discount"
                                        placeholder="0.00">
                                </div>
                                <span style="display:none" class="text-danger" id="discount_validation">Discount Field is
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
                            
                            
                                
                                 <div class="col-md-4" >
                                <label class="form-label">Balance</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="balance" id="balance"
                                        placeholder="0.00">
                                     <input type="hidden" class="form-control" name="old_balance" id="old_balance" 
                                        placeholder="0.00">
                                  
                                </div>
                             </div>
                             
                               
                                 <div class="col-md-4" >
                                <label class="form-label">Type</label>
                                <div class="input-group">
                                    <select name="account_type" id="account_type" class="form-control SlectBox">
                                        <option value="">Select Type</option>
                                        <option value="1"> P.P (Part Payment)</option>
                                        <option value="2">Adv ( Advance)</option>
                                    
                                    </select>
                                  
                                </div>
                             </div>
                          </div>
                   </div>
             </div>
             
             <div class="card" style="padding:8px !important;">
                <div class="card-header">
                    <div class="card-title">Payment History</div>
                </div>
                
                <div class="card-body">
                 
                        <div class="row">
                    	<div class="table-responsive">
                            			    <br>
                            			   
											<table id="payment_table" class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
												<thead>
													<tr>
														<th>#</th>
														<th>Receipt</th>
														<th>Date</th>
														<th>Amount</th>
														<th>Type</th>
														<th>Paymode</th>
														<th>Narration</th>
														 
													</tr>
												</thead>
												<tbody>
												<tr id="table_row_1" >
												    <td colspan="7" style="text-align:center">No Data Found</td>
												</tr>
												</tbody>
											</table>
										 
						</div>
                          </div>
                           <div class="row">
                            <div class="col-md-4 mt-3">
                                <button type="submit" class="btn btn-primary me-2">Add</button>
                                <a href="{{ url('part_payment_list') }}" class="btn btn-light">Cancel</a>
                            </div>
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
