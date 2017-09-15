<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbonentType extends Model
{
	protected $primaryKey = 'AT_ID';
    protected $table = 'ABONENT_TYPE';
    public $timestamps = false;
}
