<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectVisit extends Model
{
    use HasFactory;
    protected $table = 'project_visit';
    protected $fillable = ['visit_number', 'date'];
}