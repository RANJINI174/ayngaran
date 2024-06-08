<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Designation;

class CommissionDetail extends Model
{
    use HasFactory;

    protected $table = 'commission_details';
    protected $fillable = ['project_id', 'plan', 'marketvalue_sqft', 'commission_type', 'designation_id', 'cash', 'percentage', 'percentage_val', 'total_percentage_amt', 'total_cash_amt',];

    public function designation()
    {
        return  $this->belongsTo(Designation::class, 'designation_id', 'id');
    }
}
