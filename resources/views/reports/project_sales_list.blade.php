@extends('layouts.app')
@section('content')
    <div class="row mt-2">
 <?php

$project_id = Request::input('project_id');
$from_date = Request::input('from_date');
$to_date=Request::input('to_date');
if($from_date == '')
{
    
    $get_from_date = \App\Models\Booking::where('id','!=',0)->orderby('id','asc')->first();
    if(isset($get_from_date))
    {
        $from_date = $get_from_date->receipt_date;
    }else{
        $from_date = date('Y-m-d');
    }
    
}
if($to_date == '')
{
    $to_date = date('Y-m-d');
}
?>
      
     
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Project wise Sales List</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                    <form   method="get"  autocomplete="off" url ="{{ route('project-sales-list') }}">
                    <div class="row">
                        <div class="col-md-3">
                                <label class="form-label">From Date  </label>
                                <div class="input-group">
                                <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6" ></i>
                                    </div><input class="form-control fc-datepicker"   value="{{ $from_date }}" 
                                        type="date" name="from_date" id="from_date">
                                </div>
                             
                            </div>
                            
                             <div class="col-md-3">
                                <label class="form-label">To Date </label>
                                <div class="input-group">
                                   <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker"   value="{{ $to_date }}" 
                                        type="date" name="to_date" id="to_date">
                                </div>
                                </div>
                           
                            <div class="col-md-3">
                                <label class="form-label">Project </label>
                                <div class="input-group">
                                 <select name="project_id[]" id="project_id"  style="height:40px !important" multiple   class="form-control SlectBox">
                                        <option value="">All</option>
                                        @if(isset($projects))
                                        @foreach($projects as $val)
                                        <option value="{{ $val->id }} " @if(isset($project_id)) @if(in_array($val->id, $project_id)) {{ "Selected" }} @endif  @endif>
                                        {{ $val->short_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                             
                            </div>
                            <div class="col-md-1 mt-3">
                                 <br>
                                <button type="submit" class="btn btn-primary me-2">Search</button>
                               
                            </div>
                            
                             <div class="col-md-2 mt-3">
                                 <br> 
                                  @php
                                     $permission = new \App\Models\Permission();
                                    $print_check = $permission->checkPermission('projectwisesaleslist.print');
                                @endphp
                                @if($print_check == 1)
                                <a class="btn btn-primary me-2 btnprn"
                                                href="{{ url('/') }}/project-sales-list/print"
                                                style="padding: 4px;width:45px ; border-radius:5px;">
                                               Print
                                            </a>
                                @endif
                            </div>
                            </div>
                            </form>
                            </div>
                            <br><br>
                    <form id="Add_LegalDocumentAbstract_Form" autocomplete="off">
                        @csrf
                        @method('POST')
                        <div class="container">
                            <!--<div class="row border border-light-subtle mt-1" style="border-radius:5px;">-->
                            <div class="table-responsive mt-3">
                                <table id="projectwise_sales_list"
                                    class="table table-bordered text-nowrap text-center mb-0">
                                    <thead class="border text-center">
                                        <!-- <tr>-->
                                        <!--    <th>S.No</th>-->
                                        <!--    <th>Project Name</th>-->
                                        <!--    <th>Booking cash Count</th>-->
                                        <!--    <th>Booking cash Amount</th>-->
                                        <!--    <th>Booking Bank Count</th>-->
                                        <!--    <th>Booking Bank Amount</th>-->
                                        <!--    <th>Registered cash Count</th>-->
                                        <!--    <th>Registered cash Amount</th>-->
                                        <!--    <th>Registered Bank Count</th>-->
                                        <!--    <th>Registered Bank Amount</th>-->
                                        <!--    <th>Total Count</th>-->
                                        <!--    <th>Total Amount</th>-->
                                        <!--</tr>-->
                                        <tr>
                                            <th style="width:8%" rowspan="3">S.No</th>
                                            <th  rowspan="3">Project Name</th>
                                            <th colspan="4">Booking</th>
                                            <th colspan="4">Registered</th>
                                             
                                            <th colspan="2">Total</th>
                                        </tr>
                                         <tr>
                                             
                                            <th colspan="2">Cash</th>
                                            <th colspan="2">Bank</th>
                                            <th colspan="2">Cash</th>
                                            <th colspan="2">Bank</th>
                                            <th rowspan="2">Count</th>
                                            <th rowspan="2">Amount</th>
                                        </tr>
                                       <tr>
                                             
                                            <th>Count</th>
                                            <th>Amount</th>
                                            <th>Count</th>
                                            <th>Amount</th>
                                            <th>Count</th>
                                            <th>Amount</th>
                                            <th>Count</th>
                                            <th>Amount</th>
                                        </tr>
                                      
                                    </thead>
                                    <tbody class="border">
                                       @php
                                       $i = 1;
                                       $get_booking_cash_count = 0;
                                       $get_booking_bank_count = 0;
                                       $get_register_cash_count = 0;
                                       $get_register_bank_count = 0;
                                       $booking_cash_amt = 0;
                                       $booking_bank_amt = 0;
                                       $total_count = 0;
                                       $total_amount = 0;
                                       $total_booking_cash_count = 0;
                                       $total_booking_cash_amount = 0;
                                       $total_booking_bank_count = 0;
                                       $total_booking_bank_amount = 0;
                                       $total_register_cash_count = 0;
                                       $total_register_cash_amount = 0;
                                       $total_register_bank_count = 0;
                                       $total_register_bank_amount = 0;
                                       $overall_total_count = 0;
                                       $overall_total_amount = 0;
                                       @endphp
                                        @if(isset($bookings))
                                        @foreach($bookings as $books)
                                        
                                        <?php
                                        
                                        $get_booking_cash_count = \App\Models\Payment::leftjoin('booking','part_payment.plot_id','booking.plot_id')
                                                                    ->whereNull('booking.confirm_status')
                                                                    ->where('part_payment.pay_mode',1)
                                                                    ->whereNull('booking.register_status')
                                                                    ->whereBetween('booking.receipt_date',[$from_date,$to_date])
                                                                    ->whereNull('booking.booking_status')->where('part_payment.project_id',$books->project_id)->get()->count();
                                                                    
                                        
                                        $get_booking_cash_amount = \App\Models\Payment::leftjoin('booking','part_payment.plot_id','booking.plot_id')
                                                                    ->whereNull('booking.confirm_status')
                                                                    ->where('part_payment.pay_mode',1)
                                                                    ->whereNull('booking.register_status')
                                                                    ->whereBetween('booking.receipt_date',[$from_date,$to_date])
                                                                    ->whereNull('booking.booking_status')->where('part_payment.project_id',$books->project_id)
                                                                    ->select(DB::raw('SUM(part_payment.amount) as cash_amount'))->first();
                                        if($get_booking_cash_amount)
                                        {
                                            $booking_cash_amt = $get_booking_cash_amount->cash_amount;
                                        }
                                        
                                        if($booking_cash_amt)
                                        {
                                            $booking_cash_amt = $booking_cash_amt;
                                        }else{
                                            $booking_cash_amt = 0;
                                        }
                                                                    
                                        
                                         $get_booking_bank_count = \App\Models\Payment::leftjoin('booking','part_payment.plot_id','booking.plot_id')
                                                                    ->whereNull('booking.confirm_status')
                                                                    ->where('part_payment.pay_mode','!=',1)
                                                                    ->whereNull('booking.register_status')
                                                                    ->whereBetween('booking.receipt_date',[$from_date,$to_date])
                                                                    ->whereNull('booking.booking_status')->where('part_payment.project_id',$books->project_id)->get()->count();
                                        $get_booking_bank_amount = \App\Models\Payment::leftjoin('booking','part_payment.plot_id','booking.plot_id')
                                                                    ->whereNull('booking.confirm_status')
                                                                    ->where('part_payment.pay_mode','!=',1)
                                                                    ->whereNull('booking.register_status')
                                                                    ->whereBetween('booking.receipt_date',[$from_date,$to_date])
                                                                    ->whereNull('booking.booking_status')->where('part_payment.project_id',$books->project_id)
                                                                    ->select(DB::raw('SUM(part_payment.amount) as bank_amount'))->first();
                                        if($get_booking_bank_amount)
                                        {
                                            $booking_bank_amt = $get_booking_bank_amount->bank_amount;
                                        }
                                        
                                        if($booking_bank_amt)
                                        {
                                            $booking_bank_amt = $booking_bank_amt;
                                        }else{
                                            $booking_bank_amt = 0;
                                        }
                                        
                                        
                                        $get_register_cash_count = \App\Models\Payment::leftjoin('booking','part_payment.plot_id','booking.plot_id')
                                                                     ->where('part_payment.pay_mode',1)
                                                                    ->whereNotNull('booking.register_status')
                                                                    ->whereBetween('booking.receipt_date',[$from_date,$to_date])
                                                                    ->whereNull('booking.booking_status')->where('part_payment.project_id',$books->project_id)->get()->count();
                                                                    
                                        
                                        $get_register_cash_amount = \App\Models\Payment::leftjoin('booking','part_payment.plot_id','booking.plot_id')
                                                                    ->where('part_payment.pay_mode',1)
                                                                    ->whereNotNull('booking.register_status')
                                                                    ->whereBetween('booking.receipt_date',[$from_date,$to_date])
                                                                    ->whereNull('booking.booking_status')->where('part_payment.project_id',$books->project_id)
                                                                    ->select(DB::raw('SUM(part_payment.amount) as cash_amount'))->first();
                                        if($get_register_cash_amount)
                                        {
                                            $register_cash_amt = $get_register_cash_amount->cash_amount;
                                        }
                                        
                                        if($register_cash_amt)
                                        {
                                            $register_cash_amt = $register_cash_amt;
                                        }else{
                                            $register_cash_amt = 0;
                                        }
                                                                    
                                        
                                         $get_register_bank_count = \App\Models\Payment::leftjoin('booking','part_payment.plot_id','booking.plot_id')
                                                                    ->where('part_payment.pay_mode','!=',1)
                                                                    ->whereNotNull('booking.register_status')
                                                                    ->whereBetween('booking.receipt_date',[$from_date,$to_date])
                                                                    ->whereNull('booking.booking_status')->where('part_payment.project_id',$books->project_id)->get()->count();
                                        $get_register_bank_amount = \App\Models\Payment::leftjoin('booking','part_payment.plot_id','booking.plot_id')
                                                                    ->where('part_payment.pay_mode','!=',1)
                                                                    ->whereNotNull('booking.register_status')
                                                                    ->whereBetween('booking.receipt_date',[$from_date,$to_date])
                                                                    ->whereNull('booking.booking_status')->where('part_payment.project_id',$books->project_id)
                                                                    ->select(DB::raw('SUM(part_payment.amount) as bank_amount'))->first();
                                        if($get_register_bank_amount)
                                        {
                                            $register_bank_amt = $get_register_bank_amount->bank_amount;
                                        }
                                        
                                        if($register_bank_amt)
                                        {
                                            $register_bank_amt = $register_bank_amt;
                                        }else{
                                            $register_bank_amt = 0;
                                        }
                                          
                                        $total_count =  $get_booking_cash_count + $get_booking_bank_count + $get_register_cash_count
                                                       + $get_register_bank_count;
                                        
                                        $total_amount =  $booking_cash_amt + $booking_bank_amt + $register_cash_amt
                                                       + $register_bank_amt;
                                                       
                                         $total_booking_cash_count = $total_booking_cash_count + $get_booking_cash_count;
                                         $total_booking_cash_amount = $total_booking_cash_amount + $booking_cash_amt;
                                         $total_booking_bank_count = $total_booking_bank_count + $get_booking_bank_count;
                                         $total_booking_bank_amount = $total_booking_bank_amount + $booking_bank_amt;
                                         
                                         $total_register_cash_count = $total_register_cash_count + $get_register_cash_count;
                                         $total_register_cash_amount = $total_register_cash_amount + $register_cash_amt;
                                         $total_register_bank_count = $total_register_bank_count +  $get_register_bank_count;
                                         $total_register_bank_amount = $total_register_bank_amount + $register_bank_amt;
                                         
                                         $overall_total_count = $total_booking_cash_count + $total_booking_bank_count + $total_register_cash_count + $total_register_bank_count;
                                         $overall_total_amount = $total_booking_cash_amount + $total_booking_bank_amount + $total_register_cash_amount + $total_register_bank_amount;
                                        
                                        ?>
                                      
                                                <tr>
                                                    <td> {{ $i++ }}</td>
                                                     
                                                    <td  style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        {{ $books->short_name }}
                                                    </td>
                                                    <td  style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        {{ $get_booking_cash_count }}
                                                    </td>
                                                    <td  style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        {{ IND_money_format(round($booking_cash_amt)) }}
                                                    </td>
                                                    <td  style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        {{ $get_booking_bank_count }}
                                                    </td>
                                                    <td style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        {{ IND_money_format(round($booking_bank_amt)) }}
                                                    </td>
                                                    <td  style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        {{ $get_register_cash_count }}
                                                    </td>
                                                    <td   style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        {{ IND_money_format(round($register_cash_amt)) }}
                                                    </td>
                                                    <td  style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        {{ $get_register_bank_count }}</td>
                                                    <td  style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        {{ IND_money_format(round($register_bank_amt)) }}</td>
                                                    
                                                    <td  style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        {{ $total_count }}</td>
                                                    <td  style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        {{ IND_money_format(round($total_amount)) }}</td>
                                                </tr>

                                             @endforeach
                                             @endif

                                        <tr>
                                            
                                            <td class="text-end fw-bold text-danger" colspan="2" style="font-size:14px"> Total</td>
                                                     
                                                    <td  style="color: #6259ca;">
                                                        <h6 class="fw-bold">{{ $total_booking_cash_count }} </h6>
                                                    </td>
                                                    <td  style="color: #6259ca;">
                                                       <h6 class="fw-bold">{{ IND_money_format(round($total_booking_cash_amount)) }} </h6> 
                                                    </td>
                                                    <td  style="color: #6259ca;">
                                                        <h6 class="fw-bold">{{ $total_booking_bank_count }} </h6>
                                                    </td>
                                                    <td style="color: #6259ca;">
                                                        <h6 class="fw-bold">{{ IND_money_format(round($total_booking_bank_amount)) }} </h6>
                                                    </td>
                                                    <td  style="color: #6259ca;">
                                                        <h6 class="fw-bold">{{ $total_register_cash_count }} </h6> 
                                                    </td>
                                                    <td  style="color: #6259ca;">
                                                        <h6 class="fw-bold">{{ IND_money_format(round($total_register_cash_amount)) }} </h6> 
                                                    </td>
                                                    <td style="color: #6259ca;">
                                                        <h6 class="fw-bold">{{ $total_register_bank_count }} </h6> </td>
                                                    <td style="color: #6259ca;">
                                                        <h6 class="fw-bold">{{ IND_money_format(round($total_register_bank_amount)) }} </h6> </td>
                                                    
                                                    <td style="color: #6259ca;">
                                                        <h6 class="fw-bold">{{ $overall_total_count }} </h6> </td>
                                                    <td style="color: #6259ca;">
                                                        <h6 class="fw-bold">{{ IND_money_format(round($overall_total_amount)) }} </h6></td>
                                                        
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br><br>
                            <!--</div>-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
    
    function submitForm(elem) {
        //   if (elem.value) {
              elem.form.submit();
        //   }
      }
     $('#plot_no').on('change', function() {
         plot_search();
     });
        function plot_search() {
            var id = $("#t_project_id").val();
            plot_nos_view(id);
        }

        function plot_nos_view(id) {
             $("#get_plotnos_ListModal").modal("show");
            $("#t_project_id").val(id);
            $("#project_id").val(id).trigger("change");
            var plot_id = $("#plot_no").val();
            var type = 'get-plot-nos';
            $.ajax({
                url: "{{ route('legal_doc_abstract_lists') }}",
                method: "GET",
                data: {
                    project_id: id,
                    type: type,
                    plot_id: plot_id
                },
                success: function(res) {
                    if (res.status == true) {
                        
                            var text = "";
                            $("#plot_no").html(res.list);
                          
                            
                            // if (res.plots.length > 0) {
                            //     $("#plot_no").html(
                            //         "<option value=''>Select Plot No</option>"
                            //     );
                                
                            //     $.each(res.plots, function(key, value) {
                            //         $("#plot_no").append('<option value="' + value.id + '">' +
                            //             value.plot_no + '</option>')
                            //     });
                                
                               
                            // } else {
                            //     $("#plot_no").html(
                            //         "<option value=''>Select Plot No</option>"
                            //     );
                            // }
                            if (res.html != "") {
                            $("#plot_no_body").empty().html(res.html);
                        } else {
                            $("#plot_no_body").html('<tr><td colspan="6">Data no Found</td></tr>');
                        }
                    }
                },
            });
        }
        
         

       $('#reg_plot_no').on('change', function() {
         reg_plot_search();
        });
        function reg_plot_search() {
            var id = $("#r_project_id").val();
            Reg_com_lists(id);
        }

        function Reg_com_lists(id) {
            $("#RegCompleted_ListModal").modal("show");
            $("#r_project_id").val(id);
            $("#reg_project_id").val(id).trigger("change");
            var plot_id = $("#reg_plot_no").val();
            var type = 'register-completed-list';
            $.ajax({
                url: "{{ route('legal_doc_abstract_lists') }}",
                method: "GET",
                data: {
                    project_id: id,
                    type: type,
                    plot_id: plot_id,
                },
                success: function(res) {
                    
                    if (res.status == true) {
                        if (res.html != "") {
                            $("#reg_plot_no").html(res.list);
                            // if (res.plots.length > 0) {
                            //     $.each(res.plots, function(key, value) {
                            //         $("#reg_plot_no").append('<option value="' + value.id + '">' +
                            //             value.plot_no + '</option>')
                            //     });
                            // } else {
                            //     $("#reg_plot_no").html(
                            //         "<option value=''>Select Plot No</option><option value=''>No Data Found</option>"
                            //     );
                            // }
                            $("#reg_com_body").empty().html(res.html);
                        } else {
                            $("#reg_com_body").html('<tr><td colspan="6">Data no Found</td></tr>');
                        }
                        
                    }
                        
                    // if (res.status == true) {
                    //     if (res.html != "") {
                    //          alert(res.plots.length)
                    //          if (res.plots.length > 0) {
                    //             $.each(res.plots, function(key, value) {
                    //                 $("#reg_plot_no").append('<option value="' + value.id + '">' +
                    //                     value.plot_no + '</option>')
                    //             });
                    //         } else {
                    //             $("#reg_plot_no").html(
                    //                 "<option value=''>Select Plot No</option><option value=''>No Data Found</option>"
                    //             );
                    //         }
                            
                            
                    //          $("#reg_com_body").html(res.html);
                    //     } else {
                    //         console.log("else");
                    //         $("#reg_com_body").html('<tr><td colspan="6">Data no Found</td></tr>');
                    //     }

                    // }
                },
            });

        }
        
         $('#office_plot_no').on('change', function() {
         off_plot_search();
     });

        function off_plot_search() {
            var id = $("#off_project_id").val();
            Reg_doc_office_lists(id);
        }

        function Reg_doc_office_lists(id) {
            $("#RegDoc_Office_ListModal").modal("show");
            $("#off_project_id").val(id);
            $("#office_project_id").val(id).trigger("change");
            var plot_id = $("#office_plot_no").val();
            var type = 'register-doc-office-list';
            $.ajax({
                url: "{{ route('legal_doc_abstract_lists') }}",
                method: "GET",
                data: {
                    project_id: id,
                    type: type,
                    plot_id: plot_id
                },
                success: function(res) {
                    if (res.status == true) {
                        if (res.html != "") {
                               $("#office_plot_no").html(res.list);
                            // if (res.plots.length > 0) {
                            //     $.each(res.plots, function(key, value) {
                            //         $("#office_plot_no").append('<option value="' + value.plot_id +
                            //             '">' +
                            //             value.plot_no + '</option>')
                            //     });
                            // } else {
                            //     $("#office_plot_no").html(
                            //         "<option value=''>Select Plot No</option><option value=''>No Data Found</option>"
                            //     );
                            // }
                            $("#reg_doc_off_tbody").html(res.html);
                        } else {
                            $("#reg_doc_off_tbody").html('<tr><td colspan="9">Data no Found</td></tr>');
                        }
                    }
                },
            });
        }


    $('#office_issue_plot_no').on('change', function() {
         off_issue_plot_search();
     });
        function off_issue_plot_search() {
            var id = $("#off_issue_p_id").val();
            Reg_doc_issued_lists(id);
        }

        function Reg_doc_issued_lists(id) {
            $("#RegDoc_Issued_ListModal").modal("show");

            var plot_id = $("#office_issue_plot_no").val();
            $("#off_issue_p_id").val(id);
            $("#office_issue_p_id").val(id).trigger("change");
            var type = 'register-doc-issued-list';
            $.ajax({
                url: "{{ route('legal_doc_abstract_lists') }}",
                method: "GET",
                data: {
                    project_id: id,
                    type: type,
                    plot_id: plot_id
                },
                success: function(res) {
                    if (res.status == true) {
                        if (res.html != "") {
                            
                            $("#office_issue_plot_no").html(res.list);

                            // if (res.plots.length > 0) {
                            //     $.each(res.plots, function(key, value) {
                            //         $("#office_issue_plot_no").append('<option value="' + value
                            //             .plot_id +
                            //             '">' +
                            //             value.plot_no + '</option>')
                            //     });
                            // } else {
                            //     $("#office_issue_plot_no").html(
                            //         "<option value=''>Select Plot No</option><option value=''>No Data Found</option>"
                            //     );
                            // }
                            $("#reg_doc_issued_tbody").html(res.html);
                        } else {
                            $("#reg_doc_issued_tbody").html('<tr><td colspan="9">Data no Found</td></tr>');
                        }
                    }
                },
            });
        }

          $('#legal_plot_no').on('change', function() {
         legal_office_plot_search();
         });
     
        function legal_office_plot_search() {
            var id = $("#legal_project_id").val();
            Legal_book_office_lists(id);
        }

        function Legal_book_office_lists(id) {
            $("#LegalBook_Office_ListModal").modal("show");

            var plot_id = $("#legal_plot_no").val();
            $("#legal_project_id").val(id);
            $("#legal_off_project_id").val(id).trigger("change");
            var type = 'legal-book-office-list';
            $.ajax({
                url: "{{ route('legal_doc_abstract_lists') }}",
                method: "GET",
                data: {
                    project_id: id,
                    type: type,
                    plot_id: plot_id
                },
                success: function(res) {
                    if (res.status == true) {
                        if (res.html != "") {
                            
                             $("#legal_plot_no").html(res.list);

                            // if (res.plots.length > 0) {
                            //     $.each(res.plots, function(key, value) {
                            //         $("#legal_plot_no").append('<option value="' + value.plot_id +
                            //             '">' + value.plot_no + '</option>');
                            //     });
                            // } else {
                            //     $("#legal_plot_no").html(
                            //         "<option value=''>Select Plot No</option><option value=''>No Data Found</option>"
                            //     );
                            // }
                            $("#legal_book_off_tbody").html(res.html);
                        } else {
                            $("#legal_book_off_tbody").html('<tr><td colspan="9">Data no Found</td></tr>');
                        }
                    }
                },
            });
        }

         $('#legal_issue_plot_no').on('change', function() {
         legal_isssue_plot_search();
         });
         
         
        function legal_isssue_plot_search() {
            var id = $("#legal_issue_p_id").val();
            Legal_book_issued_lists(id);
        }

        function Legal_book_issued_lists(id) {
            $("#LegalBook_Issued_ListModal").modal("show");

            var plot_id = $("#legal_issue_plot_no").val();
            $("#legal_issue_p_id").val(id);
            $("#legal_issue_project_id").val(id).trigger("change");
            var type = 'legal-book-issued-list';
            $.ajax({
                url: "{{ route('legal_doc_abstract_lists') }}",
                method: "GET",
                data: {
                    project_id: id,
                    type: type,
                    plot_id: plot_id
                },
                success: function(res) {
                    if (res.status == true) {
                        if (res.html != "") {
                            
                            $("#legal_issue_plot_no").html(res.list);

 
                            // if (res.plots.length > 0) {
                            //     $.each(res.plots, function(key, value) {
                            //         $("#legal_issue_plot_no").append('<option value="' + value.plot_id +
                            //             '">' + value.plot_no + '</option>');
                            //     });
                            // } else {
                            //     $("#legal_issue_plot_no").html(
                            //         "<option value=''>Select Plot No</option><option value=''>No Data Found</option>"
                            //     );
                            // }
                            $("#legal_book_issued_tbody").html(res.html);
                        } else {
                            $("#legal_book_issued_tbody").html('<tr><td colspan="9">Data no Found</td></tr>');
                        }
                    }
                },
            });
        }

        function Close_model() {
            // $("#get_plotnos_ListModal").modal('hide');
            // $("#RegCompleted_ListModal").modal('hide');
            // $("#RegDoc_Office_ListModal").modal('hide');
            // $("#LegalBook_Office_ListModal").modal('hide');
            // $("#LegalBook_Issued_ListModal").modal('hide');

            // $("#t_project_id").val('');
            // $("#r_project_id").val('');
            // $("#off_project_id").val('');
            // $("#off_issue_p_id").val('');
            // $("#legal_project_id").val('');
            // $("#legal_issue_p_id").val('');

            // $("#plot_no").val('').trigger('change');
            // $("#reg_plot_no").val('').trigger('change');
            // $("#office_plot_no").val('').trigger('change');
            // $("#office_issue_plot_no").val('').trigger('change');
            // $("#legal_plot_no").val('').trigger('change');
            // $("#legal_issue_plot_no").val('').trigger('change');
            window.location.reload();
        }
    </script>
@endsection
