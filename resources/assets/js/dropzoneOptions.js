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
            // $(file.previewElement).find('.dz-error-message').text(response.error.picture[0]);
            $(file.previewElement).find('.dz-error-message').text(response);
        });
        /*this.on("success", function(file, response) {
            console.dir(response);
            $(file.previewElement).find('.dz-error-message').text(response.error.picture[0]);
        });*/
    }
};