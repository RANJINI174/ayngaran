<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SuppliersController extends Controller
{
    public function index()
    {
        try {
            // $supplier = Supplier::orderBy('id', 'asc')->get();
            $suppliers = Supplier::all();
            return view('suppliers.index', compact('suppliers'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'suppliername' => 'required',
            'supplier_contact_name' => 'required',
            'address_line_1' => 'required',
            'address_line_2' => 'required',
            'address_line_3' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'country' => 'required',
            'gstin' => 'required',
            'website' => 'required',
            'email' => 'required',
            'mobileno' => 'required',
            'phoneno' => 'required',
            'status' => 'required'
         ]);


        //  Supplier::create($validator);
        //  return response()->json(['status' => true, 'message' => 'Supplier Created Successfully!'], 200);
        // // $insert = Supplier::insert([
        // //     'name' => $request->name,
        // //     'page_url' => $request->page_url,
        // //     'parent_id' => $request->parent_id,
        // //     'is_parent' => $request->is_parent
        // //     ]);
        $suppliers = new Supplier();
        $suppliers->suppliername = $request->suppliername;
        $suppliers->supplier_contact_name = $request->supplier_contact_name;
        $suppliers->address_line_1 = $request->address_line_1;
        $suppliers->address_line_2 = $request->address_line_2;
        $suppliers->address_line_3 = $request->address_line_3;
        $suppliers->city = $request->city;
        $suppliers->state = $request->state;
        $suppliers->pincode = $request->pincode;
        $suppliers->country = $request->country;
        $suppliers->gstin = $request->gstin;
        $suppliers->website = $request->website;
        $suppliers->email = $request->email;
        $suppliers->mobileno = $request->mobileno;
        $suppliers->phoneno = $request->phoneno;
        $suppliers->status = $request->status;
        $insert = $suppliers->save();
        if ($insert) {
            return response()->json(['status' => true, 'message' => 'Supplier Created Successfully!'], 200);
        }
        return response()->json(['status' => false, 'message' => 'Supplier Created Failed!']);

    }

    public function edit($id)
    {
        try {
            if (!empty($id)) {
                $supplier = Supplier::where('id', $id)->first();
                if ($supplier != null) {
                    return response()->json(['status' => true, 'data' => $supplier], 200);
                } else {
                    return response()->json(['data' => 'Supplier Not Found']);
                }
            } else {
                return response()->json(['data' => 'Supplier Not Found']);
            }
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function update(Request $request, $id)
    {

        $request->validate([

            'edit_suppliername' => 'required',
            'edit_supplier_contact_name' => 'required',
            'edit_address_line_1' => 'required',
            'edit_address_line_2' => 'required',
            'edit_address_line_3' => 'required',
            'edit_city' => 'required',
            'edit_state' => 'required',
            'edit_pincode' => 'required',
            'edit_country' => 'required',
            'edit_gstin' => 'required',
            'edit_website' => 'required',
            'edit_email' => 'required',
            'edit_mobileno' => 'required',
            'edit_phoneno' => 'required',
            'edit_status' => 'required'
        ],[
            'edit_suppliername.required' => 'The designation field is required.',
            'edit_supplier_contact_name.required' => 'The supplier_contact_name feild is required.',
            'edit_address_line_1.required' => 'The address_line_1 feild is required.',
            'edit_address_line_2.required' => 'The address_line_2 feild is required.',
            'edit_address_line_3.required' => 'The address_line_3 feild is required.',
            'edit_city.required' => 'The city feild is required.',
            'edit_state.required' => 'The state feild is required.',
            'edit_pincode.required' => 'The pincode feild is required.',
            'edit_country.required' => 'The country feild is required.',
            'edit_gstin.required' => 'The gstin feild is required.',
            'edit_website.required' => 'The website feild is required.',
            'edit_email.required' => 'The email feild is required.',
            'edit_mobileno.required' => 'The mobileno feild is required.',
            'edit_phoneno.required' => 'The phoneno feild is required.',
            'edit_status.required' => 'The status field is required.'
        ]);
        Supplier::where('id', $id)->update(['suppliername' => $request->edit_suppliername, 'supplier_contact_name' => $request->edit_supplier_contact_name,
        'address_line_1' => $request->edit_address_line_1, 'address_line_2' => $request->edit_address_line_2, 'address_line_3' => $request->edit_address_line_3, 'city' => $request->edit_city,
        'state' => $request->edit_state, 'pincode' => $request->edit_pincode, 'country' => $request->edit_country, 'gstin' => $request->edit_gstin,
        'website' => $request->edit_website, 'email' => $request->edit_email,  'mobileno' => $request->edit_mobileno,  'phoneno' => $request->edit_phoneno, 'status' => $request->edit_status
    ]);

        return response()->json(['status' => true, 'message' => 'Page was Updated Successfully!'], 200);
    }

    public function delete($id)
    {

        if (!empty($id)) {
            $supplier = Supplier::where('id', $id)->first();
            $supplier->delete();
            return response()->json(['status' => 200, 'message' => 'Supplier Deleted Successfully!'], 200);
        }
    }
}
