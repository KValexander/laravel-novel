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

class UpdateController extends Controller {

	public function formupdatenovel(Request $request) {
		
		if(Auth::check()) {
			$user = Auth::user();
			$access = $user->access;
		} else {
			$access = "Гость";
		}

		$id = $request->route("id");
		$novel = NovelModel::find($id);

		$images = ImageModel::where("id_novel", $novel->id_novel)->first();

		$developer = DeveloperModel::where("id_developer", $novel->id_developer)->first();

		$developers = DeveloperModel::all();

		$characters = CharacterModel::all();

		$genres = DirectoryGenreModel::all();

		$data = (object)[
			"novel" => $novel,
			"images" => $images,
			"genres" => $genres,
			"developer" => $developer,
			"developers" => $developers,
			"characters" => $characters,
			"access" => $access
		];

		return view("novel.update", ["data" => $data]);
	}

	public function ajax_update_novel(Request $request) {

		if($request->input("id_developer") == "Выберите разработчика") {
			$id_developer = null;
		} else {
			$id_developer = $request->input("id_developer");
		}

		$novel = NovelModel::find($request->route("id"));
		$novel->id_developer = $id_developer;
		$novel->name = $request->input("name");
		$novel->name_in_english = $request->input("name_in_english");
		$novel->image = $request->input("image");
		$novel->background = $request->input("background");
		$novel->year_release = $request->input("year_release");
		$novel->description = $request->input("description");
		$novel->type = $request->input("type");
		$novel->duration = $request->input("duration");
		$novel->genres = $request->input("genres");
		$novel->platform = $request->input("platform");
		$novel->developer = $request->input("developer");
		$novel->country = $request->input("country");
		$novel->age_raiting = $request->input("age_raiting");
		$novel->language = $request->input("language");
		$novel->save();

		if($request->has("image1")||$request->has("image2")||$request->has("image3")||$request->has("image4")||$request->has("image5")||$request->has("image6")) {
			$image = ImageModel::where("id_novel", $request->route("id"))->first();
			$image->image1 = $request->input("image1");
			$image->image2 = $request->input("image2");
			$image->image3 = $request->input("image3");
			$image->image4 = $request->input("image4");
			$image->image5 = $request->input("image5");
			$image->image6 = $request->input("image6");
			$image->save();
		}

		$message = "Новелла была успешно обновлена";
		return response(json_encode($message), 200)
			->header("Content-Type", "application/json");
	}

}
