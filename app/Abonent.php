<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abonent extends Model
{
	protected $primaryKey = 'AB_ID';
	public $incrementing  = false;
    protected $table = 'ABONENT';
    public $timestamps = false;
}
