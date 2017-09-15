<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SprutRole extends Model
{
	protected $primaryKey = 'Oid';
	public $incrementing  = false;
    protected $table = 'SPRUT_ROLE';
    public $timestamps = false;
}