@extends('layouts.app')
@section('content')
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Receive Registration Document</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                         <?php
$project_id = Request::input('project_id');
$plot_id =Request::input('plot_id');
$status =Request::input('status');

?>  
                            <div class="row mt-2">
                                <div class="col-12">
                                    <h5 class="fw-bold mt-1" style="color: #6259ca; text-align:center;">Project Details</h5>
                                </div>
                            </div>
                            <form id="receive-register"  autocomplete="off" url ="{{ route('receive_registration_document') }}">
                            <div class="row border border-light-subtle" style="border-radius:5px;">
                               
                                <div class="col-md-3 mb-2">
                                    <label class="form-label mt-0">Project Name </label>
                                    <select name="project_id" id="receive_project_id" class="form-control SlectBox">
                                        <option value="">Select Project</option>
                                                @if (isset($projects))
                                                    @foreach ($projects as $project)
                                                        <option value="{{ $project->id }}" @if($project_id == $project->id) {{ "selected"}} @endif>{{ $project->short_name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                    </select>
                                 
                                </div>
                                
                                 <div class="col-md-3 mb-2">
                                     <label class="form-label mt-0">Plot No </label>
                                    <select name="plot_id" id="plot_id" class="form-control SlectBox">
                                        <option value="">Select Plot No</option>
                                        @if (isset($plots) && !empty($plots))
                                            @foreach ($plots as $val)
                                                <option value="{{ $val->id }}" @if($plot_id == $val->id) {{ "selected"}} @endif>{{ $val->plot_no }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    
                                </div>
                                <div class="col-sm-6 col-md-3 mb-2">
                                <label class="form-label">Status </label>
                                <div class="input-group">
                                   <select name="status" id="status" class="form-control SlectBox">
                                       <option value="">All</option>
                                       <option value="1"  <?php if($status == 1){ echo  "selected"; } ?> >Completed </option>
                                       <option value="2" <?php if($status == 2){ echo  "selected"; } ?> >Pending </option>
                                    </select>
                                </div>
                             
                            </div>
                                <div class="col-md-3 mt-3">
                                 <br>
                                <button type="submit" class="btn btn-primary me-2">Search</button>
                               
                            </div>
                                
                            </div>
                            </form>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h5 class="fw-bold" style="color: #6259ca; text-align:center;">Registration List</h5>
                                </div>
                            </div>
                            
                        <form id="Add_ReceiveRegistrationDocument_Form" autocomplete="off">
                            @csrf
                            @method('POST')
                            <div class="row border border-light-subtle" style="border-radius:5px;">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="doc_collected_date" class="form-label mt-0">Doc.Collected
                                                Date <span class="text-red">*</span></label>
                                            <input type="date" name="doc_collected_date" id="doc_collected_date"
                                                class="form-control">
                                            <span id="doc_collected_date_validation" class="text-danger"
                                                style="display:none;">Doc.Collected Date Field
                                                is Required</span>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="doc_collected_by" class="form-label mt-0">Doc.Collected By <span class="text-red">*</span></label>
                                              
                                             <select name="doc_collected_by" id="doc_collected_by" class="form-control SlectBox">
                                        <option value="">Select </option>
                                        @if (isset($users) && !empty($users))
                                            @foreach ($users as $val)
                                                <option value="{{ $val->id }}" >{{ $val->reference_code }} - {{$val->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                            <span id="doc_collected_by_validation" class="text-danger"
                                                style="display:none;">Doc.Collected By Field
                                                is Required</span>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="mobile_no" class="form-label mt-0">Mobile</label>
                                            <input type="text" name="doc_collected_mobile" id="doc_collected_mobile" class="form-control">
                                            <span id="doc_collected_mobile_validation" class="text-danger" style="display:none;">Mobile
                                                Field
                                                is Required</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="table-responsive">
                                        <table id="plot_expense_lists" class="table table-bordered text-nowrap mb-0">
                                            <thead class="border text-center">
                                                <tr>
                                                    <th class="bg-transparent border-bottom-0">S.no</th>
                                                    <th class="bg-transparent border-bottom-0">Project Name</th>
                                                    <th class="bg-transparent border-bottom-0">Plot No.</th>
                                                    <th class="bg-transparent border-bottom-0">Customer Name</th>
                                                    <th class="bg-transparent border-bottom-0">Mobile</th>
                                                    <th class="bg-transparent border-bottom-0">Booked Date</th>
                                                    <th class="bg-transparent border-bottom-0">Registered Date</th>
                                                    <th class="bg-transparent border-bottom-0">Plot Sq.Ft.</th>
                                                    <th class="bg-transparent border-bottom-0">Reg Document No</th>
                                                    <th class="bg-transparent border-bottom-0">Status</th>
                                                    <th class="bg-transparent border-bottom-0">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table_tbody_row" class="border">
                                                 <?php
                                                 $i = 1;
                                                    $sqft_total = 0;
                                                   foreach($query as $payment)
                                                   {
                                                       
                                                       
                                                     if($payment->reg_expense == 1)
                                                     {
                                                         $reg_expense = "Company";
                                                     }else{
                                                         $reg_expense = "Customer";
                                                     }
                                                     
                                                     if(isset($payment->customer_id))
                                                     {
                                                      $get_customer = \App\Models\Booking::where('id',$payment->customer_id)->first();   
                                                       $customer_name = $get_customer->customer_name;
                                                         $customer_mobile = $get_customer->mobile;
                                                     }else{
                                                         $customer_name = $payment->customer_name;
                                                         $customer_mobile = $payment->mobile;
                                                     }
                                                     
                                                     
                                                     $paid_date = \App\Models\Payment::where('project_id',$payment->project_id)
                                                                  ->where('plot_id',$payment->plot_id)->orderby('id','desc')->first();
                                                       ?>
                                                       
                                                       <?php
                                                       
                                                     
                                                    if($payment->doc_receive_status == 1){
                                                        
                                                        $status = "Completed";
                                                    }else{
                                                        $status = "Pending";
                                                    }
                                                    ?>
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $payment->short_name }}</td>
                                                    <td>{{ $payment->plot_no }}</td>
                                                    <td>{{ $customer_name }}</td>
                                                    <td>{{ $customer_mobile }} </td>
                                                    <td>{{ date('d-m-Y',strtotime($payment->receipt_date)) }}</td>
                                                    <td>{{ date('d-m-Y',strtotime($paid_date->receipt_date)) }}</td>
                                                    <td>{{ $payment->plot_sq_ft }}</td>
                                                    <td>
                                                        <input type="text" name="reg_no[{{ $payment->id }}]" id="reg_no" <?php if($payment->doc_receive_status == 1){ ?>
                                                        value = "{{ $payment->reg_no }}" readonly <?php } ?>
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                      <h6 class="fs-14 fw-bold text-end pt-2 text-success">{{ $status }}</h6>
                                                    </td>
                                                    <td>
                                                       <label class="custom-control custom-checkbox">
								 	<input type="checkbox" class="custom-control-input plot_sqft" <?php if($payment->doc_receive_status == 1){ ?> disabled checked <?php } ?>  value = "{{ $payment->id }}" 
								 	data-sqft="{{$payment->plot_sq_ft}}_{{$payment->id}}" name="plot_sqft[{{ $payment->id }}]" id="plot_sqft_{{$payment->id}}">
								 	<span class="custom-control-label "> </span>
								 </label>
							      
                                                    </td>
                                                </tr>
                                                 <?php
                                                      $sqft_total +=  $payment->plot_sq_ft;
                                                   }
                                                   
                                             
                                              
                                              ?>
                                                <tr>
                                                    <td colspan="6">
                                                        <h6 class="fs-15 fw-bold text-end pt-2 text-danger">Total :</h6>
                                                    </td>
                                                    <td colspan="5"><input type="text" name="total_plot_sqft"
                                                            id="total_plot_sqft" class="form-control" placeholder="{{ number_format($sqft_total,2) }} "
                                                            style="width: 100px;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                   <td colspan="6">
                                                        <h6 class="fw-bold text-end pt-2 text-danger">Selected
                                                            <span id="selected_value">(0)</span> :
                                                        </h6>
                                                    </td>
                                                    <td colspan="5"> 
                                                    <input type="text" name="selected_total" id="selected_total"
                                                            class="form-control" style="width:150px; color:#09ad95 !important;"
                                                            placeholder="0.00">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 my-2 d-flex align-items-center justify-content-end">

                                    <button type="submit" class="btn btn-primary me-2" id="register_btn">Receive</button>
                                    <!-- <a class="btn btn-light" href="#">Cancel</a> -->

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
    <script>
 
 $('#receive_project_id').on('change', function() {
          id = this.value;
       
         if(id != '')
         {
             $("#plot_id").html("<option value=''>Select Plot No</option>")
             let url = $('meta[name="base_url"]').attr("content") +
            "/get-register-plot-list/" + id;
          $.ajax({
                url: url,
                method: "GET",
                data: {
                    id: id
                },
                contentType: false,
                processData: false,
                success: function(res) {
                     var text = "";
                     
                    if (res.data.length > 0) {
                       
                  for (var i = 0; i < res.data.length; i++) {
                       text += $("#plot_id").append(
                        '<option value="' +
                            res.data[i]["id"] +
                            '">' +
                            res.data[i]["plot_no"] +
                            "</option>"
                    );
                    
                }
                     
                    }
                      
                },
            });
         }else{
              $("#plot_id").html("<option value=''>Select Plot No</option>"); 
           }
              
        });
 
    var total = 0;
    var i = 0;
    $( ".plot_sqft" ).each(function(index) {
        $('#register_btn').prop('disabled',true);
    
    $(this).on("click", function(){
      
        var boolKey = $(this).data('sqft');
        var test = boolKey.split("_");
        
        var value = test[0];
       if ($(this).prop('checked')==true){
        total = Number(total) + Number(test[0]);
        i++;
       }else{
        total = Number(total) - Number(test[0]); 
        i--;
       }
       
        
       var val = '('+i+')';
       $('#selected_value').html(val);
       $('#selected_total').val(total).css('color','#09ad95');
       
       if(i != 0)
       {
           $('#register_btn').prop('disabled',false);
       }else{
           $('#register_btn').prop('disabled',true);
       }
     });
    
  
});  


//  $('#project_id').change(function () { //Event handler for drop down
//         var form = $(this).closest('form');
//         $(form).submit();// this fires submit event of form
//     });
// var receiptNos2 = $("#sqft input:checkbox:checked").map(function () {
//     return $(this).data('sqft')
// }).get();
    </script>
@endsection

