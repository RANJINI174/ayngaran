<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Designation;
use App\Models\Director;
use App\Models\MarketingExecutive;
use App\Models\MarketingManager;
use App\Models\MarketingSupervisor;
use App\Models\Pincode;
use App\Models\Booking;
use App\Models\Account;
use App\Models\Bank;
use App\Models\Payment;
use App\Models\ProjectDetail;
use App\Models\PlotManagement;
use App\Models\Relationship;
use App\Models\Staff_Detail;
use App\Models\User;
use App\Models\PrintTemplateContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        try {
             $plots = '';
            $project_id =  $request->project_id;
            $plot_id =  $request->plot_id;
            // $projects = ProjectDetail::all();
            $projects = Booking::leftJoin('project_details', 'booking.project_id', '=', 'project_details.id')
                        ->select('booking.project_id', 'project_details.id', 'project_details.short_name')->distinct()->get();
            if(isset($project_id))
            {
            // $plots = PlotManagement::where('project_id',$project_id)->where('deleted_at',0)->get();   
            $plots = $plots = Booking::leftJoin('plot_management', 'booking.plot_id', '=', 'plot_management.id')->where('booking.project_id', '=', $project_id)
                    ->whereNull('booking.booking_status')->where('plot_management.deleted_at', '=', 0)->select('booking.*', 'plot_management.*')->get();
             
            }

            $bookings = Booking::leftjoin('project_details','project_details.id','booking.project_id')
                       ->leftjoin('plot_management','plot_management.id','booking.plot_id')
                       ->whereNull('booking.booking_status')
                       ->select('booking.*','plot_management.plot_no','project_details.full_name','project_details.short_name');
                       
         if(isset($project_id))
        
        {
            $bookings = $bookings->where('booking.project_id',$project_id);
        }
        if(isset($plot_id))
        
        {
            $bookings = $bookings->where('booking.plot_id',$plot_id);
        }
            $booking = $bookings->orderby('booking.id','asc')->get();
            return view('booking.index', compact('booking','projects','plots','plot_id','project_id'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function create()
    {
        try {
            $count = User::where('user_type', 'staff')->get()->count();
            $branch = Branch::where('status', 1)->get();
            $customers = Booking::where('mobile','!=',null)->get();
            $relations = Relationship::where('status', 1)->get();
            $designation = Designation::where('status', 1)->get();
            $projects = ProjectDetail::all();
            $banks = Bank::where('status', 1)->get();
            $markertes = User::where('user_type','!=','staff')->where('user_type','!=','admin')->where('status',1)->get();
            return view('booking.add', compact('count','customers' , 'branch', 'relations', 'designation','projects','banks','markertes'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    
    public function plot_list($id)
    {
        $booking_list = Booking::where('project_id',$id)->whereNull('booking_status')->select('plot_id')->get()->toArray();
        
        $plots = PlotManagement::where('project_id',$id)->where('deleted_at',0);
        if(!empty($booking_list))
        {
            $plots->whereNotIn('id',$booking_list);
        }
        
        $query = $plots->select('id','plot_no')->get();
        
        $booking_details = ProjectDetail::where('id',$id)->first();
        return response()->json(['status' => true, 'data' => $query, 'booking' => $booking_details], 200);
    }
    
    public function customer_list($id)
    {
        $customer = Booking::where('id',$id)->select('*')->first();
         
        if(isset($customer))
        {
              
            $areas  = Pincode::where('pincode', $customer->pincode)->get();
            $state  = Pincode::select('id', 'state')->where('pincode', $customer->pincode)->groupby('state')->get();
            $city  = Pincode::select('id', 'city')->where('pincode', $customer->pincode)->groupby('city')->get();
            return response()->json(['status' => true, 'data' => $customer,'areas' => $areas , 'state' => $state , 'city' => $city], 200);
        }else{
            return response()->json(['status' => false ], 200);
        }
        
    }
    
    public function marketer_list($id)
    {
        
        $user_details = User::where('users.id',$id)->leftjoin('designation','designation.id','users.designation_id')
                                 ->select('users.*','designation.designation')->first();
        $data = '';
        if(isset($user_details))
        {
        
        if(isset($user_details->director_id))
        {
         $get_director_details = User::where('users.id',$user_details->director_id)->leftjoin('designation','designation.id','users.designation_id')
                                 ->select('users.*','designation.designation')->first();   
        $data = '<tr><td>#</td><td>'.$get_director_details->reference_code.'</td><td>'.$get_director_details->designation.'</td>
                              <td>'.$get_director_details->name.'</td><td>'.$get_director_details->mobile_no.'</td></tr>';
                                 
        }
        if(isset($user_details->marketing_manager_id))
        {
         $get_marketing_manager_details = User::where('users.id',$user_details->marketing_manager_id)->leftjoin('designation','designation.id','users.designation_id')
                                 ->select('users.*','designation.designation')->first();   
        if(isset($get_marketing_manager_details))
        {
        $data .= '<tr><td>#</td><td>'.$get_marketing_manager_details->reference_code.'</td><td>'.$get_marketing_manager_details->designation.'</td>
                              <td>'.$get_marketing_manager_details->name.'</td><td>'.$get_marketing_manager_details->mobile_no.'</td></tr>';    
        }
        
        }
        if(isset($user_details->marketing_supervisor_id))
        {
         $get_marketing_supervisor_details = User::where('users.id',$user_details->marketing_supervisor_id)->leftjoin('designation','designation.id','users.designation_id')
                                 ->select('users.*','designation.designation')->first();   
        if(isset($get_marketing_supervisor_details))
        {
        $data .= '<tr><td>#</td><td>'.$get_marketing_supervisor_details->reference_code.'</td><td>'.$get_marketing_supervisor_details->designation.'</td>
                              <td>'.$get_marketing_supervisor_details->name.'</td><td>'.$get_marketing_supervisor_details->mobile_no.'</td></tr>';    
        }
        }  
        return response()->json(['status' => true, 'data' => $data,'marketer_id' => $user_details->id,'name' => $user_details->name,'mobile' => $user_details->mobile_no,'designation' => $user_details->designation], 200);
             
                                
        }
        return response()->json(['status' => false, 'data' => $data], 200);
        
                  
    }
    
    
       public function get_plot_details($project_id,$plot_id)
    {
        $plots = PlotManagement::where('project_id',$project_id)->where('id',$plot_id)->where('deleted_at',0)->first();
        $project = ProjectDetail::where('id',$project_id)->first();
        return response()->json(['status' => true, 'data' => $plots ,'project' => $project], 200);
    }
  
    
    public function store(Request $request)
    {


        try
        {
            
        $request->validate([
            'project_id' => 'required',
            'plot_id' => 'required',
            // 'sqft_rate' => 'required',
            'plot_size_sqft' => 'required',
            // 'plot_size_cent' => 'required',
            // 'total_value' => 'required',
            // 'payable' => 'required',
            // 'description' => 'required',
            'receipt_date' => 'required',
            'amount' => 'required',
            'pay_mode' => 'required',
            'marketer_code' => 'required',
            'registration_due_date' => 'required',
            'booking_open_date' => 'required',
            'company_scope' => 'required',
            'customer_scope' => 'required',
            'registration_due_days' => 'required',
            'booking_open_days' => 'required',
            'company_scope_days' => 'required',
            'customer_scope_days' => 'required',
            // 'customer_name' => 'required',
            // 'mobile' => 'required',
            // 'payment_term' => 'required',
            // 'loan_company' => 'required',
        ]);
     
        $booking = new Booking();
        $booking->project_id = $request->project_id;
        
        $get_plan = ProjectDetail::where('id',$request->project_id)->first();
        $booking->plot_id = $request->plot_id;
        // $booking->sqft_rate = $request->sqft_rate;
        $booking->plot_size_sqft = $request->plot_size_sqft;
        $booking->plot_size_cent = $request->plot_size_cent;
        $booking->total_value_gl = $request->total_value_gl;
        $booking->total_value_mv = $request->total_value_mv;
        $booking->market_value_sqft = $request->market_sqft_rate;
        $booking->guide_line_sqft = $request->guide_line_sqft_rate;
        $booking->balance = $request->balance;
        $booking->amount = $request->amount;
        $booking->payable = $request->payable;
        $booking->description = $request->description;
        $booking->receipt_date = $request->receipt_date;
        $booking->registration_due_date = $request->registration_due_date;
        $booking->booking_open_date = $request->booking_open_date;
        $booking->company_scope = $request->company_scope;
        $booking->customer_scope = $request->customer_scope;
        $booking->registration_due_days = $request->registration_due_days;
        $booking->booking_open_days = $request->booking_open_days;
        $booking->company_scope_days = $request->company_scope_days;
        $booking->customer_scope_days = $request->customer_scope_days;
        $booking->plan = $request->plan;
        $booking->pay_mode = $request->pay_mode;
        $booking->bank_name = $request->bank_name;
        $booking->bank_branch = $request->bank_branch;
        $booking->account_no = $request->account_no;
        $booking->ifsc_code = $request->ifsc_code;
        $booking->transfer_no = $request->transfer_no;
        $booking->cheque_no = $request->cheque_no;
        $booking->cheque_date = $request->cheque_date;
        $booking->online_trans_no = $request->online_trans_no;
        $booking->online_trans_date = $request->online_trans_date;
        $booking->transfer_date = $request->transfer_date;
        $booking->dd_no = $request->dd_no;
        $booking->dd_date = $request->dd_date;
        $booking->marketer_id = $request->marketer_id;
        $booking->marketer_code = $request->marketer_code;
        $booking->marketer_name = $request->marketer_name;
        $booking->designation = $request->designation;
        $booking->marketer_mobile = $request->marketer_mobile;
        
        if(isset($request->customer_id))
        {
        $booking->customer_id = $request->customer_id;
        }else{
        $booking->title = $request->title;
        $booking->customer_name = $request->customer_name;
        $booking->select = $request->select;
        $booking->relation_name = $request->relation_name;
        $booking->dob = $request->dob;
        $booking->gender = $request->gender;
        $booking->email = $request->email;
        $booking->mobile = $request->mobile;
        $booking->alternate_mobile = $request->alternate_mobile;
        $booking->street = $request->street;
        $booking->pincode = $request->pincode;
        $booking->area = $request->area;
        $booking->city = $request->city_id;
        $booking->state = $request->state_id;
        $booking->country = $request->country_id; 
        }
        
       
        $booking->payment_term = 1;
        $booking->loan_company = $request->loan_company;
        $booking->created_by = Auth::user()->id;
        $booking->created_at = date('Y-m-d H:i:s');

        $book =  $booking->save();
        
       
        
        if(isset($booking->customer_id))
        {
            $customer_id = $booking->customer_id;
        }else{
            $customer_id = $booking->id;
        }
       
       
        // $count = Payment::where('id','!=','0')->get()->count();
        // if ($count == 0)
        // {
        //     $receipt_no = 'REC - 001';
        // }else{
        //      $val = $count + 1;
        //     $receipt_no = 'REC - 00'. $val;
        // }
        
        $amount_towards = 1;
        
         $get_gl = Payment::where('amount_towards',2)->get()->count();
        if($get_gl == 0)
        {
            $gl_no = '001';
        }else{
            $gl_count = $get_gl + 1;
            $gl_no = '00'.$gl_count;
        }
        
        $get_mv = Payment::where('amount_towards',1)->get()->count();
        if($get_mv == 0)
        {
            $mv_no = 'MV-01';
        }else{
            $mv_count = $get_mv + 1;
            $mv_no = 'MV-0'.$mv_count;
        }
        
        if($amount_towards == 1)
        {
            $receipt_no = $mv_no;
        }else{
            $receipt_no = $gl_no;
        }
        
        
        $payment = new Payment();
        $payment->receipt_no = $receipt_no;
        $payment->booking_id = $booking->id;
        $payment->project_id = $request->project_id;
        $payment->plot_id = $request->plot_id;
        $payment->receipt_date = $request->receipt_date;
        $payment->amount = $request->amount;
        $payment->pay_mode = $request->pay_mode;
        $payment->payment_term = 1;
        $payment->bank_name = $request->bank_name;
        $payment->bank_branch = $request->bank_branch;
        $payment->account_no = $request->account_no;
        $payment->ifsc_code = $request->ifsc_code;
        $payment->transfer_no = $request->transfer_no;
        $payment->cheque_no = $request->cheque_no;
        $payment->cheque_date = $request->cheque_date;
        $payment->online_trans_no = $request->online_trans_no;
        $payment->online_trans_date = $request->online_trans_date;
        $payment->transfer_date = $request->transfer_date;
        $payment->dd_no = $request->dd_no;
        $payment->dd_date = $request->dd_date;
        $payment->customer_id = $customer_id;
        $payment->gl_rate = $request->guide_line_sqft_rate;
        $payment->gl_balance = $request->total_value_gl;
        $payment->balance = $request->balance;
        $payment->paid = $request->amount;
        $payment->account_type = 2;
        $payment->created_by = Auth::user()->id;
        $payment->created_at = date('Y-m-d H:i:s');
       
       $insert =  $payment->save();
       
       
       
        $get_gl_no = Account::where('account_on',1)->whereNull('is_suspense')->get()->count();
        if($get_gl_no == 0)
        {
            $gl_ref_no = '001';
        }else{
            $gl_count = $get_gl_no + 1;
            $gl_ref_no = '00'.$gl_count;
        }
        
        $get_mv_no = Account::where('account_on',2)->whereNull('is_suspense')->get()->count();
        if($get_mv_no == 0)
        {
            $mv_ref_no = 'MV-01';
        }else{
            $mv_count = $get_mv_no + 1;
            $mv_ref_no = 'MV-0'.$mv_count;
        }
       
    //   if($request->amount_towards == 1)
    //     {
            $ref_no = $mv_ref_no;
        // }else{
        //     $ref_no = $gl_ref_no;
        // }
        
       
        
        $get_details = Booking::leftjoin('project_details','project_details.id','booking.project_id')
                       ->leftjoin('plot_management','plot_management.id','booking.plot_id')->where('booking.project_id',$request->project_id)
                       ->where('plot_id',$request->plot_id)
                       ->select('booking.*','plot_management.plot_no','project_details.full_name')->first();
               $narrtion = '';        
        if(isset($get_details))
        {
            $project_name = $get_details->full_name;
            $plot_no = $get_details->plot_no;
            
            $get_director_details = User::leftjoin('users as u','users.id','u.director_id')->where('u.id',$get_details->marketer_id)->select('users.name')->first();
            if(isset($get_director_details))
            {
                $director_name = $get_director_details->name;
            }else{
                $director_name = $request->marketer_name;
            }
            
             if(isset($request->customer_id))
            {
            $get_customer_name = Booking::where('id',$request->customer_id)->first();
            $customer_name = $get_customer_name->customer_name;  
            }else{
            $get_customer_name = Booking::where('id',$booking->id)->first();
            $customer_name = $get_customer_name->customer_name;
            }
            
            $narrtion = "Project Name : ". $project_name . " - Plot No : " .$plot_no. "- Customer Name : " .$customer_name
            . "- Director Name :  " .$director_name. "- Receipt No :  " .$receipt_no;
        }
        
             
        $account = new Account();
        $account->booking_id = $booking->id;
        $account->project_id = $request->project_id;
        $account->plot_id = $request->plot_id;
        $account->account_on = 2;
        $account->voucher_date = $request->receipt_date;
        $account->transaction_no = $ref_no;
        $account->transaction_type = 1;
        $account->voucher_type = 1;
        $account->branch = 2;
        $account->account_for = $request->account_for;
        $account->main_ledger = 3;
        $account->sub_ledger = 2;
        $account->amount = $request->amount;
        $account->tds = 0;
        $account->rs = 0;
        $account->pay_mode = $request->pay_mode;
        $account->narration = $narrtion;
        $account->bank_name = $request->bank_name;
        $account->bank_branch = $request->bank_branch;
        $account->account_no = $request->account_no;
        $account->ifsc_code = $request->ifsc_code;
        $account->transfer_no = $request->transfer_no;
        $account->cheque_no = $request->cheque_no;
        $account->cheque_date = $request->cheque_date;
        $account->online_trans_date = $request->online_trans_date;
        $account->transfer_date = $request->transfer_date;
        $account->dd_no = $request->dd_no;
        $account->dd_date = $request->dd_date;
        $account->online_trans_no = $request->online_trans_no;
        $account->created_by = Auth::user()->id;
        $account->created_at = date('Y-m-d H:i:s');
        
        $insert = $account->save();
        
        $get_customer = Booking::where('id',$customer_id)->first();
        $customer_name = $get_customer->customer_name;
        $customer_mobile = $get_customer->mobile;
        
        $project_details = ProjectDetail::where('id',$request->project_id)->first();
        $project_name = $project_details->short_name;
        $project_id = $project_details->id;
        
        
        $plots = PlotManagement::where('id',$request->plot_id)->first();
        $plot_name = $plots->plot_no;
        $plot_sqft = $plots->plot_sq_ft;
        
        $received_date = date('d-m-Y',strtotime($request->receipt_date));
        
        $marketer_name = '';
        $marketer_id = '';
        $team = '';
        $get_marketer = User::where('id',$request->marketer_id)->first();
        if(isset($get_marketer))
        {
            $marketer_name = $get_marketer->name;
            $marketer_id = $get_marketer->reference_code;
            $team = $get_marketer->team_name;
        }
        
        
        $plots = PlotManagement::where('deleted_at',0)->where('project_id',$project_id)->get()->count();
        
        $total_booking = Booking::whereNull('booking_status')->where('project_id',$project_id)
                               ->where('marketer_id',$request->marketer_id)->get()->count();
       
       
         $message = "Dear $customer_name, Welcome to Ayngaran. Thank you for your Plot Booking in $project_name Project, Plot no.: $plot_name, $plot_sqft sq ft. Advance amount Rs.$request->amount received on $received_date. - Ayngaran Housing and Properties.";
      
         $encode_message = urlencode($message);
       
        $curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://sms.neophrontech.com/api/smsapi?key=e54f5cac8a06f4137b69f963471df1ba&route=2&sender=AYNHAP&number='.$customer_mobile.'&templateid=1707171084705397706&sms='.$encode_message.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: ci_session=sgrigscfpotkhv5id4g745nr0rrm4rkm'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

  $markertes = User::where('user_type','!=','staff')->where('user_type','!=','admin')->where('user_type','!=','gl_admin')->where('status',1)->get();
  
  if(isset($markertes))
  {
      foreach($markertes as $marketer)
      {
          
          $message = "Dear $marketer->name, Plot Booking….... $project_name Project, Plot no.: $plot_name, $plot_sqft sq ft. Advance amount Rs.$request->amount received from $marketer_name ($marketer_id), Team $team on $received_date, Total Plots - $total_booking - Ayngaran Housing and Properties.";       
       
          $encode_message = urlencode($message);
       
    $curl = curl_init();
   curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://sms.neophrontech.com/api/smsapi?key=e54f5cac8a06f4137b69f963471df1ba&route=2&sender=AYNHAP&number='.$marketer->mobile_no.'&templateid=1707171075313909501&sms='.$encode_message.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: ci_session=sgrigscfpotkhv5id4g745nr0rrm4rkm'
  ),
));

$response = curl_exec($curl);

curl_close($curl);  
      }
      
   
  }
  
          $message_1 = "Dear ESWARAN KM, Plot Booking….... $project_name Project, Plot no.: $plot_name, $plot_sqft sq ft. Advance amount Rs.$request->amount received from $marketer_name ($marketer_id), Team $team on $received_date, Total Plots - $total_booking - Ayngaran Housing and Properties.";       
       
          $encode_message_1 = urlencode($message_1);
          
          $message_2 = "Dear PANDIAN M, Plot Booking….... $project_name Project, Plot no.: $plot_name, $plot_sqft sq ft. Advance amount Rs.$request->amount received from $marketer_name ($marketer_id), Team $team on $received_date, Total Plots - $total_booking - Ayngaran Housing and Properties.";       
       
          $encode_message_2 = urlencode($message_2);
          
     $curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://sms.neophrontech.com/api/smsapi?key=e54f5cac8a06f4137b69f963471df1ba&route=2&sender=AYNHAP&number=9842767231&templateid=1707171075313909501&sms='.$encode_message_1.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: ci_session=sgrigscfpotkhv5id4g745nr0rrm4rkm'
   ),
  ));

$response = curl_exec($curl);

curl_close($curl);

       $curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://sms.neophrontech.com/api/smsapi?key=e54f5cac8a06f4137b69f963471df1ba&route=2&sender=AYNHAP&number=9655598888&templateid=1707171075313909501&sms='.$encode_message_2.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: ci_session=sgrigscfpotkhv5id4g745nr0rrm4rkm'
   ),
  ));

$response = curl_exec($curl);

curl_close($curl);

    
        if ($insert) {
            return response()->json(['status' => true, 'message' => 'Booking Detail Saved Successfully!']);
        } else {
            return response()->json(['status' => false, 'message' => 'Booking Detail Creation Failed!']);
        }
        
       } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        if (!empty($id)) {
            $booking = Booking::where('id',$id)->first();
            $customers = Booking::where('mobile','!=',null)->where('id','!=',$id)->get();
            $count = User::where('user_type', 'staff')->get()->count();
            $project_details = ProjectDetail::where('id',$booking->project_id)->first();
            $branch = Branch::where('status', 1)->get();
            $relations = Relationship::where('status', 1)->get();
            $designation = Designation::where('status', 1)->get();
            $projects = ProjectDetail::all();
            $plots = PlotManagement::where('project_id',$booking->project_id)->get();
            $areas  = Pincode::where('pincode', $booking->pincode)->get();
            $state  = Pincode::select('id', 'state')->where('pincode', $booking->pincode)->first();
            $city  = Pincode::select('id', 'city')->where('pincode', $booking->pincode)->first();
            $banks = Bank::where('status', 1)->get();
            $markertes = User::where('user_type','!=','staff')->where('user_type','!=','admin')->where('status',1)->get();
            return view('booking.edit', compact('count','customers', 'areas','project_details', 'state', 'city', 'branch', 'relations', 'designation','projects','booking',
            'plots','banks','markertes'));

        
        }
    }
    public function update(Request $request, $id)
    {
        
        try
        {
            $request->validate([
            'project_id' => 'required',
            'plot_id' => 'required',
            // 'sqft_rate' => 'required',
            'plot_size_sqft' => 'required',
            // 'plot_size_cent' => 'required',
            // 'total_value' => 'required',
            // 'payable' => 'required',
            // 'description' => 'required',
            'receipt_date' => 'required',
            'registration_due_date' => 'required',
            'booking_open_date' => 'required',
            'company_scope' => 'required',
            'customer_scope' => 'required',
            'registration_due_days' => 'required',
            'booking_open_days' => 'required',
            'company_scope_days' => 'required',
            'customer_scope_days' => 'required',
            'amount' => 'required',
            'pay_mode' => 'required',
            'marketer_code' => 'required',
            // 'customer_name' => 'required',
            // 'mobile' => 'required',
            // 'payment_term' => 'required',
            // 'loan_company' => 'required',
        ]);
        
        $booking = [];
        $get_plan = ProjectDetail::where('id',$request->project_id)->first();
        
       
        $booking['project_id'] = $request->project_id;
        $booking['plot_id'] = $request->plot_id;
        $booking['plan'] = $request->plan;
       
        // $booking['sqft_rate'] = $request->sqft_rate;
        $booking['plot_size_sqft'] = $request->plot_size_sqft;
        $booking['plot_size_cent'] = $request->plot_size_cent;
        $booking['total_value_gl'] = $request->total_value_gl;
        $booking['total_value_mv'] = $request->total_value_mv;
        $booking['market_value_sqft'] = $request->market_sqft_rate;
        $booking['guide_line_sqft'] = $request->guide_line_sqft_rate;
        $booking['balance'] = $request->balance;
        $booking['amount'] = $request->amount;
        $booking['payable'] = $request->payable;
        $booking['description'] = $request->description;
        $booking['receipt_date'] = $request->receipt_date;
        $booking['registration_due_date'] = $request->registration_due_date;
        $booking['booking_open_date'] = $request->booking_open_date;
        $booking['company_scope'] = $request->company_scope;
        $booking['customer_scope'] = $request->customer_scope;
        $booking['registration_due_days'] = $request->registration_due_days;
        $booking['booking_open_days'] = $request->booking_open_days;
        $booking['company_scope_days'] = $request->company_scope_days;
        $booking['customer_scope_days'] = $request->customer_scope_days;
        $booking['pay_mode'] = $request->pay_mode;
        
       
       
       if($request->pay_mode == 1)
        {
        $booking['cheque_no'] = null;
        $booking['cheque_date'] = null;
        $booking['online_trans_no'] = null;
        $booking['online_trans_date'] =  null;
        $booking['transfer_no'] =  null;;
        $booking['transfer_date'] =  null;
        $booking['dd_no'] =  null;
        $booking['dd_date'] =  null;  
        $booking['bank_name'] = null;  
        $booking['bank_branch'] = null;  
        $booking['account_no'] = null;  
        $booking['ifsc_code'] = null;  
        }
        
        if($request->pay_mode == 2)
        {
        $booking['cheque_no'] = $request->cheque_no;
        $booking['cheque_date'] = $request->cheque_date;
        $booking['online_trans_no'] = null;
        $booking['online_trans_date'] = null;
        $booking['transfer_no'] = null;
        $booking['transfer_date'] = null;
        $booking['dd_no'] = null;
        $booking['dd_date'] = null;
        $booking['bank_name'] = $request->bank_name;
        $booking['bank_branch'] = $request->bank_branch;
        $booking['account_no'] = $request->account_no;
        $booking['ifsc_code'] = $request->ifsc_code;
        }
        if($request->pay_mode == 4)
        {
        $booking['cheque_no'] = null;
        $booking['cheque_date'] = null;
        $booking['online_trans_no'] = $request->online_trans_no;
        $booking['online_trans_date'] = $request->online_trans_date;
        $booking['transfer_no'] = null;
        $booking['transfer_date'] = null;
        $booking['dd_no'] = null;
        $booking['dd_date'] = null; 
        $booking['bank_name'] = $request->bank_name;
        $booking['bank_branch'] = $request->bank_branch;
        $booking['account_no'] = $request->account_no;
        $booking['ifsc_code'] = $request->ifsc_code;
        }
        
        if($request->pay_mode == 5)
        {
        $booking['cheque_no'] = null;
        $booking['cheque_date'] = null;
        $booking['online_trans_no'] = null;
        $booking['online_trans_date'] = null;
        $booking['transfer_no'] = $request->transfer_no;
        $booking['transfer_date'] = $request->transfer_date;
        $booking['dd_no'] = null;
        $booking['dd_date'] = null;
        $booking['bank_name'] = $request->bank_name;
        $booking['bank_branch'] = $request->bank_branch;
        $booking['account_no'] = $request->account_no;
        $booking['ifsc_code'] = $request->ifsc_code;
        }
        
         if($request->pay_mode == 3)
        {
        $booking['cheque_no'] = null;
        $booking['cheque_date'] = null;
        $booking['online_trans_no'] = null;
        $booking['online_trans_date'] = null;
        $booking['transfer_no'] = null;
        $booking['transfer_date'] = null;
        $booking['dd_no'] = $request->dd_no;
        $booking['dd_date'] = $request->dd_date;   
        $booking['bank_name'] = $request->bank_name;
        $booking['bank_branch'] = $request->bank_branch;
        $booking['account_no'] = $request->account_no;
        $booking['ifsc_code'] = $request->ifsc_code;
        
            
        }
        $booking['marketer_id'] = $request->marketer_id;
        $booking['marketer_code'] = $request->marketer_code;
        $booking['marketer_name'] = $request->marketer_name;
        $booking['designation'] = $request->designation;
        $booking['marketer_mobile'] = $request->marketer_mobile;
        
        if(isset($request->customer_id))
        {
         $booking['customer_id'] = $request->customer_id;
        }else{
        $booking['title'] = $request->title;
        $booking['customer_name'] = $request->customer_name;
        $booking['select'] = $request->select;
        $booking['relation_name'] = $request->relation_name;
        $booking['dob'] = $request->dob;
        $booking['gender'] = $request->gender;
        $booking['email'] = $request->email;
        $booking['mobile'] = $request->mobile;
        $booking['alternate_mobile'] = $request->alternate_mobile;
        $booking['street'] = $request->street;
        $booking['pincode'] = $request->pincode;
        $booking['area'] = $request->area;
        $booking['city'] = $request->city_id;
        $booking['state'] = $request->state_id;
        $booking['country'] = $request->country_id;
        }
        $booking['payment_term'] = 1;
        $booking['loan_company'] = $request->loan_company;
        $booking['updated_by'] = Auth::user()->id;
        $booking['updated_at'] = date('Y-m-d H:i:s');
        
    
        $update = Booking::where('id', $id)->update($booking);
        
        if(isset($request->customer_id))
        {
            $customer_id = $request->customer_id;
        }else{
            $customer_id = $id;
        }
        
        
        $payment = [];
        
        $payment['project_id'] = $request->project_id;
        $payment['plot_id'] = $request->plot_id;
        $payment['receipt_date'] = $request->receipt_date;
        $payment['amount'] = $request->amount;
        $payment['pay_mode'] = $request->pay_mode;
        
       
       
        if($request->pay_mode == 1)
        {
        $payment['cheque_no'] = null;
        $payment['cheque_date'] = null;
        $payment['online_trans_no'] = null;
        $payment['online_trans_date'] =  null;
        $payment['transfer_no'] =  null;;
        $payment['transfer_date'] =  null;
        $payment['dd_no'] =  null;
        $payment['dd_date'] =  null; 
        $payment['bank_name'] = null; 
        $payment['bank_branch'] = null; 
        $payment['account_no'] = null; 
        $payment['ifsc_code'] = null; 
        }
        if($request->pay_mode == 2)
        {
        $payment['cheque_no'] = $request->cheque_no;
        $payment['cheque_date'] = $request->cheque_date;
        $payment['online_trans_no'] = null;
        $payment['online_trans_date'] =  null;
        $payment['transfer_no'] =  null;;
        $payment['transfer_date'] =  null;
        $payment['dd_no'] =  null;
        $payment['dd_date'] =  null;
        $payment['bank_name'] = $request->bank_name;
        $payment['bank_branch'] = $request->bank_branch;
        $payment['account_no'] = $request->account_no;
        $payment['ifsc_code'] = $request->ifsc_code;
        }
        if($request->pay_mode == 4)
        {
        $payment['cheque_no'] = null;
        $payment['cheque_date'] =  null;
        $payment['online_trans_no'] = $request->online_trans_no;
        $payment['online_trans_date'] = $request->online_trans_date;
        $payment['transfer_no'] = null;
        $payment['transfer_date'] =  null;
        $payment['dd_no'] =  null;
        $payment['dd_date'] =  null;
        $payment['bank_name'] = $request->bank_name;
        $payment['bank_branch'] = $request->bank_branch;
        $payment['account_no'] = $request->account_no;
        $payment['ifsc_code'] = $request->ifsc_code;
        }
        
        if($request->pay_mode == 5)
        {
        $payment['cheque_no'] =  null;
        $payment['cheque_date'] =  null;
        $payment['online_trans_no'] =  null;
        $payment['online_trans_date'] = null;
        $payment['transfer_no'] = $request->transfer_no;
        $payment['transfer_date'] = $request->transfer_date;
        $payment['dd_no'] =  null;
        $payment['dd_date'] =  null;
        $payment['bank_name'] = $request->bank_name;
        $payment['bank_branch'] = $request->bank_branch;
        $payment['account_no'] = $request->account_no;
        $payment['ifsc_code'] = $request->ifsc_code;
        }
        
        if($request->pay_mode == 3)
        {
          $payment['cheque_no'] =  null;
        $payment['cheque_date'] =  null;
        $payment['online_trans_no'] =  null;
        $payment['online_trans_date'] =  null;
        $payment['transfer_no'] =  null;
        $payment['transfer_date'] =  null;
        $payment['dd_no'] = $request->dd_no;
        $payment['dd_date'] = $request->dd_date;    
        $payment['bank_name'] = $request->bank_name;
        $payment['bank_branch'] = $request->bank_branch;
        $payment['account_no'] = $request->account_no;
        $payment['ifsc_code'] = $request->ifsc_code;
            
        }
        
        $payment['payment_term'] = 1;
        $payment['account_type'] = 2;
        $payment['customer_id'] = $customer_id;
        $payment['gl_rate'] = $request->guide_line_sqft_rate;
        $payment['gl_balance'] = $request->total_value_gl;
        $payment['paid'] = $request->amount;
        $payment['balance'] = $request->balance;
        $payment['updated_by'] = Auth::user()->id;
        $payment['updated_at'] = date('Y-m-d H:i:s');
    
        $update = Payment::where('booking_id',$id)->update($payment);
        
         $get_details = Booking::leftjoin('project_details','project_details.id','booking.project_id')
                       ->leftjoin('plot_management','plot_management.id','booking.plot_id')->where('booking.project_id',$request->project_id)
                       ->where('plot_id',$request->plot_id)
                       ->select('booking.*','plot_management.plot_no','project_details.full_name')->first();
               $narrtion = '';        
        if(isset($get_details))
        {
            $project_name = $get_details->full_name;
            $plot_no = $get_details->plot_no;
            
            $get_director_details = User::leftjoin('users as u','users.id','u.director_id')->where('u.id',$get_details->marketer_id)->select('users.name')->first();
            if(isset($get_director_details))
            {
                $director_name = $get_director_details->name;
            }else{
                $director_name = $request->marketer_name;
            }
            
            if(isset($request->customer_id))
            {
              $get_customer_name = Booking::where('id',$request->customer_id)->first();
            $customer_name = $get_customer_name->customer_name;  
            }else{
                $get_customer_name = Booking::where('id',$id)->first();
            $customer_name = $get_customer_name->customer_name;
            }
            
            
            // $narrtion = "Project Name : ". $project_name . " - Plot No : " .$plot_no. "- Customer Name : " .$customer_name
            // . "- Director No :  " .$director_name. "- Receipt No :  " .$receipt_no;;
        }
        
        
        $account = [];
        $account['voucher_date'] = $request->receipt_date;
        $account['transaction_type'] = 1;
        $account['voucher_type'] = 1;
        $account['branch'] = 2;
        $account['account_for'] = $request->account_for;
        $account['main_ledger'] = 3;
        $account['sub_ledger'] = 2;
        $account['amount'] = $request->amount;
        $account['project_id'] = $request->project_id;
        $account['plot_id'] = $request->plot_id;
        $account['pay_mode'] = $request->pay_mode;
        
        
        if($request->pay_mode == 1)
        {
        $account['cheque_no'] = null;
        $account['cheque_date'] = null;
        $account['online_trans_no'] = null;
        $account['online_trans_date'] =  null;
        $account['transfer_no'] =  null;;
        $account['transfer_date'] =  null;
        $account['dd_no'] =  null;
        $account['dd_date'] =  null; 
        $account['bank_name'] = null; 
        $account['bank_branch'] = null; 
        $account['account_no'] = null; 
        $account['ifsc_code'] = null; 
        }
        if($request->pay_mode == 2)
        {
        $account['cheque_no'] = $request->cheque_no;
        $account['cheque_date'] = $request->cheque_date;
        $account['online_trans_no'] = null;
        $account['online_trans_date'] =  null;
        $account['transfer_no'] =  null;;
        $account['transfer_date'] =  null;
        $account['dd_no'] =  null;
        $account['dd_date'] =  null;
        $account['bank_name'] = $request->bank_name;
        $account['bank_branch'] = $request->bank_branch;
        $account['account_no'] = $request->account_no;
        $account['ifsc_code'] = $request->ifsc_code;
        }
        if($request->pay_mode == 4)
        {
        $account['cheque_no'] = null;
        $account['cheque_date'] =  null;
        $account['online_trans_no'] = $request->online_trans_no;
        $account['online_trans_date'] = $request->online_trans_date;
        $account['transfer_no'] = null;
        $account['transfer_date'] =  null;
        $account['dd_no'] =  null;
        $account['dd_date'] =  null;
        $account['bank_name'] = $request->bank_name;
        $account['bank_branch'] = $request->bank_branch;
        $account['account_no'] = $request->account_no;
        $account['ifsc_code'] = $request->ifsc_code;
        }
        
        if($request->pay_mode == 5)
        {
        $account['cheque_no'] =  null;
        $account['cheque_date'] =  null;
        $account['online_trans_no'] =  null;
        $account['online_trans_date'] = null;
        $account['transfer_no'] = $request->transfer_no;
        $account['transfer_date'] = $request->transfer_date;
        $account['dd_no'] =  null;
        $account['dd_date'] =  null;
        $account['bank_name'] = $request->bank_name;
        $account['bank_branch'] = $request->bank_branch;
        $account['account_no'] = $request->account_no;
        $account['ifsc_code'] = $request->ifsc_code;
        }
        
        if($request->pay_mode == 3)
        {
        $account['cheque_no'] =  null;
        $account['cheque_date'] =  null;
        $account['online_trans_no'] =  null;
        $account['online_trans_date'] =  null;
        $account['transfer_no'] =  null;
        $account['transfer_date'] =  null;
        $account['dd_no'] = $request->dd_no;
        $account['dd_date'] = $request->dd_date;    
        $account['bank_name'] = $request->bank_name;
        $account['bank_branch'] = $request->bank_branch;
        $account['account_no'] = $request->account_no;
        $account['ifsc_code'] = $request->ifsc_code;
            
        }
        
        // $account['narration'] = $narrtion;
        $account['updated_by'] = Auth::user()->id;
        $account['updated_at'] = date('Y-m-d H:i:s');
        
         $update = Account::where('booking_id',$id)->update($account);
        
        if ($update) {
            return response()->json(['status' => true, 'message' => 'Booking Detail Updated Successfully!']);
        } else {
            return response()->json(['status' => false, 'message' => 'Booking Detail Updation Failed!']);
        }
        
    } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function delete($id)
    {
        if (!empty($id)) {
            
            $get_booking_data = Booking:: where('id', $id)->first();
            
            $project_id = $get_booking_data->project_id;
            $plot_id = $get_booking_data->plot_id;
             
            $pay_delete = Payment::where('project_id', $project_id)->where('plot_id',$plot_id)->delete();
            
            $account_delete = Account::where('project_id', $project_id)->where('plot_id',$plot_id)->delete();
            
            $booking = Booking:: where('id', $id)->delete();
            
            
            if ($booking) {
                return response()->json(['status' => true, 'message' => 'Booking Detail Deleted Success!']);
            } else {
                return response()->json(['status' => false, 'message' => 'Booking Detail Deleted Failed!']);
            }
        }
    }
    
    public function print($id)
    {
        $booking = Booking::leftjoin('project_details','project_details.id','booking.project_id')
                       ->leftjoin('plot_management','plot_management.id','booking.plot_id')->where('booking.id',$id)
                       ->select('booking.*','plot_management.plot_no','plot_management.plot_sq_ft','project_details.short_name','project_details.landmark'
                       ,'plot_management.market_value_sq_ft','plot_management.market_value_plot_rate','project_details.template_id')->first();
                       
           $area = '';
           $city = '';
           $state = '';
        if(isset($booking->customer_id))
       {
            $customer_id = $booking->customer_id;
           $get_customer_details = Booking::where('id',$booking->customer_id)->first();
           if(isset($get_customer_details))
           {
           $customer_name = $get_customer_details->customer_name;
           $street = $get_customer_details->street;
           $pincode = $get_customer_details->pincode;
           
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
          
        }else{
           $customer_id = $booking->id;
           $customer_name = $booking->customer_name;
           $street = $booking->street;
           $pincode = $booking->pincode;
           
           $get_area = Pincode::where('id',$booking->area)->first();
           if(isset($get_area))
           {
           $area = $get_area->area;
           $city = $get_area->city;
           $state = $get_area->state;
           }
           $customer_mobile = $booking->mobile;
           $alternate_mobile = $booking->alternate_mobile;
           
       }
       
       $payment = Payment::where('booking_id',$booking->id)->first();
       
       
       $marketer_details = User::where('id',$booking->marketer_id)->first();
       
       
       $director_details = User::where('id',$marketer_details->director_id)->first();
          
            return view('booking.print', compact('booking','payment','customer_name','customer_mobile','street','pincode','area','city','state','alternate_mobile','marketer_details','director_details'));
    }
    
    
     public function excel($id)
    {
        $booking = Booking::leftjoin('project_details','project_details.id','booking.project_id')
                       ->leftjoin('plot_management','plot_management.id','booking.plot_id')->where('booking.id',$id)
                       ->select('booking.*','plot_management.plot_no','plot_management.plot_sq_ft','project_details.short_name','project_details.landmark'
                       ,'plot_management.market_value_sq_ft','plot_management.market_value_plot_rate','project_details.template_id')->first();
                       
           $area = '';
           $city = '';
           $state = '';
        if(isset($booking->customer_id))
       {
            $customer_id = $booking->customer_id;
           $get_customer_details = Booking::where('id',$booking->customer_id)->first();
           if(isset($get_customer_details))
           {
           $customer_name = $get_customer_details->customer_name;
           $street = $get_customer_details->street;
           $pincode = $get_customer_details->pincode;
           
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
          
        }else{
           $customer_id = $booking->id;
           $customer_name = $booking->customer_name;
           $street = $booking->street;
           $pincode = $booking->pincode;
           
           $get_area = Pincode::where('id',$booking->area)->first();
           if(isset($get_area))
           {
           $area = $get_area->area;
           $city = $get_area->city;
           $state = $get_area->state;
           }
           $customer_mobile = $booking->mobile;
           $alternate_mobile = $booking->alternate_mobile;
           
       }
       
       $payment = Payment::where('booking_id',$booking->id)->first();
       
       
       $marketer_details = User::where('id',$booking->marketer_id)->first();
       
       
       $director_details = User::where('id',$marketer_details->director_id)->first();
          
            return view('booking.excel', compact('booking','payment','customer_name','customer_mobile','street','pincode','area','city','state','alternate_mobile','marketer_details','director_details'));
    }
    
    
}


