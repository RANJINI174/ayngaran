@extends('layouts.app')
@section('content')
    <!-- PAGE-HEADER END -->
    <div class="row row-sm mt-2">
        <div class="col-lg-12">
             <form id="Cancel_plotBookingForm"  autocomplete="off">
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
                                    <input type="hidden" id="cancel_project_id" name="cancel_project_id" value="{{ $payment->project_id }}">
                                    <input type="hidden" id="cancel_plot_id" name="cancel_plot_id" value="{{ $payment->plot_id }}">
                                  <select name="project_id" id="payment_project_id" class="form-control SlectBox" disabled>
                                        <option value="">Select Project</option>
                                        @if (isset($projects))
                                            @foreach ($projects as $pro)
                                                <option value="{{ $pro->id }}" @if($payment->project_id == $pro->id) {{"selected"}} @endif>{{ $pro->short_name }}</option>
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
                                   <select name="plot_id" id="payment_plot_id" class="form-control SlectBox" disabled>
                                        <option value="">Select Plot No</option>
                                         @if (isset($plots))
                                            @foreach ($plots as $plot)
                                             <option value="{{ $plot->id }}" @if($payment->plot_id == $plot->id) {{"selected"}} @endif>{{ $plot->plot_no }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <span style="display:none" class="text-danger" id="plot_validation">Plot Field is
                                    Required</span>
                            </div>
                            @if(Auth::user()->designation_id != 11)
                            
                             <div class="col-md-4">
                                <label class="form-label">Market Value Sq.ft Rate<span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly value="{{ $booking->market_value_sqft }}" name="market_sqft_rate" id="market_sqft_rate"
                                        placeholder="Market Sq.ft Rate">
                                </div>
                                 <span style="display:none" class="text-danger" id="market_sqft_rate_validation">Market Sq.ft Rate Field is
                                    Required</span>

                            </div>
                            @endif
                            
                            <div class="col-md-4">
                                <label class="form-label">Guide Line Sq.Ft Rate <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly value="{{ $booking->guide_line_sqft }}" name="guide_line_sqft_rate" id="guide_line_sqft_rate"
                                        placeholder="Guide Line Sq.Ft Rate">
                                </div>
                                 <span style="display:none" class="text-danger" id="guide_line_sqft_rate_validation">Guide Line Sq.Ft Rate Field is
                                    Required</span>

                            </div>
                            
                            <!--<div class="col-md-4">-->
                            <!--    <label class="form-label">Sq.Ft Rate <span class="text-red">*</span></label>-->
                            <!--    <div class="input-group">-->
                            <!--        <input type="text" class="form-control" readonly  value="{{ $booking->sqft_rate}}" name="sqft_rate" id="sqft_rate"-->
                            <!--            placeholder="Sq.Ft Rate">-->
                            <!--    </div>-->
                            <!--     <span style="display:none" class="text-danger" id="sqft_rate_validation">Sq.Ft Rate Field is-->
                            <!--        Required</span>-->

                            <!--</div>-->
                            
                              <div class="col-md-4">
                                <label class="form-label">Plot Size <span class="text-red">*</span></label>
                                  <div class="input-group">
                                    <input type="text" class="form-control" readonly  value="{{ $booking->plot_size_sqft }}" name="plot_size_sqft" id="plot_size_sqft"
                                        placeholder="Plot Size Sq.Ft"> <div class="input-group-text">
                                        / Sq.Ft
                                    </div>
                                        </div>
                                        <br>
                                        <div class="input-group">
                                      
                                    <input type="text" class="form-control" readonly  value="{{ $booking->plot_size_cent }}" name="plot_size_cent" id="plot_size_cent"
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
                              <div class="col-md-4" style="display:none;">
                                <label class="form-label">GL.Rate <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control"  value="{{ $payment->gl_rate }}" name="gl_rate" id="gl_rate"
                                        placeholder="GL.Rate">
                                </div>
                                 <span style="display:none" class="text-danger" id="gl_rate_validation">GL.Rate Field is
                                    Required</span>

                            </div>
                            
                            <?php
                            // if($payment->amount_towards == 1)
                            // {
                              
                            //     $gl_amount = 0;
                            // }else{
                                
                            //     $gl_amount = $payment->gl_balance;
                            // }
                            ?>
                            <div class="col-md-4">
                                <label class="form-label">Balance (GL)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly value="{{ $payment->gl_balance }}" name="gl_balance" id="gl_balance"
                                        placeholder="GL.Balance">
                                <input type="hidden" class="form-control" readonly value="{{ $booking->total_value_gl - $payment->gl_balance }}" name="gl_amount" id="gl_amount"
                                        placeholder="GL.Balance">
                                </div>
                                 <!--<span style="display:none" class="text-danger" id="gl_balance_validation">GL.Balance Field is-->
                                 <!--   Required</span>-->

                            </div>
                            @if(Auth::user()->designation_id != 11)
                                <div class="col-md-4" >
                                <label class="form-label">Balance (MV)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly name="balance" id="balance" value="{{ $payment->balance }}"
                                        placeholder="0.00">
                                    <input type="hidden" class="form-control" readonly value="{{ $booking->total_value_mv - $payment->balance }}" name="mv_amount" id="mv_amount"
                                        placeholder="GL.Balance">
                               
                                  
                                </div>
                             </div>
                             @endif
                            
                            
                              <div class="col-md-4">
                                <label class="form-label">Paid <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control"  readonly value="{{ $payment->paid }}" name="paid" id="paid"
                                        placeholder="Paid">
                                </div>
                                 <span style="display:none" class="text-danger" id="paid_validation">Paid Field is
                                    Required</span>

                            </div>
                            
                        
                            <!--  <div class="col-md-4">-->
                            <!--    <label class="form-label">Payable ( MV) <span class="text-red">*</span></label>-->
                            <!--    <div class="input-group">-->
                            <!--        <input type="text" class="form-control" readonly value="{{ $booking->payable }}" name="payable" id="payable"-->
                            <!--            placeholder="Payable ( MV)">-->
                            <!--    </div>-->
                            <!--     <span style="display:none" class="text-danger" id="payable_validation">Payable ( MV) Field is-->
                            <!--        Required</span>-->

                            <!--</div>-->
                            
                            
                              <div class="col-md-4">
                                <label class="form-label">Description  </label>
                                <div class="input-group">
                                  <textarea class="form-control" placeholder="Description" name="description" id="description" rows="3" readonly>{{ $booking->description }}</textarea>
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
                            
                            <?php
                                $customer_name = '';
                                $cusotmer_mobile = '';
                                $alternate_mobile = '';
                            $get_cusotmer_details = \App\Models\Booking::where('id',$payment->customer_id)->first();
                            if(isset($get_cusotmer_details))
                            {
                                $customer_name = $get_cusotmer_details->customer_name;
                                $cusotmer_mobile = $get_cusotmer_details->mobile;
                                $alternate_mobile = $get_cusotmer_details->alternate_mobile;
                            }
                            
                            ?>
                            
                            <div class="col-md-4">
                                <label class="form-label">Customer Name <span class="text-red">*</span></label>
                                <div class="input-group">
                                 <input type="text" class="form-control" name="customer_name" value="{{$customer_name}}" readonly id="customer_name"
                                        placeholder="Customer Name">
                                 <input type="hidden" class="form-control" name="customer_id" value="{{$payment->customer_id}}" id="customer_id"
                                        placeholder="Customer Name">
                                </div>
                                <span style="display:none" class="text-danger" id="customer_name_validation">Customer Name Field is
                                    Required</span>
                            </div>
                              
                          
                               <div class="col-md-4">
                                <label class="form-label">Mobile No <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly name="mobile" value="{{$cusotmer_mobile}}" id="mobile"
                                        placeholder="Mobile No">
                                </div>
                                <span style="display:none" class="text-danger" id="mobile_validation">
                                    Mobile No Field is Required</span>

                            </div>
                             <div class="col-md-4">
                                <label class="form-label">Alternate Mobile </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{$alternate_mobile}}" readonly name="alternate_mobile"
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
                       <?php
                 
                            $marketer_name = '';
                            $marketer_mobile = '';
                            $marketer_ref = '';
                            $designation = '';
                         $get_booking = \App\Models\Booking::where('project_id',$payment->project_id)->where('plot_id',$payment->plot_id)->first();   
                         $market = \App\Models\User::where('users.id',$get_booking->marketer_id)->leftjoin('designation','designation.id','users.designation_id')
                                 ->select('users.*','designation.designation')->first();
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
                                 <input type="text" class="form-control" name="marketer_code" id="marketer_code" readonly value="{{$marketer_ref}}"
                                        placeholder="Marketer ID">
                                </div>
                                <span style="display:none" class="text-danger" id="marketer_id_validation">Marketer ID Field is
                                    Required</span>
                            </div>
                           
                               <div class="col-md-3"  >
                                <label class="form-label"> Name </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly name="marketer_name" value="{{$marketer_name}}" id="marketer_name"
                                        placeholder="Name">
                                  
                                </div>
                             </div>
                               <div class="col-md-3"  >
                                <label class="form-label">Designation </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly name="designation" value="{{$designation}}" id="designation"
                                        placeholder="Designation">
                                </div>
                               
                            </div>
                            
                             <div class="col-md-3"  >
                                <label class="form-label">Mobile No</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly name="marketer_mobile" value="{{$marketer_mobile}}" id="marketer_mobile"
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
            
            <?php
            
 
            $status = '';
            if($payment->balance == 0)
            {
                $status = "display:none";
            }
            
           ?>
            
        
             
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
														<th>Discount</th>
														<th>Type</th>
														<th>Paymode</th>
														<th>Payment  Source</th>
														@if(Auth::user()->designation_id != 11)
														<th>Amount Towards</th>
														@endif
														<th>Narration</th>
													 
													 
													</tr>
												</thead>
												<tbody>
                                      <?php
                                      $total_gl_value = $booking->total_value_gl;
                                      $total_mv_value = $booking->total_value_mv;
                                        $payment_history = \App\Models\Payment::where('project_id',$payment->project_id)->where('plot_id',$payment->plot_id);
                                        if(Auth::user()->designation_id == 11)
                                        {
                                         $payment_history = $payment_history->where('amount_towards',2);   
                                        }
                                        $payment_history = $payment_history->get();
                                        if(isset($payment_history))
                                        {
                                            $mv_amount = \App\Models\Payment::where('project_id',$payment->project_id)->where('plot_id',$payment->plot_id)
                                                               ->where('amount_towards',1)->select( DB::raw('SUM(amount) as mv_amount'))->first();
                                           $gl_amount = \App\Models\Payment::where('project_id',$payment->project_id)->where('plot_id',$payment->plot_id)
                                                               ->where('amount_towards',2)->select( DB::raw('SUM(amount) as gl_amount'))->first();
                                                               
                                           $gl_discount = \App\Models\Payment::where('project_id',$payment->project_id)->where('plot_id',$payment->plot_id)
                                                               ->where('amount_towards',2)->select( DB::raw('SUM(discount) as gl_discount'))->first();
                                                               
                                           $mv_discount = \App\Models\Payment::where('project_id',$payment->project_id)->where('plot_id',$payment->plot_id)
                                                               ->where('amount_towards',1)->select( DB::raw('SUM(discount) as mv_discount'))->first();
                                              $balance_gl = 0;
                                             $balance_mv = 0;
                                             $discount_tot = 0;
                                            $total_amount = '';
                                            $paymode = '';
                                            $type = '';
                                            $pay_term = '';
                                            $total_gl = 0;
                                            $total_mv = 0;
                                            $total_value_gl = 0;
                                            $total_value_mv = 0;
                                            $narration = '';
                                            foreach($payment_history as $payment)
                                            {
                                                
                                              
                                             
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
                
                 if($payment->payment_term == 1)
                {
                    $pay_term = 'Own Fund';
                }else{
                    $pay_term = 'Bank Loan';
                }
                                      
                                      if(isset($payment->discount))
                                      {
                                          $discount = $payment->discount;
                                      }else{
                                          $discount = 0;
                                      }
                                      
                             
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
                                                
                                             ?>
                                             <tr>
                                                 <td>#</td>
                                                 <td> {{ $payment->receipt_no }} </td>
                                                 <td>{{ date('d-m-Y',strtotime($payment->receipt_date)) }}</td>
                                                 <td>
                                                 <input type="text" class="form-control"  readonly   name="pay_amount[]" id="pay_amount"
                                                 value = "{{  $payment->amount }}" ></td>
                                                 <td><input type="text" class="form-control" name="discount_value[]" readonly id="discount_value" value = "{{$discount }}" ></td>
                                                 <td>{{$type}}</td>
                                                 <td>{{ $paymode }}</td>
                                                 <td>
                                                     <select name="payment_source[]"  id="payment_source" class="form-control SlectBox">
                                                     <option value="">Select</option>
                                                      <option value="1" @if($payment->payment_term == 1) {{"selected"}} @endif>Own Fund</option>
                                                      <option value="2" @if($payment->payment_term == 2) {{"selected"}} @endif>Bank Loan</option>
                                                        </select>
                                                </td>
                                                @if(Auth::user()->designation_id != 11)
                                                 <td>
                                                  <select name="pay_towards[]"  id="pay_towards" class="form-control SlectBox">
                                                     <option value="">Select </option>
                                                     <option value="1"  @if($payment->amount_towards == 1) {{"selected"}} @endif>MV</option>
                                                     <option value="2"  @if($payment->amount_towards == 2) {{"selected"}} @endif>GL</option>
                                                     </select>
                                                 </td>
                                                 @endif
                                                 <td>
                                                     @if($payment->fully_paid != 1)
                                                     <input type="text" class="form-control" readonly name="narration[]"  id="narration" value = "<?php echo $narration; ?>" >
                                                     @else
                                                     <input type="text" class="form-control" readonly name="narration[]"  id="narration" value = "Fully Paid" >
                                                     @endif
                                                     
                                                 </td>
                                                  
                                             </tr>
                                             <?php
                                           
                                             if($payment->amount_towards == 2)
                                             {
                                                
                                                 $total_gl = $total_gl + $payment->amount;
                                                 
                                                 $balance_gl = $total_gl_value - $total_gl - $gl_discount->gl_discount;
                                                 
                                                 
                                                 $total_value_gl = $gl_amount->gl_amount + $gl_discount->gl_discount;
                                                  
                                                 
                                             }
                                             if($payment->amount_towards == 1)
                                             {
                                                 $total_mv = $total_mv + $payment->amount;
                                                 
                                                 $balance_mv = $total_mv_value - $total_mv - $mv_discount->mv_discount;
                                                 
                                                 $total_value_mv = $mv_amount->mv_amount +  $mv_discount->mv_discount;
                                             }
                                             
                                             $discount_tot = $discount_tot + $payment->discount;
                                             
                                            }
                                          }
                                        
                                           $balance_mv =  $balance_mv - $total_value_gl;
                                         
                                       ?>
												</tbody>
												<tfoot  >
												    @if(Auth::user()->designation_id != 11)
												    <tr>
												     <td colspan="2"></td>
												    <th  style="text-align:center !important;">Total Amount</th>
												    <th >{{ number_format($paid_amount->paid_amount,2) }} </th>
												    <th >{{ number_format($discount_tot,2) }} </th>
												    <td colspan="4"> </td>   
												    </tr>
												     <tr>
												     <td colspan="2"></td>
												    <th  style="text-align:center !important;font-size:12px !important;">Total Mv</th>
												    <th style=" font-size:12px !important;">{{ number_format( $total_value_mv,2) }} </th>
												    <td></td>
												    <td></td>
												    <th  style="text-align:center !important;font-size:12px !important;">Balance Mv</th>
												    <th style=" font-size:12px !important;">{{ number_format($balance_mv,2) }} </th> 
												    <td></td>
												    </tr>
												    @endif
												    <tr>
												     <td colspan="2"></td>
												    <th  style="text-align:center !important;font-size:12px !important;">Total GL</th>
												    <th style=" font-size:12px !important;">{{ number_format($total_value_gl ,2) }} </th>
												    <td></td>
												    <td></td>
												    <th  style="text-align:center !important;font-size:12px !important;">Balance GL</th>
												    <th style=" font-size:12px !important;">{{ number_format($balance_gl,2) }} </th>  
												    <td></td>
												    </tr>
												    
												   
												</tfoot>
											</table>
										 
						</div>
                          </div>
                          
                          <div class="row">
                              <div class="col-md-4">
                                <label class="form-label">Cancellation Reason <span class="text-red">*</span></label>
                                <div class="input-group">
                                   <textarea class="form-control" placeholder="Description" name="cancel_reason" required id="cancel_reason" rows="3">
                                     </textarea>
                                </div>
                               <span style="display:none" class="text-danger" id="cancel_reason_validation">Cancellation Reason Field is
                                    Required</span>
                            </div>
                            </div>
                            
                           <div class="row">
                            <div class="col-md-4 mt-3">
                                <button type="submit" class="btn btn-primary me-2" >Cancel Booking</button>
                                <a href="{{ url('plots-list') }}" class="btn btn-light">Back</a>
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
    
      $(document).ready(function() {
             $('.btnprn').printPage();
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