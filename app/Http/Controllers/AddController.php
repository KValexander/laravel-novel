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

class AddController extends Controller {

	public function addformnovel() {
		// Если пользователь авторизирован
		if(Auth::check()) {
			$user = Auth::user();
			$access = $user->access;
		} else {
		// Если нет
			$access = "Гость";
		}

		$developers = DeveloperModel::all();
		$genres = DirectoryGenreModel::all();

		$data = (object)[
			"developers" => $developers,
			"genres" => $genres,
			"access" => $access
		];

		return view("novel.add_novel", ["data" => $data]);
	}

	public function addformdeveloper() {
		if(Auth::check()) {
			$user = Auth::user();
			$access = $user->access;
		} else {
			$access = "Гость";
		}
		$data = (object)[
			"access" => $access
		];
		return view("novel.add_developer", ["data" => $data]);
	}

	public function addnovel(Request $request) {
		$validator = Validator::make($request->all(), [
			"name" => "required|string",
			"image" => "required|string|regex:/^(https?:\/\/)?([\w\.]+)\.([a-z]{2,6}\.?)(\/[\w\.]*)*\/?$/",
			"year_release" => "required|string",
			"description" => "required|string",
			"type" => "required|string",
			"duration" => "required|string",
			"genres" => "required|string",
			"platform" => "required|string",
			"developer" => "required|string",
			"country" => "required|string",
			"language" => "required|string",
		]);

		if($validator->fails()) {
			$error = json_encode($validator->errors());
			return view("novel.message", ["message" => $error]);
		}

		$novels = NovelModel::all();
		foreach($novels as $val) {
			if($val->name == $request->input("name")) {
				$error = "Такая новелла уже есть в нашей базе";
				return view("novel.message", ["message" => $error]);
			}
		}

		$novel = NovelModel::create([
			"id_developer" => $request->input("id_developer"),
			"name" => $request->input("name"),
			"name_in_english" => $request->input("name_in_english"),
			"image" => $request->input("image"),
			"background" => $request->input("background"),
			"year_release" => $request->input("year_release"),
			"description" => $request->input("description"),
			"type" => $request->input("type"),
			"duration" => $request->input("duration"),
			"genres" => $request->input("genres"),
			"platform" => $request->input("platform"),
			"country" => $request->input("country"),
			"developer" => $request->input("developer"),
			"age_raiting" => $request->input("age_raiting"),
			"language" => $request->input("language"),
		]);

		$image = new ImageModel;
		$image->id_novel = $novel->id_novel;
		if(	!empty($request->input("image1")) ||
			!empty($request->input("image2")) ||
			!empty($request->input("image3")) ||
			!empty($request->input("image4")) ||
			!empty($request->input("image5")) ||
			!empty($request->input("image6"))  )
		{
			$image = new ImageModel;
			$image->id_novel = $novel->id_novel;
			$image->image1 = $request->input("image1");
			$image->image2 = $request->input("image2");
			$image->image3 = $request->input("image3");
			$image->image4 = $request->input("image4");
			$image->image5 = $request->input("image5");
			$image->image6 = $request->input("image6");
		}
		$image->save();

		$message = "Новелла была направлена на модерацию";
		return view("novel.message", ["message" => $message]);
	}

	public function adddeveloper(Request $request) {
		$validator = Validator::make($request->all(), [
			"developer" => "required|string",
			"foundation_date" => "required",
			"description" => "required|string",
			"location" => "required|string",
			"language" => "required|string"
		]);

		if($validator->fails()) {
			$error = json_encode($validator->errors());
			return view("novel.message", ["message" => $error]);
		}

		$developers = DeveloperModel::all();
		foreach($developers as $val) {
			if($val->developer == $request->input("developer")) {
				$error = "Такой разработчик уже есть в нашей базе";
				return view("novel.message", ["message" => $error]);
			}
		}

		$developer = new DeveloperModel;

		$developer->developer = $request->input("developer");
		if($request->logo == "") $developer->logo = "https://bananavape.ru/img/nophoto.jpg";
		else $developer->logo = $request->input("logo");
		$developer->foundation_date = $request->input("foundation_date");
		$developer->description = $request->input("description");
		$developer->location = $request->input("location");
		$developer->language = $request->input("language");

		$developer->save();

		$message = "Разработчик был успешно добавлен";
		return view("novel.message", ["message" => $message]);
	}

}
