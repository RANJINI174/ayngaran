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
use DB;

class FullypaidController extends Controller
{
    public function index(Request $request)
    {
        try {
            $plots = '';
            $new_status = '';
            $project_id = $request->project_id;
            $plot_id = $request->plot_id;
            $new_status = $request->status;
            $status = $request->status;
            
             
            $projects = ProjectDetail::all();
            if(isset($project_id))
            {
            $plots = PlotManagement::where('project_id',$project_id)->get();    
            }
            
            $payments = Booking::leftjoin('project_details','project_details.id','booking.project_id')
                       ->leftjoin('plot_management','plot_management.id','booking.plot_id')
                       ->leftjoin('part_payment','part_payment.plot_id','booking.plot_id')->where('part_payment.balance',0)
                       ->whereNull('booking.booking_status')
                       ->select('booking.*','plot_management.plot_no','plot_management.plot_sq_ft','project_details.short_name','project_details.reg_expense')
                       ->orderby('booking.fully_paid_status');
                       
            if(isset($project_id))
        
        {
            $payments = $payments->where('booking.project_id',$project_id);
        }
        if(isset($plot_id))
        
        {
            $payments = $payments->where('booking.plot_id',$plot_id);
        }
        
        if(isset($status))
        
        { 
            if($status == 1)
            {
            $payments = $payments->where('booking.fully_paid_status',$status);
            }else{
             $payments = $payments->whereNull('booking.fully_paid_status');
            }
        }
                $query = $payments->get();
            
            return view('fullypaid.index', compact('query','projects','plots','status','new_status'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    
    
    public function fullypaid_plot_list($id)
    {
        $plots = Booking::leftjoin('project_details','project_details.id','booking.project_id')
                       ->leftjoin('plot_management','plot_management.id','booking.plot_id')
                       ->leftjoin('part_payment','part_payment.plot_id','booking.plot_id')
                       ->where('booking.project_id',$id)
                       ->where('part_payment.balance',0)->whereNull('booking.fully_paid_status')
                        ;
        
        $query = $plots->select('plot_management.id','plot_management.plot_no')->get();
         
        return response()->json(['status' => true, 'data' => $query], 200);
    }
    
    public function update_register(Request $request)
    {
        
      
       if(isset($request->plot_sqft))
       {
           foreach($request->plot_sqft as $k=>$val)
           {
              $update_status = Booking::where('id',$val)->update(['fully_paid_status' => 1,'registration_process' => null ]);
           }
           
          return response()->json(['status' => true, 'message' => 'Payment Detail Updated Successfully!']);  
       }
      
            
    }
    
    public function update(Request $request,$id,$narration)
    {
        $payment_id = $id;
        
        
      
        $update_status = Booking::where('id',$payment_id)->update(['registration_process' => $narration ]);
        if($update_status)
        {
          return response()->json(['status' => true, 'message' => 'Updated Successfully!']);  
      }else{
          return response()->json(['status' => false, 'message' => 'Updation Failed!']);   
      }
      
            
    }
   
    
}
