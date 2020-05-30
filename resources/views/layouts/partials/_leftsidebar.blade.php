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
            <li class="aside-left-bar__item aside-left-bar__item-dropdown">
                <div class="aside-left-bar__dropdown-btn">Tournois</div>
                <ul class="aside-left-bar__dropdown">
                    <li class="aside-left-bar__dropdown-item"><a class="aside-left-bar__link" href="{{ route('tournoisOzoir') }}">Tournois BC Ozoir</a></li>
                    <li class="aside-left-bar__dropdown-item"><a class="aside-left-bar__link" href="{{ route('tournoisPrives') }}">Tournois Privés</a></li>
                        <li class="aside-left-bar__dropdown-item"><a class="aside-left-bar__link" href="{{ route('championnats') }}">Championnats fédéraux</a></li>
                </ul>
            </li>
            <li class="aside-left-bar__item"><a class="aside-left-bar__link" href="{{ route('classementPodiums') }}">Classement podiums</a></li> 
        </ul>
    </div>
    <div class="aside-left-bar__container side-bar-left-green">
        <div class="aside-left-bar__container-title side-bar-green-title">Archivage</div>
        <ul class="aside-left-bar__list side-bar">
            <li class="aside-left-bar__item"><a class="aside-left-bar__link" href="{{ route('archivesligues') }}">Ligues</a></li>
            {{-- <li class="aside-left-bar__item"><a class="aside-left-bar__link" href="{{ route('archiveschoix') }}">Tournois</a></li> --}}
            <li class="aside-left-bar__item aside-left-bar__item-dropdown">
                <div class="aside-left-bar__dropdown-btn">Tournois</div>
                <ul class="aside-left-bar__dropdown">
                    <li class="aside-left-bar__dropdown-item"><a class="aside-left-bar__link" href="{{ route('vieuxtournoisOzoir') }}">Tournois BC Ozoir</a></li>
                    <li class="aside-left-bar__dropdown-item"><a class="aside-left-bar__link" href="{{ route('vieuxtournoisPrives') }}">Tournois Privés</a></li>
                    <li class="aside-left-bar__dropdown-item"><a class="aside-left-bar__link" href="{{ route('vieuxchampionnats') }}">Championnats fédéraux</a></li>
                </ul>
            </li>
            <li class="aside-left-bar__item"><a class="aside-left-bar__link" href="{{ route('archivesClassementPodiums') }}">Classement podiums</a></li>
        </ul>
    </div>
    <ul class="aside-left-bar__list side-bar">
        <li class="aside-left-bar__item"><a class="aside-left-bar__link" href="{{ route('podiums') }}">Photos podiums</a></li>
        <li class="aside-left-bar__item"><a class="aside-left-bar__link" href="{{ route('documentsDivers') }}">Documents divers</a></li>
    </ul>
</nav>

{{-- <div class="aside-left-player">
    <audio class="aside-left-player__audio" id="audio" controls loop >
        <source src="{{ isset($music_link->path) ? asset('storage' . $music_link->path) : asset('music/music.mp3') }}" type="audio/mpeg">
            <p>Votre navigateur ne prend pas en charge l'audio HTML.</p>
    </audio>
</div> --}}

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

<div class="aside-left-fb">
    <a href="{{ isset($fb_link->description) ? $fb_link->description : 'https://www.facebook.com/BC-OZOIR-1550418735236885/' }}" class="aside-left-fb__link" target="_blank">
        <img src="{{ isset($fb_img->path) ? asset('storage' . $fb_img->path) : asset('images/fb-img.png') }}" alt="Image de facebook" class="aside-left-fb__img">
    </a>
</div>