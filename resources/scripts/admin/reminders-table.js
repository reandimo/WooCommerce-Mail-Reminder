import "jquery-blockui";
import { createPopper } from '@popperjs/core';
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css'; // optional for styling
import iziToast from "izitoast";
import 'izitoast/dist/css/iziToast.css'; // optional for styling

(function ($) {
    'use strict';

    var WooMailReminderCTPTable = function (sel) {

        // objet
        var _ = this;

        // view
        _.$page = $(sel);

        this.init = function () {
            _.initPopovers()
            $(document).on('click', '.row-actions .set-status', _.toggleReminder)
            console.log('init WooMailReminderCTPTable')
        }

        /**
             * Deactivate Reminder
             *
             * @since  1.1.0
        */

        _.toggleReminder = function(e) {

            e.preventDefault()

            //Block Screen
            $.blockUI({
                message: null,
                css: { backgroundColor: '#00cec9' },
            });

            var $row = $(this).closest('tr');
            var reminder_id = $row.attr('id').split('-')[1];

            var data = {
                'action': 'woomr_toggle_reminder',
                'reminder_id': reminder_id
            };

            // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
            $.ajax({
                'url': ajaxurl, 
                'data': data, 
                method: 'POST',
                dataType: 'json',
                complete: () => {
                    $.unblockUI()
                },
                success: function (response) {

                    if (response.code == 1) {
                        $row.find('.column-status').html(response.column_td)
                        $row.find('.row-actions').find('.set-status a').html(response.action_link)

                        iziToast.success({
                            title: 'OK',
                            message: response.message,
                        });
                    } else {
                        iziToast.error({
                            title: 'Error',
                            message: response.message,
                        });
                    }

                    $.unblockUI()

                }
            });

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

        // init
        if (_.$page.length) {
            this.init();
        }

    }

    window.addEventListener('load', () => {
        if ($('table.wp-list-table').length) {
            var wmrSettings = new WooMailReminderCTPTable('.post-type-woomr_reminder');
        }
    })

})(jQuery);
