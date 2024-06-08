<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\CommissionDetail;
use App\Models\ProjectDetail;
use App\Models\Designation;
use App\Models\PlotManagement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommissionDetailController extends Controller
{
    public function index()
    {
        try {
            $commission_details = DB::table('commission_details as a')
                ->join('project_details as b', 'a.project_id', '=', 'b.id')
                ->groupBy('a.project_id', 'a.plan')
                ->select('b.full_name', 'b.short_name', 'a.project_id', DB::raw('a.plan as plan'))
                ->get();

            return view('commission_details.index', compact('commission_details'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function create()
    {
        try {
            $projects = DB::table('project_details')->get();
            $branches = Branch::where('status', 1)->get();
            return view('commission_details.add', compact('projects', 'branches'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function get_commission_detail($id)
    {
        if (!empty($id)) {
            $plot_detail = ProjectDetail::where('id', $id)->first();
            $marketer_details = Designation::whereIn('designation', ['Director', 'Marketing Managers', 'Marketing Supervisor', 'Marketing Executive'])
                ->where('status', 1)->get();
            $html = '';
            if ($plot_detail->commission_type == 1) {  // percentage type
                $sno = 1;
                foreach ($marketer_details as $val) {
                    $html .= "<tr><td>" . $sno++ .
                        "<input type='hidden' name='type' value='percentage_type'></td><td>" .
                        $val->designation .
                        "<input type='hidden' name='designation_id[]' id='designation_id_" .
                        $val->id . "' value=" .
                        $val->id .
                        "></td><td><input class='form-control percentage_sum percentage_validation' name='percentage[]' Placeholder='%'></td><td><input name='percentage_val[]' class='form-control percentage_val'></td></tr>";
                }
                $html .=
                    '<tr><td colspan="4" style="padding:4px;"><div class="d-flex align-items-center justify-content-end">Total : <input class="form-control" id="total_percentage_amt" value="0" readonly style="width:100px;"></div></td></tr>';
            }

            if ($plot_detail->commission_type == 2) {  // value type
                $sno = 1;
                foreach ($marketer_details as $val) {
                    $html .= "<tr><td>" . $sno++ .
                        "<input type='hidden' name='type' value='cash_type'></td><td>" .
                        $val->designation .
                        "<input type='hidden' name='designation_id[]' id='designation_id_" .
                        $val->id . "' value=" .
                        $val->id .
                        "></td><td><input type='text' class='form-control cash_sum cash_validation' name='cash[]' Placeholder='0.00' onkeyup='cash_sum_value()'></td></tr>";
                }
                $html .=
                    '<tr><td colspan="4" style="padding:4px;"><div class="d-flex align-items-center justify-content-end">Total : <input type="text" class="form-control" id="total_cash_amt" value="0" readonly style="width:100px;"></div></td></tr>';
            }


            // plan dropdown
            $planA = CommissionDetail::where("project_id", $id)->where("plan", 1)->groupBy('project_id')->get()->count();
            $planB = CommissionDetail::where("project_id", $id)->where("plan", 2)->groupBy('project_id')->get()->count();
            $planC = CommissionDetail::where("project_id", $id)->where("plan", 3)->groupBy('project_id')->get()->count();
            $planD = CommissionDetail::where("project_id", $id)->where("plan", 4)->groupBy('project_id')->get()->count();
            $planE = CommissionDetail::where("project_id", $id)->where("plan", 5)->groupBy('project_id')->get()->count();

            $plan_data = '<option value="">Select Plan</option>';

            if ($planA == 0) {
                $plan_data .= '<option value="1">Plan A</option>';
            }
            if (
                $planB == 0
            ) {
                $plan_data .= '<option value="2">Plan B</option>';
            }
            if (
                $planC == 0
            ) {
                $plan_data .= '<option value="3">Plan C</option>';
            }
            if (
                $planD == 0
            ) {
                $plan_data .= '<option value="4">Plan D</option>';
            }
            if (
                $planE == 0
            ) {
                $plan_data .= '<option value="5">Plan E</option>';
            }
            return response()->json([
                'status' => true, 'plot_detail' => $plot_detail, 'marketer_details' => $marketer_details,
                'html' => $html, 'plan_data' => $plan_data
            ], 200);
        }
        return response()->json(['status' => false, 'message' => 'No Data Found']);
    }
    public function get_edit_commission_detail($id)
    {

        if (!empty($id)) {
            $plot_detail =
                DB::table('project_details as a')
                ->select('a.*', 'b.*', 'c.*')
                ->leftJoin('commission_details as b', 'b.project_id', '=', 'a.id')
                ->leftJoin('designation as c', 'c.id', '=', 'b.designation_id')
                ->where('b.project_id', '=', $id)
                ->get();

            $plan = ProjectDetail::where('id', $id)->select('*')->first();
            $data = [];
            $data['plot_detail'] = $plot_detail;
            $html = '';
            $i = 1;
            foreach ($plot_detail as $val) {
                $i++;
                $html .= '<tr>';
                $html .= '<td>' . $i  . '</td>';
                $html .= '<td><input name="sq_ft_rate[]" class="form-control" value="' . $val->market_value . '"></td>';
                $html .= '<td><input type="hidden" name="designation_id[]" class="form-control" value="' . $val->designation_id . '"> ' . $val->designation . '</td>';
                $html .= '<td><input class="form-control cash_validation" name="cash[]" value="' . $val->cash . '"></td>';
                // $html .= '<td><input class="form-control cheque_validation" name="cheque[]" value="' . $val->cheque . '"</td>';
                if ($val->commission_type_val == 1) {
                    $html .= "<td><select name='commission_type_val[]'  class='form-control'><option value='1' >By Percentage</option><option value='2'>By Value</option></select></td>";
                } else {
                    $html .= "<td><select name='commission_type_val[]'  class='form-control'><option value='2' >By Value</option><option value='1'>By Percentage</option></select></td>";
                };
                $html .= '</tr>';
            }

            return response()->json(['status' => true, 'data' => $data, 'plan' => $plan, 'html' => $html], 200);
        }
        return response()->json(['status' => false, 'message' => 'No Data Found']);
    }

    public function store(Request $request)
    {
        $request->validate([
            "project_id" => "required",
            "commission_type_val" => "required",
            "plan_id" => "required",
            "mv_sq_ft" => "required",
        ]);
        $exist_project_plan = CommissionDetail::where("project_id", $request->project_id)->where("plan", $request->plan_id)->groupBy('project_id')->get()->count();
        if ($exist_project_plan) {
            return response()->json(['status' => false, 'message' => 'Project Plan Already Exist!']);
        }

        if ($request->type == "percentage_type") {
            foreach ($request->designation_id as $k => $p) {
                $insert = CommissionDetail::create([
                    'project_id' => $request->project_id,
                    'marketvalue_sqft' => $request->mv_sq_ft,
                    'plan' => $request->plan_id,
                    'commission_type' => $request->commission_type_val,
                    'designation_id' => $request['designation_id'][$k],
                    'percentage' => $request['percentage'][$k],
                    'percentage_val' => $request->percentage_val[$k],
                    'total_percentage_amt' => $request->total_percentage_amt,
                ]);
            }
        }
        if ($request->type == "cash_type") {
            foreach ($request->designation_id as $k => $p) {
                $insert = CommissionDetail::create([
                    'project_id' => $request->project_id,
                    'marketvalue_sqft' => $request->mv_sq_ft,
                    'plan' => $request->plan_id,
                    'commission_type' => $request->commission_type_val,
                    'designation_id' => $request['designation_id'][$k],
                    'cash' => $request['cash'][$k],
                    'total_cash_amt' => $request->total_cash_amt,
                ]);
            }
        }
        if ($insert) {
            return response()->json(['status' => true, 'message' => 'Commission Updation Created Successfully!'], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Commission Updation Creation Failed!'], 400);
        }
    }

    public function edit(Request $request, $id)
    {
        if (!empty($id)) {
            $projects = DB::table('project_details')->get();
            $project_detail = ProjectDetail::where("id", $id)->first();
            $commission_detail = CommissionDetail::select('*')->where('project_id', $id)->where('plan', $request->plan)->first();
            $get_commission_detail = CommissionDetail::select('*')->where('project_id', $id)->where('plan', $request->plan)->get();
            $plan_detail = CommissionDetail::where('project_id', $id)->where('plan', $request->plan)->groupBy(['project_id', 'plan'])->get();
            if ($commission_detail != "") {
                return view("commission_details.edit", compact('commission_detail', 'projects', 'project_detail', 'get_commission_detail', 'plan_detail'));
            }
            return response()->json(['status' => false, 'message' => 'Commission Updation  Not Found!'], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "project_id_val" => "required",
            "commission_type_val" => "required",
            "plan_val" => "required",
            "mv_sq_ft" => "required",
        ]);
        if (!empty($id)) {
            if ($request->type == "percentage_type") {
                foreach ($request->designation_id as $k => $p) {
                    $exist_project_plan = CommissionDetail::where("project_id", $request->project_id_val)
                        ->where("plan", $request->plan_val)->where('designation_id', $request['designation_id'][$k])
                        ->where('id', '!=', $request->per_update_id[$k])
                        ->get()->count();
                    if ($exist_project_plan > 0) {
                        return response()->json(['status' => false, 'message' => 'Project Plan Already Exist!']);
                    }
                    $update = CommissionDetail::where('id', $request->per_update_id[$k])->where('project_id', $request->project_id_val)->update([
                        'project_id' => $request->project_id_val,
                        'marketvalue_sqft' => $request->mv_sq_ft,
                        'plan' => $request->plan_val,
                        'commission_type' => $request->commission_type_val,
                        'designation_id' => $request['designation_id'][$k],
                        'percentage' => $request['percentage'][$k],
                        'percentage_val' => $request->percentage_val[$k],
                        'total_percentage_amt' => $request->total_percentage_amt,
                    ]);
                }
            }

            if ($request->type == "cash_type") {
                foreach ($request->designation_id as $k => $p) {

                    $exist_project_plan = CommissionDetail::where("project_id", $request->project_id_val)
                        ->where("plan", $request->plan_val)->where('designation_id', $request['designation_id'][$k])
                        ->where('id', '!=', $request->cash_update_id[$k])
                        ->get()->count();
                    if ($exist_project_plan > 0) {
                        return response()->json(['status' => false, 'message' => 'Project Plan Already Exist!']);
                    }
                    $update = CommissionDetail::where('id', $request->cash_update_id[$k])->where('project_id', $request->project_id_val)->update([
                        'project_id' => $request->project_id_val,
                        'marketvalue_sqft' => $request->mv_sq_ft,
                        'plan' => $request->plan_val,
                        'commission_type' => $request->commission_type_val,
                        'designation_id' => $request['designation_id'][$k],
                        'cash' => $request['cash'][$k],
                        'total_cash_amt' => $request->total_cash_amt,
                    ]);
                }
            }
            if ($update) {
                return response()->json(['status' => true, 'message' => 'Commission Updation Updated Successfully!'], 200);
            } else {
                return response()->json(['status' => false, 'message' => 'Commission Updation Updated Failed!'], 400);
            }
        }
        return response()->json(['status' => false, 'message' => 'Commission Detail Not Found!'], 400);
    }

    public function delete(Request $request, $id)
    {
        if (!empty($id)) {
            $CommissionDetail = CommissionDetail::where('project_id', $id)->where('plan', $request->del_plan)->delete();
            if ($CommissionDetail) {
                return response()->json(['status' => true, 'message' => 'Commission Updation Deleted Successfully!']);
            } else {
                return response()->json(['status' => false, 'message' => 'Commission Updation Deleted Failed!']);
            }
        }
    }
}
