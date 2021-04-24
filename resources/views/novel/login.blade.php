@extends("novel.shablon")

@section("title")
	Novel - База данных визуальных новелл. Страница авторизации.
@endsection

@section("script")
@endsection

@section("header")
	<div class="head">
		<h1>Авторизация</h1>
	</div>
	<div class="session">
		@if($data->access == "Гость")
			<p> <a href="/login">Авторизация</a> / <a href="/register">Регистрация</a> </p>
		@else
			<p>Вы вошли как {{ $data->access }}. <a href="/logout">Выйти</a></p>
		@endif
	</div>
	<div class = "alert">
		<h3 id = "alert_message"></h3>
		<input type="button" value = "Закрыть" onclick="callback_alert()" />
	</div>
@endsection

@section("sidebar")
@endsection

@section("content")
	<!-- Некое подобие меню -->
	<p>
		<input type="button" value = "На главную" onclick = "document.location.href='/'" />
		<input type="button" value = "Регистрация" onclick = "document.location.href='/register'" />
	</p>

	<div class="wrap_form" id = "once">
		<h2>Форма авторизации</h2>
		<form method = "POST">
			<p><input type="text" placeholder = "Введите ваш логин" name = "login"></p>
			<p><input type="text" placeholder = "Введите ваш пароль" name = "password"></p>
			<p><input type="submit" value = "Войти"></p>
		</form>
	</div>
@endsection

@section("footer")
@endsection