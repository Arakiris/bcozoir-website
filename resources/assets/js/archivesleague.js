window.createLeagueArchives = function(lenghtlast, previousYear, url, url_image, url_storage) {
    let tabs = document.querySelectorAll('ul.tabs li');
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    if(previousYear !== null) {
        let bottom_pag = document.querySelector('.event__bottom');
        if(lenghtlast && lenghtlast > 5){
            bottom_pag.classList.remove('archives__pagination_hide');
            $(function(){
                $('#table-' + previousYear).paginathing({
                    perPage: 5,
                    insertAfter: '#pag-' + previousYear,
                    prevText: '&lt;',
                    nextText: '&gt;',
                    firstText: '&laquo;',
                    lastText: '&raquo;'
                });
            });
        }

        for (let i = 0; i < tabs.length; i++){
            tabs[i].addEventListener('click', event => {
                let tab_id = event.target.getAttribute('data-tab');
                let parentToAddElement = document.getElementById(tab_id);
                let id = tab_id.substring(4);

                document.querySelector('li.tabs__link-current').classList.remove('tabs__link-current');
                document.querySelector('div.tabs__content-current').classList.remove('tabs__content-current');

                event.target.classList.add('tabs__link-current');
                parentToAddElement.classList.add('tabs__content-current');

                if(parentToAddElement.classList.contains('not-loaded')){
                    getDataLeague(id, token, parentToAddElement, url);
                    parentToAddElement.classList.remove('not-loaded');
                }
            }, false);
        }
    }

    function getDataLeague(id, token, parent, url) {
        renderLoader(parent);
        getDataAjax(url, id, token).then(league => {
            renderLeague(league, parent);

            if(league.length > 5){
                $(function(){
                    $('#table-' + id).paginathing({
                        perPage: 5,
                        insertAfter: '#pag-' + id,
                        prevText: '&lt;',
                        nextText: '&gt;',
                        firstText: '&laquo;',
                        lastText: '&raquo;'
                    });
                });
            }

            clearLoader(parent);
        });
        
    }

    async function getDataAjax(url, id, token) {
        const response = await fetch(url, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                },
                method: 'post',
                credentials: "same-origin",
                body: JSON.stringify({
                    id: id
                })
            });
        const resData = await response.json();

        return resData
    }

    const renderLoader = parent => {
        const loader = `
            <div class="loader"></div>
        `;
        parent.insertAdjacentHTML("afterbegin", loader);
    };

    const clearLoader = parent => {
        let loader = parent.querySelector('.loader');
        if(loader)
            loader.parentElement.removeChild(loader);
    };

    const renderLeague = (league, parent) => {
        let dateString = league[0].start_season.substring(0, 10).split('-');

        let markup = `
            <div class="archives__content archives__content-league archives__paginate" id="paginate-${dateString[0]}">
                <div class="archives__tables archives__tables-league" id="table-${dateString[0]}"> 
        `;

        league.forEach(el => {
            markup += renderLineLeague(el, parent);
        });
    
        markup += `
                </div>
            </div>
        `;

        parent.insertAdjacentHTML("afterbegin", markup);

        let markup2 = `
            <div id="tab-${dateString[0]}" class="tabs__content tabs__not-loaded tab-content not-loaded">
            </div>
        `;

        parent.insertAdjacentHTML("afterbegin", markup2);

        let markup3 = `
        <div class="event__bottom ${league.length > 5 ? 'archives__pagination_hide' : '' }">
            <div class="pagination bottom-div" id="pag-${dateString[0]}">
            </div>
        </div>
        `;

        parent.insertAdjacentHTML("beforeend", markup3);
    }

    const renderLineLeague = (league, parent) => {
        let dateString = league.start_season.substring(0, 10).split('-');
        let date = new Date(dateString[0], parseInt(dateString[1]) - 1, dateString[2]);

        let options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };

        let dateFormat = date.toLocaleString('fr-FR', options);
        dateFormat = dateFormat.charAt(0).toUpperCase() + dateFormat.slice(1);

        let storage = url_storage;

        // Render first and second column
        let markup = `
            <div class="archives__row archives__row-league">
                <div class="event__single-information">
                    <h2 class="heading-2--event-title">${ league.day_of_week }</h2>
                    <p class="event__single-paragraphe">${ league.name }</p>
                    <p class="event__single-paragraphe">${ league.is_accredited ? 'Homologué' : 'Non homologué' }</p>
                    <p class="event__single-paragraphe">${ league.place }</p>
                </div>
                <div class="event__single-members event__league-name event__single-members-league">
                    <p class="event__single-paragraphe">${ league.team_name }</p>
                </div>
        `;


        // Render third column
        markup +=  `
            <div class="event__single-members event__single-members-league event__members-league">
        `;

        if(typeof league.members !== "undefined" && league.members.length > 0){
            league.members.forEach(member => {
                markup += renderMember(member);
            });
        }


        markup +=  `
            </div>
        `;
            
        // Render third column
        if(typeof league.result !== "undefined"){
            markup += `
                <div class="event__single-image">
                    <a class="event__single-link" href="${ league.result }" target="_blank">
                        <img class="event__single-logo" src="${url_image}/tournament/Lexer.jpg" alt="Image du lien">
                    </a>
                </div>
            `;
        }
        else {
            markup += `
                <div class="event__single-image event__single-image--disable">
                    <div class="event__cell--disable">
                        <img class="event__single-logo" src="${url_image}/tournament/Lexer.jpg" alt="Lien lexer du résultat">
                    </div>
                </div>
            `;
        }

        markup += `
            </div>
        `;

        return markup;
    }

    const renderMember = (member) => {
        let storage = url_storage;
        let age = null;

        
        if(typeof member.birth_date !== "undefined" && member.birth_date){
            age = moment(member.birth_date).fromNow(true);
            if(age >= 100){
                age = null;
            }
        }

        let markup = "";
        
        markup += `
        <div class="event__noteam-line">
            <div class="event__tooltip tooltip-occasion ${ member.is_licensee == 'Licencié' ?  'event__tooltip-licensee' : 'event__tooltip-adherent' }">
                <p class="event__noteam-paragraph ${ member.club_id != 1 ? 'otherClub' : ''}">${ member.last_name } ${ member.first_name }</p>
                <div class="event__tooltip-event tooltiptext-occasion ${ member.is_licensee == 'Licencié' ? 'event__tooltip-event-licensee' : 'event__tooltip-event-adherent' }">
                    <img class="event__tooltip-img" src="${member.picture.length > 0 ? storage + '/' + member.picture[0].path : url_image + '/blank-profile.png' }" alt="Photo de ${ member.last_name } - ${ member.first_name }">
                    <div class="event__tooltipcontent tooltipcontent">
                        <p class="event__tooltiptext">${ member.last_name } ${ member.first_name } ${ age ? ' - ' + age + 'ans' : '' } </p>
                        <p class="event__tooltiptext">${ member.club.name }</p>
        `;

        if(member.is_licensee === "Licencié"){
            markup += `
                        <p class="event__tooltiptext">Licence : ${ (member.id_licensee) ? member.id_licensee : '' }</p>
                        <p class="event__tooltiptext">${ member.category.title }</p>
                        <p class="event__tooltiptext">Moyenne : ${ (member.score && member.score.average) ? member.score.average : "Pas d'enregistrement" }</p>
                        <p class="event__tooltiptext">Handicap : ${ member.handicap }</p>
                        <p class="event__tooltiptext">Bonus vétéran : ${ member.bonus }</p>
            `;
        }
        else {
            markup += `
                        <p class="event__tooltiptext">${ member.is_licensee }</p>
            `;
        }

        markup += `
                    </div>
                </div>
            </div>
        </div>
        `;

        return markup;
    }
}