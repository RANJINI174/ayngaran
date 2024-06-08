@extends('layouts.app')
@section('content')
    <div class="row mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add Staff Detail</div>
                </div>
                <div class="card-body">
                    <form id="Add_staff_detailsForm" class="p-3">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" id="url" value="{{ route('staff_detail_store') }}">
                                <label class="form-label">Staff Code</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="staff_code" id=""
                                        value="EMP-001" readonly>
                                </div>
                                <small class="text-danger staff_code"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Director <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="director_id" class="form-control SlectBox">
                                        <option value="">Select Director</option>
                                        @foreach ($directors as $director)
                                            <option value="{{ $director->id }}">{{ $director->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <small class="text-danger director_id"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Marketing Manager <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="marketing_manager_id" class="form-control SlectBox">
                                        <option value="">Select Manager</option>
                                        @foreach ($m_managers as $m_manager)
                                            <option value="{{ $m_manager->id }}">{{ $m_manager->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <small class="text-danger marketing_manager_id"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Marketing Supervisor <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="marketing_supervisor_id" class="form-control SlectBox">
                                        <option value="">Select Supervisor</option>
                                        @foreach ($m_supervisors as $m_supervisor)
                                            <option value="{{ $m_supervisor->id }}">{{ $m_supervisor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <small class="text-danger marketing_supervisor_id"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Marketing Executive<span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="marketing_executive_id" class="form-control SlectBox">
                                        <option value="">Select Executive</option>
                                        @foreach ($m_executives as $m_executive)
                                            <option value="{{ $m_executive->id }}">{{ $m_executive->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <small class="text-danger marketing_executive_id"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Staff Name <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="staff_name" id=""
                                        placeholder="Staff Name">
                                </div><small class="text-danger staff_name"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Email <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="email" id=""
                                        placeholder="Email">
                                </div>
                                <small class="text-danger email"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Mobile <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="mobile" id=""
                                        placeholder="Mobile">
                                </div>
                                <small class="text-danger mobile No"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Alternate Mobile <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="alternate_mobile" id=""
                                        placeholder="Alternate Mobile">
                                </div>
                                <small class="text-danger phone"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">D.O.B <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" placeholder="MM/DD/YYYY"
                                        type="date" name="dob">
                                </div>
                                <small class="text-danger dob"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Gender <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="gender" class="form-control SlectBox">
                                        <option value="">Select Gender</option>
                                        <option value="1">Male</option>
                                        <option value="0">Female</option>
                                    </select>
                                </div>
                                <small class="text-danger gender"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Street <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="street" id=""
                                        placeholder="Street">
                                </div>
                                <small class="text-danger street"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Branch <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="branch" class="form-control SlectBox">
                                        <option value="">Select Branch</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <small class="text-danger branch"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Designation <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="designation" class="form-control SlectBox">
                                        <option value="">Select Designation</option>
                                        @foreach ($designations as $designation)
                                            <option value="{{ $designation->id }}">{{ $designation->designation }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <small class="text-danger designation"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Pincode <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="pincode" id="pincode"
                                        placeholder="Pincode">
                                </div>
                                <small class="text-danger pincode"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Area <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="area" id="area" class="form-control SlectBox">
                                        <option value="">Select area</option>
                                    </select>
                                </div>
                                <small class="text-danger area"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">City <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="city_id" id="city_id" class="form-control SlectBox">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                                <small class="text-danger city_id"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">District <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="district_id" class="form-control SlectBox">
                                        <option value="">Select District</option>
                                        <option value="1">Erode</option>
                                        <option value="2">Coimbatore</option>
                                        <option value="3">Chennai</option>
                                    </select>
                                </div>
                                <small class="text-danger district_id"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">State <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="state_id" id="state_id" class="form-control SlectBox">
                                        <option value="">Select State</option>
                                    </select>
                                </div>
                                <small class="text-danger state_id"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Country <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="country_id" class="form-control SlectBox">
                                        <option value="">Select Country</option>
                                        <option value="1">India</option>
                                    </select>
                                </div>
                                <small class="text-danger country_id"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Attendace Applicable <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="attendace_applicable"
                                        id="" placeholder="Attendace Applicable">
                                </div>
                                <small class="text-danger attendace_applicable"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Food Allowance <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="food_allowance" id=""
                                        placeholder="Food Allowance">
                                </div>
                                <small class="text-danger food_allowance"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Salary <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="salary" id=""
                                        placeholder="Salary">
                                </div>
                                <small class="text-danger salary"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Eligible Level <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="eligible_level" id=""
                                        placeholder="Eligible Level">
                                </div>
                                <small class="text-danger eligible_level"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 my-3">
                                <div class="input-group ">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
