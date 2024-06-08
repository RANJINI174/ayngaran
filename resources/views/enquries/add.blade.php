@extends('layouts.app')
@section('content')
    <!-- PAGE-HEADER END -->
    <div class="row row-sm mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add Enquiry</div>
                </div>
                <div class="card-body">
                    <form id="Add_enquiryForm" class="p-3">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Customer Name <span class="text-red">*</span></label>
                                <input type="hidden" id="url" value="{{ route('enquiry_store') }}">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="customer_name" id=""
                                        placeholder="Customer Name">
                                </div>
                                <small class="text-danger customer_name"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Email <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="email" id=""
                                        placeholder="Email">
                                </div><small class="text-danger email"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Mobile No <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="mobile" id=""
                                        placeholder="Mobile No">
                                </div>
                                <small class="text-danger mobile"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Alternate Mobile</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="alternate_mobile" id=""
                                        placeholder="Alternate Mobile">
                                </div>
                                <small class="text-danger alternate_mobile"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Address <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="address" id=""
                                        placeholder="Address">
                                </div>
                                <small class="text-danger address"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Pincode<span class="text-red">*</span></label>
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
                                <label class="form-label">State <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="state_id" id="state_id" class="form-control SlectBox">
                                        <option value="">Select State</option>
                                    </select>
                                </div>
                                <small class="text-danger state_id"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Customer Status<span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="customer_status" class="form-control SlectBox">
                                        <option value="">Select Status</option>
                                        <option value="1">Single</option>
                                        <option value="2">Family</option>
                                    </select>
                                </div>
                                <small class="text-danger customer_status"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Site Visit<span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="site_visit" id="site_visit"
                                        placeholder="Site">
                                </div>
                                <small class="text-danger site_visit"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Marketing Person Default by <span
                                        class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="is_admin" id="is_admin"
                                        placeholder="Admin" value="Venkdasalam P" readonly>
                                </div>
                                <small class="text-danger is_admin"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Transportation <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="transporation" id="transporation" class="form-control SlectBox">
                                        <option value="">Select Transportation</option>
                                        <option value="1">Customer</option>
                                        <option value="2">Company</option>
                                    </select>
                                </div>
                                <small class="text-danger transporation"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Pickup Location<span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="pickup_location" id=""
                                        placeholder="Pickup Location">
                                </div>
                                <small class="text-danger pickup_location"></small>
                            </div>
                            <div class="col-md-4 company_spacality" style="display:none;">
                                <label class="form-label">Equipment <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <select name="equipment" id="equipment" class="form-control SlectBox">
                                        <option value="">Select Equipment</option>
                                    </select>
                                </div>
                                <small class="text-danger equipment"></small>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-4 company_spacality" style="display:none;">
                                <label class="form-label">Start KM<span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="start_km" id="start_km"
                                        placeholder="Start KM">
                                </div>
                                <small class="text-danger start_km"></small>
                            </div>
                            <div class="col-md-4 company_spacality" style="display:none;">
                                <label class="form-label">End KM<span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="end_km" id="end_km"
                                        placeholder="End KM">
                                </div>
                                <small class="text-danger end_km"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 my-3">

                                <button type="submit" class="btn btn-primary me-1">Add</button>
                                <a href="{{ url('/enquiry-lists') }}" class="btn btn-light">Cancel</a>

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
        $(document).on('change', '#transporation', function() {
            let transporation_value = $("#transporation").val();
            if (transporation_value == 2) {
                $(".company_spacality").css('display', 'block');
                $("#equipment").html(
                    ' <option value="">Select Equipment</option><option value="1">Two Wheeler</option> <option value="2">Four Wheeler</option>'
                );
            } else {
                $("#end_km").val('');
                $('#start_km').val('');
                $("#equipment").html(' <option value="">Select Equipment</option>');
                $(".company_spacality").css('display', 'none');
            }
        });
    </script>
@endsection
