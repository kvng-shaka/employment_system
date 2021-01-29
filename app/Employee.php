<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'lastname','firstname','address','city_id','state_id','country_id','age','date_of_birth','date_hired','department_id','picture'
    ];
}
