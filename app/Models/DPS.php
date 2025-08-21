<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DPS extends Model
{
    use HasFactory;
    protected $table = 'dps'; 
   

    protected $fillable = [
        'dps_number',
        'amount',
        'dps_fee',
        'service_charge',
        'stamp_charge',
        'premium',
        'user_id',
        'dps_type_id',
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
 
  
 public function dpsCollection()
{
    return $this->hasMany(DpsCollection::class, 'dps_id');
}
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relationship: Loan belongs to a LoanType
     */
    public function dpsType()
    {
        return $this->belongsTo(DpsType::class, 'dps_type_id');
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
