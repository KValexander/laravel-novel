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

class ModerationController extends Controller {

	public function moderation() {
		if(Auth::check()) {
			$user = Auth::user();
			$access = $user->access;
		} else {
			$access = "Гость";
		}

		$novels = NovelModel::where("active", 0)->orderBy("updated_at", "desc")->get();

		$data = (object)[
			"novels" => $novels,
			"access" => $access
		];

		return view("novel.moderation", ["data" => $data]);
	}

	public function deactive_novel(Request $request) {
		$id = $request->route("id");
		$novel = NovelModel::find($request->route("id"));

		if(empty($novel)) {
			$message = "Такой новеллы не существует";
		} else {
			if($novel->active == 1) {
				$novel->active = 0;
				$novel->save();
				$message = "Новелла была успешно возвращена на модерацию";
			} else {
				$message = "Новелла уже на модерации";
			}
		}
		
		return view("novel.message", ["message" => $message]);
	}

	public function ajax_active_novel(Request $request) {
		$id = $request->route("id");
		$novel = NovelModel::find($request->route("id"));

		if(empty($novel)) {
			$message = "Такой новеллы не существует";
		} else {
			if($novel->active == 0) {
				$novel->active = 1;
				$novel->save();
				$message = "Новелла была успешно подтверждена";
			} else {
				$message = "Новелла уже подтверждена";
			}
		}

		$novels = NovelModel::where("active", 0)->orderBy("updated_at", "desc")->get();

		$data = (object)[
			"novels" => $novels,
			"message" => $message
		];
		
		return response(json_encode($data), 200)
			->header("Content-Type", "application/json");

	}
}
