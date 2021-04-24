@extends("novel.shablon")

@section("title")
	{{ $data->developer->developer }}. Novel - База данных визуальных новелл.
@endsection

@section("script")
	<script>
		$(function() {
			$("div.content").css("min-height", "540px");
		});
	</script>
@endsection

@section("header")
	<div class="head">
		<h1>Разработчик - {{ $data->developer->developer }}</h1>
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
	<div class="wrap_developer">
		<img src="{{ $data->developer->logo }}" alt="{{ $data->developer->logo }}">
		<div class="line"></div>
		<h3>Основная информация</h3>
		<p><b>Название компании:</b> {{ $data->developer->developer }}</p>
		<p><b>Дата основания:</b> {{ $data->developer->foundation_date }}</p>
		<p><b>Местоположение:</b> {{ $data->developer->location }}</p>
		<p><b>Язык:</b> {{ $data->developer->language }}</p>
	</div>
@endsection

@section("content")
	<p>
		<input type="button" value = "На главную" onclick = "document.location.href='/'" />
		@if($data->access == "Администратор" || $data->access == "Модератор")
		<!-- <input type="button" value = "Удалить разработчика" onclick = "document.location.href='/delete/developer/{{ $data->developer->id_developer }}'" /> -->
		@endif
	</p>
	<div class = "wrap_developer">
		<h3>Описание</h3>
		<p>{{ $data->developer->description }}</p>
	</div>
	<div class="wrap_developer_novel">
		<h2>Новеллы разработчика</h2>
		<div class = "list_novel">
			@if(count($data->novels) == 0)
				<h3>Информация отсутствует</h3>
			@else
				@foreach($data->novels as $key => $val)
					<div class="wrap">
						<div class = "novel">
							<img src="{{ $val->image }}" alt="{{$val->name}}">
							<a href="/novel/{{$val->id_novel}}"><h3>{{ $val->name }}</h3></a>
						</div>
					</div>
				@endforeach
			@endif
		</div>
	</div>
@endsection

@section("footer")
@endsection