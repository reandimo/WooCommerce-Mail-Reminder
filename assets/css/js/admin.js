/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/scripts/admin.js":
/*!************************************!*\
  !*** ./resources/scripts/admin.js ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _admin_woo_mail_reminder_admin__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./admin/woo-mail-reminder-admin */ "./resources/scripts/admin/woo-mail-reminder-admin.js");
/* harmony import */ var _admin_woo_mail_reminder_admin__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_admin_woo_mail_reminder_admin__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _admin_reminder_edit__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./admin/reminder-edit */ "./resources/scripts/admin/reminder-edit.js");
/* harmony import */ var _admin_reminder_edit__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_admin_reminder_edit__WEBPACK_IMPORTED_MODULE_1__);



/***/ }),

/***/ "./resources/scripts/admin/reminder-edit.js":
/*!**************************************************!*\
  !*** ./resources/scripts/admin/reminder-edit.js ***!
  \**************************************************/
/***/ (() => {

(function ($) {
  'use strict';

  $(document).on('click', '#woomr-preview', function (e) {
    e.preventDefault();
    var post = $('#post-preview').attr('target');
    post = post.split('-');
    post = post[2];
    var nonce = $('#woomr-nonce').val(),
      url = '?preview_woomr_mail=true&_wpnonce=' + nonce + '&post=' + post,
      heading = $('#woomr-heading').val(),
      subject = $('#woomr-subject').val(),
      content = tinymce.activeEditor.getContent({
        entity_encoding: "raw"
      });
    var form = '<form method="post" action="' + url + '" target="_blank">';
    form += '<input type="hidden" name="heading" value="' + heading + '">';
    form += '<input type="hidden" name="subject" value="' + subject + '">';
    form += '<textarea type="hidden" name="content">' + content + '</textarea>';
    form += '</form>';
    console.log(content);
    // window.open(url, '_blank');

    $(form).appendTo('body').submit().remove();
  });
})(jQuery);

/***/ }),

/***/ "./resources/scripts/admin/woo-mail-reminder-admin.js":
/*!************************************************************!*\
  !*** ./resources/scripts/admin/woo-mail-reminder-admin.js ***!
  \************************************************************/
/***/ (() => {

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

  // $('select').select2();

  /**
  	 * Send Test Mail via AJAX
  	 *
  	 * @since  1.0.0
  */
  $(document).on('click', '#woomr_testmail_submit', function () {
    //Mail for testing
    var mail = $('#woomr_testmail').val();
    var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    if (mail !== null && mail !== '') {
      if (testEmail.test(mail)) {
        //Block Screen
        $.blockUI({
          message: null,
          css: {
            backgroundColor: '#00cec9'
          }
        });
        var data = {
          'action': 'woomr_test_mail',
          'mail': mail
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(ajaxurl, data, function (data) {
          var response = $.parseJSON(data);
          if (response.code == 1) {
            alert(response.message);
          } else {
            alert(response.message);
          }
          $.unblockUI();
        });
      } else {
        alert('You have to use a correct email, bro.');
      }
    } else {
      alert('You cant leave that blank, man.');
    }
  });

  /**
  	 * Deactivate Reminder
  	 *
  	 * @since  1.1.0
  */

  $(document).on('click', '#woomr_deactivate_reminder', function () {
    //Block Screen
    $.blockUI({
      message: null,
      css: {
        backgroundColor: '#00cec9'
      }
    });
    var data = {
      'action': 'woomr_deactivate_reminder',
      'reminder_id': reminder_id
    };

    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
    $.post(ajaxurl, data, function (data) {
      var response = $.parseJSON(data);
      if (response.code == 1) {
        alert(response.message);
      } else {
        alert(response.message);
      }
      $.unblockUI();
    });
  });

  /**
  	 * Popover
  	 *
  	 * @since  1.1.0
  */

  $(document).ready(function () {
    $('.info-icon').each(function () {
      var e = $(this);
      var c = '<img src="' + e.data('image') + '"/>';
      c += '<caption>' + e.data('desc') + '</caption>';
      e.popover({
        content: c,
        html: true,
        animation: true,
        trigger: 'hover',
        placement: 'right'
      });
    });
  });
})(jQuery);

/***/ }),

/***/ "./resources/styles/admin.scss":
/*!*************************************!*\
  !*** ./resources/styles/admin.scss ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/styles/frontend.scss":
/*!****************************************!*\
  !*** ./resources/styles/frontend.scss ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/admin": 0,
/******/ 			"css/frontend": 0,
/******/ 			"css/admin": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/frontend","css/admin"], () => (__webpack_require__("./resources/scripts/admin.js")))
/******/ 	__webpack_require__.O(undefined, ["css/frontend","css/admin"], () => (__webpack_require__("./resources/styles/admin.scss")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/frontend","css/admin"], () => (__webpack_require__("./resources/styles/frontend.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;