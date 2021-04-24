@extends("novel.shablon")

@section("title")
	{{ $data->user->login }}. Novel - База данных визуальных новел. Профиль пользователя.
@endsection

@section("script")
	<script>
		$(function() {
			background_image('{{ $data->user->background }}');
		});
		function display(id) {
			var count = document.querySelectorAll(".container");
			for(var i = 0; i < count.length; i++) {
				count[i].style = "display: none";
			}
			$("#"+id).css("display", "block");
		}
	</script>
@endsection

@section("header")
	<div class="head">
		<h1>{{ $data->user->login }}</h1>
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
@endsection

@section("content")
	<div class="wrap_profile">
		<h2>Личные данные</h2>
		<div class="avatar"><img src="{{ $data->user->avatar }}" alt="{{ $data->user->avatar }}"></div>
		<div class="profile">
			<h3>Имя профиля: {{ $data->user->login }}</h3>
			<p><b>Роль:</b> {{ $data->user->access }}</p>
			<p><b>Имя:</b> {{ $data->user->name }}</p>
			<p><b>Статус:</b> {{ $data->user->status }}</p>
		</div>
	</div>
	<div class="wrap_profile">
		<h2>Категории</h2>
		<p>
			<input type="button" value = "Избранные новеллы" onclick = "display('container_novel')">
			<input type="button" value = "Комментарии" onclick = "display('container_comments')">
		</p>
	</div>
	<div class="wrap_profile_side">
		<div class="container" id = "container_novel" style = "display: block">
			<h2>Избранные новеллы</h2>
			<div class="line"></div>
			@if(count($data->novels) == 0)
				<h3>Избранные новеллы отсутствуют</h3>
			@else
				@foreach($data->novels as $key => $val)
					<div class = "profile_novel">
						<img src="{{ $val->image }}" alt="{{$val->name}}">
						<a href="/novel/{{$val->id_novel}}"><h3>{{ $val->name }}</h3></a>
					</div>
				@endforeach
			@endif
		</div>
		<div class="container" id = "container_comments">
			<h2>Комментарии</h2>
			<div class="line"></div>
			@if(count($data->comments) == 0)
				<h3>Комментарии отсутствуют</h3>
			@else
				@foreach($data->comments as $key => $val)
					<?php $date = explode(' ', $val->updated_at) ?>
					<div class="wrap_comment">
						<h4>{{ $val->name }} (<a href = "/novel/{{ $val->id_novel }}#comments">{{ $val->novel }}</a>)</h4>
						<p><?php echo $date[0] ?> <span class="do" onclick = "document.location.href='/novel/{{ $val->id_novel }}#comments'">Посмотреть</span> </p>
						<p>{{ $val->text }}</p>
					</div>
				@endforeach
			@endif
		</div>
	</div>
@endsection

@section("footer")
@endsection