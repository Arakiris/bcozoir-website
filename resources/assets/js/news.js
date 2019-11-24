let news = document.querySelectorAll('.news__single');

news.forEach(e => {
    let button = e.querySelector('.news__button');
    if(e.offsetHeight > 140){
        button.addEventListener('click', event => {
            event.preventDefault();

            let parent, gparent, allp;
            let totalHeight = 0;

            parent = event.target.parentNode;
            gparent = parent.parentNode;
            allp = gparent.querySelectorAll(`p:not(.news__read-more)`);

            allp.forEach(e => {
                totalHeight += e.offsetHeight;
            });
            console.log(totalHeight.offsetHeight);
            
            gparent.style.transitionProperty = 'height, margin, padding';
            gparent.style.transitionDuration = '.5s';
            

            gparent.style.height = gparent.offsetHeight + 'px';
            gparent.offsetHeight;
            
            gparent.style.maxHeight = 'none';

            gparent.style.height = totalHeight + 'px';

            parent.style.display = 'none';

        }, false);
    }
    else {
        console.log(button.parentNode);
        button.parentNode.style.display = "none";
    }
});