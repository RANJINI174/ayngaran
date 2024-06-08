<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;

class BankController extends Controller
{
    public function index()
    {
        try {
            $banks = Bank::orderBy('id', 'asc')->get();
            return view('banks.index', compact('banks'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'bank_name' => 'required',
            'status' => 'required'
        ]);

        Bank::create($validator);
        return response()->json(['status' => true, 'message' => 'Bank Detail Created Successfully!'], 200);
    }

    public function edit($id)
    {
        try {
            if (!empty($id)) {
                $bank = Bank::where('id', $id)->first();
                if ($bank != null) {
                    return response()->json(['status' => true, 'data' => $bank], 200);
                } else {
                    return response()->json(['data' => 'Bank Data Not Found']);
                }
            } else {
                return response()->json(['data' => 'Bank Data Not Found']);
            }
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function update(Request $request, $id)
    {

        $validator = $request->validate([
            'edit_bank_name' => 'required',
            'edit_status' => 'required'
        ], [
            'edit_bank_name.required' => 'The branch field is required.',
            'edit_status.required' => 'The status field is required.'
        ]);
        Bank::where('id', $id)->update(['bank_name' => $request->edit_bank_name, 'status' => $request->edit_status]);
        return response()->json(['status' => true, 'message' => 'Bank Data Updated Successfully!'], 200);
    }

    public function delete($id)
    {

        if (!empty($id)) {
            $project = Bank::where('id', $id)->first();
            $project->delete();
            return response()->json(['status' => 200, 'message' => 'Bank Data Deleted Success!'], 200);
        }
    }
}
