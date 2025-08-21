<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositCollection extends Model
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
     public function user(){
        return $this->belongsTo(user::class);
    }
    public function deposit()
{
    return $this->belongsTo(Deposit::class);
}
}
