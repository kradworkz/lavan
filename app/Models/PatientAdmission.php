<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAdmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'exit_port',
        'arrived_at', 
        'completion_at', 
        'bed_id',
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

    public function bed()
    {
        return $this->belongsTo('App\Models\Bed', 'bed_id', 'id');
    }

    public function getExitPortAttribute($value){
        return ucwords(strtolower($value));
    }


    public function getArrivedAtAttribute($value)
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
