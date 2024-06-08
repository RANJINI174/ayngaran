@extends('layouts.app')
@section('content')
    <div class="row row-sm mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add Project Details</div>
                </div>
                <div class="card-body">
                    <form id="Add_ProjectForm" class="p-3" autocomplete="off">
                        @csrf
                        @method('POST')
                        
                        
                <div class="row ">
                      <input type="hidden" id="type" value="insert">
                        <input type="hidden" id="url" value="{{ route('project_store') }}">
							<div class="col-md-12">
									<div id="wizard2">
											<h3>Project Details</h3>
											<section>
									<div class="row">
							      <div class="col-md-4">
                                <label class="form-label">Short Name <span class="text-red">*</span></label>
                                <div class="input-group">
                                        <input type="text" class="form-control"  name="short_name" id="short_name" placeholder="Short Name">
                                 </div>
                                <span style="display:none" class="text-danger" id="short_name_validation">Short Name Field is
                                    Required</span>
                              </div>
                             <div class="col-md-4">
                                <label class="form-label">Full Name <span class="text-red">*</span></label>
                                 <div class="input-group">
                                    <input type="text" class="form-control"  name="full_name" id="full_name"
                                        placeholder="Full Name">
                                </div>
                                 <span style="display:none" class="text-danger" id="full_name_validation">Full Name Field is
                                    Required</span>
                             </div>
                            
                             <div class="col-md-4">
                                <label class="form-label">Location <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="landmark" id="landmark"
                                        placeholder="Location">
                                </div>
                                 <span style="display:none" class="text-danger" id="landmark_validation">Location Field is
                                    Required</span>
                            </div>
                                </div>
                                
                                <div class="row">
							      <div class="col-md-4">
                                <label class="form-label">Project Start Date <span class="text-red">*</span></label>
                                <div class="input-group">
                                       <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="date"
                                        name="project_start_date" id="project_start_date">
                                 </div>
                                <span style="display:none" class="text-danger" id="project_start_date_validation">Project Start Date Field is
                                    Required</span>
                              </div>
                             <div class="col-md-4">
                                <label class="form-label">Project Type <span class="text-red">*</span></label>
                                 <div class="input-group">
                                   <select name="project_type" id="project_type" class="form-control SlectBox">
                                        <option value="">Select Project Type</option>
                                       @if(isset($project_type))
                                       @foreach($project_type as $project)
                                       <option value="{{ $project->id }}">{{ $project->project_type }}</option>
                                       @endforeach
                                       @endif
                                    </select>
                                </div>
                                <span style="display:none;padding-top:10px" class="text-danger" id="project_type_validation">Project Type Field is
                                    Required</span>
                             </div>
                            
                             <div class="col-md-4">
                                <label class="form-label">Marketing Type <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="marketing_type" id="marketing_type" class="form-control SlectBox">
                                        <option value="">Select Project Type</option>
                                       @if(isset($marketing_type))
                                       @foreach($marketing_type as $marketing)
                                       <option value="{{ $marketing->id }}">{{ $marketing->marketing_type }}</option>
                                       @endforeach
                                       @endif
                                    </select>
                                </div>
                                 <span style="display:none;padding-top:10px" class="text-danger" id="marketing_type_validation">Marketing Type Field is
                                    Required</span>
                            </div>
                                </div>
                                
                                
                                <div class="row">
							      <div class="col-md-4">
                                <label class="form-label">Commission Type <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="commission_type" id="commission_type" class="form-control SlectBox">
                                        <option value="">Select Commission Type</option>
                                        <option value="1">By Percentage</option>
                                            <option value="2">By Value</option>
                                    </select>
                                </div>
                                <span style="display:none;padding-top:10px" class="text-danger" id="commission_type_validation">Commission Type Field is
                                    Required</span>
                            </div>
                             <div class="col-md-4">
                                <label class="form-label">Branch <span class="text-red">*</span></label>
                                 <div class="input-group">
                                     <select name="branch_id" id="branch_id" class="form-control SlectBox">
                                        <option value="">Select Branch</option>
                                        @if(isset($branch))
                                        @foreach($branch as $branches)
                                        <option value="{{ $branches->id }} ">{{ $branches->branch_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <span style="display:none;padding-top:10px" class="text-danger" id="branch_id_validation">Branch Field is
                                    Required</span>
                             </div>
                            
                             <div class="col-md-4">
                                <label class="form-label">Project Incharge <span class="text-red">*</span></label>
                                <div class="input-group">
                                      <div class="input-group">
                                   <select name="project_incharge" id="project_incharge" class="form-control SlectBox">
                                       <option value="">Select Designation</option>
                                        @if(isset($designation))
                                        @foreach($designation as $val)
                                        <option value="{{ $val->id }} ">{{ $val->designation }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                </div>
                                 <span style="display:none;padding-top:10px" class="text-danger" id="project_incharge_validation">Project Incharge Field is
                                    Required</span>
                            </div>
                            
                            <div class="col-md-4" id="select_incharge" style="display:none">
                                <label class="form-label">Select Incharge <span class="text-red">*</span></label>
                                <div class="input-group">
                                   <select name="incharge_id" id="incharge_id" class="form-control SlectBox">
                                       <option value="">Select Incharge</option>
                                      </select>
                                </div>
                              
                            </div>
                            
                            <div class="col-md-4">
                                 <label class="form-label">Project Budget <span class="text-red">*</span></label>
                                <div class="input-group">
                                   <select name="project_budget" id="project_budget" class="form-control SlectBox">
                                       <option value="">Select Budget</option>
                                       <option value="1">Low</option>
                                       <option value="2">Medium</option>
                                       <option value="3">High</option>
                                      </select>
                                </div>
                                   <span style="display:none;padding-top:10px" class="text-danger" id="project_budget_validation">Project Budget Field is
                                    Required</span>
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label">Guide Line Value <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="guide_line" id="guide_line"
                                        placeholder="Guide Line Value">
                                        <div class="input-group-text">
                                       / Sq.Ft
                                    </div>
                                </div>
                                <span style="display:none" class="text-danger" id="guide_line_validation">Guide Line Value Field is
                                    Required</span>
                            </div>
                            @if(Auth::user()->designation_id != 11)
                              <div class="col-md-4">
                                <label class="form-label">Plan <span class="text-red">*</span></label>
                                <div class="input-group">
                                 <select name="plan" id="plan" class="form-control SlectBox">
                                       <option value="">Select Plan</option>
                                       <option value="1">Plan A</option>
                                       <option value="2">Plan B</option>
                                       <option value="3">Plan C</option>
                                      </select>
                                </div>
                                 <span style="display:none;padding-top:10px" class="text-danger" id="plan_validation">Plan Field is
                                    Required</span>
                            </div>
                            @endif
                            
                            <!-- <div class="col-md-4">-->
                            <!--    <label class="form-label">Plan A <span class="text-red">*</span></label>-->
                            <!--    <div class="input-group">-->
                            <!--      <input type="text" class="form-control" name="plan" id="plan"-->
                            <!--            placeholder="Plan A">-->
                            <!--    </div>-->
                            <!--     <span style="display:none;padding-top:10px" class="text-danger" id="plan_validation">Plan A  Field is-->
                            <!--        Required</span>-->
                            <!--</div>-->
                             @if(Auth::user()->designation_id != 11)
                            <div class="col-md-4">
                                <label class="form-label"> Market Value (Plan A) <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="market_value" id="market_value"
                                        placeholder="Market Value">
                                        <div class="input-group-text">
                                       / Sq.Ft
                                    </div>
                                </div>
                               <span style="display:none" class="text-danger" id="market_value_validation"> Market Value (Plan A) Field is
                                    Required</span>
                            </div>
                            
                            <!-- <div class="col-md-4">-->
                            <!--    <label class="form-label">Plan B</label>-->
                            <!--    <div class="input-group">-->
                            <!--      <input type="text" class="form-control" name="plan_b" id="plan_b"-->
                            <!--            placeholder="Plan B">-->
                            <!--    </div>-->
                                 
                            <!--</div>-->
                            
                            <div class="col-md-4">
                                <label class="form-label"> Market Value (Plan B)  </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="market_value_b" id="market_value_b"
                                        placeholder="Market Value (Plan B)">
                                        <div class="input-group-text">
                                       / Sq.Ft
                                    </div>
                                </div>
                        
                            </div>
                            
                            
                            <!-- <div class="col-md-4">-->
                            <!--    <label class="form-label">Plan C</label>-->
                            <!--    <div class="input-group">-->
                            <!--      <input type="text" class="form-control" name="plan_c" id="plan_c"-->
                            <!--            placeholder="Plan C">-->
                            <!--    </div>-->
 
                            <!--</div>-->
                            
                            <div class="col-md-4">
                                <label class="form-label"> Market Value (Plan C)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="market_value_c" id="market_value_c"
                                        placeholder="Market Value (Plan C)">
                                        <div class="input-group-text">
                                       / Sq.Ft
                                    </div>
                                </div>
                               
                            </div>
                            
                            @endif
                            
                             <div class="col-md-4">
                                <label class="form-label">Print Template <span class="text-red">*</span></label>
                                 <div class="input-group">
                                   <select name="template_id" id="template_id" class="form-control SlectBox">
                                        <option value="">Select Print Template</option>
                                       @if(isset($template))
                                       @foreach($template as $temp)
                                       <option value="{{ $temp->id }}">{{ $temp->content_heading_name }}</option>
                                       @endforeach
                                       @endif
                                    </select>
                                </div>
                                <span style="display:none;padding-top:10px" class="text-danger" id="template_id_validation">Print Template Field is
                                    Required</span>
                             </div>
                            
                         
                         
                                </div>
											</section>
											<h3>Payment Details</h3>
											<section>
							  <div class="row">
							 	<div class="col-md-3">
                                <label class="form-label">Advance Amount <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="advance_amount" id="advance_amount"
                                        placeholder="0.00">
                                </div>
                                 <span style="display:none;" class="text-danger" id="advance_amount_validation">Advance Amount Field is
                                    Required</span>
                            </div>
                            
                            	<div class="col-md-3">
                                <label class="form-label"> Registration Due Days  <span class="text-red">*</span></label>
                                <div class="input-group">
                                     <input type="text" class="form-control" name="registration_due_days" id="registration_due_days"
                                        placeholder="0">
                               
                                </div>
                                 <span style="display:none;" class="text-danger" id="registration_due_date_validation"> Registration Due Days  Field is
                                    Required</span>
                            </div>
                            
                             <div class="col-md-3">
                                <label class="form-label">Repay Deduction <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="repay_deduction" id="repay_deduction"
                                        placeholder="0.00">
                                </div>
                                 <span style="display:none;" class="text-danger" id="repay_deduction_validation">Repay Deduction Field is
                                    Required</span>
                            </div>
                            
                            <!--<div class="col-md-3">-->
                            <!--    <label class="form-label">Advance Refund % <span class="text-red">*</span></label>-->
                            <!--    <div class="input-group">-->
                            <!--        <input type="text" class="form-control" name="advance_refund" id="advance_refund"-->
                            <!--            placeholder="0.00">-->
                            <!--    </div>-->
                            <!--     <span style="display:none;" class="text-danger" id="advance_refund_validation">Advance Refund Field is-->
                            <!--        Required</span>-->
                            <!--</div>-->
                            
                          
                            
                            <div class="col-md-3">
                                <label class="form-label">Company Scope <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="company_scope" id="company_scope"
                                        placeholder="0">
                                </div>
                               <span style="display:none;" class="text-danger" id="company_scope_validation">Company Scope Field is
                                    Required</span>
                            </div>
                               <div class="col-md-3">
                                <label class="form-label">Customer Scope <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="customer_scope" id="customer_scope"
                                        placeholder="0">
                                </div>
                                 <span style="display:none;" class="text-danger" id="customer_scope_validation">Customer Scope Field is
                                    Required</span>
                            </div>
                            
                           	<div class="col-md-3">
                                <label class="form-label">Booking Open <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="booking_open_days" id="booking_open_days"
                                        placeholder="0">
                               
                                </div>
                                 <span style="display:none;" class="text-danger" id="booking_open_validation">Booking Open  Field is
                                    Required</span>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label">Refund Days <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="refund_days" id="refund_days"
                                        placeholder="0">
                                </div>
                                 <span style="display:none;" class="text-danger" id="refund_days_validation">Refund Days Field is
                                    Required</span>
                            </div>
                            
                            
                           
                            
                            <!--  <div class="col-md-3">-->
                            <!--    <label class="form-label">Validity Days <span class="text-red">*</span></label>-->
                            <!--    <div class="input-group">-->
                            <!--        <input type="text" class="form-control" name="valididty_days" id="valididty_days"-->
                            <!--            placeholder="0">-->
                            <!--    </div>-->
                            <!--   <span style="display:none;" class="text-danger" id="valididty_days_validation">Validity Days Field is-->
                            <!--        Required</span>-->
                            <!--</div>-->
                            
                            <!-- <div class="col-md-3">-->
                            <!--    <label class="form-label">Validity Paid % <span class="text-red">*</span></label>-->
                            <!--    <div class="input-group">-->
                            <!--        <input type="text" class="form-control" name="valididty_paid" id="valididty_paid"-->
                            <!--            placeholder="0">-->
                            <!--    </div>-->
                            <!--    <span style="display:none;" class="text-danger" id="valididty_paid_validation">Validity Paid Field is-->
                            <!--        Required</span>-->
                            <!--</div>-->
                            
                            <!-- <div class="col-md-3">-->
                            <!--    <label class="form-label">Settlement / Sq.Ft <span class="text-red">*</span></label>-->
                            <!--    <div class="input-group">-->
                            <!--        <input type="text" class="form-control" name="settlement" id="settlement"-->
                            <!--            placeholder="0">-->
                            <!--    </div>-->
                            <!--    <span style="display:none;" class="text-danger" id="settlement_validation">Settlement / Sq.Ft Field is-->
                            <!--        Required</span>-->
                            <!--</div>-->
                            
                            <!-- <div class="col-md-3">-->
                            <!--    <label class="form-label">Broker Commission / Sq.Ft <span class="text-red">*</span></label>-->
                            <!--    <div class="input-group">-->
                            <!--        <input type="text" class="form-control" name="broker_commission" id="broker_commission"-->
                            <!--            placeholder="0">-->
                            <!--    </div>-->
                            <!--    <span style="display:none;" class="text-danger" id="broker_commission_validation">Broker Commission / Sq.Ft Field is-->
                            <!--        Required</span>-->
                            <!--</div>-->
											    </div>
							
											</section>
											<h3>Registration Expenses</h3>
											<section>
													    <div class="row">
													        
													        
								<div class="col-md-3">
                                <label class="form-label">Stamp Duty % <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="stamp_duty" id="stamp_duty"
                                        placeholder="0.00">
                                </div>
                                <span style="display:none" class="text-danger" id="stamp_duty_validation">Stamp Duty Field is
                                    Required</span>
                            </div>
                            
                            
                            <!--	<div class="col-md-3">-->
                            <!--    <label class="form-label">Registration Fees DD % <span class="text-red">*</span></label>-->
                            <!--    <div class="input-group">-->
                            <!--        <input type="text" class="form-control" name="registration_fees_dd" id="registration_fees_dd"-->
                            <!--            placeholder="0.00">-->
                            <!--    </div>-->
                            <!--    <span style="display:none" class="text-danger" id="registration_fees_dd_validation">Registration Fees DD Field is-->
                            <!--        Required</span>-->
                            <!--</div>-->
                            
                            
                            <div class="col-md-3">
                                <label class="form-label">DD Charge % <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="dd_charge" id="dd_charge"
                                        placeholder="0.00">
                                </div>
                                <span style="display:none" class="text-danger" id="dd_charge_validation">DD Charge Field is
                                    Required</span>
                            </div>
                            
                            
											   	<!--<div class="col-md-3">-->
               <!--                 <label class="form-label">Document Value % <span class="text-red">*</span></label>-->
               <!--                 <div class="input-group">-->
               <!--                     <input type="text" class="form-control" name="document_value" id="document_value"-->
               <!--                         placeholder="0.00">-->
               <!--                 </div>-->
               <!--                 <span style="display:none" class="text-danger" id="document_value_validation">Document Value Field is-->
               <!--                     Required</span>-->
               <!--             </div>-->
                            
               <!--             <div class="col-md-3">-->
               <!--                 <label class="form-label">Document Commission % <span class="text-red">*</span></label>-->
               <!--                 <div class="input-group">-->
               <!--                     <input type="text" class="form-control" name="document_commission" id="document_commission"-->
               <!--                         placeholder="0.00">-->
               <!--                 </div>-->
               <!--                <span style="display:none;" class="text-danger" id="document_commission_validation">Document Commission Field is-->
               <!--                     Required</span>-->
               <!--             </div>-->
               
               
               
                          <div class="col-md-3">
                                <label class="form-label">Extra Page Fees </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="extra_page_fees" id="extra_page_fees"
                                        placeholder="0.00">
                                </div>
                                <span style="display:none;" class="text-danger" id="extra_page_fees_validation">Extra Page Fees Field is
                                    Required</span>
                            </div>
                            
                            
                            
                             <div class="col-md-3">
                                <label class="form-label">Computer Fees <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="computer_fees" id="computer_fees"
                                        placeholder="0.00">
                                </div>
                                <span style="display:none;" class="text-danger" id="computer_fees_validation">Computer Fees Field is
                                    Required</span>
                            </div>
                            
                              <div class="col-md-3">
                                <label class="form-label">CD Fees <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="cd" id="cd"
                                        placeholder="0.00">
                                </div>
                               <span style="display:none;" class="text-danger" id="cd_validation">CD Field is
                                    Required</span>
                            </div>
                          <div class="col-md-3">
                                <label class="form-label">Sub Division Fees <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="sub_division_fees" id="sub_division_fees"
                                        placeholder="0.00">
                                </div>
                               <span style="display:none;" class="text-danger" id="sub_division_fees_validation">Sub Division Fees Field is
                                    Required</span>
                            </div>
                           
                            <div class="col-md-3">
                                <label class="form-label">Register Office <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="register_office" id="register_office"
                                        placeholder="0.00">
                                </div>
                                 <span style="display:none;" class="text-danger" id="register_office_validation">Register Office Field is
                                    Required</span>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label">Document Writer Charge <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="writer_fees" id="writer_fees"
                                        placeholder="0.00">
                                </div>
                                 <span style="display:none;" class="text-danger" id="writer_fees_validation">Document Writer Charge Field is
                                    Required</span>
                            </div>
                            
                          
                            <!--  <div class="col-md-3">-->
                            <!--    <label class="form-label">D.D Comm % <span class="text-red">*</span></label>-->
                            <!--    <div class="input-group">-->
                            <!--        <input type="text" class="form-control" name="dd_commission" id="dd_commission"-->
                            <!--            placeholder="0.00">-->
                            <!--    </div>-->
                            <!--    <span style="display:none;" class="text-danger" id="dd_commission_validation">D.D Comm Field is-->
                            <!--        Required</span>-->
                            <!--</div>-->
                            
                             
                            
                            <!-- <div class="col-md-3">-->
                            <!--    <label class="form-label">Registration Gift <span class="text-red">*</span></label>-->
                            <!--    <div class="input-group">-->
                            <!--        <input type="text" class="form-control" name="regitration_gift" id="regitration_gift"-->
                            <!--            placeholder="0.00">-->
                            <!--    </div>-->
                            <!--    <span style="display:none;" class="text-danger" id="regitration_gift_validation">Registration Gift Field is-->
                            <!--        Required</span>-->
                            <!--</div>-->
                            
                            <!-- <div class="col-md-3">-->
                            <!--    <label class="form-label">Customer Gift <span class="text-red">*</span></label>-->
                            <!--    <div class="input-group">-->
                            <!--        <input type="text" class="form-control" name="customer_gift" id="customer_gift"-->
                            <!--            placeholder="0.00">-->
                            <!--    </div>-->
                            <!--     <span style="display:none;" class="text-danger" id="customer_gift_validation">Customer Gift Field is-->
                            <!--        Required</span>-->
                            <!--</div>-->
                           
                             <div class="col-md-3">
                                <label class="form-label">EC <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="ec" id="ec"
                                        placeholder="0.00">
                                </div>
                                <span style="display:none;" class="text-danger" id="ec_validation">EC Field is
                                    Required</span>
                            </div>
                             <div class="col-md-3">
                                <label class="form-label">Reg.Expense <span class="text-red">*</span></label>
                                <div class="input-group">
                                     <select name="reg_expense" id="reg_expense" class="form-control SlectBox">
                                       <option value="">Select Expense</option>
                                       <option value="1">Company</option>
                                       <option value="2">Customer</option>
                                      
                                      </select>
                                </div>
                                <span style="display:none;padding-top:10px" class="text-danger" id="reg_expense_validation">Reg.Expense Field is
                                    Required</span>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Other Expense <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="other_expense" id="other_expense"
                                        placeholder="Other Expense">
                                </div>
                                 <!--<span style="display:none;" class="text-danger" id="other_expense_validation">Other Expense Field is-->
                                 <!--   Required</span>-->
                            </div>
                            <div>
							</section>
							<h3>SMS Details</h3>
							<section>
							    <div class="row">
							        <div class="col-md-3">
							         <label class="custom-control custom-checkbox">
								 	<input type="checkbox" class="custom-control-input" value = "1" name="advance" value="advance">
								 	<span class="custom-control-label">Advance</span>
								 </label>
							        </div>
							        
							        <div class="col-md-3">
							         <label class="custom-control custom-checkbox">
								 	<input type="checkbox" class="custom-control-input" value = "1" name="part_payment" value="part_payment">
								 	<span class="custom-control-label">Part Payment</span>
								 </label>
							        </div>
							        
							        <div class="col-md-3">
							         <label class="custom-control custom-checkbox">
								 	<input type="checkbox" class="custom-control-input" value = "1" name="auto_cancel" value="auto_cancel">
								 	<span class="custom-control-label">Auto Cancel</span>
								 </label>
							        </div>
							        
							        <div class="col-md-3">
							         <label class="custom-control custom-checkbox">
								 	<input type="checkbox" class="custom-control-input" value = "1" name="manual_cancel" value="manual_cancel">
								 	<span class="custom-control-label">Manual Cancel</span>
								 </label>
							        </div>
							    </div>
					     		
							</section>
							</div>
								
							</div>
						</div>
						</form>
                </div>
            </div>
        </div>
    </div>
@endsection

