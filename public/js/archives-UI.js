class ArchivesUI {
    constructor(){
        this.container = document.getElementById('tabs2');
    }

    // Display year tab and content in UI
    showYearsTabContent(year, tournaments, first = false){
        let ulTabs = document.querySelector('.tabs2');
        if(ulTabs === null) {
            let newUl = document.createElement('ul');
            newUl.className = 'tabs2';
            this.container.insertAdjacentElement('afterbegin', newUl);

            ulTabs = document.querySelector('.tabs2');
        }
        if(first)
            ulTabs.innerHTML += `<li class="tab-link current" data-tab="tab-${year}">${year}</li>`;
        else 
            ulTabs.innerHTML += `<li class="tab-link" data-tab="tab-${year}">${year}</li>`;

        let tabContent = '';
        if(first)
            tabContent += `<li class="tab-link current" data-tab="tab-${year}">${year}</li>`;
        else
            tabContent += `<li class="tab-link" data-tab="tab-${year}">${year}</li>`;
        
        tabContent += `
            <div class="archive paginate">
                <table class="archive-table">
                    <tbody>
        `;

        tournaments.forEach(tournament => {
            tabContent += `
                <tr>
                    <td class="archive-information">
            `;

            if(this.isset(tournament.rules_url) ||  this.isset(tournament.rules_pdf)){
                tabContent += `
                    <a class="occasion-link" href="${document.location.host}/storage/${tournament.is_rules_pdf ? tournament.rules_pdf : tournament.rules_url}" target="_blank">
                        <h2>${this.formatDate(tournament.date)}</h2>
                        <p>${tournament.title}</p>
                        <p>${tournament.is_accredited ? 'Homologué' : 'Non homologué'}</p>
                        <p>${tournament.place}</p>
                    </a>
                `;
            }
            else {
                tabContent += `
                    <h2>${this.formatDate(tournament.date)}</h2>
                    <p>${tournament.title}</p>
                    <p>${tournament.is_accredited ? 'Homologué' : 'Non homologué'}</p>
                    <p>${tournament.place}</p>
                `;
            }

            if(this.isset(tournament.members) && tournament.members.length > 0){
                tabContent += '<td class="archive-member">';
                tournament.members.forEach(member => {
                    tabContent += `
                    <div class="tooltip-occasion">
                        <p class="${($member.club_id != 1) ? 'otherClub' : ''}">${member.last_name} ${member.first_name}</p>
                        <div class="tooltiptext-occasion ${(member.is_licensee == 'Licencié') ?  'licensee' : 'adherent'}">
                            <img class="float-left full-size-img" src="{{ ($member->picture->first()) ? asset('storage' . $member->picture->first()->path) : null }}" alt="Photo de {{ $member->last_name }} - {{ $member->first_name }}">
                            <div class="tooltipcontent">
                                <p>{{ $member->last_name }} {{ $member->first_name }} - {{ $member->birth_date->diffInYears(Carbon\Carbon::now()) }} ans</p>
                                <p>{{ $member->club->name }}</p>
                                @if($member->is_licensee === "Licencié")
                                    <p>Licence : {{ ($member->id_licensee) ? $member->id_licensee : '' }}</p>
                                    <p>{{ $member->category->title }}</p>
                                    <p>Moyenne : {{ ($member->score && $member->score->average) ? intval($member->score->average) : "Pas d'enregistrement"  }}</p>
                                    <p>Handicap : {{ $member->handicap }}</p>
                                    <p>Bonus : {{ $member->bonus }}</p>
                                @else
                                    <p>{{ $member->is_licensee }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    `;
                });
                tabContent += '</td>';
            }

            tabContent += `
                    </td>
                </tr>
                    
            `;
        });
        tabContent += `
                    <tbody>
                </table>
            </div>       
        `;

        this.container.innerHTML += tabContent;

    }

    isset(obj) {
        if ((typeof (obj) === 'undefined') || (obj === null))
            return false;
        else
            return true;
    }

    formatDate(d){
        let monthNames = [
            "Janvier", "Février", "Mars",
            "Avril", "Mai", "Juin", "Juillet",
            "Août", "Septembre", "Octobre",
            "Novembre", "Décembre"
        ]
        let date = new Date(d);
        return `${("0" + date.getDate()).slice(-2)}-${monthNames[date.getMonth()]}-${date.getFullYear()}`;
    }
}