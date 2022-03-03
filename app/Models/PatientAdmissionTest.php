<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAdmissionTest extends Model
{
    protected $fillable = [
        'is_rtpcr', 'is_positive', 'admission_id'
    ];


    use HasFactory;

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
