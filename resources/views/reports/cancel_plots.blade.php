@extends('layouts.app')
@section('content')
    <!-- PAGE-HEADER -->
    
     <div class="modal fade" id="Edit_plotModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <b style="font-size:16px !important">Cancelled Plot Customer Details</b>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    
                </div>
                <div class="modal-body">
                    <div class="row">
                      <div class="col-md-2">
                                <label class="form-label" style="font-size:16px !important;color: #6259ca;">Project Name : </label>
                                </div>
                                <div class="col-md-3" style="text-align:left">
                                <div class="input-group">
                                     <label class="form-label"  style="font-size:16px !important;" id="project_name"> </label>
                                  
                                </div>
                            </div>
                    
                   
                    </div>
                    <br>
                    <div class="row">
							<div class="col-lg-12 col-xl-6 col-md-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Customer Details</h4>
									</div>
									<div class="card-body">
					        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">Customer Name  </label>
                                </div>
                                <div class="col-md-3">
                                <div class="input-group">
                                     <label class="form-label text-success" id="customer_name"> </label>
                                  
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Gender  </label>
                                </div>
                                 <div class="col-md-3">
                                <div class="input-group">
                                <label class="form-label text-success" id="gender"> </label>
                                </div>
                              
                            </div>
                           
                          </div>  
                           <div class="row">
                             <div class="col-md-3">
                                <label class="form-label">Mobile  </label>
                                </div>
                                 <div class="col-md-3">
                                <div class="input-group">
                                     <label class="form-label text-success" id="mobile"> </label>
                                  
                                </div>
                            </div>
                             <div class="col-md-3">
                                <label class="form-label">Alternate Mobile  </label>
                                </div>
                                 <div class="col-md-3">
                                <div class="input-group">
                                <label class="form-label text-success" id="alternate_mobile"> </label>
                                </div>
                              
                            </div>
                           
                          </div>   
                           <div class="row">
                             <div class="col-md-3">
                                <label class="form-label">Address </label>
                                </div>
                                 <div class="col-md-3">
                                <div class="input-group">
                                     <label class="form-label text-success" id="address"> </label>
                                  
                                </div>
                            </div>
                           
                          </div>   
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-xl-6 col-md-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Plot Details</h4>
									</div>
                                    <div class="card-body">
					        <div class="row">
                             <div class="col-md-3">
                                <label class="form-label">Plot No</label>
                                </div>
                                 <div class="col-md-3">
                                <div class="input-group">
                                     <label class="form-label text-success" id="plot_no"> </label>
                                  
                                </div>
                            </div>
                             <div class="col-md-3">
                                <label class="form-label">Plot Sq.Ft  </label>
                                </div>
                                 <div class="col-md-3">
                                <div class="input-group">
                                <label class="form-label text-success" id="plot_sqft"> </label>
                                </div>
                              
                            </div>
                           
                          </div>  
                           <div class="row">
                             <div class="col-md-3">
                                <label class="form-label">GV Sq.Ft  </label>
                                </div>
                                 <div class="col-md-3">
                                <div class="input-group">
                                     <label class="form-label text-success" id="gv_sqft"> </label>
                                  
                                </div>
                            </div>
                             <div class="col-md-3">
                                <label class="form-label">GV Plot Rate </label>
                                </div>
                                 <div class="col-md-3">
                                <div class="input-group">
                                <label class="form-label text-success" id="gv_plot_rate"> </label>
                                </div>
                              
                            </div>
                           
                          </div>   
                           <div class="row">
                             <div class="col-md-3">
                                <label class="form-label">Sq.Ft Rate </label>
                                </div>
                                 <div class="col-md-3">
                                <div class="input-group">
                                     <label class="form-label text-success" id="sqft_rate"> </label>
                                  
                                </div>
                            </div>
                              <div class="col-md-3">
                                <label class="form-label">Plot Rate </label>
                                </div>
                                 <div class="col-md-3">
                                <div class="input-group">
                                <label class="form-label text-success" id="plot_rate"> </label>
                                </div>
                              
                            </div>
                           
                          </div>   
                          
                          <div class="row">
                           <div class="col-md-3">
                                <label class="form-label">Total Paid</label>
                                </div>
                                 <div class="col-md-3">
                                <div class="input-group">
                                     <label class="form-label text-success" id="paid"> </label>
                                  
                                </div>
                            </div>
                              <div class="col-md-3">
                                <label class="form-label">Balance </label>
                                </div>
                                 <div class="col-md-3">
                                <div class="input-group">
                                <label class="form-label text-success" id="balance"> </label>
                                </div>
                              
                            </div>
                           
                          </div>   
									</div>
								</div>
							</div>
						</div>
                    
                 <div class="card" style="padding:8px !important;">
                <div class="card-header">
                    <div class="card-title">Marketer Details</div>
                </div>
                
                <div class="card-body">
                 
                        <div class="row">
                             <div class="table-responsive">
                            			    <br>
                            			   
											<table id="marketer_table" class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
												<thead>
													<tr>
														<th>#</th>
														<th>Marketer ID</th>
														<th>Designation</th>
														<th>Name</th>
														<th>Mobile</th>
													</tr>
												</thead>
												<tbody>
												<tr id="table_row_1" >
												    <td colspan="5" style="text-align:center">No Data Found</td>
												</tr>
												</tbody>
											</table>
										 
						</div>
                             
                          </div>
                   </div>
                 
            </div>
                    
                     <div class="card" style="padding:8px !important;">
                <div class="card-header">
                    <div class="card-title">Payment History</div>
                </div>
                
                <div class="card-body">
                 
                        <div class="row">
                    	<div class="table-responsive">
                            			    <br>
                            			   
											<table id="payment_table" class="table border text-nowrap text-md-nowrap table-striped mg-b-0">
												<thead>
													<tr>
                                                        <th>#</th>
														<th>Receipt No</th>
														<th>Date</th>
														<th>Amount</th>
														<th>Discount</th>
														<th>Type</th>
														<th>Paymode</th>
														<th>Payment  Source</th>
														<th>Amount Towards</th>
														<th>Narration</th>
														 
													</tr>
												</thead>
												<tbody>
												<tr id="table_row_1" >
												    <td colspan="10" style="text-align:center">No Data Found</td>
												</tr>
												</tbody>
											</table>
										 
						</div>
                          </div>
                          
                   </div>
             </div>
                 <div class="card" style="padding:8px !important;">
               
                <div class="card-body">
                     <div class="row">
                              <div class="col-md-4">
                    <label class="form-label">Cancellation Reason </label>
                                <div class="input-group">
                                   <textarea class="form-control" placeholder="Description" name="cancel_reason" required id="cancel_reason" rows="3">
                                     </textarea>
                                </div>
                                </div>
                    </div>
                    </div>
                    </div>
            </div>
                </div>
            </div>
        </div>
 

    
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card ">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Cancelled Plot list</h3>
                   
                </div>
                <?php

$project_id = Request::input('project_id');
$plot_id=Request::input('plot_id');

?>
                <div class="card-body">
                     <form  method="get"  autocomplete="off" url ="{{ route('cancel-plots-list') }}">
                    <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Project  </label>
                                <div class="input-group">
                            
                                  <select name="project_id" id="cancel_project_id"  class="form-control SlectBox" >
                                        <option value="">Select Project</option>
                                        @if (isset($projects))
                                            @foreach ($projects as $pro)
                                                <option value="{{ $pro->id }} " @if(isset($project_id)) @if( $pro->id == $project_id) {{ "Selected" }} @endif @endif
                                                >{{ $pro->short_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                             
                            </div>
                            
                             <div class="col-md-4">
                                <label class="form-label">Plots </label>
                                <div class="input-group">
                                   <select name="plot_id[]" id="cancel_plot_id"  style="height:40px !important" class="form-control SlectBox" multiple>
                                       <option value="">Select Plot</option>
                                       <?php
                                       $plots = '';
                                        if(isset($project_id))
            {
            $plots = \App\Models\PlotManagement::leftjoin('booking','booking.plot_id','plot_management.id')
            ->where('plot_management.project_id',$project_id)->whereNotNull('booking.booking_status')->where('plot_management.deleted_at',0)
            ->select('plot_management.id','plot_management.plot_no')->get();
            }
            ?>
                                        @if (isset($plots) && !empty($plots))
                                            @foreach ($plots as $plot)
                                                <option value="{{ $plot->id }} " @if(isset($plot_id)) @if(in_array($plot->id, $plot_id)) {{ "Selected" }} @endif @endif
                                                >{{ $plot->plot_no }}</option>
                                            @endforeach
                                        @endif
                                        
                                    </select>
                                </div>
                             
                            </div>
                             <div class="col-md-4 mt-3">
                                 <br>
                                <button type="submit" class="btn btn-primary me-2">Search</button>
                               
                            </div>
                            </div>
                            </form>
                            <br><br>
                    <div class="row mt-2 border border-light-subtle" style="border-radius:5px;">
                                <div class="table-responsive export-table">
                        <table id="cancel_plot_list" class="table table-bordered text-nowrap mb-0">
                            <thead class="border-top">
                                <tr>
                                    <th class="bg-transparent border-bottom-0 w-5">S.no</th>
                                    <th class="bg-transparent border-bottom-0">Cancelled Date</th>
                                    <th class="bg-transparent border-bottom-0">Booked Date</th>
                                    <th class="bg-transparent border-bottom-0">No of Days</th>
                                    <th class="bg-transparent border-bottom-0">Receipt No</th>
                                    <th class="bg-transparent border-bottom-0">Marketer ID</th>
                                    <th class="bg-transparent border-bottom-0">Marketer Name</th>
                                    <th class="bg-transparent border-bottom-0">Project Name</th>
                                    <th class="bg-transparent border-bottom-0">Plot No</th>
                                    <th class="bg-transparent border-bottom-0">Plot Sq.Ft</th>
                                    <th class="bg-transparent border-bottom-0">Customer Name</th>
                                    <th class="bg-transparent border-bottom-0">District</th>
                                    <th class="bg-transparent border-bottom-0">Customer Mobile</th>
                                    <th class="bg-transparent border-bottom-0">Plot Value</th>
                                    <!--<th class="bg-transparent border-bottom-0">Amount</th>-->
                                    <th class="bg-transparent border-bottom-0">Paid</th>
                                    <th class="bg-transparent border-bottom-0">Paid %</th>
                                    <th class="bg-transparent border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                $total_balance = 0;
                                $discount = 0;
                                $marketer_name = '';
                                $marketer_mobile = '';
                                $marketer_ref = '';
                                $designation = '';
                                $city = '';
                                $receipt_no = '';
                                $customer_name = '';
                                $mobile = '';
                                @endphp
                                
                                @foreach ($query as $payment)
                                
                                <?php 
                                 $plots = \App\Models\Booking::where('project_id',$payment->project_id)->where('plot_id',$payment->plot_id)
                                                     ->first();
                                                     
                                 $customer = \App\Models\Booking::where('id',$payment->customer_id)->first();
                                 
                                 if(isset($customer))
                                 {
                                     $get_area = \App\Models\Pincode::where('id',$customer->area)->first();
                                  if(isset($get_area))
                                  {
                                     $city = $get_area->city;
                                    }
                                    
                                    $customer_name = $customer->customer_name;
                                    $mobile = $customer->mobile;
                                 }
                                 
                                
                                    
                                    
                                    
                                    $get_pay_amount = \App\Models\Payment::where('project_id',$payment->project_id)->where('plot_id',$payment->plot_id)
                                    ->select(DB::raw('SUM(amount) as paid_amount')
                      ,DB::raw('SUM(discount) as discount_amount'))->first();
                      
                      if(isset($get_pay_amount))
                      {
                          $paid_amount = $get_pay_amount->paid_amount;
                          $discount_amount = $get_pay_amount->discount_amount;
                          $discount = $get_pay_amount->discount;
                          
                           $get_paid_per = ($get_pay_amount->paid_amount / $plots->total_value_mv) * 100;
                           
                              $total_balance = $plots->total_value_mv - $paid_amount - $discount_amount;
                           
                      }else{
                          $paid_amount = 0;
                          $discount_amount = 0;
                          $discount = 0;
                          $get_paid_per = 0;
                          
                             $total_balance = $plots->total_value_mv;
                      }
                                 
                              
                                
                                 
                                 
                                 $get_receipt = \App\Models\Payment::where('booking_id',$payment->book_id)->first();
                                 if(isset($get_receipt))
                                 {
                                     $receipt_no = $get_receipt->receipt_no;
                                 }
                                 
                                 $market = \App\Models\User::where('users.id',$payment->marketer_id)->leftjoin('designation','designation.id','users.designation_id')
                                 ->select('users.*','designation.designation')->first();
                        if(isset($market))
                        {
                            $marketer_name = $market->name;
                            $marketer_mobile = $market->mobile_no;
                            $marketer_ref = $market->reference_code;
                            $designation = $market->designation;
                            
                            
                            
                        }
                        
                        
                       
                        
                                $startTimeStamp = strtotime($payment->cancel_date);
                                $endTimeStamp = strtotime($payment->receipt_date);

                               $timeDiff = abs($endTimeStamp - $startTimeStamp);

                               $numberDays = $timeDiff/86400;  // 86400 seconds in one day
                               $numberDays = intval($numberDays)
                                 
                                ?>
                                    <tr class="border-bottom">
                                        <td class="text-muted fs-12 fw-semibold text-center">{{ $i++ }}</td>
                                        <td>
                                            {{ date('d-m-Y',strtotime($payment->cancel_date)) }}
                                        </td>
                                         <td>
                                            {{ date('d-m-Y',strtotime($payment->receipt_date)) }}
                                        </td>
                                         <td>
                                            {{ $numberDays }}
                                        </td>
                                         <td>
                                            {{ $receipt_no }}
                                        </td>
                                        <td>
                                            {{ $marketer_ref }}
                                        </td>
                                        <td>
                                            {{ $marketer_name }}
                                        </td>
                                        
                                        <td>
                                            {{ $payment->short_name }}
                                        </td>
                                        <td>
                                            {{ $payment->plot_no }}
                                        </td>
                                         <td>
                                            {{ $payment->plot_sq_ft }}
                                        </td>
                                         <td>
                                            {{ $customer_name }}
                                        </td>
                                         <td>
                                            {{ $city }}
                                        </td>
                                        <td>
                                            {{ $mobile }}
                                        </td>
                                        
                                         <td>
                                            {{ IND_money_format(round($plots->total_value_mv)) }}
                                        </td>
                                        <td>
                                            {{ IND_money_format(round($paid_amount)) }}
                                        </td>
                                        <td>
                                            {{ IND_money_format(round($get_paid_per)). '%' }}
                                        </td>
                                        
                                        <td class="">
                                            @php
                                                 $permission = new \App\Models\Permission();
                                                $print_check = $permission->checkPermission('cancelledplotlist.read');
                                            @endphp
                                            @if($print_check == 1)
                                            <a class="btn-info border-0 me-1"
                                               href="#"data-bs-toggle="modal" onclick="EditPlot(<?php echo $payment->project_id; ?>,<?php echo $payment->plot_id; ?>)" 
                                               style="padding: 4px; border-radius:5px;">
                                              <i  class="fa fa-eye" data-bs-toggle="tooltip" title="Print List"></i>
                                            </a>
                                            @endif
                                            
                                              @php
                                                 $permission = new \App\Models\Permission();
                                                $print_check = $permission->checkPermission('cancelledplotlist.print');
                                            @endphp
                                            @if($print_check == 1)
                                              <a class="btn btn-primary me-2  btnprn" id="cancelled_plot_print" href="{{url('/')}}/cancel_plot_print/{{$payment->project_id}}/{{$payment->plot_id}}" title="Cancelled Plots" style="padding: 4px; width: 45px; border-radius: 5px;">
                                                    Print
                                                </a>
                                            @endif
                                                                            
                                            <!--<a class="btn-info border-0 me-1" target="_blank"-->
                                            <!--    href="{{ url('/') }}/part_payment/{{ $payment->project_id }}/{{ $payment->plot_id }}/list"-->
                                            <!--    style="padding: 4px;width:45px ; border-radius:5px;">-->
                                            <!--    <i  class="fa fa-print" data-bs-toggle="tooltip" title="Print List"></i> -->
                                            <!--</a>-->
                                            
                                           
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
    </div><!-- ROW-5 END -->
@endsection
@section('scripts')
    <script>
    
     $(document).ready(function() {
            var table = $('#cancel_plot_list').DataTable({
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "iDisplayLength" : 100,
    // buttons:[ "excel","pdf"],
    buttons: [
      {
        extend: 'excelHtml5',
         exportOptions: {
            columns: 'th:not(:last-child)'
         }
       
      },
      {
        extend: 'pdfHtml5',
        orientation:'landscape',
         pageSize: 'LEGAL',
        exportOptions: {
            columns: 'th:not(:last-child)'
         }
      },
     ]
    
}).buttons().container().appendTo("#cancel_plot_list_wrapper .col-md-6:eq(0)");
          });
          
          
    function submitForm(elem) {
        //   if (elem.value) {
              elem.form.submit();
        //   }
      }
            // Getting Plot Details
    $('#cancel_project_id').on('change', function() {
          id = this.value;
         if(id != '')
         {
             $("#cancel_plot_id").html("<option value=''>Select Plot No</option>")
              let url = $('meta[name="base_url"]').attr("content") +
            "/get-cancel-plots/" + id;
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
               
                    
                      text_1 += $("#cancel_plot_id").append(
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
                      $("#cancel_plot_id").html("<option value=''>Select Plot No</option>"); 
                      
                   }
              
        });
        
        
        $(document).ready(function() {
            var table = $('#staff_detail_lists').DataTable();
             $('.btnprn').printPage();
        });

            function EditPlot(project_id,plot_id) {
            var id = plot_id;
            $('#Edit_plotModal').modal('show');
            $.ajax({
                url: '{{ url('/') }}' + "/get-cancel-plots-list/" + project_id + "/"+ id,
                method: "GET",
                data: {
                    id: id,
                    project_id : project_id
                },
                contentType: false,
                processData: false,
                success: function(res) {
                      var tot = parseFloat(res.plots.market_value_plot_rate - res.paid);
                      
                     $('#gender').text(res.gender);
                     $('#plot_no').text(res.plots.plot_no);
                     $('#plot_sqft').text(res.plots.plot_sq_ft);
                     $('#plot_rate').text(res.plots.market_value_plot_rate);
                     $('#sqft_rate').text(res.plots.market_value_sq_ft);
                     $('#paid').text(res.paid);
                     $('#balance').text(tot);
                     $('#gv_sqft').text(res.guide_line);
                     $('#gv_plot_rate').text(res.plots.guide_line_plot_rate);
                      
                     $('#customer_name').text(res.customer_name);
                     $('#mobile').text(res.mobile);
                     $('#project_name').text(res.project_name);
                     $('#alternate_mobile').text(res.alternate_mobile);
                     $('#address').text(res.address);
                     $('#cancel_reason').text(res.data.cancel_reason).prop("disabled",true);
                     
                   if (res.marketer.length > 0) {
                     
                      $("#marketer_table tbody").empty();
                      $("#marketer_table tbody").append(res.marketer);
             
                    }else{
                        $("#marketer_table tbody").empty();
                        $('#marketer_table tbody').append('<tr><td colspan=5 style="text-align : center">No Data Found</td></tr>');
                   
                   } 
                   
                   if (res.payment_history.length > 0) {
                     
                     $("#payment_table tbody").empty();
                      $("#payment_table tbody").append(res.payment_history);
             
                    }else{
                        $("#payment_table tbody").empty();
                        $('#payment_table tbody').append('<tr><td colspan=10 style="text-align : center">No Data Found</td></tr>');
                   
                   }   
                   
                },
            });
        }
 
        function deleteBooking(id) {
            swal({
                    title: "Are you sure?",
                    text: "Confirm to delete this Booking?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Delete",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        var redirect = $('meta[name="base_url"]').attr('content') + '/part_payment_list';
                        var token = $('meta[name="csrf-token"]').attr("content");
                        var formData = new FormData();
                        formData.append("_token", "{{ csrf_token() }}");
                        formData.append("id", id);
                        $.ajax({
                            url: "{{ route('part_payment_delete', '') }}" + "/" + id,
                            data: formData,
                            type: 'DELETE',
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(res) {
                                if (res) {
                                    swal("Deleted!", "Payment Detail has been deleted.", "success");
                                    window.location.href = redirect;

                                } else {
                                    swal("Payment Detail Delete Failed", "Please try again. :)", "error");
                                }
                            }
                        });

                    } else {
                        swal("Cancelled", "Cancelled", "error");
                    }
                });
        }
    </script>
@endsection
