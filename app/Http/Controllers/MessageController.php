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

class MessageController extends Controller
{
    public function index(Request $request)
    {
      try {
            $designations  = Designation::where('status', 1)->get();
            
            return view('message.index', compact('designations'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
  
   
    public function send(Request $request)
    {
         $request->validate([
            'message_date' => 'required',
            'message_for' => 'required',
            'message' => 'required',
            
             
        ]);
        
        
        if($request->message_for == '1707170961591981365')
        {
            $markertess = User::where('status',1)->where('id','!=',1);
            
            if(isset($request->message_to))
            {
               $markertess->whereIn('designation_id',$request->message_to); 
            }
            
            $markertes = $markertess->get();
     
     if(isset($markertes))
     {
      foreach($markertes as $marketer)
      {
          
                $date1 = date('d-m-Y',strtotime($request->message_date));
                $date2 = date('d-m-Y',strtotime($request->message_date_2));
                $reason = $request->message;
            
                $diff = strtotime($date2) - strtotime($date1); 
  
                $day_diff = abs(round($diff / 86400)); 
                
                
                if($day_diff == 0)
                {
                    $date = $date1;
                }else if($day_diff > 0)
                {
                    $date =  $date1 ." - ".$date2;
                }
                
           
                $message = "Dear $marketer->name, Here we are informing you that $date will be a Holiday for $reason - Ayngaran Housing and Properties.";
            
           $encode_message = urlencode($message);
       if(isset($marketer->mobile_no))
       {
           $curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://sms.neophrontech.com/api/smsapi?key=e54f5cac8a06f4137b69f963471df1ba&route=2&sender=AYNHAP&number='.$marketer->mobile_no.'&templateid=1707170961591981365&sms='.$encode_message.'',
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
             
           
        }
  
        else if($request->message_for == '1707170961875176720')
        {
          $markertess = User::where('status',1)->where('id','!=',1);
            
            if(isset($request->message_to))
            {
               $markertess->whereIn('designation_id',$request->message_to); 
            }
            
            $markertes = $markertess->get();
            
           
  
     if(isset($markertes))
     {
      foreach($markertes as $marketer)
      {
                $date1 = date('d-m-Y',strtotime($request->message_date));
                $date2 = date('d-m-Y',strtotime($request->message_date_2));
                $reason = $request->message;
            
                $diff = strtotime($date2) - strtotime($date1); 
  
                $day_diff = abs(round($diff / 86400)); 
                
                if($day_diff == 0)
                {
                    $date = $date1;
                }else if($day_diff > 0)
                {
                    $date =  $date1 ." - ".$date2;
                }
              
           
            $message = "Festival Holiday......Dear $marketer->name, Here we are informing you that $date will be a Holiday for $reason Festival. Ayngaran wishes you / your family Happy $reason - Ayngaran Housing and Properties.";
          
            $encode_message = urlencode($message);
           
            
      if(isset($marketer->mobile_no))
      {
          
          
       $curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://sms.neophrontech.com/api/smsapi?key=e54f5cac8a06f4137b69f963471df1ba&route=2&sender=AYNHAP&number='.$marketer->mobile_no.'&templateid=1707170961875176720&sms='.$encode_message.'',
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
           
        }
        else if($request->message_for == '1707170910043447922')
        {
             
            $markertess = User::where('status',1)->where('id','!=',1);
            
            if(isset($request->message_to))
            {
               $markertess->whereIn('designation_id',$request->message_to); 
            }
            
            $markertes = $markertess->get();
            
           
  
     if(isset($markertes))
     {
      foreach($markertes as $marketer)
      {
          
               $date = date('d-m-Y',strtotime($request->message_date));
               
               $reason = $request->message;
               
              $mobile_no = $marketer->mobile_no;
            
            //   $mobile_no = '8072432832';
              
              $message = "Happy $reason By Ayngaran Housing and Properties.";
       
              $encode_message = urlencode($message);
              
              if(isset($mobile_no))
              {
                 $curl = curl_init();
   curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://sms.neophrontech.com/api/smsapi?key=e54f5cac8a06f4137b69f963471df1ba&route=2&sender=AYNHAP&number='.$mobile_no.'&templateid=1707170910043447922&sms='.$encode_message.'',
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
           
        }
        
        
         return response()->json(['status' => true, 'message' => 'Message Sent Successfully!']);  
         
    }
    
}
