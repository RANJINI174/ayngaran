<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketingType;

class MarketingTypeController extends Controller
{
    public function index()
    {
        try {
            $marketing_types = MarketingType::orderBy('id', 'asc')->get();
            return view('marketing_type.index', compact('marketing_types'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'marketing_type' => 'required',
            'status' => 'required'
        ]);

        MarketingType::create($validator);
        return response()->json(['status' => true, 'message' => 'Marketing Type Created Successfully!'], 200);
    }


    public function edit($id)
    {
        try {
            if (!empty($id)) {
                $marketing_type = MarketingType::where('id', $id)->first();
                if ($marketing_type != null) {
                    return response()->json(['status' => true, 'data' => $marketing_type], 200);
                } else {
                    return response()->json(['data' => 'Marketing Type Not Found']);
                }
            } else {
                return response()->json(['data' => 'Marketing Type Not Found']);
            }
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'edit_marketing_type' => 'required',
                'edit_status' => 'required'
            ],
            [
                'edit_marketing_type.required' => 'The marketing type field is required.',
                'edit_status.required' => 'The status field is required.'
            ]
        );

        MarketingType::where('id', $id)->update(['marketing_type' => $request->edit_marketing_type, 'status' => $request->edit_status]);
        return response()->json(['status' => true, 'message' => 'Marketing Type Updated Successfully!'], 200);
    }

    public function delete($id)
    {

        if (!empty($id)) {
            $marketing_type = MarketingType::where('id', $id)->first();
            $marketing_type->delete();
            return response()->json(['status' => 200, 'message' => 'Marketing Type Deleted Success!'], 200);
        }
    }
}
