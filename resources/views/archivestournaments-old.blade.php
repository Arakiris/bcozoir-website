@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="archives, tournois, {{ $title }}" />
@endsection

@section('content')
    @if(isset($warnings) && !is_null($warnings))
        <div class="main-content-title">
    @else
        <div class="main-content-title margin-top-30">
    @endif
        <h1>{{ $title }}</h1>
    </div>
    @if(isset($tournamentsByYear) && $tournamentsByYear->count()>0)
        <div class="main-content-archives">
            <ul class="tabs">
                <?php $first = true; ?>
                @foreach($tournamentsByYear as $year => $tournaments)
                    @if($first)
                        <?php $first = false; ?>
                        <li class="tab-link current" data-tab="tab-{{ $year }}">{{ $year }}</li>
                    @else
                        <li class="tab-link" data-tab="tab-{{ $year }}">{{ $year }}</li>
                    @endif
                @endforeach
            </ul>

            <?php $first = true; ?>
            @foreach($tournamentsByYear as $year => $tournaments)
                @if($first)
                    <?php $first = false; ?>
                    <div id="tab-{{ $year }}" class="tab-content current">
                @else
                    <div id="tab-{{ $year }}" class="tab-content">
                @endif
                    <div class="archive paginate" id="paginate-{{ $year }}">
                        @foreach($tournaments as $tournament)
                            <span class="archive-row">
                                <div class="archive-information">
                                    @if(isset($tournament->rules_url) || isset($tournament->rules_pdf))
                                        <a class="occasion-link" href="{{ $tournament->is_rules_pdf ? asset('storage' . $tournament->rules_pdf) : $tournament->rules_url }}" target="_blank">
                                            <h2><?php setlocale(LC_TIME, 'fr'); echo utf8_encode(strftime("%d-%B-%Y", $tournament->date->timestamp)); ?></h2>
                                            <p>{{ $tournament->title }}</p>
                                            <p>{{ $tournament->is_accredited ? 'Homologué' : 'Non homologué' }}</p>
                                            <p>{{ $tournament->place }}</p>
                                        </a>
                                    @else
                                        <h2><?php setlocale(LC_TIME, 'fr'); echo utf8_encode(strftime("%d-%B-%Y", $tournament->date->timestamp)); ?></h2>
                                        <p>{{ $tournament->title }}</p>
                                        <p>{{ $tournament->is_accredited ? 'Homologué' : 'Non homologué' }}</p>
                                        <p>{{ $tournament->place }}</p>
                                    @endif
                                </div>
                                @if(isset($tournament->members) && $tournament->members->count()>0)
                                    <div class="archive-member">
                                        @foreach($tournament->members as $member)
                                            <div class="tooltip-occasion">
                                                <p class="{{ ($member->club_id != 1) ? 'otherClub' : '' }}">{{ $member->last_name }} {{ $member->first_name }}</p>
                                                <div class="tooltiptext-occasion {{ ($member->is_licensee == 'Licencié') ?  'licensee' : 'adherent' }}">
                                                    <img class="float-left full-size-img" src="{{ ($member->picture->first()) ? asset('storage' . $member->picture->first()->path) : null }}" alt="Photo de {{ $member->last_name }} - {{ $member->first_name }}">
                                                    <div class="tooltipcontent">
                                                        <p>{{ $member->last_name }} {{ $member->first_name }} - {{ $member->birth_date->diffInYears(Carbon\Carbon::now()) }} ans</p>
                                                        <p>{{ $member->club->name }}</p>
                                                        @if($member->is_licensee === "Licencié")
                                                            <p>Licence : {{ ($member->id_licensee) ? $member->id_licensee : '' }}</p>
                                                            <p>{{ $member->category->title }}</p>
                                                            <p>Moyenne : {{ ($member->score && $member->score->average) ? intval($member->score->average) : "Pas d'enregistrement"  }}</p>
                                                            <p>Handicap : {{ $member->handicap }}</p>
                                                            <p>Bonus : {{ $member->bonus }}</p>
                                                        @else
                                                            <p>{{ $member->is_licensee }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @if(isset($tournament->lexer_url))
                                    <div class="archive-image">
                                        <a href="{{ $tournament->lexer_url }}" target="_blank"><img class="archive-image-logo" src="{{ asset('images/tournament/Lexer.jpg') }}" alt="Image du lien"></a>
                                    </div>
                                @endif

                                @if(isset($tournament->listing))
                                    <div class="archive-image">
                                        <a href="{{ route('tournoiListing', $tournament->slug) }}"><img class="archive-image-logo" src="{{ asset('images/tournament/Listing.jpg') }}" alt="Listing du tournoi {{ $tournament->title }}"></a>
                                    </div>
                                @endif

                                @if(isset($tournament->report))
                                    <div class="archive-image">
                                        <a href="{{ route('tournoiResultat', $tournament->slug) }}"><img class="archive-image-logo" src="{{ asset('images/tournament/Report.jpg') }}" alt="Image du résultat"></a>
                                    </div>
                                @endif

                                @if(isset($tournament->pictures) && $tournament->pictures->count()>0)
                                    <div class="archive-image">
                                        <a href="{{ route('tournoiPhotos', $tournament->slug) }}"><img class="archive-image-logo" src="{{ asset('images/tournament/tournament-pictures.png') }}" alt="Image de présentation afin de montrer les photos du tournois"></a>
                                    </div>
                                @endif

                                @if(isset($tournament->videos) && $tournament->videos->count()>0)
                                    <div class="archive-image">
                                        <a href="{{ route('tournoiVideos', $tournament->slug) }}"><img class="archive-image-logo" src="{{ asset('images/tournament/Tournament-videos.jpg') }}" alt="Image de présentation afin de montrer les vidéos du tournois"></a>
                                    </div>
                                @endif
                            </span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="main-content-archives">
            <p>Il n'y a pas encore de tournoi archivé.</p>
        </div>
    @endif
@endsection

@section('scripts')
    {{--  <script src="{{ asset('js/jquery.easyPaginate.js') }}"></script>
    <script src="{{ asset('js/archivespaginate.js') }}"></script>  --}}
    <script src="{{ asset('js/paginathing.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('ul.tabs li').click(function(){
                var tab_id = $(this).attr('data-tab');
        
                $('ul.tabs li').removeClass('current');
                $('.tab-content').removeClass('current');
        
                $(this).addClass('current');
                $("#"+tab_id).addClass('current');
            });
        
            $('div.paginate').each(function(index, element){
                $this = $('#' + $(this).attr('id') + ' tbody');
                $this.paginathing({
                    perPage: 5,
                    insertAfter: '.tab-content',
                    pageNumbers: true
                });
            });
        });
    </script>
@endsection