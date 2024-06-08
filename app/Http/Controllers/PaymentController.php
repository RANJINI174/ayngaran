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

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        try {
            $plots = '';
            $project_id =  $request->project_id;
            $plot_id =  $request->plot_id;
            $projects = Booking::leftJoin('project_details', 'booking.project_id', '=', 'project_details.id')
                        ->select('booking.project_id', 'project_details.id', 'project_details.short_name')->distinct()->get();
            if(isset($project_id))
            {
            // $plots = PlotManagement::where('project_id',$project_id)->where('deleted_at',0)->get();   
            $plots = Booking::leftJoin('plot_management', 'booking.plot_id', '=', 'plot_management.id')->where('booking.project_id', '=', $project_id)
                    ->whereNull('booking.booking_status')->where('plot_management.deleted_at', '=', 0)->select('booking.*', 'plot_management.*')->get();
            }
            
            $payments = Payment::leftjoin('project_details','project_details.id','part_payment.project_id')
                       ->leftjoin('plot_management','plot_management.id','part_payment.plot_id')
                       ->leftjoin('booking','booking.plot_id','part_payment.plot_id')
                       ->whereNull('booking.booking_status')
                       ->select('part_payment.*','plot_management.plot_no','project_details.short_name','plot_management.plot_sq_ft',
                       DB::raw('SUM(part_payment.amount) as paid_amount')
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
            return view('payment.index', compact('query','projects','plots','plot_id','project_id'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function create()
    {
        try {
            $count = User::where('user_type', 'staff')->get()->count();
            $branch = Branch::where('status', 1)->get();
            $customers = Booking::all();
            $relations = Relationship::where('status', 1)->get();
            $designation = Designation::where('status', 1)->get();
            $projects = ProjectDetail::all();
            $banks = Bank::where('status', 1)->get();
            return view('payment.add', compact('count','customers' , 'branch', 'relations', 'designation','projects','banks'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    
    public function plot_list($id)
    {
         
        // $plots = PlotManagement::where('project_id',$id)->where('deleted_at',0);
        $plots = Booking::join('plot_management', 'booking.plot_id', '=', 'plot_management.id')->whereNull('booking.booking_status')
                 ->where('plot_management.deleted_at', 0)->where('booking.project_id', $id);
        
        $query = $plots->select('plot_management.id','plot_management.plot_no')->get();
        return response()->json(['status' => true, 'data' => $query], 200);
    }
    
    
     public function paymode_list($id)
    {
         
        // $plots = PlotManagement::where('project_id',$id)->where('deleted_at',0);
        $plots = DB::table('pay_modes')->where('id','!=',0);
        if($id == 1)
        {
          $plots = $plots->whereIn('id',array(1,2,3,4,5));  
        }else if($id == 2)
        {
            $plots = $plots->whereIn('id',array(2,3,4));  
        }
        
        $query = $plots->select('id','name')->get();
        return response()->json(['status' => true, 'data' => $query], 200);
    }
    
      public function allpaymode_list()
    {
         
        // $plots = PlotManagement::where('project_id',$id)->where('deleted_at',0);
        $plots = DB::table('pay_modes')->where('id','!=',0);
       
        $query = $plots->select('id','name')->get();
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
    
    public function store(Request $request)
    {
     try{

 
        $request->validate([
            'project_id' => 'required',
            'plot_id' => 'required',
            'gl_rate' => 'required',
            // 'gl_balance' => 'required',
            // 'paid' => 'required',
            'receipt_date' => 'required',
            'amount' => 'required',
            'pay_mode' => 'required',
            'account_type' => 'required',
             
        ]);
        
        $count = Payment::where('id','!=','0')->get()->count();
        if ($count == 0)
        {
            $receipt_no = 'REC - 001';
        }else{
            $val = $count + 1;
            $receipt_no = 'REC - 00'. $val;
        }
        
        if(isset($request->narration) && $request->narration == !'')
       {
        
           foreach($request->narration as $k=>$v)
           {
               
             $update_narration = Payment::where('id',$request['payment_id'][$k])->update(['narration' => $v]);
             
           }
       }
       
      
      
        $payment = new Payment();
        $payment->receipt_no = $receipt_no;
        $payment->project_id = $request->project_id;
        $payment->plot_id = $request->plot_id;
        $payment->receipt_date = $request->receipt_date;
        $payment->amount = $request->amount;
        $payment->pay_mode = $request->pay_mode;
        $payment->fully_paid = $request->fully_paid;
        $payment->bank_name = $request->bank_name;
        $payment->bank_branch = $request->bank_branch;
        $payment->account_no = $request->account_no;
        $payment->ifsc_code = $request->ifsc_code;
        $payment->transfer_no = $request->transfer_no;
        $payment->cheque_no = $request->cheque_no;
        $payment->cheque_date = $request->cheque_date;
        $payment->online_trans_no = $request->online_trans_no;
        $payment->amount_towards = $request->amount_towards;
        $payment->online_trans_date = $request->online_trans_date;
        $payment->transfer_date = $request->transfer_date;
        $payment->dd_no = $request->dd_no;
        $payment->dd_date = $request->dd_date;
        $payment->customer_id = $request->customer_id;
        $payment->gl_rate = $request->gl_rate;
        $payment->gl_balance = $request->gl_balance;
        $payment->account_type = $request->account_type;
        $payment->paid = $request->paid;
        $payment->discount = $request->discount;
        $payment->balance = $request->balance;
        $payment->created_by = Auth::user()->id;
       
       $insert =  $payment->save();
       
       
        if ($insert) {
            return response()->json(['status' => true, 'message' => 'Payment Detail Saved Successfully!']);
        } else {
            return response()->json(['status' => false, 'message' => 'Payment Detail Creation Failed!']);
        }
        
     } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
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
            
            return view('payment.edit', compact('count','customers' ,'booking', 'branch','projects','payment','plots','paid','banks','paid_amount'));

        
        }
    }
    public function update(Request $request, $id)
    {
   
   try{
  
        if(isset($request->payment_id) && $request->payment_id == !'')
       {
             
          foreach($request->payment_id as $k=>$v)
          {
             $check_fully_paid = Payment::where('project_id',$request->project_id)->where('id',$request['payment_id'][$k])->where('plot_id',$request->plot_id)
                ->first();
              if(!isset($request['booking_id'][$k]))
             {
            $paid_amount = Payment::where('project_id',$request->project_id)->where('plot_id',$request->plot_id)->where('id','<',$request['payment_id'][$k])
                            ->select('amount', DB::raw('SUM(gl_balance) as gl_balance'),'booking_id', DB::raw('SUM(balance) as balance'),
                             DB::raw('SUM(paid) as paid_amount'))->groupby('id')->orderby('id','desc')->first(); 
                             
            //  if(!isset($paid_amount->booking_id))
            //  {
               if($request['pay_towards'][$k] == 1)
             {
                 $new_amount =  $request['pay_amount'][$k];
                 $new_paid = $paid_amount->paid_amount + $request['pay_amount'][$k] + $request['discount_value'][$k];
                 $new_balance = $paid_amount->balance -  $request['pay_amount'][$k] - $request['discount_value'][$k];
                 $new_gl_balance = $paid_amount->gl_balance; 
                 
             }else{
                 $new_amount = $request['pay_amount'][$k];
                 $new_paid = $paid_amount->paid_amount + $request['pay_amount'][$k] + $request['discount_value'][$k];
                 $new_balance = $paid_amount->balance - $request['pay_amount'][$k] - $request['discount_value'][$k];
                 $new_gl_balance = $paid_amount->gl_balance - $request['pay_amount'][$k] - $request['discount_value'][$k];
             }  
             
             $narration = $request['narration'][$k];
             if($new_balance == 0)
             {
                 $fully_paid =  1;
                 $narration = "Fully Paid";
             }else{
                 $fully_paid = null;
                 $narration = $request['narration'][$k];
             }
             
             
                $update_narration = Payment::where('id',$request['payment_id'][$k])->update(['narration' => $narration,
                'discount' => $request['discount_value'][$k],'payment_term' => $request['payment_source'][$k],'amount'=>$new_amount,'paid' => $new_paid,
             'gl_balance' => $new_gl_balance,'balance' => $new_balance,'fully_paid' => $fully_paid,'amount_towards' => $request['pay_towards'][$k]]);
             
                
            //  }   
             }
            
             
            
          }
       }
       
      if(isset($request->fully_paid))
      {
           
    $request->validate([
            'project_id' => 'required',
            'plot_id' => 'required',
            'gl_rate' => 'required',
            // 'gl_balance' => 'required',
            // 'paid' => 'required',
            'receipt_date' => 'required',
            'amount' => 'required',
            'pay_mode' => 'required',
            'account_type' => 'required'
             
        ]);
           
          $total_gl = $request->total_value_gl - $request->gl_amount;
          if($total_gl != 0)
      {
        //   $count = Payment::where('id','!=','0')->get()->count();
        // if ($count == 0)
        // {
        //     $receipt_no = 'REC - 001';
        // }else{
        //     $val = $count + 1;
        //     $receipt_no = 'REC - 00'. $val;
        // }
        
        
        $amount_towards = 2;
        
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
        
        
         $total_mv = $request->total_value_mv - $request->mv_amount - $total_gl;
        
        
        $payment = new Payment();
        $payment->receipt_no = $receipt_no;
        $payment->project_id = $request->project_id;
        $payment->plot_id = $request->plot_id;
        $payment->receipt_date = $request->receipt_date;
        $payment->amount = $total_gl;
        $payment->pay_mode = $request->pay_mode;
        $payment->payment_term = $request->payment_term;
        $payment->bank_name = $request->bank_name;
        $payment->bank_branch = $request->bank_branch;
        $payment->account_no = $request->account_no;
        $payment->ifsc_code = $request->ifsc_code;
        $payment->transfer_no = $request->transfer_no;
        $payment->cheque_no = $request->cheque_no;
        $payment->cheque_date = $request->cheque_date;
        $payment->fully_paid = $request->fully_paid;
        $payment->online_trans_no = $request->online_trans_no;
        $payment->amount_towards = 2;
        $payment->online_trans_date = $request->online_trans_date;
        $payment->transfer_date = $request->transfer_date;
        $payment->dd_no = $request->dd_no;
        $payment->dd_date = $request->dd_date;
        $payment->customer_id = $request->customer_id;
        $payment->gl_rate = $request->gl_rate;
        $payment->gl_balance = 0;
        $payment->account_type = $request->account_type;
        $payment->paid = $request->paid + $total_gl;
        // $payment->discount = $request->discount;
        $payment->balance = $total_mv;
        $payment->created_by = Auth::user()->id;
       
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
        
        $amount_towards = 2;
       
      if($amount_towards == 1)
        {
            $ref_no = $mv_ref_no;
        }else{
            $ref_no = $gl_ref_no;
        }
        
       
        
        $get_details = Booking::leftjoin('project_details','project_details.id','booking.project_id')
                       ->leftjoin('plot_management','plot_management.id','booking.plot_id')->where('booking.project_id',$request->project_id)
                       ->where('plot_id',$request->plot_id)
                       ->select('booking.*','plot_management.plot_no','plot_management.plot_sq_ft','project_details.full_name')->first();
               $narrtion = '';        
        if(isset($get_details))
        {
            $project_name = $get_details->full_name;
            $plot_no = $get_details->plot_no;
            $plot_sqft = $get_details->plot_sq_ft;
            
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
            . "- Director Name :  " .$director_name. "- Receipt No :  " .$receipt_no;
        }
        
             
        $account = new Account();
        $account->voucher_date = $request->receipt_date;
        $account->transaction_no = $ref_no;
        $account->project_id = $request->project_id;
        $account->plot_id = $request->plot_id;
        $account->account_on = 1;
        $account->transaction_type = 1;
        $account->voucher_type = 1;
        $account->branch = 2;
        $account->account_for = $request->account_for;
        $account->main_ledger = 3;
        $account->sub_ledger = 5;
        $account->amount = $total_gl;
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
        
        $insert = $account->save();
        
         
        
      }
       $total_mv = $request->total_value_mv - $request->mv_amount - $total_gl;
      if(isset($payment->balance))
      {
          $paid = $payment->paid + $total_mv;
      }else{
          $paid = $request->paid + $total_mv + $request->discount;
      }
      if($total_mv != 0)
      {
        //   $count = Payment::where('id','!=','0')->get()->count();
        // if ($count == 0)
        // {
        //     $receipt_no = 'REC - 001';
        // }else{
        //     $val = $count + 1;
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
        $payment->project_id = $request->project_id;
        $payment->plot_id = $request->plot_id;
        $payment->receipt_date = $request->receipt_date;
        $payment->amount = $total_mv - $request->discount;
        $payment->pay_mode = $request->pay_mode;
        $payment->payment_term = $request->payment_term;
        $payment->bank_name = $request->bank_name;
        $payment->bank_branch = $request->bank_branch;
        $payment->account_no = $request->account_no;
        $payment->ifsc_code = $request->ifsc_code;
        $payment->transfer_no = $request->transfer_no;
        $payment->cheque_no = $request->cheque_no;
        $payment->cheque_date = $request->cheque_date;
        $payment->fully_paid = $request->fully_paid;
        $payment->online_trans_no = $request->online_trans_no;
        $payment->amount_towards = 1;
        $payment->online_trans_date = $request->online_trans_date;
        $payment->transfer_date = $request->transfer_date;
        $payment->dd_no = $request->dd_no;
        $payment->dd_date = $request->dd_date;
        $payment->customer_id = $request->customer_id;
        $payment->gl_rate = $request->gl_rate;
        $payment->gl_balance = 0;
        $payment->account_type =1;
        $payment->paid = $paid;
        $payment->discount = $request->discount;
        $payment->balance = 0;
        $payment->created_by = Auth::user()->id;
       
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
       $amount_towards = 1;
      if($amount_towards == 1)
        {
            $ref_no = $mv_ref_no;
        }else{
            $ref_no = $gl_ref_no;
        }
        
       
        
        $get_details = Booking::leftjoin('project_details','project_details.id','booking.project_id')
                       ->leftjoin('plot_management','plot_management.id','booking.plot_id')->where('booking.project_id',$request->project_id)
                       ->where('plot_id',$request->plot_id)
                       ->select('booking.*','plot_management.plot_no','plot_management.plot_sq_ft','project_details.full_name','project_details.short_name')->first();
               $narrtion = ''; 
               $marketer_name = '';
               $marketer_id = '';
               $team = '';
        if(isset($get_details))
        {
            $project_name = $get_details->full_name;
            $project_short_name = $get_details->short_name;
            $plot_no = $get_details->plot_no;
            $plot_sqft = $get_details->plot_sq_ft;
            
            $get_marketer = User::where('id',$get_details->marketer_id)->first();
        if(isset($get_marketer))
        {
            $marketer_name = $get_marketer->name;
            $marketer_id = $get_marketer->reference_code;
            $team = $get_marketer->team_name;
        }
        
        
            
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
            . "- Director Name :  " .$director_name. "- Receipt No :  " .$receipt_no;
        }
        
             
        $account = new Account();
        $account->voucher_date = $request->receipt_date;
        $account->transaction_no = $ref_no;
        $account->project_id = $request->project_id;
        $account->plot_id = $request->plot_id;
        $account->account_on = 2;
        $account->transaction_type = 1;
        $account->voucher_type = 1;
        $account->branch = 2;
        $account->account_for = $request->account_for;
        $account->main_ledger = 3;
        $account->sub_ledger = 5;
        $account->amount = $total_mv - $request->discount;
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
        
        $insert = $account->save();
        
      }
       
    $total_amount = $total_gl + $total_mv - $request->discount;
    
    $recived_date = date('d-m-Y',strtotime($request->receipt_date));
       
        
     $message = "Part Payment - $project_short_name Project, Plot no.: $plot_no, $plot_sqft sq ft. Amount Rs.$total_amount received from $marketer_name ($marketer_id), Team $team on $recived_date. - Ayngaran Housing and Properties.";
  
    $encode_message = urlencode($message);
      
      
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://sms.neophrontech.com/api/smsapi?key=e54f5cac8a06f4137b69f963471df1ba&route=2&sender=AYNHAP&number=9842767231%2C9655598888&templateid=1707171075376649792&sms='.$encode_message.'',
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

       
       
      }else{
          
         if(isset($request->amount))
      {
          $request->validate([
            'project_id' => 'required',
            'plot_id' => 'required',
            'gl_rate' => 'required',
            // 'gl_balance' => 'required',
            // 'paid' => 'required',
            'receipt_date' => 'required',
            'amount' => 'required',
            'pay_mode' => 'required',
            'account_type' => 'required'
             
        ]);
        //   $count = Payment::where('id','!=','0')->get()->count();
        // if ($count == 0)
        // {
        //     $receipt_no = 'REC - 001';
        // }else{
        //     $val = $count + 1;
        //     $receipt_no = 'REC - 00'. $val;
        // }
        
        
        $amount_towards = $request->amount_towards;
        
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
        $payment->project_id = $request->project_id;
        $payment->plot_id = $request->plot_id;
        $payment->receipt_date = $request->receipt_date;
        $payment->amount = $request->amount;
        $payment->pay_mode = $request->pay_mode;
        $payment->payment_term = $request->payment_term;
        $payment->bank_name = $request->bank_name;
        $payment->bank_branch = $request->bank_branch;
        $payment->account_no = $request->account_no;
        $payment->ifsc_code = $request->ifsc_code;
        $payment->transfer_no = $request->transfer_no;
        $payment->cheque_no = $request->cheque_no;
        $payment->cheque_date = $request->cheque_date;
        $payment->fully_paid = $request->fully_paid;
        $payment->online_trans_no = $request->online_trans_no;
        $payment->amount_towards = $request->amount_towards;
        $payment->online_trans_date = $request->online_trans_date;
        $payment->transfer_date = $request->transfer_date;
        $payment->dd_no = $request->dd_no;
        $payment->dd_date = $request->dd_date;
        $payment->customer_id = $request->customer_id;
        $payment->gl_rate = $request->gl_rate;
        $payment->gl_balance = $request->gl_balance;
        $payment->account_type = $request->account_type;
        $payment->paid = $request->paid + $request->amount + $request->discount;
        $payment->discount = $request->discount;
        $payment->balance = $request->balance;
        $payment->created_by = Auth::user()->id;
       
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
       
      if($request->amount_towards == 1)
        {
            $ref_no = $mv_ref_no;
            $account_on = 2;
        }else{
            $ref_no = $gl_ref_no;
            $account_on = 1;
        }
        
       
        
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
            
            
            $get_customer_name = Booking::where('id',$request->customer_id)->first();
            $customer_name = $get_customer_name->customer_name;
            
            $narrtion = "Project Name : ". $project_name . " - Plot No : " .$plot_no. "- Customer Name : " .$customer_name
            . "- Director Name :  " .$director_name. "- Receipt No :  " .$receipt_no;
        }
        
             
        $account = new Account();
        $account->voucher_date = $request->receipt_date;
        $account->transaction_no = $ref_no;
        $account->project_id = $request->project_id;
        $account->plot_id = $request->plot_id;
        $account->account_on = $account_on;
        $account->transaction_type = 1;
        $account->voucher_type = 1;
        $account->branch = 2;
        $account->account_for = $request->account_for;
        $account->main_ledger = 3;
        $account->sub_ledger = 5;
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
        
        $insert = $account->save();
        
        
        $get_user_details = Booking::leftjoin('project_details','project_details.id','booking.project_id')
                       ->leftjoin('plot_management','plot_management.id','booking.plot_id')->where('booking.project_id',$request->project_id)
                       ->where('plot_id',$request->plot_id)
                       ->select('booking.*','plot_management.plot_no','plot_management.plot_sq_ft','project_details.full_name','project_details.short_name')->first();
               $narrtion = '';        
        if(isset($get_user_details))
        {
            $project_name = $get_user_details->short_name;
            $plot_no = $get_user_details->plot_no;
            $plot_sqft = $get_user_details->plot_sq_ft;
            $total_amount = $request->amount;
            
            
        $marketer_name = '';
        $marketer_id = '';
        $team = '';
        $get_marketer = User::where('id',$get_user_details->marketer_id)->first();
        if(isset($get_marketer))
        {
            $marketer_name = $get_marketer->name;
            $marketer_id = $get_marketer->reference_code;
            $team = $get_marketer->team_name;
        }
        
    
        $recived_date = date('d-m-Y',strtotime($request->receipt_date));
       
       
    //   $message = "Part Payment…... $project_name Project, Plot no.: $plot_no, sq ft. $plot_sqft. Amount Rs.$total_amount received from $marketer_name ($marketer_id), Team $team on $recived_date. - Ayngaran Housing and Properties.";
      $message = "Part Payment - $project_name Project, Plot no.: $plot_no, $plot_sqft sq ft. Amount Rs.$total_amount received from $marketer_name ($marketer_id), Team $team on $recived_date. - Ayngaran Housing and Properties.";
   
      $encode_message = urlencode($message);
      
      
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://sms.neophrontech.com/api/smsapi?key=e54f5cac8a06f4137b69f963471df1ba&route=2&sender=AYNHAP&number=9842767231%2C9655598888&templateid=1707171075376649792&sms='.$encode_message.'',
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
      }
   
         return response()->json(['status' => true, 'message' => 'Payment Detail Updated Successfully!']);  
   
       
    } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
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
    
    
    public function print($id,$project_id,$plot_id)
    {
        $booking = Booking::leftjoin('project_details','project_details.id','booking.project_id')
                       ->leftjoin('plot_management','plot_management.id','booking.plot_id')->where('booking.project_id',$project_id)->where('booking.plot_id',$plot_id)
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
       
       $payments = Payment::where('id','<=',$id)->where('project_id',$project_id)->where('plot_id',$plot_id)->get();
       
       
       $single_pay = Payment::where('id','=',$id)->first();
       
       $marketer_details = User::where('id',$booking->marketer_id)->first();
       
       
       $director_details = User::where('id',$marketer_details->director_id)->first();
       
        $paid_amount = Payment::where('project_id',$project_id)->where('plot_id',$plot_id)->select( DB::raw('SUM(amount) as paid_amount'))->first();
       
       return view('payment.print_receipt', compact('booking','payments','customer_name','paid_amount','street','pincode','area','city','state','customer_mobile','alternate_mobile','marketer_details','director_details','single_pay'));
    }
    
    
    public function list($project_id,$plot_id)
   {
      
       
        $payment = '';
        $payments = '';
        $payment_history = Payment::where('project_id',$project_id)->where('plot_id',$plot_id);
        
        $payment_history = $payment_history->get();
        if(isset($payment_history))
        {
            // $paymode = '';
            // $type = '';
            // foreach($payment_list as $payment)
            // {
            //     if($payment->pay_mode == 1)
            //     {
            //         $paymode = 'Cash';
            //     }
            //      if($payment->pay_mode == 2)
            //     {
            //         $paymode = 'Cheque';
            //     }
            //      if($payment->pay_mode == 3)
            //     {
            //         $paymode = 'DD';
            //     }
            //      if($payment->pay_mode == 4)
            //     {
            //         $paymode = 'Online Transfer';
            //     }
            //      if($payment->pay_mode == 5)
            //     {
            //         $paymode = 'Cash Deposite';
            //     }
                
                
            //      if($payment->account_type == 1)
            //     {
            //         $type = 'P.P (Part Payment)';
            //     }else{
            //         $type = 'Adv ( Advance)';
            //     }
                
            //      if($payment->amount_towards == 1)
            //     {
            //         $amount_towards = 'MV';
            //     }else{
            //         $amount_towards = 'gl';
            //     }
                
               
            //      $url = url('/')."/part_payment/$payment->id/$payment->project_id/$payment->plot_id/print";
                 
                
            //     $payment = '<tr><td>#</td><td>'.$payment->receipt_no.'</td><td>'.date('d-m-Y',strtotime($payment->receipt_date)).'</td>
            //                   <td>'.$payment->amount.'</td><td>'.$type.'</td>
            //                   <td>'.$paymode.'</td><td>'.$amount_towards.'</td><td>'.$payment->narration.'</td>
            //                   <td><a class="btn-info border-0 me-1 btnprn"
            //                                     href='.$url.'
            //                                     style="padding: 4px;width:45px ; border-radius:5px;">
            //                                     <i  class="fa fa-print" data-bs-toggle="tooltip" title="Print"></i> 
            //                                 </a></tr>';
                              
            //     $payments .= $payment;
            // }
        
        
        return view('payment.customer_bill_print', compact('payment_history'));
       }
       else{
            return response()->json(['status' => false, 'msg' => 'No Data Found'], 200);
       }
       
   }
   
    public function customer_bill(Request $request)
    {
        // try {
            $plots = '';
            $project_id =  $request->project_id;
            $plot_id =  $request->plot_id;
            $projects = ProjectDetail::all();
            if(isset($project_id))
            {
            $plots = PlotManagement::where('project_id',$project_id)->get();    
            }
            
            $payments = Payment::leftjoin('project_details','project_details.id','part_payment.project_id')
                    ->leftjoin('booking','booking.plot_id','part_payment.plot_id')
                       ->whereNull('booking.booking_status')
                       ->leftjoin('plot_management','plot_management.id','part_payment.plot_id');
                       
        if(isset($project_id))
        
        {
            $payments = $payments->where('part_payment.project_id',$project_id);
        }
        if(isset($plot_id))
        
        {
            $payments = $payments->where('part_payment.plot_id',$plot_id);
        }
        
        if(Auth::user()->designation_id == 11)
        {
            $payments = $payments->where('amount_towards',2);
        }
        
                $query = $payments->select('part_payment.*','project_details.short_name','plot_management.plot_no')->get();
            // $payments = $payments->groupBy('part_payment.plot_id');
            return view('payment.customer_bill', compact('query','projects','plots','plot_id','project_id'));
        // } catch (\Exception $e) {
        //     return back()->with(['error' => $e->getMessage()])->withInput();
        // }
    }
    
}
