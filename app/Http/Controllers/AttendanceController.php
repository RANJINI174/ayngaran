<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('student', 'course')->get();
        $students = Student::all();
        $courses = Course::all();
        return view('attendances.index', compact('attendances', 'students', 'courses'));
    }
    public function create()
    {
        $students = Student::all();
        $courses = Course::all();
        return view('attendances.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'student_id' => 'required',
        //     'course_id' => 'required',
        //     'date' => 'required|date',
        //     'status' => 'required'
        // ]);

        // Attendance::create($request->all());
        // return redirect()->route('attendances.index')->with('success', 'Attendance recorded successfully.');
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'date' => 'required|date',
            'status' => 'required|boolean',
        ]);

        try {
            $attendance = new Attendance($validatedData);
            $attendance->save();

            return response()->json(['status' => true, 'message' => 'Attendance added successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Failed to add attendance!'], 500);
        }
    }

    public function show($id)
    {
        $attendance = Attendance::with('student', 'course')->findOrFail($id);
        return view('attendances.show', compact('attendance'));
    }

    public function edit($id)
    {
        // $attendance = Attendance::findOrFail($id);
        // $students = Student::all();
        // $courses = Course::all();
        // return view('attendances.edit', compact('attendance', 'students', 'courses'));

        try {
             $attendance = Attendance::findOrFail($id); // Use findOrFail to automatically handle if not found
            $students = Student::all();
            $courses = Course::all();
            // return response()->json(['status' => true, 'data' => $course,$students,$attendance], 200);
            return response()->json([
                'status' => true,
                'data' => [
                    'student_id' => $attendance->student_id,
                    'course_id' => $attendance->course_id,
                    'date' => $attendance->date,
                    'status' => $attendance->status,
                    'id' => $attendance->id
                ],
                'students' => $students,
                'courses' => $courses
            ], 200);


        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 404);
        }
    }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'student_id' => 'required',
    //         'course_id' => 'required',
    //         'date' => 'required|date',
    //         'status' => 'required'
    //     ]);

    //     $attendance = Attendance::findOrFail($id);
    //     $attendance->update($request->all());
    //     return redirect()->route('attendances.index')->with('success', 'Attendance updated successfully.');
    // }

    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'student_id' => 'required|exists:students,id',
        'course_id' => 'required|exists:courses,id',
        'date' => 'required|date',
        'status' => 'required|boolean',
    ]);

    try {
        $attendance = Attendance::findOrFail($id);
        $attendance->update($validatedData);

        return response()->json(['status' => true, 'message' => 'Attendance updated successfully!'], 200);
    } catch (\Exception $e) {
        return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
    }
}
//     public function update(Request $request, $id)
//     {

//         $request->validate([

//             'edit_student_id' => 'required',
//             'edit_course_id' => 'required',
//             'edit_date' => 'required',
//             'edit_status' => 'required'
//         ],[
//             'edit_student_id.required' => 'The student_id field is required.',
//             'edit_course_id.required' => 'The course_id feild is required.',
//             'edit_date.required' => 'The date feild is required.',
//             'edit_status.required' => 'The status field is required.'
//         ]);

//     $update = Attendance::where('id', $id)->update([
//     'student_id' => $request->edit_student_id,
//     'course_id' => $request->edit_course_id,
//     'date' => $request->edit_date,
//     'status' => $request->edit_status
// ]);
//     if ($update) {
//         return response()->json(['status' => true, 'message' => 'Attendance Updated Successfully!'], 200);
//     }
//     return response()->json(['status' => false, 'message' => 'attendancce Updated Failed!']);
//         // return response()->json(['status' => true, 'message' => 'Page was Updated Successfully!'], 200);
//     }

    // public function destroy($id)
    // {
    //     $attendance = Attendance::findOrFail($id);
    //     $attendance->delete();
    //     return redirect()->route('attendances.index')->with('success', 'Attendance deleted successfully.');
    // }

    public function delete($id)
    {

        if (!empty($id)) {
            $attendance = Attendance::where('id', $id)->first();
            $attendance->delete();
            return response()->json(['status' => 200, 'message' => 'Course Deleted Successfully!'], 200);
        }
    }

    public function generateReport()
    {
        // Implement your report generation logic here
    }
}
