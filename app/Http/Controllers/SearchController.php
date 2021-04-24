<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\NovelModel;
use App\ImageModel;
use App\UsersModel;
use App\DeveloperModel;
use App\CharacterModel;
use App\DirectoryGenreModel;

class SearchController extends Controller {

	public function search(Request $request) {

		if(Auth::check()) {
			$user = Auth::user();
			$access = $user->access;
		} else {
			$access = "Гость";
		}

		$query = $request->input("query");

		if (empty($query)) {
			 $novels = [];
		} else {
			$novels = DB::table("novel")
				->where("name", "LIKE", "%". $query ."%")
				->orWhere("name_in_english", "LIKE", "%". $query ."%")
				->get();
		}

		$data = (object)[
			"query" => $query,
			"novels" => $novels,
			"access" => $access
		];
		
		return view("novel.search", ["data" => $data]);
	}

}
