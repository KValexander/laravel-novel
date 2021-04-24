<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Match;

// Главная
Route::get("/", "NovelController@main_page")->name("main");


// Форма регистрации
Route::get("/register", "AuthController@register_form")->name("register");
// Форма авторизации
Route::get("/login", "AuthController@login_form")->name("login");

// Запрос на регистрацию
Route::post("/register", "AuthController@register");
// Запрос на регистрацию для ajax
Route::post("/register/ajax", "AuthController@ajax_register");
// Запрос на авторизацию
Route::post("/login", "AuthController@login");

// Личный кабинет
Route::get("/personal_area", "UserController@personal_area");
// Страницы пользователей
Route::get("/profile/{id}", "UserController@profile");

// Запрос на вывод информации об определённой новелле
Route::get("/novel/{id}", "NovelController@novel")->name("novel");
// Запрос на получение информации об определённой новелле
Route::get("/ajax/{id}", "NovelController@ajax_novel");

// Запрос на добавление новеллы в избранное
Route::get("/novel/{id}/add_favorites", "UserController@add_favorites");
// Запрос на удаление новеллы из избранных
Route::get("/novel/{id}/delete_favorites", "UserController@delete_favorites");

// Обновление информации о пользователе
Route::get("/personal_area/update", "UserController@update_form");
Route::post("/personal_area/update", "UserController@update");

// Удаление пользователя
Route::get("/delete/profile", "UserController@delete");

// Запрос на добавление комментария
Route::post("/novel/{id}/comments/add", "CommentsController@add_comment");
// Запрос на удаление комментария
Route::post("/novel/{id}/comments/delete", "CommentsController@delete_comment");
// Запрос на добавление комментария ответа другому комментарию
Route::post("/novel/{id}/comments/reply", "CommentsController@reply_comment");

// Запрос на вывод информации об определённом персонаже
Route::get("/novel/{id}/character", "CharacterController@character")->name("character");

// Запрос на вывод информации об определённом разработчике
Route::get("/developer/{id}", "DeveloperController@developer")->name("developer");

// Запрос на поиск новеллы
Route::get("/search", "SearchController@search");


// Группа маршрутов с особыми правами доступа
Route::group(["middleware" => "session"], function() {
	Route::get("/add/novel", "AddController@addformnovel")->name("add_novel");
	Route::post("/add/novel", "AddController@addnovel");

	Route::get("/novel/{id}/add_character", "AddCharacterController@add_form_character")->name("add_character");
	Route::post("/novel/{id}/ajax/character", "AddCharacterController@ajax_add_character");

	Route::get("/add/developer", "AddController@addformdeveloper")->name("add_developer");
	Route::post("/add/developer", "AddController@adddeveloper");

	Route::get("/add/directory", "AddDirectoryController@addformdirectory")->name("add_directory");
	Route::get("/add/ajax/directory", "AddDirectoryController@ajax_directory");

	Route::get("/update/novel/{id}", "UpdateController@formupdatenovel")->name("update_novel");
	Route::post("/update/ajax_novel/{id}", "UpdateController@ajax_update_novel");

	Route::get("/delete/novel/{id}", "DeleteController@deletenovel");
	Route::get("/delete/developer/{id}", "DeleteController@deletedeveloper");
	Route::get("/delete/directory", "DeleteController@ajax_delete_directory");

	Route::get("/moderation", "ModerationController@moderation")->name("moderation");
	Route::get("/moderation/ajax_active/{id}", "ModerationController@ajax_active_novel");
	Route::get("/moderation/deactive/{id}", "ModerationController@deactive_novel");
});

// Ответочка в случае отсутствия прав
Route::get("message", function() {
	$message = "У вас нет прав доступа к данному разделу";
	return view("novel.message", ["message" => $message]);
})->name("message");


// Выход из аккаунта
Route::get("/logout", function() {
	if(Auth::check()) { Auth::logout(); $message = "Вы вышли";
	} else { $message = "Вы не авторизированы"; }
	// $data = (object)["access" => "Гость"];
	// return view("novel.login", ["data" => $data]);
	return view("novel.message", ["message" => $message]);
});