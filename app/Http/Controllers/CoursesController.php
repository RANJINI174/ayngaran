<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Attendance;

use App\Models\Permission;

class CoursesController extends Controller
{
    public function index()
    {
        $courses = Course::all(); // or use any other method to fetch data
    // return view('suppliers.index', compact('suppliers'));
    // return view('courses.index', ['courses' => $courses]);
    return view('courses.index', compact('courses'));

    }



    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required'
         ]);

        $courses = new Course();
        $courses->title = $request->title;
        $courses->description = $request->description;
        $courses->status = $request->status;
        $insert = $courses->save();
        if ($insert) {
            return response()->json(['status' => true, 'message' => 'Course Created Successfully!'], 200);
        }
        return response()->json(['status' => false, 'message' => 'Course Created Failed!']);

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
            $course = Course::findOrFail($id); // Use findOrFail to automatically handle if not found

            return response()->json(['status' => true, 'data' => $course], 200);

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 404);
        }
    }



    public function update(Request $request, $id)
    {

        $request->validate([

            'edit_title' => 'required',
            'edit_description' => 'required',
            'edit_status' => 'required'
        ],[
            'edit_title.required' => 'The title field is required.',
            'edit_description.required' => 'The description feild is required.',
            'edit_status.required' => 'The status field is required.'
        ]);

    $update = Course::where('id', $id)->update([
    'title' => $request->edit_title,
    'description' => $request->edit_description,
    'status' => $request->edit_status
]);
    if ($update) {
        return response()->json(['status' => true, 'message' => 'Course Updated Successfully!'], 200);
    }
    return response()->json(['status' => false, 'message' => 'Course Updated Failed!']);
        // return response()->json(['status' => true, 'message' => 'Page was Updated Successfully!'], 200);
    }

    public function delete($id)
    {

        if (!empty($id)) {
            $course = Course::where('id', $id)->first();
            $course->delete();
            return response()->json(['status' => 200, 'message' => 'Course Deleted Successfully!'], 200);
        }
    }
    public function attendanceReport($course_id)
    {
        $attendances = Attendance::where('course_id', $course_id)->get();
        return view('courses.attendance', compact('attendances'));
    }
}
