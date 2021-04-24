<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\NovelModel;
use App\ImageModel;
use App\UsersModel;
use App\CommentsModel;
use App\DeveloperModel;
use App\CharacterModel;
use App\DirectoryGenreModel;

class NovelController extends Controller {

	public function main_page(Request $request) {
		$novels = NovelModel::where("active", 1)->orderBy("updated_at", "desc")->get();
	
		$count = NovelModel::where("active", 1)->count(); // Количество записей

		$n = 6; // Количество записей на странице

		if($request->has("page")) $page = $request->input("page");
		else $page = 0;
		$record = $page * $n; // Высчитка нужны новелл на определённой странице

		// Получение определённого количества новелл
		$novels = DB::select("SELECT * FROM `novel` WHERE `active` = 1 ORDER BY `id_novel` DESC LIMIT $record, $n");
		$developers = DeveloperModel::all(); // Получение всех разработчиков

		// Составление массива с информацией для перехода по страницам
		$tape = (object)[
			"count" => $count,
			"n" => $n,
			"page" => $page,
		];

		// Если пользователь авторизирован
		if(Auth::check()) {
			$user = Auth::user();
			$access = $user->access;
		} else {
		// Если нет
			$access = "Гость";
		}

		// Составление объекта передачи данных
		$data = (object)[
			"novels" => $novels,
			"developers" => $developers,
			"tape" => $tape,
			"access" => $access
		];

		if(Auth::check()) $data->user = $user;

		// Возвращение представлению запрошенных данных
		return view("novel.index", ["data" => $data]);
	}

	public function novel(Request $request) {
		// Если пользователь авторизирован
		if(Auth::check()) {
			$user = Auth::user();
			$access = $user->access;
		} else {
		// Если нет
			$access = "Гость";
		}

		$id = $request->route("id");
		$novel = NovelModel::find($id);
		$images = ImageModel::where("id_novel", $novel->id_novel)->first();
		$characters = CharacterModel::where("id_novel", $novel->id_novel)->get();
		$comments = CommentsModel::where("id_novel", $novel->id_novel)->orderBy("created_at", "ASC")->get();

		// Составление объекта отправки ответа
		$data = (object)[
			"novel" => $novel,
			"images" => $images,
			"characters" => $characters,
			"comments" => $comments,
			"access" => $access
		];

		if(Auth::check()) $data->user = $user;

		return view("novel.novel", ["data" => $data]);
	}
	
	public function ajax_novel(Request $request) {
		$id = $request->route("id");
		$novel = NovelModel::find($id);
		return response(json_encode($novel), 200)
			->header("Content-Type", "application/json");
	}

}
