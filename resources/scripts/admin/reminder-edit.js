import "jquery-blockui";
import { createPopper } from '@popperjs/core';
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css'; // optional for styling

(function ($) {
	'use strict';

	var WooMailReminderEdit = function (sel) {

		// objet
		var _ = this;

		// view
		_.$page = $(sel);
		console.log(sel)
		console.log(_.$page)

		this.init = function () {

			$(document).on('click', '#woomr-preview', _.previewTemplate)
            _.initPopovers()
			console.log('init WooMailReminderEdit')
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
                    const template = document.getElementById(id);
                    return template.innerHTML;
                },
                allowHTML: true,
            });

        }

		_.previewTemplate = function (e) {

			e.preventDefault();

			var post = $('#post-preview').attr('target')
			post = post.split('-')
			post = post[2]
			var nonce = $('#woomr-nonce').val(),
				url = '?preview_woomr_mail=true&_wpnonce=' + nonce + '&post=' + post,
				heading = $('#woomr-heading').val(),
				subject = $('#woomr-subject').val(),
				content = tinymce.activeEditor.getContent({ entity_encoding: "raw" });

			var form = '<form method="post" action="' + url + '" target="_blank">'
			form += '<input type="hidden" name="heading" value="' + heading + '">'
			form += '<input type="hidden" name="subject" value="' + subject + '">'
			form += '<textarea type="hidden" name="content">' + content + '</textarea>'
			form += '</form>'

			console.log(content)
			// window.open(url, '_blank');

			$(form).appendTo('body').submit().remove()

		}

		// init
		if (_.$page.length) {
			this.init();
		}

	}

	window.addEventListener('load', () => {
        if( $('table.wp-list-table').length == 0 ){ 
			var wmrEdit = new WooMailReminderEdit('.post-type-woomr_reminder');
		}
	})

})(jQuery);
