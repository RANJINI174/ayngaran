<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\PlotManagement;
use App\Models\ProjectDetail;
use App\Models\RegistrationExpense;
use App\Models\RegistrationExpenseConfirm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PlotRegistrationExpenseController extends Controller
{
    public function index()
    {
        try {
            // $projects = ProjectDetail::all();
            $projects = DB::table('booking')->select('booking.project_id', 'project_details.short_name')->leftJoin('project_details', 'booking.project_id', '=', 'project_details.id')
                ->whereNotNull('booking.project_id')
                ->where('booking.fully_paid_status', '=', 1)
                 ->whereNull('booking.booking_status')
                // ->whereNull('booking.confirm_status')
                ->distinct()
                ->get();
            return view('plot_registration_expense.index', compact('projects'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }



    public function expense_confirm_lists(Request $request)
    {
        $expenses = DB::table('booking as a')
            ->select('a.*', 'b.*', 'c.*', 'a.id as booking_id', 'a.project_id as b_project_id', 'a.plot_id as b_plot_id')
            ->leftJoin('project_details as b', 'a.project_id', '=', 'b.id')
            ->leftJoin('plot_management as c', 'c.id', '=', 'a.plot_id')
            ->where('a.fully_paid_status', '=', 1)
             ->whereNull('a.booking_status')
            // ->whereNotNull('a.confirm_status')
            ->orderby('a.confirm_status') ->orderby('a.updated_at','asc');

        if ($request->project_id != "") {
            $expenses->where('a.project_id', $request->project_id);
        }
        if ($request->plot_no_id != "") {
            $expenses->where('a.plot_id', $request->plot_no_id);
        }
        if (isset($request->status)) {
            if ($request->status == 1) {
                $expenses->whereNotNull('a.confirm_status');
            } else if ($request->status == 0) {
                $expenses->whereNull('a.confirm_status');
            }
        }
        $expense_confirm_lists = $expenses->get();
        $html = '';
        $sno = 1;
        $c = 0;
        $customer_name = '';

        foreach ($expense_confirm_lists  as $val) {
            $c++;
            $total_gl_val = $val->total_value_gl;
            $stamp_duty = $val->stamp_duty;
            $stamp_duty_value = ($total_gl_val * $stamp_duty) / 100;

            $dd_charge = $val->dd_charge;
            $dd_charge_value = ($total_gl_val * $dd_charge) / 100;

            $extra_page_values = $val->extra_page_fees;
            $computer_fees_values = $val->computer_fees;
            $cd_val = $val->cd;
            $sub_division_fees_val = $val->sub_division_fees;
            $register_office_val = $val->register_office;
            $writer_fees_val = $val->writer_fees;
            $ec_val = $val->ec;
            $other_expense_val = $val->other_expense;

            $total_1 = $stamp_duty_value + $dd_charge_value;
            $total_2 = $total_1 + $extra_page_values;
            $total_3 = $total_2 + $computer_fees_values;
            $total_4 = $total_3 + $cd_val;
            $total_5 = $total_4 + $sub_division_fees_val;
            $total_6 = $total_5 + $register_office_val;
            $total_7 = $total_6 + $writer_fees_val;
            $total_8 = $total_7 + $ec_val;
            $total_9 = $total_8 + $other_expense_val;

            $customer_name = '';
            $booking = Booking::where('project_id', $val->b_project_id)->where('plot_id', $val->b_plot_id)->first();
            if (isset($booking->customer_id)) {
                $get_customer_details = Booking::where('id', $booking->customer_id)->first();
                if (isset($get_customer_details)) {
                    $customer_name = $get_customer_details->customer_name;
                }
            } else {
                $customer_name = $booking->customer_name;
            }

            
  
            
            $expense = RegistrationExpense::where('project_id', $val->b_project_id)->where('plot_id', $val->b_plot_id)->first();
            $expense_id = 0;
            $stamp = 0;
            $dd = 0;
            $extra_page_charge = 0;
            $com_fees = 0;
            $cd = 0;
            $sub_div_fees = 0;
            $register_office = 0;
            $writer_fees = 0;
            $ec = 0;
            $other_expense = 0;
            if (isset($expense->stamp_duty)) {
                $stamp = $expense->stamp_duty;
                $expense_id = $expense->id;
            } else {
                $stamp = $stamp_duty_value;
            }

            if (isset($expense->dd_charge)) {
                $dd = $expense->dd_charge;
            } else {
                $dd = $dd_charge_value;
            }
            if (isset($expense->extra_page_fees)) {
                $extra_page_charge = $expense->extra_page_fees;
            } else {
                $extra_page_charge = $val->extra_page_fees;
            }
            if (isset($expense->computer_fees)) {
                $com_fees = $expense->computer_fees;
            } else {
                $com_fees = $val->computer_fees;
            }
            if (isset($expense->cd)) {
                $cd = $expense->cd;
            } else {
                $cd = $val->cd;
            }
            if (isset($expense->sub_div_fees)) {
                $sub_div_fees = $expense->sub_div_fees;
            } else {
                $sub_div_fees = $val->sub_division_fees;
            }
            if (isset($expense->register_office)) {
                $register_office = $expense->register_office;
            } else {
                $register_office = $val->register_office;
            }
            if (isset($expense->writer_fees)) {
                $writer_fees = $expense->writer_fees;
            } else {
                $writer_fees = $val->writer_fees;
            }
            if (isset($expense->ec)) {
                $ec = $expense->ec;
            } else {
                $ec = $val->ec;
            }
            if (isset($expense->other_expense) && $expense->other_expense !="") {
                $other_expense = $expense->other_expense;
            } else if (isset($val->other_expense) &&  $val->other_expense !=""){
                $other_expense = $val->other_expense;
            }
            if (isset($expense->reg_expense_by)) {
                $reg_exp_by_select = $expense->reg_expense_by;
            } else {
                $reg_exp_by_select = $val->reg_expense;
            }
            $html .= "<tr>";
            $html .= "<td style='vertical-align: middle;'><input type='hidden' name='project_id[]' value='" . $val->b_project_id . "'>" . $sno++ . "</td>";
            $html .= "<td style='vertical-align: middle;'><input type='hidden' name='booking_id[]' class='booking_id' value='" . $val->booking_id . "'>" . $val->short_name . "</td>";
            $html .= "<td style='vertical-align: middle;'> <input type='hidden' name='customer_name[]'  id='customer_name' value='" . $customer_name . "'>" . $customer_name . "</td>";
            $html .= "<td style='vertical-align: middle;'><input type='hidden' name='plot_id[]' value='" . $val->b_plot_id . "'>" . $val->plot_no . "</td>";
            $html .= "<td style='vertical-align: middle;'><input type='hidden' name='plot_sq_ft[]' class='plot_sq_ft'  id='plot_sq_ft_" . $val->booking_id . "_1'  value='" . $val->plot_sq_ft . "'>" . $val->plot_sq_ft . "</td>";

            $html .= "<td><input type='hidden' name='expense_id[]' value='" . $expense_id . "'>
            <input type='text' name='stamp_duty[]' class='form-control stamp_duty h_tot_exp'  id='stamp_duty_" . $val->booking_id . "_1'   value='" . $stamp . "' 
            onkeyup='New_expense_val(" . $val->booking_id . ")'>
            <input type='hidden'  id='booking_date_" . $val->booking_id . "_1' name='booking_date[]' value='" . $val->receipt_date . "'>
            
            </td>";
            $html .= "<td><input type='text' name='dd_charge[]' class='form-control dd_charge h_tot_exp' id='dd_charge_" . $val->booking_id . "_1'  value='" . $dd . "' onkeyup='New_expense_val(" . $val->booking_id . ")'></td>";
            $html .= "<td><input type='text' name='extra_page_fees[]' class='form-control extra_page_fees h_tot_exp' id='extra_page_" . $val->booking_id . "_1'  value='" . $extra_page_charge . "' onkeyup='New_expense_val(" . $val->booking_id . ")'></td>";
            $html .= "<td><input type='text' name='computer_fees[]' class='form-control computer_fees h_tot_exp'  id='computer_fees_" . $val->booking_id . "_1' value='" . $com_fees . "' onkeyup='New_expense_val(" . $val->booking_id . ")'></td>";
            $html .= "<td><input type='text' name='cd[]' class='form-control cd h_tot_exp' value='" . $cd . "' id='cd_" . $val->booking_id . "_1' onkeyup='New_expense_val(" . $val->booking_id . ")'></td>";
            $html .= "<td><input type='text' name='sub_division_fees[]' class='form-control sub_division_fees' id='sub_division_" . $val->booking_id . "_1'  value='" . $sub_div_fees . "' onkeyup='New_expense_val(" . $val->booking_id . ")'></td>";
            $html .= "<td><input type='text' name='register_office[]' class='form-control register_office h_tot_exp' id='reg_off_" . $val->booking_id . "_1'  value='" . $register_office . "' onkeyup='New_expense_val(" . $val->booking_id . ")'></td>";
            $html .= "<td><input type='text' name='writter_fees[]' class='form-control writter_fees h_tot_exp'  id='writer_fees_" . $val->booking_id . "_1' value='" . $writer_fees . "' onkeyup='New_expense_val(" . $val->booking_id . ")'></td>";
            $html .= "<td><input type='text' name='ec[]' class='form-control ec h_tot_exp' id='ec_" . $val->booking_id . "_1' value='" . $ec . "' onkeyup='New_expense_val(" . $val->booking_id . ")'></td>";
            $html .= "<td><input type='text' name='other_expense[]' class='form-control other_expense h_tot_exp'id='other_exp_" . $val->booking_id . "_1'  value='" . $other_expense . "' onkeyup='New_expense_val(" . $val->booking_id . ")'></td>";
            $html .= "<td><input type='text' class='form-control total_expense'id='total_expenses_" . $val->booking_id . "_1'  value='" . $total_9 . "'  readonly></td>";
            
           $html .= '<td><select id="reg_expense_' . $val->booking_id . '_1" name="reg_expense_select[]" class="form-control reg_expense_select" onchange="regExpenseChange(' . $val->booking_id . ')"
           ><option value="">Select Expense</option><option value="1" ' . (($reg_exp_by_select == 1) ? 'selected' : '') . '>Company</option><option value="2" ' . (($reg_exp_by_select == 2) ? 'selected' : '') . '>Customer</option></select></td>';
           
            if ($val->confirm_status == 1) {
                $html .= '<td><h6 class="fs-14 fw-bold text-end pt-2 text-success">Completed</h6></td>';
            } else {
                $html .= '<td><h6 class="fs-14 fw-bold text-end pt-2 text-success">Pending</h6></td>';
            }
            if ($val->confirm_status == 1) {
                $html .= '<td><label class="custom-control custom-checkbox mt-2"><input name="selected_val[]" class="custom-control-input selected_val" id="selected_val' . $val->booking_id . '_1" type="checkbox"  onclick="isCheckedById(' . $val->booking_id . ')" value="' . $val->booking_id . '" checked disabled><span class="custom-control-label "> </span></label></td>';
            } else {
                $html .= '<td><label class="custom-control custom-checkbox mt-2"><input name="selected_val[]" class="custom-control-input selected_val" id="selected_val' . $val->booking_id . '_1" type="checkbox"  onclick="isCheckedById(' . $val->booking_id . ')" value="' . $val->booking_id . '"><span class="custom-control-label "> </span></label></td>';
            }

            $html .= "</tr>";
        }
        // total calculation row
        $html .= "<tr>";
        $html .= "<td colspan='4'><h6 class='text-end fw-bold text-danger'>Total :</h6> </td>";
        $html .= "<td><input text='text' id='total_plot_sqft' class='form-control' style='width:130px; font-weight:bold;' readonly></td>";
        $html .= "<td><input text='text' id='total_stamp_duty' class='form-control' style='width:130px; font-weight:bold;' readonly></td>";
        $html .= "<td><input text='text' id='total_dd_charge' class='form-control' style='width:130px; font-weight:bold;' readonly></td>";
        $html .= "<td><input text='text' id='total_extra_page_fees' class='form-control' style='width:140px; font-weight:bold;' readonly></td>";
        $html .= "<td><input text='text' id='total_computer_fees' class='form-control' style='width:130px; font-weight:bold;' readonly></td>";
        $html .= "<td><input text='text' id='total_cd' class='form-control' style='width:130px; font-weight:bold;' readonly></td>";
        $html .= "<td><input text='text' id='total_sub_division_fees' class='form-control' style='width:130px; font-weight:bold;' readonly></td>";
        $html .= "<td><input text='text' id='total_register_office' class='form-control' style='width:130px; font-weight:bold;' readonly></td>";
        $html .= "<td><input text='text' id='total_writter_fees' class='form-control' style='width:130px; font-weight:bold;' readonly></td>";
        $html .= "<td><input text='text' id='total_ec' class='form-control' style='width:130px; font-weight:bold;' readonly></td>";
        $html .= "<td><input text='text' id='total_other_expense' class='form-control' style='width:130px; font-weight:bold;' readonly></td>";
        $html .= "<td><input text='text' id='total_expenses' class='form-control' style='width:130px; font-weight:bold;' readonly></td>";
        $html .= "<td colspan='3'></td>";
        $html .= "</tr>";
        // selected calculation row
        $html .= "<tr>";
        $html .= "<td colspan='4'><h6 class='text-end text-danger fw-bold'>Selected(<span id='change_count'>0</span>) : </h6><input type='hidden' id='sel_count_r' value='0'></td>";
        $html .= "<td><input text='text'  id='select_plot_sqft' class='form-control text-success' value='0' style='font-weight:bold;' readonly></td>";
        $html .= "<td><input text='text'  id='select_stamp_duty' class='form-control text-success' value='0' style='font-weight:bold;' readonly></td>";
        $html .= "<td><input text='text'  id='select_dd_charge' class='form-control text-success' value='0' style='font-weight:bold;' readonly></td>";
        $html .= "<td><input text='text'  id='select_extra_page_fees' class='form-control text-success' style='font-weight:bold;' value='0' readonly></td>";
        $html .= "<td><input text='text'  id='select_computer_fees' class='form-control text-success' style='font-weight:bold;' value='0' readonly></td>";
        $html .= "<td><input text='text'  id='select_cd' class='form-control text-success' value='0' style='font-weight:bold;' readonly></td>";
        $html .= "<td><input text='text'  id='select_sub_division_fees' class='form-control text-success' style='font-weight:bold;' value='0' readonly></td>";
        $html .= "<td><input text='text'  id='select_register_office' class='form-control text-success' style='font-weight:bold;' value='0' readonly></td>";
        $html .= "<td><input text='text'  id='select_writter_fees' class='form-control text-success' style='font-weight:bold;' value='0' readonly></td>";
        $html .= "<td><input text='text'  id='select_ec' class='form-control text-success' value='0' style='font-weight:bold;' readonly></td>";
        $html .= "<td><input text='text'  id='select_other_expense' class='form-control text-success' style='font-weight:bold;' value='0' readonly></td>";
        $html .= "<td><input text='text'  id='select_total_expenses' class='form-control text-success' value='0' style='font-weight:bold;' readonly></td>";
        $html .= "<td colspan='3'></td>";
        $html .= "</tr>";

        return response()->json(['status' => true, 'html' => $html, 'count' => count($expense_confirm_lists)], 200);
    }



    public function get_plot_registration_detail(Request $request)
    {
        if ($request->project_id != "") {
            $project_id = $request->project_id;
            $plot_id = $request->plot_id;
            $res_expense_by = ProjectDetail::where("id", $project_id)->first();
            $plot_nos = DB::table('booking as a')
                ->select('a.*', 'b.*', 'c.*', 'a.id as booking_id')
                ->leftJoin('project_details as b', 'a.project_id', '=', 'b.id')
                ->leftJoin('plot_management as c', 'c.id', '=', 'a.plot_id')
                ->where('a.project_id', $project_id)
                ->where('a.fully_paid_status', '=', 1)->get();
            $total_gl_value = '';
            $confirm_status = '';
            $booking = Booking::where("project_id", $project_id)->where('plot_id', $plot_id)->first();
            if (isset($booking)) {
                $total_gl_value = $booking->total_value_gl;
                $confirm_status = $booking->confirm_status;
            } else {
                $total_gl_value = '';
            }
            return response()->json(['status' => true, 'res_expense_by' => $res_expense_by, 'plot_nos' => $plot_nos, 'gl_value' => $total_gl_value, 'confirm_status' => $confirm_status], 200);
        }
        return response()->json(['status' => false, 'message' => 'No Data Found'], 400);
    }

    // public function get_plot_no_expense_details(Request $request)
    // {

    //     $expenses = DB::table('booking as a')
    //         ->select('a.*', 'b.*', 'c.*', 'a.id as booking_id')
    //         ->leftJoin('project_details as b', 'b.id', '=', 'a.project_id')
    //         ->leftJoin('plot_management as c', 'c.id', '=', 'a.plot_id')
    //         ->where('a.project_id', '=', $request->project_id);

    //     if ($request->plot_no_id != "") {
    //         $expenses->where('a.plot_id', $request->plot_no_id);
    //     }
    //     if (isset($request->status)) {
    //         if ($request->status == 1) {
    //             $expenses->whereNotNull('a.confirm_status');
    //         } else if ($request->status == 0) {
    //             $expenses->whereNull('a.confirm_status');
    //         }
    //     }
    //     $expense_details = $expenses->get();
    //     $html = '';
    //     $sno = 1;
    //     $c = 0;
    //     $total_1 = '';
    //     foreach ($expense_details  as $val) {
    //         $c++;

    //         $total_gl_val = $val->total_value_gl;
    //         $stamp_duty = $val->stamp_duty;
    //         $stamp_duty_value = ($total_gl_val * $stamp_duty) / 100;

    //         $dd_charge = $val->dd_charge;
    //         $dd_charge_value = ($total_gl_val * $dd_charge) / 100;

    //         $extra_page_values = $val->extra_page_fees;
    //         $computer_fees_values = $val->computer_fees;
    //         $cd_val = $val->cd;
    //         $sub_division_fees_val = $val->sub_division_fees;
    //         $register_office_val = $val->register_office;
    //         $writer_fees_val = $val->writer_fees;
    //         $ec_val = $val->ec;
    //         $other_expense_val = $val->other_expense;

    //         $total_1 = $stamp_duty_value + $dd_charge_value;
    //         $total_2 = $total_1 + $extra_page_values;
    //         $total_3 = $total_2 + $computer_fees_values;
    //         $total_4 = $total_3 + $cd_val;
    //         $total_5 = $total_4 + $sub_division_fees_val;
    //         $total_6 = $total_5 + $register_office_val;
    //         $total_7 = $total_6 + $writer_fees_val;
    //         $total_8 = $total_7 + $ec_val;
    //         $total_9 = $total_8 + $other_expense_val;


    //         $html .= "<tr>";
    //         $html .= "<td>" . $sno++ . "</td>";
    //         $html .= "<td style='vertical-align: middle;'><input type='hidden' name='booking_id[]' class='booking_id' value='" . $val->booking_id . "'>" . $val->short_name . "</td>";
    //         $html .= "<td style='vertical-align: middle;'> <input type='hidden' name='customer_name'  id='customer_name' value='" . $val->customer_name . "'>" . $val->customer_name . "</td>";
    //         $html .= "<td style='vertical-align: middle;'>" . $val->plot_no . "</td>";
    //         $html .= "<td style='vertical-align: middle;'><input type='hidden' name='plot_sq_ft' class='plot_sq_ft'  id='plot_sq_ft_" . $val->booking_id . "_1'  value='" . $val->plot_sq_ft . "'>" . $val->plot_sq_ft . "</td>";
    //         $html .= "<td><input type='text' name='stamp_duty' class='form-control stamp_duty'  id='stamp_duty_" . $val->booking_id . "_1'   value='" . $stamp_duty_value . "'></td>";
    //         $html .= "<td><input type='text' name='dd_charge' class='form-control dd_charge' id='dd_charge_" . $val->booking_id . "_1'  value='" . $dd_charge_value . "'></td>";
    //         $html .= "<td><input type='text' name='extra_page_fees' class='form-control extra_page_fees' id='extra_page_" . $val->booking_id . "_1'  value='" . $val->extra_page_fees . "'></td>";
    //         $html .= "<td><input type='text' name='computer_fees' class='form-control computer_fees'  id='computer_fees_" . $val->booking_id . "_1' value='" . $val->computer_fees . "'></td>";
    //         $html .= "<td><input type='text' name='cd' class='form-control cd' value='" . $val->cd . "' id='cd_" . $val->booking_id . "_1' ></td>";
    //         $html .= "<td><input type='text' name='sub_division_fees' class='form-control sub_division_fees' id='sub_division_" . $val->booking_id . "_1'  value='" . $val->sub_division_fees . "'></td>";
    //         $html .= "<td><input type='text' name='register_office' class='form-control register_office' id='reg_off_" . $val->booking_id . "_1'  value='" . $val->register_office . "'></td>";
    //         $html .= "<td><input type='text' name='writter_fees' class='form-control writter_fees'  id='writer_fees_" . $val->booking_id . "_1' value='" . $val->writer_fees . "'></td>";
    //         $html .= "<td><input type='text' name='ec' class='form-control ec' id='ec_" . $val->booking_id . "_1' value='" . $val->ec . "'></td>";
    //         $html .= "<td><input type='text' name='other_expense' class='form-control other_expense'id='other_exp_" . $val->booking_id . "_1'  value='" . $val->other_expense . "' ></td>";
    //         $html .= "<td><input type='text' name='total_expense' class='form-control total_expense'id='total_expenses_" . $val->booking_id . "_1'  value='" . $total_9 . "'></td>";
    //         if ($val->confirm_status == 1) {
    //             $html .= '<td><h6 class="fs-14 fw-bold text-end pt-2 text-success">Completed</h6></td>';
    //         } else {
    //             $html .= '<td><h6 class="fs-14 fw-bold text-end pt-2 text-success">Pending</h6></td>';
    //         }
    //         if ($val->confirm_status == 1) {
    //             $html .= '<td><label class="custom-control custom-checkbox mt-2"><input name="selected_val[]" class="custom-control-input selected_val" id="selected_val' . $val->booking_id . '_1" type="checkbox"  onclick="isCheckedById(' . $val->booking_id . ')" value="' . $val->booking_id . '" checked><span class="custom-control-label "> </span></label></td>';
    //         } else {
    //             $html .= '<td><label class="custom-control custom-checkbox mt-2"><input name="selected_val[]" class="custom-control-input selected_val" id="selected_val' . $val->booking_id . '_1" type="checkbox"  onclick="isCheckedById(' . $val->booking_id . ')" value="' . $val->booking_id . '"><span class="custom-control-label "> </span></label></td>';
    //         }

    //         $html .= "</tr>";
    //     }
    //     if ($request->reg_expense_by == 1) { // if expense company view
    //         $html .= "<tr>";
    //         $html .= "<td colspan='4'><h6 class='text-end fw-bold text-danger'>Total :</h6> </td>";
    //         $html .= "<td><input text='text' name='total_plot_sqft' id='total_plot_sqft' class='form-control' style='width:130px;' readonly></td>";
    //         $html .= "<td><input text='text' name='total_stamp_duty' id='total_stamp_duty' class='form-control' style='width:130px;' readonly></td>";
    //         $html .= "<td><input text='text' name='total_dd_charge' id='total_dd_charge' class='form-control' style='width:130px;' readonly></td>";
    //         $html .= "<td><input text='text' name='total_extra_page_fees' id='total_extra_page_fees' class='form-control' style='width:140px;' readonly></td>";
    //         $html .= "<td><input text='text' name='total_computer_fees' id='total_computer_fees' class='form-control' style='width:130px;' readonly></td>";
    //         $html .= "<td><input text='text' name='total_cd' id='total_cd' class='form-control' style='width:130px;' readonly></td>";
    //         $html .= "<td><input text='text' name='total_sub_division_fees' id='total_sub_division_fees' class='form-control' style='width:130px;' readonly></td>";
    //         $html .= "<td><input text='text' name='total_register_office' id='total_register_office' class='form-control' style='width:130px;' readonly></td>";
    //         $html .= "<td><input text='text' name='total_writter_fees' id='total_writter_fees' class='form-control' style='width:130px;' readonly></td>";
    //         $html .= "<td><input text='text' name='total_ec' id='total_ec' class='form-control' style='width:130px;' readonly></td>";
    //         $html .= "<td><input text='text' name='total_other_expense' id='total_other_expense' class='form-control' style='width:130px;' readonly></td>";
    //         $html .= "<td><input text='text' name='total_expenses' id='total_expenses' class='form-control' style='width:130px;' readonly></td>";
    //         $html .= "</tr>";
    //         // selected calculation row
    //         $html .= "<tr>";
    //         $html .= "<td colspan='4'><h6 class='text-end text-danger fw-bold'>Selected(<span id='change_count'>0</span>) : </h6><input type='hidden' id='sel_count_r' value='0'></td>";
    //         $html .= "<td><input text='text'  id='select_plot_sqft' class='form-control text-success' value='0'></td>";
    //         $html .= "<td><input text='text'  id='select_stamp_duty' class='form-control text-success' value='0'></td>";
    //         $html .= "<td><input text='text'  id='select_dd_charge' class='form-control text-success' value='0'></td>";
    //         $html .= "<td><input text='text'  id='select_extra_page_fees' class='form-control text-success' value='0'></td>";
    //         $html .= "<td><input text='text'  id='select_computer_fees' class='form-control text-success' value='0'></td>";
    //         $html .= "<td><input text='text'  id='select_cd' class='form-control text-success' value='0'></td>";
    //         $html .= "<td><input text='text'  id='select_sub_division_fees' class='form-control text-success' value='0'></td>";
    //         $html .= "<td><input text='text'  id='select_register_office' class='form-control text-success' value='0'></td>";
    //         $html .= "<td><input text='text'  id='select_writter_fees' class='form-control text-success' value='0'></td>";
    //         $html .= "<td><input text='text'  id='select_ec' class='form-control text-success' value='0'></td>";
    //         $html .= "<td><input text='text'  id='select_other_expense' class='form-control text-success' value='0'></td>";
    //         $html .= "<td><input text='text'  id='select_total_expenses' class='form-control text-success' value='0'></td>";
    //         $html .= "</tr>";
    //     }
    //     return response()->json(['status' => true, 'html' => $html], 200);
    // }




    public function store(Request $request)
    {


        $val =  $request->validate([
            'book_up_id' => 'required'
        ]);

        // $request->validate([
        // 'booking_id'=>'required',
        //     'project_id' => 'required',
        //     'customer_name' => 'required',
        //     'plot_id' => 'required',
        //     'plot_sqft' => 'required',
        //     'stamp_duty' => 'required',
        //     'dd_charge' => 'required',
        //     'extra_page_fees' => 'required',
        //     'computer_fees' => 'required',
        //     'sub_div_fees' => 'required',
        //     'register_office' => 'required',
        //     'writer_fees' => 'required',
        //     'ec' => 'required',
        //     'other_expense' => 'required',

        // ]);

        foreach ($request->booking_id as $key => $val) {
            $exist_expense = RegistrationExpense::where('booking_id', $request->booking_id[$key])
                ->where('project_id', $request->project_id[$key])
                ->count();

            if ($exist_expense > 0) {
                RegistrationExpense::where('booking_id', $request->booking_id[$key])
                    ->where('project_id', $request->project_id[$key])
                    ->update([
                        'project_id' => $request->project_id[$key],
                        'customer_name' => $request->customer_name[$key],
                        'plot_id' => $request->plot_id[$key],
                        'plot_sqft' => $request->plot_sq_ft[$key],
                        'stamp_duty' => $request->stamp_duty[$key],
                        'dd_charge' => $request->dd_charge[$key],
                        'extra_page_fees' => $request->extra_page_fees[$key],
                        'computer_fees' => $request->computer_fees[$key],
                        'cd' => $request->cd[$key],
                        'sub_div_fees' => $request->sub_division_fees[$key],
                        'register_office' => $request->register_office[$key],
                        'writer_fees' => $request->writter_fees[$key],
                        'ec' => $request->ec[$key],
                        'other_expense' => $request->other_expense[$key],
                        'reg_expense_by' => $request->reg_expense_select[$key],
                        'updated_by' => 1,
                    ]);
            } else {
                RegistrationExpense::create([
                    'booking_id' => $request->booking_id[$key],
                    'project_id' => $request->project_id[$key],
                    'customer_name' => $request->customer_name[$key],
                    'plot_id' => $request->plot_id[$key],
                    'plot_sqft' => $request->plot_sq_ft[$key],
                    'stamp_duty' => $request->stamp_duty[$key],
                    'dd_charge' => $request->dd_charge[$key],
                    'extra_page_fees' => $request->extra_page_fees[$key],
                    'computer_fees' => $request->computer_fees[$key],
                    'cd' => $request->cd[$key],
                    'sub_div_fees' => $request->sub_division_fees[$key],
                    'register_office' => $request->register_office[$key],
                    'writer_fees' => $request->writter_fees[$key],
                    'ec' => $request->ec[$key],
                    'other_expense' => $request->other_expense[$key],
                    'reg_expense_by' => $request->reg_expense_select[$key],
                    'created_by' => 1,
                ]);
            }
        }

        $book_id = explode(',', $request->book_up_id);
        for ($i = 0; $i < count($book_id); $i++) {
            $update = Booking::where("id", $book_id[$i])->update([
                'confirm_status' => 1
            ]);
        }

        if ($update) {
            return response()->json(['status' => true, 'message' => 'Registration Expense Confirm Successfully!']);
        } else {
            return response()->json(['status' => false, 'message' => 'Registration Expense Confirm Failed!']);
        }
    }
}
