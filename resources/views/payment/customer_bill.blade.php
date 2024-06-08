@extends('layouts.app')
@section('content')
    <!-- PAGE-HEADER -->
    
    
    
    <div class="row mt-2">
        <div class="col-12 col-sm-12">
            <div class="card ">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">Customer Bill Print</h3>
                    <!--<a class="btn-primary add_master_btn" href="{{ url('/create_part_payment') }}"><span> <i-->
                    <!--            class="fe fe-plus"></i></span>Add New</a>-->
                </div>
                <?php

$project_id = Request::input('project_id');
$plot_id=Request::input('plot_id');

?>
                <div class="card-body">
                     <form  method="get"  autocomplete="off" url ="{{ route('customer_bill_list') }}">
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
                               <span style="display:none" class="text-danger" id="project_validation">Project Field is
                                    Required</span>
                            </div>
                            
                             <div class="col-md-4">
                                <label class="form-label">Plots </label>
                                <div class="input-group">
                                   <select name="plot_id" id="payment_plot_id" class="form-control SlectBox">
                                       <option value="">Select Plot</option>
                                        @if (isset($plots) && !empty($plots))
                                            @foreach ($plots as $plot)
                                                <option value="{{ $plot->id }} " @if($plot_id == $plot->id) {{ "selected" }} @endif>{{ $plot->plot_no }}</option>
                                            @endforeach
                                        @endif
                                        
                                    </select>
                                </div>
                                <span style="display:none" class="text-danger" id="plot_validation">Plot Field is
                                    Required</span>
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
                            	<thead>
													<tr>
														<th>#</th>
														<th>Project Name</th>
														<th>Plot No</th>
														<th>Receipt</th>
														<th>Date</th>
														<th>Amount</th>
														<th>Type</th>
														<th>Paymode</th>
														@if(Auth::user()->designation_id != 11)
														<th>Amount Towards</th>
														@endif
														<th>Narration</th>
														<th>Action</th>
													 
													</tr>
												</thead>
                            <tbody>
                                <?php
                                $narration = '';
                                $new_narration = '';
                                        // $payment_history = \App\Models\Payment::where('project_id',$payment->project_id)->where('plot_id',$payment->plot_id)->get(); 
                                        if(isset($query))
                                        {
                                            $total_amount = '';
                                            $paymode = '';
                                            $type = '';
                                            $i = 1;
                                            foreach($query as $payment)
                                            {
                 if($payment->pay_mode == 1)
                 {
                    $paymode = 'Cash';
                }
                 if($payment->pay_mode == 2)
                {
                    $paymode = 'Cheque';
                }
                 if($payment->pay_mode == 3)
                {
                    $paymode = 'DD';
                }
                 if($payment->pay_mode == 4)
                {
                    $paymode = 'Online Transfer';
                }
                 if($payment->pay_mode == 5)
                {
                    $paymode = 'Cash Deposite';
                }
                
                
                if($payment->account_type == 1)
                {
                    $type = 'Part Payment';
                }else{
                    $type = 'Advance';
                }
                
                
                                            if (isset($payment->narration)) {
                                                    $narration = $payment->narration;
                                                } else {
                                                    if($payment->pay_mode != 1)
                                                    {
                                                     if (isset($payment->bank_name)) {
                                                        $bank = \App\Models\Bank::where('id', $payment->bank_name)->first();
                                                        $narration = $bank->bank_name;
                                                    }else{
                                                        $narration = $payment->narration;
                                                    }
                                                    }else{
                                                        $narration = $payment->narration;
                                                    }
                                                    
                                                }
                                                
                                                
                                                if($payment->fully_paid != 1)
                                                {
                                                    $new_narration = $narration;
                                                }else{
                                                    $new_narration = "Fully Paid";
                                                }
                                                
                                             ?>
                                             <tr>
                                                 <td> {{ $i++ }}</td>
                                                 <td> {{ $payment->short_name }} </td>
                                                 <td> {{ $payment->plot_no }} </td>
                                                 <td> {{ $payment->receipt_no }} </td>
                                                 <td>{{ date('d-m-Y',strtotime($payment->receipt_date)) }}</td>
                                                 <td>
                                                 <input type="text" readonly class="form-control" @if(isset($payment->booking_id))  readonly @endif name="pay_amount[]" id="pay_amount"
                                                 value = "{{ IND_money_format($payment->amount) }}" ></td>
                                                 <td>{{$type}}</td>
                                                 <td>{{ $paymode }}</td>
                                                 @if(Auth::user()->designation_id != 11)
                                                 <td>
                                                  <select name="pay_towards[]" id="pay_towards" disabled class="form-control SlectBox">
                                                     <option value="">Select </option>
                                                     <option value="1"  @if($payment->amount_towards == 1) {{"selected"}} @endif>MV</option>
                                                     <option value="2"  @if($payment->amount_towards == 2) {{"selected"}} @endif>GL</option>
                                                     </select>
                                                 </td>
                                                 @endif
                                                 <td>
                                                     <input type="text" readonly class="form-control" name="narration[]"  id="narration" value = "{{$new_narration }}" >
                                                      
                                                 </td>
                                                  <td style="text-align:center !important;">
                                @php
                               $permission = new \App\Models\Permission();
                               $print_check = $permission->checkPermission('customerbillprint.print');
                               @endphp
                               
                               @if($print_check == 1)
                                                       <a class="btn-info border-0 me-1 btnprn"
                                                href="{{ url('/') }}/part_payment/{{ $payment->id }}/{{ $payment->project_id }}/{{ $payment->plot_id }}/print"
                                                style="padding: 4px;width:45px ; border-radius:5px;">
                                                <i  class="fa fa-print" data-bs-toggle="tooltip" title="Print"></i> 
                                            </a>
                                @endif
                                                  </td>
                                                 
                                             </tr>
                                             <?php
                                             
                                             
                                            }
                                        }
                                       ?>
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
