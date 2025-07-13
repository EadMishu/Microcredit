<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nominee extends Model
{
    protected $fillable = [
        'user_id', 'name', 'relation', 'dob', 'nid',
        'present_address', 'present_division', 'present_district', 'present_police_station',
        'permanent_address', 'permanent_division', 'permanent_district', 'permanent_police_station',
        'image'
    ];

    // Relations


     protected $casts = [
    
    'dob' => 'date',
];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function permanent_districts() {
        return $this->belongsTo(Location::class, 'permanent_district');
    }
}