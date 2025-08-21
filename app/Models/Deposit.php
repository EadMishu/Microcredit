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
        'deposit_fee',
        'service_charge',
        'stamp_charge',
     
        'member_id',
        'deposit_type_id',
        'open_date',
        'close_date',
        'closed_date',
        'status',
        'note',
    ];

    const STATUS_PENDING = 1;
    const STATUS_RUNNING = 2;
    const STATUS_CLOSED  = 3;

    // ❌ REMOVE this - it's invalid
    // public function depositCollections()
    // {
    //     return $this->hasMany(DepositCollection::class);
    // }

    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function depositType()
    {
        return $this->belongsTo(DepositType::class, 'deposit_type_id');
    }

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

