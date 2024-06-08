<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionCashIssue extends Model
{
    use HasFactory;

    protected $table = 'commission_cash_issue';

    protected $fillable = ['project_id', 'plot_id', 'commission_id', 'marketer_id', 'reference_code', 'designation_id', 'name', 'mobile_no', 'comm_amount', 'comm_issued','issued_date'];
}
