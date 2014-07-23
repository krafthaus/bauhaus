;(function ($, window, document, undefined) {

	'use strict';

	// External links handling
	$('a[rel*="external"]').click(function () {
		$(this).attr('target', '_blank');
	});

	// Smooth anchor scrolling
	$('a[href*=#]').click(function (event) {
		var anchor = $(this).attr('href').replace('#', '');

		$('html, body').animate({
			scrollTop: $('a[name=' + anchor + ']').offset().top
		}, 1000);

		event.preventDefault();
	});

})(jQuery, window, document);