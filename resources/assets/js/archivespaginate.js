$(document).ready(function(){
    $('ul.tabs li.tabs__link').click(function(){
        var tab_id = $(this).attr('data-tab');

        $('li.tabs__link').removeClass('tabs__link-current');
        $('div.tabs__content').removeClass('tabs__content-current');

        $(this).addClass('tabs__link-current');
        $("#"+tab_id).addClass('tabs__content-current');
    });

    $('div.paginate').each(function (index, element) {
        var pag_id = $(this).attr('id').substr(9);
        var table = $('#' + $(this).attr('id') + " .archives__tables");
        table.paginathing({
            perPage: 2,
            insertAfter: '#pag-' + pag_id ,
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