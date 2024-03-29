@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="tournois" />
@endsection

@section('content')
<div class="content__title">
    <h1 class="heading-1">Classement Podiums</h1>
    <p class="content__paragraph">Cliquer sur le tournoi pour avoir le r&egraveglement</p>
</div>
    <div class="event event__ranking">
        @if(isset($podia) && $podia->count()>0)
            <div class="event__table event__table-ranking">
                @foreach($podia as $podium)
                    @if((isset($podium->tournament->members) && $podium->tournament->members->count()>0) || isset($podium->tournament->teams) && $podium->tournament->teams->count()>0)
                        <div class="event__single-information">
                            @if((isset($podium->tournament->rules_url) && ($podium->tournament->is_rules_pdf == 0)) || (isset($podium->tournament->rules_pdf) && ($podium->tournament->is_rules_pdf == 1)))
                                <a class="event__single-link" href="{{ $podium->tournament->is_rules_pdf ? asset('storage' . $podium->tournament->rules_pdf) : $podium->tournament->rules_url }}" target="_blank">
                                    <h2 class="heading-2--event-title"><?php setlocale(LC_TIME, 'fr'); echo utf8_encode(strftime("%d-%B-%Y", $podium->tournament->date->timestamp)); ?></h2>
                                    <p class="event__single-paragraphe">{{ $podium->tournament->title }}</p>
                                    <p class="event__single-paragraphe">{{ $podium->tournament->is_accredited ? 'Homologué' : 'Non homologué' }}</p>
                                    <p class="event__single-paragraphe">{{ $podium->tournament->place }}</p>
                                </a>
                            @else
                                <h2 class="heading-2--event-title"><?php setlocale(LC_TIME, 'fr'); echo utf8_encode(strftime("%d-%B-%Y", $podium->tournament->date->timestamp)); ?></h2>
                                <p class="event__single-paragraphe">{{ $podium->tournament->title }}</p>
                                <p class="event__single-paragraphe">{{ $podium->tournament->is_accredited ? 'Homologué' : 'Non homologué' }}</p>
                                <p class="event__single-paragraphe">{{ $podium->tournament->place }}</p>
                            @endif
                        </div>

                        <div class="event__ranking-container">
                            <table class="event__ranking-table">
                                @if ($podium->tournament->formation == 0 && isset($podium->tournament->members) && $podium->tournament->members->count()>0)
                                    <tbody>
                                        <tr>
                                            <td class="event__ranking-table-title event__ranking-table-title-left">Individuel</td>
                                            <td class="event__ranking-table-title">Classement podiums</td>
                                        </tr>
                                        @foreach($podium->tournament->members as $member)
                                            <tr>
                                                <td class="event__ranking-table-content event__ranking-table-solo">
                                                    <div class="event__tooltip event__tooltip-ranking {{ ($member->is_licensee == 'Licencié') ?  'event__tooltip-licensee' : 'event__tooltip-adherent' }}">
                                                        <p class="event__ranking-paragraph {{ ($member->club_id != 1) ? 'otherClub' : '' }}">{{ $member->last_name }} {{ $member->first_name }}</p>
                                                        <div class="event__tooltip-event event__tooltip-event-ranking {{ ($member->is_licensee == 'Licencié') ?  'event__tooltip-event-licensee' : 'event__tooltip-event-adherent' }}">
                                                            <img class="event__tooltip-img" src="{{ ($member->picture->first()) ? asset('storage' . $member->picture->first()->path) : asset('images/blank-profile.png') }}" alt="Photo de {{ $member->last_name }} - {{ $member->first_name }}">
                                                            <div class="event__tooltip-content">
                                                                @if(isset($member->birth_date) && !empty($member->birth_date) && $member->birth_date->diffInYears(Carbon\Carbon::now()) < 100)
                                                                    <p class="event__tooltiptext">{{ $member->last_name }} {{ $member->first_name }} - {{ $member->birth_date->diffInYears(Carbon\Carbon::now()) }} ans</p>
                                                                @else
                                                                    <p class="event__tooltiptext">{{ $member->last_name }} {{ $member->first_name }}</p>
                                                                @endif
                                                                <p class="event__tooltiptext">{{ $member->club->name }}</p>
                                                                @if($member->is_licensee === "Licencié")
                                                                    <p class="event__tooltiptext">Licence : {{ ($member->id_licensee) ? $member->id_licensee : '' }}</p>
                                                                    <p class="event__tooltiptext">{{ $member->category->title }}</p>
                                                                    <p class="event__tooltiptext">Moyenne : {{ ($member->score && $member->score->average) ? intval($member->score->average) : "Pas d'enregistdement" }}</p>
                                                                    <p class="event__tooltiptext">Handicap : {{ $member->handicap }}</p>
                                                                    <p class="event__tooltiptext">Bonus vétéran : {{ $member->bonus }}</p>
                                                                @else
                                                                    <p class="event__tooltiptext">{{ $member->is_licensee }}</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="event__ranking-table-content">
                                                    <div class="event__rank-display"> {{ !is_null($member->pivot->rank) ? $member->pivot->rank : '&nbsp;' }} </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @endif

                                @if ($podium->tournament->formation == 1 && isset($podium->tournament->teams) && $podium->tournament->teams->count()>0)
                                    @foreach($podium->tournament->teams as $team)
                                        <tbody>
                                            <tr>
                                                <td class="event__ranking-table-title event__ranking-table-title-left">{{$team->name}}</td>
                                                <td class="event__ranking-table-title">Classement podiums</td>
                                            </tr>
                                            
                                            @foreach ($team->members as $member)
                                                <tr>
                                                    <td class="event__ranking-table-content">
                                                        <div class="event__team-line">
                                                            <div class="event__tooltip event__tooltip-ranking {{ ($member->is_licensee == 'Licencié') ?  'event__tooltip-licensee' : 'event__tooltip-adherent' }}">
                                                                <p class="event__ranking-paragraph {{ ($member->club_id != 1) ? 'otherClub' : '' }}">{{ $member->last_name }} {{ $member->first_name }}</p>
                                                                <div class="event__tooltip-event event__tooltip-event-ranking {{ ($member->is_licensee == 'Licencié') ?  'event__tooltip-event-licensee' : 'event__tooltip-event-adherent' }}">
                                                                    <img class="event__tooltip-img" src="{{ ($member->picture->first()) ? asset('storage' . $member->picture->first()->path) : asset('images/blank-profile.png') }}" alt="Photo de {{ $member->last_name }} - {{ $member->first_name }}">
                                                                    <div class="event__tooltip-content">
                                                                        @if(isset($member->birth_date) && !empty($member->birth_date) && $member->birth_date->diffInYears(Carbon\Carbon::now()) < 100)
                                                                            <p class="event__tooltiptext">{{ $member->last_name }} {{ $member->first_name }} - {{ $member->birth_date->diffInYears(Carbon\Carbon::now()) }} ans</p>
                                                                        @else
                                                                            <p class="event__tooltiptext">{{ $member->last_name }} {{ $member->first_name }}</p>
                                                                        @endif
                                                                        <p class="event__tooltiptext">{{ $member->club->name }}</p>
                                                                        @if($member->is_licensee === "Licencié")
                                                                            <p class="event__tooltiptext">Licence : {{ ($member->id_licensee) ? $member->id_licensee : '' }}</p>
                                                                            <p class="event__tooltiptext">{{ $member->category->title }}</p>
                                                                            <p class="event__tooltiptext">Moyenne : {{ ($member->score && $member->score->average) ? intval($member->score->average) : "Pas d'enregistrement" }}</p>
                                                                            <p class="event__tooltiptext">Handicap : {{ $member->handicap }}</p>
                                                                            <p class="event__tooltiptext">Bonus vétéran : {{ $member->bonus }}</p>
                                                                        @else
                                                                            <p class="event__tooltiptext">{{ $member->is_licensee }}</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="event__ranking-table-content">
                                                        <div class="event__rank-display">
                                                            @if ($team->display_rank)
                                                                {{$member->pivot->rank}} 
                                                            @endif
                                                            &nbsp; 
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="event__bottom bottom-tournament-league">
                <div class="paginations bottom-div">
                    {{ $podia->links() }}
                </div>
            </div>
        @else
            <div class="main-content-occasion">
                <p>Il n'y a pas encore de classement d'enregistrer cette saison.</p>
            </div>
        @endif
    </div>
@endsection