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
/******/ 	return __webpack_require__(__webpack_require__.s = 41);
/******/ })
/************************************************************************/
/******/ ({

/***/ 41:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(42);


/***/ }),

/***/ 42:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(43);

$(function () {
    $('.notification').delay(5000).slideUp(1000);

    $('input:radio[name=is_licensee]').on('change', function () {
        var idLicensee = $("#id_licensee");
        if ($(this).val() == 0) {
            idLicensee.val('').prop("disabled", true);
        } else {
            idLicensee.prop("disabled", false);
        }
    });

    $('#is_finished').on('change', function () {
        var finishedDiv = $('.finished');
        if ($(this).is(":checked")) {
            finishedDiv.slideDown(1000);
            return;
        }
        finishedDiv.slideUp(1000);
    });

    $('input:radio[name=is_rules_pdf]').on('change', function () {
        var isURL = $('#rules_url');
        var isPDF = $('#rules_pdf');
        // 0 = URL, 1 = PDF
        if ($(this).val() == 0) {
            isURL.val('').prop("disabled", false);
            isPDF.val('').prop("disabled", true);
            return;
        }
        isPDF.val('').prop("disabled", false);
        isURL.val('').prop("disabled", true);
    });
});

/***/ }),

/***/ 43:
/***/ (function(module, exports) {

Dropzone.options.myAwesomeDropzone = {
    paramName: "media", // The name that will be used to transfer the file
    acceptedFiles: 'image/*',
    dictDefaultMessage: "Glissez vos médias ici.",
    dictFallbackMessage: "Votre navigateur ne supporte pas le plugin \"drag'n'drop file upload\".",
    dictFallbackText: "Veuillez utilisez le formulaire de téléchargement ascendant de fichier.",
    dictFileTooBig: "Votre fichier est trop gros ({{filesize}}MiB). Taille Maximum: {{maxFilesize}}MiB.",
    dictInvalidFileType: "Vous ne pouvez pas transférer ce type de fichier.",
    dictCancelUpload: "Annuler le transfert.",
    dictCancelUploadConfirmation: "Êtes-vous sûr de vouloir annuler ce transfert ?",
    dictRemoveFile: "Supprimer fichier",
    dictMaxFilesExceeded: "Vous ne pouvez pas transférer plus de fichiers.",
    init: function init() {
        this.on("error", function (file, response) {
            console.dir(response);
            $(file.previewElement).find('.dz-error-message').text(response.error.picture[0]);
        });
        /*this.on("success", function(file, response) {
            console.dir(response);
            $(file.previewElement).find('.dz-error-message').text(response.error.picture[0]);
        });*/
    }
};

/*Dropzone.options.myAwesomeDropzoneVideos = {
    paramName: "video", // The name that will be used to transfer the file
    acceptedFiles: 'video/*',
    dictDefaultMessage: "Glissez vos photos ici.",
    dictFallbackMessage: "Votre navigateur ne supporte pas le plugin \"drag'n'drop file upload\".",
    dictFallbackText: "Veuillez utilisez le formulaire de téléchargement ascendant de fichier.",
    dictFileTooBig: "Votre fichier est trop gros ({{filesize}}MiB). Taille Maximum: {{maxFilesize}}MiB.",
    dictInvalidFileType: "Vous ne pouvez pas transférer ce type de fichier.",
    dictCancelUpload: "Annuler le transfert.",
    dictCancelUploadConfirmation: "Êtes-vous sûr de vouloir annuler ce transfert ?",
    dictRemoveFile: "Supprimer fichier",
    dictMaxFilesExceeded: "Vous ne pouvez pas transférer plus de fichiers."
};*/

/*$(document).ready(function () {
    new Dropzone('#fileInput', {
        url: "/admin/actualites",
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 100,
        maxFiles: 100,
        acceptedFiles: 'image/*',
        dictDefaultMessage: "Glissez vos photos ici.",
        dictFallbackMessage: "Votre navigateur ne supporte pas le plugin \"drag'n'drop file upload\".",
        dictFallbackText: "Veuillez utilisez le formulaire de téléchargement ascendant de fichier.",
        dictFileTooBig: "Votre fichier est trop gros ({{filesize}}MiB). Taille Maximum: {{maxFilesize}}MiB.",
        dictInvalidFileType: "Vous ne pouvez pas transférer ce type de fichier.",
        dictCancelUpload: "Annuler le transfert.",
        dictCancelUploadConfirmation: "Êtes-vous sûr de vouloir annuler ce transfert ?",
        dictRemoveFile: "Supprimer fichier",
        dictMaxFilesExceeded: "Vous ne pouvez pas transférer plus de fichiers.",

        // The setting up of the dropzone
        init: function () {
            var myDropzone = this;

            // First change the button to actually tell Dropzone to process the queue.
            $("#submit-all").click(function (e) {
                // Make sure that the form isn't actually being sent.
                e.preventDefault();
                e.stopPropagation();
                myDropzone.processQueue();
            });

            // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
            // of the sending event because uploadMultiple is set to true.
            //this.on("sendingmultiple", function () {
            // Gets triggered when the form is actually being sent.
            // Hide the success button or the complete form.
            //});
            this.on("successmultiple", function (files, response) {
                //alert('it workt');
                // Gets triggered when the files have successfully been sent.
                // Redirect user or notify of success.
            });
            this.on("errormultiple", function (files, response) {
                //alert('it doesn\'t work');
                // Gets triggered when there was an error sending the files.
                // Maybe show form again, and notify user of error
            });
        },
        sending: function (file, xhr, formData) {
            formData.append("name", $('#name').val());
        }
    })
})*/

/***/ })

/******/ });