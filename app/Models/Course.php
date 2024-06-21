<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected  $table = "courses";
    protected $primaryKey = 'id';
    protected $fillable = ['title','description','status'];


    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_students', 'course_id', 'student_id')
                    ->using(CourseStudent::class);
    }
    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
}
