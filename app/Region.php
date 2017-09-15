<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'REGION';
    public $timestamps = false;
    public $incrementing  = false;
    protected $primaryKey = 'RGN_ID';
}