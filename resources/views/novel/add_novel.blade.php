@extends("novel.shablon")

@section("title")
	Novel - База данных визуальных новелл. Страница добавления новеллы.
@endsection

@section("script")
	<script src = "{{ asset('novel/script/add_novel.js') }}"></script>
@endsection

@section("header")
	<div class="head">
		<h1>Страница добавления новелл</h1>
	</div>
	<div class="session">
		@if($data->access == "Гость")
			<p> <a href="/login">Авторизация</a> / <a href="/register">Регистрация</a> </p>
		@else
			<p>Вы вошли как {{ $data->access }}. <a href="/logout">Выйти</a></p>
		@endif
	</div>
	<div class = "increase_img"><div class="close"></div><img src="" alt=""></div>
	<div class="increase_img_overlay"></div>
@endsection

@section("sidebar")
	<h2>Предпросмотр</h2>
	<div class="novel_preview">
		<h3>Предпросмотр записи</h3>
	</div>
@endsection

@section("content")
	<!-- Кнопки перехода -->
	<p><input type="button" value = "На главную" onclick = "document.location.href='/'" /></p>

	<!-- Форма добавления новеллы -->
	<form method = "POST">
		{!! csrf_field() !!}
		
		<!-- Обёртка для слайдера -->
		<div class = "wrap_slider">
			<div class="slider_images"></div>
		</div>

		<!-- Обёртка для формы -->
		<div class="wrap_form">
			<!-- Добавление скриншотов -->
			<h2>Добавление скриншотов</h2>
			<p><input type="text" placeholder = "Изображение 1" name = "image1" class = "slide"></p>
			<p><input type="text" placeholder = "Изображение 2" name = "image2" class = "slide"></p>
			<p><input type="text" placeholder = "Изображение 3" name = "image3" class = "slide"></p>
			<p><input type="text" placeholder = "Изображение 4" name = "image4" class = "slide"></p>
			<p><input type="text" placeholder = "Изображение 5" name = "image5" class = "slide"></p>
			<p><input type="text" placeholder = "Изображение 6" name = "image6" class = "slide"></p>
			<p><input type = "button" value = "Посмотреть" onclick = "image_preview();" onblur = "increase_image();" /></p>
		</div>

		<!-- Обёртка для формы -->
		<div class="wrap_form">
			<!-- Блок добавления новеллы -->
			<h2>Информация по новелле</h2>

			<!-- Название новеллы -->
			<p><input type="text" name = "name" id = "name" placeholder = "Название новеллы" /></p>
			<p><input type="text" name = "name_in_english" placeholder = "Название новеллы на английском (необязательно)" /></p>

			<!-- Изображение новеллы -->
			<p><input type="text" name = "image" id = "image" placeholder = "Вставьте URL изображения для титульника" /> </p>
			<p><input type="text" name = "background" id = "background" placeholder = "Вставьте URL изображения для заднего фона (необязательно)" /> </p>
			<p><input type = "button" value = "Посмотреть" onclick = "novel_preview();" /></p>

			<!-- Описание новеллы -->
			<p><textarea name="description" cols="30" rows="10" placeholder = "Описание"></textarea></p>

			<!-- Год релиза новеллы -->
			<p><input type="text" name = "year_release" placeholder = "Год релиза" /></p>

			<!-- Тип новеллы -->
			<p>
				<select name="type">
					<option disabled selected>Выберите тип новеллы</option>
					<option value="Новелла с выборами">Новелла с выборами</option>
					<option value="Кинетическая новелла (без выборов)">Кинетическая новелла (без выборов)</option>
					<option value="Новелла смешанных типов">Новелла смешанных типов</option>
				</select>
			</p>

			<!-- Продолжительность новеллы -->
			<p>
				<select name="duration">
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
				<select name="platform">
					<option disabled selected>Выберите платформу</option>
					<option value="Windows">Windows</option>
					<option value="Linux">Linux</option>
					<option value="Mac">Mac</option>
					<option value="Android">Android</option>
					<option value="iOS">iOS</option>
				</select>
			</p>

			<!-- Жанры новеллы -->
			<p><input type="text" id = "genres" name = "genres" placeholder = "Жанры" /></p>
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
			<p><input type="text" placeholder = "Разработчик" id = "developer" name = "developer" /></p>
			<p>
				<select onclick = "add_developer()" id = "developers" name="id_developer">
					<option selected>Выберите разработчика</option>
					@foreach($data->developers as $key => $val)
						<option value="{{ $val->id_developer }}">{{ $val->developer }}</option>
					@endforeach
				</select>
			</p>

			<!-- Страна разработчик -->
			<p><input type="text" name = "country" placeholder = "Страна разработчик" /></p>

			<!-- Язык перевода новеллы -->
			<p><input type="text" name = "language" placeholder = "Язык перевода" /></p>

			<!-- Возрастной рейтинг новеллы -->
			<p>
				<select name="age_raiting">
					<option disabled selected>Выберите возрастной рейтинг</option>
					<option value="12+">12+</option>
					<option value="16+">16+</option>
					<option value="18+" selected>18+</option>
				</select>
			</p>

			<!-- Кнопка подтверждения -->
			<p><input type="submit" value = "Добавить" /></p>
		</div>
	</form>
@endsection
