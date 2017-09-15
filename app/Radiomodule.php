<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Radiomodule extends Model
{
    protected $table = 'USK';
    public $timestamps = false;

    protected $hidden = [
        'USKT_IMAGE'
    ];
}
