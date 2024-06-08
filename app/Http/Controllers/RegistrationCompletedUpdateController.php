<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Branch;
use App\Models\PlotManagement;
use App\Models\ProjectDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationCompletedUpdateController extends Controller
{
    public function index(Request $request)
    {
        try {
        $project_id = $request->project_id;
        $plot_id = $request->plot_no;
        $status = $request->status;
        $projects = Booking::leftJoin('project_details', 'booking.project_id', '=', 'project_details.id')
                        ->select('booking.project_id', 'project_details.id', 'project_details.short_name')->distinct()->get();
        
        
        $reg_com_updates = DB::table("booking as a")
            ->leftJoin('project_details as b', 'b.id', '=', 'a.project_id')
            ->leftJoin('plot_management as c', 'c.id', '=', 'a.plot_id')
            ->where('a.confirm_status', '=', 1)
            ->whereNull('a.booking_status')
            // ->whereNull('a.register_status')
            ->select('a.*', 'b.*', 'c.*', 'a.id as booking_id', 'a.project_id as n_project_id', 'a.plot_id as n_plot_id')
            ->orderby('a.register_status');

        if (isset($project_id)) {
            $reg_com_updates = $reg_com_updates->where('a.project_id', $project_id);
        }
        if (isset($plot_id)) {
            $reg_com_updates = $reg_com_updates->where('a.plot_id', $plot_id);
        }
        
        if(isset($status))
        
        { 
            if($status == 1)
            {
            $reg_com_updates = $reg_com_updates->where('a.register_status',$status);
            }else{
             $reg_com_updates = $reg_com_updates->whereNull('a.register_status');
            }
        }
        $list = $reg_com_updates->get();

        $query = Booking::join('plot_management', 'booking.plot_id', '=', 'plot_management.id')
                    ->whereNull('booking.booking_status')->where('booking.fully_paid_status', 1)
                    ->where('booking.confirm_status', 1)->where('plot_management.deleted_at', 0);
                    if(isset($project_id)){
                      $query->where('booking.project_id',$project_id);  
                    }
                    $plot_nos = $query->select('plot_management.*')->orderBy('booking.id')->get();

        return view('plot_registration_complete_updated.index', compact('projects', 'list', 'project_id', 'plot_id', 'plot_nos','status'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function get_plot_nos(Request $request)
    {
        if ($request->project_id != "") {
            $plot_nos =  DB::table('plot_management as a')
                ->select('a.*', 'b.*', 'a.id as plot_id', 'b.id as booking_id', 'c.*')
                ->leftJoin('booking as b', 'a.id', '=', 'b.plot_id')
                ->leftJoin('project_details as c', 'c.id', '=', 'b.project_id')
                ->where('a.project_id', $request->project_id)
                ->whereNotNull('b.confirm_status')
                ->whereNull('b.register_status')
                ->whereNull('b.booking_status')
                ->get();
             
            return response()->json(['status' => true, 'plot_nos' => $plot_nos], 200);
        }
        return response()->json(['status' => false, 'message' => 'No Data Found'], 400);
    }

    public function store(Request $request)
    {

        $val =  $request->validate([
            'register_date' => 'required',
            'book_up_id' => 'required',
            'gl_value' => 'required',
        ]);
        $book_id = explode(',', $request->book_up_id);
        $plot_id = explode(',', $request->plot_id);
        $gl_value = explode(',', $request->gl_value);

        for ($i = 0; $i < count($book_id); $i++) {
            $update = Booking::where("id", $book_id[$i])->update([
                'register_status' => 1,
                'register_date' => $request->register_date,
                'new_update_gl_val' => $gl_value[$i]
            ]);
        }


        if ($update) {
            return response()->json(['status' => true, 'message' => 'Plot Registration Complete Updated Successfully!']);
        } else {
            return response()->json(['status' => false, 'message' => 'Plot Registration Complete Updated Failed!']);
        }
    }
}
