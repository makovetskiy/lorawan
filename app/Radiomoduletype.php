<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Radiomoduletype extends Model
{
    protected $table = 'USK_TYPE';
    public $timestamps = false;
    public $incrementing  = false;
    protected $primaryKey = 'USKT_ID';
    protected $hidden = [
        'USKT_IMAGE'
    ];
}