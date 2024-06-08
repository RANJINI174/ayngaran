@extends('layouts.app')
@section('content')
    <!-- PAGE-HEADER -->
    
    
    
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card ">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Plot Cancellation list</h3>
                   
                </div>
                <?php

$project_id = Request::input('project_id');
$plot_id=Request::input('plot_id');

?>
                <div class="card-body">
                     <form  method="get"  autocomplete="off" url ="{{ route('plots-list') }}">
                    <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Project  </label>
                                <div class="input-group">
                                    <input type="hidden" id="url" value="{{ route('store-payment') }}">
                                  <select name="project_id" id="cancel_project_id" class="form-control SlectBox">
                                        <option value="">Select Project</option>
                                        @if (isset($projects))
                                            @foreach ($projects as $pro)
                                                <option value="{{ $pro->id }} " @if($project_id == $pro->id) {{ "selected" }} @endif>{{ $pro->short_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                             
                            </div>
                            
                             <div class="col-md-4">
                                <label class="form-label">Plots </label>
                                <div class="input-group">
                                   <select name="plot_id" id="cancel_plot_id" class="form-control SlectBox">
                                       <option value="">Select Plot</option>
                                       <?php
                                       $plots = '';
                                       if(isset($project_id))
                                       {
                                           // add a booking status condition - by Gowtham.S
                                       $plots = \App\Models\Booking::leftjoin('plot_management','booking.plot_id','plot_management.id')
        ->where('plot_management.project_id',$project_id)->whereNull('booking.register_status')->whereNull('booking.booking_status')->where('plot_management.deleted_at',0)->get();       
                                       }
                                        
                                       ?>
                                        @if (isset($plots) && !empty($plots))
                                            @foreach ($plots as $plot)
                                                <option value="{{ $plot->id }} " @if($plot_id == $plot->id) {{ "selected" }} @endif>{{ $plot->plot_no }}</option>
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
                    <div class="table-responsive">
                        <table id="staff_detail_lists" class="table table-bordered text-nowrap mb-0">
                            <thead class="border-top">
                                <tr>
                                    <th class="bg-transparent border-bottom-0 w-5">S.no</th>
                                    <!--<th class="bg-transparent border-bottom-0">Receipt Date</th>-->
                                    <th class="bg-transparent border-bottom-0">Project Name</th>
                                    <th class="bg-transparent border-bottom-0">Plot No</th>
                                    <th class="bg-transparent border-bottom-0">Plot Sq.Ft</th>
                                    <th class="bg-transparent border-bottom-0">Customer Name</th>
                                     @if(Auth::user()->designation_id != 11)
                                    <th class="bg-transparent border-bottom-0">Plot Value</th>
                                     @endif
                                     @if(Auth::user()->designation_id == 11)
                                     <th class="bg-transparent border-bottom-0">Plot Value</th>
                                     @endif
                                    <!--<th class="bg-transparent border-bottom-0">Amount</th>-->
                                    <th class="bg-transparent border-bottom-0">Paid Amount</th>
                                    <th class="bg-transparent border-bottom-0">Discount</th>
                                    <th class="bg-transparent border-bottom-0">Balance</th>
                                    <th class="bg-transparent border-bottom-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                $total_balance = 0;
                                $discount = 0;
                                @endphp
                                
                                @foreach ($query as $payment)
                                
                                <?php 
                                 $plots = \App\Models\Booking::where('project_id',$payment->project_id)->where('plot_id',$payment->plot_id)
                                                     ->first();
                                                     
                                 $customer = \App\Models\Booking::where('id',$payment->customer_id)->first();
                                 
                                 $total_balance = $plots->total_value_mv - $payment->paid_amount - $payment->discount_amount;
                                 if(isset($payment->discount_amount))
                                 {
                                   $discount = $payment->discount_amount;  
                                 }else{
                                   $discount = 0;
                                 }
                                 
                                ?>
                                    <tr class="border-bottom">
                                        <td class="text-muted fs-12 fw-semibold text-center">{{ $i++ }}</td>
                                        <!--<td>-->
                                        <!--    {{ date('d-m-Y',strtotime($payment->receipt_date)) }}-->
                                        <!--</td>-->
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
                                            {{ $customer->customer_name }}
                                        </td>
                                          @if(Auth::user()->designation_id != 11)
                                         <td>
                                            {{ IND_money_format($plots->total_value_mv) }}
                                        </td>
                                        @endif
                                        @if(Auth::user()->designation_id == 11)
                                        <td>
                                            {{ IND_money_format($plots->total_value_gl) }}
                                        </td>
                                        @endif
                                        <td>
                                            {{ IND_money_format($payment->paid_amount) }}
                                        </td>
                                        <td>
                                            {{ IND_money_format($discount) }}
                                        </td>
                                         <td>
                                            {{ IND_money_format($total_balance) }}
                                        </td>
                                   
                                        <td class="">
                               @php
                               $permission = new \App\Models\Permission();
                               $edit_check = $permission->checkPermission('plotcancellationlist.edit');
                               @endphp
                               @if($edit_check == 1)
                                            <a class="btn-primary border-0 me-1"
                                                href="{{ url('/') }}/plots/{{ $payment->project_id }}/{{ $payment->plot_id }}/edit"
                                                style="padding: 4px; border-radius:5px;">
                                                <i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="12"
                                                        viewBox="0 0 24 24" width="12">
                                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                                        <path
                                                            d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z" />
                                                    </svg></i>
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
        </div><!-- COL END -->
    </div><!-- ROW-5 END -->
@endsection
@section('scripts')
    <script>
    
             // Getting Plot Details
    $('#cancel_project_id').on('change', function() {
          id = this.value;
         if(id != '')
         {
             $("#cancel_plot_id").html("<option value=''>Select Plot No</option>")
              let url = $('meta[name="base_url"]').attr("content") +
            "/get-cancel-plots-list/" + id;
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
