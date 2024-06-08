<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainLedger extends Model
{
    use HasFactory;

    protected $table = 'main_ledger';
    protected $fillable = ['name', 'detail', 'status'];
}
