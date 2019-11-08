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
/******/ 	return __webpack_require__(__webpack_require__.s = 181);
/******/ })
/************************************************************************/
/******/ ({

/***/ 181:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(182);


/***/ }),

/***/ 182:
/***/ (function(module, exports) {

var DOMAnimations = function () {
    var elementSetZero = function elementSetZero(element) {
        element.style.overflow = 'hidden';
        element.style.height = 0;
        element.style.paddingTop = 0;
        element.style.paddingBottom = 0;
        element.style.marginTop = 0;
        element.style.marginBottom = 0;
    };

    var setTransition = function setTransition(element) {
        var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 500;

        element.style.transitionProperty = 'height, margin, padding';
        element.style.transitionDuration = duration + 'ms';
    };

    var removePropertyPadMarg = function removePropertyPadMarg(element) {
        element.style.removeProperty('padding-top');
        element.style.removeProperty('padding-bottom');
        element.style.removeProperty('margin-top');
        element.style.removeProperty('margin-bottom');
    };

    var removePropertyAnimation = function removePropertyAnimation(element) {
        element.style.removeProperty('height');
        element.style.removeProperty('overflow');
        element.style.removeProperty('transition-duration');
        element.style.removeProperty('transition-property');
    };

    return {
        slideUp: function slideUp(element) {
            var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 500;

            element.style.height = element.offsetHeight + 'px';
            setTransition(element, duration);
            element.offsetHeight;
            elementSetZero(element);
            window.setTimeout(function () {
                element.style.display = 'none';
                removePropertyPadMarg(element);
                removePropertyAnimation(element);
            }, duration);
        },

        slideDown: function slideDown(element) {
            var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 500;

            element.style.removeProperty('display');
            var display = window.getComputedStyle(element).display;
            if (display === 'none') display = 'block';
            element.style.display = display;
            var height = element.offsetHeight;
            elementSetZero(element);
            element.offsetHeight;
            setTransition(element, duration);
            element.style.height = height + 'px';
            removePropertyPadMarg(element);
            window.setTimeout(function () {
                removePropertyAnimation(element);
            }, duration);
        },

        slideToggle: function slideToggle(element) {
            var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 500;

            var display = window.getComputedStyle(element).display;
            if (display === 'none') slideDown(element, duration);else slideUp(element, duration);
        }
    };
}();

var prev = null;

var teams = document.getElementById('teams');
var addTeams = document.getElementById('add-teams');
var solo = document.getElementById('solo');
var addPlayers = document.getElementById('add-players');
var duration = 500;

var ranking_radios = document.querySelectorAll('input[name="formation"]');

for (var i = 0; i < ranking_radios.length; i++) {
    ranking_radios[i].addEventListener('change', function (e) {
        e.preventDefault();
        if (this.value == 0) {
            DOMAnimations.slideUp(teams, duration);
            window.setTimeout(function () {
                DOMAnimations.slideDown(solo);
            }, duration);

            addTeams.classList.add('disabled');
            addTeams.disabled = true;
            addPlayers.classList.remove('disabled');
            addPlayers.disabled = false;
        } else if (this.value == 1) {
            DOMAnimations.slideUp(solo, duration);
            window.setTimeout(function () {
                DOMAnimations.slideDown(teams);
            }, duration);
            addTeams.classList.remove('disabled');
            addTeams.disabled = false;
            addPlayers.classList.add('disabled');
            addPlayers.disabled = true;
        }
    }, false);
}

/***/ })

/******/ });