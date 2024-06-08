<?php

namespace App\Exports;

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
use Illuminate\Database\Eloquent\Model;

class ReceiptsExport extends Model
{
  public function view($id)
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
       
      return view('booking.print', compact('booking','payment','customer_name','customer_mobile','street','pincode','area',
      'city','state','alternate_mobile','marketer_details','director_details'));
  }
}