<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_number',
        'user_id',
        'amount',
        'loan_type_id',
        'open_date',
        'close_date',
        'closed_date',
        'status',
    ];

    /**
     * Status constants
     */
    const STATUS_PENDING = 1;
    const STATUS_RUNNING = 2;
    const STATUS_CLOSED  = 3;

    /**
     * Relationship: Loan belongs to a Member (User)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relationship: Loan belongs to a LoanType
     */
    public function loanType()
    {
        return $this->belongsTo(LoanType::class, 'loan_type_id');
    }

    /**
     * Accessor for readable status text
     */
    public function getStatusTextAttribute()
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'Pending',
            self::STATUS_RUNNING => 'Running',
            self::STATUS_CLOSED  => 'Closed',
            default => 'Unknown',
        };
    }
     public function loanCollections()
{
    return $this->hasMany(LoanCollection::class);
}

    public function extends()
    {
        return $this->hasOne(TimeExtension::class, 'loan_id')->latest();
    }

}
