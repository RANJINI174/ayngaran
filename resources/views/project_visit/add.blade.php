@extends('layouts.app')
@section('content')
    <!-- PAGE-HEADER END -->
    <div class="row row-sm mt-2">
        <div class="col-lg-12">
             <form id="Add_projectvisitForm"  autocomplete="off">
                    @csrf
                        @method('POST')
            <div class="card" style="padding:8px !important;">
                <div class="card-header">
                    <div class="card-title">Site Visit Create</div>
                </div>
                
                <div class="card-body">
                 
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Visit Number</label>
                                <div class="input-group">
                                    <?php
                                    $ref_no  = '';
                                     if($count == 0)
                                      {
                                       $ref_no = 'V-001';   
                                      }
                                      else{
                                       $get_count = $count + 1;
                                      $ref_no = 'V-00'.$get_count;   
                                      }
                                      
                                      
                                      
                                      ?>
                                       <input type="text" class="form-control" name="visit_number" id="visit_number"
                                            value="{{ $ref_no }}" readonly>
                                    
                                </div>
                                <input type="hidden" id="url" value="{{ route('project_visit_store') }}">
                                <small class="text-danger reference_code"></small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Visit Date <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker"  
                                        type="date" name="visit_date" id="visit_date" value="{{ date('Y-m-d') }}">
                                 </div>
                                 <br>
                               <span style="display:none" class="text-danger" id="visit_date_validation">Visit Date Field is
                                    Required</span>
                            </div>
                            
                           <div class="col-md-4">
                                <label class="form-label">Customer Name <span class="text-red">*</span></label>
                                <div class="input-group">
                                   <input type="text" class="form-control" name="customer_name" id="customer_name"
                                        placeholder="Customer Name">
                                </div>
                                 <span style="display:none" class="text-danger" id="customer_name_validation">Customer Name Field is
                                    Required</span>

                            </div>
                            
                           <div class="col-md-4">
                                <label class="form-label">No.of Person <span class="text-red">*</span></label>
                                <div class="input-group">
                                   <input type="text" class="form-control" name="no_of_person" id="no_of_person"
                                        placeholder="No.of Person">
                                </div>
                                 <span style="display:none" class="text-danger" id="no_of_person_validation">No.of Person Field is
                                    Required</span>

                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label">Team  <span class="text-red">*</span></label>
                                <div class="input-group">
                            
                                  <select name="team" id="team"   class="form-control SlectBox">
                                        <option value="">Select Team</option>
                                        
                                        @if(isset($team_name))
                                        @foreach($team_name as $team)
                                        <option value="{{ $team->team_name }} ">{{ $team->team_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div><br>
                               <span style="display:none" class="text-danger" id="team_validation">Team Field is
                                     Required</span>
                            </div>
                        
                            <div class="col-md-4">
                                <label class="form-label">Marketer <span class="text-red">*</span></label>
                                <div class="input-group">
                                   <select name="marketer_id" id="marketer_id"  class="form-control SlectBox">
                                       <option value="">Select Marketer</option>
                                        @if (isset($marketer) && !empty($marketer))
                                            @foreach ($marketer as $val)
                                                <option value="{{ $val->id }}" >{{$val->reference_code }} - {{ $val->name }}</option>
                                            @endforeach
                                        @endif
                                        
                                    </select>
                                </div><br>
                             <span style="display:none" class="text-danger" id="marketer_id_validation">Marketer Field is
                                    Required</span>
                            </div>
                            
                            
                            <div class="col-md-4">
                                <label class="form-label">Project Name<span class="text-red">*</span></label>
                                <div class="input-group">
                                   <select name="project_id[]" id="project_id"  data-placeholder="Select Project" class="form-control SlectBox" multiple>
                                       <option value="">Select Project</option>
                                        @if (isset($projects) && !empty($projects))
                                            @foreach ($projects as $val)
                                                <option value="{{ $val->id }} " >{{ $val->short_name }}</option>
                                            @endforeach
                                        @endif
                                        
                                    </select>
                                </div>
                                <!-- <div class="form-group">-->
                                <!--    <label class="form-label">Users list</label>-->
                                <!--    <select class="form-control select2" data-placeholder="Choose Browser" multiple>-->
                                <!--        <option value="Firefox">-->
                                <!--            Firefox-->
                                <!--        </option>-->
                                <!--        <option value="Chrome selected">-->
                                <!--            Chrome-->
                                <!--        </option>-->
                                <!--        <option value="Safari">-->
                                <!--            Safari-->
                                <!--        </option>-->
                                <!--        <option selected value="Opera">-->
                                <!--            Opera-->
                                <!--        </option>-->
                                <!--        <option value="Internet Explorer">-->
                                <!--            Internet Explorer-->
                                <!--        </option>-->
                                <!--    </select>-->
                                <!--</div>-->
                                <br>
                              <span style="display:none" class="text-danger" id="project_validation">Project Field is
                                    Required</span>

                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Vehicle <span class="text-red">*</span></label>
                                <div class="input-group">
                                   <!--<input type="text" class="form-control" name="vehicle" id="vehicle"-->
                                   <!--     placeholder="Vehicle">-->
                                    <select name="vehicle" id="vehicle"   class="form-control SlectBox">
                                       <option value="">Select Project</option>
                                        @if (isset($vehicles) && !empty($vehicles))
                                            @foreach ($vehicles as $val)
                                                <option value="{{ $val->id }} " >{{ $val->vehicle_name }}</option>
                                            @endforeach
                                        @endif
                                        
                                    </select>
                                </div>
                                 <span style="display:none" class="text-danger" id="vehicle_validation">Vehicle Field is
                                    Required</span>

                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label">Trip Distance</label>
                                <div class="input-group">
                                   <input type="text" class="form-control" name="trip_distance" id="trip_distance"
                                        placeholder="Trip Distance">
                                </div>
                                 <span style="display:none" class="text-danger" id="trip_distance_validation">Trip Distance Field is
                                    Required</span>

                            </div>
                            
                           
                            
                            
                              <div class="col-md-4">
                                <label class="form-label">Feedback  </label>
                                <div class="input-group">
                                  <textarea class="form-control" placeholder="Feedback" name="feedback" id="feedback" rows="3"></textarea>
                                </div>
                                 

                            </div>
                            
                             <br>
                           <div class="row">
                            <div class="col-md-4 mt-3">
                                <button type="submit" class="btn btn-primary me-2" id="add_booking">Add</button>
                                <a href="{{ url('project_visit_list') }}" class="btn btn-light">Cancel</a>
                            </div>
                        </div>
                        </div>
                  
                       
                   
                </div>
                 
            </div>
            
              
            
             
            
            </form>
        </div>
    </div>
@endsection

 
@section('scripts')


     <!-- INTERNAL Bootstrap-Datepicker js-->
    <!--<script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>-->

    <!-- INTERNAL Sumoselect js-->
    <!--<script src="{{ asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>-->

    <!-- TIMEPICKER JS -->
    <!--<script src="{{ asset('assets/plugins/time-picker/jquery.timepicker.js') }}"></script>-->
    <!--<script src="{{ asset('assets/plugins/time-picker/toggles.min.js') }}"></script>-->



    <!-- INTERNAL multi js-->
    <!--<script src="{{ asset('assets/plugins/multi/multi.min.js') }}"></script>-->

  
    <!-- MULTI SELECT JS-->
    <!--<script src="{{ asset('assets/plugins/multipleselect/multiple-select.js') }}"></script>-->
    <!--<script src="{{ asset('assets/plugins/multipleselect/multi-select.js') }}"></script>-->

    <!-- FORMELEMENTS JS -->
    <!--<script src="{{ asset('assets/js/formelementadvnced.js') }}"></script>-->
    <!--<script src="{{ asset('assets/js/form-elements.js') }}"></script>-->


    <script>
               
  $('#team').on('change', function() {  

       id = this.value;
         if(id != '')
         {
             $("#marketer_id").html("<option value=''>Select Marketer</option>")
              let url = $('meta[name="base_url"]').attr("content") +
            "/get-marketers/" + id;
          $.ajax({
                url: url,
                method: "GET",
                data: {
                    id: id
                },
                contentType: false,
                processData: false,
                success: function(res) {
                      var text_1 = "";
                     if (res.data.length > 0) {
                       
                  for (var i = 0; i < res.data.length; i++) {
               
                    
                      text_1 += $("#marketer_id").append(
                        '<option value="' +
                            res.data[i]["id"] +
                            '">' +
                            res.data[i]["name"] +
                            "</option>"
                    );
                    
               
                    
                     }
                     
                     
                     
                     
                   }
                },
            });
         }else{
                      $("#marketer_id").html("<option value=''>Select Marketer</option>"); 
                      
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
