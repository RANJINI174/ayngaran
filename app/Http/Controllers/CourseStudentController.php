<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class CourseStudentController extends Controller
{
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
}
