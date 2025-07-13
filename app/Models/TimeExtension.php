<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeExtension extends Model
{
    use HasFactory;

    protected $table = 'time_extension'; // optional if you're not using Laravel's plural convention

    protected $fillable = [
        'loan_id',
        'amount',
        'close_date',
    ];

    /**
     * Relationship: TimeExtension belongs to a Loan
     */
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}