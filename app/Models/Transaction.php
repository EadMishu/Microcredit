<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
      protected $fillable = [
        'date',
        'description',
        'amount',
        'type',
    ];


   public function user(){
        return $this->belongsTo(user::class);
    }
}
