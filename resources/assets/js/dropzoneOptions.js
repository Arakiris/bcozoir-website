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
    init: function() {
        this.on("error", function(file, response) {
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