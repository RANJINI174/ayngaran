<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\ProjectDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectAbstractController extends Controller
{
    public function index(Request $request)
    {
        try {
            $project_id = $request->get_project_id;
            $id = '';
            $projects =
                Booking::leftJoin('project_details', 'booking.project_id', '=', 'project_details.id')
                ->select('project_details.id', 'project_details.short_name')->distinct('booking.project_id')->get();

            $reports = DB::table('project_details');
            if (isset($project_id) && !empty($project_id)) {
                $id = $project_id;
                $reports->whereIn('id', $project_id);
            }
            $reports = $reports->get();

            return view('reports.project_abstract', compact('projects', 'reports', 'id'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
}
