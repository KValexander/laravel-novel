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

class DeleteController extends Controller {

	public function deletenovel(Request $request) {
		// NovelModel::destroy($request->route("id"));
		$id = $request->route("id");
		$novel = NovelModel::find($id);
		if(empty($novel)) {
			$message = "Такой новеллы не существует";
			return view("novel.message", ["message" => $message]);
		}
		$novel->delete();
		$image = ImageModel::where("id_novel", $id)->first();
		if(!empty($image)) ImageModel::destroy($image->id_image);
		$message = "Новелла была успешно удалена";
		return view("novel.message", ["message" => $message]);
	}

	public function deletedeveloper(Request $request) {
		// DeveloperModel::destroy($request->route("id"));
		$developer = DeveloperModel::find($request->route("id"));
		if(empty($developer)) { $message = "Такого разработчика не существует";
		} else { $developer->delete(); $message = "Разработчик был успешно удалён"; }
		return view("novel.message", ["message" => $message]);
	}

	public function ajax_delete_directory(Request $request) {
		$genre = DirectoryGenreModel::find($request->input("id_genre"));
		if(empty($genre)) { $message = "Такого жанра нет";
		} else { $genre->delete(); $message = "Жанр был успешно удалён"; }
		$genres = DirectoryGenreModel::all();
		$response = (object)[ "genres" => $genres, "message" => $message ];
		return response(json_encode($response), 200)
			->header("Content-Type", "application/json");
	}

}
