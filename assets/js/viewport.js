(function ($) {
	if (Object.keys(wpgauges).length) {
		// console.log(wpgauges);
		$(window).scroll(function () {
			$("canvas.animation").each(function () {
				var el = $(this);
				var id = el.attr("id");
				// console.log(id);
				var gauge = wpgauges[id];
				var data = el.data();
				if (data.animateto) {
					var top_of_element = el.offset().top;
					var top_of_screen = $(window).scrollTop();
					var bottom_of_element = top_of_element + el.outerHeight();
					var bottom_of_screen = top_of_screen + $(window).innerHeight();

					if ((bottom_of_screen > top_of_element) && (top_of_screen < bottom_of_element)) {
						setTimeout(function () {
							gauge.value = parseFloat(data.animateto);
							// gauge.update();
						}, 700);
						el.removeClass("animation");
					}
				}

			});
		});
	}
})(jQuery);