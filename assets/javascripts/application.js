/**
 * 
 */

;(function ($, window, document, undefined) {

	'use strict';

	// External links handling
	$('a[rel*="external"]').click(function () {
		$(this).attr('target', '_blank');
	});

	// auto tab selection
	$('.nav-tabs a:first').tab('show');

	$('.field-datetime').datetimepicker({
		icons: {
			time: "fa fa-clock-o",
			date: "fa fa-calendar",
			up:   "fa fa-arrow-up",
			down: "fa fa-arrow-down"
		},
		pick12HourFormat: false
	});

	$('.field-date').datetimepicker({
		icons: {
			time: "fa fa-clock-o",
			date: "fa fa-calendar",
			up:   "fa fa-arrow-up",
			down: "fa fa-arrow-down"
		},
		pickTime: false
	});

	$('.field-time').datetimepicker({
		icons: {
			time: "fa fa-clock-o",
			date: "fa fa-calendar",
			up:   "fa fa-arrow-up",
			down: "fa fa-arrow-down"
		},
		pickDate: false
	});

	// ...

})(jQuery, window, document);