<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAdmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'exit_port',
        'started_at', 
        'completion_at', 
        'is_home',
        'patient_id',
        'status_id',
        'is_released',
        'is_positive'
    ];

    public function status()
    {
        return $this->belongsTo('App\Models\Dropdown', 'status_id', 'id');
    }

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'patient_id', 'id');
    }

    public function facility()
    {
        return $this->hasOne('App\Models\PatientAdmissionFacility', 'admission_id');
    } 

    public function tests()
    {
        return $this->hasMany('App\Models\PatientAdmissionTest', 'admission_id');
    } 

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification', 'admission_id');
    }

    public function getExitPortAttribute($value){
        return ucwords(strtolower($value));
    }


    public function getStartedAtAttribute($value)
    {
        return date('M d, Y', strtotime($value));
    }

    public function getCompletionAtAttribute($value)
    {
        return date('M d, Y', strtotime($value));
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
