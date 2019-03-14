@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="leagues" />
@endsection


@section('content')
    <div class="occasion-content">
        @if(isset($warnings) && !is_null($warnings))
            <div class="main-content-title">
        @else
            <div class="main-content-title margin-top-30">
        @endif
            <h1>{{ $title }}</h1>
            <p>Cliquer sur les ligues pour avoir le r&egraveglement</p>
        </div>
        @if(isset($leagues) && $leagues->count()>0)
            <div class="main-content-occasion">

                <table class="occasion league-width">
                    <p></p>
                    @foreach($leagues as $league)
                        <tr class="occasion-row">
                            <td class="occasion-information league-information">
                                <h2>{{ $league->day_of_week }}</h2>
                                <p>{{ $league->name }}</p>
                                <p>{{ $league->is_accredited ? 'Homologué' : 'Non homologué' }}</p>
                                <p>{{ $league->place }}</p>
                            </td>
                            <td class="occasion-member league-member event-vertical-middle">
                                <p>{{ $league->team_name }}</p>
                            </td>
                            @if(isset($league->members) && $league->members->count()>0)
                                <td class="occasion-member league-member">
                                    @foreach($league->members as $member)
                                        <div class="tooltip-occasion">
                                            <p class="{{ ($member->club_id != 1) ? 'otherClub' : '' }}">{{ $member->last_name }} {{ $member->first_name }}</p>
                                            <div class="tooltiptext-occasion {{ ($member->is_licensee == 'Licencié') ?  'licensee' : 'adherent' }}">
                                                <img class="float-left full-size-img" src="{{ ($member->picture->first()) ? asset('storage' . $member->picture->first()->path) : null }}" alt="Photo de {{ $member->last_name }} - {{ $member->first_name }}">
                                                <div class="tooltipcontent">
                                                    @if($member->birth_date->diffInYears(Carbon\Carbon::now()) >= 100)
                                                        <p>{{ $member->last_name }} {{ $member->first_name }}</p>
                                                    @else
                                                        <p>{{ $member->last_name }} {{ $member->first_name }} - {{ $member->birth_date->diffInYears(Carbon\Carbon::now()) }} ans</p>
                                                    @endif
                                                    <p>{{ $member->club->name }}</p>
                                                    @if($member->is_licensee === "Licencié")
                                                        <p>Licence : {{ ($member->id_licensee) ? $member->id_licensee : '' }}</p>
                                                        <p>{{ $member->category->title }}</p>
                                                        <p>Moyenne : {{ $member->score ? $member->score->average : "Pas d'enregistrement"  }}</p>
                                                        <p>Handicap : {{ $member->handicap }}</p>
                                                        <p>Bonus vétéran : {{ $member->bonus }}</p>
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
                                <td class="occasion-image occasion-image-league">
                                    <a href="{{ $league->result }}" target="_blank"><img class="occasion-image-league-lexer" src="images/tournament/Lexer.jpg" alt="Image du lien"></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="bottom-tournament-league">
                <div class="bottom-div">
                    <div class="pagination-middle">
                        {{ $leagues->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="main-content-occasion">
                <p>Il n'y a pas encore de ligues.</p>
            </div>
        @endif
    </div>
@endsection