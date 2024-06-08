<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlotDocumentIssueList extends Model
{
    use HasFactory;
    protected $table = 'plot_document_issue_lists';
    protected $fillable = ['project_id', 'plot_id','plot_sq_ft','customer_name','customer_mobile','reg_no','reg_date','collected_by',
    'collected_date','reg_expense_by','issued_name','issued_mobile','document_issued_file','status'];
}