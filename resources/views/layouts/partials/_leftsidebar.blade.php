<nav class="aside-left-bar">
    <ul class="aside-left-bar__list side-bar">
        <li class="aside-left-bar__item"><a class="aside-left-bar__link" href="{{ route('actualites') }}">Informations</a></li>
        <li class="aside-left-bar__item"><a class="aside-left-bar__link" href="{{ route('evenements') }}">Évènements</a></li>
        <li class="aside-left-bar__item"><a class="aside-left-bar__link" href="{{ route('listing') }}">Moyennes listing</a></li>
    </ul>
    <div class="aside-left-bar__container side-bar-left-green">
        <div class="aside-left-bar__container-title side-bar-green-title">Saison en cours {{$season}}</div>
        
        <ul class="aside-left-bar__list side-bar">
            <li class="aside-left-bar__item"><a class="aside-left-bar__link" href="{{ route('ligues') }}">Ligues</a></li>
            <li class="aside-left-bar__item"><a class="aside-left-bar__link" href="{{ route('tournoisOzoir') }}">Tournois BC Ozoir</a></li>
            <li class="aside-left-bar__item"><a class="aside-left-bar__link" href="{{ route('tournoisPrives') }}">Tournois privés</a></li>
            <li class="aside-left-bar__item"><a class="aside-left-bar__link" href="{{ route('championnats') }}">Championnats fédéraux</a></li>
            <li class="aside-left-bar__item"><a class="aside-left-bar__link" href="{{ route('classementPodiums') }}">Classement podiums</a></li>
            
        </ul>
    </div>
    <div class="aside-left-bar__container side-bar-left-green">
        <div class="aside-left-bar__container-title side-bar-green-title">Archivage</div>
        <ul class="aside-left-bar__list side-bar">
            <li class="aside-left-bar__item"><a class="aside-left-bar__link" href="{{ route('archivesligues') }}">Ligues</a></li>
            {{-- <li class="aside-left-bar__item"><a class="aside-left-bar__link" href="{{ route('archiveschoix') }}">Tournois</a></li> --}}
            <li class="aside-left-bar__item aside-left-bar__item-dropdown">
                {{-- Tournois --}}
                <div class="aside-left-bar__dropdown-btn">Tournois</div>
                <ul class="aside-left-bar__dropdown">
                    <li class="aside-left-bar__dropdown-item"><a class="aside-left-bar__link" href="{{ route('vieuxtournoisOzoir') }}">Tournois d'Ozoir</a></li>
                    <li class="aside-left-bar__dropdown-item"><a class="aside-left-bar__link" href="{{ route('vieuxtournoisPrives') }}">Tournois Privés</a></li>
                    <li class="aside-left-bar__dropdown-item"><a class="aside-left-bar__link" href="{{ route('vieuxchampionnats') }}">Championnats fédéraux</a></li>
                </ul>
            </li>
            <li class="aside-left-bar__item"><a class="aside-left-bar__link" href="{{ route('archivesClassementPodiums') }}">Classements podiums</a></li>
        </ul>
    </div>
    <ul class="aside-left-bar__list side-bar">
        <li class="aside-left-bar__item"><a class="aside-left-bar__link" href="{{ route('podiums') }}">Photos podiums</a></li>
        <li class="aside-left-bar__item"><a class="aside-left-bar__link" href="{{ route('documentsDivers') }}">Documents divers</a></li>
    </ul>
</nav>

<div class="aside-left-calendar">
    <div class="aside-left-calendar__title agendaTitle"><span>Agenda</span></div>
    <div id="calendar" class="calendar">
    </div>
</div>

<div class="aside-left-counter">
    <div class="aside-left-counter__title">
        <h2 class="heading-2 aside-left-counter__heading">CONNEXIONS</h2>
    </div>

    <div class="aside-left-counter__wrapper">
        <div class="aside-left-counter__content">
            <h5 class="aside-left-counter__content-title">En ligne</h5>
            <p class="aside-left-counter__content-text">{{ $onlineguest }}</p>
        </div>
        <div class="aside-left-counter__content">
            <h5 class="aside-left-counter__content-title">Aujourd'hui</h5>
            <p class="aside-left-counter__content-text">{{ $stat->daily_visits }}</p>
        </div>
        <div class="aside-left-counter__content">
            <h5 class="aside-left-counter__content-title">Mois en cours</h5>
            <p class="aside-left-counter__content-text">{{ $stat->month_visits }}</p>
        </div>
        <div class="aside-left-counter__content">
            <h5 class="aside-left-counter__content-title">24/01/18 <span class="aside-left-counter__content-title--arrow">&#10132;</span> </h5>
            <p class="aside-left-counter__content-text">{{ $stat->since_creation_visits }}</p>
        </div>
    </div>
</div>