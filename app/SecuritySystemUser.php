<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecuritySystemUser extends Model
{
	protected $primaryKey = 'Oid';
	public $incrementing  = false;
    protected $table = 'SecuritySystemUser';
    public $timestamps = false;
    
}
