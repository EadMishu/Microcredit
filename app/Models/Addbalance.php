<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addbalance extends Model
{
    protected $fillable = [
        'loan_id',
        'amount',
        'close_date',
    ];
}
