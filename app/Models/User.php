<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Mass assignable attributes
    protected $fillable = [
        'member_number',
        'name',
        'name_bn',
        'father_name',
        'mother_name',
        'husband_name',
        'wife_name',
        'occupation',
        'dob',
        'nid',
        'present_address',
        'present_division',
        'present_district',
        'present_police_station',
        'permanent_address',
        'permanent_division',
        'permanent_district',
        'permanent_police_station',
        'nationality',
        'mobile_number',
        'mobile_number_2',
        'mobile_number_3',
        'image',
        'signature',
        'join_date',
        'role',
        'password',
        'status'
    ];

    // Hidden from arrays and JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Attribute casting
    protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
    'join_date' => 'date',
    'dob' => 'date',
];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function loanCollections()
    {
    return $this->hasMany(LoanCollection::class);
    }
  public function dpsCollection(){
        return $this->hasMany(dpsCollection::class);
     }
    // Nominees
    public function nominees()
    {
        return $this->hasMany(Nominee::class);
    }
    public function collection()
    {
        return $this->hasMany(Collection::class);
    }

    // Location Relationships

    public function presentDivision()
    {
        return $this->belongsTo(Location::class, 'present_division');
    }

    public function presentDistrict()
    {
        return $this->belongsTo(Location::class, 'present_district');
    }

    public function presentPoliceStation()
    {
        return $this->belongsTo(Location::class, 'present_police_station');
    }

    public function permanentDivision()
    {
        return $this->belongsTo(Location::class, 'permanent_division');
    }

    public function permanentDistrict()
    {
        return $this->belongsTo(Location::class, 'permanent_district');
    }

    public function permanentPoliceStation()
    {
        return $this->belongsTo(Location::class, 'permanent_police_station');
    }

    // Optional: Get the latest nominee only
    public function latestNominee()
    {
        return $this->hasOne(Nominee::class)->latestOfMany();
    }
}