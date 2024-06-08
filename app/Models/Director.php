<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;

    protected $table = 'directors';
    protected $fillable = ['reference_code', 'name', 'email', 'mobile_no', 'alternate_mobile', 'address', 'area', 'gender', 'dob', 'state_id', 'city_id', 'country_id', 'pincode'];
}
