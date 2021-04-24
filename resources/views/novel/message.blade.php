@extends("novel.shablon")

@section("title")
	Novel - База данных визуальных новелл. Сообщение.
@endsection

@section("header")
	<h1>Сообщение</h1>
@endsection

@section("content")
	<p>
		<input type="button" value = "На главную" onclick = "document.location.href='/'" />
	</p>
	<div class="message"><h3>{{ $message }}</h3></div>
@endsection