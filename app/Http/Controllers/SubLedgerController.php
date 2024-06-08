<?php

namespace App\Http\Controllers;
use App\Models\MainLedger;
use App\Models\SubLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubLedgerController extends Controller
{
    public function index()
    {
        try {
            
            // $subs = SubLedger::all();
           $subs = DB::table('sub_ledger')->leftJoin('main_ledger', 'sub_ledger.main_ledger_id', '=', 'main_ledger.id')
           ->select('sub_ledger.*','main_ledger.name as main_ledger')->orderBy('sub_ledger.id','asc')->get();
            $main_ledgers = MainLedger::where('status',1)->get();
            return view('sub_ledger.index', compact('subs','main_ledgers'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'main_ledger'=>'required',
                'name' => 'required',
                // 'detail' => 'required',
                'status' => 'required'
            ]
        );

        $sub = new SubLedger();
        $sub->main_ledger_id = $request->main_ledger;
        $sub->name = $request->name;
        $sub->detail = $request->detail;
        $sub->status = $request->status;
        $insert = $sub->save();
        if ($insert) {
            return response()->json(['status' => true, 'message' => 'Sub Ledger Created Successfully!'], 200);
        }
        return response()->json(['status' => false, 'message' => 'Sub Ledger Created Failed!']);
    }

    public function edit($id)
    {
        try {
            if (!empty($id)) {
                // $sub = SubLedger::where('id', $id)->first();
                $sub = DB::table('sub_ledger')
                    ->leftJoin('main_ledger', 'sub_ledger.main_ledger_id', '=', 'main_ledger.id')
                    ->where('sub_ledger.id',$id)->select('sub_ledger.*', 'main_ledger.name as main_legder')->first();
                    
                if ($sub != null) {
                     $main_ledger = MainLedger::where('status',1)->get();
                     $html = "<option value=".$sub->main_ledger_id.">".$sub->main_legder."</option>";
                     foreach($main_ledger as $main){
                         $html .= "<option value=".$main->id.">".$main->name."</option>";
                     }
                     
                    return response()->json(['status' => true, 'data' => $sub,'html'=>$html], 200);
                } else {
                    return response()->json(['data' => 'Sub Ledger Data Not Found']);
                }
            } else {
                return response()->json(['data' => 'Sub Ledger Data Not Found']);
            }
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'edit_main'=>'required',
                'edit_name' => 'required',
                // 'edit_detail' => 'required',
                'edit_status' => 'required'
            ],
            [
                'edit_main.required'=>'The main ledger field is required.',
                'edit_name.required' => 'The name field is required.',
                // 'edit_detail.required' => 'The detail field is required.',
            ]
        );

        $update = SubLedger::where("id", $id)->update([
            'main_ledger_id'=>$request->edit_main,
            'name' => $request->edit_name,
            'detail' => $request->edit_detail,
            'status' => $request->edit_status
        ]);
        if ($update) {
            return response()->json(['status' => true, 'message' => 'Sub Ledger Updated Successfully!'], 200);
        }
        return response()->json(['status' => false, 'message' => 'Sub Ledger Updated Failed!']);
    }

    public function delete($id)
    {

        if (!empty($id)) {
            $sub = SubLedger::where('id', $id)->first();
            $sub->delete();
            return response()->json(['status' => 200, 'message' => 'Sub Ledger Deleted Success!'], 200);
        }
        return response()->json(['status' => false, 'message' => 'Sub Ledger Content Updated Failed!']);
    }
}
