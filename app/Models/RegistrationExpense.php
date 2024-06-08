<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationExpense extends Model
{
    use HasFactory;
    protected  $table = "registration_expenses";
    protected $fillable = [
        'booking_id', 'project_id', 'customer_name', 'plot_id', 'plot_sqft', 'stamp_duty', 'dd_charge', 'extra_page_fees', 'computer_fees', 'cd', 'sub_div_fees', 'register_office',
        'writer_fees', 'ec', 'other_expense','reg_expense_by', 'created_by', 'updated_by'
    ];
}
