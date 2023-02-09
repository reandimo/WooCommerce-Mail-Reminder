(function( $ ) {
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

	 // $('select').select2();

/**
	 * Send Test Mail via AJAX
	 *
	 * @since  1.0.0
*/

	 $(document).on('click', '#woomr_testmail_submit', function(){
	 	
	 	//Mail for testing
	 	var mail = $('#woomr_testmail').val();
	 	var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

	 	if (mail !== null && mail !== '') {
	 		
			if ( testEmail.test(mail) ){

			 	//Block Screen
			 	$.blockUI({
			 		message: null, 
			 		css: { backgroundColor: '#00cec9'},
			 	});

				var data = {
					'action': 'woomr_test_mail',
					'mail': mail
				};

				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
				$.post(ajaxurl, data, function(data) { 

					var response = $.parseJSON(data)

					if (response.code == 1) {
						alert( response.message )
					}else{
						alert( response.message );
					}

					$.unblockUI()
				});

			}else{
				alert('You have to use a correct email, bro.');
			}

	 	}else{
	 		alert('You cant leave that blank, man.');
	 	}

	 })

/**
	 * Deactivate Reminder
	 *
	 * @since  1.1.0
*/

	$(document).on('click', '#woomr_deactivate_reminder', function(){
	 	 	 		 
		//Block Screen
		$.blockUI({
			message: null, 
			css: { backgroundColor: '#00cec9'},
		});

		var data = {
					'action': 'woomr_deactivate_reminder',
					'reminder_id': reminder_id
		};

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		$.post(ajaxurl, data, function(data) { 

			var response = $.parseJSON(data)

			if (response.code == 1) {
				alert( response.message )
			}else{
				alert( response.message );
			}

			$.unblockUI()

		});
 

	})

/**
	 * Popover
	 *
	 * @since  1.1.0
*/

	$(document).ready(function(){

		$('.info-icon').each(function(){
			var e = $(this);
			var c =  '<img src="'+ e.data('image') +'"/>';
				c += '<caption>'+ e.data('desc') +'</caption>'; 
		 	
			e.popover({
				content: c, 
				html: true,
				animation: true,
				trigger: 'hover',
				placement: 'right'
			}); 
		}) 

	})


})( jQuery );
