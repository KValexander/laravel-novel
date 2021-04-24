<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentsModel extends Model {

	protected $table = 'comments';
	protected $primaryKey = 'id_comment';
	
	public $timestamps = true;
}
