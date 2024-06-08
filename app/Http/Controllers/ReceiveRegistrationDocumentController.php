<?php

namespace App\Http\Controllers;

use App\Models\Branch;
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

class ReceiveRegistrationDocumentController extends Controller
{
    
    public function index(Request $request)
    {
        //  try {
             $plots = '';
            $project_id = $request->project_id;
            $plot_id = $request->plot_id;
            $status = $request->status;
            $branch = Branch::where('status', 1)->get();
            $projects = ProjectDetail::all();
            if(isset($project_id))
            {
            $plots = PlotManagement::leftjoin('booking','plot_management.id','booking.plot_id')
            ->where('booking.project_id',$project_id)->whereNull('booking.booking_status')->whereNotNull('booking.register_status')->get();    
            }
            $users = User::where('user_type','!=','admin')->where('user_type','!=','staff')->where('user_type','!=','gl_admin')->get();
            $payments = Booking::leftjoin('project_details','project_details.id','booking.project_id')
                       ->leftjoin('plot_management','plot_management.id','booking.plot_id')->where('booking.register_status',1)
                       ->whereNull('booking.booking_status')
                       ->select('booking.*','plot_management.plot_no','plot_management.plot_sq_ft','project_details.short_name')
                       ->orderby('booking.doc_receive_status');
                       
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
            $payments = $payments->where('booking.doc_receive_status',$status);
            }else{
             $payments = $payments->whereNull('booking.doc_receive_status');
            }
        }
        
           $query = $payments->get();
            
            return view('receive_registration_document.index', compact('query','branch','projects','users','plots'));
        // } catch (\Exception $e) {
        //     return back()->with(['error' => $e->getMessage()])->withInput();
        // }
        
      
    }
    
    
     public function getMobile($id)
    {
         
        $users = User::where('id',$id)->first();
        
        if(isset($users))
        {
           return response()->json(['status' => true, 'data' => $users], 200);  
        }else{
           return response()->json(['status' => false], 400);
        }
       
    }
    
    
     public function plot_list($id)
    {
        //  $plots = Booking::leftjoin('project_details','project_details.id','booking.project_id')
        //               ->leftjoin('plot_management','plot_management.id','booking.plot_id')->where('booking.register_status',1)->where('booking.project_id',$id)
        //                 ->whereNull('booking.doc_receive_status')->whereNull('booking.booking_status');
        
        $plots = PlotManagement::leftjoin('booking','plot_management.id','booking.plot_id')
            ->where('booking.project_id',$id)->whereNull('booking.booking_status')->where('booking.register_status',1)->whereNotNull('booking.register_status');
                       
        $query = $plots->select('plot_management.id','plot_management.plot_no')->get();
         
        return response()->json(['status' => true, 'data' => $query], 200);
    }
    
    public function updateDocumentReceive(Request $request)
    {
        $validator = $request->validate([
            'doc_collected_date' => 'required',
            'doc_collected_by' => 'required',
            'doc_collected_mobile' => 'required'
        ]);
        $doc_collected_date =$request->doc_collected_date;
        $doc_collected_by =$request->doc_collected_by;
        $doc_collected_mobile = $request->doc_collected_mobile;
       
       if(isset($request->plot_sqft))
       {
           foreach($request->plot_sqft as $k=>$val)
           {
            
              $update_status = Booking::where('id',$val)->update(['doc_receive_status' => 1,'reg_no' => $request->reg_no[$k], 'doc_collected_date' =>  $doc_collected_date,
              'doc_collected_by' => $doc_collected_by,'doc_collected_mobile' => $doc_collected_mobile]);
           }
           
          return response()->json(['status' => true, 'message' => 'Payment Detail Updated Successfully!']);  
       }
      
            
    }
 
}
