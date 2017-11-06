@extends('layouts.master')

@section('content')
    <div class="main-content-title">
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
                                    <h2>{{ $tournament->date->format('Y-m-d') }}</h2>
                                    <p>{{ $tournament->title }}</p>
                                    <p>{{ $tournament->is_accredited ? 'Homologué' : 'Non homologué' }}</p>
                                    <p>{{ $tournament->place }}</p>
                                </div>
                                @if(isset($tournament->members) && $tournament->members->count()>0)
                                    <div class="archive-member">
                                        @foreach($tournament->members as $member)
                                            <p class="{{ ($member->club_id != 1) ? 'otherClub' : '' }}">{{ $member->last_name }} - {{ $member->first_name }}</p>
                                        @endforeach
                                    </div>
                                @endif

                                @if(isset($tournament->rules_url) || isset($tournament->rules_pdf))
                                    <div class="archive-image">
                                        <a href="{{ $tournament->is_rules_pdf ? asset('storage' . $tournament->rules_pdf) : $tournament->rules_url }}" target="_blank"><img src="{{ asset('images/tournament/Lexer.jpg') }}" alt="Image du lien"></a>
                                    </div>
                                @endif

                                @if(isset($tournament->listing))
                                    <div class="archive-image">
                                        <a href="{{ route('tournoiListing', $tournament->id) }}"><img src="{{ asset('images/tournament/Listing.jpg') }}" alt="Listing du tournoi {{ $tournament->title }}"></a>
                                    </div>
                                @endif

                                @if(isset($tournament->report))
                                    <div class="archive-image">
                                        <a href="{{ route('tournoiResultat', $tournament->id) }}"><img src="{{ asset('images/tournament/Report.jpg') }}" alt="Image du résultat"></a>
                                    </div>
                                @endif

                                @if(isset($tournament->pictures) && $tournament->pictures->count()>0)
                                    <div class="archive-image">
                                        <a href="{{ route('tournoiPhotos', $tournament->id) }}"><img src="{{ asset('images/tournament/Tournament-pictures.jpg') }}" alt="Image de présentation afin de montrer les photos du tournois"></a>
                                    </div>
                                @endif

                                @if(isset($tournament->videos) && $tournament->videos->count()>0)
                                    <div class="archive-image">
                                        <a href="{{ route('tournoiVideos', $tournament->id) }}"><img src="{{ asset('images/tournament/Tournament-videos.jpg') }}" alt="Image de présentation afin de montrer les vidéos du tournois"></a>
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
    <script src="{{ asset('js/jquery.easyPaginate.js') }}"></script>
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
                $this = $('#' + $(this).attr('id'));
                $this.easyPaginate({
					paginateElement: 'span',
					elementsPerPage: 2,
					effect: 'climb'
				});
            });
        });
    </script>
@endsection