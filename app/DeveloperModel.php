<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeveloperModel extends Model {

	protected $table = 'developer';
	protected $primaryKey = 'id_developer';
	
	public $timestamps = false;

}
