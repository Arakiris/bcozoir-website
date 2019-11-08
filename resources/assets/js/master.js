$(document).ready(function() {
    $('.content__warning').slick({
        dots: false,
        prevArrow: false,
        nextArrow: false,
        infinite: true,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 2000
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

    $('.partners-carousel').slick({
        lazyLoad: 'ondemand',
        dots: false,
        prevArrow: false,
        nextArrow: false,
        infinite: true,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 3000
    })
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
})});
    

lightbox.option({
    'showImageNumberLabel': false,
    'disableScrolling' : false
})

document.addEventListener("DOMContentLoaded", function(){
    var lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
    let active = false;

    if("IntersectionObserver" in window) {
        let lazyImageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if(entry.isIntersecting){
                    let lazyImage = entry.target;
                    lazyImage.src = lazyImage.dataset.src;
                    lazyImage.classList.remove("lazy");
                    lazyImageObserver.unobserve(lazyImage);
                }
            });
        });

        lazyImages.forEach(lazyImage => {
            lazyImageObserver.observe(lazyImage);
        });
    }
    else {
        const lazyLoad = function() {
            if (active === false) {
                active = true;
        
                setTimeout(function() {
                    lazyImages.forEach(function(lazyImage) {
                        if ((lazyImage.getBoundingClientRect().top <= window.innerHeight && lazyImage.getBoundingClientRect().bottom >= 0) && getComputedStyle(lazyImage).display !== "none") {
                        lazyImage.src = lazyImage.dataset.src;
                        lazyImage.srcset = lazyImage.dataset.srcset;
                        lazyImage.classList.remove("lazy");
            
                        lazyImages = lazyImages.filter(function(image) {
                            return image !== lazyImage;
                        });
            
                        if (lazyImages.length === 0) {
                            document.removeEventListener("scroll", lazyLoad);
                            window.removeEventListener("resize", lazyLoad);
                            window.removeEventListener("orientationchange", lazyLoad);
                        }
                    }
                });
        
                active = false;
                }, 200);
            }
        };
        
        document.addEventListener("scroll", lazyLoad);
        window.addEventListener("resize", lazyLoad);
        window.addEventListener("orientationchange", lazyLoad);
    }
});