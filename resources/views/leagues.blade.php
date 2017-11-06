@extends('layouts.master')

@section('content')
    <div class="main-content-title">
        <h1>Ligue</h1>
    </div>
    @if(isset($leagues) && $leagues->count()>0)
        <div class="main-content-occasion">

            <table class="occasion league-width">
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
                                    <p class="{{ ($member->club_id != 1) ? 'otherClub' : '' }}">{{ $member->last_name }} - {{ $member->first_name }}</p>
                                @endforeach
                            </td>
                        @endif

                        @if(isset($league->result) || isset($tournament->result))
                            <td class="occasion-image">
                                <a href="{{ $league->result }}"><img src="images/tournament/Lexer.jpg" alt="Image du lien"></a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>
            <div class="bottom-div">
                <div>
                    {{ $leagues->links() }}
                </div>
            </div>
        </div>
    @else
        <div class="main-content-occasion">
            <p>Il n'y a pas encore d'actualités.</p>
        </div>
    @endif
@endsection