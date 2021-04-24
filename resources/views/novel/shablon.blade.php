<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield("title")</title>

	<link rel="shortcut icon" href="{{ asset('novel/favicon.png') }}">

	<link rel="stylesheet" href="{{ asset('novel/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('novel/css/slider.css') }}">
	<script src="{{ asset('novel/script/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ asset('novel/script/slider.js') }}"></script>
	<script src="{{ asset('novel/script/main.js') }}"></script>

	@yield("head")

	@yield("script")

</head>
<body>
	
	<div class = "top">
		<nav>
			<div class="logo">
				<a href="/"><img src="{{ asset('novel/favicon.png') }}" alt=""></a>
			</div>
			<h1 onclick = "document.location.href='/'">Novel</h1>
			<nav class = "menu">
				<a href="/">Главная страница</a>
				<a href="/">Визуальные новеллы</a>
				<a href="/personal_area">Личный кабинет</a>
				<a href="/login">Авторизация</a>
				<a href="/register">Регистрация</a>
			</nav>
		</nav>
	</div>

	<div class="app">

		<header>
			@yield("header")
		</header>
		
		<div class="sidebar">
			@yield("sidebar")
		</div>

		<div class = "content">
			@yield("content")
		</div>

		<footer>
			@yield("footer")
		</footer>

	</div>

	<div class = "bottom">
		<nav>
			<div class="logo">
				<img src="{{ asset('novel/favicon.png') }}" alt="">
			</div>
			<h1 onclick = "document.location.href='/'">Novel</h1>
		</nav>
	</div>
</body>
</html>