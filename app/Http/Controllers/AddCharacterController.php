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

class AddCharacterController extends Controller {

	public function add_form_character(Request $request) {
		// Если пользователь авторизирован
		if(Auth::check()) {
			$user = Auth::user();
			$access = $user->access;
		} else {
		// Если нет
			$access = "Гость";
		}

		$id = $request->route("id");
		$novel = NovelModel::where("id_novel", $id)->first();

		$data = (object) [
			"novel" => $novel,
			"access" => $access
		];

		return view("novel.add_character", ["data" => $data]);
	}

	public function ajax_add_character(Request $request) {
		$id = $request->route("id");

		$validator = Validator::make($request->all(), [
			"image" => "required|string|regex:/^(https?:\/\/)?([\w\.]+)\.([a-z]{2,6}\.?)(\/[\w\.]*)*\/?$/",
			"original_name" => "required|string",
			"name_in_russian" => "required|string",
			"gender" => "required|string",
			"role" => "required|string",
			"description" => "required|string",
		]);

		if($validator->fails()){
			$errors = $validator->errors();
			return response(json_encode($errors), 422)
				->header("Content-Type", "application/json");
		}

		$character = new CharacterModel;
		$character->id_novel = $id;
		$character->image = $request->input("image");
		$character->original_name = $request->input("original_name");
		$character->name_in_russian = $request->input("name_in_russian");
		$character->gender = $request->input("gender");
		$character->role = $request->input("role");
		$character->description = $request->input("description");
		$character->save();

		$message = "Персонаж был добавлен";
		return response(json_encode($message), 200)
			->header("Content-Type", "application/json");
	}
}
