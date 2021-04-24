@extends("novel.shablon")

@section("title")
	Novel - База данных визуальных новелл. Страница добавления разработчика.
@endsection


@section("header")
	<div class="head">
		<h1>Страница добавления разработчика</h1>
	</div>
	<div class="session">
		@if($data->access == "Гость")
			<p> <a href="/login">Авторизация</a> / <a href="/register">Регистрация</a> </p>
		@else
			<p>Вы вошли как {{ $data->access }}. <a href="/logout">Выйти</a></p>
		@endif
	</div>
@endsection

@section("sidebar")
@endsection

@section("content")
	<p><input type="button" value = "Вернуться" onclick = "document.location.href='/moderation'" /></p>
	<div class="wrap_form" style = "margin-top: 20px; margin-bottom: 0px;">
		<h2>Добавление разработчика</h2>
		<form method = "POST">
			{!! csrf_field() !!}
			<p><input type="text" name = "developer" placeholder = "Название компании" /></p>
			<p><input type="text" name = "logo" placeholder = "Логотип компании (URL)" /></p>
			<p><input type="text" name = "foundation_date" placeholder = "Дата основания" /></p>
			<p><textarea name="description" placeholder = "Описание"></textarea></p>
			<p><input type="text" name = "location" placeholder = "Местоположение (страна, город)" /></p>
			<p><input type="text" name = "language" placeholder = "Язык" /></p>
			<p><input type="submit" value = "Добавить" /></p>
		</form>
	</div>
@endsection