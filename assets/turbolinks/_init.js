
Turbolinks.start();

Turbolinks.setProgressBarDelay(0);

//(function ($) {
//	document.addEventListener("turbolinks:click", function () {
//		$('body').addClass('noscroll');
//		$('.app-loader').css('display', 'flex');
//	});
//
//	document.addEventListener("turbolinks:render", function () {
//		$('.app-loader').hide();
//		$('body').removeClass('noscroll');
//
//	});
//	document.addEventListener("turbolinks:load", function () {
//		$('.app-loader').hide();
//		$('body').removeClass('noscroll');
//
//	});
//} )( jQuery );