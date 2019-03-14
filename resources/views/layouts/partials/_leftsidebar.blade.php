<aside class="aside-left">
    <nav class="aside-bar">
        <ul class="side-bar">
            <li><a href="{{ route('actualites') }}">Informations</a></li>
            <li><a href="{{ route('evenements') }}">Évènements</a></li>
            <li><a href="{{ route('listing') }}">Moyennes listing</a></li>
            <li><a href="{{ route('ligues') }}">Ligues 2018-2019</a></li>
            <li><a href="{{ route('tournoisOzoir') }}">Tournois BC Ozoir 2018-2019</a></li>
            <li><a href="{{ route('tournoisPrives') }}">Tournois privés 2018-2019</a></li>
            <li><a href="{{ route('championnats') }}">Championnats fédéraux 2018-2019</a></li>
            <li><a href="{{ route('podiums') }}">Galerie photos podiums</a></li>
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