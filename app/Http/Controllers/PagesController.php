<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pages;

class PagesController extends Controller
{
    public function index()
    {
        try {
            $pages = Pages::orderBy('id', 'asc')->get();
            
            $parent_pages = Pages::where('is_parent','1')->orderBy('id', 'asc')->get();
            
            return view('pages.index', compact('pages','parent_pages'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
         ]);
        
        $insert = Pages::insert([
            'name' => $request->name,
            'page_url' => $request->page_url,
            'parent_id' => $request->parent_id,
            'is_parent' => $request->is_parent
            ]);
        if($insert)
        {
        return response()->json(['status' => true, 'message' => 'Page Created Successfully!'], 200);    
        }else{
        return response()->json(['status' => false, 'message' => 'Unable to Create the Page!'], 400);    
        }
        
    }

    public function edit($id)
    {
        try {
            if (!empty($id)) {
                $pages = Pages::where('id', $id)->first();
                if ($pages != null) {
                    return response()->json(['status' => true, 'data' => $pages], 200);
                } else {
                    return response()->json(['data' => 'Page Not Found']);
                }
            } else {
                return response()->json(['data' => 'Page Not Found']);
            }
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }

    public function update(Request $request, $id)
    {

        $validator = $request->validate([
            'edit_name' => 'required',
            // 'edit_status' => 'required'
        ]);
        Pages::where('id', $id)->update(['name' => $request->edit_name, 'page_url' => $request->edit_page_url,'is_parent' => $request->edit_is_parent,
        'parent_id' => $request->edit_parent_id]);
        return response()->json(['status' => true, 'message' => 'Page was Updated Successfully!'], 200);
    }

    public function delete($id)
    {

        if (!empty($id)) {
            $project = Pages::where('id', $id)->first();
            $project->delete();
            return response()->json(['status' => 200, 'message' => 'Page Deleted Successfully!'], 200);
        }
    }
}