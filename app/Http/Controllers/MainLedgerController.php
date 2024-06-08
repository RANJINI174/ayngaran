<?php

namespace App\Http\Controllers;

use App\Models\MainLedger;
use Illuminate\Http\Request;

class MainLedgerController extends Controller
{
    public function index()
    {
        try {
            $mains = MainLedger::all();
            return view('main_ledger.index', compact('mains'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                // 'detail' => 'required',
                'status' => 'required'
            ]
        );

        $main = new MainLedger();
        $main->name = $request->name;
        $main->detail = $request->detail;
        $main->status = $request->status;
        $insert = $main->save();
        if ($insert) {
            return response()->json(['status' => true, 'message' => 'Main Ledger Created Successfully!'], 200);
        }
        return response()->json(['status' => false, 'message' => 'Main Ledger Created Failed!']);
    }

    public function edit($id)
    {
        try {
            if (!empty($id)) {
                $main = MainLedger::where('id', $id)->first();
                if ($main != null) {
                    return response()->json(['status' => true, 'data' => $main], 200);
                } else {
                    return response()->json(['data' => 'Main Ledger Data Not Found']);
                }
            } else {
                return response()->json(['data' => 'Main Ledger Data Not Found']);
            }
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'edit_name' => 'required',
                // 'edit_detail' => 'required',
                'edit_status' => 'required'
            ],[
                'edit_name.required'=>'The name field is required.',
                // 'edit_detail.required' => 'The detail field is required.',
            ]
        );

        $update = MainLedger::where("id", $id)->update([
            'name' => $request->edit_name,
            'detail' => $request->edit_detail,
            'status' => $request->edit_status
        ]);
        if ($update) {
            return response()->json(['status' => true, 'message' => 'Main Ledger Updated Successfully!'], 200);
        }
        return response()->json(['status' => false, 'message' => 'Main Ledger Updated Failed!']);
    }

    public function delete($id)
    {

        if (!empty($id)) {
            $main = MainLedger::where('id', $id)->first();
            $main->delete();
            return response()->json(['status' => 200, 'message' => 'Main Ledger Deleted Success!'], 200);
        }
        return response()->json(['status' => false, 'message' => 'Main Ledger Content Updated Failed!']);
    }
}