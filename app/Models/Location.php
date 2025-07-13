<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'type',       // e.g., 'division', 'district', 'police_station'
        'parent_id',  // self-referencing ID
        'status',     // 1 = active, 0 = inactive
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Parent location (e.g., district belongs to a division)
    public function parent()
    {
        return $this->belongsTo(Location::class, 'parent_id');
    }

    // Child locations (e.g., division has many districts)
    public function children()
    {
        return $this->hasMany(Location::class, 'parent_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    */

    // Scope for divisions
    public function scopeDivisions($query)
    {
        return $query->where('type', 'division');
    }

    // Scope for districts
    public function scopeDistricts($query)
    {
        return $query->where('type', 'district');
    }

    // Scope for police stations
    public function scopePoliceStations($query)
    {
        return $query->where('type', 'police_station');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    // Optional: Human-readable type label
    public function getTypeLabelAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->type));
    }

    // Optional: Check type
    public function getIsDivisionAttribute()
    {
        return $this->type === 'division';
    }

    public function getIsDistrictAttribute()
    {
        return $this->type === 'district';
    }

    public function getIsPoliceStationAttribute()
    {
        return $this->type === 'police_station';
    }
}
