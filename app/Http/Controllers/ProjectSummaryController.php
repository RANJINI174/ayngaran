<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\PlotManagement;
use App\Models\ProjectDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class ProjectSummaryController extends Controller
{
    public function index(Request $request)
    {
        try {
            // $projects =
            //     Booking::leftJoin('project_details', 'booking.project_id', '=', 'project_details.id')
            //     ->select('project_details.id', 'project_details.short_name')->distinct('booking.project_id')->get();
                
                
             $projects = ProjectDetail::all();
             $project_id = $request->get_project_id;
             $id = '';
            $reports = DB::table('project_details');
            if (isset($project_id) && !empty($project_id)) {
                $id = $project_id;
                $reports->where('id', $project_id);
            }
            $reports = $reports->get();

            return view('reports.project_summary', compact('projects','reports','id'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function get_project_summary(Request $request)
    {
        if ($request->project_id != "") {
            $project_id = $request->project_id;
            $project = ProjectDetail::where('id', $project_id)->first();
            $site = '';
            $start_date = '';
            $project_start_total_days = '';

            if (isset($project)) {
                $site = $project->short_name;
                $start_date = $project->project_start_date;
                 $project_start_days = $project->project_start_date;
            }

            $current_date = new DateTime(date('Y-m-d'));
            $project_start_date = new DateTime($project_start_days);

            $interval = $current_date->diff($project_start_date);
            $project_start_total_days = $interval->days;
            
            $booking_open = Booking::orderBy('id', 'asc')->first();
            $book_open_date = '';
            if (isset($booking_open)) {
                $book_open_date =  date('d-m-Y', strtotime($booking_open->receipt_date));
            }
            $booking_last = Booking::orderBy('id', 'desc')->first();
            $booking_last_date = '';
            if (isset($booking_last)) {
                $booking_last_date =  date('d-m-Y', strtotime($booking_last->receipt_date));
            }
            
            
            $total_plots = PlotManagement::where('project_id', $project_id)->where('deleted_at','=',0)->get()->count(); // total plots

            $total_plot_sqfts = 0;
            $plot = PlotManagement::where('project_id', $project_id)->where('deleted_at','=',0)->select(DB::raw('SUM(plot_sq_ft) as total_plot_sqft')) // total plots sqft
                     ->first(); 
            if (isset($plot)) {
                $total_plot_sqfts = number_format($plot->total_plot_sqft, 2);
            }
            
            $book_plots = Booking::whereNull('booking_status')->whereNull('fully_paid_status')->whereNull('confirm_status') // booking plots
                          ->whereNull('register_status')->where('project_id', $project_id)->get()->count();
            
            $booking_total_sqft = 0;
            $booking_plots = DB::table('booking')->whereNull('booking_status')->whereNull('fully_paid_status')->whereNull('confirm_status') // booking plots sqft
                             ->whereNull('register_status')->leftJoin('plot_management', 'booking.plot_id', '=', 'plot_management.id')
                             ->where('booking.project_id', $project_id)->select(DB::raw('SUM(plot_management.plot_sq_ft) as booking_total_sqft'))->first();
            if (isset($booking_plots)) {
                $booking_total_sqft = number_format($booking_plots->booking_total_sqft, 2);
            }

            $fully_paid_count = Booking::where('fully_paid_status',1)->whereNull('booking_status') // fully paid count
                                ->whereNull('confirm_status')->whereNull('register_status')->where('project_id', $project_id)->get()->count();
            
           $fully_paid_sqft = 0;
           $fully_paid_plots = DB::table('booking')->whereNull('booking_status')->where('fully_paid_status',1)->whereNull('register_status')->whereNull('confirm_status')
                             ->leftJoin('plot_management', 'booking.plot_id', '=', 'plot_management.id')
                             ->where('booking.project_id', $project_id)->select(DB::raw('SUM(plot_management.plot_sq_ft) as booking_total_sqft'))->first();
            if (isset($fully_paid_plots)) {
                $fully_paid_total_sqft = number_format($fully_paid_plots->booking_total_sqft, 2);
            }
            
            $register_pending_count = Booking::where('project_id', $project_id)->whereNull('booking_status')->whereNotNull('fully_paid_status') // register pending
                                      ->whereNotNull('confirm_status')->whereNull('register_status')->get()->count();


            $register_plots = Booking::where('project_id', $project_id)->whereNull('booking_status')->where('fully_paid_status',1)->whereNotNull('confirm_status')
                              ->whereNotNull('register_status')->get()->count(); // register plots
            $register_total_sqft = 0;
            $register_total_plots = DB::table('booking')->leftJoin('plot_management', 'booking.plot_id', '=', 'plot_management.id')
                ->where('booking.project_id', $project_id)->whereNull('booking.booking_status')->where('booking.fully_paid_status',1)
                ->whereNotNull('booking.confirm_status')->whereNotNull('booking.register_status')
                ->select(DB::raw('SUM(plot_management.plot_sq_ft) as register_total_sqft'))->first();
            if (isset($register_total_plots)) {
                $register_total_sqft = number_format($register_total_plots->register_total_sqft, 2);
            }


            $plots = PlotManagement::where('project_id', $project_id)->where('deleted_at', 0)->get()->count();
            $total_booking = Booking::where('project_id', $project_id)->whereNull('booking_status')->get()->count();
            $vacant_plots = $plots - $total_booking;

            $total_plot_sqft = PlotManagement::where('project_id', $project_id)->where('deleted_at', 0)
                ->select(DB::raw('SUM(plot_sq_ft) as plot_sqft_sum'))->first();
            if (isset($total_plot_sqft)) {
                $total_sqft = $total_plot_sqft->plot_sqft_sum;
            }

            $total_booking_sqft_get = Booking::leftjoin('plot_management', 'plot_management.id', 'booking.plot_id')
                ->where('booking.project_id', $project_id)->whereNull('booking_status')
                ->select(DB::raw('SUM(plot_sq_ft) as plot_sqft_sum'))->first();
            if (isset($total_booking_sqft_get)) {
                $filled_sqft = $total_booking_sqft_get->plot_sqft_sum;
            }

            $vacant_sqft = $total_sqft - $filled_sqft;
            $vacant_total_sqft = number_format($vacant_sqft, 2);

            $html = '';
            $html .= '<tr>
            <td>1</td>
            <td>' . $site . '</td>
            <td>' . date('d-m-Y', strtotime($start_date)) . '</td>
            <td>' . $project_start_total_days . '</td>
            <td>' . $book_open_date . '</td>
            <td>' . $booking_last_date . '</td>
            <td>' . $book_plots . '</td>
            <td>' . $fully_paid_count . '</td>
            <td>' . $register_plots . '</td>
            <td>' . $register_pending_count . '</td>
            <td>' . $total_plots . '</td>
            <td>' . $total_plot_sqfts . '</td>
            <td>' . $book_plots . '</td>
            <td>' . $booking_total_sqft . '</td>
            <td>' . $register_plots . '</td>
            <td>' . $register_total_sqft . '</td>
            <td>' . $fully_paid_count . '</td>
            <td>' . $fully_paid_total_sqft . '</td>
            <td>' . $vacant_plots . '</td>
            <td>' . $vacant_total_sqft . '</td>
            </tr>';
            return response()->json([
                'status' => true, 'html' => $html, 'fully_paid_count' => $fully_paid_count, 'register_pending_count' => $register_pending_count, 'total_plots' => $total_plots, 'total_sqft' => $total_plot_sqfts,
                'book_plots' => $book_plots, 'booking_total_sqft' => $booking_total_sqft, 'register_plots' => $register_plots, 'register_total_sqft' => $register_total_sqft,
                'vacant_plots' => $vacant_plots, 'vacant_total_sqft' => $vacant_total_sqft,'fully_paid_plots' => $fully_paid_count, 'fully_paid_total_sqft' => $fully_paid_total_sqft
            ]);
        }
        return response()->json(['status' => false, 'message' => 'No Data Found'], 400);
    }
}
