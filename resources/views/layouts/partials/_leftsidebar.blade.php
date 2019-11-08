<div class="random-pic random-pic__left partnerFrame">
    <div class="random-pic__title partnerAdsTitle"> <a href="{{ route('becomePartner') }}" class="random-pic__title-link partner-link-become">Partenaires </a></div>
    <div class="random-pic__content partners-carousel">
        @foreach($partnerAds as $partner)
            <div class="random-pic__content-left">
                <div class="random-pic__content-single">
                    @if (!empty($partner->url))
                        <a class="random-pic__link-single" href="{{ $partner->url }}" target="_blank">
                            <img data-lazy="{{ asset('storage' . $partner->picture->first()->path)  }}" alt="Photo au hasard" class="random-pic__photo-left partnerRandomPicture">
                        </a>
                    @else
                        <img data-lazy="{{ asset('storage' . $partner->picture->first()->path)  }}" alt="Photo au hasard" class="random-pic__photo-left partnerRandomPicture">
                    @endif
                    <div class="random-pic__text-single partnerAdsText">
                        {!! $partner->title !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

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
            <li class="aside-left-bar__item"><a class="aside-left-bar__link" href="{{ route('podiums') }}">Photos podiums</a></li>
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
        <li class="aside-left-bar__item"><a class="aside-left-bar__link" href="{{ route('documentsDivers') }}">Documents divers</a></li>
    </ul>
</nav>

<div class="aside-left-calendar">
    <div class="aside-left-calendar__title agendaTitle"><span>Agenda</span></div>
    <div id="calendar" class="calendar">
    </div>
</div>

<div class="aside-left-counter">
    <div class="aside-left-counter__title counter-title">
        <h2 class="heading-2 title">CONNEXIONS</h2>
    </div>

    <div><img class="aside-left-counter__img counter-img" src="{{ asset('images/Guest-online.png') }}" alt="Image signifiant les visiteurs actuellement en ligne"></div>
    <div>{{ $onlineguest }}</div>
    <div>En ligne</div>

    <div><img class="aside-left-counter__img counter-img" src="{{ asset('images/Visitor-counter.png') }}" alt="Image signifiant le nombre de visiteurs du jour"></div>
    <div>{{ $stat->daily_visits }}</div>
    <div>Visites aujourd'hui</div>

    <div><img class="aside-left-counter__img counter-img" src="{{ asset('images/Visitor-counter.png') }}" alt="Image signifiant le nombre de visiteurs du mois"></div>
    <div>{{ $stat->month_visits }}</div>
    <div>Visites du mois en cours</div>

    <div><img class="aside-left-counter__img counter-img-last" src="{{ asset('images/Total-visitor-counter.png') }}" alt="Image signifiant le nombre de visiteurs dupuis la création du site"></div>
    <div>{{ $stat->since_creation_visits }}</div>
    <div>Visites depuis le 24 Janvier 2018</div>
</div>