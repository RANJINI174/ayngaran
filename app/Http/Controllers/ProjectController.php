<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ProjectType;

class ProjectController extends Controller
{
    public function index()
    {
        try {
            $project_types = ProjectType::orderBy('id', 'asc')->get();
            return view('project_type.index', compact('project_types'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }


    public function store(Request $request)
    {
        $validator = $request->validate([
            'project_type' => 'required',
            'status' => 'required'
        ]);

        ProjectType::create($validator);
        return response()->json(['status' => true, 'message' => 'Project Type Created Successfully!'], 200);
    }

    public function edit($id)
    {
        try {
            if (!empty($id)) {
                $editProject_type = ProjectType::where('id', $id)->first();
                if ($editProject_type != null) {
                    return response()->json(['status' => true, 'data' => $editProject_type], 200);
                } else {
                    return response()->json(['data' => 'Project Type Not Found']);
                }
            } else {
                return response()->json(['data' => 'Project Type Not Found']);
            }
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'edit_project_type' => 'required',
            'edit_status' => 'required'
        ], [
            'edit_project_type.required' => 'The project type field is required.',
            'edit_status.required' => 'The status field is required.'
        ]);
        ProjectType::where('id', $id)->update(['project_type' => $request->edit_project_type, 'status' => $request->edit_status]);
        return response()->json(['status' => true, 'message' => 'Project Type Updated Successfully!'], 200);
    }

    public function delete($id)
    {

        if (!empty($id)) {
            $project = ProjectType::where('id', $id)->first();
            $project->delete();
            return response()->json(['status' => 200, 'success' => 'Project Type Deleted Success!'], 200);
        }
    }
}
