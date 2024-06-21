<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\CourseStudent;
use Illuminate\Http\Request;

class CourseStudentController extends Controller
{



    // public function index()
    // {
    //     $students = Student::all();
    //     $courses = Course::all();
    //     $course_students = CourseStudent::with('courses')->get()->flatMap(function ($student) {
    //         return $student->courses->map(function ($course) use ($student) {
    //             return (object)[
    //                 'student_id' => $student->id,
    //                 'student_name' => $student->name,
    //                 'course_id' => $course->id,
    //                 'course_name' => $course->name,
    //             ];
    //         });
    //     });

    //     return view('course_students.index', compact('students', 'courses', 'course_students'));
    // }
    public function index()
    {
        $students = Student::all();
        $courses = Course::all();
        $course_students = CourseStudent::with('student', 'course')->get();

        return view('course_students.index', compact('students', 'courses', 'course_students'));
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        // Create new course student record
        CourseStudent::create($validatedData);

        // Return a response (you can customize as needed)
        return response()->json([
            'status' => true,
            'message' => 'Course student relationship created successfully!'
        ]);
    }

    public function edit($student_id, $course_id)
    {
        $courseStudent = CourseStudent::where('student_id', $student_id)
                                      ->where('course_id', $course_id)
                                      ->first();

        if (!$courseStudent) {
            return response()->json(['status' => false, 'message' => 'Record not found.']);
        }

        return response()->json(['status' => true, 'data' => $courseStudent]);
    }

// public function update(Request $request, $id)
// {
//     // Validate the request data
//     $request->validate([
//         'edit_student_id' => 'required|exists:students,id',
//         'edit_course_id' => 'required|exists:courses,id'
//     ],[
//         'edit_student_id.required' => 'The student field is required.',
//         'edit_student_id.exists' => 'The selected student does not exist.',
//         'edit_course_id.required' => 'The course field is required.',
//         'edit_course_id.exists' => 'The selected course does not exist.'
//     ]);


//     $update = CourseStudent::where('id', $id)->update([
//         'student_id' => $request->edit_student_id,
//         'course_id' => $request->edit_course_id
//     ]);

//     // Check if the update was successful
//     if ($update) {
//         return response()->json(['status' => true, 'message' => 'Enrollment Updated Successfully!'], 200);
//     }

//     // Return an error response if the update failed
//     return response()->json(['status' => false, 'message' => 'Enrollment Update Failed!'], 500);
// }
public function update(Request $request, $student_id, $course_id)
{
    $validatedData = $request->validate([
        'edit_student_id' => 'required|exists:students,id',
        'edit_course_id' => 'required|exists:courses,id',
    ]);

    $courseStudent = CourseStudent::where('student_id', $student_id)
                                  ->where('course_id', $course_id)
                                  ->first();

    if (!$courseStudent) {
        return response()->json(['status' => false, 'message' => 'Record not found.']);
    }

    $courseStudent->update([
        'student_id' => $validatedData['edit_student_id'],
        'course_id' => $validatedData['edit_course_id'],
    ]);

    return response()->json(['status' => true, 'message' => 'Enrollment updated successfully.']);
}
    // Enroll a student in a course
    public function enrollStudent(Request $request, $studentId)
    {
        $student = Student::findOrFail($studentId);
        $courseId = $request->course_id;

        if ($student->courses()->where('course_id', $courseId)->exists()) {
            return response()->json(['status' => false, 'message' => 'Student is already enrolled in this course.'], 400);
        }

        $student->courses()->attach($courseId);

        return response()->json(['status' => true, 'message' => 'Student enrolled in course successfully.']);
    }

    // Unenroll a student from a course
    public function unenrollStudent($studentId, $courseId)
    {
        $student = Student::findOrFail($studentId);

        if (!$student->courses()->where('course_id', $courseId)->exists()) {
            return response()->json(['status' => false, 'message' => 'Student is not enrolled in this course.'], 400);
        }

        $student->courses()->detach($courseId);

        return response()->json(['status' => true, 'message' => 'Student unenrolled from course successfully.']);
    }

    // View courses a student is enrolled in
    public function studentCourses($studentId)
    {
        $student = Student::with('courses')->findOrFail($studentId);

        return response()->json(['status' => true, 'data' => $student->courses]);
    }

    // View students enrolled in a course
    public function courseStudents($courseId)
    {
        $course = Course::with('students')->findOrFail($courseId);

        return response()->json(['status' => true, 'data' => $course->students]);
    }

    public function updateEnrollment(Request $request)
    {
        $student = Student::findOrFail($request->student_id);
        $currentCourseId = $request->current_course_id;
        $newCourseId = $request->new_course_id;

        if (!$student->courses()->where('course_id', $currentCourseId)->exists()) {
            return response()->json(['status' => false, 'message' => 'Student is not enrolled in the current course.'], 400);
        }

        if ($student->courses()->where('course_id', $newCourseId)->exists()) {
            return response()->json(['status' => false, 'message' => 'Student is already enrolled in the new course.'], 400);
        }

        $student->courses()->detach($currentCourseId);
        $student->courses()->attach($newCourseId);

        return response()->json(['status' => true, 'message' => 'Student enrollment updated successfully.']);
    }

    // public function delete($id)
    // {

    //     if (!empty($id)) {
    //         $course_student = CourseStudent::where('id', $id)->first();
    //         $course_student->delete();
    //         return response()->json(['status' => 200, 'message' => 'CourseStudent Deleted Successfully!'], 200);
    //     }
    // }

    public function destroy($student_id, $course_id)
    {
        try {
            $enrollment = CourseStudent::where('student_id', $student_id)
                ->where('course_id', $course_id)
                ->first();

            if ($enrollment) {
                $enrollment->delete();
                return response()->json(['status' => true, 'message' => 'Enrollment deleted successfully']);
            } else {
                return response()->json(['status' => false, 'message' => 'Enrollment not found']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
