<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SprutUser extends Model
{
	protected $primaryKey = 'Oid';
	public $incrementing  = false;
    protected $table = 'SPRUT_USER';
    public $timestamps = false;
}