@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="archives, leagues" />
@endsection

@section('content')
    <div class="content__title main-content-title">
        <h1 class="heading-1">{{ $title }}</h1>
        <p class="content__paragraph">
            Cliquer sur la ligue pour avoir le r&egraveglement 
        </p>
    </div>

    @if(isset($leagues))
        <?php $previousYear = $leagues[0]->start_season->format('Y'); ?>
        <div class="archives">
            <ul class="tabs">
                <li class="tabs__link tabs__link-current" data-tab="tab-{{ $previousYear }}">{{ $previousYear }}</li>

                @if (isset($years) && $years->count()>0)
                    @foreach($years as $year)
                        <li class="tabs__link" data-tab="tab-{{ $year->year }}">{{ $year->year }}</li>
                    @endforeach
                @endif
            </ul>

            <div id="tab-{{ $previousYear }}" class="tabs__content tabs__content-current">
                <div class="archives__content archives__content-league archives__paginate" id="paginate-{{ $previousYear }}">
                    <div class="archives__tables archives__tables-league" id="table-{{ $previousYear }}">
                        @foreach($leagues as $league)
                            <div class="archives__row archives__row-league">
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
                                    @endif
                                </div>
                
                                @if(isset($league->result) || isset($tournament->result))
                                    <div class="event__single-image">
                                        <a class="event__single-link" href="{{ $league->result }}" target="_blank">
                                            <img class="event__single-logo" src="{{ asset('images/tournament/Lexer.jpg') }}" alt="Image du lien">
                                        </a>
                                    </div>
                                @else
                                    <div class="event__single-image event__single-image--disable">
                                        <div class="event__cell--disable">
                                            <img class="event__single-logo" src="{{ asset('images/tournament/Lexer.jpg') }}" alt="Lien lexer du résultat">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="event__bottom bottom-tournament-league">
                    <div class="pagination bottom-div" id="pag-{{ $previousYear }}">
                    </div>
                </div>
            </div>

            @foreach($years as $year)
                <div id="tab-{{ $year->year }}" class="tabs__content tabs__not-loaded tab-content not-loaded">
                    
                </div>
            @endforeach
        </div>
    @else
        <div class="archives archives__pagination_hide">
            <p class="inexistent">Il n'y a pas encore de ligue archivé.</p>
        </div>
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('js/paginathing.min.js') }}"></script>
    <script src="{{ asset('js/archivesleague.js') }}"></script>
    
    <script>
        let lenghtlast = {!! isset($leagues) ? json_encode($leagues->count(), JSON_HEX_TAG)  : json_encode('0', JSON_HEX_TAG) !!};
        let previousYear = {!! isset($previousYear) ? json_encode($previousYear, JSON_HEX_TAG) : json_encode(null, JSON_HEX_TAG) !!};
        let url = {!! json_encode(route('leaguesYear'), JSON_HEX_TAG) !!};

        let url_image = {!! json_encode(asset('images'), JSON_HEX_TAG) !!};
        let url_storage = {!! json_encode(asset('storage'), JSON_HEX_TAG) !!};

        createLeagueArchives(lenghtlast, previousYear, url, url_image, url_storage);
    </script>
@endsection