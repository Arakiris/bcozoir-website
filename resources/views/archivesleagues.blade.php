@extends('layouts.master')

@section('content')
    <div class="main-content-title">
        <h1>{{ $title }}</h1>
    </div>
    <div class="main-content-archives">
        <ul class="tabs">
            <?php $first = true; ?>
            @foreach($leaguesByYear as $year => $leagues)
                @if($first)
                    <?php $first = false; ?>
                    <li class="tab-link current" data-tab="tab-{{ $year }}">{{ $year }}</li>
                @else
                    <li class="tab-link" data-tab="tab-{{ $year }}">{{ $year }}</li>
                @endif
            @endforeach
        </ul>

        <?php $first = true; ?>
        @foreach($leaguesByYear as $year => $leagues)
            @if($first)
                <?php $first = false; ?>
                <div id="tab-{{ $year }}" class="tab-content current">
            @else
                <div id="tab-{{ $year }}" class="tab-content">
            @endif
                <div class="archive league-width paginate" id="paginate-{{ $year }}">
                    @foreach($leagues as $league)
                        <span class="archive-row">
                            <div class="archive-information league-information">
                                <h2>{{ $league->day_of_week }}</h2>
                                <p>{{ $league->name }}</p>
                                <p>{{ $league->is_accredited ? 'Homologué' : 'Non homologué' }}</p>
                                <p>{{ $league->place }}</p>
                            </div>
                            <div class="archive-member league-member">
                                <p>{{ $league->team_name }}</p>
                            </div>
                            @if(isset($league->members) && $league->members->count()>0)
                                <div class="archive-member league-member">
                                    @foreach($league->members as $member)
                                        <p class="{{ ($member->club_id != 1) ? 'otherClub' : '' }}">{{ $member->last_name }} - {{ $member->first_name }}</p>
                                    @endforeach
                                </div>
                            @endif

                            @if(isset($league->result) || isset($tournament->result))
                                <div class="archive-image">
                                    <a href="{{ $league->result }}"><img src="{{ asset('images/tournament/Lexer.jpg') }}" alt="Image du lien"></a>
                                </div>
                            @endif
                        </span>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
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
					elementsPerPage: 2
				});
            });
        });
    </script>
@endsection