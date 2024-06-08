<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlotSqftEdit extends Model
{
    use HasFactory;
    protected $table = 'plot_square_feet_edit';
    protected $fillable = ['plot_id', 'project_id', 'initial_plot_no', 'initial_plot_sq_ft', 'new_plot_no', 'new_plot_sq_ft', 'reason'];
}
