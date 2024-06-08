<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketingManager extends Model
{
    use HasFactory;
    protected $table = 'marketing_managers';
    protected $fillable = ['reference_code', 'name', 'email', 'mobile_no', 'alternate_mobile', 'address', 'area', 'gender', 'dob', 'state_id', 'city_id', 'country_id', 'pincode'];
}
