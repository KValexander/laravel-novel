@extends("novel.shablon")

@section("title")
	@if(!empty($data->novel->name_in_english))
		{{ $data->novel->name }} / {{ $data->novel->name_in_english }}.
	@else
		{{ $data->novel->name }}.
	@endif
	Novel - База данных визуальных новел.
@endsection

@section("script")
	<script src = "{{ asset('novel/script/novel.js') }}"></script>
	<script>
		$(function() {
			$("div.content").css("min-height", "800px");
			increase_image();
			background_image('{{ $data->novel->background }}');
		});
	</script>
@endsection

@section("header")
	<div class="head">
		<h1>Персонаж - {{ $data->character->name_in_russian }} / {{ $data->character->original_name }}</h1>
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
	<div class="novel_content">
		<img src = "{{ $data->novel->image }}" alt="{{ $data->novel->image }}" />
		<div class="line"></div>
		<p><b>Год релиза:</b> {{ $data->novel->year_release }}</p>
		<p><b>Тип:</b> {{ $data->novel->type }} </p>
		<p><b>Платформа:</b> {{ $data->novel->platform }} </p>
		<p><b>Продолжительность:</b> {{ $data->novel->duration }} </p>
		<p><b>Жанры:</b> {{ $data->novel->genres }} </p>
		<p><b>Разработчик:</b> {{ $data->novel->developer }} </p>
		<p><b>Язык:</b> {{ $data->novel->language }} </p>
	</div>
@endsection

@section("content")
	<p>
		<input type="button" value = "Вернуться" onclick = "document.location.href='/novel/{{ $data->novel->id_novel }}'" />
	</p>

	<div class="wrap_content">
		<h2>Основная информация</h2>
		<div class="wrap">
			<img src="{{ $data->character->image }}" alt="{{ $data->character->image }}">
			<p><b>Оригинальное имя:</b> {{ $data->character->original_name }}</p>
			<p><b>Имя по русски:</b> {{ $data->character->name_in_russian }}</p>
			<p><b>Пол:</b> {{ $data->character->gender }}</p>
			<p><b>Роль:</b> {{ $data->character->role }}</p>
		</div>
	</div>

	<div class="wrap_content">
		<h3>Описание</h3>
		<p>{{ $data->character->description }}</p>
	</div>

@endsection

@section("footer")
@endsection