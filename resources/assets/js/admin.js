require('./dropzoneOptions');

$(function(){   
    $('.notification').delay(5000).slideUp(1000);

    $('input:radio[name=is_licensee]').on('change', function() {
        var idLicensee = $("#id_licensee");
        if($(this).val() == 0){
            idLicensee.val('').prop("disabled", true);
        }
        else {
            idLicensee.prop("disabled", false);
        }
    });

    $('#is_finished').on('change', function(){
        var finishedDiv = $('.finished');
        if($(this).is(":checked")){
            finishedDiv.slideDown(1000);
            return;
        }
        finishedDiv.slideUp(1000);
    });

    $('input:radio[name=is_rules_pdf]').on('change', function() {
        var isURL = $('#rules_url');
        var isPDF = $('#rules_pdf');
        // 0 = URL, 1 = PDF
        if($(this).val() == 0){
            isURL.val('').prop("disabled", false);
            isPDF.val('').prop("disabled", true);
            return;
        }
        isPDF.val('').prop("disabled", false);
        isURL.val('').prop("disabled", true);
        
    });
});