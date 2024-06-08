<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Director;
use App\Models\Relationship;
use App\Models\Pincode;
use App\Models\Designation;
use App\Models\User;
use App\Models\ProjectType;
use App\Models\MarketingType;
use App\Models\ProjectDetail;
use App\Models\PlotManagement;
use App\Models\PrintTemplateContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProjectDetailController extends Controller
{
    public function index()
    {
        try {
            $project_details = DB::table("project_details")->join("project_type", "project_type.id", '=', "project_details.project_type")
                ->select(
                    "project_details.id",
                    "project_details.project_type",
                    "project_details.full_name",
                    "project_details.short_name",
                    "project_details.marketing_type",
                    "project_details.project_start_date",
                    "project_type.project_type"
                )->orderby('project_details.id','asc')
                ->get();
            return view('project_details.index', compact('project_details'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function create()
    {
        try {
            $branch = Branch::where('status', 1)->get();
            $relations = Relationship::where('status', 1)->get();
            $designation = Designation::where('status', 1)->get();
            $project_type = ProjectType::where('status', 1)->get();
            $marketing_type = MarketingType::where('status', 1)->get();
            $template = PrintTemplateContent::where('status',1)->get();
            return view('project_details.add', compact('branch', 'relations', 'designation', 'project_type', 'marketing_type','template'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function store(Request $request)
    {
        //project details
        $request->validate([
            'short_name' => 'required',
            'full_name' => 'required',
            'landmark' => 'required',
            'project_start_date' => 'required',
            'project_type' => 'required',
            'marketing_type'  => 'required',
            'commission_type' => 'required',
            'branch_id' => 'required',
            'project_incharge' => 'required',
            'incharge_id' => 'required',
            'project_budget' => 'required',
            'guide_line' => 'required',
            // 'market_value' => 'required',
            // 'plan' => 'required',

        ]);

        //payment details
        $request->validate([
            'advance_amount' => 'required',
            // 'advance_refund' => 'required',
            'refund_days' => 'required',
            // 'valididty_days' => 'required',
            // 'valididty_paid' => 'required',
            // 'registration_due_date' => 'required',
            'repay_deduction' => 'required',
            // 'settlement'  => 'required',
            // 'broker_commission' => 'required',
        ]);
        //registration expense
        $request->validate([
            // 'document_value' => 'required',
            // 'document_commission' => 'required',
            'writer_fees' => 'required',
            // 'dd_commission' => 'required',
            'sub_division_fees' => 'required',
            // 'regitration_gift'  => 'required',
            'computer_fees' => 'required',
            // 'customer_gift' => 'required',
            'cd' => 'required',
            // 'ec' => 'required',
            'reg_expense' => 'required',
            // 'other_expense' => 'required',
        ]);
        //SMS Details
        $request->validate([
            // 'advance' => 'required',
            // 'part_payment' => 'required',
            // 'auto_cancel' => 'required',
            // 'manual_cancel' => 'required',
        ]);
        $total_value = 0;
        $total_value_1 = 0;
        if(isset($request->stamp_duty))
        {
            $value =  $request->stamp_duty / 100;
            
            $total_value = $value * $request->guide_line;
        }
        
        // if(isset($request->registration_fees_dd))
        // {
        //     $value_1 =  $request->registration_fees_dd / 100;
            
        //     $total_value_1 = $value_1 * $request->guide_line;
        // }
        
        $check_project_name = ProjectDetail::where('full_name', $request->full_name)->get()->count();
        if ($check_project_name > 0) {
            return response()->json(['status' => false, 'message' => 'Project Name Already Exisit!']);
            
        }

        $check_short_name = ProjectDetail::where('short_name', $request->short_name)->get()->count();

        if ($check_short_name > 0) {
            return response()->json(['status' => false, 'message' => 'Short Name Already Exisit!']);
        }
        
        
        $project = new ProjectDetail();
        $project->short_name = $request->short_name;
        $project->full_name = $request->full_name;
        $project->landmark     = $request->landmark;
        $project->template_id     = $request->template_id;
        $project->project_start_date = $request->project_start_date;
        $project->project_type = $request->project_type;
        $project->marketing_type = $request->marketing_type;
        $project->commission_type = $request->commission_type;
        $project->branch_id = $request->branch_id;
        $project->project_incharge = $request->project_incharge;
        $project->incharge_id = $request->incharge_id;
        $project->project_budget = $request->project_budget;
        $project->guide_line = $request->guide_line;
        $project->market_value = $request->market_value;
        $project->plan = $request->plan;
        $project->market_value_b = $request->market_value_b;
        // $project->plan_b = $request->plan_b;
        $project->market_value_c = $request->market_value_c;
        // $project->plan_c = $request->plan_c;
        $project->advance_amount = $request->advance_amount;
        $project->company_scope = $request->company_scope;
        $project->customer_scope = $request->customer_scope;
        // $project->booking_open = $request->booking_open;
        // $project->registration_due_date = $request->registration_due_date;
        $project->booking_open_days = $request->booking_open_days;
        $project->registration_due_days = $request->registration_due_days;
        $project->repay_deduction = $request->repay_deduction;
        // $project->advance_refund = $request->advance_refund;
        $project->refund_days = $request->refund_days;
        // $project->validity_days = $request->valididty_days;
        // $project->validity_paid = $request->valididty_paid;
        // $project->settlement = $request->settlement;
        // $project->broker_commission = $request->broker_commission;
        $project->stamp_duty = $request->stamp_duty;
        $project->registration_fees_dd = $request->registration_fees_dd;
        $project->stamp_duty_value = $total_value;
        $project->dd_charge = $request->dd_charge;
        // $project->registration_fees_dd_value = $total_value_1;
        $project->extra_page_fees = $request->extra_page_fees;
        $project->register_office = $request->register_office;
        // $project->document_value = $request->document_value;
        // $project->document_commission = $request->document_commission;
        $project->writer_fees = $request->writer_fees;
        // $project->dd_commission = $request->dd_commission;
        $project->sub_division_fees = $request->sub_division_fees;
        // $project->regitration_gift = $request->regitration_gift;
        $project->computer_fees = $request->computer_fees;
        // $project->customer_gift = $request->customer_gift;
        $project->cd = $request->cd;
        $project->ec = $request->ec;
        $project->reg_expense = $request->reg_expense;
        $project->other_expense = $request->other_expense;
        $project->advance = $request->advance;
        $project->part_payment = $request->part_payment;
        $project->auto_cancel = $request->auto_cancel;
        $project->manual_cancel = $request->manual_cancel;
        $project->created_ay = 1;
        $project->updated_by = 1;
        $insert =  $project->save();

        if ($insert) {
            return response()->json(['status' => true, 'message' => 'Project Created Successfully!']);
        } else {
            return response()->json(['status' => false, 'message' => 'Project Creation Failed!']);
        }
    }

    public function introducer_list($id)
    {
        $director = User::where('designation_id', $id)->select('id', 'name')->get();
        return response()->json(['status' => true, 'data' => $director], 200);
    }

    public function introducerid_list($id)
    {
        $director = User::where('id', $id)->select('reference_code')->first();

        return response()->json(['status' => true, 'data' => $director], 200);
    }

    public function edit($id)
    {
        if (!empty($id)) {
            $project = ProjectDetail::where("id", $id)->first();
            $project_incharge = User::where('designation_id', $project->project_incharge)->select('id', 'name')->get();
            $branch = Branch::where('status', 1)->get();
            $relations = Relationship::where('status', 1)->get();
            $designation = Designation::where('status', 1)->get();
            $project_type = ProjectType::where('status', 1)->get();
            $marketing_type = MarketingType::where('status', 1)->get();
            $template = PrintTemplateContent::where('status',1)->get();
            return view('project_details.edit', compact('project', 'project_incharge', 'branch', 'relations', 'designation', 'project_type', 'marketing_type','template'));
        }
        return response()->json(['status' => false, 'message' => 'Director not found!']);
    }

    public function update(Request $request, $id)
    {
        //project details
        $request->validate([
            'short_name' => 'required',
            'full_name' => 'required',
            'landmark' => 'required',
            'project_start_date' => 'required',
            'project_type' => 'required',
            'marketing_type'  => 'required',
            'commission_type' => 'required',
            'branch_id' => 'required',
            'project_incharge' => 'required',
            // 'incharge_id' => 'required',
            'project_budget' => 'required',
            'guide_line' => 'required',
            // 'market_value' => 'required',
            // 'plan' => 'required',

        ]);

        //payment details
        $request->validate([
            'advance_amount' => 'required',
            // 'advance_refund' => 'required',
            'refund_days' => 'required',
            // 'valididty_days' => 'required',
            // 'valididty_paid' => 'required',
            // 'settlement'  => 'required',
            // 'broker_commission' => 'required',
        ]);
        //registration expense
        $request->validate([
            // 'document_value' => 'required',
            // 'document_commission' => 'required',
            'writer_fees' => 'required',
            // 'dd_commission' => 'required',
            'sub_division_fees' => 'required',
            // 'regitration_gift'  => 'required',
            'computer_fees' => 'required',
            // 'customer_gift' => 'required',
            'cd' => 'required',
            // 'ec' => 'required',
            'reg_expense' => 'required',
            // 'other_expense' => 'required',
        ]);
        //SMS Details
        $request->validate([
            // 'advance' => 'required',
            // 'part_payment' => 'required',
            // 'auto_cancel' => 'required',
            // 'manual_cancel' => 'required',
        ]);
        
        
         $check_project_name = ProjectDetail::where('full_name', $request->full_name)->where('id', '!=', $id)->get()->count();
        if ($check_project_name > 0) {
            return response()->json(['status' => false, 'message' => 'Project Name Already Exisit!']);
        }

        $check_short_name = ProjectDetail::where('short_name', $request->short_name)->where('id', '!=', $id)->get()->count();

        if ($check_short_name > 0) {
            return response()->json(['status' => false, 'message' => 'Short Name Already Exisit!']);
        }
        
        
        
        $total_value = 0;
        $total_value_1 = 0;
        if(isset($request->stamp_duty))
        {
            $value =  $request->stamp_duty / 100;
            
            $total_value = $value * $request->guide_line;
        }
        
        if(isset($request->registration_fees_dd))
        {
            $value_1 =  $request->registration_fees_dd / 100;
            
            $total_value_1 = $value_1 * $request->guide_line;
        }

        $data = [];
        $data['short_name'] = $request->short_name;
        $data['full_name'] = $request->full_name;
        $data['landmark'] = $request->landmark;
        $data['template_id'] = $request->template_id;
        $data['project_start_date'] = $request->project_start_date;
        $data['project_type'] = $request->project_type;
        $data['marketing_type'] = $request->marketing_type;
        $data['commission_type'] = $request->commission_type;
        $data['branch_id'] = $request->branch_id;
        $data['project_incharge'] = $request->project_incharge;
        $data['incharge_id'] = $request->incharge_id;
        $data['project_budget'] = $request->project_budget;
        $data['guide_line'] = $request->guide_line;
        // $data['settlement'] = $request->settlement;
        $data['market_value'] = $request->market_value;
        $data['plan'] = $request->plan;
        $data['market_value_b'] = $request->market_value_b;
        // $data['plan_b'] = $request->plan_b;
        $data['market_value_c'] = $request->market_value_c;
        // $data['plan_c'] = $request->plan_c;
        $data['advance_amount'] = $request->advance_amount;
        $data['company_scope'] = $request->company_scope;
        $data['customer_scope'] = $request->customer_scope;
        // $data['booking_open'] = $request->booking_open;
        
        // $data['registration_due_date'] = $request->registration_due_date;
        $data['booking_open_days'] = $request->booking_open_days;
        $data['registration_due_days'] = $request->registration_due_days;
        $data['repay_deduction'] = $request->repay_deduction;
        // $data['advance_refund'] = $request->advance_refund;
        $data['refund_days'] = $request->refund_days;
        // $data['validity_days'] = $request->valididty_days;
        // $data['validity_paid'] = $request->valididty_paid;
        // $data['broker_commission'] = $request->broker_commission;
        
        $data['stamp_duty'] = $request->stamp_duty;
        $data['registration_fees_dd'] = $request->registration_fees_dd;
        $data['stamp_duty_value'] = $total_value;
        $data['dd_charge'] = $request->dd_charge;
        // $data['registration_fees_dd_value'] = $total_value_1;
        $data['extra_page_fees'] = $request->extra_page_fees;
        $data['register_office'] = $request->register_office;
        
        // $data['document_value'] = $request->document_value;
        // $data['document_commission'] = $request->document_commission;
        $data['writer_fees'] = $request->writer_fees;
        // $data['dd_commission'] = $request->dd_commission;
        $data['sub_division_fees'] = $request->sub_division_fees;
        // $data['regitration_gift'] = $request->regitration_gift;
        $data['computer_fees'] = $request->computer_fees;
        // $data['customer_gift'] = $request->customer_gift;
        $data['cd'] = $request->cd;
        $data['ec'] = $request->ec;
        $data['reg_expense'] = $request->reg_expense;
        $data['other_expense'] = $request->other_expense;
        $data['advance'] = $request->advance;
        $data['part_payment'] = $request->part_payment;
        $data['auto_cancel'] = $request->auto_cancel;
        $data['manual_cancel'] = $request->manual_cancel;
        $data['created_ay'] = 1;
        $data['updated_by'] = 1;
        $update = ProjectDetail::where('id', $id)->update($data);
        if ($update) {
            return response()->json(['status' => true, 'message' => 'Project Updated Successfully!']);
        } else {
            return response()->json(['status' => false, 'message' => 'Project Updation Failed!']);
        }
    }
   
    
    public function delete($id)
    {
        if (!empty($id)) {
            $ProjectDetail = ProjectDetail::where('id', $id)->delete();
            $plot_management = PlotManagement::where('project_id', $id)->delete();
            if (isset($ProjectDetail) && !empty($ProjectDetail) && isset($plot_management) && !empty($plot_management)) {
                return response()->json(['status' => true, 'message' => 'Project Deleted Successfully!']);
            } else {
                return response()->json(['status' => false, 'message' => 'Project Deleted Failed!']);
            }
        }
    }
}