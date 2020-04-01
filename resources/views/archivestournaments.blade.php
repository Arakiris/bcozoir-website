@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="archives, tournois, {{ $title }}" />
@endsection

@section('content')
    <div class="content__title main-content-title">
        <h1 class="heading-1">{{ $title }}</h1>
        <p class="content__paragraph">
            Cliquer sur le tournoi pour avoir le r&egraveglement                
        </p>
    </div>

    @if(isset($tournaments))
        <?php $previousYear = $tournaments[0]->start_season->format('Y'); ?>
        <div class="archives">
            <div class="archives__content main-content-archives">
                <ul class="tabs">
                    <li class="tabs__link tabs__link-current" data-tab="tab-{{ $previousYear }}">{{ $previousYear }}</li>

                    @if (isset($years) && $years->count()>0)
                        @foreach($years as $year)
                            <li class="tabs__link tab-link" data-tab="tab-{{ $year->year }}">{{ $year->year }}</li>
                        @endforeach
                    @endif
                </ul>

                <div id="tab-{{ $previousYear }}" class="tabs__content tabs__content-current">
                    <div class="archives__content archives__paginate" id="paginate-{{ $previousYear }}">
                        <div class="archives__tables" id="table-{{ $previousYear }}">
                            @foreach($tournaments as $tournament)
                                <div class="archives__row">
                                    <div class="event__single-information">
                                        @if((isset($tournament->rules_url) && ($tournament->is_rules_pdf == 0)) || (isset($tournament->rules_pdf) && ($tournament->is_rules_pdf == 1)))
                                        <a class="event__single-link" href="{{ $tournament->is_rules_pdf ? asset('storage' . $tournament->rules_pdf) : $tournament->rules_url }}" target="_blank">
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
                                            @if ((isset($tournament->members) && $tournament->members->count()>0) && $tournament->formation == 0)
                                                <div class="event__team-title team-title"><p class="event__team-text">Individuel</p></div>
                                                <div class="event__team-content team-members">
                                                    @foreach($tournament->members as $member)
                                                        <div class="event__team-line">
                                                            <div class="event__tooltip {{ ($member->is_licensee == 'Licencié') ?  'event__tooltip-licensee' : 'event__tooltip-adherent' }}">
                                                                <p class="event__noteam-paragraph {{ ($member->club_id != 1) ? 'otherClub' : '' }}">{{ $member->last_name }} {{ $member->first_name }}</p>
                                                                <div class="event__tooltip-event {{ ($member->is_licensee == 'Licencié') ?  'event__tooltip-event-licensee' : 'event__tooltip-event-adherent' }}">
                                                                    <img class="event__tooltip-img" src="{{ ($member->picture->first()) ? asset('storage' . $member->picture->first()->path) : null }}" alt="Photo de {{ $member->last_name }} - {{ $member->first_name }}">
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
                                            
                                            @if ((isset($tournament->teams) && $tournament->teams->count()>0) && $tournament->formation == 1)
                                                @foreach($tournament->teams as $team)
                                                    <div class="event__team-title team-title"><p class="event__team-text">{{$team->name}}</p></div>
                                                    <div class="event__team-content team-members">
                                                        @foreach ($team->members as $member)
                                                            <div class="event__team-line">
                                                                <div class="event__tooltip {{ ($member->is_licensee == 'Licencié') ?  'event__tooltip-licensee' : 'event__tooltip-adherent' }}">
                                                                    <p class="event__team-paragraph {{ ($member->club_id != 1) ? 'otherClub' : '' }}">{{ $member->last_name }} {{ $member->first_name }}</p>
                                                                    <div class="event__tooltip-event {{ ($member->is_licensee == 'Licencié') ?  'event__tooltip-event-licensee' : 'event__tooltip-event-adherent' }}">
                                                                        <img class="event__tooltip-img" src="{{ ($member->picture->first()) ? asset('storage' . $member->picture->first()->path) : null }}" alt="Photo de {{ $member->last_name }} - {{ $member->first_name }}">
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

                                    @if(isset($tournament->lexer_url))
                                        <div class="event__single-image">
                                            <a class="event__single-link" href="{{ $tournament->lexer_url }}" target="_blank">
                                                <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/Lexer.jpg') }}" alt="Lien lexer du résultat">
                                            </a>
                                        </div>
                                    @else
                                        <div class="event__single-image event__single-image--disable">
                                            <div class="event__cell--disable">
                                                <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/Lexer.jpg') }}" alt="Lien lexer du résultat">
                                            </div>
                                        </div>
                                    @endif
                
                                    @if(isset($tournament->listing))
                                        <div class="event__single-image">
                                            <a class="event__single-link" href="{{ route('tournoiListing', $tournament->slug) }}">
                                                <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/Listing.jpg') }}" alt="Listing du tournoi {{ $tournament->title }}">
                                            </a>
                                        </div>
                                    @else
                                        <div class="event__single-image--disable">
                                            <div class="event__cell--disable">
                                                <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/Listing.jpg') }}" alt="Listing du tournoi {{ $tournament->title }}">
                                            </div>
                                        </div>
                                    @endif
                
                                    @if(isset($tournament->report))
                                        <div class="event__single-image">
                                            <a class="event__single-link" href="{{ route('tournoiResultat', $tournament->slug) }}">
                                                <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/Report.jpg') }}" alt="Image du résultat">
                                            </a>
                                        </div>
                                    @else
                                        <div class="event__single-image--disable">
                                            <div class="event__cell--disable">
                                                <img class="occasion-image-logo" src="{{ asset('images/tournament/Report.jpg') }}" alt="Image du résultat">
                                            </div>
                                        </div>
                                    @endif
                
                                    @if(isset($tournament->pictures) && $tournament->pictures->count()>0)
                                        <div class="event__single-image">
                                            <a class="event__single-link" href="{{ route('tournoiPhotos', $tournament->slug) }}">
                                                <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/tournament-pictures.png') }}" alt="Image de présentation afin de montrer les photos du tournois">
                                            </a>
                                        </div>
                                    @else
                                        <div class="event__single-image--disable">
                                            <div class="event__cell--disable">
                                                <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/tournament-pictures.png') }}" alt="Image de présentation afin de montrer les photos du tournois">
                                            </div>
                                        </div>
                                    @endif
                
                                    @if(isset($tournament->videos) && $tournament->videos->count()>0)
                                        <div class="event__single-image">
                                            <a class="event__single-link" href="{{ route('tournoiVideos', $tournament->slug) }}">
                                                <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/Tournament-videos.jpg') }}" alt="Image de présentation afin de montrer les vidéos du tournois">
                                            </a>
                                        </div>
                                    @else
                                        <div class="event__single-image--disable">
                                            <div class="event__cell--disable">
                                                <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/Tournament-videos.jpg') }}" alt="Image de présentation afin de montrer les vidéos du tournois">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="event__bottom archives__pagination_hide">
                        <div class="pagination bottom-div" id="pag-{{ $previousYear }}">
                        </div>
                    </div>
                </div>

                @if (isset($years) && $years->count()>0)
                    @foreach($years as $year)
                        <div id="tab-{{ $year->year }}" class="tabs__content tabs__not-loaded not-loaded">
                            
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    @else
        <div class="archives main-content-archives">
            <p class="inexistent">Il n'y a pas encore de tournoi archivé.</p>
        </div>
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('js/paginathing.min.js') }}"></script>
    <script src="{{ asset('js/archivestournament.js') }}"></script>

    <script>
        let lenghtlast = {!! isset($tournaments) ? json_encode($tournaments->count(), JSON_HEX_TAG)  : json_encode('0', JSON_HEX_TAG) !!};
        let previousYear = {!! isset($previousYear) ? json_encode($previousYear, JSON_HEX_TAG) : json_encode(null, JSON_HEX_TAG) !!};

        let url;
        let urltype = {!! json_encode($type, JSON_HEX_TAG) !!};
        
        switch(urltype) {
            case 1:
                url = {!! json_encode(route('tournamentOzoirYear'), JSON_HEX_TAG) !!};
                break;
            case 2:
                url = {!! json_encode(route('tournamentsprivateYear'), JSON_HEX_TAG) !!};
                break;
            case 3:
                url = {!! json_encode(route('championshipsYear'), JSON_HEX_TAG) !!};
                break;
            default:
                url = "Mauvais URL";
        }
        let url_image = {!! json_encode(asset('images'), JSON_HEX_TAG) !!};
        let url_home = {!! json_encode(url('/'), JSON_HEX_TAG) !!};
        let url_storage = {!! json_encode(asset('storage'), JSON_HEX_TAG) !!};

        createTournamentArchives(lenghtlast, previousYear, url, url_home, url_image, url_storage);
    </script>
@endsection