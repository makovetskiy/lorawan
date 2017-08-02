<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'Application';
    protected $primaryKey = 'AppEUI';
    public $timestamps = false;
    protected $fillable = [
        'AppEUI',
        'Name',
        'Code'
    ];
}
