$(document).ready(function(){
    $('ul.tabs li').click(function(){
        var tab_id = $(this).attr('data-tab');

        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');

        $(this).addClass('current');
        $("#"+tab_id).addClass('current');
    });

    $('div.paginate').each(function(index, element){
        $this = $('#' + $(this).attr('id'));
        $this.easyPaginate({
            paginateElement: 'span',
            elementsPerPage: 5,
            effect: 'climb'
        });
    });
});