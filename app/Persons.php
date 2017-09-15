<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persons extends Model
{
	protected $primaryKey = 'PRS_ID';
	public $incrementing  = false;
    protected $table = 'PERSONS';
    public $timestamps = false;
}
