@extends('layouts.app')
@section('content')
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Project History</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form>
                            @csrf
                            @method('POST')
                            <div class="container">
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <h4 class="fw-bold mt-1" style="color: #6259ca; text-align:center;">Project Details
                                        </h4>
                                    </div>
                                    <div class="col-12" >
                                <div class="col-md-4">
                                 <br><br>
                                  @php
                                     $permission = new \App\Models\Permission();
                                    $print_check = $permission->checkPermission('projecthistory.print');
                                @endphp
                                @if($print_check == 1) 
                                <a  class="btn btn-primary me-2 btnprn" id="project_history_print"
                                                href="#" title="Project History Print"
                                                style="padding: 4px;width:45px ; border-radius:5px;">
                                                Print</a>
                                @endif
                            </div>
                            </div>
                                </div>
                                 <br>
                                <div class="row border border-light-subtle" style="border-radius:5px;">
                                    
                                   <div class="col-12">
                                              <div class="row">
                                                   <div class="col-md-4">
                                        <label class="form-label">Project Name <span class="text-red">*</span></label>
                                        <select name="get_project_id" id="get_project_id" class="form-control SlectBox">
                                            <option value="">Select Project</option>
                                            @if (isset($projects))
                                                @foreach ($projects as $project)
                                                    <option value="{{ $project->id }}">{{ $project->short_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span id="project_name_validation" class="text-danger" style="display:none;">Project
                                            Field is Required</span>
                                    </div>
                                                    <div class="col-md-4"><br><br>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label class="form-label text-start">Full Name :</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="input-group">
                                                                    <label class="form-label text-success"
                                                                        id="full_name">
                                                                    </label>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   <div class="col-md-4"><br><br>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Start Date :</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <label class="form-label text-success"
                                                                        id="start_date" style="padding-right:2px !important;">
                                                                    </label>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                             <br>
                                             <br>
                                     <div class="col-12">
                                              <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label text-start">Total Days :</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <label class="form-label text-success"
                                                                        id="total_days">
                                                                    </label>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">First Booking Date:</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <label class="form-label text-success"
                                                                        id="first_booking_date">
                                                                    </label>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Last Booking Date:</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <label class="form-label text-success"
                                                                        id="last_booking_date">
                                                                    </label>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                   
                              
                            </div>
                             </div>
                            <div class="container">
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <h4 class="fw-bold mt-1" style="color: #6259ca; text-align:center;">Plots Details
                                        </h4>
                                    </div>
                                </div>
                                <div class="row border border-light-subtle" style="border-radius:5px;">
                                    <div class="col-12">
                                              <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label text-start">Total Plots :</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <label class="form-label text-success"
                                                                        id="total_plots">
                                                                    </label>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Booked Plots :</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <label class="form-label text-success"
                                                                        id="total_booking">
                                                                    </label>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Vacant Plots :</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <label class="form-label text-success"
                                                                        id="vacant_plots">
                                                                    </label>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Total Sq.Ft :</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <label class="form-label text-success"
                                                                        id="total_sqft">
                                                                    </label>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Booked Sq.Ft :</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <label class="form-label text-success"
                                                                        id="booked_sqft">
                                                                    </label>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Vacant Sq.Ft :</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <label class="form-label text-success"
                                                                        id="vacant_sqft">
                                                                    </label>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Reg.Pending Plots :</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <label class="form-label text-success"
                                                                        id="reg_pending_plots">
                                                                    </label>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Registered Plots :</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <label class="form-label text-success"
                                                                        id="register_plots">
                                                                    </label>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   </div>
                                                   <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Reg Pending Sq.Ft :</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <label class="form-label text-success"
                                                                        id="reg_pending_sqft">
                                                                    </label>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Registered Sq.Ft :</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <label class="form-label text-success"
                                                                        id="reg_sqft">
                                                                    </label>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                         
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="container">
                                
                               
                                   

                                                <div class="row">
                                                    <div class="table-responsive"  >
                                                        <br>
                                                        <table id="vacant_plot_table" style="width:100 % !important"
                                                            class="table border table-bordered text-nowrap text-md-nowrap table-striped mg-b-0">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width:5 % !important">S.No</th>
                                                                    <th style="width:10 % !important">Customer Name</th>
                                                                    <th style="width:10 % !important">Booked Date</th>
                                                                    <th style="width:10 % !important">Marketer <br>ID</th>
                                                                    <th style="width:10 % !important">Marketer <br>Name</th>
                                                                     <th style="width:5 % !important">Plot No</th>
                                                                    <th style="width:5 % !important">Sq Ft</th>
                                                                    <th style="width:5 % !important">Rate</th>
                                                                    <th style="width:5 % !important">Total Value</th>
                                                                    <th style="width:10 % !important">Total Paid</th>
                                                                    <th style="width:5 % !important">Discount</th>
                                                                    <th style="width:10 % !important">Balance</th>
                                                                    <th style="width:10 % !important">Reg.No</th>
                                                                    <th style="width:10 % !important">Reg.Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="vacant_plot_body" class="border">
                                                                <tr id="table_row_1">
                                                                    <td colspan="14" style="text-align:center">No Data
                                                                        Found</td>
                                                                </tr>
                                                            </tbody>
                                                           
                                                        </table>

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
        // Getting Plot Details
$('#get_project_id').on('change', function() {
          id = this.value;
         if(id != '')
         {
                    var project_history_print = '{{ url('/') }}/project-history/' + id +'/print';
                             $("#project_history_print").attr('href',project_history_print);
             let url = $('meta[name="base_url"]').attr("content") +
            "/get-plot-details/" + id;
          $.ajax({
                url: url,
                method: "GET",
                data: {
                    id: id
                },
                contentType: false,
                processData: false,
                success: function(res) {
                 $('#full_name').text(res.project.full_name);
                 $('#start_date').text(res.project_date);
                 $('#first_booking_date').text(res.first_booking_date);
                 $('#last_booking_date').text(res.last_booking_date);
                 $('#total_plots').text(res.plots);
                 $('#total_booking').text(res.booking_count);
                 $('#reg_pending_plots').text(res.reg_pending_count)
                 $('#vacant_plots').text(res.vacant_plots)
                 $('#register_plots').text(res.registered_plots)
                 if(res.total_sqft != '' || res.total_sqft != null)
                 {
                     total_sqft = 0;
                    
                 }else{
                      total_sqft = res.total_sqft.toFixed(2);
                 }
                 $('#total_sqft').text(total_sqft)
                 if(res.reg_sqft == null)
                 { 
                      reg_sqft = 0;
                     
                 }else{
                     reg_sqft = res.reg_sqft.toFixed(2);
                     
                   
                 }
                 $('#reg_sqft').text(reg_sqft)
                 if(res.booking_sqft == null)
                 {
                      booking_sqft = 0;
                    
                 }else{
                     booking_sqft = res.booking_sqft.toFixed(2);
                 }
                 $('#booked_sqft').text(booking_sqft)
                 if(res.reg_pending_sqft == null)
                 {
                     reg_pending_sqft = 0;
                    
                 }else{
                     reg_pending_sqft = res.reg_pending_sqft.toFixed(2); 
                 }
                 $('#reg_pending_sqft').text(reg_pending_sqft)
                 if(res.vacant_sqft == null)
                 {
                     vacant_sqft = 0;
                     
                 }else{
                     vacant_sqft = res.vacant_sqft.toFixed(2);
                 }
                 $('#vacant_sqft').text(vacant_sqft)
                 $('#total_days').text(res.numberDays)
                 if (res.table_data.length > 0) {
                     
                      $("#vacant_plot_table tbody").empty();
                      $("#vacant_plot_table tbody").append(res.table_data);
             
                    }else{
                        $("#vacant_plot_table tbody").empty();
                        $('#vacant_plot_table tbody').append('<tr><td colspan=5 style="text-align : center">No Data Found</td></tr>');
                   
                   }  
                    
                },
            });
         } else{
              var project_history_print = '{{ url('/') }}/project-history/' + id +'/print';
                             $("#project_history_print").attr('href','#');
         }
        });
        
    </script>
@endsection
