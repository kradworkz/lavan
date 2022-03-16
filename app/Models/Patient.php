<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'mobile',
        'firstname', 
        'lastname', 
        'middlename',
        'suffix',
        'gender',
        'mobile',
        'birthday',
        'address',
        'barangay_id',
        'is_vaccinated',
        'vaccine'
    ];

    public function histories()
    {
        return $this->hasMany('App\Models\PatientAdmission', 'patient_id')->orderBy('created_at','DESC');
    } 

    public function barangay()
    {
        return $this->belongsTo('App\Models\Barangay', 'barangay_id', 'id');
    }
    
    public function getFirstnameAttribute($value){
        return ucwords($value);
    }

    // public function getBirthdayAttribute($value)
    // {
    //     return date('M d, Y', strtotime($value));
    // }

    public function getMiddlenameAttribute($value){
        return ucwords($value);
    }
    
    public function getLastnameAttribute($value){
        return ucwords($value);
    }

    public function getSuffixAttribute($value){
        return strtoupper($value);
    }
    
    public function getAddressAttribute($value){
        return ucwords($value);
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
