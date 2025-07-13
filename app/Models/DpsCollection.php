<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DpsCollection extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'dps_id',
        'date',
        'amount',


    ];
    protected $casts = [
    'date' => 'date', // Cast as Carbon instance
    ];
    // relations
    public function user(){
        return $this->belongsTo(user::class);
    }
    public function dps(){
        return $this->belongsTo(dps::class);
    }
}
