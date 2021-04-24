@extends("novel.shablon")

@section("title")
	Novel - База данных визуальных новелл. Страница модерации.
@endsection

@section("script")
	<script>
		var out;

		$(function() {
			$("div.novel_content").css("display", "none");
		});

		function ajax_confirmation(id) {
			$.ajax({
				url: "/moderation/ajax_active/" + id,
				type: "GET",
				success: function(data) {
					novel_out(data.novels);
					call_alert(data.message);
				},
				error: function(jqXHR) {
					call_alert(jqXHR.responseText);
				}
			});
		}

		function novel_out(data) {
			out = "";
			if(data.length == 0) {
				out = "<h3>Информация отсутствует</h3>"
			} else {
				for(var i = 0; i < data.length; i++) {
					out += `
						<div class="moderation">
							<div class = "novels">
								<img src="${ data[i].image }" alt="${ data[i].image }">
								<h3><a href="/novel/${ data[i].id_novel }">${ data[i].name }</a></h3>
								<p><b>Год релиза:</b> ${ data[i].year_release }</p>
								<p><b>Тип:</b> ${ data[i].type }</p>
								<p><b>Платформа:</b> ${ data[i].platform }</p>
								<p><b>Продолжительность:</b> ${ data[i].duration }</p>
								<p><b>Жанры:</b> ${ data[i].genres }</p>
								<p><b>Разработчик:</b> ${ data[i].developer }</p>
								<p><b>Язык:</b> ${ data[i].language }</p>
							</div>
							<div class="access" onclick = "ajax_confirmation('${ data[i].id_novel }')">Подтвердить</div>
						</div>
					`;
				}
			}
			$(".list_novel").html(out);
		}
	</script>
@endsection

@section("header")
	<div class="head">
		<h1>Страница модерирования</h1>
	</div>
	<div class="session">
		<p>Вы вошли как {{ $data->access }}. <a href="/logout">Выйти</a></p>
	</div>
	<div class = "alert"><h3 id = "alert_message"></h3><input type="button" value = "Закрыть" onclick="callback_alert()" /></div>
@endsection

@section("sidebar")
	<div class="novel_content"></div>
@endsection

@section("content")
	<p>
		<input type="button" value = "На главную" onclick = "document.location.href='/'" />
		<input type="button" value = "Добавить справочники" onclick = "document.location.href='/add/directory'" />
		<input type="button" value = "Добавить разработчика" onclick = "document.location.href='/add/developer'" />
	</p>
	<h2>Список новелл на подтверждение</h2>
	<div class = "list_novel">
		@if(count($data->novels) == 0)
			<h3>Информация отсутствует</h3>
		@else
			@foreach($data->novels as $key => $val)
			<div class="moderation">
				<div class = "novels">
					<img src="{{ $val->image }}" alt="{{ $val->image }}">
					<h3><a href="/novel/{{$val->id_novel}}">{{ $val->name }}</a></h3>
					<p><b>Год релиза:</b> {{ $val->year_release }}</p>
					<p><b>Тип:</b> {{ $val->type }} </p>
					<p><b>Платформа:</b> {{ $val->platform }} </p>
					<p><b>Продолжительность:</b> {{ $val->duration }} </p>
					<p><b>Жанры:</b> {{ $val->genres }} </p>
					<p><b>Разработчик:</b> {{ $val->developer }} </p>
					<p><b>Язык:</b> {{ $val->language }} </p>
				</div>
				<div class="access" onclick = "ajax_confirmation('{{ $val->id_novel }}')">Подтвердить</div>
			</div>
			@endforeach
		@endif
	</div>
@endsection

@section("footer")
@endsection