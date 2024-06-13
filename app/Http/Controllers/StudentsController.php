<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Permission;

class StudentsController extends Controller
{
    public function index()
    {
        $students = Student::all(); // or use any other method to fetch data
    // return view('suppliers.index', compact('suppliers'));
    return view('students.index', ['students' => $students]);


    }
    public function create()
    {
        $student = Student::all();
        // $categories = categories::all();
        //return view('sports.create')->with('categories',$categories);
        return view('students.create',compact('student'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'status' => 'required'
         ]);

        $students = new Student();
        $students->name = $request->name;
        $students->email = $request->email;
        $students->status = $request->status;
        $insert = $students->save();
        if ($insert) {
            return response()->json(['status' => true, 'message' => 'Student Created Successfully!'], 200);
        }
        return response()->json(['status' => false, 'message' => 'Student Created Failed!']);

    }

    public function edit($id)
    {

        try {
            if (!empty($id)) {
                $student = Student::where('id', $id)->first();
                if ($student != null) {
                    return response()->json(['status' => true, 'data' => $student], 200);
                    // return view('edit_supplier', ['supplier' => $supplier]);
                } else {
                    return response()->json(['data' => 'Student Not Found']);
                }
            } else {
                return response()->json(['data' => 'Student Not Found']);
            }
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()])->withInput();
        }
    }



    public function update(Request $request, $id)
    {

        $request->validate([

            'edit_name' => 'required',
            'edit_email' => 'required',
            'edit_status' => 'required'
        ],[
            'edit_name.required' => 'The name field is required.',
            'edit_email.required' => 'The email feild is required.',
            'edit_status.required' => 'The status field is required.'
        ]);

    $update = Student::where('id', $id)->update([
    'name' => $request->edit_name,
    'email' => $request->edit_email,
    'status' => $request->edit_status
]);
    if ($update) {
        return response()->json(['status' => true, 'message' => 'Student Updated Successfully!'], 200);
    }
    return response()->json(['status' => false, 'message' => 'Student Updated Failed!']);
        // return response()->json(['status' => true, 'message' => 'Page was Updated Successfully!'], 200);
    }

    public function delete($id)
    {

        if (!empty($id)) {
            $student = Student::where('id', $id)->first();
            $student->delete();
            return response()->json(['status' => 200, 'message' => 'Student Deleted Successfully!'], 200);
        }
    }
}
