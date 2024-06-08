@extends('layouts.app')
@section('content')
    <!-- PAGE-HEADER END -->
    <div class="row row-sm mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add Staff </div>
                </div>
                <div class="card-body">
                    <form id="Add_staff_detailsForm" class="p-3" autocomplete="off">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Staff ID <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="hidden" id="url" value="{{ route('staff_detail_store') }}">
                                   <?php
                                    
                                    $words = strlen($count);
                                    
                                    if($words == 0)
                                    {
                                        $ref_no = "ST-001";
                                    }else
                                    {
                                        $ref_count = $count + 1;
                                        $ref_word = strlen($ref_count);
                                        if($ref_word == 1)
                                        {
                                           $ref_no = "ST-00".$ref_count; 
                                        }else if($ref_word == 2)
                                        {
                                           $ref_no = "ST-0".$ref_count;  
                                        }else{
                                           $ref_no = "ST-".$ref_count;   
                                        }
                                        
                                    }
                                     
                                    ?>
                                        <input type="text" class="form-control" name="reference_code" id=""
                                            value="{{ $ref_no }}" readonly>
                                    
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
                                        placeholder="Name">
                                </div>
                                <span style="display:none" class="text-danger" id="name_validation">Name Field is
                                    Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Email <span class="text-red"></span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="email" id="email"
                                        placeholder="Email">
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
                                    <input type="text" class="form-control" name="father_husband_name"
                                        id="father_husband_name" placeholder="Father Name / Husband Name">
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
                                                <option value="{{ $branches->id }} ">{{ $branches->branch_name }}</option>
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
                                        type="date" name="join_date" id="join_date">
                                </div>
                                <span style="display:none" class="text-danger" id="join_date_validation">Join Date
                                    Field is Required</span>
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
                                        type="date" name="wedding_date" id="wedding_date">
                                </div>
                                <small class="text-danger wedding_date"></small>
                            </div>

                        </div>


                        <div class="row">


                            <div class="col-md-4">
                                <label class="form-label">Nominee Name<span class="text-red">*</span> </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nominee_name" id="nominee_name"
                                        placeholder="Nominee Name">
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
                                                <option value="{{ $relation->id }}">{{ $relation->relationship_type }}
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
                                        placeholder="Nominee Mobile">
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
                                                <option value="{{ $val->id }} ">{{ $val->designation }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <span style="display:none;padding-top:10px" class="text-danger"
                                    id="designation_validation">Designation Field is Required</span>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Address <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <textarea class="form-control" placeholder="Address" name="address" id="address" rows="3"></textarea>
                                </div>
                                <span style="display:none" class="text-danger" id="address_validation">
                                    Address Field is Required</span>
                            </div>


                            <div class="col-md-4">
                                <label class="form-label">Mobile No <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="mobile_no" id="mobile_no"
                                        placeholder="Mobile No">
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
                                        id="alternate_mobile" placeholder="Alternate Mobile">
                                </div>
                                <small class="text-danger alternate_mobile"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">D.O.B <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" placeholder="MM/DD/YYYY"
                                        type="date" name="dob" id="dob">
                                </div>
                                <span style="display:none" class="text-danger" id="dob_validation">
                                    D.O.B Field is Required</span>
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
                                <small class="text-danger gender"></small>
                            </div>


                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <label class="form-label">Pincode </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="pincode" id="pincode"
                                        placeholder="Pincode">
                                </div>
                                <small class="text-danger pincode"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Area </label>
                                <div class="input-group">
                                    <select name="area" id="area" class="form-control SlectBox">
                                        <option value="">Select area</option>
                                    </select>
                                </div>
                                <small class="text-danger area"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">City </label>
                                <div class="input-group">
                                    <select name="city_id" id="city_id" class="form-control SlectBox">
                                        <option value="">Select City</option>
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
                                <small class="text-danger bank_name"></small>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <label class="form-label">Account No </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="account_no" id="account_no"
                                        placeholder="Account No">
                                </div>
                                <small class="text-danger account_no"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">IFSC Code</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="ifsc_code" id="ifsc_code"
                                        placeholder="IFSC Code">
                                </div>
                                <small class="text-danger ifsc_code"></small>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Bank Branch </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="bank_branch" id="bank_branch"
                                        placeholder="Bank Branch">
                                </div>
                                <small class="text-danger bank_branch"></small>
                            </div>


                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <label class="form-label">Introduced By</label>
                                <div class="input-group">
                                    <select name="introduced_by" id="introduced_by" class="form-control SlectBox">
                                        <option value="">Select Type</option>
                                        @if (isset($designation))
                                            @foreach ($designation as $val)
                                                <option value="{{ $val->id }} ">{{ $val->designation }}</option>
                                            @endforeach
                                        @endif
                                        <option value="thired_party">Third Party</option>
                                    </select>
                                </div><small class="text-danger introduced_by"></small>
                            </div>


                            <div class="col-md-4" id="select_introducer" style="display:none">
                                <label class="form-label">Select Introducer</label>
                                <div class="input-group">
                                    <select name="introducer" id="introducer" class="form-control SlectBox">
                                        <option value="">Select Introducer</option>
                                    </select>
                                </div><small class="text-danger introducer"></small>
                            </div>


                            <div class="col-md-4" id="select_introducer_id" style="display:none">
                                <label class="form-label">Introducer ID</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="introducer_id" id="introducer_id"
                                        placeholder="Introducer ID">
                                </div><small class="text-danger introducer_id"></small>
                            </div>

                            <div class="col-md-4" id="thired_part_1" style="display:none">
                                <label class="form-label">Third Party Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="thired_party_name"
                                        id="thired_party_name" placeholder="Third Party Name">
                                </div><small class="text-danger thired_party_name"></small>
                            </div>

                            <div class="col-md-4" id="thired_part_2" style="display:none">
                                <label class="form-label">Third Party Mobile</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="thired_party_mobile"
                                        id="thired_party_mobile" placeholder="Third Party Mobile">
                                </div><small class="text-danger thired_party_mobile"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Status</label>
                                <div class="input-group">
                                    <select name="status" id="status" class="form-control SlectBox">
                                        <option value="1">Active</option>
                                        <option value="0">In Active</option>
                                    </select>
                                </div><small class="text-danger Active"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <button type="submit" class="btn btn-primary me-2">Add</button>
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
