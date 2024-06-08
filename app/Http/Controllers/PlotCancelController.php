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
use App\Models\Bank;
use App\Models\PrintTemplateContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
// use Request;

class PlotCancelController extends Controller
{
    public function index(Request $request)
    {
        try {
            $plots = '';
            $project_id =  $request->project_id;
            $plot_id =  $request->plot_id;
            $projects = ProjectDetail::all();
            if(isset($project_id))
            {
            $plots = PlotManagement::where('project_id',$project_id)->where('deleted_at',0)->get();    
            }
            
            $payments = Payment::leftjoin('project_details','project_details.id','part_payment.project_id')
                       ->leftjoin('plot_management','plot_management.id','part_payment.plot_id')
                       ->leftjoin('booking','booking.plot_id','part_payment.plot_id')
                       ->whereNull('booking.register_status')
                       ->whereNull('booking.booking_status')
                       ->select('part_payment.*','plot_management.plot_no','project_details.short_name','plot_management.plot_sq_ft',DB::raw('SUM(part_payment.amount) as paid_amount')
                       ,DB::raw('SUM(part_payment.discount) as discount_amount'))
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
            
            return view('cancel_plots.index', compact('query','projects','plots','plot_id','project_id'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
   
    public function getcancelPlots($id)
    {
         
        // $plots = Booking::leftjoin('plot_management','booking.plot_id','plot_management.id')
        // ->where('plot_management.project_id',$id)->whereNull('booking.register_status')->where('plot_management.deleted_at',0);
        
        // updated By Gowtham.S
        $plots = Booking::leftjoin('plot_management','booking.plot_id','plot_management.id')
        ->where('plot_management.project_id',$id)->whereNull('booking.register_status')->whereNull('booking.booking_status')->where('plot_management.deleted_at',0);
        
        $query = $plots->select('plot_management.id','plot_management.plot_no')->get();
        return response()->json(['status' => true, 'data' => $query], 200);
    }
 
  
   public function booking_list($project_id,$id)
   {
       $booking =Booking::where('project_id',$project_id)->where('plot_id',$id)->first();
       
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
           $customer_mobile = $get_customer_details->mobile;
           $alternate_mobile = $get_customer_details->alternate_mobile;   
           }
          
        }else{
           $customer_id = $booking->id;
           $customer_name = $booking->customer_name;
           $customer_mobile = $booking->mobile;
           $alternate_mobile = $booking->alternate_mobile;
           
       }
       
       $user_details = User::where('users.id',$booking->marketer_id)->first();
                                 
       $marketer = '';
        if(isset($user_details))
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
        
        }
        $paid_amount = Payment::where('project_id',$project_id)->where('plot_id',$id)->select( DB::raw('SUM(amount) as paid_amount'))->first();
        
        if(isset($paid_amount))
        {
            $paid = $paid_amount->paid_amount;
        }else{
            $paid = 0;
        }
        
        $guide_line = 0;
        $project_details = ProjectDetail::where('id',$project_id)->first();
        
        if(isset($project_details))
        {
            $guide_line = $project_details->guide_line;
        }
       
        $payment = '';
        $payments = '';
        $payment_list = Payment::where('project_id',$project_id)->where('plot_id',$id)->get();
        if(isset($payment_list))
        {
            $paymode = '';
            $type = '';
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
                    $type = 'P.P (Part Payment)';
                }else{
                    $type = 'Adv ( Advance)';
                }
                
              
                $payment = '<tr><td>#</td><td>'.$payment->receipt_no.'</td><td>'.date('d-m-Y',strtotime($payment->receipt_date)).'</td>
                              <td>'.$payment->amount.'</td><td>'.$type.'</td>
                              <td>'.$paymode.'</td><td><input type="text" class="form-control" name="narration[]" id="narration"  >
                              <input type="hidden" class="form-control" name="payment_id[]" id="payment_id" value="' . $payment->id . '" ></td></tr>';
                              
                $payments .= $payment;
            }
        }
        
       return response()->json(['status' => true, 'data' => $booking,'marketer' => $marketer,'customer_name' => $customer_name, 'mobile' => $customer_mobile,
       'alternate_mobile' => $alternate_mobile,'payment_history' => $payments ,'customer_id' => $customer_id, 'paid' => $paid ,'guide_line' => $guide_line], 200);
       }
       else{
            return response()->json(['status' => false, 'msg' => 'No Data Found'], 200);
       }
       
   }
   
    public function edit($project_id,$plot_id)
    {
        if (!empty($project_id)) {
            $payment = Payment::where('project_id',$project_id)->where('plot_id',$plot_id)->orderby('id','desc')->first();
            $booking = Booking::where('project_id',$payment->project_id)->where('plot_id',$payment->plot_id)->first();
            $count = User::where('user_type', 'staff')->get()->count();
            $branch = Branch::where('status', 1)->get();
            $customers = Booking::all();
            $projects = ProjectDetail::all();
            $plots = PlotManagement::where('project_id',$booking->project_id)->where('deleted_at',0)->get();
            $banks = Bank::where('status', 1)->get();
            
           $paid_amount = Payment::where('project_id',$payment->project_id)->where('plot_id',$payment->plot_id)->select( DB::raw('SUM(amount) as paid_amount'))->first();
        
        if(isset($paid_amount))
        {
            $paid = $paid_amount->paid_amount;
        }else{
            $paid = 0;
        }
            
            return view('cancel_plots.edit', compact('count','customers' ,'booking', 'branch','projects','payment','plots','paid','banks','paid_amount'));

        
        }
    }
    public function update(Request $request, $project_id,$plot_id)
    {
        // $request->validate([
        //     'cancel_reason' => 'required',
        //  ]);
      
       $paid_amount = Payment::where('project_id',$project_id)->where('plot_id',$plot_id)->select( DB::raw('SUM(amount) as paid_amount'))->first();
        
        if(isset($paid_amount))
        {
            $paid = $paid_amount->paid_amount;
        }else{
            $paid = 0;
        }
        
        
        $account_on = 2;
        $get_gl_no = Account::where('account_on',1)->get()->count();
        if($get_gl_no == 0)
        {
            $gl_ref_no = '001';
        }else{
            $gl_count = $get_gl_no + 1;
            $gl_ref_no = '00'.$gl_count;
        }
        
        $get_mv_no = Account::where('account_on',2)->get()->count();
        if($get_mv_no == 0)
        {
            $mv_ref_no = 'MV-01';
        }else{
            $mv_count = $get_mv_no + 1;
            $mv_ref_no = 'MV-0'.$mv_count;
        }
        
        if($account_on == 1)
        {
            $ref_no = $gl_ref_no;
        }else{
            $ref_no = $mv_ref_no;
        }
        
        
         $get_details = Booking::leftjoin('project_details','project_details.id','booking.project_id')
                       ->leftjoin('plot_management','plot_management.id','booking.plot_id')->where('booking.project_id',$request->project_id)
                       ->where('plot_id',$request->plot_id)
                       ->select('booking.*','plot_management.plot_no','plot_management.plot_sq_ft','project_details.full_name','project_details.short_name')->first();
                       
                       
                    $receipt_nos = '';
                    
                    $get_receipt_nos = Payment::where('project_id',$request->project_id)->where('plot_id',$request->plot_id)->get();
                    if(isset($get_receipt_nos))
                    {
                        foreach($get_receipt_nos as $receipt)
                        {
                            $receipt_nos .= $receipt->receipt_no.',';
                        }
                    }
                    
            $update_cancel = Booking::where('project_id',$project_id)->where('plot_id',$plot_id)->update(['booking_status' => 1,'cancel_reason' => $request->cancel_reason
        ,'cancel_date' => date('Y-m-d')]);
             
               $narrtion = '';        
        if(isset($get_details))
        {
            $project_name = $get_details->full_name;
            $project_short_name = $get_details->short_name;
            $plot_no = $get_details->plot_no;
            $plot_sqft = $get_details->plot_sq_ft;
            $project_id = $get_details->project_id;
            
            $get_director_details = User::leftjoin('users as u','users.id','u.director_id')->where('u.id',$get_details->marketer_id)->select('users.name')->first();
            if(isset($get_director_details))
            {
                $director_name = $get_director_details->name;
            }else{
                $director_name = $request->marketer_name;
            }
            
            $get_customer_name = Booking::where('id',$request->customer_id)->first();
            $customer_name = $get_customer_name->customer_name;
            
            $narrtion = "Project Name : ". $project_name . " - Plot No : " .$plot_no. "- Customer Name : " .$customer_name
            . "- Director Name :  " .$director_name. " - Cancel Purpose :  " .$request->cancel_reason. " - Receipt No's : ".$receipt_nos;
            
            
            $marketer_name = '';
        $marketer_id = '';
        $team = '';
        $get_marketer = User::where('id',$get_details->marketer_id)->first();
        if(isset($get_marketer))
        {
            $marketer_name = $get_marketer->name;
            $marketer_id = $get_marketer->reference_code;
            $team = $get_marketer->team_name;
        }
        
            
             
            $received_date = date('d-m-Y');
      
            $total_cancel = Booking::whereNotNull('booking_status')
                               ->where('project_id',$project_id)->get()->count();
                               
        
           
        
      $message = "Dear $customer_name, For your information, you have cancelled Plot No.: $plot_no,  in project : $project_short_name - Ayngaran Housing and Properties.";
      
      $encode_message = urlencode($message);
      
      $curl = curl_init();
   curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://sms.neophrontech.com/api/smsapi?key=e54f5cac8a06f4137b69f963471df1ba&route=2&sender=AYNHAP&number=9842767231&templateid=1707171092262846417&sms='.$encode_message.'',
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

       
     $message = "Plot Cancellation…... $project_short_name Project, Plot no.:$plot_no, $plot_sqft sq ft. Marketer : $marketer_name ($marketer_id), Team $team on $received_date. Total Cancelled Plots - $total_cancel - Ayngaran Housing and Properties.";
    
    $encode_message = urlencode($message);
      
      
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://sms.neophrontech.com/api/smsapi?key=e54f5cac8a06f4137b69f963471df1ba&route=2&sender=AYNHAP&number=9842767231&templateid=1707171075332593041&sms='.$encode_message.'',
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
        
        
        
        $account = new Account();
        $account->voucher_date = date('y-m-d');
        $account->transaction_no = $ref_no;
        $account->account_on = $account_on;
        $account->transaction_type = 2;
        $account->voucher_type = 1;
        $account->branch = $request->branch;
        $account->main_ledger = 7;
        $account->sub_ledger = 11;
        $account->amount = $paid;
        $account->tds = 0;
        $account->rs = 0;
        $account->pay_mode = 1;
        $account->narration = $narrtion;
        $account->created_by = Auth::user()->id;
        
        $insert = $account->save();
        
       
      
      
        
        if ($insert) {
            return response()->json(['status' => true, 'message' => 'Booking Cancellation Updated Successfully!']);
        } else {
            return response()->json(['status' => false, 'message' => 'Booking Cancellation Updation Failed!']);
        }
        
        
      
    }
    public function delete($id)
    {
        if (!empty($id)) {
            $payment = Payment:: where('id', $id)->delete();
            if ($payment) {
                return response()->json(['status' => true, 'message' => 'Payment Detail Deleted Success!']);
            } else {
                return response()->json(['status' => false, 'message' => 'Payment Detail Deleted Failed!']);
            }
        }
    }
    
    
  
}
