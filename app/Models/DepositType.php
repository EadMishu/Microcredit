<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositType extends Model
{
    use HasFactory;
    protected $table = 'deposit_type';
    protected $fillable = [
        'name',
        'percentage',
        'duration',
        
        'status',
    ];

     protected $casts = [
        'percentage' => 'float',
        'duration' => 'integer',
       
        'status' => 'integer',
    ];
    public function deposit()
    {
        return $this->hasMany(Deposit::class, 'deposit_type_id');
    }

    /**
     * Accessor to get readable status
     */
    public function getStatusTextAttribute()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }
}
