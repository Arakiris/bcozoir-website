/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 187);
/******/ })
/************************************************************************/
/******/ ({

/***/ 187:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(188);


/***/ }),

/***/ 188:
/***/ (function(module, exports) {

$(document).ready(function () {
    $('ul.tabs li.tabs__link').click(function () {
        var tab_id = $(this).attr('data-tab');

        $('li.tabs__link').removeClass('tabs__link-current');
        $('div.tabs__content').removeClass('tabs__content-current');

        $(this).addClass('tabs__link-current');
        $("#" + tab_id).addClass('tabs__content-current');
    });

    $('div.paginate').each(function (index, element) {
        var pag_id = $(this).attr('id').substr(9);
        var table = $('#' + $(this).attr('id') + " .archives__tables");
        table.paginathing({
            perPage: 2,
            insertAfter: '#pag-' + pag_id,
            prevText: '&lt;',
            nextText: '&gt;',
            firstText: '&laquo;',
            lastText: '&raquo;'
        });
    });

    // $('ul.tabs li').click(function(){
    //     var tab_id = $(this).attr('data-tab');

    //     $('ul.tabs li').removeClass('current');
    //     $('.tab-content').removeClass('current');

    //     $(this).addClass('current');
    //     $("#"+tab_id).addClass('current');
    // });

    // $('div.paginate').each(function (index, element) {
    //     $table = $(this).find("table").attr('id');
    //     $this = $('#' + $(this).attr('id') + ' #' + $table + ' tbody');
    //     $this.paginathing({
    //         perPage: 5,
    //         insertAfter: '#' + $table,
    //         prevText: '&lt;',
    //         nextText: '&gt;',
    //         firstText: '&laquo;',
    //         lastText: '&raquo;'
    //     });
    // });

    // OLD
    // $('div.paginate').each(function(index, element){
    //     $this = $('#' + $(this).attr('id'));
    //     $this.easyPaginate({
    //         paginateElement: 'span',
    //         elementsPerPage: 5,
    //         effect: 'climb'
    //     });
    // });
});

/***/ })

/******/ });