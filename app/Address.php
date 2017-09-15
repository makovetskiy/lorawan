<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'ADRESS';
    public $timestamps = false;
    public $incrementing  = false;
    protected $primaryKey = 'ADR_ID';
}