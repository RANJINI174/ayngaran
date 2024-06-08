<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintTemplateContent extends Model
{
    use HasFactory;

    protected  $table = "print_template_contents";
    protected $fillable = ['print_template_content_name', 'status'];
}
