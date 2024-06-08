<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlotManagement;
use App\Models\PlotSqftEdit;
use Illuminate\Support\Facades\DB;

class PlotSqftEditController extends Controller
{

    public function plot_square_feet_edit()
    {
        try {
            $projects = DB::table("project_details")->get();
            $plots = PlotManagement::all();
            $plot_sqft_edits = DB::table("plot_square_feet_edit as a")
                ->leftJoin("plot_management as b", "b.id", "=", "a.plot_id")
                ->leftJoin("project_details as c", "c.id", "=", "a.project_id")
                ->select("a.*", "b.plot_no", "c.short_name")->get();
            $count = PlotSqftEdit::count();
            return view('plot_management.plot_square_feet_edit', compact('projects', 'plots', 'plot_sqft_edits', 'count'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function get_plot_list($id)
    {
        if (!empty($id)) {
            // $plots = PlotManagement::where('project_id', $id)->where("deleted_at", "=", 0)->get();
            
            $plots =  PlotManagement::select('plot_management.*')->leftJoin('booking as b', 'plot_management.id', '=', 'b.plot_id')->where('plot_management.project_id', $id)
                      ->where('plot_management.deleted_at', '=', 0)->whereNull('b.register_status')->orderBy('plot_management.id')->distinct()->get();
            
            $exist_edits =
                DB::table("plot_square_feet_edit as a")
                ->leftJoin("plot_management as b", "b.id", "=", "a.plot_id")
                ->leftJoin("project_details as c", "c.id", "=", "a.project_id")
                ->select("a.*", "b.plot_no", "c.short_name")
                ->where("a.project_id", $id)
                ->get();
            // echo "<pre>";
            // print_r($exist_edits);
            // exit;
            if ($plots != null) {
                return response()->json(['status' => 200, 'data' => $plots, 'exist_edits' => $exist_edits], 200);
            } else {
                return response()->json(['status' => 400, 'message' => 'Plots Not Found!'], 400);
            }
        }
    }
    public function get_plot_sqft($id)
    {
        if (!empty($id)) {
            $plot = PlotManagement::where('id', $id)->first();
            $plot_sqft = $plot->plot_sq_ft;
            if ($plot != null) {
                return response()->json(['status' => 200, 'data' => $plot, 'plot_sqft' => $plot_sqft], 200);
            } else {
                return response()->json(['status' => 400, 'message' => 'Plot Not Found!'], 400);
            }
        }
    }
    public function plot_sqft_update(Request $request, $id)
    {
        $request->validate([
            'edit_project_id' => 'required',
            'edit_ini_plot_no' => 'required',
            'edit_ini_plot_sq_ft' => 'required',
            'edit_new_plot_no' => 'required',
            'edit_new_plot_sq_ft' => 'required',
            'valid_reason' => 'required',
        ]);
        $exist_plot_no = PlotManagement::where("project_id", $request->edit_project_id)
            ->where("plot_no", $request->edit_new_plot_no)->where('id', '!=', $request->edit_plot_id)
            ->get()->count();
        // $same_plot_no = PlotManagement::where("project_id", $request->edit_project_id)
        //     ->where("plot_no", $request->edit_new_plot_no)->where('id', '=', $request->edit_plot_id)
        //     ->get()->count();
        if ($exist_plot_no > 0) {
            return response()->json(['status' => false, 'message' => 'Plot No Already Exist!']);
        } 
        // else if ($same_plot_no > 0) {
        //     return response()->json(['status' => false, 'message' => 'Plot No Already Exist!']);
        // }
        // save
        $plot_sqft = new PlotSqftEdit();
        $plot_sqft->plot_id = $request->edit_plot_id;
        $plot_sqft->project_id = $request->edit_project_id;
        $plot_sqft->initial_plot_no = $request->edit_ini_plot_no;
        $plot_sqft->initial_plot_sq_ft = $request->old_edit_ini_plot_sq_ft;
        $plot_sqft->new_plot_no = $request->edit_new_plot_no;
        $plot_sqft->new_plot_sq_ft = $request->edit_new_plot_sq_ft;
        $plot_sqft->reason = $request->valid_reason;
        $plot_sqft->save();
        // update
        $data['deleted_at'] = 1;
        $update = PlotManagement::where('id', $request->edit_plot_id)->update($data);

        //plot management plot create
        $get_plot = PlotManagement::where('id', $request->edit_plot_id)->first();
        
        $new_plot_sqft = $request->edit_new_plot_sq_ft;
        $gl_value = $get_plot->guide_line_sq_ft;
        $mv_value = $get_plot->market_value_sq_ft;
        $gl_plot_rate = $new_plot_sqft * $gl_value;
        $mv_plot_rate = $new_plot_sqft * $mv_value;
        
        $plot = new PlotManagement();
        $plot->project_id = $get_plot->project_id;
        $plot->type_id = $get_plot->type_id;
        $plot->guide_line_sq_ft = $get_plot->guide_line_sq_ft;
        $plot->market_value_sq_ft = $get_plot->market_value_sq_ft;
        $plot->plot_no = $request->edit_new_plot_no;
        $plot->plot_sq_ft = $new_plot_sqft;
        $plot->direction_id = $get_plot->direction_id;
        $plot->guide_line_plot_rate = $gl_plot_rate;
        $plot->market_value_plot_rate = $mv_plot_rate;
        $plot->save();

        if ($update) {
            $plot_sqft_edits = DB::table("plot_square_feet_edit as a")
                ->leftJoin("project_details as b", "b.id", "=", "a.project_id")
                ->leftJoin("plot_management as c", "c.id", "=", "a.plot_id")
                ->select("a.*", "b.short_name", "c.*")
                ->get();
            $i = 1;
            $html = '';
            foreach ($plot_sqft_edits as $val) {
                $html .= '<tr>';
                $html .= '<td>' . $i++  . '</td>';
                $html .= '<td>' . $val->short_name . '</td>';
                $html .= '<td>' . $val->plot_no . '</td>';
                $html .= '<td>' . number_format($val->initial_plot_sq_ft, 2) . '</td>';
                $html .= '<td>' . $val->new_plot_no . '</td>';
                $html .= '<td>' . number_format($val->new_plot_sq_ft, 2) . '</td>';
                $html .= '<td>' . $val->reason . '</td>';
                $html .= '</tr>';
            }
            return response()->json(['status' => true, 'message' => 'Plot Square Feet Updated Successfully!', 'html' => $html], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Plot Squate Feet Updated Failed!'], 400);
        }
    }
}