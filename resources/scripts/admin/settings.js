import "jquery-blockui";
import { createPopper } from '@popperjs/core';
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css'; // optional for styling

(function ($) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	var WooMailReminderSettings = function (sel) {

		// objet
		var _ = this;

		// view
		_.$page = $(sel);

		this.init = function () {
			$(document).on('click', '#woomr_testmail_submit', _.sendTestMail)
            _.initPopovers()
			console.log('init WooMailReminderSettings')
		}

		/**
			 * Popover
			 *
			 * @since  1.2.0
		*/
		_.initPopovers = () => {

			$('.info-icon').each(function (i, item) {

				$(this).attr('data-template', 'wmr-popover-' + i)

				let e = $(this);
				let c = '<img src="' + e.data('image') + '" style="max-width: 100%;"/>';
				c += '<caption>' + e.data('desc') + '</caption>';

				$('body').append('<div id="wmr-popover-' + i + '" style="display: none;">' + c + '</div>')

			})

			tippy('.info-icon', {
				content(reference) {
					const id = reference.getAttribute('data-template');
					console.log(reference)
					console.log(id)
					const template = document.getElementById(id);
					return template.innerHTML;
				},
				allowHTML: true,
			});

		}


		/**
			 * Send Test Mail via AJAX
			 *
			 * @since  1.0.0
		*/

		_.sendTestMail = () => {

				//Mail for testing
				var mail = $('#woomr_testmail').val();
				var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

				if (mail !== null && mail !== '') {

					if (testEmail.test(mail)) {

						//Block Screen
						$.blockUI({
							message: null,
							css: { backgroundColor: '#00cec9' },
						});

						var data = {
							'action': 'woomr_test_mail',
							'mail': mail
						};

						// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
						$.post(ajaxurl, data, function (data) {

							var response = JSON.parse(data)

							if (response.code == 1) {
								alert(response.message)
							} else {
								alert(response.message);
							}

							$.unblockUI()
						});

					} else {
						alert('You have to use a correct email, bro.');
					}

				} else {
					alert('You can\'t leave that blank, man.');
				} 

		}

		// init
		if (_.$page.length) {
			this.init();
		}

	}

	window.addEventListener('load', () => {
		var wmrSettings = new WooMailReminderSettings('.settings_page_woo-mail-reminder');
	})
	
})(jQuery);
