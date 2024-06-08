<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubLedger extends Model
{
    use HasFactory;

    protected $table = 'sub_ledger';
    protected $fillable = ['name', 'detail', 'status'];
}
