<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecuritySystemRole extends Model
{
	protected $primaryKey = 'Oid';
	public $incrementing  = false;
    protected $table = 'SecuritySystemRole';
    public $timestamps = false;
}