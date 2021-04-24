@extends("novel.shablon")

@section("title")
	Novel - База данных визуальных новелл. Страница обновления информации.
@endsection

@section("script")
	<script>
		$(function() {
			background_image('{{ $data->user->background }}');
		});
		
		function profile_preview(url) {
			background_image(url);
		}

		function avatar_preview() {
			out = `
				<img src = "${$('#avatar').val()}" alt = "${$('#avatar').val()}" />
			`;
			$(".avatar").html(out);
		}

		function ajax_update_profile() {
			$.ajax({
				url: "/personal_area/update",
				type: "POST",
				header: {
					"Content-Type": "application/json"
				},
				data: $("form").serialize(),
				success: function(data) {
					call_alert(data);
				},
				error: function(jqXHR) {
					call_alert(jqXHR.responseText);
				}
			});
		}
	</script>
@endsection

@section("header")
	<div class="head">
		<h1>Страница обновления информации</h1>
	</div>
	<div class="session">
		<p>Вы вошли как {{ $data->access }}. <a href="/logout">Выйти</a></p>
	</div>
	<div class = "alert"><h3 id = "alert_message"></h3><input type="button" value = "Закрыть" onclick="callback_alert()" /></div>
@endsection

@section("sidebar")
	<div class="wrap_profile_sidebar">
		<div class="avatar"></div>
	</div>
@endsection

@section("content")
	<p><input type="button" value = "Вернуться" onclick = "document.location.href='/personal_area'" /></p>

	<form method = "POST">
		{!! csrf_field() !!}
		<div class="wrap_form" id = "once">
			<p><input type="text" name = "login" value = "{{ $data->user->login }}" placeholder = "Логин (менять нельзя)" disabled></p>
			<p><input type="text" name = "password" value = "{{ $data->user->password }}" placeholder = "Пароль (менять нельзя)" disabled></p>
			<p><input type="text" name = "email" value = "{{ $data->user->email }}" placeholder = "email (менять нельзя)" disabled></p>
			<p>
				<input type="text" value = "{{ $data->user->avatar }}" name = "avatar" id = "avatar" class = "items" placeholder = "Вставьте URL изображения аватарки">
				<input style = "margin-right: 12px;" type="button" value = "Посмотреть" onclick = "avatar_preview()">
			</p>
			<p><input type="text" value = "{{ $data->user->name }}" name = "name"  placeholder = "Ваше имя"></p>
			<p><textarea name="status" placeholder = "Ваш статус" name = "status" cols="30" rows="10">{{ $data->user->status }}</textarea></p>
			<p>
				<input type="text" value = "{{ $data->user->background }}" name = "background" id = "background" class = "items" placeholder = "Вставьте URL изображения для заднего фона">
				<input style = "margin-right: 12px;" type="button" value = "Посмотреть" onclick = "profile_preview($('#background').val())">
			</p>
			<p><input type="button" value = "Сохранить" onclick = "ajax_update_profile()"></p>
		</div>
	</form>
@endsection