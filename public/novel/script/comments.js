function update_comments(data) {
	out = "";
	console.log(data);
	for(var i = 0; i < data.length; i++) {
		if(data[i].reply == 0) {
			date = data[i].updated_at.split("T");
			out += `
				<div class="wrap_comment">
					<a href="/profile/${data[i].id_user}"><h4>${i} ${data[i].name}</h4></a>
					<p>
						${date[0]}
								<span class = "do" onclick = "ajax_delete_comment('${ data[i].id_user }', '${ data[i].id_comment }')">Удалить</span>
					</p>
					<p>${data[i].text}</p>
					<p id = "${ data[i].id_comment }"><span class = "do" onclick = "reply('${ data[i].id_comment }')">Ответить</span></p>
				</div>
			`;
			for(var j = 0; j < data.length; j++) {
				if(data[i].id_comment == data[j].reply) {
					date = data[j].updated_at.split("T");
					out += `
						<div class="reply_comment">
							<a href="/profile/${data[j].id_user}"><h4>${j} ${data[j].name}</h4></a>
							<p>
								${date[0]}
								<span class = "do" onclick = "ajax_delete_comment('${ data[j].id_user }', '${ data[j].id_comment }')">Удалить</span>
							</p>
							<p>${data[j].text}</p>
						</div>
					`;
				}
			}
		}
	}
	$("div.comments").html(out);
}

function reply(id) {
	out = `
		<textarea class = "reply" id="reply" placeholder = "Введите ваш ответ" cols="30" rows="10"></textarea>
		<p><span class = "do" onclick = "ajax_reply_comment('{{ $data->user->login }}','${id}')">Ответить</span></p>
	`;
	$("p#" + id).html(out);
}