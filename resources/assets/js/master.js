$(document).ready(function() {
    $('.warning-carousel').slick({
        dots: false,
        prevArrow: false,
        nextArrow: false,
        infinite: true,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 4000
    });

    $('.warning-carousel').addClass('carousel-initialized');

    $('.ads-carousel').slick({
        lazyLoad: 'ondemand',
        dots: true,
        prevArrow: false,
        nextArrow: false,
        infinite: true,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 1500
    });

    $('.pictures-carousel').slick({
        lazyLoad: 'ondemand',
        dots: false,
        prevArrow: false,
        nextArrow: false,
        infinite: true,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 3000
    });
});

window.addEventListener("load", function(){
    window.cookieconsent.initialise({
        "palette": {
            "popup": {
            "background": "#edeff5",
            "text": "#838391"
            },
            "button": {
            "background": "#4b81e8"
            }
        },
        "theme": "classic",
        "content": {
            "message": "Ce site utilise des cookies pour vous assurer la meilleure expérience possible sur notre site. En poursuivant votre navigation sur ce site, vous acceptez notre utilisation de cookies.",
            "dismiss": "OK",
            "link": "En savoir plus",
            "href": "http://bcozoir.dev/mentions-legales"
        }
    })
});

lightbox.option({
    'showImageNumberLabel': false,
    'disableScrolling' : false
})