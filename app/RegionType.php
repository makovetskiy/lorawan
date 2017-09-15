<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegionType extends Model
{
    protected $table = 'REGION_TYPE';
    public $timestamps = false;
    public $incrementing  = false;
    protected $primaryKey = 'RGNT_ID';
}