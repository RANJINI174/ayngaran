<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected  $table = "students";
    protected $primaryKey = 'id';
    protected $fillable = ['name','email','status'];


    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_students', 'student_id', 'course_id')
                    ->using(CourseStudent::class);
    }
    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
}
