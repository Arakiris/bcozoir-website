@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="archives, tournois, archives classement podiums" />
@endsection

@section('content')
    <div class="content__title main-content-title">
        <h1 class="heading-1">Archives classement podiums</h1>
    </div>

    @if(isset($podia) && !empty($podia) && $podia->count() > 0)
        <?php $previousYear = $podia[0]->date->format('Y'); ?>
        <div class="archives main-content-archives">
            <ul class="tabs"> 
                <li class="tabs__link tabs__link-current" data-tab="tab-{{ $previousYear }}">{{ $previousYear }}</li>
                
                @if (isset($years) && $years->count()>0)
                    @foreach($years as $year)
                        <li class="tabs__link tab-link" data-tab="tab-{{ $year->year }}">{{ $year->year }}</li>
                    @endforeach
                @endif
            </ul>

            <div id="tab-{{ $previousYear }}" class="tabs__content tabs__content-current--ranking">
                <div class="archives__content archives__content-ranking archives__paginate" id="paginate-{{ $previousYear }}">
                    <div class="archives__tables archives__tables-ranking" id="table-{{ $previousYear }}">


                        @foreach($podia as $podium)

                            <div class="archives__row archives__row-ranking">
                                <div class="event__single-information occasion-information">
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

                                @if((isset($podium->tournament->members) && $podium->tournament->members->count()>0) || isset($podium->tournament->teams) && $podium->tournament->teams->count()>0)
                                    <div class="event__single-members event__single-members-ranking">
                                        @if ($podium->tournament->formation == 0 && isset($podium->tournament->members) && $podium->tournament->members->count()>0)
                                            <div class="event__team-title"><p class="event__team-text">Individuel</p></div>
                                            <div class="event__noteam-rank no-team">
                                                @foreach($podium->tournament->members as $member)
                                                    @if (!is_null($member->pivot->rank))
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
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
            
                                        @if ($podium->tournament->formation == 1 && isset($podium->tournament->teams) && $podium->tournament->teams->count()>0)
                                            @foreach($podium->tournament->teams as $team)
                                                @if ($team->display_rank)
                                                    <div class="event__team-title"><p class="event__team-text">{{$team->name}}</p></div>
                                                    <div class="event__team-content">
                                                        @foreach ($team->members as $member)
                                                            <div class="event__team-line">
                                                                <div class="event__tooltip event__tooltip-ranking event__tooltip-team-rank {{ ($member->is_licensee == 'Licencié') ?  'event__tooltip-licensee' : 'event__tooltip-adherent' }}">
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
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
            
                                    <div class="event__single-members event__single-members-ranking">
                                        @if ($podium->tournament->formation == 0 && isset($podium->tournament->members) && $podium->tournament->members->count()>0)
                                            <div class="event__team-title"><p class="event__team-text">Classement podiums</p></div>
                                            <div class="event__team-content">
                                                @foreach($podium->tournament->members as $member)
                                                    @if (!is_null($member->pivot->rank))
                                                        <div class="event__rank-display"> {{$member->pivot->rank}} </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
            
                                        @if ($podium->tournament->formation == 1 && isset($podium->tournament->teams) && $podium->tournament->teams->count()>0)
                                            @foreach($podium->tournament->teams as $team)
                                                @if ($team->display_rank)
                                                    <div class="event__team-title"><p class="event__team-text">Classement podiums</p></div>
                                                    <div class="event__team-content">
                                                        @foreach ($team->members as $member)
                                                            <div class="event__rank-display">{{ $member->pivot->rank }} &nbsp; </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
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

            @foreach($years as $year)
                <div id="tab-{{ $year->year }}" class="tabs__content tabs__not-loaded not-loaded">
                    
                </div>
            @endforeach
        </div>
    @else
        <div class="archives main-content-archives">
            <p class="inexistent">Il n'y a pas encore de classement de podium archivé.</p>
        </div>
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('js/paginathing.min.js') }}"></script>
    <script src="{{ asset('js/archivesranking.js') }}"></script>

    <script>
        let lenghtlast = {!! isset($podia) ? json_encode($podia->count(), JSON_HEX_TAG)  : json_encode('0', JSON_HEX_TAG) !!};
        let previousYear = {!! isset($previousYear) ? json_encode($previousYear, JSON_HEX_TAG) : json_encode(null, JSON_HEX_TAG) !!};
        let url = {!! json_encode(route('rankingYear'), JSON_HEX_TAG) !!};

        let url_image = {!! json_encode(asset('images'), JSON_HEX_TAG) !!};
        let url_storage = {!! json_encode(asset('storage'), JSON_HEX_TAG) !!};

        createRankingArchives(lenghtlast, previousYear, url, url_image, url_storage);
    </script>
@endsection