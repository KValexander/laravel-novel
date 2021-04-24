@extends("novel.shablon")

@section("title")
	Novel - База данных визуальных новелл. Добавление персонажей.
@endsection

@section("script")
	<script>
		var out;
		var js;
		$(function() {
			increase_image();
			background_image('{{ $data->novel->background }}');
		});

		function ajax_add_character(id) {
			js = $("form").serialize();
			$.ajax({
				url: "/novel/" + id + "/ajax/character",
				type: "POST",
				header: {
					"Content-Type": "application/json"
				},
				data: js,
				success: function(data) {
					call_alert(data);
				},
				error: function(jqXHR) {
					call_alert(jqXHR.responseText);
				}
			});
		}

		function character_preview() {
			if ($("#image").val() == "") {
				out = "<h3 style = 'padding: 0'>Заполните поля</h3>"
			} else {
				out = `
					<img src = "${ $("#image").val() }" />
					<h3>${ $("#name").val() }</h3>
				`;
			}
			$("div.character_preview").html(out);
		}
	</script>
@endsection

@section("header")
	<div class="head">
		<h1>Страница добавления персонажей</h1>
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
	<div class="character_preview"></div>
@endsection

@section("content")
	<!-- Кнопки перехода -->
	<p><input type="button" value = "Вернуться" onclick = "document.location.href='/novel/{{ $data->novel->id_novel }}'" /></p>

	<!-- Обёртка формы добавления персонажей -->
	<div class="wrap_form" id = "once">
		<h2>Добавление персонажа</h2>
		<form>
			<p><input type="text" name = "image" id = "image" placeholder = "Введите URL ссылку на изображение персонажа"></p>
			<p><input type="text" name = "name_in_russian" id = "name" placeholder = "Имя по русски"></p>
			<p><input type="button" value = "Посмотреть" onclick = "character_preview()"></p>
			<p><input type="text" name = "original_name" placeholder = "Оригинальное имя"></p>
			<p>
				<select name="gender">
					<option value="Мужской">Мужской</option>
					<option value="Женский">Женский</option>
				</select>
			</p>
			<p><input type="text" name = "role" placeholder = "Роль"></p>
			<p><textarea name="description" placeholder = "Описание" cols="30" rows="10"></textarea></p>
			<p><input type="button" value = "Добавить" onclick = "ajax_add_character('{{ $data->novel->id_novel }}')"></p>
		</form>
	</div>
@endsection