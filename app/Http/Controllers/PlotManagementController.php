<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use App\Models\PlotManagement;
use App\Models\ProjectDetail;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class PlotManagementController extends Controller
{
    public function index()
    {

        try {
            $plot_managements =  DB::table('plot_management')
                ->leftJoin('project_details as b', 'b.id', '=', 'plot_management.project_id')
                ->leftJoin('direction as c', 'c.id', '=', 'plot_management.direction_id')
                ->select("plot_management.*", "b.*", "c.direction_name")
                ->groupBy('plot_management.project_id')
                ->get();
            return view('plot_management.index', compact('plot_managements'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function create()
    {

        try {
            $projects = DB::table("project_details")->get();
            $types = ProjectType::where("status", 1)->get();
            $directions = Direction::where("status", 1)->get();
            $plots = PlotManagement::where('deleted_at', '=', 0)->get();
            return view('plot_management.add', compact('projects', 'plots', 'types', 'directions'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function project_plot_edit($id)
    {

        try {

            $projects = DB::table("project_details")->get();
            $types = ProjectType::where("status", 1)->get();
            $directions = Direction::where("status", 1)->get();
            $plots = PlotManagement::where("project_id", $id)->where('deleted_at', '=', 0)->get();
            $plot_managements =  DB::table('plot_management')
                ->leftJoin('project_details as b', 'b.id', '=', 'plot_management.project_id')
                ->leftJoin('direction as c', 'c.id', '=', 'plot_management.direction_id')
                ->select("plot_management.*", "b.market_value", "c.direction_name")
                ->where("plot_management.project_id", $id)
                ->where('plot_management.deleted_at', '=', 0)
                ->get();
            $project_detail = ProjectDetail::where("id", $id)->first();
            return view('plot_management.edit', compact('projects', 'plots', 'plot_managements', 'types', 'directions', 'project_detail'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function plot_no_auto_fill($id)
    {
        $plot = PlotManagement::where("id", $id)->first();
        $sq_ft_rate = number_format($plot->sq_ft_rate, 2);
        $plot_rate = number_format($plot->plot_rate, 2);
        $plot_sq_ft = number_format($plot->plot_sq_ft, 2);
        if ($plot != null) {
            return response()->json(['status' => true, 'plot' => $plot, 'plot_sq_ft' => $plot_sq_ft, 'sq_ft_rate' => $sq_ft_rate, 'plot_rate' => $plot_rate], 200);
        }
        return response()->json(['status' => false, 'message' => 'Plot Not Found!'], 400);
    }

    public function get_type_value($id)
    {
        if (!empty($id)) {
            $plots =
                PlotManagement::from('plot_management as a')
                ->select(
                    'a.*',
                    'c.direction_name'
                )
                ->leftJoin('direction as c', 'c.id', '=', 'a.direction_id')
                ->where('a.project_id', '=', $id)
                ->where('a.deleted_at', '=', 0)
                ->get();
            $plot_count = PlotManagement::where("project_id", $id)->where('deleted_at', '=', 0)->get()->count();
            $directions = Direction::all();
            $project_type_val = ProjectDetail::where("id", $id)->first();
            $market_val = number_format($project_type_val->market_value, 2);
            return response()->json(['status' => true, 'data' => $project_type_val, 'market_val' => $market_val, 'plots' => $plots, 
            'directions' => $directions,'plot_count'=>$plot_count], 200);
        }
        return response()->json(['status' => false, 'message' => 'Project Not Found!'], 400);
    }

    public function store(Request $request)
    {

        $request->validate([
            'project_id' => 'required',
            'type_id' => 'required',
            'guide_line_sq_ft' => 'required',
            // 'market_value_sq_ft' => 'required',
            'plot_no' => 'required',
            'plot_sq_ft' => 'required',
            'direction_id' => 'required',
            'guide_line_plot_rate' => 'required',
            // 'market_value_plot_rate' => 'required',
        ]);

        $exist_plot_no = PlotManagement::where("project_id", $request->project_id)->where("plot_no", $request->plot_no)->get()->count();
        if ($exist_plot_no > 0) {
            return response()->json(['status' => false, 'message' => 'Plot No Already Exist!']);
        }
        $plot = new PlotManagement();
        $plot->project_id = $request->project_id;
        $plot->type_id = $request->type_id;
        $plot->guide_line_sq_ft = $request->guide_line_sq_ft;
        $plot->market_value_sq_ft = $request->market_value_sq_ft;
        $plot->plot_no = $request->plot_no;
        $plot->plot_sq_ft = $request->plot_sq_ft;
        $plot->direction_id = $request->direction_id;
        $plot->guide_line_plot_rate = $request->guide_line_plot_rate;
        $plot->market_value_plot_rate = $request->market_value_plot_rate;
        $insert = $plot->save();
        if ($insert) {
            $plot_lists = PlotManagement::from('plot_management as a')
                ->select(
                    'a.*',
                    'c.direction_name'
                )
                ->leftJoin('direction as c', 'c.id', '=', 'a.direction_id')
                ->where('a.project_id', '=', $request->project_id)
                ->where('a.deleted_at', '=', 0)
                ->get();
            $directions = Direction::all();
            $plot_sqft = 0;
                                            $guide_line_sqft = 0;
                                            $mv_sqft = 0;
                                            $gl_plot_rate = 0;
                                            $mv_plot_rate = 0;

            if (!empty($plot_lists)) {
                $html = '';
                $i = 1;
                $html .= "<tr>";
                $html .= "<td>#</td>";
                $html .= "<td><select name='plot_no_search' id='res_plot_no_search' class='form-control plot_no_search' onchange='responsePlotChange()'>";
                $html .= " <option value=''>Plot No</option>";
                foreach ($plot_lists  as $val) {
                    $html .= " <option value='" . $val->id . "'>" . $val->plot_no . "</option>";
                }
                $html .= "</select></td>";
                $html .= "<td><input type='text' class='form-control' id='res_plot_sq_ft_search' readonly></td>";
                $html .= "<td><input type='text' class='form-control' id='res_gl_sq_ft_search' readonly></td>";
                if(Auth::user()->designation_id  != 11)
                    {
                $html .= "<td><input type='text' class='form-control' id='res_mv_sq_ft_search' readonly></td>";
                    }
                $html .= "<td><input type='text' class='form-control' id='res_gl_plot_rate_search' readonly></td>";
                $html .= "<td><input type='text' class='form-control' id='res_mv_plot_rate_search' readonly></td>";
                $html .= "<td colspan='2'><select name='seacrh_direction_id' id='res_seacrh_direction_id' class='form-control SlectBox'><option value=''>Direction</option>";
                foreach ($directions  as $val) {
                    $html .= " <option value='" . $val->id . "'>" . $val->direction_name . "</option>";
                }
                $html .= "</select></td>";
                $html .= "<tr>";

                foreach ($plot_lists as $val) {
                    $html .= '<tr>';
                    $html .= '<td>' . $i++  . '</td>';
                    $html .= '<td>' . $val->plot_no . '</td>';
                    $html .= '<td>' . $val->plot_sq_ft . '</td>';
                    $html .= '<td>' . IND_money_format(round($val->guide_line_sq_ft)) . '</td>';
                    if(Auth::user()->designation_id  != 11)
                    {
                    $html .= '<td>' . IND_money_format(round($val->market_value_sq_ft)) . '</td>';    
                    }
                    $html .= '<td>' . IND_money_format(round($val->guide_line_plot_rate)) . '</td>';
                    $html .= '<td>' . IND_money_format(round($val->market_value_plot_rate)) . '</td>';
                    $html .= '<td>' . $val->direction_name . '</td>';
                    $html .= '<td><a class="btn-primary border-0 me-1" href="#" data-bs-toggle="modal" onclick="EditPlot(' . $val->id . ')"data-bs-target="#Edit_plotModal"style="padding: 4px; border-radius:5px;"><i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg"height="12" viewBox="0 0 19 24" width="12"><path d="M0 0h24v24H0V0z" fill="none" /><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-. 45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z" /></svg></i></a></td>';
                    $html .= '</tr>';
                    
                    
                    $plot_count = PlotManagement::where('project_id', $val->project_id)
                                            ->where('deleted_at', '=', 0)
                                            ->get()
                                            ->count();
                                          
                                        if ($val->plot_sq_ft != '' && $val->plot_sq_ft != null) {
                                            $plot_sqft += $val->plot_sq_ft;
                                        }
                                        if ($val->guide_line_sq_ft != '' && $val->guide_line_sq_ft != null) {
                                            $guide_line_sqft += $val->guide_line_sq_ft;
                                        }
                                        if ($val->market_value_sq_ft != '' && $val->market_value_sq_ft != null) {
                                            $mv_sqft += $val->market_value_sq_ft;
                                        }
                                        if ($val->guide_line_plot_rate != '' && $val->guide_line_plot_rate != null) {
                                            $gl_plot_rate += round($val->guide_line_plot_rate);
                                        }
                                        if ($val->market_value_plot_rate != '' && $val->market_value_plot_rate != null) {
                                            $mv_plot_rate += round($val->market_value_plot_rate);
                                        }
                                        
                }
                $html .= '<tr>
                                    <td>
                                        <h5 class="fw-bold text-end text-danger">Total :</h5>
                                    </td>
                                    <td>
                                        <h5 class="fw-bold text-success">'.$plot_count.'</h5>
                                    </td>
                                    <td>
                                        <h5 class="fw-bold text-success">' .$plot_sqft.'</h5>
                                    </td>
                                    <td>
                                        <!--<h5 class="fw-bold text-success">{{ number_format($guide_line_sqft, 2) }}</h5>-->
                                    </td>
                                    <td>
                                        <!--<h5 class="fw-bold text-success">{{ number_format($mv_sqft, 2) }}</h5>-->
                                    </td>
                                    <td>
                                        <h5 class="fw-bold text-success">'.IND_money_format($gl_plot_rate).'</h5>
                                    </td>
                                    <td colspan="3">
                                        <h5 class="fw-bold text-success">'.IND_money_format($mv_plot_rate).'</h5>
                                    </td>
                                    ';

                return response()->json(['status' => true, 'message' => 'Plot Created Successfully!', 'html' => $html], 200);
            } else {
                return response()->json(['status' => false, 'message' => 'Plot Creation Failed!'], 400);
            }
        }
    }
    public function edit($id)
    {
        if (!empty($id)) {

            $plot = PlotManagement::where('id', $id)->first();
            $register_plot_count =
                DB::table('plot_management')
                ->leftJoin('booking', 'plot_management.id', '=', 'booking.plot_id')->where('plot_management.deleted_at', 0)
                ->where('booking.plot_id', $id)->where('booking.confirm_status', 1)->get()->count();

            $project = ProjectDetail::where('id', $plot->project_id)->first();
            if ($plot) {
               return response()->json(['status' => 200, 'data' => $plot, 'register_plot_count' => $register_plot_count, 'project' => $project], 200);
            } else {
                return response()->json(['status' => 400, 'message' => 'Plot not found!'], 400);
            }
        }
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'edit_project_id' => 'required',
            'edit_type_id' => 'required',
            'edit_guide_line_sq_ft' => 'required',
            // 'edit_market_value_sq_ft' => 'required',
            'edit_plot_no' => 'required',
            'edit_plot_sq_ft' => 'required',
            'edit_direction_id' => 'required',
            'edit_guide_line_plot_rate' => 'required',
            // 'edit_market_value_plot_rate' => 'required',
        ]);
        $exist_plot_no = PlotManagement::where("project_id", $request->edit_project_id)
            ->where("plot_no", $request->edit_plot_no)->where('id', '!=', $id)
            ->get()->count();

        if ($exist_plot_no > 0) {
            return response()->json(['status' => false, 'message' => 'Plot No Already Exist!']);
        }

        $data['project_id'] = $request->edit_project_id;
        $data['type_id'] = $request->edit_type_id;
        $data['guide_line_sq_ft'] = $request->edit_guide_line_sq_ft;
        $data['market_value_sq_ft'] = $request->edit_market_value_sq_ft;
        $data['plot_no'] = $request->edit_plot_no;
        $data['plot_sq_ft'] = $request->edit_plot_sq_ft;
        $data['direction_id'] = $request->edit_direction_id;
        $data['guide_line_plot_rate'] = $request->edit_guide_line_plot_rate;
        $data['market_value_plot_rate'] = $request->edit_market_value_plot_rate;
        $update = PlotManagement::where('id', $id)->update($data);
        if ($update) {
            $plot_lists = PlotManagement::from('plot_management as a')
                ->select(
                    'a.*',
                    'c.direction_name'
                )
                ->leftJoin('direction as c', 'c.id', '=', 'a.direction_id')
                ->where('a.project_id', '=', $request->edit_project_id)
                ->where('a.deleted_at', '=', 0)
                ->get();
            $directions = Direction::all();
            $plot_sqft = 0;
                                            $guide_line_sqft = 0;
                                            $mv_sqft = 0;
                                            $gl_plot_rate = 0;
                                            $mv_plot_rate = 0;

            if (!empty($plot_lists)) {
                $html = '';
                $i = 1;
                $html .= "<tr>";
                $html .= "<td>#</td>";
                $html .= "<td><select name='plot_no_search' id='res_plot_no_search' class='form-control plot_no_search' onchange='responsePlotChange()'>";
                $html .= " <option value=''>Plot No</option>";
                foreach ($plot_lists  as $val) {
                    $html .= " <option value='" . $val->id . "'>" . $val->plot_no . "</option>";
                }
                $html .= "</select></td>";
                $html .= "<td><input type='text' class='form-control' id='res_plot_sq_ft_search' readonly></td>";
                $html .= "<td><input type='text' class='form-control' id='res_gl_sq_ft_search' readonly></td>";
                if(Auth::user()->designation_id  != 11)
                    {
                $html .= "<td><input type='text' class='form-control' id='res_mv_sq_ft_search' readonly></td>";
                    }
                $html .= "<td><input type='text' class='form-control' id='res_gl_plot_rate_search' readonly></td>";
                $html .= "<td><input type='text' class='form-control' id='res_mv_plot_rate_search' readonly></td>";
                $html .= "<td colspan='2'><select name='seacrh_direction_id' id='res_seacrh_direction_id' class='form-control SlectBox'><option value=''>Direction</option>";
                foreach ($directions  as $val) {
                    $html .= " <option value='" . $val->id . "'>" . $val->direction_name . "</option>";
                }
                $html .= "<tr>";
                foreach ($plot_lists as $val) {
                    $html .= '<tr>';
                    $html .= '<td>' . $i++  . '</td>';
                    $html .= '<td>' . $val->plot_no . '</td>';
                    $html .= '<td>' . $val->plot_sq_ft . '</td>';
                    $html .= '<td>' . IND_money_format(round($val->guide_line_sq_ft)) . '</td>';
                    if(Auth::user()->designation_id  != 11)
                    {
                    $html .= '<td>' . IND_money_format(round($val->market_value_sq_ft)) . '</td>';    
                    }
                    $html .= '<td>' . IND_money_format(round($val->guide_line_plot_rate)) . '</td>';
                    $html .= '<td>' . IND_money_format(round($val->market_value_plot_rate)) . '</td>';
                    $html .= '<td>' . $val->direction_name . '</td>';
                    $html .= '<td><a class="btn-primary border-0 me-1" href="#"data-bs-toggle="modal" onclick="EditPlot(' . $val->id . ')"data-bs-target="#Edit_plotModal"style="padding: 4px; border-radius:5px;"><i><svg class="table-edit" xmlns="http://www.w3.org/2000/svg"height="12" viewBox="0 0 19 24" width="12"><path d="M0 0h24v24H0V0z" fill="none" /><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-. 45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z" /></svg></i></a></td>';
                    $html .= '</tr>';
                    
                    $plot_count = PlotManagement::where('project_id', $val->project_id)
                                            ->where('deleted_at', '=', 0)
                                            ->get()
                                            ->count();
                                        if ($val->plot_sq_ft != '' && $val->plot_sq_ft != null) {
                                            $plot_sqft += $val->plot_sq_ft;
                                        }
                                        if ($val->guide_line_sq_ft != '' && $val->guide_line_sq_ft != null) {
                                            $guide_line_sqft += $val->guide_line_sq_ft;
                                        }
                                        if ($val->market_value_sq_ft != '' && $val->market_value_sq_ft != null) {
                                            $mv_sqft += $val->market_value_sq_ft;
                                        }
                                        if ($val->guide_line_plot_rate != '' && $val->guide_line_plot_rate != null) {
                                            $gl_plot_rate += round($val->guide_line_plot_rate);
                                        }
                                        if ($val->market_value_plot_rate != '' && $val->market_value_plot_rate != null) {
                                            $mv_plot_rate += round($val->market_value_plot_rate);
                                        }
                                        
                }
                
                $html .= '<tr>
                                    <td>
                                        <h5 class="fw-bold text-end text-danger">Total :</h5>
                                    </td>
                                    <td>
                                        <h5 class="fw-bold text-success">'.$plot_count.'</h5>
                                    </td>
                                    <td>
                                        <h5 class="fw-bold text-success">' .$plot_sqft.'</h5>
                                    </td>
                                    <td>
                                        <!--<h5 class="fw-bold text-success">{{ number_format($guide_line_sqft, 2) }}</h5>-->
                                    </td>
                                    <td>
                                        <!--<h5 class="fw-bold text-success">{{ number_format($mv_sqft, 2) }}</h5>-->
                                    </td>
                                    <td>
                                        <h5 class="fw-bold text-success">'.IND_money_format($gl_plot_rate).'</h5>
                                    </td>
                                    <td colspan="3">
                                        <h5 class="fw-bold text-success">'.IND_money_format($mv_plot_rate).'</h5>
                                    </td>
                                    ';

                return response()->json(['status' => true, 'message' => 'Plot Updated Successfully!', 'html' => $html], 200);
            } else {
                return response()->json(['status' => false, 'message' => 'Plot Updated Failed!'], 400);
            }
        }
    }
    public function delete($id)
    {
        if (!empty($id)) {

            $plot = PlotManagement::where('id', $id)->delete();
            if ($plot) {
                return response()->json(['status' => 200, 'message' => 'Plot Deleted Successfully!'], 200);
            } else {
                return response()->json(['status' => 400, 'message' => 'Plot Deleted Failed!'], 400);
            }
        }
    }
}