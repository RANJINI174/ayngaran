@extends('layouts.app')
@section('content')
    <div class="row row-sm mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add Marketing Executive</div>
                </div>
                <div class="card-body">
                    <form id="Add_marketingExecutiveForm" class="p-3" autocomplete="off">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Marketing Executive ID</label>
                                <div class="input-group">
                                    <?php
                                    
                                    $words = strlen($count);
                                    
                                    if($words == 0)
                                    {
                                        $ref_no = "ME-001";
                                    }else
                                    {
                                        $ref_count = $count + 1;
                                        $ref_word = strlen($ref_count);
                                        if($ref_word == 1)
                                        {
                                           $ref_no = "ME-00".$ref_count; 
                                        }else if($ref_word == 2)
                                        {
                                           $ref_no = "ME-0".$ref_count;  
                                        }else{
                                           $ref_no = "ME-".$ref_count;   
                                        }
                                        
                                    }
                                     
                                    ?>
                                    <input type="text" class="form-control" name="reference_code" id="reference_code"
                                            value="{{ $ref_no }}" readonly>
 
                                </div>

                            </div>
                            <div class="col-md-4">
                                <input type="hidden" id="url" value="{{ route('marketing_executive_store') }}">
                                <label class="form-label">Name <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Name">
                                </div>
                                <span style="display:none" class="text-danger" id="name_validation">Name Field is Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Director</label>
                                <div class="input-group">
                                   <select name="director_id" id="director_id" class="form-control SlectBox">
                                        <option value="">Select Director</option>
                                        @if(isset($director))
                                        @foreach($director as $val)
                                        <option value="{{ $val->id }} ">{{ $val->name }}</option>
                                        @endforeach
                                        @endif
                                     </select>
                                </div>
                                
                            </div>
                           
                         </div>
                         <div class="row">
                              <div class="col-md-4">
                                <label class="form-label">Marketing Manager</label>
                                <div class="input-group">
                                   <select name="marketing_manager_id" id="marketing_manager_id" class="form-control SlectBox">
                                        <option value="">Select Marketing Manager</option>
                                        @if(isset($marketing_manager))
                                        @foreach($marketing_manager as $val)
                                        <option value="{{ $val->id }} ">{{ $val->name }}</option>
                                        @endforeach
                                        @endif
                                        </select>
                                </div>
                                
                            </div>
                             <div class="col-md-4">
                                <label class="form-label">Marketing Supervisor</label>
                                <div class="input-group">
                                   <select name="marketing_supervisor_id" id="marketing_supervisor_id" class="form-control SlectBox">
                                        <option value="">Select Marketing Supervisor</option>
                                        @if(isset($marketing_supervisor))
                                        @foreach($marketing_supervisor as $val)
                                        <option value="{{ $val->id }} ">{{ $val->name }}</option>
                                        @endforeach
                                        @endif
                                       </select>
                                </div>
                                
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label">Email <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control"  name="email" id="email"
                                        placeholder="Email">
                                </div>
                                
                                <span style="display:none" class="text-danger" id="email_name_validation">Email Field is Required</span>
                                <span style="display:none" class="text-danger" id="email_validation">Email Already Exist</span>
                            </div>
                         </div>
                        <div class="row">
                           <!--<div class="col-md-4">-->
                           <!--     <label class="form-label">Password<span class="text-red">*</span></label>-->
                           <!--     <div class="input-group">-->
                           <!--         <input type="password" autocomplete="new-password" class="form-control" name="password" id="password"-->
                           <!--             placeholder="Password">-->
                           <!--     </div>-->
                           <!--     <span style="display:none" class="text-danger" id="password_validation">Password Field is Required</span>-->
                           <!-- </div>-->
                            <div class="col-md-4"> <!-- Updated By Gowtham.s-->
                                <label class="form-label">Password<span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="password" autocomplete="new-password" class="form-control" name="password"
                                        id="password" placeholder="Password">
                                    <button type="button" class="btn btn-primary toggle-password">
                                        <i class="fe fe-eye-off" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <span style="display:none" class="text-danger" id="password_validation">Password Field is
                                    Required</span>
                            </div>
                           
                            
                             <div class="col-md-4">
                                <label class="form-label">Father Name / Husband Name <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="father_husband_name" id="father_husband_name"
                                        placeholder="Father Name / Husband Name">
                                </div>
                                <span style="display:none" class="text-danger" id="father_husband_name_validation">Father Name / Husband Name Field is Required</span>
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
                                <span style="display:none;padding-top:10px" class="text-danger" id="branch_validation">Branch Field is Required</span>
                            </div>
                        </div>
                        
                         <div class="row">
                          
                             <div class="col-md-4">
                                <label class="form-label">Join Date <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="date"
                                        name="join_date" id="join_date">
                                </div>
                                <span style="display:none" class="text-danger" id="join_date_validation">Join Date Field is Required</span>
                            </div>
                            
                             <div class="col-md-4">
                                <label class="form-label">Marital Status <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="marrital_status" id="marrital_status" class="form-control SlectBox">
                                        <option value="">Select Status</option>
                                        <option value="1">Married</option>
                                        <option value="0">Un Married</option>
                                    </select>
                                </div>
                                <span style="display:none;padding-top:10px" class="text-danger" id="marrital_status_validation">Marital Status Field is Required</span>
                            </div>
                            
                             <div class="col-md-4">
                                <label class="form-label">Wedding Date </label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="date"
                                        name="wedding_date" id="wedding_date">
                                </div>

                            </div>
                            
                              
                            
                        </div>
                        
                         <div class="row">
                             
                             <div class="col-md-4">
                                <label class="form-label">Nominee Name <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nominee_name" id="nominee_name"
                                        placeholder="Nominee Name">
                                </div>
                                <span style="display:none" class="text-danger" id="nominee_name_validation">Nominee Name Field is Required</span>
                            </div>
                              <div class="col-md-4">
                                <label class="form-label">Relationship <span class="text-red">*</span></label>
                                <div class="input-group">
                                   <select name="relationship" id="relationship" class="form-control SlectBox">
                                        <option value="">Select Relationship</option>
                                        @if(isset($relations))
                                        @foreach($relations as $relation)
                                        <option value="{{ $relation->id }} ">{{ $relation->relationship_type }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <span style="display:none;padding-top:10px" class="text-danger" id="relationship_validation">Relationship Field is Required</span>
                            </div>
                             <div class="col-md-4">
                                <label class="form-label">Nominee Mobile No <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nominee_mobile" id="nominee_mobile"
                                        placeholder="Nominee Mobile">
                                </div>
                                <span style="display:none" class="text-danger" id="nominee_mobile_validation">Nominee Mobile No Field is Required</span>
                            </div>
                           
                        </div>
                        
                        <div class="row">
                              
                             <div class="col-md-4">
                                <label class="form-label">Designation <span class="text-red">*</span></label>
                                <div class="input-group">
                                   <select name="designation_id" id="designation_id" class="form-control SlectBox">
                                       <option value="">Select Designation</option>
                                        @if(isset($designation))
                                        @foreach($designation as $val)
                                        <option value="{{ $val->id }} ">{{ $val->designation }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <span style="display:none;padding-top:10px" class="text-danger" id="designation_id_validation">Designation Field is Required</span>
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label">Address <span class="text-red">*</span></label>
                                <div class="input-group">

                                    <textarea class="form-control mb-4" placeholder="Address" name="address" id="address" rows="3"></textarea>
                                </div>
                                <span style="display:none" class="text-danger" id="address_validation">Address Field is Required</span>
                            </div>
                          
                             <div class="col-md-4">
                                <label class="form-label">Mobile No <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="mobile_no" id="mobile_no"
                                        placeholder="Mobile Number">
                                </div>
                                <span style="display:none" class="text-danger" id="mobile_no_validation">Mobile No Field is Required</span>
                                <span style="display:none" class="text-danger" id="mobile_validation">Mobile No Already Exist</span>
                            </div>
                          
                        </div>
                        
                        <div class="row">
                           
                            <div class="col-md-4">
                                <label class="form-label">Alternate Mobile</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="alternate_mobile" id="alternate_mobile"
                                        placeholder="Alternate Mobile">
                                </div>
                                 
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">D.O.B <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                   <input class="form-control fc-datepicker" placeholder="MM/DD/YYYY" type="date"
                                        name="dob" id="dob">
                                </div>
                                <span style="display:none" class="text-danger" id="dob_validation">D.O.B  Field is Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Gender</label>
                                <div class="input-group">
                                    <select name="gender" class="form-control SlectBox">
                                        <option value="">Select Gender</option>
                                        <option value="1">Male</option>
                                        <option value="0">Female</option>
                                    </select>
                                </div>
                                 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Pincode</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="pincode" id="pincode"
                                        placeholder="Pincode">
                                </div>
                                 
                            </div>
                             <div class="col-md-4">
                                <label class="form-label">Area</label>
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
                        </div>
                        
                        <div class="row">
                           <div class="col-md-4">
                                <label class="form-label">State </label>
                                <div class="input-group">
                                    <select name="state_id" id="state_id" class="form-control SlectBox">
                                        <option value="">Select State</option>
                                    </select>
                                </div>
                                 
                            </div>
                               <div class="col-md-4">
                                <label class="form-label">Country </label>
                                <div class="input-group">
                                    <select name="country_id" class="form-control SlectBox">
                                        <option value="">Select Country</option>
                                        <option value="1">India</option>
                                    </select>
                                </div>
                                
                            </div>
                             <div class="col-md-4">
                                <label class="form-label">Bank Name </label>
                                <div class="input-group">
                                   <select name="bank_name" id="bank_name" class="form-control SlectBox">
                                        <option value="">Select Bank</option>
                                        @if(isset($banks))
                                        @foreach($banks as $bank)
                                        <option value="{{ $bank->id }} ">{{ $bank->bank_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                
                            </div>
                        </div>
                         <div class="row">
                              <div class="col-md-4">
                                <label class="form-label">Account No </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="account_no" id="account_no"
                                        placeholder="Account No">
                                </div>
                                 
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">IFSC Code</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="ifsc_code" id="ifsc_code"
                                        placeholder="IFSC Code">
                                </div>
                                
                            </div>
                              <div class="col-md-4">
                                <label class="form-label">Bank Branch </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="bank_branch" id="bank_branch"
                                        placeholder="Bank Branch">
                                </div>
                               
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-4">
                                <label class="form-label">Introduced By  </label>
                                <div class="input-group">
                                   <select name="introduced_by" id="introduced_by" class="form-control SlectBox">
                                        <option value="">Select Type</option>
                                        @if(isset($designation))
                                        @foreach($designation as $val)
                                        <option value="{{ $val->id }} ">{{ $val->designation }}</option>
                                        @endforeach
                                        @endif
                                        <option value="thired_party">Third Party</option>
                                    </select>
                                </div>
                            </div>
                           
                            
                            <div class="col-md-4" id="select_introducer" style="display:none">
                                <label class="form-label">Select Introducer </label>
                                <div class="input-group">
                                   <select name="introducer" id="introducer" class="form-control SlectBox">
                                       <option value="">Select Introducer</option>
                                      </select>
                                </div>
                            </div>
                        
                        
                             <div class="col-md-4" id="select_introducer_id" style="display:none">
                                <label class="form-label">Introducer ID </label>
                                <div class="input-group">
                                 <input type="text" class="form-control" name="introducer_id" id="introducer_id"
                                        placeholder="Introducer ID">
                                </div>
                            </div>
                            
                            <div class="col-md-4" id="thired_part_1" style="display:none">
                                <label class="form-label">Third Party Name </label>
                                <div class="input-group">
                                 <input type="text" class="form-control" name="thired_party_name" id="thired_party_name"
                                        placeholder="Third Party Name">
                                </div>
                            </div>
                            
                            <div class="col-md-4" id="thired_part_2" style="display:none">
                                <label class="form-label">Third Party Mobile </label>
                                <div class="input-group">
                                 <input type="text" class="form-control" name="thired_party_mobile" id="thired_party_mobile"
                                        placeholder="Third Party Mobile">
                                </div>
                            </div>
                             <div class="col-md-4">
                                <label class="form-label">Status</label>
                                <div class="input-group">
                                   <select name="status" id="status" class="form-control SlectBox">
                                        <option value="1">Active</option>
                                        <option value="0">In Active</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                       <div class="row">
                            <div class="col-md-4 mt-3">
                                <button type="submit" class="btn btn-primary me-2">Add</button>
                                <a href="{{ url('marketing-executive-lists') }}" class="btn btn-light">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
