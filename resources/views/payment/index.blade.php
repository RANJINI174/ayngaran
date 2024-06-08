@extends('layouts.app')
@section('content')
    <!-- PAGE-HEADER -->
    
    
    
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card ">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Part Payment List</h3>
                    <!--<a class="btn-primary add_master_btn" href="{{ url('/create_part_payment') }}"><span> <i-->
                    <!--            class="fe fe-plus"></i></span>Add New</a>-->
                </div>
                <?php

$project_id = Request::input('project_id');
$plot_id=Request::input('plot_id');

?>
                <div class="card-body">
                     <form  method="get"  autocomplete="off" url ="{{ route('payment_list') }}">
                    <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Project  </label>
                                <div class="input-group">
                                    <input type="hidden" id="url" value="{{ route('store-payment') }}">
                                  <select name="project_id" id="payment_project_id" class="form-control SlectBox">
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
                                   <select name="plot_id" id="payment_plot_id" class="form-control SlectBox">
                                       <option value="">Select Plot No</option>
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
                                    @if(Auth::user()->designation_id != 11)
                                    <th class="bg-transparent border-bottom-0">Balance</th>
                                    @endif
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
                                 if(isset($customer))
                                 {
                                     $customer_name = $customer->customer_name;
                                 }
                                 
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
                                            {{ $customer_name }}
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
                                         @if(Auth::user()->designation_id != 11)
                                         <td>
                                            {{ IND_money_format($total_balance) }}
                                        </td>
                                        @endif
                                @php
                                $permission = new \App\Models\Permission();
                               $edit_check = $permission->checkPermission('partpaymentlist.edit');
                               $print_check = $permission->checkPermission('partpaymentlist.print');
                                 @endphp
                               
                                         <td class="">
                                              @if ($edit_check == 1)
                                            <a class="btn-primary border-0 me-1"
                                                href="{{ url('/') }}/part_payment/{{ $payment->project_id }}/{{ $payment->plot_id }}/edit"
                                                style="padding: 4px; border-radius:5px;">
                                                <i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="12"
                                                        viewBox="0 0 24 24" width="12">
                                                        <path d="M0 0h24v24H0V0z" fill="none" />
                                                        <path
                                                            d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z" />
                                                    </svg></i>
                                            </a>
                                    @endif  
                                 
                                     @if ($print_check == 1)
                                          
                                            
                                            <a class="btn-info border-0 me-1" target="_blank"
                                                href="{{ url('/') }}/part_payment/{{ $payment->project_id }}/{{ $payment->plot_id }}/list"
                                                style="padding: 4px;width:45px ; border-radius:5px;">
                                                <i  class="fa fa-print" data-bs-toggle="tooltip" title="Print List"></i> 
                                            </a>
                                            
                                   @endif
                                            
                                            <!--<button onclick="deleteBooking('{{ $payment->id }}')"-->
                                            <!--    class="btn-danger border-0" data-bs-toggle="tooltip"-->
                                            <!--    data-bs-original-title="Delete" style="border-radius: 5px;"><i><svg-->
                                            <!--            class="table-delete" xmlns="http://www.w3.org/2000/svg"-->
                                            <!--            height="12" viewBox="0 0 24 24" width="12">-->
                                            <!--            <path d="M0 0h24v24H0V0z" fill="none" />-->
                                            <!--            <path-->
                                            <!--                d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z" />-->
                                            <!--        </svg></i></button>-->
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
        $(document).ready(function() {
            var table = $('#staff_detail_lists').DataTable();
             $('.btnprn').printPage();
        });



// function EditPlot(project_id,plot_id) {
    
    
//             $('#Edit_plotModal').modal('show');
//             $.ajax({
//                 url: '{{ url('/') }}' + "/part_payment/" + project_id + "/" + plot_id + "/list/",
//                 method: "GET",
//                 data: {
//                     project_id: project_id,
//                     plot_id : plot_id
//                 },
//                 contentType: false,
//                 processData: false,
//                 success: function(res) {
                    
                    
//                 if (res.payment_history.length > 0) {
//                             var html = '';
//                             var index = 0;
                            
              
//                  for (var i = 0; i < res.payment_history.length; i++) {
                      
                
//                       if(res.payment_history[i]['account_type'] == 1)
//                       {
//                       type = 'P.P (Part Payment)';
//                       }else{
//                       type = 'Adv ( Advance)';
//                         }
                        
                 
                        
                        
//                 if(res.payment_history[i]['pay_mode'] == 1)
//                 {
//                     paymode = 'Cash';
//                 }
//                  if(res.payment_history[i]['pay_mode'] == 2)
//                 {
//                     paymode = 'Cheque';
//                 }
//                  if(res.payment_history[i]['pay_mode'] == 3)
//                 {
//                     paymode = 'DD';
//                 }
//                  if(res.payment_history[i]['pay_mode'] == 4)
//                 {
//                     paymode = 'Online Transfer';
//                 }
//                  if(res.payment_history[i]['pay_mode'] == 5)
//                 {
//                     paymode = 'Cash Deposite';
//                 }
                
                
//                 if(res.payment_history[i]['amount_towards'] == 1)
//                 {
//                     amount_towards = 'MV';
//                 }else{
//                     amount_towards = 'gl';
//                 }
                
                        
                        
                        
//                                 index++;
//                                 html += '<tr class="table_rows_count"><td>' + index +
//                                     '</td><td>' +
//                                     res.payment_history[i][
//                                         'receipt_no'
//                                     ] + '</td><td>' + res.payment_history[i]['receipt_date'] + '</td><td>' + res
//                                     .payment_history[i]['amount'] + '</td><td>' + type +
//                                     '</td><td>' + paymode +
//                                     '</td><td>' + amount_towards +
//                                     '</td><td>' + res.payment_history[i]['narration'] +
//                                     '</td><td><a class="btn-info border-0 me-1 btnprn" id="btnprn" href="{{ url('/') }}/part_payment/' + res.payment_history[i]['id'] + '/' + res.payment_history[i]['project_id'] + '/' + res.payment_history[i]['plot_id'] + '/print" style="padding: 4px;width:45px ; border-radius:5px;"><i  class="fa fa-print" data-bs-toggle="tooltip" title="Print"></i></a></td>';
//                             }
                            
//                             console.log(html)
//                          $("#payment_table tbody").html(html);    
//                 }else{
//                         $("#payment_table tbody").empty();
//                         $('#payment_table tbody').append('<tr><td colspan=8 style="text-align : center">No Data Found</td></tr>');
                   
//                   }
                            
                
               
                            
//                 },
//             });
//         }
        
        
        
 $('#btnprn').on('click', function() {
     alert()
    //  printPage();
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
