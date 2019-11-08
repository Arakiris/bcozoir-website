<aside class="aside-left">

        <div class="partnerFrame">
            <a href="{{ route('becomePartner') }}" class="partner-link-become"><div class="partnerAdsTitle">Partenaires</div></a>
            <div class="partners-carousel partnerRandomPicture">
                @foreach($partnerAds as $partner)
                    <div>
                        @if (!empty($partner->url))
                            <a href="{{$partner->url}}">
                                <img data-lazy="{{ asset('storage' . $partner->picture->first()->path)  }}" alt="Photo au hasard" class="partnerRandomPicture">
                            </a>
                        @else
                            <img data-lazy="{{ asset('storage' . $partner->picture->first()->path)  }}" alt="Photo au hasard" class="partnerRandomPicture">
                        @endif
                        <div class="partnerAdsText">
                            {!! $partner->title !!}
                        </div>
                    </div>
                @endforeach
            </div>
    
        </div>

    <nav class="aside-bar">
        <ul class="side-bar">
            <li><a href="{{ route('actualites') }}">Informations</a></li>
            <li><a href="{{ route('evenements') }}">Évènements</a></li>
            <li><a href="{{ route('listing') }}">Moyennes listing</a></li>
        </ul>
        <div class="side-bar-left-green">
            <div class="side-bar-green-title">Saison en cours<br>{{$season}}</div>
            
            <ul class="side-bar">
                <li><a href="{{ route('ligues') }}">Ligues</a></li>
                <li><a href="{{ route('tournoisOzoir') }}">Tournois BC Ozoir</a></li>
                <li><a href="{{ route('tournoisPrives') }}">Tournois privés</a></li>
                <li><a href="{{ route('championnats') }}">Championnats fédéraux</a></li>
                <li><a href="{{ route('classementPodiums') }}">Classement podiums</a></li>
                <li><a href="{{ route('podiums') }}">Photos podiums</a></li>
            </ul>
        </div>
        <div class="side-bar-left-green">
            <div class="side-bar-green-title">Archivage</div>
            <ul class="side-bar">
                <li><a href="{{ route('archivesligues') }}">Ligues</a></li>
                <li><a href="{{ route('archiveschoix') }}">Tournois</a></li>
                <li><a href="{{ route('archivesClassementPodiums') }}">Classements podiums</a></li>
            </ul>
        </div>
        <ul class="side-bar">
            <li><a href="{{ route('documentsDivers') }}">Documents divers</a></li>
        </ul>
    </nav>
    
    <div class="container-calendar">
        <div class="agendaTitle"><span>Agenda</span></div>
        <div id="calendar" class="calendar">
        </div>
    </div>

    <div class="counter">
        <div class="counter-title">
            <h2 class="title">CONNEXIONS</h2>
        </div>
        <div class="counter-content">
            <table class="counter-table">
                <colgroup>
                    <col span="1" style="width: 14%;">
                    <col span="1" style="width: 14%;">
                    <col span="1" style="width: 72%;">
                </colgroup>
                <tr>
                    <td><img class="counter-img" src="{{ asset('images/Guest-online.png') }}" alt="Image signifiant les visiteurs actuellement en ligne"></td>
                    <td>{{ $onlineguest }}</td>
                    <td>En ligne</td>
                </tr>
                <tr>
                    <td><img class="counter-img" src="{{ asset('images/Visitor-counter.png') }}" alt="Image signifiant le nombre de visiteurs du jour"></td>
                    <td>{{ $stat->daily_visits }}</td>
                    <td>Visites aujourd'hui</td>
                </tr>
                <tr>
                    <td><img class="counter-img" src="{{ asset('images/Visitor-counter.png') }}" alt="Image signifiant le nombre de visiteurs du mois"></td>
                    <td>{{ $stat->month_visits }}</td>
                    <td>Visites du mois en cours</td>
                </tr>
                <tr>
                    <td><img class="counter-img-last" src="{{ asset('images/Total-visitor-counter.png') }}" alt="Image signifiant le nombre de visiteurs dupuis la création du site"></td>
                    <td>{{ $stat->since_creation_visits }}</td>
                    <td>Visites depuis le 24 Janvier 2018</td>
                </tr>
            </table>
        </div>
    </div>
</aside>