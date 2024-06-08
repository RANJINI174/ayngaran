<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketingType extends Model
{
    use HasFactory;
    protected $table = 'marketing_type';
    protected $fillable = ['marketing_type', 'status'];
}