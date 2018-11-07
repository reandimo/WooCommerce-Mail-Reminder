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
				jQuery.post(ajaxurl, data, function(response) { 

					if (response == 1) {
						alert('Mail sent!')
					}else{
						alert('We cant send the email right now, try again!');
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

})( jQuery );
