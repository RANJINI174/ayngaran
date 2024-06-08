<?php

namespace App\Http\Controllers;

use App\Models\Relationship;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;

class RelationShipController extends Controller
{
    public function index()
    {
        try {
            $relationships = Relationship::orderBy('id', 'asc')->get();
            return view('relationship.index', compact('relationships'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'relationship_type' => 'required',
            'status' => 'required'
        ]);


        Relationship::create($validator);
        return response()->json(['status' => true, 'message' => 'Relationship Created Successfully!'], 200);
    }


    public function edit($id)
    {
        try {
            if (!empty($id)) {
                $relationship = Relationship::where('id', $id)->first();
                if ($relationship != null) {
                    return response()->json(['status' => true, 'data' => $relationship], 200);
                } else {
                    return response()->json(['data' => 'Relationship Type Not Found']);
                }
            } else {
                return response()->json(['data' => 'Relationship Type Not Found']);
            }
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'edit_relationship_type' => 'required',
                'edit_status' => 'required'
            ],
            [
                'edit_relationship_type.required' => 'The relationship type field is required.',
                'edit_status.required' => 'The status field is required.'
            ]
        );
        Relationship::where('id', $id)->update(['relationship_type' => $request->edit_relationship_type, 'status' => $request->edit_status]);
        return response()->json(['status' => true, 'message' => 'Relationship Updated Successfully!'], 200);
    }

    public function delete($id)
    {

        if (!empty($id)) {
            $project = Relationship::where('id', $id)->first();
            $project->delete();
            return response()->json(['status' => 200, 'message' => 'Project Deleted Success!'], 200);
        }
    }
}
