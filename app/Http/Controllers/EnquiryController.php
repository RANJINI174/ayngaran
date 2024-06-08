<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Pincode;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index()
    {
        try {
            $enquires = Enquiry::all();
            return view('enquries.index', compact('enquires'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function create()
    {
        try {
            return view('enquries.add');
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'email' => 'required|email|unique:enquiries,email',
            'mobile' => 'required|numeric|digits:10',
            'alternate_mobile' => '',
            'address' => 'required',
            'pincode' => 'required',
            'area' => 'required',
            'city_id' => 'required',
            'state_id' => 'required',
            'customer_status' => 'required',
            'site_visit' => 'required',
            'transporation' => 'required',
            'pickup_location' => 'required',
            'is_admin' => 'required',
        ]);
        if ($request->alternate_mobile != "") {
            $request->validate([
                'alternate_mobile' => 'required|numeric|digits:10',
            ]);
        }
        if ($request->transporation == 2) {
            $request->validate([
                'equipment' => 'required',
                'start_km' => 'required',
                'end_km' => 'required',
            ]);
        }

        $enquiry = new Enquiry();
        $enquiry->customer_name = $request->customer_name;
        $enquiry->email = $request->email;
        $enquiry->mobile = $request->mobile;
        $enquiry->alternate_mobile = $request->alternate_mobile;
        $enquiry->address = $request->address;
        $enquiry->pincode = $request->pincode;
        $enquiry->area = $request->area;
        $enquiry->city_id = $request->city_id;
        $enquiry->state_id = $request->state_id;
        $enquiry->customer_status = $request->customer_status;
        $enquiry->site_visit = $request->site_visit;
        $enquiry->transporation  = $request->transporation;
        $enquiry->equipment = $request->equipment;
        $enquiry->is_admin = $request->is_admin;
        $enquiry->start_km = $request->start_km;
        $enquiry->end_km = $request->end_km;
        $enquiry->pickup_location = $request->pickup_location;
        $enquiry->save();
        if($enquiry)
        {
           return response()->json(['status' => true, 'message' => 'Enquiry Created Successfully!'],200); 
        }else{
            return response()->json(['status' => true, 'message' => 'Enquiry Creation Failed!'],400);
        }
        
    }
    public function edit($id)
    {
        try {
            $enquiry = Enquiry::where('id', $id)->first();
            $areas  = Pincode::where('pincode', $enquiry->pincode)->get();
            $state  = Pincode::select('id', 'state')->where('pincode', $enquiry->pincode)->first();
            $city  = Pincode::select('id', 'city')->where('pincode', $enquiry->pincode)->first();
            return view('enquries.edit', compact('enquiry', 'areas', 'state', 'city'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'customer_name' => 'required',
            'email' => 'required|email|exists:enquiries,email',
            'mobile' => 'required|numeric|digits:10',
            'alternate_mobile' => '',
            'address' => 'required',
            'pincode' => 'required',
            'area' => 'required',
            'city_id' => 'required',
            'state_id' => 'required',
            'customer_status' => 'required',
            'site_visit' => 'required',
            'transporation' => 'required',
            'pickup_location' => 'required',
            'is_admin' => 'required',
        ]);
        if ($request->alternate_mobile != "") {
            $request->validate([
                'alternate_mobile' => 'required|numeric|digits:10',
            ]);
        }
        if ($request->transporation == 2) {
            $request->validate([
                'equipment' => 'required',
                'start_km' => 'required',
                'end_km' => 'required',
            ]);
        }
        $validate['alternate_mobile'] = $request->alternate_mobile;
        $validate['equipment'] = $request->equipment;
        $validate['start_km'] = $request->start_km;
        $validate['end_km'] = $request->end_km;
        // dd($validate);
        Enquiry::where('id', $id)->update($validate);
        return response()->json(['status' => true, 'message' => 'Enquiry Updated Successfully!']);
    }
    public function delete($id)
    {
        if (!empty($id)) {

            $enquiry = Enquiry::where('id', $id)->first();
            $enquiry->delete();
            return response()->json(['status' => 200, 'message' => 'Enquiry Deleted Success!'], 200);
        }
    }
}