@extends('layouts.app')
@section('content')
    <div class="row mt-2">
 <?php

 
$designation_id = Request::input('designation_id');
$from_date = Request::input('from_date');
$to_date=Request::input('to_date');
if($from_date == '')
{
    $from_date = date('Y-m-d');
}
if($to_date == '')
{
    $to_date = date('Y-m-d');
}

$status = Request::input('status');
 
?>
      
     
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Marketer Status Report</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                    <form   method="get"  autocomplete="off" url ="{{ route('marketer-status-report') }}">
                    <div class="row">
                        <div class="col-md-3">
                                <label class="form-label">From Date  </label>
                                <div class="input-group">
                                <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker"   value="{{ $from_date }}" 
                                        type="date" name="from_date" id="from_date">
                                </div>
                             
                            </div>
                            
                             <div class="col-md-3">
                                <label class="form-label">To Date </label>
                                <div class="input-group">
                                   <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker"  value="{{ $to_date }}" 
                                        type="date" name="to_date" id="to_date">
                                </div>
                                </div>
                           
                            <div class="col-md-3">
                                <label class="form-label">Designation </label>
                                <div class="input-group">
                                 <select name="designation_id[]" id="designation_id"  style="height:40px !important" class="form-control SlectBox" multiple>
                                        <option value="">All</option>
                                        @if(isset($designation) && !empty($designation))
                                        @foreach($designation as $val)
                                        <option value="{{ $val->id }}" @if(isset($designation_id)) @if(in_array($val->id, $designation_id)) {{ "Selected" }} @endif @endif
                                         >{{ $val->designation }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                             
                            </div>
                             <div class="col-md-2">
                                <label class="form-label">Status </label>
                                <div class="input-group">
                                 <select name="status" id="status"  style="height:40px !important" class="form-control SlectBox" >
                                        <option value="">All</option>
                                        <option value="1" @if($status == 1) {{ "Selected" }} @endif >Active</option>
                                        <option value="2" @if($status == 2) {{ "Selected" }} @endif >In Active</option>
                                    </select>
                                </div>
                             
                            </div>
                      <div class="col-md-2 mt-3">
                                 <br>
                                <button type="submit" class="btn btn-primary me-2">Search</button>
                               
                            </div>
                            </div>
                            </form>
                            </div>
                            <br><br>
                    <form id="Add_LegalDocumentAbstract_Form" autocomplete="off">
                        @csrf
                        @method('POST')
                        
                            <!--<div class="row border border-light-subtle mt-1" style="border-radius:5px;">-->
                             <div class="row mt-2 border border-light-subtle" style="border-radius:5px;">
                                <div class="table-responsive export-table">
                                <table id="LegalDocumentAbstract_Lists"
                                    class="table table-bordered text-nowrap text-center mb-0">
                                    <thead class="border text-center">
                                       <!-- <tr>-->
                                       <!--     <th   rowspan="2">S.No</th>-->
                                       <!--     <th  rowspan="2">Marketer ID</th>-->
                                       <!--     <th  rowspan="2">Name</th>-->
                                       <!--     <th colspan="2">ME</th>-->
                                       <!--     <th colspan="2">MS</th>-->
                                       <!--     <th colspan="2">MM</th>-->
                                       <!--     <th colspan="2">Director</th>-->
                                       <!--     <th rowspan="2">Designation</th>-->
                                           
                                       <!--     <th  rowspan="2">Site Visit</th>-->
                                       <!--     <th  rowspan="2">Booked Plots</th>-->
                                       <!--     <th   rowspan="2">Reg.Plots</th>-->
                                       <!--     <th  rowspan="2">Payment</th>-->
                                            
                                       <!-- </tr>-->
                                        
                                       <!--<tr>-->
                                       <!--     <th style="border-top :1px solid #eaedf1 !important;">ID</th>-->
                                       <!--     <th style="border-top :1px solid #eaedf1 !important;">Name</th>-->
                                       <!--     <th style="border-top :1px solid #eaedf1 !important;">ID</th>-->
                                       <!--     <th style="border-top :1px solid #eaedf1 !important;">Name</th>-->
                                       <!--     <th style="border-top :1px solid #eaedf1 !important;">ID</th>-->
                                       <!--     <th style="border-top :1px solid #eaedf1 !important;">Name</th>-->
                                       <!--     <th style="border-top :1px solid #eaedf1 !important;">ID</th>-->
                                       <!--     <th style="border-top :1px solid #eaedf1 !important;">Name</th>-->
                                       <!-- </tr>-->
                                         <tr>
                                            <th style="">SNO</th>
                                            <th style="">Marketer ID</th>
                                            <th style="">Name</th>
                                            <th style="">Designation</th>
                                            <!--<th style="">ME ID</th>-->
                                            <!--<th style="">ME Name</th>-->
                                            <th style="">MS ID</th>
                                            <th style="">MS Name</th>
                                            <th style="">MM ID</th>
                                            <th style="">MM Name</th>
                                            <th style="">Director ID</th>
                                            <th style="">Director Name</th>
                                            
                                            <th style="">Site Visit</th>
                                            <th style="">Booked Plots</th>
                                            <th style="">Reg. Plots</th>
                                            <th style="">Payment</th>
                                        </tr>
                                     
                                    </thead>
                                            <tbody class="border">
                                                <?php
                                                $i = 1;
                                                $director_id = '';
                                                 $director_name = '';
                                                $manager_id = '';
                                                $manager_name = '';
                                                $supervisor_id = '';
                                                $supervisor_name = '';
                                                $executive_id = '';
                                                $executive_name = '';
                                                $designation = '';
                                                $booked_total = 0;
                                                $reg_total = 0;
                                                $amount_total = 0;
                                                $visit_total = 0;
                                                ?>
                                                    @if(isset($marketer))
                                                    @foreach($marketer as $val)
                                                    
                                                    <?php
                                                    $user_details = \App\Models\User::where('id',$val->id)->first();
                                                    $get_designation = \App\Models\Designation::where('id',$val->designation_id)->first();
                                                    if(isset($get_designation))
                                                    {
                                                        $designation = $get_designation->designation;
                                                        
                                                    }
                                                    
                                                    
        //                                              if(isset($user_details))
        // {
        
        // if(isset($user_details->director_id))
        // {
        //  $get_director_details = \App\Models\User::where('users.id',$user_details->director_id)->leftjoin('designation','designation.id','users.designation_id')
        //                          ->select('users.*','designation.designation')->first();   
        //  if(isset($get_director_details))
        // {
        //     $director_id = $get_director_details->reference_code;
        //     $director_name = $get_director_details->name;
        // } 
                                 
        // }
        // if(isset($user_details->marketing_manager_id))
        // {
        //  $get_marketing_manager_details = \App\Models\User::where('users.id',$user_details->marketing_manager_id)->leftjoin('designation','designation.id','users.designation_id')
        //                          ->select('users.*','designation.designation')->first();   
        
        //  if(isset($get_marketing_manager_details))
        // {
        //     $manager_id = $get_marketing_manager_details->reference_code;
        //     $manager_name = $get_marketing_manager_details->name;
        // }
        
        // }
        // if(isset($user_details->marketing_supervisor_id))
        // {
        //  $get_marketing_supervisor_details = \App\Models\User::where('users.id',$user_details->marketing_supervisor_id)->leftjoin('designation','designation.id','users.designation_id')
        //                          ->select('users.*','designation.designation')->first();  
        
        // if(isset($get_marketing_supervisor_details))
        // {
        //     $supervisor_id = $get_marketing_supervisor_details->reference_code;
        //     $supervisor_name = $get_marketing_supervisor_details->name;
        // }
        // } 
        
        // if(isset($user_details->marketing_executive_id))
        // {
        //  $get_marketing_executive_details = \App\Models\User::where('users.id',$user_details->marketing_executive_id)->leftjoin('designation','designation.id','users.designation_id')
        //                          ->select('users.*','designation.designation')->first();
        
        // if(isset($get_marketing_executive_details))
        // {
        //     $executive_id = $get_marketing_executive_details->reference_code;
        //     $executive_name = $get_marketing_executive_details->name;
        // }
        // } 
        
        // } 
        
          if (isset($user_details)) {
                    if (!empty($user_details->director_id) && $user_details->director_id != null) {
                        $get_director_details = \App\Models\User::where('users.id', $user_details->director_id)
                            ->leftjoin('designation', 'designation.id', 'users.designation_id')
                            ->select('users.*', 'designation.designation')
                            ->first();
                        if (isset($get_director_details)) {
                            $director_id = $get_director_details->reference_code;
                            $director_name = $get_director_details->name;
                        }
                    } else {
                        $director_id = '';
                        $director_name = '';
                    }
                    if (!empty($user_details->marketing_manager_id) && $user_details->marketing_manager_id != null) {
                        $get_marketing_manager_details = \App\Models\User::where('users.id', $user_details->marketing_manager_id)
                            ->leftjoin('designation', 'designation.id', 'users.designation_id')
                            ->select('users.*', 'designation.designation')
                            ->first();
                
                        if (!empty($get_marketing_manager_details) && $get_marketing_manager_details != null && isset($get_marketing_manager_details)) {
                            $manager_id = $get_marketing_manager_details->reference_code;
                            $manager_name = $get_marketing_manager_details->name;
                        }
                    } else {
                        $manager_id = '';
                        $manager_name = '';
                    }
                    if (!empty($user_details->marketing_supervisor_id) && $user_details->marketing_supervisor_id != null) {
                        $get_marketing_supervisor_details = \App\Models\User::where('users.id', $user_details->marketing_supervisor_id)
                            ->leftjoin('designation', 'designation.id', 'users.designation_id')
                            ->select('users.*', 'designation.designation')
                            ->first();
                
                        if (isset($get_marketing_supervisor_details)) {
                            $supervisor_id = $get_marketing_supervisor_details->reference_code;
                            $supervisor_name = $get_marketing_supervisor_details->name;
                        }
                    } else {
                        $supervisor_id = '';
                        $supervisor_name = '';
                    }
                
                    if (!empty($user_details->marketing_executive_id) && $user_details->marketing_executive_id != null) {
                        $get_marketing_executive_details = \App\Models\User::where('users.id', $user_details->marketing_executive_id)
                            ->leftjoin('designation', 'designation.id', 'users.designation_id')
                            ->select('users.*', 'designation.designation')
                            ->first();
                
                        if (isset($get_marketing_executive_details)) {
                            $executive_id = $get_marketing_executive_details->reference_code;
                            $executive_name = $get_marketing_executive_details->name;
                        }
                    } else {
                        $executive_id = '';
                        $executive_name = '';
                    }
        }
        if($val->designation_id == 1)
        {
            $director_id = $val->reference_code;
            $director_name = $val->name;
        }
        
                                             $get_marketer_book = \App\Models\Booking::where('marketer_id',$val->id)
                                                                  ->whereNull('booking_status')
                                                                  ->whereBetween('receipt_date',[$from_date,$to_date])->get();
                                             
                                             $booking_ids = array();
                                             if(isset($get_marketer_book))
                                             {
                                                 foreach($get_marketer_book as $market_val)
                                                 {
                                                     array_push($booking_ids,$market_val->plot_id);
                                                     
                                                 }
                                             }
                                             
                                             $get_total_payment = \App\Models\Payment::whereIn('plot_id',$booking_ids)
                                                                   ->select(DB::raw('SUM(amount) as total_amount'))->first();
                                           if(isset($get_total_payment))
                                           {
                                             $total_amount = $get_total_payment->total_amount;  
                                           }else{
                                               $total_amount = 0;
                                           }
                                            
                                             
        
                                         $booking_count = \App\Models\Booking::whereNull('confirm_status')
                                         ->whereBetween('receipt_date',[$from_date,$to_date])
                               ->whereNull('register_status')->whereNull('booking_status')->where('marketer_id',$val->id)->get()->count();
                        
                                 $registered_plots = \App\Models\Booking::whereNotNull('register_status')->whereNull('booking_status')
                                                     ->whereBetween('receipt_date',[$from_date,$to_date])->where('marketer_id',$val->id)->get()->count();
                                 
                                 $amount_total = $amount_total + $total_amount;
                                 $booked_total = $booked_total + $booking_count;
                                 $reg_total = $reg_total + $registered_plots;
                                 
                                 if($designation == "Marketing Executive")
                                 {
                                     $new_des = "ME";
                                 }else if($designation == "Marketing Supervisor")
                                 {
                                     $new_des = "MS";
                                 }else if($designation == "Marketing Managers")
                                 {
                                     $new_des = "MM";
                                 }else{
                                     $new_des = "Director";
                                 }
                                 
                                 
                                 $project_visit_count = \App\Models\ProjectVisit::whereBetween('visit_date',[$from_date,$to_date])
                                                       ->where('marketer_id',$val->id)->get()->count();
                                                       
                                                       $visit_total = $visit_total + $project_visit_count;
                                                    ?>
                                                     <tr>
                                                     <td > {{ $i++ }}</td>
                                                     <td> {{ $val->reference_code }}</td>
                                                     <td> {{ $val->name }}</td>
                                                     <td>{{ $new_des }}</td>
                                                    <!--<td>-->
                                                    <!--    {{ $executive_id }}-->
                                                    <!--</td>-->
                                                    <!--<td>-->
                                                    <!--    {{ $executive_name }}-->
                                                    <!--</td>-->
                                                    <td>
                                                        {{ $supervisor_id }}
                                                    </td>
                                                    <td>
                                                        {{ $supervisor_name }}
                                                    </td>
                                                    <td>
                                                        {{ $manager_id }}
                                                    </td>
                                                    <td>
                                                        {{ $manager_name }}
                                                    </td>
                                                    <td>
                                                        {{ $director_id }}</td>
                                                    <td>
                                                        {{ $director_name }}</td>
                                                    
                                                   
                                                    <td  style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        {{ $project_visit_count }}</td>
                                                    <td  style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        {{ $booking_count }}</td>
                                                    <td  style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        {{ $registered_plots }}</td>
                                                    <td  style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        {{ IND_money_format(round($total_amount)) }}</td>
                                                  
                                                </tr>
                                                  @endforeach
                                                  @endif
                                                  
                                                
                                             
 
                                    </tbody>
                                    <tfoot>
                                          <tr>
                                                     <td colspan="10"> 
                                                     <h6 class="fs-15 fw-bold text-end pt-2 text-danger">Total :</h6>
                                                     </td>
                                                    <td  style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        <h6 class="fs-15 fw-bold text-center pt-2 text-danger"> {{ $visit_total }} </h6></td>  
                                                    <td  style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        <h6 class="fs-15 fw-bold text-center pt-2 text-danger"> {{ $booked_total }} </h6></td>
                                                    <td  style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        <h6 class="fs-15 fw-bold text-center pt-2 text-danger"> {{ $reg_total }} </h6></td>
                                                    <td  style="cursor: pointer;width:150px; color:#09ad95 !important;font-size:14px;">
                                                        <h6 class="fs-15 fw-bold text-center pt-2 text-danger"> {{ IND_money_format(round($amount_total)) }} </h6></td>
                                                  
                                                </tr>
                                    </tfoot>
                                </table>
                                </div>
                            </div>
                            <br><br>
                            <!--</div>-->
                         
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
      
      $(document).ready(function() {
            var table = $('#LegalDocumentAbstract_Lists').DataTable({
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "iDisplayLength" : 100,
    // buttons:[ "excel","pdf"],
    buttons: [
      {
        extend: 'excelHtml5',
          
       
      },
      {
        extend: 'pdfHtml5',
        orientation:'landscape',
         pageSize: 'LEGAL',
        
      },
     ]
    
}).buttons().container().appendTo("#LegalDocumentAbstract_Lists_wrapper .col-md-6:eq(0)");
          });
          
    //   $(document).ready(function() {
    //         var table = $('#LegalDocumentAbstract_Lists').DataTable();
    //       });
   
    
    </script>
@endsection
