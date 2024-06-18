<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;

use App\Models\Permission;

class StudentsController extends Controller
{
    public function index()
    {
        $students = Student::all(); // or use any other method to fetch data
    // return view('suppliers.index', compact('suppliers'));
    // return view('students.index', ['students' => $students]);
    return view('students.index', compact('students'));

    }
    public function create()
    {
        return view('students.create');
    }



    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required',
    //         'status' => 'required'
    //      ]);

    //     $students = new Student();
    //     $students->name = $request->name;
    //     $students->email = $request->email;
    //     $students->status = $request->status;
    //     $insert = $students->save();
    //     if ($insert) {
    //         return response()->json(['status' => true, 'message' => 'Student Created Successfully!'], 200);
    //     }
    //     return response()->json(['status' => false, 'message' => 'Student Created Failed!']);

    // }

    public function store(Request $request)
{
    try {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'status' => 'required'
        ]);

        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->status = $request->status;
        $insert = $student->save();

        if ($insert) {
            return response()->json(['status' => true, 'message' => 'Student Created Successfully!'], 200);
        }

        return response()->json(['status' => false, 'message' => 'Student Creation Failed!'], 500);

    } catch (\Exception $e) {
        return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
    }
}


    public function edit($id)
    {

        // try {
        //     if (!empty($id)) {
        //         $student = Student::where('id', $id)->first();
        //         if ($student != null) {
        //             return response()->json(['status' => true, 'data' => $student], 200);
        //             // return view('edit_supplier', ['supplier' => $supplier]);
        //         } else {
        //             return response()->json(['data' => 'Student Not Found']);
        //         }
        //     } else {
        //         return response()->json(['data' => 'Student Not Found']);
        //     }
        // } catch (\Exception $e) {
        //     return back()->with(['error' => $e->getMessage()])->withInput();
        // }

        try {
            $student = Student::findOrFail($id); // Use findOrFail to automatically handle if not found

            return response()->json(['status' => true, 'data' => $student], 200);

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 404);
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

    public function enrollCourse(Request $request, $student_id)
    {
        $student = Student::find($student_id);
        $student->courses()->attach($request->course_id);

        return response()->json(['status' => true, 'message' => 'Course enrolled successfully']);
    }

    public function unenrollCourse($student_id, $course_id)
    {
        $student = Student::find($student_id);
        $student->courses()->detach($course_id);

        return response()->json(['status' => true, 'message' => 'Course unenrolled successfully']);
    }

    public function attendanceReport($student_id)
    {
        $attendances = Attendance::where('student_id', $student_id)->get();
        return view('students.attendance', compact('attendances'));
    }
}
