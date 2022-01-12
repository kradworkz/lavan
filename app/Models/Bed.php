<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    use HasFactory;

    public function facility()
    {
        return $this->belongsTo('App\Models\Facility', 'facility_id', 'id');
    }
}
