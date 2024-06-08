<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff_Detail extends Model
{
    use HasFactory;

    protected $table = 'staff_details';
    protected $guarded = [];

    public function branches()
    {
        return $this->belongsTo(Branch::class, 'branch');
    }

    public function designations()
    {
        return $this->belongsTo(Designation::class, 'designation');
    }
}
