<?php

namespace App\Http\Controllers;
use App\Models\ProjectDetail;
use App\Models\PlotManagement;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class LegalBookIssueController extends Controller
{
     public function index(Request $request)
    {
        try {
             $projects = ProjectDetail::all();
             return view('legal_book_issue.index',compact('projects'));
              
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }  
    
    public function plot_list($id)
    {
         
        $plots = PlotManagement::leftjoin('booking','booking.plot_id','plot_management.id')->where('plot_management.project_id',$id)
        ->where('booking.doc_issue_status',1)->whereNull('booking.legal_issue_status');
        
        $query = $plots->select('plot_management.id','plot_management.plot_no')->get();
        return response()->json(['status' => true, 'data' => $query], 200);
    }
    
    public function plotdetails($project_id,$id)
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
       $register_date = '';
       if(isset($booking->register_date))
       {
          $register_date = date('d-m-Y',strtotime($booking->register_date)); 
       }
       
       $collected_date = date('d-m-Y',strtotime($booking->doc_collected_date));
       $user_name = '';
       $get_collected_by = User::where('id',$booking->doc_collected_by)->first();
       if(isset($get_collected_by))
       {
           $user_name = $get_collected_by->name;
       }
       
       
       $projects = ProjectDetail::where('id',$project_id)->first();
       
       $reg_expense = $projects->reg_expense;
       if($reg_expense == 1)
       {
           $expense_by = "Company";
       }
       else if($reg_expense == 2)
       {
          $expense_by = "Customer"; 
       }
      
       
       
       return response()->json(['status' => true, 'data' => $booking, 'customer_name' => $customer_name, 'mobile' => $customer_mobile,
       'alternate_mobile' => $alternate_mobile, 'customer_id' => $customer_id,'collected_by' => $user_name,'expense_by' => $expense_by ,'register_date' => $register_date,
       'collected_date' => $collected_date], 200);
       }
       else{
            return response()->json(['status' => false, 'msg' => 'No Data Found'], 400);
       }
       
   }
   
   public function updateLegalBook(Request $request)
   {
        $validator = $request->validate([
            'project_id' => 'required',
            'plot_id' => 'required'
        ]);
        
       $project_id = $request->project_id;
       $plot_id = $request->plot_id;
       $issued_to_name = $request->issue_to_name;
       $issued_to_mobile = $request->issue_to_mobile_no;

        $update_status = Booking::where('project_id', $project_id)->where('plot_id', $plot_id)->update([
            'legal_issue_status' => 1,
            'issued_to_name' => $issued_to_name,
            'issued_to_mobile' => $issued_to_mobile
        ]);
        
       if($update_status)
       {
           return response()->json(['status' => true, 'msg' => 'Legal Book Issue Status Updated'], 200);
       }else{
           return response()->json(['status' => false, 'msg' => 'Legal Book Issue Status Updation Failed'], 400);
       }
   }
    
}
