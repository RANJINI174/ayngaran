<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    public function index()
    {
        try {
            $designations = Designation::orderBy('id', 'asc')->get();
            return view('designation.index', compact('designations'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'designation' => 'required',
            'status' => 'required'
        ]);

        Designation::create($validator);
        return response()->json(['status' => true, 'message' => 'Designation Created Successfully!'], 200);
    }


    public function edit($id)
    {
        try {
            if (!empty($id)) {
                $designation = Designation::where('id', $id)->first();
                if ($designation != null) {
                    return response()->json(['status' => true, 'data' => $designation], 200);
                } else {
                    return response()->json(['data' => 'Designation Not Found']);
                }
            } else {
                return response()->json(['data' => 'Designation Not Found']);
            }
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'edit_designation' => 'required',
            'edit_status' => 'required'
        ], [
            'edit_designation.required' => 'The designation field is required.',
            'edit_status.required' => 'The status field is required.'
        ]);

        Designation::where('id', $id)->update(['designation' => $request->edit_designation, 'status' => $request->edit_status]);
        return response()->json(['status' => true, 'message' => 'Designation Updated Successfully!'], 200);
    }

    public function delete($id)
    {

        if (!empty($id)) {
            $designation = Designation::where('id', $id)->first();
            $designation->delete();
            return response()->json(['status' => 200, 'success' => 'Designation Deleted Success!'], 200);
        }
    }
}
