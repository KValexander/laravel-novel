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
use App\FavoritesModel;
use App\DirectoryGenreModel;

class UserController extends Controller {

	public function personal_area(Request $request) {
		if(Auth::check()) {
			$user = Auth::user();
			$access = $user->access;
		} else {
			$message = "Вы не являетесь авторизированным пользователем";
			return view("novel.message", ["message" => $message]);
		}

		$favorites = FavoritesModel::where("id_user", $user->id)->orderBy("id_favorites", "DESC")->get();
		$novels = array();
		for ($i=0; $i < count($favorites); $i++) { 
			$novels[] = NovelModel::where("id_novel", $favorites[$i]->id_novel)->first();
		}

		$comments = CommentsModel::where("id_user", $user->id)->orderBy("id_comment", "DESC")->get();
		$data = (object)[
			"user" => $user,
			"novels" => $novels,
			"comments" => $comments,
			"access" => $access
		];

		return view("novel.personal_area", ["data" => $data]);
	}

	public function update_form(Request $request) {
		if(Auth::check()) {
			$user = Auth::user();
			$access = $user->access;
		} else {
			$message = "Вы не являетесь авторизированным пользователем";
			return view("novel.message", ["message" => $message]);
		}
		$data = (object)[
			"user" => $user,
			"access" => $access
		];
		return view("novel.user_update", ["data" => $data]);
	}

	public function update(Request $request) {
		if(Auth::check()) {
			$user = Auth::user();
			$access = $user->access;
		} else {
			$message = "Вы не являетесь авторизированным пользователем";
			return view("novel.message", ["message" => $message]);
		}
		
		$user = UsersModel::find($user->id);
		// $user->email = $request->input("email");
		// $user->login = $request->input("login");
		// $user->password = bcrypt($request->input("password"));
		$user->name = $request->input("name");
		$user->avatar = $request->input("avatar");
		$user->status = $request->input("status");
		$user->background = $request->input("background");
		$user->save();

		$message = "Информация была успешно изменена";
		$data = (object)[
			"message" => $message
		];
		return response(json_encode($message), 200)
			->header("Content-Type", "application/json");
	}

	public function delete(Request $request) {

		if(Auth::check()) {
			$id = Auth::id();
			$user = UsersModel::find($id);
			$user->delete();
			$message = "Профиль был успешно удалён";
		} else {
			$message = "Вы не являетесь авторизированным пользователем";
		}

		return view("novel.message", ["message" => $message]);
	}

	public function profile(Request $request) {
		if(Auth::check()) {
			$user = Auth::user();
			$access = $user->access;
		} else {
			$access = "Гость";
		}

		$id = $request->route("id");
		$user = UsersModel::find($id);
		if(empty($user)) {
			$message = "Такого пользователя не существует";
			return view("novel.message", ["message" => $message]);
		}

		$favorites = FavoritesModel::where("id_user", $id)->orderBy("id_favorites", "DESC")->get();
		$novels = array();
		for ($i=0; $i < count($favorites); $i++) { 
			$novels[] = NovelModel::where("id_novel", $favorites[$i]->id_novel)->first();
		}

		$comments = CommentsModel::where("id_user", $id)->orderBy("id_comment", "DESC")->get();
		$data = (object)[
			"user" => $user,
			"novels" => $novels,
			"comments" => $comments,
			"access" => $access
		];

		return view("novel.profile", ["data" => $data]);
	}

	public function add_favorites(Request $request) {
		if(Auth::check()) {
			$user = Auth::user();
			$access = $user->access;
		} else {
			$message = "Вы не авторизированны";
			return view("novel.message", ["message" => $message]);
		}
		$id_novel = $request->route("id");
		$id_user = Auth::id();
		$favorites = FavoritesModel::where("id_user", $id_user)->where("id_novel", $id_novel)->first();

		if(!empty($favorites)) {
			$message = "Эта новелла уже находитя в вашем списке избранного";
		} else {
			$favorites = new FavoritesModel;
			$favorites->id_novel = $id_novel;
			$favorites->id_user = $id_user;
			$favorites->save();
			$message = "Новелла была добавлена в избранное";
		}

		$data = (object)[
			"message" => $message
		];

		return response(json_encode($data), 200)
			->header("Content-Type", "application/json");
	}

	public function delete_favorites(Request $request) {
		if(Auth::check()) {
			$user = Auth::user();
			$access = $user->access;
		} else {
			$message = "Вы не авторизированны";
			return view("novel.message", ["message" => $message]);
		}
		$id_novel = $request->route("id");
		$id_user = Auth::id();
		$favorites = FavoritesModel::where("id_user", $id_user)->where("id_novel", $id_novel)->first();
		if(empty($favorites)) {
			$message = "Эта новелла не находится у вас в списке избранного";
		} else {
			$favorites = FavoritesModel::find($favorites->id_favorites);
			$favorites->delete();
			$message = "Новелла была удалена из избранного";
		}

		$data = (object)[
			"message" => $message
		];

		return response(json_encode($data), 200)
			->header("Content-Type", "application/json");
	}

}
