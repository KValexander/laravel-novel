@extends("novel.shablon")

@section("title")
	Novel - База данных визуальных новелл. Страница регистрации.
@endsection

@section("script")
	<script>
		function ajax_registration() {
			$.ajax({
				url: "/register/ajax",
				type: "POST",
				header: {
					"Content-Type": "application/json"
				},
				data: $("form").serialize(),
				success: function(data) {
					$("form")[0].reset();
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
		<h1>Регистрация</h1>
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
		<input type="button" value = "Авторизация" onclick = "document.location.href='/login'" />
	</p>

	<div class="wrap_form" id = "once">
		<h2>Форма регистрации</h2>
		<form method = "POST">
			<p><input type="text" placeholder = "Введите логин" name = "login"></p>
			<p><input type="password" placeholder = "Введите пароль" name = "password"></p>
			<p><input type="text" placeholder = "Введите вашу почту" name = "email"></p>
			@if($data->access == "Модератор" || $data->access == "Администратор")
				<p>
					<select name="access">
						@if($data->access == "Администратор")
							<option value="Администратор">Администратор</option>
							<option value="Модератор">Модератор</option>
						@endif
						<option value="Редактор">Редактор</option>
						<option value="Пользователь" selected>Пользователь</option>
					</select>
				</p>
			@endif
			<p><input type="button" value = "Зарегистрироваться" onclick = "ajax_registration()"></p>
		</form>
	</div>
@endsection

@section("footer")
@endsection