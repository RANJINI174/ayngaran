<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Direction;
use App\Models\PlotManagement;
use App\Models\ProjectDetail;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VacantPlotController extends Controller
{
    public function index(Request $request)
    {
        try {
            // $projects = Booking::leftJoin('project_details', 'booking.project_id', '=', 'project_details.id')
            //     ->select('project_details.id', 'project_details.short_name')->distinct('booking.project_id')->get();
            $projects = ProjectDetail::all();
            return view('reports.vacant_plots', compact('projects'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function get_vacant_plots(Request $request)
    {
        if ($request->project_id != "") {
            $project_id = $request->project_id;
            $project = ProjectDetail::where('id', $project_id)->first();
            $project_name = '';
            $start_date = '';

            $project_start_days = '';
            if (isset($project)) {
                $project_name = $project->short_name;
                $start_date = date('d-m-Y', strtotime($project->project_start_date));
                $project_start_days = $project->project_start_date;
            }
            $current_date = new DateTime(date('Y-m-d'));
            $project_start_date = new DateTime($project_start_days);

            $interval = $current_date->diff($project_start_date);
            $project_start_total_days = $interval->days;


            $booking_open = Booking::where('project_id',$project_id)->orderBy('id', 'asc')->first();
            $booking_start_date = '';
            if (isset($booking_open)) {
                $booking_start_date =   date('d-m-Y', strtotime($booking_open->receipt_date));
            }
            $booking_last = Booking::where('project_id',$project_id)->orderBy('id', 'desc')->first();
            $booking_last_date = '';
            if (isset($booking_last)) {
                $booking_last_date =  date('d-m-Y', strtotime($booking_last->receipt_date));
            }

            $booking_plots = Booking::where('project_id', $project_id)->whereNull('booking_status')->get()->count();
            $total_plots = PlotManagement::where('project_id', $project_id)->where('deleted_at', '=', 0)->get()->count();

            $total_booking = Booking::where('project_id', $project_id)->whereNull('booking_status')->get()->count();
            $vacant_plots = $total_plots - $total_booking;

            $booking_plots_sqft = 0;
            $booking_plot_lists = DB::table('booking')->leftJoin('plot_management', 'booking.plot_id', '=', 'plot_management.id')
                ->whereNull('booking.booking_status')->where('booking.project_id', $project_id)->select(DB::raw('SUM(plot_management.plot_sq_ft) as booking_total_sqft'))->first();
            if (isset($booking_plot_lists)) {
                $booking_plots_sqft = $booking_plot_lists->booking_total_sqft;
            }
            
            $total_plots_sqft = 0;
            $total_plot_sqfts = 0;
            $total_plot_lists = PlotManagement::where('project_id', $project_id)->where('deleted_at', '=', 0)->select(DB::raw('SUM(plot_sq_ft) as total_plot_sqft'))->first();
            if (isset($total_plot_lists)) {
                $total_plots_sqft = $total_plot_lists->total_plot_sqft;
                $total_plot_sqfts = $total_plot_lists->total_plot_sqft;
            }

            $filled_sqft = 0;
            $total_booking_sqft_get = Booking::leftJoin('plot_management', 'plot_management.id', '=', 'booking.plot_id')
                ->where('booking.project_id', $project_id)
                ->whereNull('booking_status')
                ->select(DB::raw('SUM(plot_sq_ft) as plot_sqft_sum'))
                ->first();

            if ($total_booking_sqft_get) {
                $filled_sqft = $total_booking_sqft_get->plot_sqft_sum;
            }

            $vacant_sqft = $total_plot_sqfts - $filled_sqft;
            $vacant_total_sqft = $vacant_sqft;
            
            
            
            $get_booked_plots = Booking::where('project_id', $project_id)->whereNull('booking_status')->get();
            $booked_ids = array();
            
            if(isset($get_booked_plots))
            {
                foreach($get_booked_plots as $book_plots)
                {
                    array_push($booked_ids,$book_plots->plot_id);
                }
            }
            $vacant_plot_nos =  PlotManagement::where('project_id',$project_id)->where('deleted_at', 0)
                              ->WhereNotIn('id',$booked_ids)->get();
            $html = '';
            $sno = 1;
            $total_vacant_plots = 0;
            if (isset($vacant_plot_nos)) {
                foreach ($vacant_plot_nos as $val) {
                    $direction = Direction::where('id',$val->direction_id)->first();
                    $total_vacant_plots += $val->plot_sq_ft;
                $html .= '<tr>
                <td>'.$sno++.'</td>
                <td>'.$val->plot_no.'</td>
                <td>'.$val->plot_sq_ft.'</td>
                <td>'.$direction->direction_name.'</td>
                </tr>';
                }
            }

            return response()->json([
                'status' => true,'project_id'=>$project_id, 'project_name' => $project_name, 'start_date' => $start_date, 'days' => $project_start_total_days,
                'booking_start_date' => $booking_start_date, 'booking_last_date' => $booking_last_date, 'booking_plots' => $booking_plots, 'vacant_plots' => $vacant_plots,
                'total_plots' => $total_plots, 'booking_plots_sqft' => $booking_plots_sqft, 'total_plots_sqft' => $total_plots_sqft, 'vacant_plots_sqft' => $vacant_total_sqft,
                'vacant_pot_nos'=>$html,'total_vacant_plots'=>$total_vacant_plots
            ], 200);
        }
        return response()->json(['status' => false, 'message' => 'No Data Found'], 400);
    }
    
     public function vacant_plots_print_lists(Request $request,$id)
    {
        try {
            $project_id = '';
            if(isset($id)){
                $project_id = $id;
            }
            $projects = ProjectDetail::all();
            return view('reports.vacant_plots_print', compact('projects','project_id'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    
}
