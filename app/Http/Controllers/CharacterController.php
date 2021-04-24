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

class CharacterController extends Controller {

	public function character(Request $request) {
		if(Auth::check()) {
			$user = Auth::user();
			$access = $user->access;
		} else {
			$access = "Гость";
		}

		$id_novel = $request->route("id");

		$id_character = $request->input("id");

		$novel = NovelModel::find($id_novel);

		$character = CharacterModel::find($id_character);

		if(empty($character)) return view("novel.message", ["message" => "Такого персонажа нет"]);

		$data = (object)[
			"novel" => $novel,
			"character" => $character,
			"access" => $access
		];

		return view("novel.character", ["data" => $data]);
	}
}
