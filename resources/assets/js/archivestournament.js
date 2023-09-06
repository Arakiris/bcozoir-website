window.createTournamentArchives = function(lenghtlast, previousYear, url, url_home, url_image, url_storage){
    let tabs = document.querySelectorAll('ul.tabs li');
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    if(previousYear !== null) {
        let bottom_pag = document.querySelector('.event__bottom');
        if(lenghtlast && lenghtlast > 5){
            bottom_pag.classList.remove('archives__pagination_hide');
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
                    getDataTournament(id, token, parentToAddElement, url);
                    parentToAddElement.classList.remove('not-loaded');
                }
            }, false);
        }
    }

    function getDataTournament(id, token, parent, url) {
        renderLoader(parent);

        getDataAjax(url, id, token).then(tournaments => {
            renderTournament(tournaments, parent);

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

    const renderTournament = (tournament, parent) => {
        let dateString = tournament[0].start_season.substring(0, 10).split('-');

        let markup = `
            <div class="archives__content archives__paginate" id="paginate-${dateString[0]}">
                <div class="archives__tables" id="table-${dateString[0]}"> 
        `;

        tournament.forEach(el => {
            markup += renderLineTournament(el, parent);
        });
       
        markup += `
                </div>
            </div>
        `;

        parent.insertAdjacentHTML("afterbegin", markup);

        let markup2 = `
            <div class="event__bottom ${tournament.length > 5 ? 'archives__pagination_hide' : '' }">
                <div class="pagination bottom-div" id="pag-${dateString[0]}">
                </div>
            </div>
        `;

        parent.insertAdjacentHTML("beforeend", markup2);
    }

    const renderLineTournament = (tournament, parent) => {
        let dateString = tournament.date.substring(0, 10).split('-');
        let date = new Date(dateString[0], parseInt(dateString[1]) - 1, dateString[2]);

        let options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        let dateFormat = date.toLocaleString('fr-FR', options);
        dateFormat = dateFormat.charAt(0).toUpperCase() + dateFormat.slice(1);

        let storage = url_storage;

        let additional_information = '';

        if (typeof tournament.additional_information != "undefined" && tournament.additional_information != null && tournament.additional_information != ''){
            additional_information = `
                <div class="event__additional-information">
                    ${ tournament.additional_information }
                </div>
            `;
        }

        // Render first column
        let markup = `
            <div class="archives__row">
                <div class="event__single-information">
        `;

        if( ((typeof tournament.rules_url != "undefined" && tournament.rules_url != null) && (tournament.is_rules_pdf == 0))
            || ((typeof tournament.rules_pdf != "undefined" && tournament.rules_pdf != null) && (tournament.is_rules_pdf == 1)) ){

            markup +=  `
                <div class="event__single-information__wrapper">
                    <a class="event__single-link" class="occasion-link" href="${ (tournament.is_rules_pdf == 1) ? storage + '/' + tournament.rules_pdf : tournament.rules_url }" target="_blank">
                        <h2 class="heading-2--event-title">${dateFormat}</h2>
                        <p class="event__single-paragraphe">${ tournament.title }</p>
                        <p class="event__single-paragraphe">${ (tournament.is_accredited == 1) ? 'Homologué' : 'Non homologué' }</p>
                        <p class="event__single-paragraphe">${ tournament.place }</p>
                        ${ additional_information }
                    </a>
                </div>
            `;
        }
        else {
            markup +=  `
                <div class="event__single-information__wrapper">
                    <h2 class="heading-2--event-title">${dateFormat}</h2>
                    <p class="event__single-paragraphe">${ tournament.title }</p>
                    <p class="event__single-paragraphe">${ (tournament.is_accredited == 1) ? 'Homologué' : 'Non homologué' }</p>
                    <p class="event__single-paragraphe">${ tournament.place }</p>
                    ${ additional_information }
                </div>
            `
        }

        markup += `
            </div>
        `;

        
        // Render second column
        markup += `
            <div class="event__single-members">
        `;

        if(tournament.formation == 0 && typeof tournament.members !== "undefined" && tournament.members.length > 0){
            markup += `
                <div class="event__team-title"><p class="event__team-text">Individuel</p></div>
                <div class="event__team-content">`;
            tournament.members.forEach(member => {
                markup += renderMemberTournament(member);
            });
            markup += `</div>`;
        }

        if(tournament.formation == 1 && typeof tournament.teams !== "undefined" && tournament.teams.length > 0) {
            tournament.teams.forEach(team => {
                markup += renderTeamTournament(team);
            });
        }

        markup += `
            </div>
        `;


        // Render the  rest
        markup += rendercolumnURL(tournament.lexer_url, tournament.lexer_url, `${url_image}/tournament/Lexer.jpg`, true);
        markup += rendercolumnURL(tournament.listing, `${url_home}/tournoi/${tournament.slug}/listing`, `${url_image}/tournament/Listing.png`, false);
        markup += rendercolumnURL(tournament.report, `${url_home}/tournoi/${tournament.slug}/resultat`, `${url_image}/tournament/Report.png`, false);

        if(typeof tournament.pictures_count !== "undefined" && tournament.pictures_count > 0)
            markup += activeURL(`${url_home}/tournoi/${tournament.slug}/photos`, `${url_image}/tournament/tournament-pictures.png`, false);

        else 
            markup += inactiveURL(`${url_image}/tournament/tournament-pictures.png`);

        if(typeof tournament.videos_count !== "undefined" && tournament.videos_count > 0)
            markup += activeURL(`${url_home}/tournoi/${tournament.slug}/videos`, `${url_image}/tournament/Tournament-videos.png`, false);
        else 
            markup += inactiveURL(`${url_image}/tournament/Tournament-videos.png`);

        markup += `
            </div>
        `;

        return markup;
    }

    const renderMemberTournament = (member) => {
        let markup = `<div class="event__team-line">`;
        markup += renderMember(member);
        markup += `</div>`;
        
        return markup;
    };

    const renderTeamTournament = team => {
        let markup = `
            <div class="event__team-title team-title"><p class="event__team-text">${ team.name }</p></div>
                <div class="event__team-content team-members">
        `;

        team.members.forEach((member) => {
            markup += `<div class="event__team-line">`;
            markup += renderMember(member);
            markup += `</div>`;
        });

        markup += `
                </div>
        `;

        return markup;
    };

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
            <div class="event__tooltip ${ member.is_licensee == 'Licencié' ?  'event__tooltip-licensee' : 'event__tooltip-adherent' }">
                <p class="event__noteam-paragraph ${ member.club_id != 1 ? 'otherClub' : ''}">${ member.last_name } ${ member.first_name }</p>
                <div class="event__tooltip-event ${ member.is_licensee == 'Licencié' ? 'event__tooltip-event-licensee' : 'event__tooltip-event-adherent' }">
                    <img class="event__tooltip-img" src="${ member.picture.length > 0 ? storage + '/' + member.picture[0].path :  url_image + '/blank-profile.png'}" alt="Photo de ${ member.last_name } - ${ member.first_name }">
                    <div class="event__tooltip-content">
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
        `;

        return markup;
    }

    const rendercolumnURL = (item, url, img, target) => {
        if(typeof item !== "undefined" && item){
            return activeURL(url, img, target);
        }
        else {
            return inactiveURL(img);
        }
    }

    const activeURL = (url, img, target) => {
        console.log('target ' + target);
        return `
            <div class="event__single-image">
                <a class="event__single-link" href="${ url }" ${ (target === true) ? 'target="_blank"' : ''}>
                    <img class="event__single-logo occasion-image-league-lexero" src="${ img }" alt="Image du lien">
                </a>
            </div>
        `;
    }

    const inactiveURL = (img) => {
        return `
            <div class="event__single-image event__single-image--disable">
                <div class="event__cell--disable">
                    <img class="event__single-logo occasion-image-logo" src="${ img }" alt="Lien lexer du résultat">
                </div>
            </div>
        `;
    }
}