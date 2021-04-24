@extends("novel.shablon")

@section("title")
	Novel - База данных визуальных новел. Страница добавления справочников.
@endsection

@section("script")
	<script>
		var out;
		var js;

		ajax_genres();

		function ajax_add_genre() {
			js = `?genre=${$("#genre").val()}`;
			$.ajax({
				url: "/add/ajax/directory" + js,
				type: "GET",
				success: function(data) {
					select_genre(data.genres);
					call_alert(data.message);
					document.querySelector("#genre").value = "";
				},
				error: function(jqXHR) {
					out = `<p>${jqXHR.responseText}</p>`;
					$(".content").html(out);
				}
			});
		}

		function ajax_delete_genre() {
			js = '?id_genre=' + $("#id_genre").val();
			$.ajax({
				url: "/delete/directory" + js,
				type: "GET",
				success: function(data) {
					select_genre(data.genres);
					call_alert(data.message);
				},
				error: function(jqXHR) {
					out = `<p>${jqXHR.responseText}</p>`;
					$(".content").html(out);
				}
			});
		}

		function ajax_genres() {
			$.ajax({
				url: "/add/ajax/directory",
				type: "GET",
				success: function(data) {
					select_genre(data);
					console.log(data);
				},
				error: function(jqXHR) {
					out = `<p>${jqXHR.responseText}</p>`;
					$(".content").html(out);
				}
			});
		}

		function select_genre(data) {
			out = `<option disabled selected>Жанры</option>`;
			for(var i = 0; i < data.length; i++) {
				out += `<option value="${data[i].id_genre}" >${data[i].genre}</option>`;
			}
			$("select.genres").html(out);
		}
		
	</script>
@endsection

@section("header")
	<div class="head">
		<h1>Страница добавления справочников</h1>
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
	<p><input type="button" value = "Вернуться" onclick = "document.location.href='/moderation'" /></p>

	<div class="wrap_form" style = "margin-top: 20px; margin-bottom: 0px;">
		<h2>Добавление и удаление жанров</h2>
		<p>
			<input type="text" class = "items" id = "genre" placeholder = "Введите название жанра">
			<input type="button" value = "Добавить" onclick = "ajax_add_genre()" />
		</p>
		<p>
			<select class = "genres items" id = "id_genre"></select>
			<input type="button" value = "Удалить" onclick = "ajax_delete_genre()">
		</p>
	</div>
@endsection