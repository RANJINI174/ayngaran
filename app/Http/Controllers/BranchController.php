<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    public function index()
    {
        try {
            $branches = Branch::orderBy('id', 'asc')->get();
            return view('branch.index', compact('branches'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'branch_name' => 'required',
            'status' => 'required'
        ]);

        Branch::create($validator);
        return response()->json(['status' => true, 'message' => 'Branch Created Successfully!'], 200);
    }

    public function edit($id)
    {
        try {
            if (!empty($id)) {
                $branch = Branch::where('id', $id)->first();
                if ($branch != null) {
                    return response()->json(['status' => true, 'data' => $branch], 200);
                } else {
                    return response()->json(['data' => 'Branch Not Found']);
                }
            } else {
                return response()->json(['data' => 'Branch Not Found']);
            }
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function update(Request $request, $id)
    {

        $validator = $request->validate([
            'edit_branch' => 'required',
            'edit_status' => 'required'
        ], [
            'edit_branch.required' => 'The branch field is required.',
            'edit_status.required' => 'The status field is required.'
        ]);
        Branch::where('id', $id)->update(['branch_name' => $request->edit_branch, 'status' => $request->edit_status]);
        return response()->json(['status' => true, 'message' => 'Branch Updated Successfully!'], 200);
    }

    public function delete($id)
    {

        if (!empty($id)) {
            $project = Branch::where('id', $id)->first();
            $project->delete();
            return response()->json(['status' => 200, 'message' => 'Branch Deleted Success!'], 200);
        }
    }
}
