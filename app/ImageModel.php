<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageModel extends Model {

	protected $table = 'image';
	protected $primaryKey = 'id_image';
	
	public $timestamps = false;

}
