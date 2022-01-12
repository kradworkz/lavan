<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' , 'address', 'barangay_id', 'is_main'
    ];

    public function barangay()
    {
        return $this->belongsTo('App\Models\Barangay', 'barangay_id', 'id');
    }

    public function beds()
    {
        return $this->hasMany('App\Models\Bed', 'facility_id');
    } 

    public function bedcount()
    {
        return $this->hasMany('App\Models\Bed', 'facility_id')->count();
    } 

    public function available()
    {
        return $this->hasMany('App\Models\Bed', 'facility_id')->where('is_available',1)->count();
    } 

    public function getNameAttribute($value){
        return ucwords(strtolower($value));
    }

    public function getAddressAttribute($value){
        return ucwords(strtolower($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }
}
