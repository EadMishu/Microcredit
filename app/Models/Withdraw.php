<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'date',
        'amount',
    ];
     protected $casts = [
    'date' => 'date', // Cast as Carbon instance
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
