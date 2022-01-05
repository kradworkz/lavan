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

    public function getNameAttribute($value){
        return ucwords(strtolower($value));
    }

    public function getAddressAttribute($value){
        return ucwords(strtolower($value));
    }
}
