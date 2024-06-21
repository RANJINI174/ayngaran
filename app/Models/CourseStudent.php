<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseStudent extends Model
{
    protected $table = 'course_students';

    // Disable auto-incrementing for the composite primary key
    public $incrementing = false;

    // Set the key type as a string
    protected $keyType = 'string';

    // Define the composite primary key
    protected $primaryKey = ['student_id', 'course_id'];

    // Add fillable properties
    protected $fillable = ['student_id', 'course_id'];

    // Disable timestamps if not needed
    // public $timestamps = false;
     public $timestamps = true;

    // Define relationships
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // Handle composite keys
    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if (!is_array($keys)) {
            return parent::setKeysForSaveQuery($query);
        }

        foreach ($keys as $key) {
            $query->where($key, '=', $this->getKeyForSaveQuery($key));
        }

        return $query;
    }

    protected function getKeyForSaveQuery($key = null)
    {
        if (is_null($key)) {
            $key = $this->getKeyName();
        }

        return $this->original[$key] ?? $this->getAttribute($key);
    }
}
