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
use App\Models\AcDayCloseBook;
use Illuminate\Http\Request;


class AccountDayCloseBookController extends Controller
{
    public function index()
    {
        try {
            $current_date = date("Y-m-d");
            $transaction = Account::whereNull('closing_status')->whereNull('is_suspense')->orderBy('voucher_date', 'ASC')->first();
            $previous_data = Account::where('voucher_date', '=', $transaction->voucher_date)->whereNull('is_suspense')
             ->whereNull('closing_status')->get()->count();
             
            $get_suspense_date = Account::whereNull('suspense_status')->where('is_suspense',1)->orderBy('voucher_date', 'ASC')->first();
           
            $account = Account::leftjoin('main_ledger', 'main_ledger.id', 'account_transactions.main_ledger')
                ->leftjoin('sub_ledger', 'sub_ledger.id', 'account_transactions.sub_ledger')
                ->leftjoin('branch', 'branch.id', 'account_transactions.branch');
            if ($previous_data > 0) {
                $account->where('account_transactions.voucher_date', '=', $transaction->voucher_date);
            } else {
                $account->where('account_transactions.voucher_date', '=', $current_date);
            }
            $account->whereNull('account_transactions.closing_status')
                 ->whereNull('is_suspense')
                ->orderBy('account_transactions.voucher_date', 'asc')
                ->select('account_transactions.*', 'main_ledger.name as main_ledger', 'sub_ledger.name as sub_ledger', 'branch.branch_name');
            $accounts = $account->get();

            $admin =  Account::leftjoin('main_ledger', 'main_ledger.id', 'account_transactions.main_ledger')
                ->leftjoin('sub_ledger', 'sub_ledger.id', 'account_transactions.sub_ledger')
                ->leftjoin('branch', 'branch.id', 'account_transactions.branch');
            if ($previous_data > 0) {
                $admin->where('account_transactions.voucher_date', '=', $transaction->voucher_date);
            } else {
                $admin->where('account_transactions.voucher_date', '=', $current_date);
            }
            $admin->where("account_transactions.voucher_type", "=", 3)
                ->whereNull('account_transactions.closing_status')
                ->whereNull('is_suspense')
                ->orderBy('account_transactions.voucher_date', 'asc')
                ->select('account_transactions.*', 'main_ledger.name as main_ledger', 'sub_ledger.name as sub_ledger', 'branch.branch_name');
            $admin_accounts = $admin->get();

            return view('account_day_close_book.index', compact('accounts', 'admin_accounts', 'transaction', 'previous_data', 'current_date','get_suspense_date'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'voucher_id' => 'required',
            'opening_balance' => 'required',
            'closing_balance' => 'required',
        ]);
        $current_date = date("Y-m-d");
        foreach ($request->voucher_id as $key => $val) {
            $update = Account::where('id', $request->voucher_id[$key])->update([
                'closing_status' => 1,
                'closing_date' => $current_date,
                'opening_balance' => 1,
                'closing_balance' => $request->closing_balance,
            ]);
        }

        // $request->validate([
        //     'closing_date' => 'required',
        //     'opening_balance' => 'required',
        //     'voucher' => 'required',
        //     'account_on' => 'required',
        //     'transaction_type' => 'required',
        //     'main_ledger' => 'required',
        //     'sub_ledger' => 'required',
        //     'narration' => 'required',
        //     'description' => 'required',
        //     'pay_mode' => 'required',
        //     'bank_debit' => 'required',
        //     'bank_credit' => 'required',
        //     'cash_debit' => 'required',
        //     'cash_credit' => 'required',

        //     'total_receipt' => 'required',
        //     'receipt_amount' => 'required',
        //     'total_book_amount' => 'required',
        //     'total_blocking_adv_amt' => 'required',
        //     'admin_amount' => 'required',
        //     'balance' => 'required',
        //     'closing_balance' => 'required'
        // ]);


        // $ac_close_book = new AcDayCloseBook();
        // $ac_close_book->closing_date = $request->closing_date;
        // $ac_close_book->opening_balance = $request->opening_balance;
        // $ac_close_book->voucher = $request->voucher;
        // $ac_close_book->account_on = $request->account_on;
        // $ac_close_book->transaction_type = $request->transaction_type;
        // $ac_close_book->main_ledger = $request->main_ledger;
        // $ac_close_book->sub_ledger = $request->sub_ledger;
        // $ac_close_book->narration = $request->narration;
        // $ac_close_book->description = $request->description;
        // $ac_close_book->pay_mode = $request->pay_mode;
        // $ac_close_book->bank_debit = $request->bank_debit;
        // $ac_close_book->bank_credit = $request->bank_credit;
        // $ac_close_book->cash_debit = $request->cash_debit;
        // $ac_close_book->cash_credit = $request->cash_credit;

        // $ac_close_book->total_receipt = $request->total_receipt;
        // $ac_close_book->receipt_amount = $request->receipt_amount;
        // $ac_close_book->total_book_amount = $request->total_book_amount;
        // $ac_close_book->total_blocking_adv_amt = $request->total_blocking_adv_amt;
        // $ac_close_book->admin_amount = $request->admin_amount;
        // $ac_close_book->balance = $request->balance;
        // $ac_close_book->closing_balance = $request->closing_balance;

        // $insert = $ac_close_book->save();

        if ($update) {
            return response()->json(['status' => true, 'message' => 'Account Day Book Closed Successfully!']);
        } else {
            return response()->json(['status' => false, 'message' => 'Account Day Book Closed Failed!']);
        }
    }
}
