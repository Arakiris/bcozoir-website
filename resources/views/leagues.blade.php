@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="leagues" />
@endsection


@section('content')
<div class="content__title occasion-content">
    <h1 class="heading-1">{{ $title }}</h1>
    <p class="content__paragraph">Cliquer sur les ligues pour avoir le r&egraveglement</p>
</div>
<div class="event event__league">
    @if(isset($leagues) && $leagues->count()>0)
        <div class="event__table event__table-league main-content-occasion">
            @foreach($leagues as $league)
                <div class="event__single-information">
                    <h2 class="heading-2--event-title">{{ $league->day_of_week }}</h2>
                    <p class="event__single-paragraphe">{{ $league->name }}</p>
                    <p class="event__single-paragraphe">{{ $league->is_accredited ? 'Homologué' : 'Non homologué' }}</p>
                    <p class="event__single-paragraphe">{{ $league->place }}</p>
                </div>
                <div class="event__single-members event__league-name event__single-members-league">
                    <p class="event__single-paragraphe">{{ $league->team_name }}</p>
                </div>

                <div class="event__single-members event__single-members-league event__members-league">
                    @if(isset($league->members) && $league->members->count()>0)
                        @foreach($league->members as $member)
                            <div class="event__noteam-line">
                                <div class="event__tooltip tooltip-occasion {{ ($member->is_licensee == 'Licencié') ?  'event__tooltip-licensee' : 'event__tooltip-adherent' }}">
                                    <p class="event__noteam-paragraph {{ ($member->club_id != 1) ? 'otherClub' : '' }}">{{ $member->last_name }} {{ $member->first_name }}</p>
                                    <div class="event__tooltip-event tooltiptext-occasion {{ ($member->is_licensee == 'Licencié') ?  'event__tooltip-event-licensee' : 'event__tooltip-event-adherent' }}">
                                        <img class="event__tooltipimg full-size-img" src="{{ ($member->picture->first()) ? asset('storage' . $member->picture->first()->path) : null }}" alt="Photo de {{ $member->last_name }} - {{ $member->first_name }}">
                                        <div class="event__tooltipcontent tooltipcontent">
                                            @if(isset($member->birth_date) && !empty($member->birth_date) && $member->birth_date->diffInYears(Carbon\Carbon::now()) >= 100)
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
                        @endforeach
                    @endif
                </div>

                @if(isset($league->result) || isset($tournament->result))
                    <div class="event__single-image">
                        <a class="event__single-link" href="{{ $league->result }}" target="_blank">
                            <img class="event__single-logo occasion-image-league-lexero" src="images/tournament/Lexer.jpg" alt="Image du lien">
                        </a>
                    </div>
                @else
                    <div class="event__single-image event__single-image--disable">
                        <div class="event__cell--disable">
                            <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/Lexer.jpg') }}" alt="Lien lexer du résultat">
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="event__bottom bottom-tournament-league">
            <div class="paginations bottom-div">
                {{ $leagues->links() }}
            </div>
        </div>
    @else
        <div class="main-content-occasion">
            <p>Il n'y a pas encore de ligues.</p>
        </div>
    @endif
</div>
@endsection