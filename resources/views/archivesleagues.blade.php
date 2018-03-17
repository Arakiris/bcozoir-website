@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="archives, leagues" />
@endsection

@section('content')
    @if(isset($warnings) && !is_null($warnings))
        <div class="main-content-title">
    @else
        <div class="main-content-title margin-top-30">
    @endif
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
                    <table class="archive-table" id="table-{{ $year }}">
                        <tbody>
                            @foreach($leagues as $league)
                                <tr>
                                    <td class="archive-information league-information">
                                        <h2>{{ $league->day_of_week }}</h2>
                                        <p>{{ $league->name }}</p>
                                        <p>{{ $league->is_accredited ? 'Homologué' : 'Non homologué' }}</p>
                                        <p>{{ $league->place }}</p>
                                    </td>
                                    <td class="archive-member league-member">
                                        <p>{{ $league->team_name }}</p>
                                    </td>
                                    @if(isset($league->members) && $league->members->count()>0)
                                        <td class="archive-member league-member">
                                            @foreach($league->members as $member)
                                                <div class="tooltip-occasion">
                                                    <p class="{{ ($member->club_id != 1) ? 'otherClub' : '' }}">{{ $member->last_name }} {{ $member->first_name }}</p>
                                                    <div class="tooltiptext-occasion {{ ($member->is_licensee == 'Licencié') ?  'licensee' : 'adherent' }}">
                                                        <img class="float-left full-size-img" src="{{ ($member->picture->first()->path) ? asset('storage' . $member->picture->first()->path) : null }}" alt="Photo de {{ $member->last_name }} - {{ $member->first_name }}">
                                                        <div class="tooltipcontent">
                                                            <p>{{ $member->last_name }} {{ $member->first_name }} - {{ $member->birth_date->diffInYears(Carbon\Carbon::now()) }} ans</p>
                                                            <p>{{ $member->club->name }}</p>
                                                            @if($member->is_licensee === "Licencié")
                                                                <p>Licence : {{ ($member->id_licensee) ? $member->id_licensee : '' }}</p>
                                                                <p>{{ $member->category->title }}</p>
                                                                <p>Moyenne : {{ $member->score ? $member->score->average : "Pas d'enregistrement"  }}</p>
                                                                <p>Handicap : {{ $member->handicap }}</p>
                                                                <p>Bonus : {{ $member->bonus }}</p>
                                                            @else
                                                                <p>{{ $member->is_licensee }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </td>
                                    @endif

                                    @if(isset($league->result) || isset($tournament->result))
                                        <td class="archive-image archive-image-leagues">
                                            <a href="{{ $league->result }}"><img class="archive-image-lexer" src="{{ asset('images/tournament/Lexer.jpg') }}" alt="Image du lien"></a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/paginathing.min.js') }}"></script>
    <script src="{{ asset('js/archivespaginate.js') }}"></script>
@endsection