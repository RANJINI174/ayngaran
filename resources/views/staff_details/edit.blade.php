@extends('layouts.app')
@section('content')
    <!-- PAGE-HEADER END -->
    <div class="row row-sm mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Staff </div>
                </div>
                <div class="card-body">
                    <form id="Edit_staff_detailsForm" class="p-3" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Staff ID <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="hidden" id="staff_detail_id"
                                        value="{{ !empty($staff->id) ? $staff->id : '' }}">
                                    <input type="text" class="form-control" name="reference_code" id=""
                                        value="{{ !empty($staff->reference_code) ? $staff->reference_code : '' }}" readonly>
                                </div>
                                <small class="text-danger reference_code"></small>
                            </div>
                            {{-- <div class="col-md-4">
                                <label class="form-label">Director <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="director_id" id="director_id" class="form-control SlectBox">
                                        <option value="">Select Director</option>
                                        @if (isset($directors))
                                            @foreach ($directors as $director)
                                                <option value="{{ $director->id }} ">{{ $director->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <small class="text-danger director_id"></small>
                            </div> --}}
                            {{-- <div class="col-md-4">
                                <label class="form-label">Marketing Manager <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="marketing_manager_id" id="marketing_manager_id"
                                        class="form-control SlectBox">
                                        <option value="">Select Marketing Manager</option>
                                        @if (isset($marketing_managers))
                                            @foreach ($marketing_managers as $marketing_manager)
                                                <option value="{{ $marketing_manager->id }} ">{{ $marketing_manager->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <small class="text-danger marketing_manager_id"></small>
                            </div> --}}
                            <div class="col-md-4">
                                <label class="form-label">Name <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Name" value="{{ !empty($staff->name) ? $staff->name : '' }}">
                                </div>
                                <span style="display:none" class="text-danger" id="name_validation">Name Field is
                                    Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Email</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="email" id="email"
                                        placeholder="Email" value="{{ !empty($staff->email) ? $staff->email : '' }}">
                                </div>
                                <span class="text-danger" id="email_name_validation"></span>
                                <span style="display:none" class="text-danger" id="email_validation">Email Already
                                    Exist</span>
                            </div>

                        </div>
                        <div class="row">

                            {{-- <div class="col-md-4">
                                <label class="form-label">Marketing Manager <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="marketing_manager_id" id="marketing_manager_id"
                                        class="form-control SlectBox">
                                        <option value="">Select Marketing Manager</option>
                                        @if (isset($marketing_managers))
                                            @foreach ($marketing_managers as $marketing_manager)
                                                <option value="{{ $marketing_manager->id }} ">{{ $marketing_manager->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <small class="text-danger marketing_manager_id"></small>
                            </div> --}}

                            <!-- <div class="col-md-4">
                                                                                <label class="form-label">Team Name <span class="text-red">*</span></label>
                                                                                <div class="input-group">
                                                                                    <input type="text" class="form-control" name="team_name" id="team_name"
                                                                                        placeholder="Team Name">
                                                                                </div>
                                                                                <small class="text-danger team_name"></small>
                                                                            </div> -->


                        </div>
                        <div class="row">

                            <!--<div class="col-md-4">-->
                            <!--    <label class="form-label">Password<span class="text-red">*</span></label>-->
                            <!--    <div class="input-group">-->
                            <!--        <input type="password" class="form-control" autocomplete="new-password" name="password"-->
                            <!--            id="password" placeholder="Password">-->
                            <!--    </div>-->
                            <!--    <span style="display:none" class="text-danger" id="password_validation">Password Field-->
                            <!--        is Required</span>-->
                            <!--</div>-->
                            <?php 
                                $decrypt_password = '';
                                if (!empty($staff->encrypt_password) && $staff->encrypt_password != null) {
                                    $decrypt_password = \Illuminate\Support\Facades\Crypt::decrypt($staff->encrypt_password);
                                }
                            ?>
                            <div class="col-md-4">
                                <label class="form-label">Password<span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="password" autocomplete="new-password" class="form-control" name="password"
                                        id="password" placeholder="Password" value="{{ !empty($decrypt_password) ? $decrypt_password : '' }}">
                                    <button type="button" class="btn btn-primary toggle-password">
                                        <i class="fe fe-eye-off" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <span style="display:none" class="text-danger" id="password_validation">Password Field is Required</span>
                            </div>
                            
                            
                            <div class="col-md-4">
                                <label class="form-label">Father Name / Husband Name <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="father_husband_name"
                                        id="father_husband_name" placeholder="Father Name / Husband Name"
                                        value="{{ !empty($staff->father_husband_name) ? $staff->father_husband_name : '' }}">
                                </div>
                                <span style="display:none" class="text-danger" id="father_husband_name_validation">Father
                                    Name / Husband Name Field is Required</span>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Branch <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="branch_id" id="branch_id" class="form-control SlectBox">
                                        <option value="">Select Branch</option>
                                        @if (isset($branch))
                                            @foreach ($branch as $branches)
                                                <option value="{{ $branches->id }} "
                                                    {{ !empty($branches->id == $staff->branch_id) ? 'selected' : '' }}>
                                                    {{ $branches->branch_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <span style="display:none;padding-top:10px" class="text-danger"
                                    id="branch_validation">Branch Field is Required</span>
                            </div>



                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <label class="form-label">Join Date <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" placeholder="MM/DD/YYYY"
                                        type="date" name="join_date" id="join_date"
                                        value="{{ !empty($staff->join_date) ? $staff->join_date : '' }}">
                                </div>
                                <span style="display:none" class="text-danger" id="join_date_validation">Join Date
                                    Field is Required</span>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Marital Status <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="marrital_status" id="marrital_status" class="form-control SlectBox">
                                        <option value="">Select Status</option>
                                        <option value="1"
                                            @if ($staff->marrital_status == 1) {{ 'selected' }} @endif>Married</option>
                                        <option value="0"
                                            @if ($staff->marrital_status == 0) {{ 'selected' }} @endif>Un Married
                                        </option>
                                    </select>
                                </div>
                                <span style="display:none;padding-top:10px" class="text-danger"
                                    id="marrital_status_validation">Marital
                                    Status Field is Required</span>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Wedding Date </label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" placeholder="MM/DD/YYYY"
                                        type="date" name="wedding_date" id="wedding_date"
                                        value="{{ !empty($staff->wedding_date) ? $staff->wedding_date : '' }}">
                                </div>
                                <small class="text-danger wedding_date"></small>
                            </div>

                        </div>


                        <div class="row">


                            <div class="col-md-4">
                                <label class="form-label">Nominee Name<span class="text-red">*</span> </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nominee_name" id="nominee_name"
                                        placeholder="Nominee Name"
                                        value="{{ !empty($staff->nominee_name) ? $staff->nominee_name : '' }}">
                                </div>
                                <span style="display:none" class="text-danger" id="nominee_name_validation">Nominee Name
                                    Field is Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Relationship <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="relationship" id="relationship" class="form-control SlectBox">
                                        <option value="">Select Relationship</option>
                                        @if (isset($relations))
                                            @foreach ($relations as $relation)
                                                <option value="{{ $relation->id }}"
                                                    {{ !empty($relation->id == $staff->relationship) ? 'selected' : '' }}>
                                                    {{ $relation->relationship_type }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <span style="display:none;padding-top:10px" class="text-danger"
                                    id="relationship_validation">Relationship Field is Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Nominee Mobile No <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nominee_mobile" id="nominee_mobile"
                                        placeholder="Nominee Mobile"
                                        value="{{ !empty($staff->nominee_mobile) ? $staff->nominee_mobile : '' }}">
                                </div>
                                <span style="display:none" class="text-danger" id="nominee_mobile_validation">
                                    Nominee Mobile Field is Required</span>
                            </div>


                        </div>

                        <div class="row">


                            <div class="col-md-4">
                                <label class="form-label">Designation <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="designation_id" id="designation_id" class="form-control SlectBox">
                                        <option value="">Select Designation</option>
                                        @if (isset($designation))
                                            @foreach ($designation as $val)
                                                <option
                                                    value="{{ $val->id }} "{{ !empty($val->id == $staff->designation_id) ? 'selected' : '' }}>
                                                    {{ $val->designation }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <span style="display:none;padding-top:10px" class="text-danger"
                                    id="designation_validation">Designation Field is Required</span>
                            </div>
                            <!--<div class="col-md-4">-->
                            <!--    <label class="form-label">Address <span class="text-red">*</span></label>-->
                            <!--    <div class="input-group">-->
                            <!--        <textarea class="form-control" placeholder="Address" name="address" id="address" rows="3">{{ !empty($staff->address) ? $staff->address : '' }}</textarea>-->
                            <!--    </div>-->
                            <!--    <span style="display:none" class="text-danger" id="address_validation">-->
                            <!--        Address Field is Required</span>-->
                            <!--</div>-->

                           <div class="col-md-4">
                                <label class="form-label">Address <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <textarea class="form-control mb-4" placeholder="Address" name="address" id="address" rows="3"
                                        cols="50" style="text-align: start;" wrap="virtual">{{ !empty($staff->address) ? $staff->address : '' }}</textarea>
                                </div>
                                <span style="display:none" class="text-danger" id="address_validation">Address Field is
                                    Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Mobile No <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="mobile_no" id="mobile_no"
                                        placeholder="Mobile No"
                                        value="{{ !empty($staff->mobile_no) ? $staff->mobile_no : '' }}">
                                </div>
                                <span style="display:none" class="text-danger" id="mobile_no_validation">
                                    Mobile No Field is Required</span>
                                <span style="display:none" class="text-danger" id="mobile_validation">Mobile No Already
                                    Exist</span>
                            </div>


                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <label class="form-label">Alternate Mobile </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="alternate_mobile"
                                        id="alternate_mobile" placeholder="Alternate Mobile"
                                        value="{{ !empty($staff->alternate_mobile) ? $staff->alternate_mobile : '' }}">
                                </div>
                                <small class="text-danger alternate_mobile"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">D.O.B <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" placeholder="MM/DD/YYYY"
                                        type="date" name="dob" id="dob"
                                        value="{{ !empty($staff->dob) ? $staff->dob : '' }}">
                                </div>
                                <span style="display:none" class="text-danger" id="dob_validation">
                                    D.O.B Field is Required</span>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Gender</label>
                                <div class="input-group">
                                    <select name="gender" class="form-control SlectBox">
                                        <option value="">Select Gender</option>
                                        <option value="1" {{ $staff->gender == 1 ? 'selected' : '' }}>
                                            Male</option>
                                        <option value="0" {{ $staff->gender == 0 ? 'selected' : '' }}>
                                            Female
                                        </option>
                                    </select>
                                </div>
                                <small class="text-danger gender"></small>
                            </div>


                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <label class="form-label">Pincode </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="pincode" id="pincode"
                                        placeholder="Pincode" value="{{ $staff->pincode }}">
                                </div>
                                <small class="text-danger pincode"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Area </label>
                                <div class="input-group">
                                    <select name="area" id="area" class="form-control SlectBox">
                                        <option value="">Select area</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}"
                                                {{ !empty($area->id == $staff->area) ? 'selected' : '' }}>
                                                {{ $area->area }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <small class="text-danger area"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">City </label>
                                <div class="input-group">
                                    <select name="city_id" id="city_id" class="form-control SlectBox">
                                        <option value="">Select City</option>
                                        @if (isset($city) && !empty($city))
                                            <option value="{{ $city->id }}" selected>{{ $city->city }}</option>
                                        @endif
                                    </select>
                                </div>
                                <small class="text-danger city_id"></small>
                            </div>


                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <label class="form-label">State </label>
                                <div class="input-group">
                                    <select name="state_id" id="state_id" class="form-control SlectBox">
                                        <option value="">Select State</option>
                                        @if (isset($state) && !empty($state))
                                            <option value="{{ $state->id }}" selected>{{ $state->state }}</option>
                                        @endif
                                    </select>
                                </div>
                                <small class="text-danger state_id"></small>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Country </label>
                                <div class="input-group">
                                    <select name="country_id" class="form-control SlectBox">
                                        <option value="">Select Country</option>
                                        <option value="1" {{ $staff->country_id == 1 ? 'selected' : '' }}>India
                                        </option>
                                    </select>
                                </div>
                                <small class="text-danger country_id"></small>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Bank Name </label>
                                <div class="input-group">
                                <select name="bank_name" id="bank_name" class="form-control SlectBox">
                                        <option value="">Select Bank</option>
                                        @if(isset($banks))
                                        @foreach($banks as $bank)
                                        <option value="{{ $bank->id }} "  @if($staff->bank_name == $bank->id) {{ "selected" }} @endif>{{ $bank->bank_name }}</option>
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
                                        placeholder="Account No"
                                        value="{{ !empty($staff->account_no) ? $staff->account_no : '' }}">
                                </div>
                                <small class="text-danger account_no"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">IFSC Code</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="ifsc_code" id="ifsc_code"
                                        placeholder="IFSC Code"
                                        value="{{ !empty($staff->ifsc_code) ? $staff->ifsc_code : '' }}">
                                </div>
                                <small class="text-danger ifsc_code"></small>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Bank Branch </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="bank_branch" id="bank_branch"
                                        placeholder="Bank Branch"
                                        value="{{ !empty($staff->bank_branch) ? $staff->bank_branch : '' }}">
                                </div>
                                <small class="text-danger bank_branch"></small>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Introduced By </label>
                                <div class="input-group">
                                    <select name="introduced_by" id="introduced_by" class="form-control SlectBox">
                                        <option value="">None</option>
                                        @if (isset($designation))
                                            @foreach ($designation as $val)
                                                <option value="{{ $val->id }} "
                                                    @if ($staff->introduced_by == $val->id) {{ 'selected' }} @endif>
                                                    {{ $val->designation }}</option>
                                            @endforeach
                                        @endif
                                        <option value="thired_party"
                                            @if ($staff->introduced_by == 'thired_party') {{ 'selected' }} @endif>Third Party
                                        </option>
                                    </select>
                                </div><small class="text-danger introduced_by"></small>
                            </div>

                            <div class="col-md-4" id="select_introducer" <?php if($staff->introduced_by == 'thired_party' || $staff->introduced_by == ''){ ?> style="display:none"
                                <?php }else {?> style="display:block" <?php } ?>>
                                <label class="form-label">Select Introducer</label>
                                <div class="input-group">
                                    <select name="introducer" id="introducer" class="form-control SlectBox">
                                        <option value="">Select Introducer</option>
                                        @if (isset($introducer_name) && !empty($introducer_name))
                                            @foreach ($introducer_name as $introducer)
                                                <option value="{{ $introducer->id }}"
                                                    @if ($staff->introducer_id == $introducer->id) {{ 'Selected' }} @endif>
                                                    {{ $introducer->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div><small class="text-danger introducer"></small>
                            </div>


                            <div class="col-md-4" id="select_introducer_id" <?php if($staff->introduced_by == 'thired_party' || $staff->introduced_by == ''){ ?> style="display:none"
                                <?php }else {?> style="display:block" <?php } ?>>
                                <label class="form-label">Introducer ID</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly name="introducer_id"
                                        id="introducer_id" placeholder="Introducer ID"
                                        value="{{ !empty($introducer_id) ? $introducer_id : '' }}">
                                </div><small class="text-danger introducer_id"></small>
                            </div>

                            <div class="col-md-4" id="thired_part_1" <?php if($staff->introduced_by != 'thired_party'){ ?> style="display:none"
                                <?php }else {?> style="display:block" <?php } ?>>
                                <label class="form-label">Third Party Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="thired_party_name"
                                        id="thired_party_name" placeholder="Third Party Name"
                                        value="{{ !empty($staff->thired_party_name) ? $staff->thired_party_name : '' }}">
                                </div><small class="text-danger thired_party_name"></small>
                            </div>

                            <div class="col-md-4" id="thired_part_2" <?php if($staff->introduced_by != 'thired_party'){ ?> style="display:none"
                                <?php }else {?> style="display:block" <?php } ?>>
                                <label class="form-label">Third Party Mobile</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="thired_party_mobile"
                                        id="thired_party_mobile" placeholder="Third Party Mobile"
                                        value="{{ !empty($staff->thired_party_mobile) ? $staff->thired_party_mobile : '' }}">
                                </div><small class="text-danger thired_party_mobile"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Status</label>
                                <div class="input-group">
                                    <select name="status" id="status" class="form-control SlectBox">
                                        <option value="1"
                                            @if ($staff->status == '1') {{ 'selected' }} @endif>
                                            Active</option>
                                        <option value="0"
                                            @if ($staff->status == '0') {{ 'selected' }} @endif>
                                            In
                                            Active</option>
                                    </select>
                                </div><small class="text-danger introduced_by"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Select Promote / Demote</label>
                                <div class="input-group">
                                    <select name="select_type" id="select_type" class="form-control SlectBox">
                                        <option value="">Select</option>
                                        <option value="1"
                                            @if ($staff->select_type == '1') {{ 'selected' }} @endif>Promote</option>
                                        <option value="2"
                                            @if ($staff->select_type == '2') {{ 'selected' }} @endif>Demote</option>
                                    </select>
                                </div><small class="text-danger status"></small>
                            </div>
                            <div class="col-md-4" id="promote_div">
                                <label class="form-label">Promote To</label>
                                <div class="input-group">
                                    <select name="promote_id" id="promote_id" class="form-control SlectBox">
                                    <option value="">Select</option>
                                     @if(isset($designation))
                                     @foreach($designation as $val)
                                     <option value="{{ $val->id }} " @if($staff->promote_id == $val->id) {{ "selected" }} @endif>{{ $val->designation }}</option>
                                     @endforeach
                                     @endif
                                    </select>
                                </div><small class="text-danger status"></small>
                            </div>
                             <div class="col-md-4" id="demote_div">
                                <label class="form-label">Demote To</label>
                                <div class="input-group">
                                   <select name="demote_id" id="demote_id" class="form-control SlectBox">
                                    <option value="">Select</option>
                                     @if(isset($designation))
                                     @foreach($designation as $val)
                                     <option value="{{ $val->id }} " @if($staff->demote_id == $val->id) {{ "selected" }} @endif>{{ $val->designation }}</option>
                                     @endforeach
                                     @endif
                                    </select>
                                </div><small class="text-danger status"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                                <a href="{{ url('staff-details') }}" class="btn btn-light">Cancel</a>
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
        function isValidEmail(email) {
            var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            return emailRegex.test(email);
        }
        
          $(document).ready(function() {
            
            $('#select_type').trigger('change');
        });
 
 $('#select_type').on('change', function() {
              $('#promote_div').css("display","none");
              $('#demote_div').css("display","none");
    
          if(this.value == 1)
          {
              $('#promote_div').css("display","block");
              $('#demote_div').css("display","none");
          }else if(this.value == 2){
              $('#promote_div').css("display","none");
              $('#demote_div').css("display","block");
          }
              
        });

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
