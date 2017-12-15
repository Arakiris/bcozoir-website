<aside class="aside-left">
    <nav class="aside-bar">
        <ul class="side-bar">
            <li><a href="{{ route('actualites') }}">Actualités</a></li>
            <li><a href="{{ route('tournoisOzoir') }}">Tournois BC Ozoir</a></li>
            <li><a href="{{ route('tournoisPrives') }}">Tournois privés</a></li>
            <li><a href="{{ route('championnats') }}">Championnats fédéraux</a></li>
            <li><a href="{{ route('ligues') }}">Ligues</a></li>
            <li><a href="{{ route('listing') }}">Moyennes listing</a></li>
            <li><a href="{{ route('podiums') }}">Podiums</a></li>
            <li><a href="{{ route('evenements') }}">Évènements</a></li>
            <li><a href="{{ route('archiveschoix') }}">Archives tournois</a></li>
            <li><a href="{{ route('archivesligues') }}">Archives ligues</a></li>
        </ul>
    </nav>
    
    <div class="container-calendar">
        <div class="agendaTitle"><span>Agenda</span></div>
        <div id="calendar" class="calendar">
        </div>
    </div>

    <div class="counter">
        <div class="counter-title">
            <h2 class="title">Compteurs</h2>
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
                    <td>Visites dernier mois</td>
                </tr>
                <tr>
                    <td><img class="counter-img-last" src="{{ asset('images/Total-visitor-counter.png') }}" alt="Image signifiant le nombre de visiteurs dupuis la création du site"></td>
                    <td>{{ $stat->since_creation_visits }}</td>
                    <td>Visites depuis le 27 Décembre 2017</td>
                </tr>
            </table>
        </div>
    </div>
</aside>