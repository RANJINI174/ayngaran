<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direction;

class DirectionController extends Controller
{
    public function index()
    {
        try {
            $directions = Direction::orderBy('id', 'asc')->get();
            return view('direction.index', compact('directions'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'direction_name' => 'required',
            'status' => 'required'
        ]);

        Direction::create($validator);
        return response()->json(['status' => true, 'message' => 'Direction Created Successfully!'], 200);
    }

    public function edit($id)
    {
        try {
            if (!empty($id)) {
                $direction = Direction::where('id', $id)->first();
                if ($direction != null) {
                    return response()->json(['status' => true, 'data' => $direction], 200);
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
        $request->validate(
            [
                'edit_direction_name' => 'required',
                'edit_status' => 'required'
            ],
            [

                'edit_direction_name.required' => 'The direction name field is required.',
                'edit_status.required' => 'The status field is required.'

            ]
        );

        Direction::where('id', $id)->update(['direction_name' => $request->edit_direction_name, 'status' => $request->edit_status]);
        return response()->json(['status' => true, 'message' => 'Direction Updated Successfully!'], 200);
    }

    public function delete($id)
    {

        if (!empty($id)) {
            $Direction = Direction::where('id', $id)->first();
            $Direction->delete();
            return response()->json(['status' => 200, 'message' => 'Direction Deleted Success!'], 200);
        }
    }
}
