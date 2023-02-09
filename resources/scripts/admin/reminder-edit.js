(function( $ ) {
	'use strict';

	$(document).on('click', '#woomr-preview', function(e){

		e.preventDefault();


		var post = $('#post-preview').attr('target')
			post = post.split('-')
			post = post[2]
		var nonce = $('#woomr-nonce').val(),
			url = '?preview_woomr_mail=true&_wpnonce='+ nonce +'&post=' + post,
			heading = $('#woomr-heading').val(),
			subject = $('#woomr-subject').val(),
			content = tinymce.activeEditor.getContent({entity_encoding : "raw"});

		var form  = '<form method="post" action="'+ url +'" target="_blank">'
			form += '<input type="hidden" name="heading" value="'+ heading +'">'
			form += '<input type="hidden" name="subject" value="'+ subject +'">'
			form += '<textarea type="hidden" name="content">'+ content +'</textarea>'
			form += '</form>'
 
		console.log( content ) 
		// window.open(url, '_blank');

		$( form ).appendTo('body').submit().remove()

	}) 

})( jQuery );
