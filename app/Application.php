<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'Application';
    protected $primaryKey = 'AppEUI';
    public $incrementing = false;
    public $timestamps = false;
}
