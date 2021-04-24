<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DirectoryGenreModel extends Model {

	protected $table = 'directory_genre';
	protected $primaryKey = 'id_genre';
	
	public $timestamps = false;

}
