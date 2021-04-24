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

class DeveloperController extends Controller {

	public function developer(Request $request) {

		if(Auth::check()) {
			$user = Auth::user();
			$access = $user->access;
		} else {
			$access = "Гость";
		}

		$developer = DeveloperModel::find($request->route("id"));

		$novels = NovelModel::where("id_developer", $developer->id_developer)->get();

		$data = (object)[
			"developer" => $developer,
			"novels" => $novels,
			"access" => $access
		];


		return view("novel.developer", ["data" => $data]);
	}

}
