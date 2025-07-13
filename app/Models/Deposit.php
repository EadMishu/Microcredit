<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;
    protected $table = 'deposit';
    protected $fillable = [
        'deposit_number',
        'amount',
        'member_id',
        'deposit_type_id',
        'open_date',
        'close_date',
        'closed_date',
        'status',
        'note',
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
    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    /**
     * Relationship: Loan belongs to a LoanType
     */
    public function depositType()
    {
        return $this->belongsTo(DepositType::class, 'deposit_type_id');
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


}
