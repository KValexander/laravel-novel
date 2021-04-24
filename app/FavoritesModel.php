<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoritesModel extends Model {
	protected $table = 'favorites';
	protected $primaryKey = 'id_favorites';
	
	public $timestamps = false;

}
