<?php

namespace App\Http\Controllers;

use \App\Models\CommissionCashIssue;
use App\Models\CommissionDetail;
use App\Models\PlotManagement;
use App\Models\ProjectDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommissionCashIssueController extends Controller
{
    public function index()
    {
        try {
            $projects = ProjectDetail::all();
            return view('commission_cash_issue.index', compact('projects'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

   public function get_commission_plot_sqft(Request $request)
    {
        if ($request->project_id != "" && $request->plot_id) {

            $plot = PlotManagement::where('project_id', $request->project_id)->where("id", $request->plot_id)->first();
            $plot_sqft = 0;
            if (!empty($plot)) {
                $plot_sqft = number_format($plot->plot_sq_ft,2);
            }
            return response()->json(['status' => true, 'plot_sqft' => $plot_sqft], 200);
        }
        return response()->json(['status' => false, 'message' => 'No Data Found'], 400);
    }
    public function get_plot_nos(Request $request)
    {
        if ($request->project_id != "") {
            $plot_nos = DB::table('booking as a')
                ->select('a.*', 'b.*')
                ->leftJoin('plot_management as b', 'a.plot_id', '=', 'b.id')
                ->where('a.project_id', $request->project_id)
                ->whereNotNull('a.register_status')
                ->get();
            return response()->json(['status' => true, 'plot_nos' => $plot_nos], 200);
        }
        return response()->json(['status' => false, 'message' => 'No Data Found'], 400);
    }



    public function get_marketer_list(Request $request)
    {
        if ($request->plot_id != "" && $request->plan != "") {
            $project_id = $request->project_id;
            $plot_id = $request->plot_id;
            $plan = $request->plan;
            $project = ProjectDetail::where('id', $request->project_id)->first();
            $commission_type = '';
            if (isset($project)) {
                $commission_type = $project->commission_type;
            }
            $plot = PlotManagement::where("id", $request->plot_id)->first();
            $mv_per_sqft = 0;
            if ($plan == 1) {
                if (!empty($project->market_value) && $project->market_value != null) {
                    $mv_per_sqft = $project->market_value;
                }
            } else if ($plan == 2) {
                if (!empty($project->market_value_b) && $project->market_value_b != null) {
                    $mv_per_sqft = $project->market_value_b;
                }
            } else if ($plan == 3) {
                if (!empty($project->market_value_c) && $project->market_value_c != null) {
                    $mv_per_sqft = $project->market_value_c;
                }
            }

            $plot_sqft = $plot->plot_sq_ft;

            $marketer = DB::table('booking as a')->select('a.id', 'a.marketer_id')->leftJoin('plot_management as b', 'a.plot_id', '=', 'b.id')
                ->where('a.plot_id', '=', $request->plot_id)->first();

            $user = DB::table('users as a')->select('a.*', 'b.designation')->leftJoin('designation as b', 'a.designation_id', '=', 'b.id')
                ->where('a.id', '=', $marketer->marketer_id)->first();

            $dir = DB::table('users as a')->select('a.*', 'b.designation')->leftJoin('designation as b', 'a.designation_id', '=', 'b.id')
                ->where('a.id', '=', $user->id)->first();

            $director = DB::table('users as a')->select('a.*', 'b.designation', 'a.id as user_id')->leftJoin('designation as b', 'a.designation_id', '=', 'b.id')
                ->where('a.id', '=', $user->director_id)->first();

            $m_manager = DB::table('users as a')->select('a.*', 'b.designation', 'a.id as user_id')->leftJoin('designation as b', 'a.designation_id', '=', 'b.id')
                ->where('a.id', '=', $user->marketing_manager_id)->first();

            $m_supervior = DB::table('users as a')->select('a.*', 'b.designation', 'a.id as user_id')->leftJoin('designation as b', 'a.designation_id', '=', 'b.id')
                ->where('a.id', '=', $user->marketing_supervisor_id)->first();

            $director_percentage_amt = 0;
            $manager_percentage_amt = 0;
            $supervisor_percentage_amt = 0;
            $exe_percentage_amt = 0;

            $director_cash_amt = 0;
            $manager_cash_amt = 0;
            $supervisor_cash_amt = 0;
            $executive_cash_amt = 0;
            $commission_details = CommissionDetail::where('project_id', $project_id)->where("plan", "=", $plan)->get();
            if ($commission_details->isNotEmpty()) {

                $director_cash = $commission_details[0]['cash'];
                $manager_cash = $commission_details[1]['cash'];
                $supervisor_cash = $commission_details[2]['cash'];
                $executive_cash = $commission_details[3]['cash'];

                $director_percentage = $commission_details[0]['percentage'];
                $manager_percentage = $commission_details[1]['percentage'];
                $supervisor_percentage = $commission_details[2]['percentage'];
                $executive_percentage = $commission_details[3]['percentage'];

                $designation_id = $dir->designation_id;

                if (isset($director)) { // director percentange
                    $director_per = ($mv_per_sqft * $director_percentage) / 100;
                    $director_percentage_amt = $plot_sqft * $director_per;
                }
                if ($designation_id != 2 && $m_manager == null) {
                    $m_per_val = ($mv_per_sqft * $manager_percentage) / 100;
                    $manager_per_val = $plot_sqft * $m_per_val;
                    $director_percentage_amt = $director_percentage_amt + $manager_per_val;
                }
                if ($m_supervior == null &&  $designation_id != 3 && $m_manager == null && $designation_id != 2) {
                    $s_per_val = ($mv_per_sqft * $supervisor_percentage) / 100;
                    $tot_s_per_val = $plot_sqft * $s_per_val;
                    $director_percentage_amt = $director_percentage_amt + $tot_s_per_val;
                }
                if (isset($director)) { // director cash
                    $director_cash_amt = $plot_sqft * $director_cash;
                }
                if ($designation_id != 2 && $m_manager == null) {
                    $m_cash_amt = $plot_sqft * $manager_cash;
                    $director_cash_amt = $director_cash_amt + $m_cash_amt;
                }
                if ($m_supervior == null &&  $designation_id != 3 && $m_manager == null && $designation_id != 2) {
                    $s_cash_amt = $plot_sqft * $supervisor_cash;
                    $director_cash_amt = $director_cash_amt + $s_cash_amt;
                }

                if (isset($m_manager)) { // manager percentage
                    $manager_per_value = ($mv_per_sqft * $manager_percentage) / 100;
                    $manager_percentage_amt = $plot_sqft * $manager_per_value;
                }
                if ($designation_id != 3 && $m_supervior == null) {
                    $sup_per_value = ($mv_per_sqft * $supervisor_percentage) / 100;
                    $tot_sup_per_val = $plot_sqft * $sup_per_value;
                    $manager_percentage_amt = $manager_percentage_amt + $tot_sup_per_val;
                }
                if (isset($m_manager)) { // manager cash
                    $mm_cash_amt = $plot_sqft * $manager_cash;
                    $manager_cash_amt = $mm_cash_amt;
                }
                if ($designation_id != 3 && $m_supervior == null) {
                    $sup_cash_amt = $plot_sqft * $supervisor_cash;
                    $manager_cash_amt = $manager_cash_amt + $sup_cash_amt;
                }


                if (isset($m_supervior)) {
                    $supervisor_value = ($mv_per_sqft * $supervisor_percentage) / 100; // supervisor percentage
                    $super__per_amt = $plot_sqft * $supervisor_value;
                    $supervisor_percentage_amt = $supervisor_percentage_amt + $super__per_amt;
                }

                if ($designation_id == 4 && $dir == null) {
                    $executive_value = ($mv_per_sqft * $executive_percentage) / 100;
                    $supervisor_percentage_amt = $plot_sqft * $executive_value;
                }


                if (isset($m_supervior)) {
                    $sup_cash_amt = $plot_sqft * $supervisor_cash; // supervisor cash
                    $supervisor_cash_amt = $sup_cash_amt;
                }
                if ($designation_id == 4 && $dir == null) {
                    $exe_cash_amt = $plot_sqft * $executive_cash;
                    $supervisor_cash_amt = $supervisor_cash_amt + $exe_cash_amt;
                }

                if (isset($dir) && $designation_id == 4) {
                    $execut_value = ($mv_per_sqft * $executive_percentage) / 100; // executive percentage
                    $total_exe_per = $plot_sqft * $execut_value;
                    $exe_percentage_amt = $exe_percentage_amt + $total_exe_per;
                } else if (isset($dir) && $designation_id == 3) {

                    $supervisor_values = ($mv_per_sqft * $supervisor_percentage) / 100;
                    $super__per_amt = $plot_sqft * $supervisor_values;
                    $s_percentage_amount = $supervisor_percentage_amt + $super__per_amt;

                    $execut_values = ($mv_per_sqft * $executive_percentage) / 100;
                    $total_exe_per = $plot_sqft * $execut_values;
                    $e_percentage_amount = $exe_percentage_amt + $total_exe_per;

                    $exe_percentage_amt = $s_percentage_amount + $e_percentage_amount;
                } else if (isset($dir) && $designation_id == 2) {

                    $supervisor_values = ($mv_per_sqft * $supervisor_percentage) / 100;
                    $super__per_amt = $plot_sqft * $supervisor_values;
                    $s_percentage_amount = $supervisor_percentage_amt + $super__per_amt;

                    $execut_values = ($mv_per_sqft * $executive_percentage) / 100;
                    $total_exe_per = $plot_sqft * $execut_values;
                    $e_percentage_amount = $exe_percentage_amt + $total_exe_per;

                    $manager_per_value = ($mv_per_sqft * $manager_percentage) / 100;
                    $m_percentage_amount = $plot_sqft * $manager_per_value;

                    $exe_percentage_amt = $s_percentage_amount + $e_percentage_amount + $m_percentage_amount;
                } else if (isset($dir) && $designation_id == 1) {

                    $supervisor_values = ($mv_per_sqft * $supervisor_percentage) / 100;
                    $super__per_amt = $plot_sqft * $supervisor_values;
                    $s_percentage_amount = $supervisor_percentage_amt + $super__per_amt;

                    $execut_values = ($mv_per_sqft * $executive_percentage) / 100;
                    $total_exe_per = $plot_sqft * $execut_values;
                    $e_percentage_amount = $exe_percentage_amt + $total_exe_per;

                    $manager_per_value = ($mv_per_sqft * $manager_percentage) / 100;
                    $m_percentage_amount = $plot_sqft * $manager_per_value;

                    $director_per = ($mv_per_sqft * $director_percentage) / 100;
                    $d_percentage_amount = $plot_sqft * $director_per;

                    $exe_percentage_amt = $s_percentage_amount + $e_percentage_amount + $m_percentage_amount + $d_percentage_amount;
                }

                if (isset($dir) && $designation_id == 4) {
                    $executive_cash_amt = $plot_sqft * $executive_cash;  // executive cash

                } else if (isset($dir) && $designation_id == 3) {
                    $sup_cash_amount = $plot_sqft * $supervisor_cash;
                    $exe_cash_amount = $plot_sqft * $executive_cash;
                    $executive_cash_amt = $sup_cash_amount + $exe_cash_amount;
                } else if (isset($dir) && $designation_id == 2) {
                    $executive_cash_amount = $plot_sqft * $executive_cash;
                    $super_cash_amount = $plot_sqft * $supervisor_cash;
                    $manager_cash_amount = $plot_sqft * $manager_cash;
                    $executive_cash_amt = $manager_cash_amount + $super_cash_amount + $executive_cash_amount;
                } else if (isset($dir) && $designation_id == 1) {
                    $executive_cash_amount = $plot_sqft * $executive_cash;
                    $super_cash_amount = $plot_sqft * $supervisor_cash;
                    $manager_cash_amount = $plot_sqft * $manager_cash;
                    $direct_cash_amt = $plot_sqft * $director_cash;
                    $executive_cash_amt = $manager_cash_amount + $super_cash_amount + $executive_cash_amount + $direct_cash_amt;
                }
            }
            $html = '';
            if ($dir != null) {
                $total_marketer_amt = 0;
                if ($commission_type == 1) {
                    $total_marketer_amt = $exe_percentage_amt;
                } else {
                    $total_marketer_amt = $executive_cash_amt;
                }

                $com_bal = CommissionCashIssue::where('project_id', $project->id)->where('plot_id', $plot->id)->where('plan', $plan)->where('marketer_id', $marketer->marketer_id)->orderBy('id', 'desc')->first();
                $c_balance = '';
                if (!empty($com_bal) && $com_bal != null) {
                    $c_balance = $com_bal->comm_balance;
                } else {
                    $c_balance = $total_marketer_amt;
                }

                $html .= '<tr>
                            <td>1</td>
                            <td>' . $dir->reference_code . '</td>
                            <td>' . $dir->designation . '</td>
                            <td>' . $dir->name . '</td>
                            <td>' . $dir->mobile_no . '</td>';
                if ($commission_type == 1) {
                    $html .= '  <td><input type="hidden" id="commission_amt_1_' . $marketer->marketer_id . '" class="commission_amt" value="' . $exe_percentage_amt . '">' . number_format($exe_percentage_amt, 2) . '</td>
                 ';
                } else {

                    $html .= '  <td><input type="hidden" id="commission_amt_1_' . $marketer->marketer_id  . '" class="commission_amt" value="' . $executive_cash_amt . '">' . number_format($executive_cash_amt, 2) . '</td>
                 ';
                }
                $html .= ' <td><button type="button" class="btn btn-sm btn-primary" onclick="isCheckedById(' . $marketer->marketer_id . ',' . $project_id . ',' . $plot_id . ',' . $total_marketer_amt . ')" >Issue</button></td>
                        <td><input type="hidden" id="comm_bal_1_' . $marketer->marketer_id . '" class="commission_balance" value="' . $c_balance . '">
                        <span id="comm_text_1_' . $marketer->marketer_id . '">' . number_format($c_balance, 2) . '</span></td>';
                $html .= '<td><button class="btn btn-primary btn-sm" onclick="Marketer_history_show(' . $project_id . ',' . $plot_id . ',' . $marketer->marketer_id  . ')">History</button></td>';
                $html .=   '<td><button type="button" class="btn btn-flickr btn-sm"><i class="fa fa-flickr me-2"></i>Message</button></td>
                        </tr>';
            }
            if ($director != null) {
                $total_marketer_amt = 0;
                if ($commission_type == 1) {
                    $total_marketer_amt = $director_percentage_amt;
                } else {
                    $total_marketer_amt = $director_cash_amt;
                }
                $d_com = CommissionCashIssue::where('project_id', $project->id)->where('plot_id', $plot->id)->where('plan', $plan)->where('marketer_id', $director->user_id)->orderBy('id', 'desc')->first();
                $d_balance = '';
                if (!empty($d_com) && $d_com != null) {
                    $d_balance = $d_com->comm_balance;
                } else {
                    $d_balance = $total_marketer_amt;
                }
                $html .= '<tr>
                            <td>2</td>
                            <td>' . $director->reference_code . '</td>
                            <td>' . $director->designation . '</td>
                            <td>' . $director->name . '</td>
                            <td>' . $director->mobile_no . '</td>';
                if ($commission_type == 1) {
                    $html .= '  <td><input type="hidden" id="commission_amt_1_' . $director->user_id  . '" class="commission_amt" value="' . $director_percentage_amt . '">' . number_format($director_percentage_amt, 2) . '</td>
                    ';
                } else {
                    $html .= '  <td><input type="hidden" id="commission_amt_1_' . $director->user_id  . '" class="commission_amt" value="' . $director_cash_amt . '">' . number_format($director_cash_amt, 2) . '</td>
                   ';
                }
                $html .= '<td><button type="button" class="btn btn-sm btn-primary" onclick="isCheckedById(' . $director->user_id . ',' . $project_id . ',' . $plot_id . ',' . $total_marketer_amt . ')" >Issue</button></td> <td><input type="hidden" id="comm_bal_1_' . $director->user_id  . '" class="commission_balance" value="' . $d_balance . '">
                <span id="comm_text_1_' . $director->user_id  . '">' . number_format($d_balance, 2) . '</span></td>';
                $html .= '<td><button class="btn btn-primary btn-sm" onclick="Marketer_history_show(' . $project_id . ',' . $plot_id . ',' . $director->user_id  . ')">History</button></td>';
                $html .=   '<td><button type="button" class="btn btn-flickr btn-sm"><i class="fa fa-flickr me-2"></i>Message</button></td>
                 </tr>';
            }
            if ($m_manager != null) {
                $total_marketer_amt = 0;
                if ($commission_type == 1) {
                    $total_marketer_amt = $manager_percentage_amt;
                } else {
                    $total_marketer_amt = $manager_cash_amt;
                }
                $m_com = CommissionCashIssue::where('project_id', $project->id)->where('plot_id', $plot->id)->where('plan', $plan)->where('marketer_id', $m_manager->user_id)->orderBy('id', 'desc')->first();
                $m_balance = '';
                if (!empty($m_com) && $m_com != null) {
                    $m_balance = $m_com->comm_balance;
                } else {
                    $m_balance = $total_marketer_amt;
                }
                $html .= '<tr>
                            <td>3</td>
                            <td>' . $m_manager->reference_code . '</td>
                            <td>' . $m_manager->designation . '</td>
                            <td>' . $m_manager->name . '</td>
                            <td>' . $m_manager->mobile_no . '</td>';
                if ($commission_type == 1) {
                    $html .= '  <td><input type="hidden" id="commission_amt_1_' . $m_manager->user_id . '" class="commission_amt" value="' . $manager_percentage_amt . '">' . number_format($manager_percentage_amt, 2) . '</td>
                    ';
                } else {
                    $html .= '  <td><input type="hidden" id="commission_amt_1_' . $m_manager->user_id  . '" class="commission_amt" value="' . $manager_cash_amt . '">' . number_format($manager_cash_amt, 2) . '</td>
                   ';
                }
                $html .= '<td><button type="button" class="btn btn-sm btn-primary" onclick="isCheckedById(' . $m_manager->user_id  . ',' . $project_id . ',' . $plot_id . ',' . $total_marketer_amt . ')" >Issue</button></td>
                <td><input type="hidden" id="comm_bal_1_' . $m_manager->user_id  . '" class="commission_balance" value="' . $m_balance . '">
                <span id="comm_text_1_' . $m_manager->user_id  . '">' . number_format($m_balance, 2) . '</span></td>';
                $html .= '<td><button class="btn btn-primary btn-sm" onclick="Marketer_history_show(' . $project_id . ',' . $plot_id . ',' . $m_manager->user_id  . ')">History</button></td>';
                $html .= '<td><button type="button" class="btn btn-flickr btn-sm"><i class="fa fa-flickr me-2"></i>Message</button></td>
                        </tr>';
            }
            if ($m_supervior != null) {
                $total_marketer_amt = 0;
                if ($commission_type == 1) {
                    $total_marketer_amt = $supervisor_percentage_amt;
                } else {
                    $total_marketer_amt = $supervisor_cash_amt;
                }
                $s_com = CommissionCashIssue::where('project_id', $project->id)->where('plot_id', $plot->id)->where('plan', $plan)->where('marketer_id', $m_supervior->user_id)->orderBy('id', 'desc')->first();
                $s_balance = '';
                if (!empty($s_com) && $s_com != null) {
                    $s_balance = $s_com->comm_balance;
                } else {
                    $s_balance = $total_marketer_amt;
                }
                $html .= '<tr>
                            <td>4</td>
                            <td>' . $m_supervior->reference_code . '</td>
                            <td>' . $m_supervior->designation . '</td>
                            <td>' . $m_supervior->name . '</td>
                            <td>' . $m_supervior->mobile_no . '</td>';
                if ($commission_type == 1) {
                    $html .= '  <td><input type="hidden" id="commission_amt_1_' . $m_supervior->user_id  . '" class="commission_amt" value="' . $supervisor_percentage_amt . '">' . number_format($supervisor_percentage_amt, 2) . '</td>
                    ';
                } else {

                    $html .= '  <td><input type="hidden" id="commission_amt_1_' . $m_supervior->user_id  . '" class="commission_amt" value="' . $supervisor_cash_amt . '">' . number_format($supervisor_cash_amt, 2) . '</td>
                    ';
                }
                $html .= '<td><button type="button" class="btn btn-sm btn-primary" onclick="isCheckedById(' . $m_supervior->user_id . ',' . $project_id . ',' . $plot_id . ',' . $total_marketer_amt . ')" >Issue</button></td>
                <td><input type="hidden" id="comm_bal_1_' . $m_supervior->user_id  . '" class="commission_balance" value="' . $s_balance . '">
                <span id="comm_text_1_' . $m_supervior->user_id  . '">' . number_format($s_balance, 2) . '</span></td>';
                $html .= '<td><button class="btn btn-primary btn-sm" onclick="Marketer_history_show(' . $project_id . ',' . $plot_id . ',' . $m_supervior->user_id  . ')">History</button></td>';
                $html .= '<td><button type="button" class="btn btn-flickr btn-sm"><i class="fa fa-flickr me-2"></i>Message</button></td>
                        </tr>';
            }
            $html .= '<tr>
                        <td colspan="5">
                            <h6 class="fw-bold text-end text-danger">Total :</h6>
                        </td>
                        <td>
                            <h6 class="fw-bold text-success" id="total_com_amt">0.00</h6>
                        </td>
                        <td></td>
                        <td>
                            <h6 class="fw-bold text-success" id="total_com_bal">0.00</h6>
                        </td>
                         <td></td>
                    </tr>';
            return response()->json(['status' => true, 'marketer' => $user, 'html' => $html, 'mv_per_sqft' => $mv_per_sqft], 200);
        }
        return response()->json(['status' => false, 'message' => 'No Data Found'], 400);
    }


    public function get_marketer_comm(Request $request)
    {

        if ($request->user_id != "") {
            $user = DB::table('users')->select('users.*', 'designation.designation as designation_name', 'users.id as user_id')
                ->leftJoin('designation', 'designation.id', '=', 'users.designation_id')->where('users.id', $request->user_id)->first();
            $project = ProjectDetail::where('id', $request->project_id)->first();
            $project_name = '';
            $com_type = '';
            if (isset($project)) {
                $project_name = $project->short_name;
                $com_type = $project->commission_type;
            }
            $plot = PlotManagement::where('id', $request->plot_id)->first();
            $plot_no = '';
            if (isset($plot)) {
                $plot_no = $plot->plot_no;
            }
            $plan = '';
            if (!empty($request->plan)) {
                $plan = $request->plan;
            }
            // $comm = CommissionDetail::where('project_id', $request->project_id)->where('designation_id', $user->designation_id)->where('plan', '=', 1)->first();
            $count = CommissionCashIssue::count();
            $com_balance = CommissionCashIssue::where('project_id', $project->id)->where('plot_id', $plot->id)->where('plan', $plan)->where('marketer_id', $user->user_id)->orderBy('id', 'desc')->first();
            $html = '';
            // if ($user != null && $project != null && $plot != null && $com_balance != null) {
            $html .= '<tr>
                        <td><input type="hidden" name="mobile_no" id="cm_mobile_no" value="' . $user->mobile_no . '">
                                <input type="hidden" name="designation_id" id="cm_designation_id" value="' . $user->designation_id . '">
                                <input type="hidden" name="marketer_id" id="cm_marketer_id" value="' . $user->user_id . '">1
                        </td>
                        <td><input type="hidden" name="project_id" id="cm_project_id" value="' . $project->id . '">' . $project_name . '</td>
                        <td><input type="hidden" name="plot_id" id="cm_plot_id" value="' . $plot->id . '">' . $plot_no . '</td>';

            if ($count == 0) {
                $html .= '<td><input type="hidden" name="commission_id" id="cm_commission_id" value="1">1</td>';
            } else {
                $html .= '<td><input type="hidden" name="commission_id" id="cm_commission_id" value="' . ($count + 1) . '">' . ($count + 1) . '</td>';
            }

            $html .= ' <td><input type="hidden" name="reference_code" value="' . $user->reference_code . '">' . $user->reference_code . '</td>
                   <td><input type="hidden" name="name" value="' . $user->name . '">' . $user->name . '</td>';
            if ($com_type == 1) {
                $remain_balance = '';
                if (!empty($com_balance) && $com_balance != null) {
                    $remain_balance = $com_balance->comm_balance;
                } else {
                    $remain_balance = '';
                }
                $html .= ' <td><input type="hidden" id="m_comm_amt_1" name="comm_amount" id="cm_comm_amount" class="m_commission_amt" value="' . $remain_balance . '"><span id="marketer_commission_amt_text">' . $remain_balance . '</span></td>';
            } else {
                $remain_balance = '';
                if (!empty($com_balance) && $com_balance != null) {
                    $remain_balance = $com_balance->comm_balance;
                } else {
                    $remain_balance = '';
                }
                $html .= ' <td><input type="hidden" id="m_comm_amt_1" name="comm_amount"  class="m_commission_amt" value="' . $remain_balance . '"><span id="marketer_commission_amt_text">' . $remain_balance . '</span></td>';
            }

            $html .= ' <td><input type="text" name="" id="com_issued" value="" class="form-control" data-user_id="' . $user->user_id . '" autocomplete="off"></td>
                           <td><label class="custom-control custom-checkbox"><input class="custom-control-input issue_com" id="issue_com_1" type="checkbox" onclick="issuedCheckedCom(' . $user->user_id . ')" value=""><span class="custom-control-label "></span></label></td>
                          </tr>';
            $html .= '<tr>
                            <td colspan="6"><h6 class="fw-bold text-end text-danger">Total :</h6></td><td><h6 class="fw-bold text-success" id="total_marketer_com_amt">0.00</h6></td>
                        <td><input type="hidden" name="tot_remain_bal" id="tot_remain_bal" value=""><h6 class="fw-bold text-success" id="total_marketer_com_issue_amt">0.00</h6></td><td></td></tr>';


            $btn = '';
            $btn .= '<div class="d-flex align-items-center justify-content-end mt-3"> <button type="submit" class="btn btn-primary comm_issue_btn me-2" disabled>Issue</button>
                    </div>';
            return response()->json(['status' => true, 'html' => $html, 'btn' => $btn], 200);
            // }
        }
        return response()->json(['status' => false, 'message' => 'No Data Found'], 400);
    }
    public function store(Request $request)
    {
        $val = $request->validate([
            'project_id' => 'required',
            'plot_id' => 'required',
            'plan' => 'required',
            'commission_id' => 'required',
            'marketer_id' => 'required',
            'reference_code' => 'required',
            'designation_id' => 'required',
            'name' => 'required',
            'mobile_no' => 'required',
            'comm_amount' => 'required',
            'comm_issued' => 'required',
            'comm_balance' => 'required',
        ]);
        // dd($val);
        $id = $request->marketer_id;
        $current_date = date('Y-m-d');
        $comm = new CommissionCashIssue();
        $comm->project_id = $request->project_id;
        $comm->plan = $request->plan;
        $comm->plot_id = $request->plot_id;
        $comm->commission_id = $request->commission_id;
        $comm->marketer_id = $request->marketer_id;
        $comm->reference_code = $request->reference_code;
        $comm->designation_id = $request->designation_id;
        $comm->name = $request->name;
        $comm->mobile_no = $request->mobile_no;
        $comm->comm_amount = $request->comm_amount;
        $comm->comm_issued = $request->comm_issued;
        $comm->comm_balance = $request->comm_balance;
        $comm->issued_date = $current_date;

        $insert =  $comm->save();

        if ($insert) {
            return response()->json(['status' => true, 'message' => 'Commission Issued Successfully!', 'id' => $id]);
        } else {
            return response()->json(['status' => false, 'message' => 'Commission Issued Failed!']);
        }
    }

    public function get_marketer_history(Request $request)
    {
        if ($request->project_id != '') {
            $project_id = $request->project_id;
            $plot_id = $request->plot_id;
            $marketer_id = $request->user_id;
            $project = ProjectDetail::where('id', $request->project_id)->first();
            $project_name = '';
            if (isset($project)) {
                $project_name = $project->short_name;
            }
            $plot = PlotManagement::where("id", $request->plot_id)->first();
            $plot_no = '';
            if (isset($plot)) {
                $plot_no = $plot->plot_no;
            }
            $user = User::where("id", $request->user_id)->first();
            $marketer_code = '';
            $marketer_name = '';
            if (isset($user)) {
                $marketer_code = $user->reference_code;
                $marketer_name = $user->name;
            }
            $plan = '';
            if (!empty($request->plan)) {
                $plan = $request->plan;
            }
            $result = CommissionCashIssue::where('project_id', $project_id)->where('plot_id', $plot_id)->where('plan', $plan)->where('marketer_id', $marketer_id)->orderBy('id', 'asc')->get();

            $html = '';
            $i = 1;
            $commission_amount = 0;
            foreach ($result as $val) {
                $commission_cash_issue = CommissionCashIssue::where('project_id', $project_id)->where('plot_id', $plot_id)->where('plan', $plan)
                    ->where('marketer_id', $marketer_id)->orderBy('id', 'asc')->first();
                if (!empty($commission_cash_issue) && $commission_cash_issue != null) {
                    $commission_amount = $commission_cash_issue->comm_amount;
                }
                $html .= '<tr>
                        <td>' . $i++ . '</td>
                        <td>' . date('d-m-Y', strtotime($val->issued_date)) . '</td>
                        <td>' . $project_name . '</td>
                        <td>' . $plot_no . '</td>
                        <td>' . $val->commission_id . '</td>
                        <td>' . $marketer_code . '</td>
                        <td>' . $marketer_name . '</td>
                        <td>' . number_format($commission_amount, 2) . '</td>
                        <td>' . number_format($val->comm_issued, 2) . '</td>
                        <td>' . number_format($val->comm_balance, 2) . '</td></tr>';
            }
            return response()->json(['status' => true, 'html' => $html], 200);
        }
        return response()->json(['status' => false, 'message' => 'No Data Found'], 400);
    }
}
