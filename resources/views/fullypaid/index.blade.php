@extends('layouts.app')
@section('content')
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Registration Fully Paid List</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                       
 <?php
$project_id = Request::input('project_id');
$plot_id =Request::input('plot_id');
$status =Request::input('status');


?>                    <div class="row mt-2">
                                <div class="col-12">
                                    <h5 class="fw-bold mt-1" style="color: #6259ca; text-align:center;">Fully Paid Details
                                    </h5>
                                </div>
                            </div>
                            <form id="fully_paid_list"   autocomplete="off" url ="{{ route('fullypaid_list') }}">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                <label class="form-label">Project  </label>
                                <div class="input-group">
                                    <input type="hidden" id="url" value="{{ route('store-payment') }}">
                                  <select name="project_id" id="full_paid_project_id" class="form-control SlectBox">
                                        <option value="">Select Project</option>
                                        @if (isset($projects))
                                            @foreach ($projects as $pro)
                                                <option value="{{ $pro->id }} " @if($project_id == $pro->id) {{ "selected" }} @endif>{{ $pro->short_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                             
                            </div>
                            
                             <div class="col-md-3">
                                <label class="form-label">Plot No </label>
                                <div class="input-group">
                                   <select name="plot_id" id="plot_id" class="form-control SlectBox">
                                       <option value="">Select Plot No</option>
                                        @if (isset($plots) && !empty($plots))
                                            @foreach ($plots as $plot)
                                                <option value="{{ $plot->id }} " @if($plot_id == $plot->id) {{ "selected" }} @endif>{{ $plot->plot_no }}</option>
                                            @endforeach
                                        @endif
                                        
                                    </select>
                                </div>
                             
                            </div>
                             <div class="col-md-3">
                                <label class="form-label">Status </label>
                                <div class="input-group">
                                   <select name="status" id="status" class="form-control SlectBox">
                                       <option value="">All</option>
                                       <option value="1"  @if($status == 1) {{ "selected" }} @endif >Completed </option>
                                       <option value="2" @if($status == 2) {{ "selected" }} @endif  > Pending </option>
                                    </select>
                                </div>
                             
                            </div>
                             <div class="col-md-3 mt-3">
                                 <br>
                                <button type="submit" class="btn btn-primary me-2">Search</button>
                               
                            </div>
                                        
                                        
                                    </div>
                                </div>
                                </form>
                                <br>
                                 <form id="Add_fullypaid_Form" autocomplete="off">
                            @csrf
                            @method('POST')
                                <div class="col-12 mt-2">
                                    <div class="table-responsive">
                                        <table id="plot_expense_lists" class="table table-bordered text-nowrap mb-0">
                                            <thead class="border text-center">
                                                <tr>
                                                    <th class="bg-transparent border-bottom-0">S.no</th>
                                                    <th class="bg-transparent border-bottom-0">Project</th>
                                                    <th class="bg-transparent border-bottom-0">Plot No</th>
                                                    <th class="bg-transparent border-bottom-0">Customer</th>
                                                    <th class="bg-transparent border-bottom-0">Mobile</th>
                                                    <th class="bg-transparent border-bottom-0">Booked<br> Date</th>
                                                    <th class="bg-transparent border-bottom-0">Full Paid<br> Date</th>
                                                    <th class="bg-transparent border-bottom-0">Plot<br> Sq.ft</th>
                                                    <th class="bg-transparent border-bottom-0">Reg.<br>Exp.By</th>
                                                    <th class="bg-transparent border-bottom-0">Registration <br>Process</th>
                                                    <th class="bg-transparent border-bottom-0">Status</th>
                                                    <th class="bg-transparent border-bottom-0">Action</th>
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
                                                                  
                                                    if($payment->fully_paid_status == 1){
                                                        
                                                        $status = "Completed";
                                                    }else{
                                                        $status = "Pending";
                                                    }
                                                       ?>
                                                     <tr>  
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $payment->short_name }} </td>
                                                    <td>{{ $payment->plot_no }} </td>
                                                    <td>{{ $customer_name }}</td>
                                                    <td>{{ $customer_mobile }} </td>
                                                    <td>{{ date('d-m-Y',strtotime($payment->receipt_date)) }}</td>
                                                    <td>{{ date('d-m-Y',strtotime($paid_date->receipt_date)) }}</td>
                                                    <td>{{ $payment->plot_sq_ft }}</td>
                                                    <td>{{ $reg_expense }}</td>
                                                   
                                                    <td>
                                                        <input type="text" data-registration="{{ $payment->id }}" value = "{{ $payment->registration_process }}" name="registration_process[{{ $payment->id }}]" id="registration_process"
                                                            class="form-control" <?php if($payment->fully_paid_status == 1){?> readonly   <?php } ?> >
                                                            
                                                    </td>
                                                     
                                                     <td>
                                                         <h6 class="fs-14 fw-bold text-end pt-2 text-success">{{ $status }}</h6>
                                                    </td>
                                                    <td>
                                                        <?php if($payment->fully_paid_status != 1){?>
                                                       
                                                       <a href="#" onclick="updateRegister('{{ $payment->id }}')"> <span class="badge bg-info  me-1 mb-1 mt-1">Update</span></a>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                       
							         <label class="custom-control custom-checkbox">
								 	  <input type="checkbox" <?php if($payment->fully_paid_status == 1){?> disabled  checked <?php } ?> class="custom-control-input plot_sqft"  value = "{{ $payment->id }}" 
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
                                                    <td colspan="7">
                                                        <h6 class="fs-15 fw-bold text-end pt-2 text-danger">Total :</h6>
                                                    </td>
                                                    <td colspan="6">
                                                        <input type="text" name="grand_total" id="grand_total"
                                                            class="form-control" style="width:150px; color:#09ad95 !important;"
                                                            placeholder="{{ number_format($sqft_total,2) }} ">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7">
                                                        <h6 class="fw-bold text-end pt-2 text-danger">Selected
                                                            <span id="selected_value">(0)</span> :
                                                        </h6>
                                                    </td>
                                                    <td colspan="6">
                                                        <input type="text" name="selected_total" id="selected_total"
                                                            class="form-control" style="width:150px; color:#09ad95 !important;"
                                                            placeholder="0.00">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <!--</div>-->
                            <div class="row mt-2">
                                <div class="col d-flex align-items-center justify-content-end">
                                    <button type="submit" class="btn btn-primary me-2" id="register_btn">Confirm</button>
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
  $('#full_paid_project_id').on('change', function() {
          id = this.value;
       
         if(id != '')
         {
             $("#plot_id").html("<option value=''>Select Plot No</option>")
             let url = $('meta[name="base_url"]').attr("content") +
            "/get-fullypaid-plot-list/" + id;
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


function updateRegister(id) {
    
              const narration = $(".form-control[data-registration='" + id + "']").val();
    
              var redirect = $('meta[name="base_url"]').attr('content') + '/fullypaid_list';
               var token = $('meta[name="csrf-token"]').attr("content");
               var formData = new FormData();
                formData.append("_token", "{{ csrf_token() }}");
                 formData.append("id", id);
                  $.ajax({
                            url: '{{ url('/') }}' + "/fullypaid/" + id +"/"+ narration + "/update",
                            data: formData,
                            type: 'GET',
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(res) {
                                if (res.status == true) {
                                    swal("Sucess!", "Updated Successfully..!", "success");
                                    window.location.href = redirect;

                                } else {
                                    swal("Failed", "Please try again. :)", "error");
                                }
                            }
                        });

               
        }
    </script>
@endsection
