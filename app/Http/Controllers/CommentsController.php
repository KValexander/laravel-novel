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

class CommentsController extends Controller {

	public function add_comment(Request $request) {
		$validator = Validator::make($request->all(), [
			"text" => "required|string"
		]);
		
		if($validator->fails()) {
			$errors = $validator->errors();
			return response(json_encode($errors), 422)
				->header("Content-Type", "application/json");
		}

		$novel = NovelModel::find($request->route("id"));

		$comment = new CommentsModel;
		$comment->id_novel = $request->route("id");
		$comment->id_user = Auth::id();
		$comment->name = $request->input("name");
		$comment->novel = $novel->name;
		$comment->text = $request->input("text");
		$comment->save();

		$message = "Комментарий добавлен";
		$comments = CommentsModel::where("id_novel", $request->route("id"))->get();
		
		$data = (object)[
			"message" => $message,
			"comments" => $comments
		];

		return response(json_encode($data), 200)
			->header("Content-Type", "application/json");
	}

	public function delete_comment(Request $request) {
		$id_session = Auth::id();
		$id_user = $request->input("id_user");
		$id_comment = $request->input("id_comment");
		
		if($id_user == $id_session) {
			$comment = CommentsModel::find($id_comment);
			$comment->delete();
			$message = "Комментарий удалён";
		} else {
			$message = "Доступ запрещён";
		}

		$comments = CommentsModel::where("id_novel", $request->route("id"))->get();

		$data = (object)[
			"message" => $message,
			"comments" => $comments
		];

		return response(json_encode($data), 200)
			->header("Content-Type", "application/json");
	}

	public function reply_comment(Request $request) {
		$validator = Validator::make($request->all(), [
			"text" => "required|string"
		]);
		
		if($validator->fails()) {
			$errors = $validator->errors();
			return response(json_encode($errors), 422)
				->header("Content-Type", "application/json");
		}

		$comment = new CommentsModel;
		$comment->id_novel = $request->route("id");
		$comment->id_user = Auth::id();
		$comment->name = $request->input("name");
		$comment->text = $request->input("text");
		$comment->reply = $request->input("reply");
		$comment->save();

		$message = "Комментарий добавлен";
		$comments = CommentsModel::where("id_novel", $request->route("id"))->get();
		
		$data = (object)[
			"message" => $message,
			"comments" => $comments
		];

		return response(json_encode($data), 200)
			->header("Content-Type", "application/json");

	}
}
