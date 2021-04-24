@extends("novel.shablon")

@section("title")
	Novel - База данных визуальных новелл. Главная страница.
@endsection

@section("script")
	<script>
		var out;

		$(function() {
			var count = '{{ $data->tape->count }}'; // Количество записей
			var n = '{{ $data->tape->n }}'; // Количество постов на одной странице
			var page = '{{ $data->tape->page }}'; // Номер текущей страницы
			var k = 1, all_page, width, color; // Используемые переменные
			all_page = Math.ceil(count / n); // Количество создаваемых страниц
			width = (all_page * 35) + 5; // Ширина для хранения блоков переключения страниц
			$("div.tape").css("width", width);
			out = "";
			for(var i = 0; i < all_page; i++) {
				color = "";
				if (i == page) color = "style='background-color: #FF9A0F'";
				out += `<div class = "unit" ${color} onclick="document.location.href='/?page=${i}'">${k}</div>`;
				k++;
			}
			$("div.tape").html(out);
		});

		function novel_preview(id) {
			$.ajax({
				url: "/ajax/" + id,
				type: "GET",
				success: function(data) {
					var out = `
					<img src = "${data.image}" alt="${data.image}" />
					<div class="line"></div>
					<p><b>Год релиза:</b> ${data.year_release}</p>
					<p><b>Тип:</b> ${data.type} </p>
					<p><b>Платформа:</b> ${data.platform} </p>
					<p><b>Продолжительность:</b> ${data.duration} </p>
					<p><b>Жанры:</b> ${data.genres} </p>
					<p><b>Разработчик:</b> ${data.developer} </p>
					<p><b>Язык:</b> ${data.language} </p>`;
					$(".novel_preview").html(out);
				}
			});
		}
		
		function novel_leave() {
			var out = `<h3>Наведитесь на новеллу</h3>`;
			$(".novel_preview").html(out);
		}
	</script>
@endsection

@section("header")
	<div class="head">
		<h1>Главная страница</h1>
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
	<div class="novel_preview">
		<h3>Наведитесь на новеллу</h3>
	</div>
@endsection

@section("content")
	<!-- Некое подобие меню -->
	<p>
		@if($data->access == "Модератор" || $data->access == "Администратор")
		<input type="button" value = "Страница модерирования" onclick = "document.location.href='/moderation'" />
		@endif
		@if($data->access == "Редактор" || $data->access == "Модератор" || $data->access == "Администратор")
		<input type="button" value = "Добавить новеллу" onclick = "document.location.href='/add/novel'" />
		@endif
	</p>

	<!-- Список новелл -->
	<h2>Список новелл</h2>
	<div class = "list_novel">
		<p>
			<form action="/search" method="GET">
				<input type="text" class = "search" name = "query" placeholder = "Поиск">
				<input type="submit" class = "search" value = "Поиск">
			</form>
		</p>
		@if(count($data->novels) == 0)
			<h3>Информация отсутствует</h3>
		@else
			@foreach($data->novels as $key => $val)
				<div class="wrap">
					<div class = "novel">
						<img src="{{ $val->image }}" onmouseenter="novel_preview('{{$val->id_novel}}')" onmouseleave="//novel_leave()" alt="{{$val->name}}">
						<a href="/novel/{{$val->id_novel}}"><h3>{{ $val->name }}</h3></a>
					</div>
				</div>
			@endforeach
		@endif
		<!-- Обёртка для кнопок перехода по страницам -->
		<div class = "tape"></div>
	</div>

	<!-- Список разработчиков -->
	<h2>Список разработчиков</h2>
	<div class="list_developer">
		@if(count($data->developers) == 0)
			<h3>Информация отсутствует</h3>
		@else
			@foreach($data->developers as $key => $val)
			<div class="developer">
				<a href="/developer/{{ $val->id_developer }}">
					<img src="{{ $val->logo }}" alt="{{ $val->logo }}">
					<h3>{{ $val->developer }}</h3>
				</a>
			</div>
			@endforeach
		@endif
	</div>
@endsection

@section("footer")
@endsection