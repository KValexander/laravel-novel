function image_press(id) {
	arr1 = document.querySelectorAll(".increase_image");
	arr2 = [];
	for(var i = 0; i < arr1.length; i++) {
		arr2.push(arr1[i].src);
	}
	for(var i = 0; i < arr2.length; i++) {
		$("#slide"+i).fadeOut(500, function() {
			$("#slide"+i).css("display", "none");
		});
	}
	$("#"+id).fadeIn(500, function() {
		$("#"+id).css("display", "block");
	});
}