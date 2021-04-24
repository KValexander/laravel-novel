@extends("novel.shablon")

@section("title")
	@if(!empty($data->novel->name_in_english)) {{ $data->novel->name }} / {{ $data->novel->name_in_english }}. @else {{ $data->novel->name }}. @endif
	Novel - База данных визуальных новел.
@endsection

@section("script")
	<script src = "{{ asset('novel/script/novel.js') }}"></script>
	<script src = "{{ asset('novel/script/comments.js') }}"></script>
	<script>
		$(function() {
			$("div.content").css("min-height", "800px");
			increase_image();
			background_image('{{ $data->novel->background }}');
		});
		function ajax_add_comment(name) {
			var js = {
				"name": name,
				"text": $("#text").val()
			};
			$.ajax({
				url: "/novel/{{ $data->novel->id_novel }}/comments/add",
				type: "POST",
				header: {
					"Content-Type": "application/json"
				},
				data: js,
				success: function(data) {
					call_alert(data.message);
					update_comments(data.comments);
				},
				error: function(jqXHR) {
					call_alert(jqXHR.responseText);
				}

			});
		}
		function ajax_delete_comment(id_user, id_comment) {
			var js = {
				"id_user": id_user,
				"id_comment": id_comment,
			};
			$.ajax({
				url: "/novel/{{ $data->novel->id_novel }}/comments/delete",
				type: "POST",
				header: {
					"Content-Type": "application/json"
				},
				data: js,
				success: function(data) {
					call_alert(data.message);
					update_comments(data.comments);
				},
				error: function(jqXHR) {
					call_alert(jqXHR.responseText);
				}
			});
		}
		function ajax_reply_comment(name, id_comment) {
			var js = {
				"name": name,
				"text": $("#reply").val(),
				"reply": id_comment,
			};
			$.ajax({
				url: "/novel/{{ $data->novel->id_novel }}/comments/reply",
				type: "POST",
				header: {
					"Content-Type": "application/json"
				},
				data: js,
				success: function(data) {
					call_alert(data.message);
					update_comments(data.comments);
				},
				error: function(jqXHR) {
					call_alert(jqXHR.responseText);
				}
			});
		}

		function ajax_add_favorites() {
			$.ajax({
				url: "/novel/{{ $data->novel->id_novel }}/add_favorites",
				type: "GET",
				success: function(data) {
					call_alert(data.message);
				},
				error: function(jqXHR) {
					call_alert(jqXHR.responseText);
				}
			});
		}
		function ajax_delete_favorites() {
			$.ajax({
				url: "/novel/{{ $data->novel->id_novel }}/delete_favorites",
				type: "GET",
				success: function(data) {
					call_alert(data.message);
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
		@if(!empty($data->novel->name_in_english))
			<h1>{{ $data->novel->name }} / {{ $data->novel->name_in_english }}</h1>
		@else
			<h1>{{ $data->novel->name }}</h1>
		@endif
	</div>
	<div class="session">
		@if($data->access == "Гость")
			<p> <a href="/login">Авторизация</a> / <a href="/register">Регистрация</a> </p>
		@else
			<p>Вы вошли как {{ $data->access }}. <a href="/logout">Выйти</a></p>
		@endif
	</div>
	<div class = "alert"><h3 id = "alert_message"></h3><input type="button" value = "Закрыть" onclick="callback_alert()" /></div>
	<div class = "increase_img"><div class="close"></div><img src="" alt=""></div>
	<div class="increase_img_overlay"></div>
@endsection

@section("sidebar")
	<div class="novel_content" style = "margin-top: 30px">
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
	@if($data->access != "Гость")
	<div class="favorites">
		<p><input type="button" value = "Добавить в избранное" onclick = "ajax_add_favorites()" /></p>
		<p><input type="button" value = "Удалить из избранного" onclick = "ajax_delete_favorites()" /></p>
	</div>
	@endif
@endsection

@section("content")
	<p style = "padding: 0">
		<!-- <input type="button" value = "На главную" onclick = "document.location.href='/'" /> -->
		@if($data->access == "Редактор" || $data->access == "Модератор" || $data->access == "Администратор")
		<input type="button" value = "Обновить информацию" onclick = "document.location.href='/update/novel/{{ $data->novel->id_novel }}'" />
		<input type="button" value = "Добавить персонажей" onclick = "document.location.href='/novel/{{ $data->novel->id_novel }}/add_character'" />
		@endif
	</p>

	<!-- Слайдер -->
	<!-- Если изображений в базе нет -->
	<div class = "wrap_slider">
		<div class="slider_images"></div>
	</div>

	<!-- Если изображения в базе есть -->
	@if(!empty($data->images))
		<script>
			var images = '{{ $data->images }}';
			var regex = /^(https?:\/\/)?([\w\.]+)\.([a-z]{2,6}\.?)(\/[\w\.]*)*\/?$/;
			var arr1 = [], arr2 = [], arr3 = [];

			arr1 = images.split("&quot");
			for(var i = 0; i < arr1.length; i++) {
				arr2 = arr1[i].split(";");
				arr2[0] = arr2[1];
				if(regex.test(arr2[0])) {
					arr3.push(arr2[0])
				}
			}

			var out = `<div class="main_image"><div id="slider" class = "slider_wrap">`;
			for(var i = 0; i < arr3.length; i++) {
				out += `<img class = "increase_image" id = "slide${i}" src = "${arr3[i]}" alt="${arr3[i]}" />`;
			}
			out += `</div></div>`;

			out += `<div class = "side_image">`;
			for(var i = 0; i < arr3.length; i++) {
				out += `<img onclick = "image_press('slide${i}')" src = "${arr3[i]}" alt="${arr3[i]}" />`;
			}
			out += `</div>`;

			$(".slider_images").html(out);
		</script>
	@endif

	<div class="wrap_content">
		<h3>Описание</h3>
		<p>{{$data->novel->description}}</p>
	</div>

	<div class="wrap_content">
		<h2>Персонажи</h2>
		@if(count($data->characters) == 0)
			<p>Информация отсутствует</p>
		@else
			@foreach($data->characters as $key => $val)
			<div class="wrap_character">
				<a href="/novel/{{ $data->novel->id_novel }}/character?id={{$val->id_character}}">
					<img src="{{ $val->image }}" alt="{{ $val->image }}">
					<h3>{{ $val->name_in_russian }}</h3>
				</a>
			</div>
			@endforeach
		@endif
	</div>

	<div class="wrap_content">
		<h2>Комментарии ({{ count($data->comments) }}):</h2>
		<div class="comments_form">
			@if($data->access == "Гость")
				<p>Добавлять комментарии могут только зарегистрированные пользователи</p>
				<p><a href="/login">[войти]</a> <a href="/register">[зарегистрироваться]</a></p>
			@else
				<div class="line"></div>
				<p><textarea class = "comment" id = "text" placeholder = "Введите ваш комментарий" cols="30" rows="10"></textarea></p>
				<p><input type="button" value = "Добавить комментарий" onclick = "ajax_add_comment('{{ $data->user->login }}')"></p>
			@endif
		</div>
		<div class="line"></div>
		<div class="comments">
			<a name="comments"></a>
			@if(count($data->comments) == 0)
				<h3>Комментарии отсутствуют</h3>
			@else
				@foreach($data->comments as $key => $val)
					@if($val->reply == 0)
						<?php $date = explode(' ', $val->updated_at) ?>
						<div class="wrap_comment">
							<a href="/profile/{{ $val->id_user }}"><h4>{{ $key }} {{ $val->name }}</h4></a>
							<p><?php echo $date[0] ?>
							@if($data->access != "Гость")
								@if($data->user->id == $val->id_user)
									<span class = "do" onclick = "ajax_delete_comment('{{ $val->id_user }}', '{{ $val->id_comment }}')">Удалить</span>
								@endif
							@endif
							</p>
							<p>{{ $val->text }}</p>
							@if($data->access != "Гость")
								<p id = "{{ $val->id_comment }}"><span class = "do" onclick = "reply('{{ $val->id_comment }}')">Ответить</span></p>
							@endif
						</div>
						@for($i = 0; $i < count($data->comments); $i++)
							@if($val->id_comment == $data->comments[$i]->reply)
								<?php $date = explode(' ', $data->comments[$i]->updated_at) ?>
								<div class="reply_comment">
									<a href="/profile/{{ $data->comments[$i]->id_user }}"><h4>{{ $i }} {{ $data->comments[$i]->name }}</h4></a>
									<p><?php echo $date[0] ?>
									@if($data->access != "Гость")
										@if($data->user->id == $data->comments[$i]->id_user)
											<span class = "do" onclick = "ajax_delete_comment('{{ $data->comments[$i]->id_user }}', '{{ $data->comments[$i]->id_comment }}')">Удалить</span>
										@endif
									@endif
									</p>
									<p>{{ $data->comments[$i]->text }}</p>
									@if($data->access != "Гость")
										<!-- <p id = "{{ $data->comments[$i]->id_comment }}"><span class = "do" id = "{{ $data->comments[$i]->id_comment }}" onclick = "reply('{{ $data->comments[$i]->id_comment }}')">Ответить</span></p> -->
									@endif
								</div>
							@endif
						@endfor
					@endif
				@endforeach
			@endif
		</div>
	</div>

@endsection

@section("footer")
@endsection