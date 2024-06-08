<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Designation;
use App\Models\Director;
use App\Models\MarketingExecutive;
use App\Models\MarketingManager;
use App\Models\MarketingSupervisor;
use App\Models\Pincode;
use App\Models\Account;
use App\Models\Booking;
use App\Models\ProjectDetail;
use App\Models\PlotManagement;
use App\Models\Relationship;
use App\Models\Staff_Detail;
use App\Models\User;
use App\Models\Payment;
use App\Models\ProjectVisit;
use App\Models\Bank;
use App\Models\PrintTemplateContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
// use Request;

class ReportController extends Controller
{
    public function cancelPlots(Request $request)
    {
        // try {
            $plots = '';
            $project_id =  $request->project_id;
            $plot_id =  $request->plot_id;
            $projects = ProjectDetail::all();
            if(isset($project_id))
            {
            $plots = PlotManagement::leftjoin('booking','booking.plot_id','plot_management.id')
            ->where('plot_management.project_id',$project_id)->whereNotNull('booking.booking_status')->where('plot_management.deleted_at',0)
            ->select('plot_management.id','plot_management.plot_no')->get();
            }
            
            $payments = Booking::leftjoin('project_details','project_details.id','booking.project_id')
                       ->leftjoin('plot_management','plot_management.id','booking.plot_id')
                        ->whereNotNull('booking.booking_status')
                       ->select('booking.*','plot_management.plot_no','project_details.short_name','plot_management.plot_sq_ft','booking.receipt_date','booking.cancel_date','booking.marketer_id','booking.id as book_id')
                       ->groupby('booking.id');
                   
                       
        if(isset($project_id))
        
        {
            $payments = $payments->where('booking.project_id',$project_id);
        }
        if(isset($plot_id))
        
        {
            $payments = $payments->whereIn('booking.plot_id',$plot_id);
        }
                $query = $payments->orderby('booking.id','asc')->get();
            // $payments = $payments->groupBy('part_payment.plot_id');
            return view('reports.cancel_plots', compact('query','projects','plots','plot_id','project_id'));
        // } catch (\Exception $e) {
        //     return back()->with(['error' => $e->getMessage()])->withInput();
        // }
    }
   
    public function cance_plot_list($id)
    {
          
        $plots = PlotManagement::leftjoin('booking','booking.plot_id','plot_management.id')
        ->where('plot_management.project_id',$id)->whereNotNull('booking.booking_status')->where('plot_management.deleted_at',0);
        
        $query = $plots->select('plot_management.id','plot_management.plot_no')->get();
        return response()->json(['status' => true, 'data' => $query], 200);
    }
 
  
   public function getcancelPlots($project_id,$id)
   {
       
       $booking =Booking::where('project_id',$project_id)->where('plot_id',$id)->first();
       
       $plots = PlotManagement::where('id',$id)->where('deleted_at',0)->first();
       
       if(isset($booking))
       {
       
        $customer_name = '';
        $customer_mobile = '';
        $alternate_mobile = '';
       if(isset($booking->customer_id))
       {
            $customer_id = $booking->customer_id;
           $get_customer_details = Booking::where('id',$booking->customer_id)->first();
           if(isset($get_customer_details))
           {
           $customer_name = $get_customer_details->customer_name;
           $street = $get_customer_details->street;
           $pincode = $get_customer_details->pincode;
           
           if($get_customer_details->gender ==1)
           {
               $gender = "Male";
           }else{
               $gender = "Female";
           }
           
           $get_area = Pincode::where('id',$get_customer_details->area)->first();
           if(isset($get_area))
           {
           $area = $get_area->area;
           $city = $get_area->city;
           $state = $get_area->state;
           }
           $customer_mobile = $get_customer_details->mobile;
           $alternate_mobile = $get_customer_details->alternate_mobile;   
           }
           $st = "<br>";
          $address =  $street ."\n" . $area .  "\n". $city  .'-'. $pincode  ;
          
        }else{
           $customer_id = $booking->id;
           $customer_name = $booking->customer_name;
           $street = $booking->street;
           $pincode = $booking->pincode;
           
           if($booking->gender ==1)
           {
               $gender = "Male";
           }else{
               $gender = "Female";
           }
           
           $get_area = Pincode::where('id',$booking->area)->first();
           if(isset($get_area))
           {
           $area = $get_area->area;
           $city = $get_area->city;
           $state = $get_area->state;
           }
           $customer_mobile = $booking->mobile;
           $alternate_mobile = $booking->alternate_mobile;
           
           $address =  $street ."\n" . $area .  "\n". $city  .'-'. $pincode  ;
           
       }
       
       
       
       $user_details = User::where('users.id',$booking->marketer_id)->first();
                                 
       $marketer = '';
        if(isset($user_details))
        {
            if($user_details->user_type != 'director')
            {
                if(isset($user_details->director_id))
        {
         $get_director_details = User::where('users.id',$user_details->director_id)->leftjoin('designation','designation.id','users.designation_id')
                                 ->select('users.*','designation.designation')->first();   
        $marketer = '<tr><td>#</td><td>'.$get_director_details->reference_code.'</td><td>'.$get_director_details->designation.'</td>
                              <td>'.$get_director_details->name.'</td><td>'.$get_director_details->mobile_no.'</td></tr>';
                                 
        }
        if(isset($user_details->marketing_manager_id))
        {
         $get_marketing_manager_details = User::where('users.id',$user_details->marketing_manager_id)->leftjoin('designation','designation.id','users.designation_id')
                                 ->select('users.*','designation.designation')->first();   
        if(isset($get_marketing_manager_details))
        {
        $marketer .= '<tr><td>#</td><td>'.$get_marketing_manager_details->reference_code.'</td><td>'.$get_marketing_manager_details->designation.'</td>
                              <td>'.$get_marketing_manager_details->name.'</td><td>'.$get_marketing_manager_details->mobile_no.'</td></tr>';    
        }
        
        }
        if(isset($user_details->marketing_supervisor_id))
        {
         $get_marketing_supervisor_details = User::where('users.id',$user_details->marketing_supervisor_id)->leftjoin('designation','designation.id','users.designation_id')
                                 ->select('users.*','designation.designation')->first();   
        if(isset($get_marketing_supervisor_details))
        {
        $marketer .= '<tr><td>#</td><td>'.$get_marketing_supervisor_details->reference_code.'</td><td>'.$get_marketing_supervisor_details->designation.'</td>
                              <td>'.$get_marketing_supervisor_details->name.'</td><td>'.$get_marketing_supervisor_details->mobile_no.'</td></tr>';    
        }
        }  
            }else{
              $get_user_details = User::where('users.id',$user_details->id)->leftjoin('designation','designation.id','users.designation_id')
                                 ->select('users.*','designation.designation')->first();  
            if(isset($get_user_details))
            {
             $marketer .= '<tr><td>#</td><td>'.$get_user_details->reference_code.'</td><td>'.$get_user_details->designation.'</td>
                              <td>'.$get_user_details->name.'</td><td>'.$get_user_details->mobile_no.'</td></tr>';   
            }
                
           }
        
        
        
        }
        $paid_amount = Payment::where('project_id',$project_id)->where('plot_id',$id)->select( DB::raw('SUM(amount) as paid_amount'))->first();
        
        if(isset($paid_amount))
        {
            $paid = $paid_amount->paid_amount;
        }else{
            $paid = 0;
        }
        
        $guide_line = 0;
        $project_name = '';
        $project_details = ProjectDetail::where('id',$project_id)->first();
        
        if(isset($project_details))
        {
            $guide_line = $project_details->guide_line;
            $project_name = $project_details->full_name;
        }
       
        $payment = '';
        $payments = '';
        $payment_list = Payment::where('project_id',$project_id)->where('plot_id',$id)->get();
        if(isset($payment_list))
        {
            $paymode = '';
            $type = '';
            $i =   1 ;
            foreach($payment_list as $payment)
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
                                                
                                                if($payment->fully_paid == 1)
                                                {
                                                    $new_narration = 'Fully Paid';
                                                }else{
                                                    $new_narration = $narration;
                                                }
                                                
                                                
                   if($payment->payment_term == 1)
                {
                    $pay_term = 'Own Fund';
                }else{
                    $pay_term = 'Bank Loan';
                }
                
                if($payment->amount_towards == 1)
                {
                    $amount_towards = 'MV';
                }else{
                    $amount_towards = 'GL';
                }
              
                $payment = '<tr><td>'.$i++.'</td><td>'.$payment->receipt_no.'</td><td>'.date('d-m-Y',strtotime($payment->receipt_date)).'</td>
                              <td>'.$payment->amount.'</td><td>'.$payment->discount.'</td><td>'.$type.'</td>
                              <td>'.$paymode.'</td><td>'.$pay_term.'</td><td>'.$amount_towards.'</td><td>'.$new_narration.'
                              <input type="hidden" class="form-control" name="payment_id[]" id="payment_id" value="' . $payment->id . '" ></td></tr>';
                              
                $payments .= $payment;
            }
        }
        
        
       return response()->json(['status' => true, 'data' => $booking,'marketer' => $marketer,'customer_name' => $customer_name, 'mobile' => $customer_mobile,
       'alternate_mobile' => $alternate_mobile,'gender' => $gender,'address' => $address,'payment_history' => $payments ,'plots' => $plots,'customer_id' => $customer_id,
       'paid' => $paid ,'project_name' => $project_name
       ,'guide_line' => $guide_line], 200);
       }
       else{
            return response()->json(['status' => false, 'msg' => 'No Data Found'], 200);
       }
       
   }
   
   
   public function bookingRegisteredList(Request $request)
    {
        // try {
            $plots = '';
            $project_id =  $request->project_id;
            
            $plot_id =  $request->plot_id;
            $projects = ProjectDetail::all();
            // $marketer = User::where('user_type','!=','staff')->where('user_type','!=','admin')->where('user_type','!=','gl_admin')->get();
            $marketer = User::where('user_type', '!=', 'staff')->where('user_type', '!=', 'admin')->where('user_type','!=','gl_admin');
            if ($request->team != "" && isset($request->team)) {
                $marketer->whereIn('team_name', $request->team);
            }
            $marketer = $marketer->get();
            
            if(isset($project_id))
            {
            $plots = PlotManagement::whereIn('project_id',$project_id)->where('deleted_at',0)->get();    
            }
            
            $team_name = User::where('user_type','!=','staff')->where('user_type','!=','admin')->where('user_type','!=','gl_admin')->groupby('team_name')->get();
            
            $from_date =  $request->from_date;
            $to_date =  $request->to_date;
            if($from_date == '')
            {
            $from_date = date('Y-m-d');
            }
            if($to_date == '')
            {
             $to_date = date('Y-m-d');
            }
            
            $marketer_id = $request->marketer_id;
            $status = $request->status;
            $team_id = $request->team;
         
          $payments = Booking::leftjoin('project_details','project_details.id','booking.project_id')
                       ->leftjoin('plot_management','plot_management.id','booking.plot_id')
                       ->leftjoin('users','users.id','booking.marketer_id')
                       ->whereBetween('booking.receipt_date',[$from_date,$to_date])
                       ->select('booking.*','plot_management.plot_no','plot_management.plot_sq_ft','project_details.short_name','users.team_name');
        
                   
        if(isset($marketer_id))
        
        {
            $payments = $payments->whereIn('booking.marketer_id',$marketer_id);
        }
        
        
        if(isset($team_id))
        
        {
            $payments = $payments->whereIn('users.team_name',$team_id);
        }
        
        if($status == 1)
        
        {
            $payments = $payments->whereNull('booking.fully_paid_status')->whereNull('booking.booking_status');
        }
        
         if($status == 2)
        
        {
            $payments = $payments->where('fully_paid_status',1)->whereNull('register_status');
        }
        
         if($status == 3)
        
        {
            $payments = $payments->where('fully_paid_status',1)->whereNotNull('register_status');
        }
        
         if($status == 4)
        
        {
            $payments = $payments->where('booking_status',1);
        }
                       
        if(isset($project_id))
        
        {
            $payments = $payments->whereIn('booking.project_id',$project_id);
        }
        
         $query = $payments->orderby('booking.id','asc')->get();
         
         
                           $total_plots = 0;
                            $total_sqft = 0;
                            $booking_count_query = Booking::leftjoin('users','users.id','booking.marketer_id')
                                                  ->whereNull('booking.booking_status')
                                                  ->whereNull('fully_paid_status')->whereNull('booking_status')
                                                 ->whereBetween('receipt_date',[$from_date,$to_date]);
                                                 
         
                             
                            $booking_sum_query   = Booking::leftjoin('users','users.id','booking.marketer_id')
                                                 ->leftjoin('plot_management','plot_management.id','booking.plot_id')
                                                 ->whereNull('fully_paid_status')->whereNull('booking_status')
                                                 ->whereNull('booking.booking_status')
                                                 ->whereBetween('receipt_date',[$from_date,$to_date])
                                                ->select(DB::raw('SUM(plot_management.plot_sq_ft) as plot_sqft_sum'));
                                              
                                                 
                            $fully_paid_count_query = Booking::leftjoin('users','users.id','booking.marketer_id')
                                                  ->where('fully_paid_status',1)->whereNull('register_status')
                                                  ->whereNull('booking.booking_status')
                                                 ->whereBetween('receipt_date',[$from_date,$to_date]);
                            $fully_paid_sum_query   = Booking::leftjoin('plot_management','plot_management.id','booking.plot_id')
                                                 ->leftjoin('users','users.id','booking.marketer_id')
                                                 ->where('fully_paid_status',1)->whereNull('register_status')
                                                 ->whereNull('booking.booking_status')
                                                 ->whereBetween('receipt_date',[$from_date,$to_date])
                                                ->select(DB::raw('SUM(plot_management.plot_sq_ft) as plot_sqft_sum'));
                            
                             
                             
                            $registered_count_query = Booking::leftjoin('users','users.id','booking.marketer_id')->where('fully_paid_status',1)
                                                 ->whereNotNull('register_status')->whereNull('booking_status')
                                                 ->whereBetween('receipt_date',[$from_date,$to_date]);
                            $registered_sum_query   = Booking::leftjoin('plot_management','plot_management.id','booking.plot_id')
                                                   ->leftjoin('users','users.id','booking.marketer_id')
                                                 ->where('fully_paid_status',1)->whereNotNull('register_status')->whereNull('booking.booking_status')
                                                 ->whereBetween('receipt_date',[$from_date,$to_date])
                                                ->select(DB::raw('SUM(plot_management.plot_sq_ft) as plot_sqft_sum'));
                            
                            
                            
                            $cancelled_count_query = Booking::leftjoin('users','users.id','booking.marketer_id')->where('booking_status',1)
                                               ->whereBetween('receipt_date',[$from_date,$to_date]);
                            $cancelled_sum_query   = Booking::leftjoin('plot_management','plot_management.id','booking.plot_id')
                                                 ->leftjoin('users','users.id','booking.marketer_id')
                                                 ->where('booking_status',1)->whereBetween('receipt_date',[$from_date,$to_date])
                                                ->select(DB::raw('SUM(plot_management.plot_sq_ft) as plot_sqft_sum'));
                            
                             
                            
                             
                             
                              if(isset($marketer_id))
        
        {
            $booking_count_query = $booking_count_query->whereIn('booking.marketer_id',$marketer_id);
            $booking_sum_query = $booking_sum_query->whereIn('booking.marketer_id',$marketer_id);
            $fully_paid_count_query = $fully_paid_count_query->whereIn('booking.marketer_id',$marketer_id);
            $fully_paid_sum_query = $fully_paid_sum_query->whereIn('booking.marketer_id',$marketer_id);
            $registered_count_query = $registered_count_query->whereIn('booking.marketer_id',$marketer_id);
            $registered_sum_query = $registered_sum_query->whereIn('booking.marketer_id',$marketer_id);
            $cancelled_count_query = $cancelled_count_query->whereIn('booking.marketer_id',$marketer_id);
            $cancelled_sum_query = $cancelled_sum_query->whereIn('booking.marketer_id',$marketer_id);
        }
        
        
        if(isset($team_id))
        
        {
            $booking_count_query = $booking_count_query->whereIn('users.team_name',$team_id);
            $booking_sum_query = $booking_sum_query->whereIn('users.team_name',$team_id);
            $fully_paid_count_query = $fully_paid_count_query->whereIn('users.team_name',$team_id);
            $fully_paid_sum_query = $fully_paid_sum_query->whereIn('users.team_name',$team_id);
            $registered_count_query = $registered_count_query->whereIn('users.team_name',$team_id);
            $registered_sum_query = $registered_sum_query->whereIn('users.team_name',$team_id);
            $cancelled_count_query = $cancelled_count_query->whereIn('users.team_name',$team_id);
            $cancelled_sum_query = $cancelled_sum_query->whereIn('users.team_name',$team_id);
        }
        
        if($status == 1)
        
        {
            $booking_count_query = $booking_count_query->whereNull('booking.fully_paid_status');
            $booking_sum_query = $booking_sum_query->whereNull('booking.fully_paid_status');
            $fully_paid_count_query = $fully_paid_count_query->whereNull('booking.fully_paid_status');
            $fully_paid_sum_query = $fully_paid_sum_query->whereNull('booking.fully_paid_status');
            $registered_count_query = $registered_count_query->whereNull('booking.fully_paid_status');
            $registered_sum_query = $registered_sum_query->whereNull('booking.fully_paid_status');
            $cancelled_count_query = $cancelled_count_query->whereNull('booking.fully_paid_status');
            $cancelled_sum_query = $cancelled_sum_query->whereNull('booking.fully_paid_status');
        }
        
         if($status == 2)
        
        {
            $booking_count_query = $booking_count_query->where('fully_paid_status',1)->whereNull('register_status');
            $booking_sum_query = $booking_sum_query->where('fully_paid_status',1)->whereNull('register_status');
            $fully_paid_count_query = $fully_paid_count_query->where('fully_paid_status',1)->whereNull('register_status');
            $fully_paid_sum_query = $fully_paid_sum_query->where('fully_paid_status',1)->whereNull('register_status');
            $registered_count_query = $registered_count_query->where('fully_paid_status',1)->whereNull('register_status');
            $registered_sum_query = $registered_sum_query->where('fully_paid_status',1)->whereNull('register_status');
            $cancelled_count_query = $cancelled_count_query->where('fully_paid_status',1)->whereNull('register_status');
            $cancelled_sum_query = $cancelled_sum_query->where('fully_paid_status',1)->whereNull('register_status');
        }
        
         if($status == 3)
        
        {
            $booking_count_query = $booking_count_query->where('fully_paid_status',1)->whereNotNull('register_status');
            $booking_sum_query = $booking_sum_query->where('fully_paid_status',1)->whereNotNull('register_status');
            $fully_paid_count_query = $fully_paid_count_query->where('fully_paid_status',1)->whereNotNull('register_status');
            $fully_paid_sum_query = $fully_paid_sum_query->where('fully_paid_status',1)->whereNotNull('register_status');
            $registered_count_query = $registered_count_query->where('fully_paid_status',1)->whereNotNull('register_status');
            $registered_sum_query = $registered_sum_query->where('fully_paid_status',1)->whereNotNull('register_status');
            $cancelled_count_query = $cancelled_count_query->where('fully_paid_status',1)->whereNotNull('register_status');
            $cancelled_sum_query = $cancelled_sum_query->where('fully_paid_status',1)->whereNotNull('register_status');
        }
        
         if($status == 4)
        
        {
            $booking_count_query = $booking_count_query->where('booking_status',1);
            $booking_sum_query = $booking_sum_query->where('booking_status',1);
            $fully_paid_count_query = $fully_paid_count_query->where('booking_status',1);
            $fully_paid_sum_query = $fully_paid_sum_query->where('booking_status',1);
            $registered_count_query = $registered_count_query->where('booking_status',1);
            $registered_sum_query = $registered_sum_query->where('booking_status',1);
            $cancelled_count_query = $cancelled_count_query->where('booking_status',1);
            $cancelled_sum_query = $cancelled_sum_query->where('booking_status',1);
        }
                       
        if(isset($project_id))
        
        {
            $booking_count_query = $booking_count_query->whereIn('booking.project_id',$project_id);
            $booking_sum_query = $booking_sum_query->whereIn('booking.project_id',$project_id);
            $fully_paid_count_query = $fully_paid_count_query->whereIn('booking.project_id',$project_id);
            $fully_paid_sum_query = $fully_paid_sum_query->whereIn('booking.project_id',$project_id);
            $registered_count_query = $registered_count_query->whereIn('booking.project_id',$project_id);
            $registered_sum_query = $registered_sum_query->whereIn('booking.project_id',$project_id);
            $cancelled_count_query = $cancelled_count_query->whereIn('booking.project_id',$project_id);
            $cancelled_sum_query = $cancelled_sum_query->whereIn('booking.project_id',$project_id);
        }
        
         $booking_count = $booking_count_query->orderby('booking.id','asc')->get()->count();
         $booking_sum = $booking_sum_query->first();
         $fully_paid_count = $fully_paid_count_query->orderby('booking.id','asc')->get()->count();
         $fully_paid_sum = $fully_paid_sum_query->first();
         $registered_count = $registered_count_query->orderby('booking.id','asc')->get()->count();
         $registered_sum = $registered_sum_query->first();
         $cancelled_count = $cancelled_count_query->orderby('booking.id','asc')->get()->count();
         $cancelled_sum = $cancelled_sum_query->first();
         
                             
                             
                              $booking_sqft = $booking_sum->plot_sqft_sum;
                             if($booking_sqft == '')
                             {
                                 $booking_sqft = 0;
                             }
                              $fully_paid_sqft = $fully_paid_sum->plot_sqft_sum;
                             if($fully_paid_sqft == '')
                             {
                                 $fully_paid_sqft = 0;
                             }
                              $registered_sqft = $registered_sum->plot_sqft_sum;
                             if($registered_sqft == '')
                             {
                                 $registered_sqft = 0;
                             }
                              $cancelled_sqft = $cancelled_sum->plot_sqft_sum;
                             if($cancelled_sqft == '')
                             {
                                 $cancelled_sqft = 0;
                             }
                             
                             $total_plots = $booking_count + $fully_paid_count + $registered_count + $cancelled_count;
                             $total_sqft = $booking_sqft + $fully_paid_sqft + $registered_sqft + $cancelled_sqft;
                               
            
            return view('reports.booking_registered_list', compact('query','projects','plots','plot_id','project_id','marketer','team_name',
              'booking_count','fully_paid_count','registered_count','cancelled_count','booking_sqft','fully_paid_sqft','registered_sqft','cancelled_sqft','total_plots','total_sqft'));
        // } catch (\Exception $e) {
        //     return back()->with(['error' => $e->getMessage()])->withInput();
        // }
   
}


  public function projectDetailsList(Request $request)
    {
        // try {
            $plots = '';
            $project_id =  $request->project_id;
            $plot_id =  $request->plot_id;
            $projects = ProjectDetail::all();
            // $marketer = User::where('user_type','!=','staff')->where('user_type','!=','admin')->get();
            $marketer = User::where('user_type', '!=', 'staff')->where('user_type', '!=', 'admin')->where('user_type','!=','gl_admin');
            if ($request->team != "" && isset($request->team)) {
                $marketer->where('team_name', $request->team);
            }
            $marketer = $marketer->get();
            
            if(isset($project_id))
            {
            $plots = PlotManagement::whereIn('project_id',$project_id)->where('deleted_at',0)->get();    
            }
            
            $team_name = User::where('user_type','!=','staff')->where('user_type','!=','admin')->where('user_type','!=','gl_admin')->groupby('team_name')->get();
            
            $from_date =  $request->from_date;
            $to_date =  $request->to_date;
            if($from_date == '')
            {
            $from_date = date('Y-m-d');
            }
            if($to_date == '')
            {
             $to_date = date('Y-m-d');
            }
            
            $marketer_id = $request->marketer_id;
            $status = $request->status;
            $team_id = $request->team;
         
          $payments = PlotManagement::leftjoin('project_details','project_details.id','plot_management.project_id')
                        ->leftjoin('direction','direction.id','plot_management.direction_id')
                        ->where('plot_management.deleted_at',0)
                        ->select( 'plot_management.plot_no','plot_management.id','plot_management.project_id','plot_management.plot_sq_ft','plot_management.guide_line_sq_ft',
                       'plot_management.market_value_sq_ft','plot_management.guide_line_plot_rate','plot_management.market_value_plot_rate',
                       'project_details.short_name','direction.direction_name');
        
                   
       
        // if($status == 1)
        
        // {
        //     $payments = $payments->whereNull('booking.fully_paid_status')->whereNull('booking.booking_status');
        // }
        
        //  if($status == 2)
        
        // {
        //     $payments = $payments->where('fully_paid_status',1)->whereNull('register_status');
        // }
        
        //  if($status == 3)
        
        // {
        //     $payments = $payments->where('fully_paid_status',1)->whereNotNull('register_status');
        // }
        
        //  if($status == 4)
        
        // {
        //     $payments = $payments->where('booking_status',1);
        // }
                       
        if(isset($project_id))
        
        {
            $payments = $payments->whereIn('plot_management.project_id',$project_id);
        }
        
         $query = $payments->orderby('plot_management.id','asc')->get();
         
         
                           $total_plots = 0;
                            $total_sqft = 0;
                            $booking_count_query = Booking::leftjoin('users','users.id','booking.marketer_id')
                                                  ->leftjoin('plot_management','plot_management.id','booking.plot_id')
                                                 ->where('plot_management.deleted_at',0)
                                                  ->whereNull('fully_paid_status')->whereNull('booking_status');
                                                 
         
                             
                            $booking_sum_query   = Booking::leftjoin('users','users.id','booking.marketer_id')
                                                 ->leftjoin('plot_management','plot_management.id','booking.plot_id')
                                                 ->whereNull('fully_paid_status')->whereNull('booking_status')
                                                 ->where('plot_management.deleted_at',0)
                                                 ->select(DB::raw('SUM(plot_management.plot_sq_ft) as plot_sqft_sum'));
                                              
                                                 
                            $fully_paid_count_query = Booking::leftjoin('users','users.id','booking.marketer_id')
                                                  ->leftjoin('plot_management','plot_management.id','booking.plot_id')
                                                 ->where('plot_management.deleted_at',0)
                                                  ->where('fully_paid_status',1)->whereNull('register_status')
                                                  ->whereNull('booking_status');
                            $fully_paid_sum_query   = Booking::leftjoin('plot_management','plot_management.id','booking.plot_id')
                                                 ->leftjoin('users','users.id','booking.marketer_id')
                                                 ->whereNull('booking_status')->where('plot_management.deleted_at',0)
                                                 ->where('fully_paid_status',1)->whereNull('register_status')
                                                  ->select(DB::raw('SUM(plot_management.plot_sq_ft) as plot_sqft_sum'));
                            
                             
                             
                            $registered_count_query = Booking::leftjoin('users','users.id','booking.marketer_id')
                                                    ->leftjoin('plot_management','plot_management.id','booking.plot_id')
                                                 ->where('plot_management.deleted_at',0)
                                                  ->whereNull('booking_status')->where('fully_paid_status',1)->whereNotNull('register_status')
                                                  ;
                            $registered_sum_query   = Booking::leftjoin('plot_management','plot_management.id','booking.plot_id')
                                                   ->leftjoin('users','users.id','booking.marketer_id')
                                                   ->whereNull('booking_status')->where('plot_management.deleted_at',0)
                                                 ->where('fully_paid_status',1)->whereNotNull('register_status')
                                                  ->select(DB::raw('SUM(plot_management.plot_sq_ft) as plot_sqft_sum'));
                            
                            
                            
                            $cancelled_count_query = Booking::leftjoin('users','users.id','booking.marketer_id')
                                                 ->leftjoin('plot_management','plot_management.id','booking.plot_id')
                                                 ->where('plot_management.deleted_at',0)
                                                 ->where('booking_status',1);
                            $cancelled_sum_query   = Booking::leftjoin('plot_management','plot_management.id','booking.plot_id')
                                                 ->leftjoin('users','users.id','booking.marketer_id')->where('plot_management.deleted_at',0)
                                                 ->where('booking_status',1)->select(DB::raw('SUM(plot_management.plot_sq_ft) as plot_sqft_sum'));
                            
                             
                            
                             
                             
        //                       if(isset($marketer_id))
        
        // {
        //     $booking_count_query = $booking_count_query->where('booking.marketer_id',$marketer_id);
        //     $booking_sum_query = $booking_sum_query->where('booking.marketer_id',$marketer_id);
        //     $fully_paid_count_query = $fully_paid_count_query->where('booking.marketer_id',$marketer_id);
        //     $fully_paid_sum_query = $fully_paid_sum_query->where('booking.marketer_id',$marketer_id);
        //     $registered_count_query = $registered_count_query->where('booking.marketer_id',$marketer_id);
        //     $registered_sum_query = $registered_sum_query->where('booking.marketer_id',$marketer_id);
        //     $cancelled_count_query = $cancelled_count_query->where('booking.marketer_id',$marketer_id);
        //     $cancelled_sum_query = $cancelled_sum_query->where('booking.marketer_id',$marketer_id);
        // }
        
        
        // if(isset($team_id))
        
        // {
        //     $booking_count_query = $booking_count_query->where('users.team_name',$team_id);
        //     $booking_sum_query = $booking_sum_query->where('users.team_name',$team_id);
        //     $fully_paid_count_query = $fully_paid_count_query->where('users.team_name',$team_id);
        //     $fully_paid_sum_query = $fully_paid_sum_query->where('users.team_name',$team_id);
        //     $registered_count_query = $registered_count_query->where('users.team_name',$team_id);
        //     $registered_sum_query = $registered_sum_query->where('users.team_name',$team_id);
        //     $cancelled_count_query = $cancelled_count_query->where('users.team_name',$team_id);
        //     $cancelled_sum_query = $cancelled_sum_query->where('users.team_name',$team_id);
        // }
        
        // if($status == 1)
        
        // {
        //     $booking_count_query = $booking_count_query->whereNull('booking.fully_paid_status')->whereNull('booking.booking_status');
        //     $booking_sum_query = $booking_sum_query->whereNull('booking.fully_paid_status')->whereNull('booking.booking_status');
        //     $fully_paid_count_query = $fully_paid_count_query->whereNull('booking.fully_paid_status')->whereNull('booking.booking_status');
        //     $fully_paid_sum_query = $fully_paid_sum_query->whereNull('booking.fully_paid_status')->whereNull('booking.booking_status');
        //     $registered_count_query = $registered_count_query->whereNull('booking.fully_paid_status')->whereNull('booking.booking_status');
        //     $registered_sum_query = $registered_sum_query->whereNull('booking.fully_paid_status')->whereNull('booking.booking_status');
        //     $cancelled_count_query = $cancelled_count_query->whereNull('booking.fully_paid_status')->whereNull('booking.booking_status');
        //     $cancelled_sum_query = $cancelled_sum_query->whereNull('booking.fully_paid_status')->whereNull('booking.booking_status');
        // }
        
        //  if($status == 2)
        
        // {
        //     $booking_count_query = $booking_count_query->where('fully_paid_status',1)->whereNull('register_status');
        //     $booking_sum_query = $booking_sum_query->where('fully_paid_status',1)->whereNull('register_status');
        //     $fully_paid_count_query = $fully_paid_count_query->where('fully_paid_status',1)->whereNull('register_status');
        //     $fully_paid_sum_query = $fully_paid_sum_query->where('fully_paid_status',1)->whereNull('register_status');
        //     $registered_count_query = $registered_count_query->where('fully_paid_status',1)->whereNull('register_status');
        //     $registered_sum_query = $registered_sum_query->where('fully_paid_status',1)->whereNull('register_status');
        //     $cancelled_count_query = $cancelled_count_query->where('fully_paid_status',1)->whereNull('register_status');
        //     $cancelled_sum_query = $cancelled_sum_query->where('fully_paid_status',1)->whereNull('register_status');
        // }
        
        //  if($status == 3)
        
        // {
        //     $booking_count_query = $booking_count_query->where('fully_paid_status',1)->whereNotNull('register_status');
        //     $booking_sum_query = $booking_sum_query->where('fully_paid_status',1)->whereNotNull('register_status');
        //     $fully_paid_count_query = $fully_paid_count_query->where('fully_paid_status',1)->whereNotNull('register_status');
        //     $fully_paid_sum_query = $fully_paid_sum_query->where('fully_paid_status',1)->whereNotNull('register_status');
        //     $registered_count_query = $registered_count_query->where('fully_paid_status',1)->whereNotNull('register_status');
        //     $registered_sum_query = $registered_sum_query->where('fully_paid_status',1)->whereNotNull('register_status');
        //     $cancelled_count_query = $cancelled_count_query->where('fully_paid_status',1)->whereNotNull('register_status');
        //     $cancelled_sum_query = $cancelled_sum_query->where('fully_paid_status',1)->whereNotNull('register_status');
        // }
        
        //  if($status == 4)
        
        // {
        //     $booking_count_query = $booking_count_query->where('booking_status',1);
        //     $booking_sum_query = $booking_sum_query->where('booking_status',1);
        //     $fully_paid_count_query = $fully_paid_count_query->where('booking_status',1);
        //     $fully_paid_sum_query = $fully_paid_sum_query->where('booking_status',1);
        //     $registered_count_query = $registered_count_query->where('booking_status',1);
        //     $registered_sum_query = $registered_sum_query->where('booking_status',1);
        //     $cancelled_count_query = $cancelled_count_query->where('booking_status',1);
        //     $cancelled_sum_query = $cancelled_sum_query->where('booking_status',1);
        // }
                       
        if(isset($project_id))
        
        {
            $booking_count_query = $booking_count_query->whereIn('booking.project_id',$project_id);
            $booking_sum_query = $booking_sum_query->whereIn('booking.project_id',$project_id);
            $fully_paid_count_query = $fully_paid_count_query->whereIn('booking.project_id',$project_id);
            $fully_paid_sum_query = $fully_paid_sum_query->whereIn('booking.project_id',$project_id);
            $registered_count_query = $registered_count_query->whereIn('booking.project_id',$project_id);
            $registered_sum_query = $registered_sum_query->whereIn('booking.project_id',$project_id);
            $cancelled_count_query = $cancelled_count_query->whereIn('booking.project_id',$project_id);
            $cancelled_sum_query = $cancelled_sum_query->whereIn('booking.project_id',$project_id);
        }
        
         $booking_count = $booking_count_query->orderby('booking.id','asc')->get()->count();
         $booking_sum = $booking_sum_query->first();
         $fully_paid_count = $fully_paid_count_query->orderby('booking.id','asc')->get()->count();
         $fully_paid_sum = $fully_paid_sum_query->first();
         $registered_count = $registered_count_query->orderby('booking.id','asc')->get()->count();
         $registered_sum = $registered_sum_query->first();
         $cancelled_count = $cancelled_count_query->orderby('booking.id','asc')->get()->count();
         $cancelled_sum = $cancelled_sum_query->first();
         
                             
                             
                              $booking_sqft = $booking_sum->plot_sqft_sum;
                             if($booking_sqft == '')
                             {
                                 $booking_sqft = 0;
                             }
                              $fully_paid_sqft = $fully_paid_sum->plot_sqft_sum;
                             if($fully_paid_sqft == '')
                             {
                                 $fully_paid_sqft = 0;
                             }
                              $registered_sqft = $registered_sum->plot_sqft_sum;
                             if($registered_sqft == '')
                             {
                                 $registered_sqft = 0;
                             }
                              $cancelled_sqft = $cancelled_sum->plot_sqft_sum;
                             if($cancelled_sqft == '')
                             {
                                 $cancelled_sqft = 0;
                             }
                             $total_sqft = 0;
                             $filled_sqft = 0;
                             
                             $total_plot_sqft_get = PlotManagement::where('deleted_at',0)
                        ->select(DB::raw('SUM(plot_sq_ft) as plot_sqft_sum'));
                        if(isset($project_id))
        
                         {
                             $total_plot_sqft_get = $total_plot_sqft_get->whereIn('project_id',$project_id);
                         }
                         
                         $total_plot_sqft = $total_plot_sqft_get->first();
                         
                        if(isset($total_plot_sqft))
                       {
                         $total_sqft = $total_plot_sqft->plot_sqft_sum;
                        }
        
                        $total_booking_sqft_get = Booking::leftjoin('plot_management','plot_management.id','booking.plot_id')
                                   ->whereNull('booking_status')->where('plot_management.deleted_at',0)
                                  ->select(DB::raw('SUM(plot_sq_ft) as plot_sqft_sum'));
                      if(isset($project_id))
                     {
                       $total_booking_sqft_get = $total_booking_sqft_get->whereIn('plot_management.project_id',$project_id);
                     }
                     
                     $total_plot_sqft_get_value = $total_booking_sqft_get->first();
                     
                      if(isset($total_plot_sqft_get_value))
                       {
                         $filled_sqft = $total_plot_sqft_get_value->plot_sqft_sum;
                        }
                         
                      $vacant_sqft = $total_sqft - $filled_sqft;
         
        
                              $plots_get = PlotManagement::where('deleted_at',0);
                              if(isset($project_id))
                              {
                                  $plots_get = $plots_get->whereIn('project_id',$project_id);
                              }
        
                               $plots = $plots_get->get()->count();
                               
                             $total_booking_get = Booking::leftjoin('plot_management','plot_management.id','booking.plot_id')
                                                 ->where('plot_management.deleted_at',0)->whereNull('booking_status');
                             
                             if(isset($project_id))
                              {
                                  $total_booking_get = $total_booking_get->whereIn('booking.project_id',$project_id);
                              }
                              $total_booking = $total_booking_get->get()->count();
         
                             $vacant_plots = $plots - $total_booking;
                             
                             $total_plots_get = $booking_count + $fully_paid_count + $registered_count;
                             $total_sqft_get = $booking_sqft + $fully_paid_sqft + $registered_sqft ;
                               
                              $total_plots = $total_plots_get + $vacant_plots;
                              $total_sqft  = $total_sqft_get + $vacant_sqft;
            
            return view('reports.project_details', compact('query','projects','plots','plot_id','project_id','marketer','team_name',
              'booking_count','fully_paid_count','registered_count','cancelled_count','booking_sqft','vacant_sqft','vacant_plots','fully_paid_sqft','registered_sqft','cancelled_sqft','total_plots','total_sqft'));
        // } catch (\Exception $e) {
        //     return back()->with(['error' => $e->getMessage()])->withInput();
        // }
   
}


   public function siteVisitDetailsList(Request $request)
    {
        // try {
             
            $project_id =  $request->project_id;
             
            $projects = ProjectDetail::all();
            
            $team_name = User::where('user_type','!=','staff')->where('user_type','!=','admin')->where('user_type','!=','gl_admin')->groupby('team_name')->get();
            
            $from_date =  $request->from_date;
            $to_date =  $request->to_date;
            if($from_date == '')
            {
            $from_date = date('Y-m-d');
            }
            if($to_date == '')
            {
             $to_date = date('Y-m-d');
            }
            
            
            $team_id = $request->team;
         
    
      $project = ProjectVisit::leftJoin("project_details as ci",\DB::raw("FIND_IN_SET(ci.id,project_visit.project_id)"),">",\DB::raw("'0'"))
      ->leftjoin('users','users.id','project_visit.marketer_id') 
        ->whereBetween('visit_date',[$from_date,$to_date])
        ->groupBy('project_visit.id') ;
        
        // $project = ProjectVisit::leftJoin("project_details as ci",'ci.id','project_visit.project_id')
        // ->leftjoin('users','users.id','project_visit.marketer_id') 
        // ->whereBetween('visit_date',[$from_date,$to_date]);
        // // ->groupBy('users.id') ;
                       
        if(isset($project_id))
        
        {
            foreach($project_id as $word){
           $project->whereRaw('FIND_IN_SET(?, project_visit.project_id)', [$word]);
         }

           
        }
        
        if(isset($team_id))
        
        {
            $project = $project->whereIn('project_visit.team_name',$team_id);
        }
        
         $query = $project->orderby('project_visit.id','asc')->get([ 'project_visit.*','users.name',  \DB::raw("GROUP_CONCAT(ci.short_name) as company_name") ]);
         
          
            
            return view('reports.site_visit_list', compact('query','team_name','projects'));
        // } catch (\Exception $e) {
        //     return back()->with(['error' => $e->getMessage()])->withInput();
        // }
   
}



  public function projectHistory(Request $request)
    {
        try {
            $plots = '';
            $project_id =  $request->project_id;
            $plot_id =  $request->plot_id;
            $projects = ProjectDetail::all();
            $marketer = User::where('user_type','!=','staff')->where('user_type','!=','admin')->where('user_type','!=','gl_admin')->get();
            if(isset($project_id))
            {
            $plots = PlotManagement::where('project_id',$project_id)->where('deleted_at',0)->get();    
            }
            
            $payments = Payment::leftjoin('project_details','project_details.id','part_payment.project_id')
                       ->leftjoin('plot_management','plot_management.id','part_payment.plot_id')
                       ->leftjoin('booking','booking.plot_id','part_payment.plot_id')
                       ->whereNotNull('booking.booking_status')
                       ->select('part_payment.*','plot_management.plot_no','project_details.short_name','plot_management.plot_sq_ft',DB::raw('SUM(part_payment.amount) as paid_amount')
                       ,DB::raw('SUM(part_payment.discount) as discount_amount'),'booking.receipt_date','booking.cancel_date','booking.marketer_id','booking.id as book_id')
                       ->groupby('part_payment.project_id')->groupby('part_payment.plot_id');
                       
        if(isset($project_id))
        
        {
            $payments = $payments->where('part_payment.project_id',$project_id);
        }
        if(isset($plot_id))
        
        {
            $payments = $payments->where('part_payment.plot_id',$plot_id);
        }
                $query = $payments->orderby('part_payment.booking_id','asc')->get();
            // $payments = $payments->groupBy('part_payment.plot_id');
            return view('reports.project_history', compact('query','projects','plots','plot_id','project_id','marketer'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
   
}



    public function printProjectHistory(Request $request,$id)
    {
        try{
            $id = $id;
          return view('reports.project_history_print', compact('id'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
   
}


     
      public function plotDetails($id)
    {
        $first_booking_date = '';
        $last_booking_date = '';
        $project = ProjectDetail::where('id',$id)->first();
        
        $first_booking = Booking::where('project_id',$id)->orderby('id','asc')->first();
        if(isset($first_booking))
        {
            $first_booking_date = date('d-m-Y',strtotime($first_booking->receipt_date));
        }
        $last_booking = Booking::where('project_id',$id)->orderby('id','desc')->first();
        if(isset($last_booking))
        {
            $last_booking_date = date('d-m-Y',strtotime($last_booking->receipt_date));
        }
         
         
        $project_date = date('d-m-Y',strtotime($project->project_start_date));
        
        
        $startTimeStamp = strtotime($project->project_start_date);
        $endTimeStamp = strtotime(date('Y-m-d'));

           $timeDiff = abs($endTimeStamp - $startTimeStamp);

          $numberDays = $timeDiff/86400;  // 86400 seconds in one day

             $numberDays = intval($numberDays);
 
         
        $plots = PlotManagement::where('project_id',$id)->where('deleted_at',0)->get()->count();
        
        
        $total_booking = Booking::where('project_id',$id)->whereNull('booking_status')->get()->count();
         
        $vacant_plots = $plots - $total_booking;
         
        $booking_count = Booking::whereNull('confirm_status')
                        ->whereNull('register_status')
                        ->whereNull('booking_status')->where('project_id',$id)->get()->count();
        
        $reg_pending_count = Booking::whereNotNull('fully_paid_status')->whereNotNull('confirm_status')
                             ->whereNull('register_status')->where('project_id',$id)->get()->count();
        
        $registered_plots = Booking::whereNotNull('register_status')->where('project_id',$id)->get()->count();
        
        $registered_plots_sqft = Booking::leftjoin('plot_management','plot_management.id','booking.plot_id')
                                ->whereNotNull('register_status')->where('booking.project_id',$id)
                                ->select(DB::raw('SUM(plot_management.plot_sq_ft) as plot_sqft_sum'))->first();
        
        if(isset($registered_plots_sqft))
        {
            $reg_sqft = $registered_plots_sqft->plot_sqft_sum;
        }
        
        $total_plot_sqft = PlotManagement::where('project_id',$id)->where('deleted_at',0)
                        ->select(DB::raw('SUM(plot_sq_ft) as plot_sqft_sum'))->first();
        if(isset($total_plot_sqft))
        {
            $total_sqft = $total_plot_sqft->plot_sqft_sum;
        }
        
        $total_booking_sqft_get = Booking::leftjoin('plot_management','plot_management.id','booking.plot_id')
                                  ->where('booking.project_id',$id)->whereNull('booking_status') 
                                  ->select(DB::raw('SUM(plot_sq_ft) as plot_sqft_sum'))->first();
         if(isset($total_booking_sqft_get))
        {
            $filled_sqft = $total_booking_sqft_get->plot_sqft_sum;
        }
        
        $vacant_sqft = $total_sqft - $filled_sqft;
        
        $booking_sqft_get = Booking::leftjoin('plot_management','plot_management.id','booking.plot_id')
                          ->whereNull('confirm_status')
                         ->whereNull('register_status')
                          ->whereNull('booking_status')->where('booking.project_id',$id)
                         ->select(DB::raw('SUM(plot_sq_ft) as plot_sqft_sum'))->first();
        
        if(isset($booking_sqft_get))
        {
            $booking_sqft = $booking_sqft_get->plot_sqft_sum;
        }else{
            $booking_sqft = 0;
        }
        
        
        $reg_pending_plots = Booking::leftjoin('plot_management','plot_management.id','booking.plot_id')
                              ->whereNotNull('fully_paid_status')->whereNotNull('confirm_status')
                             ->whereNull('register_status')->where('booking.project_id',$id)
                             ->select(DB::raw('SUM(plot_sq_ft) as plot_sqft_sum'))->first();
        if(isset($reg_pending_plots))
        {
            $reg_pending_sqft = $reg_pending_plots->plot_sqft_sum;
        }
        
        
        $bookings =Booking::where('project_id',$id)->whereNull('booking_status')->get();
         $table_data = '';
        if(isset($bookings))
        {
        $plot_rate = 0;
        $total_value = 0;
        $paid_value = 0;
        $discount_value = 0;
        $balance_value = 0;
        $register_date = '';
            $i =1;
            foreach($bookings as $booking)
            {
                
          if(isset($booking->customer_id))
         {
            $customer_id = $booking->customer_id;
           $get_customer_details = Booking::where('id',$booking->customer_id)->first();
           if(isset($get_customer_details))
           {
           $customer_name = $get_customer_details->customer_name;
           $customer_mobile = $get_customer_details->mobile;
           $alternate_mobile = $get_customer_details->alternate_mobile;   
           }
          
        }else{
           $customer_id = $booking->id;
           $customer_name = $booking->customer_name;
           $customer_mobile = $booking->mobile;
           $alternate_mobile = $booking->alternate_mobile;
           
       }
       
       $get_marketer = User::where('id',$booking->marketer_id)->first();  
       if(isset($get_marketer))
       {
           $marketer_name = $get_marketer->name;
           $marketer_id = $get_marketer->reference_code;
       }
       
       $plots_data = PlotManagement::where('project_id',$booking->project_id)
                    ->where('id',$booking->plot_id)->where('deleted_at',0)->first();
                    
       $total_val = Payment::where('project_id',$booking->project_id)->where('plot_id',$booking->plot_id)->select(DB::raw('SUM(amount) as paid_amount'),
       DB::raw('SUM(discount) as discount_amount'))->first();
        
       $balance = Payment::where('project_id',$booking->project_id)->where('plot_id',$booking->plot_id)->select('balance')->orderby('id','desc')->first();
       
       if(isset($booking->register_date))
       {
           $register_date = date('d-m-Y',strtotime($booking->register_date));
       }else{
           $register_date = '';
       }
       
       
       $table_data .= '<tr><td>'.$i.'</td><td>'.$customer_name.'</td><td>'.date('d-m-Y',strtotime($booking->receipt_date)).'</td>
                              <td>'.$marketer_id.'</td><td>'.$marketer_name.'</td><td>'.$plots_data->plot_no.'</td><td>'.$plots_data->plot_sq_ft.'</td>
                              <td>'.$plots_data->market_value_sq_ft.'</td><td>'.IND_money_format(round($plots_data->market_value_plot_rate)).'</td>
                              <td>'.IND_money_format(round($total_val->paid_amount)).'</td><td>'.IND_money_format(round($total_val->discount_amount)).'</td>
                              <td>'.IND_money_format(round($balance->balance)).'</td><td>'.$booking->reg_no.'</td><td>'.$register_date.'</td></tr>
                              ';
                                 
        $plot_rate = $plot_rate + $plots_data->plot_sq_ft;
        $total_value = $total_value + $plots_data->market_value_plot_rate;
        $paid_value = $paid_value + $total_val->paid_amount;
        $discount_value = $discount_value + $total_val->discount_amount;
        $balance_value = $balance_value + $balance->balance;
        
        $i++;
            }
            
        $table_data .= '<tr><td colspan="6"><h5 class="text-center fw-bold text-danger">Total</h5></td><td><span style="font-size:14px" class="text-success">'.$plot_rate.'</span></td><td></td><td><span style="font-size:14px" class="text-success">
        '.IND_money_format(round($total_value)).'</span></td><td><span style="font-size:14px" class="text-success">'.IND_money_format(round($paid_value)).'</span></td><td><span style="font-size:14px" class="text-success">'.IND_money_format(round($discount_value)).'</span></td>
        <td><span style="font-size:14px" class="text-success">'.IND_money_format(round($balance_value)).'</span></td><td colspan="2"></td></tr>';
        }
         
        return response()->json(['status' => true, 'first_booking_date' => $first_booking_date , 
        'last_booking_date' => $last_booking_date,'project' => $project,'plots' => $plots,'booking_count' => $booking_count,'vacant_plots' => $vacant_plots,
        'reg_pending_count'=>$reg_pending_count ,'registered_plots' => $registered_plots,'reg_sqft' => $reg_sqft ,'total_sqft' => $total_sqft,'booking_sqft' => $booking_sqft,
        'reg_pending_sqft' => $reg_pending_sqft,'vacant_sqft' => $vacant_sqft,'table_data' => $table_data,'numberDays' => $numberDays,'project_date' => $project_date], 200);
    }
    

     public function projectSalesList(Request $request)
    {
        try {
            $from_date =  $request->from_date;
            $to_date =  $request->to_date;
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
            
            $project_id = $request->project_id;
            $projects = ProjectDetail::all();
            $query = Booking::leftjoin('project_details', 'project_details.id', 'booking.project_id')
                              ->whereBetween('booking.receipt_date',[$from_date,$to_date])->select('project_details.*')
                             ->groupby('booking.project_id')->select('booking.*','project_details.short_name');
             
             if(isset($project_id))
             {
                 $query = $query->whereIn('booking.project_id',$project_id);
             }
               $bookings = $query->get();              
            return view('reports.project_sales_list', compact('projects','bookings'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    
    
    public function printSalesList(Request $request)
    {
        try {
            
            $project_id = $request->project_id;
            $projects = ProjectDetail::all();
            $query = Booking::leftjoin('project_details', 'project_details.id', 'booking.project_id')->select('project_details.*')
                             ->groupby('booking.project_id')->select('booking.*','project_details.short_name');
             
             if(isset($project_id))
             {
                 $query = $query->where('booking.project_id',$project_id);
             }
               $bookings = $query->get();              
            return view('reports.project_sales_list_print', compact('projects','bookings'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    
     public function marketerStatusReport(Request $request)
    {
        try {
            
            $designation_id = $request->designation_id;
            // $designation = Designation::where('status',1)->get();
            $designation = Designation::whereIn('designation', ['Director', 'Marketing Managers', 'Marketing Supervisor', 'Marketing Executive'])
                            ->where('status',1)->get();
            $query = User::where('user_type','!=','staff')->where('user_type','!=','admin')->where('user_type','!=','gl_admin');
            $from_date =  $request->from_date;
            $status =  $request->status;
            $to_date =  $request->to_date;
            if($from_date == '')
            {
            $from_date = date('Y-m-d');
            }
            if($to_date == '')
            {
             $to_date = date('Y-m-d');
            }
            
            if(isset($designation_id))
            {
               $query->whereIn('designation_id',$designation_id); 
            }
            
            if(isset($status))
            {
                if($status == 1)
                {
                    $query->where('status',1); 
                }
                else if($status == 2)
                {
                    $query->where('status',0); 
                }
               
            }
            
            $projects = Booking::leftjoin('project_details', 'project_details.id', 'booking.project_id')
            ->whereBetween('booking.receipt_date',[$from_date,$to_date])->select('project_details.*');
            
            $marketer = $query->orderby('id','asc')->get();
            return view('reports.marketer_status_report', compact('projects','designation','marketer'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }


   public function cancelled_plot_print(Request $request){ // updated by Gowtham.s
        // try{
        //     if(!empty($request->project_id) && !empty($request->plot_id)){
                $project_id = $request->project_id;
                $id = $request->plot_id;
              return view('reports.cancel_plots_print',compact('project_id','id'));
        //     }
        // } catch (\Exception $e) {
        //     return back()->with(['error' => $e->getMessage()])->withInput();
        // }  
   }
  
}
