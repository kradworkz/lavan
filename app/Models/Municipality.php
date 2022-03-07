<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;
    protected $fillable = [
        'name' 
    ];
    public $timestamps = false;

    public function barangays()
    {
        return $this->hasMany('App\Models\Barangay', 'municipality_id');
    } 

    public function users()
    {
        return $this->hasMany('App\Models\User', 'municipality_id');
    } 

    public function getNameAttribute($value){
        return ucwords(strtolower($value));
    }
}
