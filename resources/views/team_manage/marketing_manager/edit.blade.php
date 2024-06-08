@extends('layouts.app')
@section('content')
    <div class="row mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Marketing Manager</div>
                </div>
                <div class="card-body">
                    <form id="Edit_marketingmanagerForm" class="p-3" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Marketing Manager ID<span class="text-red">*</span></label>
                                <input type="hidden" id="marketing_manager_id" value="{{ $marketing_manager->id }}">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="reference_code" id="reference_code"
                                        value="{{ !empty($marketing_manager->reference_code) ? $marketing_manager->reference_code : '' }}"
                                        readonly>
                                </div>
                                <small class="text-danger reference_code"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Name <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Name"
                                        value="{{ !empty($marketing_manager->name) ? $marketing_manager->name : '' }}">
                                </div>
                                <span style="display:none" class="text-danger" id="name_validation">Name Field is
                                    Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Director <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="director_id" id="director_id" class="form-control SlectBox">
                                        <option value="">Select Director</option>
                                        @if (isset($directors))
                                            @foreach ($directors as $director)
                                                <option value="{{ $director->id }}"
                                                    {{ !empty($director->id == $marketing_manager->director_id) ? 'selected' : '' }}>
                                                    {{ $director->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <span style="display:none;padding-top:10px" class="text-danger"
                                    id="director_validation">Director Field is Required</span>
                            </div>

                        </div>

                        <div class="row">
                            {{-- <div class="col-md-4">
                                <label class="form-label">Team Name <span class="text-red">*</span></label>
                                <input type="hidden" id="url" value="{{ route('director_store') }}">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="team_name" id="team_name"
                                        placeholder="Team Name"
                                        value="{{ !empty($marketing_manager->team_name) ? $marketing_manager->team_name : '' }}">
                                </div>
                                <small class="text-danger team_name"></small>
                            </div> --}}
                            <div class="col-md-4">
                                <label class="form-label">Email <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="email" id="email"
                                        placeholder="Email"
                                        value="{{ !empty($marketing_manager->email) ? $marketing_manager->email : '' }}">
                                </div>
                                <span style="display:none" class="text-danger" id="email_name_validation">Email Field is
                                    Required</span>
                                <span style="display:none" class="text-danger" id="email_validation">Email Already
                                    Exist</span>
                            </div>

                            <!--<div class="col-md-4">-->
                            <!--    <label class="form-label">Update Password<span class="text-red">*</span></label>-->
                            <!--    <div class="input-group">-->
                            <!--        <input type="password" class="form-control" autocomplete="new-password" name="password"-->
                            <!--            id="password" placeholder="Update Password">-->
                            <!--    </div>-->
                            <!--    <span style="display:none" class="text-danger" id="password_validation">Password Field-->
                            <!--        is Required</span>-->
                            <!--</div>-->
                             <?php 
                                $decrypt_password = '';
                                if (!empty($marketing_manager->encrypt_password) && $marketing_manager->encrypt_password != null) {
                                    $decrypt_password = \Illuminate\Support\Facades\Crypt::decrypt($marketing_manager->encrypt_password);
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
                                        value="{{ !empty($marketing_manager->father_husband_name) ? $marketing_manager->father_husband_name : '' }}">
                                </div>
                                <span style="display:none" class="text-danger" id="father_husband_name_validation">Father
                                    Name / Husband Name Field is Required</span>
                            </div>
                        </div>

                        <div class="row">


                            <div class="col-md-4">
                                <label class="form-label">Branch <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="branch_id" id="branch_id" class="form-control SlectBox">
                                        <option value="">Select Branch</option>
                                        @if (isset($branch))
                                            @foreach ($branch as $branches)
                                                <option value="{{ $branches->id }}"
                                                    @if ($marketing_manager->branch_id == $branches->id) {{ 'selected' }} @endif>
                                                    {{ $branches->branch_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <span style="display:none;padding-top:10px" class="text-danger"
                                    id="branch_validation">Branch Field is Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Join Date <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" type="date" name="join_date"
                                        id="join_date"
                                        value="{{ !empty($marketing_manager->join_date) ? $marketing_manager->join_date : '' }}">
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
                                            @if ($marketing_manager->marrital_status == 1) {{ 'selected' }} @endif>Married</option>
                                        <option value="0"
                                            @if ($marketing_manager->marrital_status == 0) {{ 'selected' }} @endif>Un Married
                                        </option>
                                    </select>
                                </div>
                                <span style="display:none;padding-top:10px" class="text-danger"
                                    id="marrital_status_validation">Marital
                                    Status Field is Required</span>
                            </div>
                        </div>

                        <div class="row">



                            <div class="col-md-4">
                                <label class="form-label">Wedding Date </label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker"
                                        value="{{ !empty($marketing_manager->wedding_date) ? $marketing_manager->wedding_date : '' }}"
                                        type="date" name="wedding_date" id="wedding_date">
                                </div>
                                <small class="text-danger wedding_date"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Nominee Name <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nominee_name" id="nominee_name"
                                        placeholder="Nominee Name"
                                        value="{{ !empty($marketing_manager->nominee_name) ? $marketing_manager->nominee_name : '' }}">
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
                                                    @if ($relation->id == $marketing_manager->relationship) {{ 'selected' }} @endif>
                                                    {{ $relation->relationship_type }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <span style="display:none;padding-top:10px" class="text-danger"
                                    id="relationship_validation">Relationship Field is Required</span>
                            </div>

                        </div>


                        <div class="row">


                            <div class="col-md-4">
                                <label class="form-label">Nominee Mobile No <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nominee_mobile" id="nominee_mobile"
                                        placeholder="Nominee Mobile"
                                        value="{{ !empty($marketing_manager->nominee_mobile) ? $marketing_manager->nominee_mobile : '' }}">
                                </div>
                                <span style="display:none" class="text-danger" id="nominee_mobile_validation">
                                    Nominee Mobile Field is Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Designation <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="designation_id" id="designation_id" class="form-control SlectBox">
                                        <option value="">Select Designation</option>
                                        @if (isset($designation))
                                            @foreach ($designation as $val)
                                                <option value="{{ $val->id }} "
                                                    @if ($val->id == $marketing_manager->designation_id) {{ 'selected' }} @endif>
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
                            <!--        <textarea class="form-control" placeholder="Address" name="address" id="address" rows="3">-->
                            <!--           {{ $marketing_manager->address }}-->
                            <!--        </textarea>-->

                            <!--    </div>-->
                            <!--    <span style="display:none" class="text-danger" id="address_validation">-->
                            <!--        Address Field is Required</span>-->
                            <!--</div>-->
                            <div class="col-md-4">
                                <label class="form-label">Address <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <textarea class="form-control mb-4" placeholder="Address" name="address" id="address" rows="3"
                                        cols="50" style="text-align: start;" wrap="virtual">{{ $marketing_manager->address }}</textarea>
                                </div>
                                <span style="display:none" class="text-danger" id="address_validation">Address Field is
                                    Required</span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Mobile No <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="mobile_no" id="mobile_no"
                                        placeholder="Mobile No"
                                        value="{{ !empty($marketing_manager->mobile_no) ? $marketing_manager->mobile_no : '' }}">
                                </div>
                                <span style="display:none" class="text-danger" id="mobile_no_validation">
                                    Mobile No Field is Required</span>
                                <span style="display:none" class="text-danger" id="mobile_validation">Mobile No Already
                                    Exist</span>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Alternate Mobile </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="alternate_mobile"
                                        id="alternate_mobile" placeholder="Alternate Mobile"
                                        value="{{ !empty($marketing_manager->alternate_mobile) ? $marketing_manager->alternate_mobile : '' }}">
                                </div>
                                <small class="text-danger alternate_mobile"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">D.O.B <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" type="date" name="dob"
                                        id="dob"
                                        value="{{ !empty($marketing_manager->dob) ? $marketing_manager->dob : '' }}">
                                </div>
                                <span style="display:none" class="text-danger" id="dob_validation">
                                    D.O.B Field is Required</span>
                            </div>

                        </div>
                        <div class="row">


                            <div class="col-md-4">
                                <label class="form-label">Gender</label>
                                <div class="input-group">
                                    <select name="gender" class="form-control SlectBox">
                                        <option value="">Select Gender</option>
                                        <option value="1" {{ $marketing_manager->gender == 1 ? 'selected' : '' }}>
                                            Male</option>
                                        <option value="0" {{ $marketing_manager->gender == 0 ? 'selected' : '' }}>
                                            Female
                                        </option>
                                    </select>
                                </div>
                                <small class="text-danger gender"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Pincode </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="pincode" id="pincode"
                                        placeholder="Pincode" value="{{ $marketing_manager->pincode }}">
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
                                                {{ !empty($area->id == $marketing_manager->area) ? 'selected' : '' }}>
                                                {{ $area->area }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <small class="text-danger area"></small>
                            </div>
                        </div>
                        <div class="row">


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
                                        <option value="1"
                                            {{ $marketing_manager->country_id == 1 ? 'selected' : '' }}>India
                                        </option>
                                    </select>
                                </div>
                                <small class="text-danger country_id"></small>
                            </div>
                        </div>
                        <div class="row">


                            <div class="col-md-4">
                                <label class="form-label">Bank Name </label>
                                <div class="input-group">
                                    <select name="bank_name" id="bank_name" class="form-control SlectBox">
                                        <option value="">Select Bank</option>
                                        @if(isset($banks))
                                        @foreach($banks as $bank)
                                        <option value="{{ $bank->id }} "  @if($marketing_manager->bank_name == $bank->id) {{ "selected" }} @endif>{{ $bank->bank_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <small class="text-danger bank_name"></small>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Account No </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="account_no" id="account_no"
                                        placeholder="Account No"
                                        value="{{ !empty($marketing_manager->account_no) ? $marketing_manager->account_no : '' }}">
                                </div>
                                <small class="text-danger account_no"></small>
                            </div>


                            <div class="col-md-4">
                                <label class="form-label">IFSC Code</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="ifsc_code" id="ifsc_code"
                                        placeholder="IFSC Code"
                                        value="{{ !empty($marketing_manager->ifsc_code) ? $marketing_manager->ifsc_code : '' }}">
                                </div>
                                <small class="text-danger ifsc_code"></small>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <label class="form-label">Bank Branch </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="bank_branch" id="bank_branch"
                                        placeholder="Bank Branch"
                                        value="{{ !empty($marketing_manager->bank_branch) ? $marketing_manager->bank_branch : '' }}">
                                </div>
                                <small class="text-danger bank_branch"></small>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Introduced By </label>
                                <div class="input-group">
                                    <select name="introduced_by" id="introduced_by" class="form-control SlectBox">
                                        <option value="">None</option>
                                        @if (isset($designation))
                                            @foreach ($designation as $val)
                                                <option value="{{ $val->id }} "
                                                    @if ($marketing_manager->introduced_by == $val->id) {{ 'selected' }} @endif>
                                                    {{ $val->designation }}</option>
                                            @endforeach
                                        @endif
                                        <option value="thired_party"
                                            @if ($marketing_manager->introduced_by == 'thired_party') {{ 'selected' }} @endif>Third Party
                                        </option>
                                    </select>
                                </div><small class="text-danger introduced_by"></small>
                            </div>

                            <div class="col-md-4" id="select_introducer" <?php if($marketing_manager->introduced_by == 'thired_party' || $marketing_manager->introduced_by == ''){ ?> style="display:none"
                                <?php }else {?> style="display:block" <?php } ?>>
                                <label class="form-label">Select Introducer</label>
                                <div class="input-group">
                                    <select name="introducer" id="introducer" class="form-control SlectBox">
                                        <option value="">Select Introducer</option>
                                        @if (isset($introducer_name) && !empty($introducer_name))
                                            @foreach ($introducer_name as $introducer)
                                                <option value="{{ $introducer->id }}"
                                                    @if ($marketing_manager->introducer_id == $introducer->id) {{ 'Selected' }} @endif>
                                                    {{ $introducer->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div><small class="text-danger introducer"></small>
                            </div>


                            <div class="col-md-4" id="select_introducer_id" <?php if($marketing_manager->introduced_by == 'thired_party' || $marketing_manager->introduced_by == ''){ ?> style="display:none"
                                <?php }else {?> style="display:block" <?php } ?>>
                                <label class="form-label">Introducer ID</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" readonly name="introducer_id"
                                        id="introducer_id" placeholder="Introducer ID"
                                        value="{{ !empty($introducer_id) ? $introducer_id : '' }}">
                                </div><small class="text-danger introducer_id"></small>
                            </div>

                            <div class="col-md-4" id="thired_part_1" <?php if($marketing_manager->introduced_by != 'thired_party'){ ?> style="display:none"
                                <?php }else {?> style="display:block" <?php } ?>>
                                <label class="form-label">Third Party Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="thired_party_name"
                                        id="thired_party_name" placeholder="Third Party Name"
                                        value="{{ !empty($marketing_manager->thired_party_name) ? $marketing_manager->thired_party_name : '' }}">
                                </div><small class="text-danger thired_party_name"></small>
                            </div>

                            <div class="col-md-4" id="thired_part_2" <?php if($marketing_manager->introduced_by != 'thired_party'){ ?> style="display:none"
                                <?php }else {?> style="display:block" <?php } ?>>
                                <label class="form-label">Third Party Mobile</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="thired_party_mobile"
                                        id="thired_party_mobile" placeholder="Third Party Mobile"
                                        value="{{ !empty($marketing_manager->thired_party_mobile) ? $marketing_manager->thired_party_mobile : '' }}">
                                </div><small class="text-danger thired_party_mobile"></small>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Status</label>
                                <div class="input-group">
                                    <select name="status" id="status" class="form-control SlectBox">
                                        <option value="1"
                                            @if ($marketing_manager->status == '1') {{ 'selected' }} @endif>Active</option>
                                        <option value="0"
                                            @if ($marketing_manager->status == '0') {{ 'selected' }} @endif>In
                                            Active</option>
                                    </select>
                                </div><small class="text-danger status"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Select Promote / Demote</label>
                                <div class="input-group">
                                    <select name="select_type" id="select_type" class="form-control SlectBox">
                                        <option value="">Select</option>
                                        <option value="1"
                                            @if ($marketing_manager->select_type == '1') {{ 'selected' }} @endif>Promote</option>
                                        <option value="2"
                                            @if ($marketing_manager->select_type == '2') {{ 'selected' }} @endif>Demote</option>
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
                                     <option value="{{ $val->id }} " @if($marketing_manager->promote_id == $val->id) {{ "selected" }} @endif>{{ $val->designation }}</option>
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
                                     <option value="{{ $val->id }} " @if($marketing_manager->demote_id == $val->id) {{ "selected" }} @endif>{{ $val->designation }}</option>
                                     @endforeach
                                     @endif
                                    </select>
                                </div><small class="text-danger status"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-4">
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                                <a href="{{ url('marketing-manager-lists') }}" class="btn btn-light">Cancel</a>
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
      

    </script>
@endsection