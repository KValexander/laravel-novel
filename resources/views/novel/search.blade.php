@extends("novel.shablon")

@section("title")
	Результаты ({{$data->query}}). Novel - База данных визуальных новелл.
@endsection

@section("script")
@endsection

@section("header")
	<div class="head">
		<h1>Результаты поиска ({{$data->query}})</h1>
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
	<p><input type="button" value = "На главную" onclick = "document.location.href='/'" /></p>
	<div class="wrap_search">
		@if(count($data->novels) == 0)
			<h2>Ничего не найдено.</h2>
		@else
			@foreach($data->novels as $key => $val)
				<div class="search_novel">
					<a href="/novel/{{ $val->id_novel }}"><img src="{{ $val->image }}" alt="">
					<h3>{{ $val->name }}</h3></a>
					<p><b>Год релиза:</b> {{ $val->year_release }}</p>
					<p><b>Тип:</b> {{ $val->type }} </p>
					<p><b>Платформа:</b> {{ $val->platform }} </p>
					<p><b>Продолжительность:</b> {{ $val->duration }} </p>
					<p><b>Жанры:</b> {{ $val->genres }} </p>
					<p><b>Разработчик:</b> {{ $val->developer }} </p>
					<p><b>Язык:</b> {{ $val->language }} </p>
				</div>
			@endforeach
		@endif
	</div>
@endsection

@section("footer")
@endsection