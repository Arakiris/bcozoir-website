var DOMAnimations = (function(){
    var elementSetZero = function(element){
        element.style.overflow = 'hidden';
        element.style.height = 0;
        element.style.paddingTop = 0;
        element.style.paddingBottom = 0;
        element.style.marginTop = 0;
        element.style.marginBottom = 0;
    }

    var setTransition = function(element, duration = 500){
        element.style.transitionProperty = 'height, margin, padding';
        element.style.transitionDuration = duration + 'ms';
    }

    var removePropertyPadMarg = function(element){
        element.style.removeProperty('padding-top');
        element.style.removeProperty('padding-bottom');
        element.style.removeProperty('margin-top');
        element.style.removeProperty('margin-bottom');
    }

    var removePropertyAnimation = function(element){
        element.style.removeProperty('height');
        element.style.removeProperty('overflow');
        element.style.removeProperty('transition-duration');
        element.style.removeProperty('transition-property');
    }

    return{
        slideUp: function(element, duration = 500){
            element.style.height = element.offsetHeight + 'px';
            setTransition(element, duration);
            element.offsetHeight;
            elementSetZero(element);
            window.setTimeout(function(){
                element.style.display = 'none';
                removePropertyPadMarg(element);
                removePropertyAnimation(element);
            }, duration)
        },

        slideDown: function(element, duration = 500){
            element.style.removeProperty('display');
            let display = window.getComputedStyle(element).display;
            if (display === 'none')
                display = 'block';
            element.style.display = display;
            let height = element.offsetHeight;
            elementSetZero(element);
            element.offsetHeight;
            setTransition(element, duration);
            element.style.height = height + 'px';
            removePropertyPadMarg(element);
            window.setTimeout(function(){
                removePropertyAnimation(element);
            }, duration);
        },

        slideToggle: function(element, duration = 500){
            let display = window.getComputedStyle(element).display;
            if (display === 'none')
                slideDown(element, duration);
            else
                slideUp(element, duration);
        }
    }
}());

let prev = null;

let teams = document.getElementById('teams');
let addTeams = document.getElementById('add-teams');
let solo = document.getElementById('solo');
let addPlayers = document.getElementById('add-players');
let duration = 500;

let ranking_radios = document.querySelectorAll('input[name="formation"]');

for(let i = 0; i < ranking_radios.length; i++){
    ranking_radios[i].addEventListener('change', function(e){
        e.preventDefault();
        if(this.value == 0){
            DOMAnimations.slideUp(teams, duration);
            window.setTimeout(() => {
                DOMAnimations.slideDown(solo);
            }, duration);
            
            addTeams.classList.add('disabled');
            addTeams.disabled = true;
            addPlayers.classList.remove('disabled');
            addPlayers.disabled = false;
        }
        else if(this.value == 1){
            DOMAnimations.slideUp(solo, duration);
            window.setTimeout(() => {
                DOMAnimations.slideDown(teams);
            }, duration);
            addTeams.classList.remove('disabled');
            addTeams.disabled = false;
            addPlayers.classList.add('disabled');
            addPlayers.disabled = true;
        }
    }, false)
}