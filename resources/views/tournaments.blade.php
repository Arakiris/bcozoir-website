@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="tournois" />
@endsection

@section('content')
<div class="content__title">
    <h1 class="heading-1">{{ $title }}</h1>
    <p class="content__paragraph">
        @if((isset($futur) && ($futur == true)) || (isset($tournaments) && $tournaments->count() == 1))
            Cliquer sur le tournoi pour avoir le r&egraveglement
        @else
            Cliquer sur les tournois pour avoir le r&egraveglement
        @endif                 
        
    </p>
</div>
<div class="event">
    @if(isset($tournaments) && $tournaments->count()>0)
        @if(isset($futur) && ($futur == true))
            <div class="event__table event__table-future">
        @else
            <div class="event__table event__table-tournament">
        @endif                 
            @foreach($tournaments as $tournament)
                <div class="event__single-information">
                    @if((isset($tournament->rules_url) && ($tournament->is_rules_pdf == 0)) || (isset($tournament->rules_pdf) && ($tournament->is_rules_pdf == 1)))
                        <a class="event__single-link occasion-link" href="{{ $tournament->is_rules_pdf ? asset('storage' . $tournament->rules_pdf) : $tournament->rules_url }}" target="_blank">
                            <h2 class="heading-2--event-title"><?php setlocale(LC_TIME, 'fr'); echo utf8_encode(strftime("%d-%B-%Y", $tournament->date->timestamp)); ?></h2>
                            <p class="event__single-paragraphe">{{ $tournament->title }}</p>
                            <p class="event__single-paragraphe">{{ $tournament->is_accredited ? 'Homologué' : 'Non homologué' }}</p>
                            <p class="event__single-paragraphe">{{ $tournament->place }}</p>
                        </a>
                    @else
                        <h2 class="heading-2--event-title"><?php setlocale(LC_TIME, 'fr'); echo utf8_encode(strftime("%d-%B-%Y", $tournament->date->timestamp)); ?></h2>
                        <p class="event__single-paragraphe">{{ $tournament->title }}</p>
                        <p class="event__single-paragraphe">{{ $tournament->is_accredited ? 'Homologué' : 'Non homologué' }}</p>
                        <p class="event__single-paragraphe">{{ $tournament->place }}</p>
                    @endif
                </div>
                <div class="event__single-members">
                    @if((isset($tournament->members) && $tournament->members->count()>0) || isset($tournament->teams) && $tournament->teams->count()>0)
                        @if ($tournament->formation == 0 && isset($tournament->members) && $tournament->members->count()>0)
                            <div class="event__noteam no-team">
                                @foreach($tournament->members as $member)
                                    <div class="event__noteam-line">
                                        <div class="event__tooltip {{ ($member->is_licensee == 'Licencié') ?  'event__tooltip-licensee' : 'event__tooltip-adherent' }}">
                                            <p class="event__noteam-paragraph {{ ($member->club_id != 1) ? 'otherClub' : '' }}">{{ $member->last_name }} {{ $member->first_name }}</p>
                                            <div class="event__tooltip-event {{ ($member->is_licensee == 'Licencié') ?  'event__tooltip-event-licensee' : 'event__tooltip-event-adherent' }}">
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
                                @endforeach
                            </div>
                        @endif
                        
                        @if ($tournament->formation == 1 && isset($tournament->teams) && $tournament->teams->count()>0)
                            @foreach($tournament->teams as $team)
                                <div class="event__team-title"><p class="event__team-text">{{$team->name}}</p></div>
                                <div class="event__team-content">
                                    @foreach ($team->members as $member)
                                        <div class="event__team-line">
                                            <div class="event__tooltip {{ ($member->is_licensee == 'Licencié') ?  'event__tooltip-licensee' : 'event__tooltip-adherent' }}">
                                                <p class="event__team-paragraph {{ ($member->club_id != 1) ? 'otherClub' : '' }}">{{ $member->last_name }} {{ $member->first_name }}</p>
                                                <div class="event__tooltip-event {{ ($member->is_licensee == 'Licencié') ?  'event__tooltip-event-licensee' : 'event__tooltip-event-adherent' }}">
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
                                    @endforeach
                                </div>
                            @endforeach
                        @endif
                    @endif
                </div>
                
                @if(isset($futur) && ($futur == false))
                    @if(isset($tournament->lexer_url))
                        <div class="event__single-image">
                            <a class="event__single-link" href="{{ $tournament->lexer_url }}" target="_blank">
                                <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/Lexer.jpg') }}" alt="Lien lexer du résultat">
                            </a>
                        </div>
                    @else
                        <div class="event__single-image--disable">
                            <div class="event__cell--disable">
                                <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/Lexer.jpg') }}" alt="Lien lexer du résultat">
                            </div>
                        </div>
                    @endif

                    @if(isset($tournament->listing))
                        <div class="event__single-image event__top-border">
                            <a class="event__single-link" href="{{ route('tournoiListing', $tournament->slug) }}">
                                <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/Listing.jpg') }}" alt="Listing du tournoi {{ $tournament->title }}">
                            </a>
                        </div>
                    @else
                        <div class="event__single-image--disable event__top-border">
                            <div class="event__cell--disable">
                                <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/Listing.jpg') }}" alt="Listing du tournoi {{ $tournament->title }}">
                            </div>
                        </div>
                    @endif

                    @if(isset($tournament->report))
                        <div class="event__single-image event__top-border">
                            <a class="event__single-link" href="{{ route('tournoiResultat', $tournament->slug) }}">
                                <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/Report.jpg') }}" alt="Image du résultat">
                            </a>
                        </div>
                    @else
                        <div class="event__single-image--disable event__top-border">
                            <div class="event__cell--disable">
                                <img class="occasion-image-logo" src="{{ asset('images/tournament/Report.jpg') }}" alt="Image du résultat">
                            </div>
                        </div>
                    @endif

                    @if(isset($tournament->pictures) && $tournament->pictures->count()>0)
                        <div class="event__single-image event__top-border">
                            <a class="event__single-link" href="{{ route('tournoiPhotos', $tournament->slug) }}">
                                <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/tournament-pictures.png') }}" alt="Image de présentation afin de montrer les photos du tournois">
                            </a>
                        </div>
                    @else
                        <div class="event__single-image--disable event__top-border">
                            <div class="event__cell--disable">
                                <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/tournament-pictures.png') }}" alt="Image de présentation afin de montrer les photos du tournois">
                            </div>
                        </div>
                    @endif

                    @if(isset($tournament->videos) && $tournament->videos->count()>0)
                        <div class="event__single-image event__top-border">
                            <a class="event__single-link" href="{{ route('tournoiVideos', $tournament->slug) }}">
                                <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/Tournament-videos.jpg') }}" alt="Image de présentation afin de montrer les vidéos du tournois">
                            </a>
                        </div>
                    @else
                        <div class="event__single-image--disable event__top-border">
                            <div class="event__cell--disable">
                                <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/Tournament-videos.jpg') }}" alt="Image de présentation afin de montrer les vidéos du tournois">
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
        <div class="event__bottom bottom-tournament-league">
            @if($pagination)
                <div class="paginations bottom-div">
                    {{ $tournaments->links() }}
                </div>
            @endif
        </div>
    @else
        <div class="main-content-occasion">
            <p class="content__paragraph">Il n'y a pas encore de tournoi d'enregistrer cette saison.</p>
        </div>
    @endif
</div>
@endsection