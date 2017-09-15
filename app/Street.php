<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    protected $table = 'STREET';
    public $timestamps = false;
    public $incrementing  = false;
    protected $primaryKey = 'STRT_ID';
}