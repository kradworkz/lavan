<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'municipality_id' 
    ];
    public $timestamps = false;

    public function patient()
    {
        return $this->hasOne('App\Models\Patient', 'barangay_id');
    } 
}
