<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAdmissionFacility extends Model
{
    use HasFactory;

    protected $fillable = [
        'bed_id', 'admission_id'
    ];

    public function bed()
    {
        return $this->belongsTo('App\Models\Bed', 'bed_id', 'id');
    }

    public function admission()
    {
        return $this->belongsTo('App\Models\PatientAdmission', 'admission_id', 'id');
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
