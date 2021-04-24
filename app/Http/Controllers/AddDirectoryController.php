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

class AddDirectoryController extends Controller {

	public function addformdirectory(Request $request) {
		if(Auth::check()) {
			$user = Auth::user();
			$access = $user->access;
		} else {
			$access = "Гость";
		}
		$data = (object)[
			"access" => $access
		];
		return view("novel.add_directory", ["data" => $data]);
	}

	public function ajax_directory(Request $request) {
		if($request->has("genre")) {

			$genres = DirectoryGenreModel::all();
			foreach ($genres as $key => $val) {
				if($val->genre == $request->input("genre")) {
					$message = "Такой жанр уже есть в базе";
					$response = (object)[ "genres" => $genres, "message" => $message ];
					return response(json_encode($response), 200)
						->header("Content-Type", "Application/json");
				}
			}

			if(empty($request->input("genre"))) {
				$message = "Заполните поле жанр";
			} else {
				$genre = new DirectoryGenreModel;
				$genre->genre = $request->input("genre");
				$genre->save();
				$message = "Жанр был добавлен";
			}

			$genres = DirectoryGenreModel::all();
			$response = (object)[ "genres" => $genres, "message" => $message ];
			return response(json_encode($response), 200)
				->header("Content-Type", "Application/json");
		}
		$genres = DirectoryGenreModel::all();
		return response(json_encode($genres), 200)
			->header("Content-Type", "application/json");
	}

}
