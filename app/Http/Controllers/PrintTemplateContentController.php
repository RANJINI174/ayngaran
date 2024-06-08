<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\PrintTemplateContent;

class PrintTemplateContentController extends Controller
{
    public function index()
    {
        try {
            $prints = PrintTemplateContent::all();
            // $prints = PrintTemplateContent::where('status', '=', '1')->get();
            return view('print_template_content.index', compact('prints'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'content_heading_name' => 'required',
                'print_template_content_name' => 'required',
                'status' => 'required'
            ],
            [
                'content_heading_name.required' => 'The content name field is required.',
                'print_template_content_name.required' => 'The print terms field is required.',
            ]
        );
        
        $print_content = new PrintTemplateContent();
        $print_content->content_heading_name = $request->content_heading_name;
        $print_content->print_template_content_name = $request->print_template_content_name;
        $print_content->status = $request->status;
        $insert = $print_content->save();
        if ($insert) {
            return response()->json(['status' => true, 'message' => 'Print Template Content Created Successfully!'], 200);
        }
        return response()->json(['status' => false, 'message' => 'Print Template Content Failed!']);
    }

    public function edit($id)
    {
        try {
            if (!empty($id)) {
                $print = PrintTemplateContent::where('id', $id)->first();
                if ($print != null) {
                    return response()->json(['status' => true, 'data' => $print], 200);
                } else {
                    return response()->json(['data' => 'Print Template Content Data Not Found']);
                }
            } else {
                return response()->json(['data' => 'Print Template Content Data Not Found']);
            }
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'edit_content_heading_name' => 'required',
                'edit_print_template_content_name' => 'required',
                'edit_status' => 'required'
            ],
            [
                'edit_content_heading_name.required' => 'The content name field is required.',
                'edit_print_template_content_name.required' => 'The print terms field is required.',
            ]
        );

        $update = PrintTemplateContent::where("id", $id)->update([
            'content_heading_name' => $request->edit_content_heading_name,
            'print_template_content_name' => $request->edit_print_template_content_name,
            'status' => $request->edit_status
        ]);
        if ($update) {
            return response()->json(['status' => true, 'message' => 'Print Template Content Updated Successfully!'], 200);
        }
        return response()->json(['status' => false, 'message' => 'Print Template Content Updated Failed!']);
    }

    public function delete($id)
    {

        if (!empty($id)) {
            $print = PrintTemplateContent::where('id', $id)->first();
            $print->delete();
            return response()->json(['status' => 200, 'message' => 'Print Template Content Deleted Success!'], 200);
        }
        return response()->json(['status' => false, 'message' => 'Print Template Content Updated Failed!']);
    }
}
