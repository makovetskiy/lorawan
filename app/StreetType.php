<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StreetType extends Model
{
    protected $table = 'STREET_TYPE';
    public $timestamps = false;
    public $incrementing  = false;
    protected $primaryKey = 'STREETT_ID';
}