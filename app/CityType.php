<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityType extends Model
{
    protected $table = 'CITY_TYPE';
    public $timestamps = false;
    public $incrementing  = false;
    protected $primaryKey = 'CITYT_ID';
}