<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NovelModel extends Model {

	protected $table = 'novel';
	protected $primaryKey = 'id_novel';

	protected $fillable = ["name","name_in_english", "image","background", "year_release","description","type","duration","genres","platform","developer","country","age_raiting","language"];
	
	public $timestamps = true;

}
