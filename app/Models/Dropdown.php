<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dropdown extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' , 'type', 'color'
    ];

    public function getNameAttribute($value){
        return ucwords($value);
    }

    public function statuses()
    {
        return $this->hasMany('App\Models\PatientAdmission', 'status_id');
    } 

    public function categories()
    {
        return $this->hasMany('App\Models\PatientAdmission', 'category_id');
    } 

    public function getColorAttribute($value)
    {
        if($value == 'violet' ){
            return 'primary';
        }else if($value == 'blue'){
            return 'info';
        }else if($value == 'red'){
            return 'danger';
        }else if($value == 'yellow'){
            return 'warning';
        }else if($value == 'black'){
            return 'dark';
        }else if($value == 'gray'){
            return 'secondary';
        }else{
            return 'success';
        }
    }
}
