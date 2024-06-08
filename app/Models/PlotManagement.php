<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlotManagement extends Model
{
    use HasFactory;
    protected $table = 'plot_management';
    protected $fillable = ['project_id', 'type_id', 'guide_line_sq_ft', 'market_value_sq_ft', 'plot_no', 'plot_sq_ft', 'direction_id', 'guide_line_plot_rate', 'market_value_plot_rate'];
}
