<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseStudent extends Model
{
    protected $table = 'course_students';

    protected $fillable = [
        'student_id',
        'course_id',
    ];
    public $incrementing = false;
    protected $primaryKey = ['student_id', 'course_id'];


    // Define any necessary relationships, if required
    public function student()
    {
        // return $this->belongsTo(Student::class);
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function course()
    {
        // return $this->belongsTo(Course::class);
        return $this->belongsTo(Course::class, 'course_id');
    }
}
