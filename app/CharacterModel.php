<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CharacterModel extends Model {

	protected $table = 'character';
	protected $primaryKey = 'id_character';
	
	public $timestamps = false;

}
