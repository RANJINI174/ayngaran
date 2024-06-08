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
use Auth;
use Illuminate\Http\Request;

class SuspenseDayBookController extends Controller
{
    public function index(Request $request)
    {
        try {
            
   $from_date = $request->input('from_date');
   $to_date = $request->input('to_date');
  if($from_date == '')
   {
     $transaction = \App\Models\Account::where('is_suspense',1)->whereNull('suspense_status')->orderBy('voucher_date', 'ASC')->first();  
    
    if (isset($transaction)) {
     $from_date = $transaction->voucher_date;
    } else {
    $from_date = date('d-m-Y');
    }
                                    
   }
  if($to_date == '')
  {
    $to_date = date('Y-m-d');
   }
   
   
           $accounts = Account::leftjoin('main_ledger', 'main_ledger.id', 'account_transactions.main_ledger')
                ->leftjoin('sub_ledger', 'sub_ledger.id', 'account_transactions.sub_ledger')
                ->leftjoin('branch', 'branch.id', 'account_transactions.branch')
                ->where("account_transactions.voucher_type","=",2)
                ->whereNull("account_transactions.suspense_id")
                ->whereNull("account_transactions.suspense_status")
                ->whereBetween('account_transactions.voucher_date', [$from_date, $to_date])
                ->select('account_transactions.*', 'main_ledger.name as main_ledger', 'sub_ledger.name as sub_ledger', 'branch.branch_name')
                ->orderBy('account_transactions.voucher_date', 'ASC')->get();
            $main_ledger = MainLedger::where('status',1)->get();
            $sub_ledger = SubLedger::where('status',1)->get();
            return view('account_suspense_day_book.index',compact('accounts','main_ledger','sub_ledger'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    
    public function store(Request $request)
    {
         $request->validate([
            'voucher_date' => 'required',
            // 'transaction_type' => 'required',
            'main_ledger' => 'required',
            'sub_ledger' => 'required',
            'amount' => 'required',
            // 'pan_no' => 'required',
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
        
        if($request->account_on == 1)
        {
            $ref_no = $gl_ref_no;
        }else{
            $ref_no = $mv_ref_no;
        }
        
        $update_suspense = Account::where('id',$request->suspense_id)->update(['suspense_status' => 1]);
        if($update_suspense)
        {
           $account = new Account();
        $account->voucher_date = $request->voucher_date;
        $account->transaction_no = $ref_no;
        $account->account_on = $request->account_on;
        $account->suspense_id = $request->suspense_id;
        $account->pan_no = $request->pan_no;;
        $account->old_amount = $request->old_amount;
        $account->transaction_type = $request->trans_type;
        $account->voucher_type = 2;
        $account->branch = $request->branch;
        $account->account_for = $request->account_for;
        $account->main_ledger = $request->main_ledger;
        $account->sub_ledger = $request->sub_ledger;
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
        
        $insert = $account->save();
        
        if ($insert) {
            return response()->json(['status' => true, 'message' => 'Account Voucher Created Successfully!']);
        } else {
            return response()->json(['status' => false, 'message' => 'Account Voucher Creation Failed!']);
        } 
        }
        
    }
    
     public function print($id,$from_date,$to_date)
    {
         $from_date = $from_date;
         $to_date = $to_date;
         $accounts = Account::leftjoin('main_ledger', 'main_ledger.id', 'account_transactions.main_ledger')
                ->leftjoin('sub_ledger', 'sub_ledger.id', 'account_transactions.sub_ledger')
                ->leftjoin('branch', 'branch.id', 'account_transactions.branch')
                ->where("account_transactions.voucher_type","=",2)
                ->whereNull("account_transactions.suspense_id")
                ->whereNull("account_transactions.suspense_status")
                ->where("account_transactions.id","=",$id)
                ->select('account_transactions.*', 'main_ledger.name as main_ledger', 'sub_ledger.name as sub_ledger', 'branch.branch_name')->get();
       
       return view('account_suspense_day_book.print_receipt', compact('accounts','from_date','to_date'));
    }
}
