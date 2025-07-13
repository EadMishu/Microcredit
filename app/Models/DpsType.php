<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DpsType extends Model
{
    use HasFactory;
     protected $table = 'dps_type';

    protected $fillable = [
        'name',
        'percentage',
        'duration',
        'number_of_installments',
        'status',
    ];

    /**
     * Relationship: A loan type has many loans.
     */
    public function dps()
    {
        return $this->hasMany(DPS::class, 'dps_type_id');
    }

    /**
     * Accessor to get readable status
     */
    public function getStatusTextAttribute()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }
}
