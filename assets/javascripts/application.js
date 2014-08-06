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
	$(document).on('loaded.bs.modal', function () {
		$('.nav-tabs a:first').tab('show');
	});

	// DateTime picker
	$('.field-datetime').datetimepicker({
		icons: {
			time: "fa fa-clock-o",
			date: "fa fa-calendar",
			up:   "fa fa-arrow-up",
			down: "fa fa-arrow-down"
		},
		pick12HourFormat: false
	});

	// Date picker
	$('.field-date').datetimepicker({
		icons: {
			time: "fa fa-clock-o",
			date: "fa fa-calendar",
			up:   "fa fa-arrow-up",
			down: "fa fa-arrow-down"
		},
		pickTime: false
	});

	// Time picker
	$('.field-time').datetimepicker({
		icons: {
			time: "fa fa-clock-o",
			date: "fa fa-calendar",
			up:   "fa fa-arrow-up",
			down: "fa fa-arrow-down"
		},
		pickDate: false
	});

	// Ajax form submit
	$(document).on('submit', 'form[data-async]', function (e) {
		var $form   = $(this),
			$target = $($form.attr('data-target'));

		$.ajax({
			type: $form.attr('method'),
			url:  $form.attr('action'),
			data: $form.serialize(),
			success: function (data) {
				$target.html(data);
			}
		});

		e.preventDefault();
	});

	// Init tinymce
	tinymce.init({
		selector: '.form-wysiwyg'
	});

	// Infinite fields
	$(document)
		.on('click', '.field-infinite a[data-event="field-add"]', function () {
			var clone = $(this).closest('.row').clone();

			$(clone).find('input').val('');
			$(this).closest('.row').after(clone);

			redrawInfiniteFieldButtons();
		}).on('click', '.field-infinite a[data-event="field-remove"]', function () {
			$(this).closest('.row').remove();

			redrawInfiniteFieldButtons();
		});

	function redrawInfiniteFieldButtons () {
		$('.form-group').each(function () {
			var addFields    = $(this).find('[data-event="field-add"]'),
				removeFields = $(this).find('[data-event="field-remove"]');

			for (var i = 0; i < addFields.length -1; i++) {
				addFields.eq(i).hide();
				removeFields.eq(i).show();
			}

			// infinite limit
			var limit = $(this).find('input').last().attr('infinite-limit');
			if (limit != undefined) {
				var fields = $(this).find('input').length;

				if (fields >= limit) {
					addFields.last().hide();
				} else {
					addFields.last().show();
				}
			}
		});
	}

	// ...

})(jQuery, window, document);