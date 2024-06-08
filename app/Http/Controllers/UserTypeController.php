<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    public function index()
    {
        try {
            $user_types = UserType::orderBy('id', 'asc')->get();
            return view('user_type.index', compact('user_types'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'user_type' => 'required',
            'status' => 'required'
        ]);

        UserType::create($validator);
        return response()->json(['status' => true, 'message' => 'User Type Created Successfully!'], 200);
    }

    public function edit($id)
    {
        try {
            if (!empty($id)) {
                $user_type = UserType::where('id', $id)->first();
                if ($user_type != null) {
                    return response()->json(['status' => true, 'data' => $user_type], 200);
                } else {
                    return response()->json(['data' => 'User Type Not Found']);
                }
            } else {
                return response()->json(['data' => 'User Type Not Found']);
            }
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'edit_user_type' => 'required',
            'edit_status' => 'required'
        ]);

        UserType::where('id', $id)->update(['user_type' => $request->edit_user_type, 'status' => $request->edit_status]);
        return response()->json(['status' => true, 'message' => 'User Type Updated Successfully!'], 200);
    }

    public function delete($id)
    {
        if (!empty($id)) {
            $user_type = UserType::where('id', $id)->first();
            $user_type->delete();
            return response()->json(['status' => 200, 'success' => 'User Type Deleted Success!'], 200);
        }
    }
}
