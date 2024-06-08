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


class ReportPrintController extends Controller
{
   public function printBookingRegistered($from_date,$to_date)
   {
       $project_id = '';
       $plot_id = '';
       $team = '';
       $marketer_id = '';
       $status = '';
       return view('reports.booking_registered_print', compact('from_date','to_date','project_id','plot_id','team','marketer_id','status'));
   }
}
