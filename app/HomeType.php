<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeType extends Model
{
    protected $table = 'HOME_TYPE';
    public $timestamps = false;
    public $incrementing  = false;
    protected $primaryKey = 'HOMET_ID';
}