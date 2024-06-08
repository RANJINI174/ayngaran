<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        try {
            $vehicles = Vehicle::all();
            return view('vehicle.index', compact('vehicles'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'vehicle_name' => 'required',
                'status' => 'required'
            ]
        );
        $vehicle = new Vehicle();
        $vehicle->vehicle_name = $request->vehicle_name;
        $vehicle->status = $request->status;
        $insert = $vehicle->save();
        if ($insert) {
            return response()->json(['status' => true, 'message' => 'Vehicle Created Successfully!'], 200);
        }
        return response()->json(['status' => false, 'message' => 'Vehicle Created Failed!']);
    }

    public function edit($id)
    {
        try {
            if (!empty($id)) {
                $vehicle = Vehicle::where('id', $id)->first();
                if ($vehicle != null) {
                    return response()->json(['status' => true, 'data' => $vehicle], 200);
                } else {
                    return response()->json(['data' => 'vehicle Data Not Found']);
                }
            } else {
                return response()->json(['data' => 'vehicleData Not Found']);
            }
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'edit_vehicle_name' => 'required',
                'edit_status' => 'required'
            ],
            [
                'edit_vehicle_name.required' => 'The vehicle name field is required.',
                'edit_status.required' => 'The status field is required.',
            ]
        );

        $update = Vehicle::where("id", $id)->update([
            'vehicle_name' => $request->edit_vehicle_name,
            'status' => $request->edit_status
        ]);
        if ($update) {
            return response()->json(['status' => true, 'message' => 'Vehicle Updated Successfully!'], 200);
        }
        return response()->json(['status' => false, 'message' => 'Vehicle Updated Failed!']);
    }

    public function delete($id)
    {

        if (!empty($id)) {
            $vehicle = Vehicle::where('id', $id)->first();
            $vehicle->delete();
            return response()->json(['status' => 200, 'message' => 'Vehicle Deleted Success!'], 200);
        }
        return response()->json(['status' => false, 'message' => 'Vehicle Updated Failed!']);
    }
}