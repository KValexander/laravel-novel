@extends("novel.shablon")

@section("title")
	@if(!empty($data->novel->name_in_english))
		{{ $data->novel->name }} / {{ $data->novel->name_in_english }}.
	@else
		{{ $data->novel->name }}.
	@endif
	{{ $data->novel->name }}. Novel - База данных визуальных новелл. Обновление новеллы.
@endsection

@section("script")
	<script src = "{{ asset('novel/script/update.js') }}"></script>
	<script>
		var out;
		$(function() {
			$("div.content").css("min-height", "750px");
			image_preview();
			increase_image();
			background_image('{{ $data->novel->background }}');

			var count = $(".addit_image p input").length;
			out = "";
			if (count != 6) {
				for(var i = ++count; i <= 6; i++) {
					out += `<p><input class = "slide" type="text" placeholder = "Изображение ${i}" name = "image${i}"></p>`;
				}
				$(".addit_image").append(out);
			}

			// Скрипт для выбора типа новеллы по умолчанию
			const type = document.querySelector("#type").getElementsByTagName("option");
			for(var i = 0; i < type.length; i++) { if (type[i].value == "{{$data->novel->type}}") type[i].selected = true; }

			// Скрипт для выбора продолжительности новеллы по умолчанию
			const duration = document.querySelector("#duration").getElementsByTagName("option");
			for(var i = 0; i < duration.length; i++) { if (duration[i].value == "{{$data->novel->duration}}") duration[i].selected = true; }

			// Скрипт для выбора платформы новеллы по умолчанию
			const platform = document.querySelector("#platform").getElementsByTagName("option");
			for(var i = 0; i < platform.length; i++) { if (platform[i].value == "{{$data->novel->platform}}") platform[i].selected = true; }

			// Скрипт для выбора возрастного рейтинга новеллы по умолчанию
			const age_raiting = document.querySelector("#age_raiting").getElementsByTagName("option");
			for(var i = 0; i < age_raiting.length; i++) { if (age_raiting[i].value == "{{$data->novel->age_raiting}}") age_raiting[i].selected = true; }
		});

		function ajax_update(id) {
			js = $("form").serialize();
			console.log(js);
			$.ajax({
				url: "/update/ajax_novel/" + id,
				type: "POST",
				data: js,
				header: {
					"Content-Type": "application/json"
				},
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
		<h1>Страница обновления информации о новелле</h1>
	</div>
	<div class="session">
		@if($data->access == "Гость")
			<p> <a href="/login">Авторизация</a> / <a href="/register">Регистрация</a> </p>
		@else
			<p>Вы вошли как {{ $data->access }}. <a href="/logout">Выйти</a></p>
		@endif
	</div>
	<div class = "alert"><h3 id = "alert_message"></h3><input type="button" value = "Вернуться" onclick="document.location.href='/novel/{{ $data->novel->id_novel }}'" /></div>
	<div class = "increase_img"><div class="close"></div><img src="" alt=""></div>
	<div class="increase_img_overlay"></div>
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
		@if($data->access == "Модератор" || $data->access == "Администратор")
			<input type="button" value = "Вернуть на модерацию" onclick = "document.location.href='/moderation/deactive/{{ $data->novel->id_novel }}'" />
		@endif
	</p>

	<!-- Обёртка для слайдера -->
	<div class = "wrap_slider">
		<div class="slider_images"></div>
	</div>

	<!-- Форма обновления новеллы -->
	<form method = "POST">
		{!! csrf_field() !!}
		
		<!-- Обёртка для формы -->
		<div class="wrap_form">
			<!-- Добавление скриншотов -->
			<h2>Добавление скриншотов</h2>

			<!-- Блок с поля ввода изображений -->
			<div class="addit_image"></div>

			<!-- Кнопка вывода изображений -->
			<p><input type = "button" value = "Посмотреть" onclick = "image_preview();" onblur = "increase_image();" /></p>

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
							arr3.push(arr2[0]);
						}
					}
					var k = 1; out = "";
					for(var i = 0; i < arr3.length; i++) {
						out += `<p><input class = "slide" type = "text" placeholder = "Изображение ${k}" name="image${k}" value = "${arr3[i]}" /></p>`;
						k++;
					}
					$(".addit_image").html(out);
				</script>
			@endif
		</div>

		<!-- Обёртка для формы -->
		<div class="wrap_form">
			<h2>Обновление информации о новелле</h2>

			<!-- Название новеллы -->
			<p><input type="text" name = "name" id = "name" placeholder = "Название новеллы" value = "{{ $data->novel->name }}" /></p>
			<p><input type="text" name = "name_in_english" placeholder = "Название новеллы на английском (необязательно)" value = "{{ $data->novel->name_in_english }}" /></p>

			<!-- Изображение новеллы -->
			<!-- <p><input type="text" name = "image" id = "image" placeholder = "Вставьте URL изображения" value = "{{ $data->novel->image }}" /> </p> -->
			<p><input type="text" name = "image" id = "image" placeholder = "Вставьте URL изображения для титульника" value = "{{ $data->novel->image }}" /> </p>
			<p><input type="text" name = "background" id = "background" placeholder = "Вставьте URL изображения для заднего фона (необязательно)" value = "{{ $data->novel->background }}" /> </p>

			<!-- Описание новеллы -->
			<p><textarea name="description" cols="30" rows="10" placeholder = "Описание">{{ $data->novel->description }}</textarea></p>

			<!-- Год релиза новеллы -->
			<p><input type="text" name = "year_release" placeholder = "Год релиза" value = "{{ $data->novel->year_release }}" /></p>

			<!-- Тип новеллы -->
			<p>
				<select name="type" id = "type">
					<option disabled selected>Выберите тип новеллы</option>
					<option value="Новелла с выборами">Новелла с выборами</option>
					<option value="Кинетическая новелла (без выборов)">Кинетическая новелла (без выборов)</option>
					<option value="Новелла смешанных типов">Новелла смешанных типов</option>
				</select>
			</p>

			<!-- Продолжительность новеллы -->
			<p>
				<select name="duration" id="duration">
					<option disabled selected>Выберите продолжительность</option>
					<option value="Менее 2 часов">Менее 2 часов</option>
					<option value="2-10 часов">2-10 часов</option>
					<option value="10-30 часов">10-30 часов</option>
					<option value="30-50 часов">30-50 часов</option>
					<option value="Более 50 часов">Более 50 часов</option>
				</select>
			</p>

			<!-- Платформа для которой разрабатывалась новелла -->
			<p>
				<select name="platform" id = "platform">
					<option disabled selected>Выберите платформу</option>
					<option value="Windows">Windows</option>
					<option value="Linux">Linux</option>
					<option value="Mac">Mac</option>
					<option value="Android">Android</option>
					<option value="iOS">iOS</option>
				</select>
			</p>

			<!-- Жанры новеллы -->
			<p><input type="text" id = "genres" name = "genres" value = "{{ $data->novel->genres }}" placeholder = "Жанры" /></p>
			<p>
				<select class="items" id="genre">
					<option disabled selected>Выберите жанр</option>
					@foreach($data->genres as $key => $val)
						<option value="{{ $val->genre }}">{{ $val->genre }}</option>
					@endforeach
				</select>
				<input type="button" value = "Добавить" onclick = "add_genre()" />
			</p>

			<!-- Разработчик новеллы -->
			<p><input type="text" placeholder = "Разработчик" id = "developer" name = "developer" value = "{{ $data->novel->developer }}" /></p>
			<p>
				<select onclick = "add_developer()" id = "developers" name="id_developer">
					<option selected>Выберите разработчика</option>
					@foreach($data->developers as $key => $val)
						<option value="{{ $val->id_developer }}">{{ $val->developer }}</option>
					@endforeach
				</select>
			</p>
			@if(!empty($data->developer->id_developer))
				<script>
					// Скрипт для выбора разработчика новеллы по developer
					var developer = document.querySelector("#developers").getElementsByTagName("option");
					for(var i = 0; i < developer.length; i++) { if (developer[i].value == "{{$data->developer->id_developer}}") developer[i].selected = true; }
				</script>
			@endif

			<!-- Страна разработчик -->
			<p><input type="text" name = "country" placeholder = "Страна разработчик" value = "{{ $data->novel->country }}" /></p>

			<!-- Язык перевода новеллы -->
			<p><input type="text" name = "language" placeholder = "Язык перевода" value = "{{ $data->novel->language }}" /></p>

			<!-- Возрастной рейтинг новеллы -->
			<p>
				<select name="age_raiting" id="age_raiting">
					<option disabled selected>Выберите возрастной рейтинг</option>
					<option value="12+">12+</option>
					<option value="16+">16+</option>
					<option value="18+" selected>18+</option>
				</select>
			</p>

			<!-- Кнопка подтверждения -->
			<p><input type="button" value = "Сохранить" onclick = "ajax_update('{{ $data->novel->id_novel }}');"/></p>
		</div>
	</form>

@endsection