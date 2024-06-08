@extends('layouts.app')
@section('content')
    <div class="row row-sm mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Project Details</div>
                </div>
                <div class="card-body">
                    <form id="Edit_ProjectForm" class="p-3" autocomplete="off">
                        @csrf
                        @method('PUT')


                        <div class="row ">
                            <input type="hidden" id="type" value="edit">
                            <input type="hidden" id="edit_project_detail_id" value="{{ $project->id }}">
                            <div class="col-md-12">
                                <div id="wizard2">
                                    <h3>Project Details</h3>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label">Short Name <span class="text-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="short_name"
                                                        id="short_name" placeholder="Short Name"
                                                        value="{{ !empty($project->short_name) ? $project->short_name : '' }}">
                                                </div>
                                                <span style="display:none" class="text-danger"
                                                    id="short_name_validation">Short Name Field is
                                                    Required</span>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Full Name <span class="text-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="full_name"
                                                        id="full_name" placeholder="Full Name"
                                                        value="{{ !empty($project->full_name) ? $project->full_name : '' }}">
                                                </div>
                                                <span style="display:none" class="text-danger"
                                                    id="full_name_validation">Full Name Field is
                                                    Required</span>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Location <span class="text-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="landmark"
                                                        id="landmark" placeholder="Location"
                                                        value="{{ !empty($project->landmark) ? $project->landmark : '' }}">
                                                </div>
                                                <span style="display:none" class="text-danger" id="landmark_validation">
                                                    Location Field is
                                                    Required</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label">Project Start Date <span
                                                        class="text-red">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                    </div><input class="form-control fc-datepicker" placeholder="MM/DD/YYYY"
                                                        type="date" name="project_start_date" id="project_start_date"
                                                        value="{{ !empty($project->project_start_date) ? $project->project_start_date : '' }}">
                                                </div>
                                                <span style="display:none" class="text-danger"
                                                    id="project_start_date_validation">Project Start Date Field is
                                                    Required</span>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Project Type <span
                                                        class="text-red">*</span></label>
                                                <div class="input-group">
                                                    <select name="project_type" id="project_type"
                                                        class="form-control SlectBox">
                                                        <option value="">Select Project Type</option>
                                                        @if (isset($project_type))
                                                            @foreach ($project_type as $val)
                                                                <option value="{{ $val->id }}"
                                                                    {{ !empty($val->id == $project->project_type) ? 'selected' : '' }}>
                                                                    {{ $val->project_type }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <span style="display:none;padding-top:10px" class="text-danger"
                                                    id="project_type_validation">Project Type Field is
                                                    Required</span>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Marketing Type <span
                                                        class="text-red">*</span></label>
                                                <div class="input-group">
                                                    <select name="marketing_type" id="marketing_type"
                                                        class="form-control SlectBox">
                                                        <option value="">Select Project Type</option>
                                                        @if (isset($marketing_type))
                                                            @foreach ($marketing_type as $marketing)
                                                                <option value="{{ $marketing->id }}"
                                                                    {{ !empty($marketing->id == $project->marketing_type) ? 'selected' : '' }}>
                                                                    {{ $marketing->marketing_type }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <span style="display:none;padding-top:10px" class="text-danger"
                                                    id="marketing_type_validation">Marketing Type Field is
                                                    Required</span>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label">Commission Type <span
                                                        class="text-red">*</span></label>
                                                <div class="input-group">
                                                    <select name="commission_type" id="commission_type"
                                                        class="form-control SlectBox">
                                                        <option value="">Select Commission Type</option>
                                                        <option value="1"
                                                            {{ !empty($project->commission_type == 1) ? 'selected' : '' }}>
                                                            By Percentage</option>
                                                        <option value="2"
                                                            {{ !empty($project->commission_type == 2) ? 'selected' : '' }}>
                                                            By Value</option>
                                                    </select>
                                                </div>
                                                <span style="display:none;padding-top:10px" class="text-danger"
                                                    id="commission_type_validation">Commission Type Field is
                                                    Required</span>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Branch <span class="text-red">*</span></label>
                                                <div class="input-group">
                                                    <select name="branch_id" id="branch_id"
                                                        class="form-control SlectBox">
                                                        <option value="">Select Branch</option>
                                                        @if (isset($branch))
                                                            @foreach ($branch as $branches)
                                                                <option value="{{ $branches->id }} "
                                                                    {{ !empty($branches->id == $project->branch_id) ? 'selected' : '' }}>
                                                                    {{ $branches->branch_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <span style="display:none;padding-top:10px" class="text-danger"
                                                    id="branch_id_validation">Branch Field is
                                                    Required</span>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Project Incharge <span
                                                        class="text-red">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group">
                                                        <select name="project_incharge" id="project_incharge"
                                                            class="form-control SlectBox">
                                                            <option value="">Select Designation</option>
                                                            @if (isset($designation))
                                                                @foreach ($designation as $val)
                                                                    <option value="{{ $val->id }} "
                                                                        {{ !empty($val->id == $project->project_incharge) ? 'selected' : '' }}>
                                                                        {{ $val->designation }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <span style="display:none;padding-top:10px" class="text-danger"
                                                    id="project_incharge_validation">Project Incharge Field is
                                                    Required</span>
                                            </div>

                                            <div class="col-md-4" id="select_incharge">
                                                <label class="form-label">Select Incharge <span
                                                        class="text-red">*</span></label>
                                                <div class="input-group">
                                                    <select name="incharge_id" id="incharge_id"
                                                        class="form-control SlectBox">
                                                        <option value="">Select Incharge</option>
                                                        @if (isset($project_incharge))
                                                            @foreach ($project_incharge as $val)
                                                                <option value="{{ $val->id }} "
                                                                    {{ !empty($val->id == $project->incharge_id) ? 'selected' : '' }}>
                                                                    {{ $val->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Project Budget <span
                                                        class="text-red">*</span></label>
                                                <div class="input-group">
                                                    <select name="project_budget" id="project_budget"
                                                        class="form-control SlectBox">
                                                        <option value="">Select Budget</option>
                                                        <option value="1"
                                                            {{ !empty($project->commission_type == 1) ? 'selected' : '' }}>
                                                            Low</option>
                                                        <option value="2"
                                                            {{ !empty($project->commission_type == 2) ? 'selected' : '' }}>
                                                            Medium</option>
                                                        <option value="3"
                                                            {{ !empty($project->commission_type == 3) ? 'selected' : '' }}>
                                                            High</option>
                                                    </select>
                                                </div>
                                                <span style="display:none;padding-top:10px" class="text-danger"
                                                    id="project_budget_validation">Project Budget Field is
                                                    Required</span>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Guide Line Value <span
                                                        class="text-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="guide_line"
                                                        id="guide_line" placeholder="Guide Line Value"
                                                        value="{{ !empty($project->guide_line) ? $project->guide_line : '' }}">
                                                        <div class="input-group-text">
                                       / Sq.Ft
                                    </div>
                                                </div>
                                                
                                                <span style="display:none" class="text-danger"
                                                    id="guide_line_validation">Guide Line Value Field is
                                                    Required</span>
                                            </div>
                             @if(Auth::user()->designation_id != 11)               
                                    
                           <div class="col-md-4">
                                <label class="form-label">Plan <span class="text-red">*</span></label>
                                <div class="input-group">
                                 <select name="plan" id="plan" class="form-control SlectBox">
                                       <option value="">Select Plan</option>
                                       <option value="1" {{ !empty($project->plan == 1) ? 'selected' : '' }}>Plan A</option>
                                       <option value="2" {{ !empty($project->plan == 2) ? 'selected' : '' }}>Plan B</option>
                                       <option value="3" {{ !empty($project->plan == 3) ? 'selected' : '' }}>Plan C</option>
                                      </select>
                                </div>
                                 <span style="display:none;padding-top:10px" class="text-danger" id="plan_validation">Plan Field is
                                    Required</span>
                            </div>

                            <!--          <div class="col-md-4">-->
                            <!--    <label class="form-label">Plan A <span class="text-red">*</span></label>-->
                            <!--    <div class="input-group">-->
                            <!--      <input type="text" class="form-control" value="{{ !empty($project->plan) ? $project->plan : '' }}" name="plan" id="plan"-->
                            <!--            placeholder="Plan A">-->
                            <!--    </div>-->
                            <!--     <span style="display:none;padding-top:10px" class="text-danger" id="plan_validation">Plan Field is-->
                            <!--        Required</span>-->
                            <!--</div>-->
                            
                            <div class="col-md-4">
                                <label class="form-label"> Market Value (Plan A) <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ !empty($project->market_value) ? $project->market_value : '' }}" name="market_value" id="market_value"
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
                            <!--      <input type="text" class="form-control" value="{{ !empty($project->plan_b) ? $project->plan_b : '' }}" name="plan_b" id="plan_b"-->
                            <!--            placeholder="Plan B">-->
                            <!--    </div>-->
                                 
                            <!--</div>-->
                            
                            <div class="col-md-4">
                                <label class="form-label"> Market Value (Plan B)  </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ !empty($project->market_value_b) ? $project->market_value_b : '' }}" name="market_value_b" id="market_value_b"
                                        placeholder="Market Value (Plan B)">
                                        <div class="input-group-text">
                                       / Sq.Ft
                                    </div>
                                </div>
                        
                            </div>
                            
                            
                            <!-- <div class="col-md-4">-->
                            <!--    <label class="form-label">Plan C</label>-->
                            <!--    <div class="input-group">-->
                            <!--      <input type="text" class="form-control" value="{{ !empty($project->plan_c) ? $project->plan_c : '' }}" name="plan_c" id="plan_c"-->
                            <!--            placeholder="Plan C">-->
                            <!--    </div>-->
 
                            <!--</div>-->
                            
                            <div class="col-md-4">
                                <label class="form-label"> Market Value (Plan C)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ !empty($project->market_value_c) ? $project->market_value_c : '' }}" name="market_value_c" id="market_value_c"
                                        placeholder="Market Value (Plan C)">
                                        <div class="input-group-text">
                                       / Sq.Ft
                                    </div>
                                </div>
                               
                            </div>
                            
                            @endif
                            
                            <div class="col-md-4">
                                <label class="form-label">Print Template<span class="text-red">*</span></label>
                                 <div class="input-group">
                                   <select name="template_id" id="template_id" class="form-control SlectBox">
                                        <option value="">Select Print Template</option>
                                       @if(isset($template))
                                       @foreach($template as $temp)
                                       <option value="{{ $temp->id }}" {{ !empty($project->template_id == $temp->id) ? 'selected' : '' }}>{{ $temp->content_heading_name }}</option>
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
                                                    <input type="text" class="form-control" name="advance_amount"
                                                        id="advance_amount" placeholder="0.00"
                                                        value="{{ !empty($project->advance_amount) ? $project->advance_amount : '' }}">
                                                </div>
                                                <span style="display:none;" class="text-danger"
                                                    id="advance_amount_validation">Advance Amount Field is
                                                    Required</span>
                                            </div>
                               	<div class="col-md-3">
                                <label class="form-label"> Registration Due Days  <span class="text-red">*</span></label>
                                <div class="input-group">
                               <input type="text" class="form-control" name="registration_due_days" id="registration_due_days"
                                        placeholder="0" value="{{ !empty($project->registration_due_days) ? $project->registration_due_days : '' }}">
                                </div>
                                 <span style="display:none;" class="text-danger" id="registration_due_date_validation">Registration Due Days Field is
                                    Required</span>
                            </div>
                            
                             <div class="col-md-3">
                                <label class="form-label">Repay Deduction <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control"  value="{{ !empty($project->repay_deduction) ? $project->repay_deduction : '' }}" 
                                    name="repay_deduction" id="repay_deduction"
                                        placeholder="0.00">
                                </div>
                                 <span style="display:none;" class="text-danger"  id="repay_deduction_validation">Repay Deduction Field is
                                    Required</span>
                            </div>
                                            <!--<div class="col-md-3">-->
                                            <!--    <label class="form-label">Advance Refund % <span class="text-red">*</span></label>-->
                                            <!--    <div class="input-group">-->
                                            <!--        <input type="text" class="form-control" name="advance_refund"-->
                                            <!--            id="advance_refund" placeholder="0.00"-->
                                            <!--            value="{{ !empty($project->advance_refund) ? $project->advance_refund : '' }}">-->
                                            <!--    </div>-->
                                            <!--    <span style="display:none;" class="text-danger"-->
                                            <!--        id="advance_refund_validation">Advance Refund Field is-->
                                            <!--        Required</span>-->
                                            <!--</div>-->
                                            
                                            
                            <div class="col-md-3">
                                <label class="form-label">Company Scope <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="company_scope" id="company_scope"
                                        placeholder="Company Scope" value="{{ !empty($project->company_scope) ? $project->company_scope : '' }}">
                                </div>
                               <span style="display:none;" class="text-danger" id="company_scope_validation">Company Scope Field is
                                    Required</span>
                            </div>
                             
                              <div class="col-md-3">
                                <label class="form-label">Customer Scope <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="customer_scope" id="customer_scope"
                                        placeholder="customer_scope" value="{{ !empty($project->customer_scope) ? $project->customer_scope : '' }}">
                                </div>
                                 <span style="display:none;" class="text-danger" id="customer_scope_validation">Customer Scope Field is
                                    Required</span>
                            </div>
                            
                           
                           	<div class="col-md-3">
                                <label class="form-label">Booking Open <span class="text-red">*</span></label>
                                <div class="input-group">
                                     <input type="text" class="form-control" name="booking_open_days" id="booking_open_days"
                                        placeholder="0" value="{{ !empty($project->booking_open_days) ? $project->booking_open_days : '' }}">
                                 </div>
                                 <span style="display:none;" class="text-danger" id="booking_open_validation">Booking Open  Field is
                                    Required</span>
                            </div>
                            
                                <div class="col-md-3">
                                                <label class="form-label">Refund Days <span class="text-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="refund_days"
                                                        id="refund_days" placeholder="0"
                                                        value="{{ !empty($project->refund_days) ? $project->refund_days : '' }}">
                                                </div>
                                                <span style="display:none;" class="text-danger"
                                                    id="refund_days_validation">Refund Days Field is
                                                    Required</span>
                                            </div>


                                            <!--<div class="col-md-3">-->
                                            <!--    <label class="form-label">Validity Days <span class="text-red">*</span></label>-->
                                            <!--    <div class="input-group">-->
                                            <!--        <input type="text" class="form-control" name="valididty_days"-->
                                            <!--            id="valididty_days" placeholder="0"-->
                                            <!--            value="{{ !empty($project->validity_days) ? $project->validity_days : '' }}">-->
                                            <!--    </div>-->
                                            <!--    <span style="display:none;" class="text-danger"-->
                                            <!--        id="valididty_days_validation">Validity Days Field is-->
                                            <!--        Required</span>-->
                                            <!--</div>-->

                                            <!--<div class="col-md-3">-->
                                            <!--    <label class="form-label">Validity Paid % <span class="text-red">*</span></label>-->
                                            <!--    <div class="input-group">-->
                                            <!--        <input type="text" class="form-control" name="valididty_paid"-->
                                            <!--            id="valididty_paid" placeholder="0"-->
                                            <!--            value="{{ !empty($project->validity_paid) ? $project->validity_paid : '' }}">-->
                                            <!--    </div>-->
                                            <!--    <span style="display:none;" class="text-danger"-->
                                            <!--        id="valididty_paid_validation">Validity Paid Field is-->
                                            <!--        Required</span>-->
                                            <!--</div>-->

                                            <!--<div class="col-md-3">-->
                                            <!--    <label class="form-label">Settlement / Sq.Ft <span class="text-red">*</span></label>-->
                                            <!--    <div class="input-group">-->
                                            <!--        <input type="text" class="form-control" name="settlement"-->
                                            <!--            id="settlement" placeholder="0"-->
                                            <!--            value="{{ !empty($project->settlement) ? $project->settlement : '' }}">-->
                                            <!--    </div>-->
                                            <!--    <span style="display:none;" class="text-danger"-->
                                            <!--        id="settlement_validation">Settlement / Sq.Ft Field is-->
                                            <!--        Required</span>-->
                                            <!--</div>-->

                                            <!--<div class="col-md-3">-->
                                            <!--    <label class="form-label">Broker Commission / Sq.Ft <span class="text-red">*</span></label>-->
                                            <!--    <div class="input-group">-->
                                            <!--        <input type="text" class="form-control" name="broker_commission"-->
                                            <!--            id="broker_commission" placeholder="0"-->
                                            <!--            value="{{ !empty($project->broker_commission) ? $project->broker_commission : '' }}">-->
                                            <!--    </div>-->
                                            <!--    <span style="display:none;" class="text-danger"-->
                                            <!--        id="broker_commission_validation">Broker Commission / Sq.Ft Field is-->
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
                                    value="{{ !empty($project->stamp_duty) ? $project->stamp_duty : '' }}"
                                        placeholder="0.00">
                                </div>
                                <span style="display:none" class="text-danger" id="stamp_duty_validation">Stamp Duty Field is
                                    Required</span>
                            </div>
                            
                            
                            <!--	<div class="col-md-3">-->
                            <!--    <label class="form-label">Registration Fees DD % <span class="text-red">*</span></label>-->
                            <!--    <div class="input-group">-->
                            <!--        <input type="text" class="form-control"  value="{{ !empty($project->registration_fees_dd) ? $project->registration_fees_dd : '' }}" name="registration_fees_dd" id="registration_fees_dd"-->
                            <!--            placeholder="0.00">-->
                            <!--    </div>-->
                            <!--    <span style="display:none" class="text-danger" id="registration_fees_dd_validation">Registration Fees DD Field is-->
                            <!--        Required</span>-->
                            <!--</div>-->
                            
                            <div class="col-md-3">
                                <label class="form-label">DD Charge % <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ !empty($project->dd_charge) ? $project->dd_charge : '' }}" name="dd_charge" id="dd_charge"
                                        placeholder="0.00">
                                </div>
                                <span style="display:none" class="text-danger" id="dd_charge_validation">DD Charge Field is
                                    Required</span>
                            </div>
                                            
                                            
                                            <div class="col-md-3">
                                <label class="form-label">Extra Page Fees </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ !empty($project->extra_page_fees) ? $project->extra_page_fees : '' }}" name="extra_page_fees" id="extra_page_fees"
                                        placeholder="0.00">
                                </div>
                                <span style="display:none;" class="text-danger" id="extra_page_fees_validation">Extra Page Fees Field is
                                    Required</span>
                            </div>
                            
                            
                            
                             <div class="col-md-3">
                                <label class="form-label">Computer Fees <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ !empty($project->computer_fees) ? $project->computer_fees : '' }}" name="computer_fees" id="computer_fees"
                                        placeholder="0.00">
                                </div>
                                <span style="display:none;" class="text-danger" id="computer_fees_validation">Computer Fees Field is
                                    Required</span>
                            </div>
                            
                              <div class="col-md-3">
                                <label class="form-label">CD Fees <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ !empty($project->cd) ? $project->cd : '' }}" name="cd" id="cd"
                                        placeholder="0.00">
                                </div>
                               <span style="display:none;" class="text-danger" id="cd_validation">CD Field is
                                    Required</span>
                            </div>
                          <div class="col-md-3">
                                <label class="form-label">Sub Division Fees <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ !empty($project->sub_division_fees) ? $project->sub_division_fees : '' }}" name="sub_division_fees" id="sub_division_fees"
                                        placeholder="0.00">
                                </div>
                               <span style="display:none;" class="text-danger" id="sub_division_fees_validation">Sub Division Fees Field is
                                    Required</span>
                            </div>
                           
                            <div class="col-md-3">
                                <label class="form-label">Register Office <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ !empty($project->register_office) ? $project->register_office : '' }}" name="register_office" id="register_office"
                                        placeholder="0.00">
                                </div>
                                 <span style="display:none;" class="text-danger" id="register_office_validation">Register Office Field is
                                    Required</span>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label">Document Writer Charge <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ !empty($project->writer_fees) ? $project->writer_fees : '' }}" name="writer_fees" id="writer_fees"
                                        placeholder="0.00">
                                </div>
                                 <span style="display:none;" class="text-danger" id="writer_fees_validation">Document Writer Charge Field is
                                    Required</span>
                            </div>
                            
                                            <!--<div class="col-md-3">-->
                                            <!--    <label class="form-label">Document Value % <span class="text-red">*</span></label>-->
                                            <!--    <div class="input-group">-->
                                            <!--        <input type="text" class="form-control" name="document_value"-->
                                            <!--            id="document_value" placeholder="0.00"-->
                                            <!--            value="{{ !empty($project->document_value) ? $project->document_value : '' }}">-->
                                            <!--    </div>-->
                                            <!--    <span style="display:none" class="text-danger"-->
                                            <!--        id="document_value_validation">Document Value Field is-->
                                            <!--        Required</span>-->
                                            <!--</div>-->

                                            <!--<div class="col-md-3">-->
                                            <!--    <label class="form-label">Document Commission % <span class="text-red">*</span></label>-->
                                            <!--    <div class="input-group">-->
                                            <!--        <input type="text" class="form-control" name="document_commission"-->
                                            <!--            id="document_commission" placeholder="0.00"-->
                                            <!--            value="{{ !empty($project->document_commission) ? $project->document_commission : '' }}">-->
                                            <!--    </div>-->
                                            <!--    <span style="display:none;" class="text-danger"-->
                                            <!--        id="document_commission_validation">Document Commission Field is-->
                                            <!--        Required</span>-->
                                            <!--</div>-->

                                            <!--<div class="col-md-3">-->
                                            <!--    <label class="form-label">Document Writer Fees <span class="text-red">*</span></label>-->
                                            <!--    <div class="input-group">-->
                                            <!--        <input type="text" class="form-control" name="writer_fees"-->
                                            <!--            id="writer_fees" placeholder="0.00"-->
                                            <!--            value="{{ !empty($project->writer_fees) ? $project->writer_fees : '' }}">-->
                                            <!--    </div>-->
                                            <!--    <span style="display:none;" class="text-danger"-->
                                            <!--        id="writer_fees_validation">Document Writer Fees Field is-->
                                            <!--        Required</span>-->
                                            <!--</div>-->


                                            <!--<div class="col-md-3">-->
                                            <!--    <label class="form-label">D.D Comm % <span class="text-red">*</span></label>-->
                                            <!--    <div class="input-group">-->
                                            <!--        <input type="text" class="form-control" name="dd_commission"-->
                                            <!--            id="dd_commission" placeholder="0.00"-->
                                            <!--            value="{{ !empty($project->dd_commission) ? $project->dd_commission : '' }}">-->
                                            <!--    </div>-->
                                            <!--    <span style="display:none;" class="text-danger"-->
                                            <!--        id="dd_commission_validation">D.D Comm Field is-->
                                            <!--        Required</span>-->
                                            <!--</div>-->

                                            <!--<div class="col-md-3">-->
                                            <!--    <label class="form-label">Sub Division Fees <span class="text-red">*</span></label>-->
                                            <!--    <div class="input-group">-->
                                            <!--        <input type="text" class="form-control" name="sub_division_fees"-->
                                            <!--            id="sub_division_fees" placeholder="0.00"-->
                                            <!--            value="{{ !empty($project->sub_division_fees) ? $project->sub_division_fees : '' }}">-->
                                            <!--    </div>-->
                                            <!--    <span style="display:none;" class="text-danger"-->
                                            <!--        id="sub_division_fees_validation">Sub Division Fees Field is-->
                                            <!--        Required</span>-->
                                            <!--</div>-->

                                            <!--<div class="col-md-3">-->
                                            <!--    <label class="form-label">Registration Gift <span class="text-red">*</span></label>-->
                                            <!--    <div class="input-group">-->
                                            <!--        <input type="text" class="form-control" name="regitration_gift"-->
                                            <!--            id="regitration_gift" placeholder="0.00"-->
                                            <!--            value="{{ !empty($project->regitration_gift) ? $project->regitration_gift : '' }}">-->
                                            <!--    </div>-->
                                            <!--    <span style="display:none;" class="text-danger"-->
                                            <!--        id="regitration_gift_validation">Registration Gift Field is-->
                                            <!--        Required</span>-->
                                            <!--</div>-->

                                            <!--<div class="col-md-3">-->
                                            <!--    <label class="form-label">Computer Fees <span class="text-red">*</span></label>-->
                                            <!--    <div class="input-group">-->
                                            <!--        <input type="text" class="form-control" name="computer_fees"-->
                                            <!--            id="computer_fees" placeholder="0.00"-->
                                            <!--            value="{{ !empty($project->computer_fees) ? $project->computer_fees : '' }}">-->
                                            <!--    </div>-->
                                            <!--    <span style="display:none;" class="text-danger"-->
                                            <!--        id="computer_fees_validation">Computer Fees Field is-->
                                            <!--        Required</span>-->
                                            <!--</div>-->
                                            <!--<div class="col-md-3">-->
                                            <!--    <label class="form-label">Customer Gift <span class="text-red">*</span></label>-->
                                            <!--    <div class="input-group">-->
                                            <!--        <input type="text" class="form-control" name="customer_gift"-->
                                            <!--            id="customer_gift" placeholder="0.00"-->
                                            <!--            value="{{ !empty($project->customer_gift) ? $project->customer_gift : '' }}">-->
                                            <!--    </div>-->
                                            <!--    <span style="display:none;" class="text-danger"-->
                                            <!--        id="customer_gift_validation">Customer Gift Field is-->
                                            <!--        Required</span>-->
                                            <!--</div>-->
                                            <!--<div class="col-md-3">-->
                                            <!--    <label class="form-label">CD <span class="text-red">*</span></label>-->
                                            <!--    <div class="input-group">-->
                                            <!--        <input type="text" class="form-control" name="cd"-->
                                            <!--            id="cd" placeholder="0.00"-->
                                            <!--            value="{{ !empty($project->cd) ? $project->cd : '' }}">-->
                                            <!--    </div>-->
                                            <!--    <span style="display:none;" class="text-danger" id="cd_validation">CD-->
                                            <!--        Field is-->
                                            <!--        Required</span>-->
                                            <!--</div>-->
                                            <div class="col-md-3">
                                                <label class="form-label">EC <span class="text-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="ec"
                                                        id="ec" placeholder="0.00"
                                                        value="{{ !empty($project->ec) ? $project->ec : '' }}">
                                                </div>
                                                <span style="display:none;" class="text-danger" id="ec_validation">EC
                                                    Field is
                                                    Required</span>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Reg.Expense <span class="text-red">*</span></label>
                                                <div class="input-group">
                                                    <select name="reg_expense" id="reg_expense"
                                                        class="form-control SlectBox">
                                                        <option value="">Select Expense</option>
                                                        <option value="1"
                                                            {{ !empty($project->reg_expense == 1) ? 'selected' : '' }}>
                                                            Company</option>
                                                        <option value="2"
                                                            {{ !empty($project->reg_expense == 2) ? 'selected' : '' }}>
                                                            Customer</option>

                                                    </select>
                                                </div>
                                                <span style="display:none;padding-top:10px" class="text-danger"
                                                    id="reg_expense_validation">Reg.Expense Field is
                                                    Required</span>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Other Expense <span class="text-red">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="other_expense"
                                                        id="other_expense" placeholder="Other Expense"
                                                        value="{{ !empty($project->other_expense) ? $project->other_expense : '' }}">
                                                </div>
                                                <!--<span style="display:none;" class="text-danger"-->
                                                <!--    id="other_expense_validation">Other Expense Field is-->
                                                <!--    Required</span>-->
                                            </div>
                                            <div>
                                    </section>
                                    <h3>SMS Details</h3>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="advance" value = "1"
                                                        @if($project->advance == 1) {{ "checked" }} @endif>
                                                    <span class="custom-control-label">Advance</span>
                                                </label>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="part_payment" value = "1"
                                                        @if($project->part_payment == 1) {{ "checked" }} @endif>
                                                    <span class="custom-control-label">Part Payment</span>
                                                </label>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="auto_cancel" value = "1"
                                                        @if($project->auto_cancel == 1) {{ "checked" }} @endif>
                                                    <span class="custom-control-label">Auto Cancel</span>
                                                </label>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="manual_cancel" value = "1"
                                                        @if($project->manual_cancel == 1) {{ "checked" }} @endif>
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
@section('scripts')
    <script>
        $(document).ready(function() {
            if ($("project_incharge").val() != "") {
                $("#select_incharge").css("display", "block");
            } else {
                $("#select_incharge").css("display", "none");
            }
        });
    </script>
@endsection
