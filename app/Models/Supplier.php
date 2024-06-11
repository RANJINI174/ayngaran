<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $fillable = ['suppliername', 'supplier_contact_name','address_line_1','address_line_2','address_line_3','city','state','pincode','country','gstin','website','email','mobileno','phoneno','status'];
}
