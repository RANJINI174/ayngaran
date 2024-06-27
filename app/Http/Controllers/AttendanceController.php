<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;
// use Barryvdh\DomPDF\Facade as PDF;
// use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\AttendancesExport;

class AttendanceController extends Controller
{
    // public function index(Request $request)
    // {
    //     $query = Attendance::query();

    //     // Filter by course_id if provided
    //     if ($request->has('course_id')) {
    //         $query->whereHas('student.courses', function ($query) use ($request) {
    //             $query->where('course_id', $request->course_id);
    //         });
    //     }

    //     // Filter by date if provided
    //     if ($request->has('date')) {
    //         $query->whereDate('date', $request->date);
    //     }

    //     // Load the related student and course data
    //     $attendances = $query->with(['student', 'student.courses'])->get();

    //     // Fetch all courses and students
    //     $courses = Course::all();
    //     $students = Student::all();

    //     return view('attendances.index', compact('attendances', 'students', 'courses'));
    // }

// course,date wise fetch the data

    public function index(Request $request)
    {
        $attendances = Attendance::query();
        $students = Student::all();
        $courses = Course::all();
        if ($request->has('date')) {
            $attendances->whereDate('date', $request->date);
        }
        if ($request->has('course_id')) {
                  $attendances->where('course_id', $request->input('course_id'));
        }


        $attendances = $attendances->get();

        return view('attendances.index', compact('attendances','students','courses'));
    }


    //course only correct
//     public function index(Request $request)
// {
//     $query = Attendance::query();

//     if ($request->has('course_id')) {
//         $query->where('course_id', $request->input('course_id'));
//     }

//     $attendances = $query->with(['student', 'course'])->paginate(10);
//     $courses = Course::all();
//     $students = Student::all();



//     return view('attendances.index', compact('attendances', 'courses', 'students'));
// }

// public function index(Request $request)
// {
//     // Initialize the Attendance query
//     $query = Attendance::query();

//     // Filter by course_id if provided
//     if ($request->has('course_id')) {
//         $query->whereHas('student.courses', function ($query) use ($request) {
//             $query->where('course_id', $request->course_id);
//         });
//     }

//     // Filter by date if provided
//     if ($request->has('date')) {
//         $query->whereDate('date', $request->date);
//     }

//     // Load the related student and course data and paginate the results
//     $attendances = $query->with(['student', 'student.courses'])->paginate(10);

//     // Fetch all courses and students
//     $courses = Course::all();
//     $students = Student::all();

//     // Return the view with the filtered attendances, courses, and students
//     return view('attendances.index', compact('attendances', 'students', 'courses'));
// }

public function updateStatus(Request $request)
{
    $attendance = Attendance::find($request->id);
    $attendance->status = $request->status;
    $attendance->save();

    return response()->json(['success' => true]);
}

    // public function create()
    // {
    //     $students = Student::all();
    //     $courses = Course::all();
    //     return view('attendances.create', compact('students', 'courses'));
    // }

    //fetch the data

    // public function create(Request $request)
    // {
    //     $courses = Course::all();
    //     $students = collect(); // empty collection by default

    //     if ($request->has('course_id') && $request->has('date')) {
    //         $students = Student::where('course_id', $request->course_id)->get();
    //     }

    //     return view('attendances.create', compact('courses', 'students', 'request'));
    // }
    public function store(Request $request)
    {

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


    public function delete($id)
    {

        if (!empty($id)) {
            $attendance = Attendance::where('id', $id)->first();
            $attendance->delete();
            return response()->json(['status' => 200, 'message' => 'Course Deleted Successfully!'], 200);
        }
    }

    public function generateReport(Request $request)
{
    $attendances = Attendance::query();
        $students = Student::all();
        $courses = Course::all();
        if ($request->has('date')) {
            $attendances->whereDate('date', $request->date);
        }
        if ($request->has('course_id')) {
                  $attendances->where('course_id', $request->input('course_id'));
        }


        $attendances = $attendances->get();
        $totalStudents = $attendances->unique('student_id')->count();
    return view('attendances.report', compact('attendances', 'courses','totalStudents'));
}
//     public function generateReport(Request $request)
// {
//     $query = Attendance::query();

//     if ($request->has('course_id')) {
//         $query->whereHas('student.courses', function ($query) use ($request) {
//             $query->where('course_id', $request->course_id);
//         });
//     }

//     if ($request->has('date')) {
//         $query->whereDate('date', $request->date);
//     }

//     $attendances = $query->with(['student', 'student.courses'])->get();
//     $courses = Course::all();

//     return view('attendances.report', compact('attendances', 'courses'));
// }


    // public function fetchAttendance(Request $request)
    // {
    //     $date = $request->date;
    //     $attendances = Attendance::whereDate('date', $date)->get();

    //     return response()->json(['attendances' => $attendances]);
    // }
    public function fetchAttendance(Request $request)
{
    $date = $request->date;
    $attendances = Attendance::whereDate('date', $date)
        ->with(['student', 'course'])
        ->get();

    return response()->json(['attendances' => $attendances]);
}
    // public function report()
    // {
    //     $courses = Course::with('attendances')->get();
    //     return view('attendances.report', compact('courses'));
    // }

    public function reportByCourse($course_id)
    {
        $course = Course::with('attendances.student')->findOrFail($course_id);
        return view('attendances.report_course', compact('course'));
    }

//     public function exportPdf(Request $request)
// {
//     $query = Attendance::query();

//     if ($request->has('course_id')) {
//         $query->whereHas('student.courses', function ($query) use ($request) {
//             $query->where('course_id', $request->course_id);
//         });
//     }

//     if ($request->has('date')) {
//         $query->whereDate('date', $request->date);
//     }

//     $attendances = $query->with(['student', 'student.courses'])->get();
//     $pdf = PDF::loadView('attendances.pdf', compact('attendances'));

//     return $pdf->download('attendance_report.pdf');
// }

// public function exportExcel(Request $request)
// {
//     return Excel::download(new AttendancesExport($request), 'attendance_report.xlsx');
// }
}
