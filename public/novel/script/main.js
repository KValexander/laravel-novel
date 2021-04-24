function increase_image() {
	// Увеличение изображения при нажатии
	$("img.increase_image").click(function(event) {
		$("div.increase_img img").attr("src", event.target.src);
		$('div.increase_img').css({top:'50%',left:'50%',margin:'-'+($('div.increase_img').height() / 2)+'px 0 0 -'+($('div.increase_img').width() / 2)+'px'});

		$("div.increase_img div.close").css({margin: '-' + ($('div.increase_img div.close').height() / 2) + 'px 0 0 ' + ($('div.increase_img').width() - ($('div.increase_img div.close').width() / 2)) + 'px'});

		$("div.increase_img_overlay").fadeIn(500);
		$("div.increase_img").fadeIn(500, function() {
			$("div.increase_img").css("display", "block");
		});
	});

	$("div.increase_img").click(function() {
		$("div.increase_img_overlay").fadeOut(500);
		$("div.increase_img").fadeOut(500, function() {
			$("div.increase_img").css("display", "none");
		});
	});
}

function background_image(url) {
	$(".app").css("background-color", "rgba(255,255,255, 0.9)");
	$("body").css("background", "url('" + url + "') #FFF fixed top center no-repeat");
	$("body").css("background-size", "cover");

	$("body").append(`<div class = "background_mask"></div>`);
}

function call_alert(message) {
	$("#alert_message").html(message);
	$(".alert").fadeIn(100);
}

function callback_alert() {
	$(".alert").fadeOut(100);
}
