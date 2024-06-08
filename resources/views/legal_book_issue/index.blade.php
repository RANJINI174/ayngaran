@extends('layouts.app')
@section('content')
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Legal Book Issue</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form id="Add_LegalBookIssue_Form" autocomplete="off">
                            @csrf
                            @method('POST')
                            <div class="row mt-2">
                                <div class="col-12">
                                    <h5 class="fw-bold" style="color: #6259ca; text-align:center;">Project Details</h5>
                                </div>
                            </div>
                            <div class="row border border-light-subtle" style="border-radius:5px;">
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label mt-0">Project Name <span class="text-red">*</span></label>
                                    <select name="project_id" id="legal_project_id" class="form-control SlectBox">
                                        <option value="">Select Project</option>
                                        @if (isset($projects))
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}">{{ $project->short_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                  <span id="legal_project_id_validation" class="text-danger"
                                                style="display:none;">Project Name Field
                                                is Required</span>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label mt-0">Plot No<span class="text-red">*</span></label>
                                    <select name="plot_id" id="legal_plot_id" class="form-control SlectBox">
                                        <option value="">Select Plot No</option>
                                        @if (isset($plots))
                                            @foreach ($plots as $val)
                                                <option value="{{ $val->id }}">{{ $val->plot_no }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                   <span id="legal_plot_id_validation" class="text-danger"
                                                style="display:none;">Plot No Field
                                                is Required</span>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h5 class="fw-bold" style="color: #6259ca; text-align:center;">Plot Details</h5>
                                </div>
                            </div>
                            <div class="row border border-light-subtle" style="border-radius:5px;">
                                <div class="col-sm-6 col-md-6 mb-2">
                                    <div class="row">
                                        <label for="" class="col-6 col-md-6 col-lg-3 form-label">Plot Sq.Ft.</label>
                                        <div class="col-6 col-md-6 col-lg-9">
                                            <!-- <input type="hidden" class="form-control" name="plot_no" id="plot_no"> -->
                                            <label class="form-label text-success" id="plot_sqft_value">0.00</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h5 class="fw-bold" style="color: #6259ca; text-align:center;">Customer Details</h5>
                                </div>
                            </div>
                            <div class="row border border-light-subtle mt-1" style="border-radius:5px;">
                                <div class="col-md-6 mb-2">
                                    <div class="row">
                                        <label for="" class="col-6 col-md-6 col-lg-3 form-label">Name.</label>
                                        <div class="col-6 col-md-6 col-lg-9">
                                            <!-- <input type="hidden" class="form-control" name="name" id="name"> -->
                                            <label class="form-label text-success" id="customer_name"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 mb-2">
                                    <div class="row">
                                        <label for="" class="col-6 col-md-6 col-lg-3 form-label">Mobile.</label>
                                        <div class="col-6 col-md-6 col-lg-9">
                                            <!-- <input type="hidden" class="form-control" name="mobile_no" id="mobile_no"> -->
                                            <label class="form-label text-success" id="customer_mobile"> </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 mb-2">
                                    <div class="row">
                                        <label for="" class="col-6 col-md-6 col-lg-3 form-label">Reg.No.</label>
                                        <div class="col-6 col-md-6 col-lg-9">
                                            <!-- <input type="hidden" class="form-control" name="reg_no" id="reg_no"> -->
                                            <label class="form-label text-success" id="reg_no"> </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 mb-2">
                                    <div class="row">
                                        <label for="" class="col-6 col-md-6 col-lg-3 form-label">Reg.Date</label>
                                        <div class="col-6 col-md-6 col-lg-9">
                                            <!-- <input type="hidden" class="form-control" name="reg_date" id="reg_date"> -->
                                            <label class="form-label text-success" id="register_date"> </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 mb-2">
                                    <div class="row">
                                        <label for="" class="col-6 col-md-6 col-lg-3 form-label">Collected
                                            By</label>
                                        <div class="col-6 col-md-6 col-lg-9">
                                            <!-- <input type="hidden" class="form-control" name="collected_by" id="collected_by"> -->
                                            <label class="form-label text-success" id="collected_by"> </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 mb-2">
                                    <div class="row">
                                        <label for="" class="col-6 col-md-6 col-lg-3 form-label">Collected
                                            Date</label>
                                        <div class="col-6 col-md-6 col-lg-9">
                                            <!-- <input type="hidden" class="form-control" name="collected_date" id="collected_date"> -->
                                            <label class="form-label text-success" id="collected_date"> </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 mb-2">
                                    <div class="row">
                                        <label for="" class="col-6 col-md-6 col-lg-3 form-label">Reg. Expense
                                            By</label>
                                        <div class="col-6 col-md-6 col-lg-9">
                                            <!-- <input type="hidden" class="form-control" name="reg_expense_by" id="reg_expense_by"> -->
                                            <label class="form-label text-info fw-bold"
                                                style="font-size: 18px;" id="expense_by"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <h5 class="fw-bold" style="color: #6259ca; text-align:center;">Issued To</h5>
                                </div>
                            </div>
                            <div class="row border border-light-subtle mt-1" style="border-radius:5px;">
                                <div class="col-sm-6 col-md-6 mb-2">
                                    <label for="" class="form-label mt-0">Name.</label>
                                    <input type="text" class="form-control" name="issue_to_name" id="issue_to_name"
                                        placeholder="Name">
                                    <!-- <span id="issue_to_name_validation" class="text-danger" style="display:none;">
                                                                                                                    Name Field is Required</span> -->
                                </div>
                                <div class="col-sm-6 col-md-6 mb-2">

                                    <label for="" class="form-label mt-0">Mobile.</label>

                                    <input type="text" class="form-control" name="issue_to_mobile_no"
                                        id="issue_to_mobile_no" placeholder="Mobile">
                                    <!-- <label class="form-label text-success">897645332</label> -->


                                </div>
                                <!--<div class="col-12 mt-1">-->
                                <!--    <label class="custom-control custom-checkbox">-->
                                <!--        <input type="checkbox" class="custom-control-input" name="legal_book_issue"-->
                                <!--            id="legal_book_issue">-->
                                <!--        <span class="custom-control-label fw-semibold fs-14">Legal Book Issue</span>-->
                                <!--    </label>-->
                                <!--</div>-->
                            </div>
                            <!--<div class="row mt-3">-->
                            <!--    <div class="col-12">-->
                            <!--        <h5 class="fw-bold" style="color: #6259ca; text-align:center;">SMS Details</h5>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="row border border-light-subtle mt-1" style="border-radius:5px;">-->
                            <!--    <div class="col-md-4">-->
                            <!--        <label class="form-label">Resend Code</label>-->
                            <!--        <button type="button" class="btn btn-flickr"><i-->
                            <!--                class="fa fa-flickr me-2"></i>Message</button>-->
                            <!--    </div>-->
                            <!--    <div class="col-md-4">-->
                            <!--        <label class="form-label">Code</label>-->
                            <!--        <div class="input-group">-->
                            <!--            <input type="password" class="form-control" name="code" id="code"-->
                            <!--                placeholder="Code">-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="col-md-4">-->
                            <!--        <div class="form-group">-->
                            <!--                                                            <div class="form-label">Upload</div>-->
                            <!--                                                            <div class="form-file">-->
                            <!--                                                                <input type="file" class="form-file-input" name="example-file-input-custom">-->
                            <!--                                                                <label class="form-file-label">Choose file</label>-->
                            <!--                                                            </div>-->
                            <!--                                                        </div>-->
                            <!--    </div>-->


                            <!--</div>-->
                            <div class="row mt-2">
                                <div class="col d-flex align-items-center justify-content-end">
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script></script>
@endsection
