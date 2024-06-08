<?php

namespace App\Http\Controllers;
use App\Models\Account;
use App\Models\Branch;
use App\Models\Pincode;
use App\Models\Booking;
use App\Models\Bank;
use App\Models\Payment;
use App\Models\ProjectDetail;
use App\Models\PlotManagement;
use App\Models\Relationship;
use App\Models\Staff_Detail;
use App\Models\User;
use App\Models\MainLedger;
use App\Models\SubLedger;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
class AccountVoucherEntryController extends Controller
{
    public function index()
    {
        try {
            
            
            $accounts = Account::leftjoin('main_ledger','main_ledger.id','account_transactions.main_ledger')
                      ->leftjoin('sub_ledger','sub_ledger.id','account_transactions.sub_ledger')
                      ->leftjoin('branch','branch.id','account_transactions.branch')
                      ->whereNull("account_transactions.is_suspense")
                      ->where('account_transactions.voucher_date',date('Y-m-d'))
                      ->select('account_transactions.*','main_ledger.name as main_ledger','sub_ledger.name as sub_ledger','branch.branch_name')
                      ->orderBy('account_transactions.id','asc');
             if(Auth::user()->designation_id == 11)
             {
                 $accounts = $accounts->where('account_on',1);
             }
             $accounts = $accounts->get();
            return view('accounts_voucher_entry.index',compact('accounts'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    
    
    public function voucher_list(Request $request)
    {
        try {
            
            $from_date = $request->input('from_date');
            $to_date = $request->input('to_date');
  if($from_date == '')
   {
    $from_date = date('Y-m-d');
   }
  if($to_date == '')
  {
    $to_date = date('Y-m-d');
   }
            $accounts = Account::leftjoin('main_ledger','main_ledger.id','account_transactions.main_ledger')
                      ->leftjoin('sub_ledger','sub_ledger.id','account_transactions.sub_ledger')
                      ->leftjoin('branch','branch.id','account_transactions.branch')
                      ->whereNull("account_transactions.is_suspense")
                       
                    //   ->where('account_transactions.voucher_type','!=',2)
                    //   ->where('account_transactions.voucher_date',date('Y-m-d'))
                      ->whereBetween('account_transactions.voucher_date', [$from_date, $to_date])
                      ->select('account_transactions.*','main_ledger.name as main_ledger','sub_ledger.name as sub_ledger','branch.branch_name')
                      ->orderBy('account_transactions.id','asc');
            if(Auth::user()->designation_id == 11)
             {
                 $accounts = $accounts->where('account_on',1);
             }
               $accounts = $accounts->get();
            return view('accounts_voucher_entry.voucher_list',compact('accounts'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function create()
    {
        try {
            $branch = Branch::where('status', 1)->get();
            $users = User::where('user_type','!=','admin')->where('user_type','!=','staff')->get();
            $main_ledger = MainLedger::where('status',1)->get();
            $sub_ledger = SubLedger::where('status',1)->get();
            $banks = Bank::where('status',1)->get();

            return view('accounts_voucher_entry.add',compact('branch' ,'users','main_ledger','sub_ledger','banks'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'voucher_date' => 'required',
            // 'account_on' => 'required',
            'voucher_type' => 'required',
            'transaction_type' => 'required',
            // 'account_for' => 'required',
            // 'main_ledger' => 'required',
            // 'sub_ledger' => 'required',
            'branch' => 'required',
            'amount' => 'required',
            // 'tds' => 'required',
            // 'rs' => 'required',
            'pay_mode' => 'required',
        ]);
        
        $get_gl_no = Account::where('account_on',1)->whereNull('is_suspense')->get()->count();
        if($get_gl_no == 0)
        {
            $gl_ref_no = '001';
        }else{
            $gl_count = $get_gl_no + 1;
            $gl_ref_no = '00'.$gl_count;
        }
        
        $get_mv_no = Account::where('account_on',2)->whereNull('is_suspense')->get()->count();
        if($get_mv_no == 0)
        {
            $mv_ref_no = 'MV-01';
        }else{
            $mv_count = $get_mv_no + 1;
            $mv_ref_no = 'MV-0'.$mv_count;
        }
        
        $account_on = $request->account_on;
        
        if(Auth::user()->designation_id == 11)
        {
           $account_on = 1; 
        }
        
        
        if($request->voucher_type != 2)
        {
           if($account_on == 1)
        {
            $ref_no = $gl_ref_no;
        }else{
            $ref_no = $mv_ref_no;
        }
        
        }else{
            
         $get_sus_no = Account::where('voucher_type',2)->whereNotNull('is_suspense')->get()->count();
        if($get_sus_no == 0)
        {
            $ref_no = 'S-001';
        }else{
            $sus_count = $get_sus_no + 1;
            $ref_no = 'S-00'.$sus_count;
        }
        }
        
        
       
        
      
        $account = new Account();
        $account->voucher_date = $request->voucher_date;
        $account->transaction_no = $ref_no;
        $account->account_on = $account_on;
        $account->transaction_type = $request->transaction_type;
        $account->voucher_type = $request->voucher_type;
        $account->branch = $request->branch;
        $account->account_for = $request->account_for;
        $account->main_ledger = $request->main_ledger;
        $account->sub_ledger = $request->sub_ledger;
        $account->purpose = $request->purpose;
        $account->amount = $request->amount;
        $account->tds = $request->tds;
        $account->rs = $request->rs;
        $account->pay_mode = $request->pay_mode;
        $account->narration = $request->narration;
        $account->bank_name = $request->bank_name;
        $account->bank_branch = $request->bank_branch;
        $account->account_no = $request->account_no;
        $account->ifsc_code = $request->ifsc_code;
        $account->transfer_no = $request->transfer_no;
        $account->cheque_no = $request->cheque_no;
        $account->cheque_date = $request->cheque_date;
        $account->online_trans_date = $request->online_trans_date;
        $account->transfer_date = $request->transfer_date;
        $account->dd_no = $request->dd_no;
        $account->dd_date = $request->dd_date;
        $account->online_trans_no = $request->online_trans_no;
        $account->created_by = Auth::user()->id;
        
          if($request->voucher_type == 2)
        {
           $account->is_suspense = 1;
        }
        
        
        $insert = $account->save();
        
        if ($insert) {
            return response()->json(['status' => true, 'message' => 'Account Voucher Created Successfully!']);
        } else {
            return response()->json(['status' => false, 'message' => 'Account Voucher Creation Failed!']);
        }
        
    }
    
    
     public function edit($id)
    {
        try {
            $branch = Branch::where('status', 1)->get();
            $users = User::where('user_type','!=','admin')->where('user_type','!=','staff')->get();
            $main_ledger = MainLedger::where('status',1)->get();
            $sub_ledger = SubLedger::where('status',1)->get();
            $banks = Bank::where('status',1)->get();
            $account = Account::where('id',$id)->first();

            return view('accounts_voucher_entry.edit',compact('branch' ,'users','main_ledger','sub_ledger','banks','account'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    
    
     public function update(Request $request,$id)
    {
      
        $update_narration = Account::where('id',$id)->update(['narration' => $request->narration]);
        
        if ($update_narration) {
            return response()->json(['status' => true, 'message' => 'Account Voucher Updated Successfully!']);
        } else {
            return response()->json(['status' => false, 'message' => 'Account Voucher Updation Failed!']);
        }
        
    }
    
     public function getsubledger($id)
    {
        $subledger =SubLedger::where('main_ledger_id',$id)->select('id','name')->get();
        return response()->json(['status' => true, 'data' => $subledger], 200);
    }
    
    
    public function voucher_print(Request $request, $id)
    {
        try {
            $voucher = DB::table('account_transactions as a')
                ->select('a.*', 'b.branch_name', 'c.name as sub_ledger')
                ->leftJoin('branch as b', 'a.branch', '=', 'b.id')
                ->leftJoin('sub_ledger as c', 'c.id', '=', 'a.sub_ledger')
                ->where('a.id', $id)
                ->first();
            return view('accounts_voucher_entry.voucher_print', compact('voucher'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
}
