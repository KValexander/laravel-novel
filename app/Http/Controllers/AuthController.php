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

class AuthController extends Controller {

	public function register_form() {
		if(Auth::check()) {
			$user = Auth::user();
			$access = $user->access;
		} else {
			$access = "Гость";
		}
		$data = (object)[
			"access" => $access
		];
		return view("novel.register", ["data" => $data]);
	}

	public function login_form() {
		if(Auth::check()) {
			$user = Auth::user();
			$access = $user->access;
		} else {
			$access = "Гость";
		}
		$data = (object)[
			"access" => $access
		];
		return view("novel.login", ["data" => $data]);
	}

	public function register(Request $request) {

		$validator = Validator::make($request->all(), [
			"email" => "required|string|regex:/@/",
			"login" => "required|string|unique:users,login|min:4",
			"password" => "required|min:8",
		]);

		if($validator->fails()) {
			$errors = $validator->errors();
			return view("novel.message", ["message" => json_encode($errors)]);
		}

		$user = new UsersModel;
		$user->email = $request->input("email");
		$user->login = $request->input("login");
		$user->password = bcrypt($request->input("password"));
		if($request->has("access")) $user->access = $request->input("access");
		else $user->access = "Пользователь";
		$user->save();

		$message = "Вы успешно зарегистрировались";
		return view("novel.message", ["message" => $message]);
	}

	public function ajax_register(Request $request) {
		$validator = Validator::make($request->all(), [
			"email" => "required|string|regex:/@/",
			"login" => "required|string|unique:users,login",
			"password" => "required|min:8",
		]);
		if(Auth::check()) {
			$message = "Вы уже авторизированны";
			return response(json_encode($message), 200)
				->header("Content-Type", "application/json");
		}

		if($validator->fails()) {
			$errors = $validator->errors();
			return response(json_encode($errors), 422)
				->header("Content-Type", "application/json");
		}

		$user = new UsersModel;
		$user->email = $request->input("email");
		$user->login = $request->input("login");
		$user->password = bcrypt($request->input("password"));

		if($request->has("access")) $user->access = $request->input("access");
		else $user->access = "Пользователь";

		$user->save();

		$message = "Вы успешно зарегистрировались";
			return response(json_encode($message), 200)
				->header("Content-Type", "application/json");

	}

	public function login(Request $request) {

		if(Auth::check()) {
			$message = "Вы уже авторизированны";
			return view("novel.message", ["message" => $message]);
		}

		$login = $request->input("login");
		$password = $request->input("password");

		if(Auth::attempt(["login" => $login, "password" => $password], true)) {
			$message = "Вы успешно авторизировались";
		} else {
			$message = "Такого пользователя нет в нашей базе";
		}

		return view("novel.message", ["message" => $message]);
	}

}
