!function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:o})},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=3)}({3:function(e,t,n){e.exports=n("yy+8")},"yy+8":function(e,t){$(document).ready(function(){$(".content__warning").slick({dots:!1,prevArrow:!1,nextArrow:!1,infinite:!0,speed:300,autoplay:!0,autoplaySpeed:4e3}),$(".warning-carousel").addClass("carousel-initialized"),$(".welcome-carousel").slick({lazyLoad:"ondemand",dots:!0,prevArrow:!1,nextArrow:!1,infinite:!0,speed:300,autoplay:!0,autoplaySpeed:4e3}),$(".pictures-carousel").slick({lazyLoad:"ondemand",dots:!1,prevArrow:!1,nextArrow:!1,infinite:!0,speed:300,autoplay:!0,autoplaySpeed:5e3}),$(".partners-carousel").slick({lazyLoad:"ondemand",dots:!1,prevArrow:!1,nextArrow:!1,infinite:!0,speed:300,autoplay:!0,autoplaySpeed:5e3})}),window.addEventListener("load",function(){window.cookieconsent.initialise({palette:{popup:{background:"#edeff5",text:"#838391"},button:{background:"#4b81e8"}},theme:"classic",content:{message:"Ce site utilise des cookies pour vous assurer la meilleure expérience possible sur notre site. En poursuivant votre navigation sur ce site, vous acceptez notre utilisation de cookies.",dismiss:"OK",link:"En savoir plus",href:"http://bcozoir.dev/mentions-legales"}})}),lightbox.option({showImageNumberLabel:!1,disableScrolling:!1}),document.addEventListener("DOMContentLoaded",function(){var e=[].slice.call(document.querySelectorAll("img.lazy")),t=!1;if("IntersectionObserver"in window){var n=new IntersectionObserver(function(e,t){e.forEach(function(e){if(e.isIntersecting){var t=e.target;t.src=t.dataset.src,t.classList.remove("lazy"),n.unobserve(t)}})});e.forEach(function(e){n.observe(e)})}else{var o=function n(){!1===t&&(t=!0,setTimeout(function(){e.forEach(function(t){t.getBoundingClientRect().top<=window.innerHeight&&t.getBoundingClientRect().bottom>=0&&"none"!==getComputedStyle(t).display&&(t.src=t.dataset.src,t.srcset=t.dataset.srcset,t.classList.remove("lazy"),0===(e=e.filter(function(e){return e!==t})).length&&(document.removeEventListener("scroll",n),window.removeEventListener("resize",n),window.removeEventListener("orientationchange",n)))}),t=!1},200))};document.addEventListener("scroll",o),window.addEventListener("resize",o),window.addEventListener("orientationchange",o)}});var n=document.querySelectorAll(".aside-left-bar__dropdown-btn"),o=document.querySelectorAll(".aside-left-bar__dropdown");n.forEach(function(e){e.addEventListener("click",function(e){e.target.parentElement.querySelector(".aside-left-bar__dropdown").classList.toggle("aside-left-bar__dropdown-show"),o.forEach(function(t){t.parentElement.isSameNode(e.target.parentElement)||t.classList.remove("aside-left-bar__dropdown-show")})})}),window.addEventListener("click",function(e){e.target.matches(".aside-left-bar__item-dropdown")||e.target.matches(".aside-left-bar__dropdown-btn")||o.forEach(function(e){e.classList.remove("aside-left-bar__dropdown-show")})})}});