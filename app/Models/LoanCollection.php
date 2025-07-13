<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanCollection extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'user_id',
        'loan_id',
        'date',
        'amount',
    ];
    protected $casts = [
    'date' => 'date', // Cast as Carbon instance
    ];

    /**
     * Relationship: LoanCollection belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: LoanCollection optionally belongs to a Loan.
     */
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
