function add_genre() {
	var choice = $("#genre").val();
	if($("#genres").val() == "") out = choice;
	else out = ", " + choice;
	document.querySelector("#genres").value += out;
}

function add_developer() {
	var developers = document.querySelector("#developers").getElementsByTagName("option");
	for(var i = 0; i < developers.length; i++) {
		if(developers[i].selected == true) {
			if(developers[i].textContent == "Выберите разработчика") developer = "";
			else developer = developers[i].textContent;
		}
	}
	document.querySelector("#developer").value = developer;
}

function image_preview() {
	arr1 = document.querySelectorAll(".slide");
	var arr2 = [];
	for(var i = 0; i < arr1.length; i++) {
		if(arr1[i].value != "") arr2.push(arr1[i].value);
	}
	if(arr2.length == 0) {
		$(".slider_images").html("<h2>Добавьте изображения</h2>");
		return;
	}
	var out = `<div class="main_image"><div id="slider" class = "slider_wrap">`;
	for(var i = 0; i < arr2.length; i++) {
		out += `<img class = "increase_image" id = "slide${i}" src = "${arr2[i]}" alt="${arr2[i]}" />`;
	}
	out += `</div></div>`;

	out += `<div class = "side_image">`;
	for(var i = 0; i < arr2.length; i++) {
		out += `<img onclick = "slide_wrap('slide${i}')" src = "${arr2[i]}" alt="${arr2[i]}" />`;
	}
	out += `</div>`;
	$(".slider_images").html(out);
}

function slide_wrap(id) {
	arr = document.querySelectorAll(".slide");
	for(var i = 0; i < arr.length; i++) {
		$("#slide"+i).fadeOut(500, function() {
			$("#slide"+i).css("display", "none");
		});
	}
	$("#"+id).fadeIn(500, function() {
		$("#"+id).css("display", "block");
	});
}