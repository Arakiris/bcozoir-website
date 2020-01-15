$(document).ready(function() {
    $('.content__warning').slick({
        dots: false,
        prevArrow: false,
        nextArrow: false,
        infinite: true,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 4000
    });

    $('.warning-carousel').addClass('carousel-initialized');

    $('.welcome-carousel').slick({
        lazyLoad: 'ondemand',
        dots: true,
        prevArrow: false,
        nextArrow: false,
        infinite: true,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 4000
    });

    $('.pictures-carousel').slick({
        lazyLoad: 'ondemand',
        dots: false,
        prevArrow: false,
        nextArrow: false,
        infinite: true,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 5000
    });

    $('.partners-carousel').slick({
        lazyLoad: 'ondemand',
        dots: false,
        prevArrow: false,
        nextArrow: false,
        infinite: true,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 5000
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

let alldropdown = document.querySelectorAll(".aside-left-bar__dropdown-btn");
let itemsdropdown = document.querySelectorAll(".aside-left-bar__dropdown");

alldropdown.forEach((item) => {
    item.addEventListener('click', event => {
        event.target.parentElement.querySelector(".aside-left-bar__dropdown").classList.toggle("aside-left-bar__dropdown-show");
        itemsdropdown.forEach((e) => {
            let elementToCheck = e.parentElement;
            if(!elementToCheck.isSameNode(event.target.parentElement))
                e.classList.remove("aside-left-bar__dropdown-show");
        });
        
    });

});

window.addEventListener("click", event => {
    if(!event.target.matches('.aside-left-bar__item-dropdown') && !event.target.matches('.aside-left-bar__dropdown-btn')){
        itemsdropdown.forEach((item) => {
            item.classList.remove("aside-left-bar__dropdown-show");
        });
    }
});