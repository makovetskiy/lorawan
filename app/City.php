<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'CITY';
    public $timestamps = false;
    public $incrementing  = false;
    protected $primaryKey = 'CITY_ID';
}