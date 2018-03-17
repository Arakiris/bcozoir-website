$(document).ready(function(){
    var minimized_elements = $('span.minimize');
    var minimize_character_count = 150;    

    minimized_elements.each(function(){    
        var t = $(this).html();
        if(t.length < minimize_character_count ) return;

        $(this).html(
            t.slice(0,minimize_character_count )+'<span>... </span><a href="#" class="more">Lire la suite</a>'+
            '<span style="display:none;">'+ t.slice(minimize_character_count ,t.length)+' <a href="#" class="less">Réduire</a></span>'
        );

    }); 

    $('a.more', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).slideUp().prev().slideUp();
        $(this).next().slideDown();        
    });

    $('a.less', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).parent().slideUp().prev().show().prev().show();    
    });
});